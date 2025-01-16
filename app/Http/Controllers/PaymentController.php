<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use App\Models\Address;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use GuzzleHttp\Client;

class PaymentController extends Controller
{
    public function process(Request $request, $orderId)
    {
        $order = Order::findOrFail($orderId);

        // Konfigurasi Midtrans
        Config::$serverKey = config('services.midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        // Data transaksi Midtrans
        $transactionDetails = [
            'order_id' => $order->id,
            'gross_amount' => $order->total_amount,
        ];

        $customerDetails = [
            'first_name' => Auth::user()->name,
            'email' => Auth::user()->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $snapToken = Snap::getSnapToken([
            'transaction_details' => $transactionDetails,
            'customer_details' => $customerDetails,
        ]);

        // Simpan pembayaran sementara dengan status 'pending'
        $payment = Payment::create([
            'order_id' => $order->id,
            'payment_method' => 'midtrans',
            'amount' => $order->total_amount,
            'status' => 'pending',
            'invoice' => 'INV-' . strtoupper(uniqid()),
        ]);

        // Kirim token Snap ke view
        return view('checkout.midtrans', compact('snapToken', 'order'));
    }


    public function checkPaymentStatus($orderId)
    {
        try {
            // 1. Buat koneksi ke Midtrans API
            $client = new \GuzzleHttp\Client([
                'verify' => base_path('resources\cacert.pem'), // Path ke sertifikat SSL
            ]);

            $serverKey = config('services.midtrans.server_key'); // Ambil Server Key dari config
            $url = "https://api.sandbox.midtrans.com/v2/{$orderId}/status";

            // 2. Kirim Request ke Midtrans
            $response = $client->request('GET', $url, [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode($serverKey . ':'),
                    'Content-Type' => 'application/json',
                ],
            ]);

            // 3. Ambil data respons dari Midtrans
            $result = json_decode($response->getBody()->getContents(), true);

            // 4. Proses status transaksi
            $payment = Payment::where('order_id', $orderId)->first();
            
            if ($payment) {
                DB::beginTransaction();
                switch ($result['transaction_status']) {
                    case 'settlement': // Pembayaran berhasil
                        $payment->status = 'success';
                        Cart::where('user_id', $payment->order->user_id)->delete();
                        session()->forget('cart');
                        break;

                    case 'pending': // Menunggu pembayaran
                        $payment->status = 'pending';
                        break;

                    case 'deny': // Ditolak
                    case 'cancel':
                        $payment->status = 'failed';
                        break;

                    case 'expire': // Kadaluwarsa
                        $payment->status = 'expired';
                        break;
                }

                // 5. Simpan pembaruan status
                $payment->payment_method = $result['payment_type']; // Simpan metode pembayaran
                $payment->save();
                DB::commit();

                return response()->json(['message' => 'Status updated successfully!']);
            }

            return response()->json(['message' => 'Payment not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
