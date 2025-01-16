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
use GuzzleHttp\Exception\RequestException;
use Illuminate\Support\Str;




class CheckoutController extends Controller
{
    public function show()
    {
        // Mengambil data keranjang dari sesi
        $cartItems = session()->get('cart', []);

        // Menghitung total pembayaran
        $total = collect($cartItems)->sum(function ($item) {
            return $item['price'] * $item['quantity']; // Mengakses dengan notasi array
        });


        // Menampilkan halaman checkout
        return view('checkout.show', compact('cartItems', 'total'));
    }



    public function process(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
        ]);

        DB::beginTransaction();

        try {
            $address = Address::create([
                'user_id' => Auth::id(),
                'address' => $validatedData['address'],
                'city' => 'Jakarta',
                'postal_code' => '15340',
            ]);

            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $address->id,
                'total_amount' => $request->total,
            ]);

            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'midtrans',
                'amount' => $request->total,
                'status' => 'pending',
                'invoice' => 'INV-' . strtoupper(uniqid()),
            ]);

            // dd($order, $payment);

            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Menggunakan sertifikat SSL melalui konfigurasi
            $client = new \GuzzleHttp\Client([
                'verify' => base_path('resources/cacert.pem'), // Path ke sertifikat SSL
            ]);

            $transactionDetails = [
                'order_id' => $payment->invoice,
                'gross_amount' => $request->total,
            ];

            // dd($transactionDetails);

            $customerDetails = [
                'first_name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
            ];

            Log::info('Transaction Details: ', $transactionDetails);
            Log::info('Customer Details: ', $customerDetails);

            $response = $client->post('https://app.sandbox.midtrans.com/snap/v1/transactions', [
                'headers' => [
                    'Authorization' => 'Basic ' . base64_encode(config('services.midtrans.server_key') . ':'),
                    'Content-Type' => 'application/json',
                ],
                'json' => [
                    'transaction_details' => $transactionDetails,
                    'customer_details' => $customerDetails,
                ],
            ]);

            $body = $response->getBody()->getContents();
            $result = json_decode($body);

            if (isset($result->token)) {
                $snapToken = $result->token;
            }

            Log::info('Snap Token: ', ['snap_token' => $snapToken]);
            Log::info('Midtrans Response: ', ['response' => $body]);

            DB::commit();

            return view('checkout.midtrans', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error processing payment: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memproses pesanan Anda.');
        }
    }





    public function callback(Request $request)
    {
        // Server key and signature validation
        $serverKey = config('services.midtrans.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        Log::info('Midtrans Callback Data:', $request->all());

        if ($hashed == $request->signature_key) {
            // Find the payment based on the order_id
            $payment = Payment::where('order_id', $request->order_id)->first();

            if ($payment) {
                // Update the payment status based on the transaction_status
                switch ($request->transaction_status) {
                    case 'settlement':
                        $payment->status = 'success';
                        $payment->payment_method = $request->payment_type;
                        break;
                    case 'pending':
                        $payment->status = 'pending';
                        break;
                    case 'deny':
                        $payment->status = 'failed';
                        break;
                    case 'expire':
                        $payment->status = 'expired';
                        break;
                    case 'cancel':
                        $payment->status = 'canceled';
                        break;
                }

                // Save the updated payment record
                $payment->save();
            }
        }

        // Optionally, you can return a response (like redirect or json)
        return response()->json(['message' => 'Callback processed successfully']);
        // return route('invoice.show', ['orderId' => $payment]);
    }

    public function history()
    {
        $orders = Order::where('user_id', Auth::id())
            ->with(['address', 'payments' => function ($query) {
                $query->orderBy('created_at'); // Ambil pembayaran terbaru
            }])
            ->get();

        return view('orders.history', compact('orders'));
    }

    public function invoice($orderId)
    {

        $order = Order::with(['address', 'payments'])->findOrFail($orderId);
        return view('orders.invoice', compact('order'));
    }


    public function success()
    {
        return view('checkout.success');
    }
}
