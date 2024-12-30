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

class CheckoutController extends Controller
{
    public function show()
    {
        $cartItems = session()->get('cart', []);
        $total = array_reduce($cartItems, function ($sum, $item) {
            return $sum + $item['price'] * $item['quantity'];
        }, 0);
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
            // Buat alamat pengiriman
            $address = Address::create([
                'user_id' => Auth::id(),
                'address' => $validatedData['address'],
                'city' => 'Jakarta',
                'postal_code' => '15340',
            ]);

            // Buat pesanan
            $order = Order::create([
                'user_id' => Auth::id(),
                'address_id' => $address->id,
                'total_amount' => $request->total,
            ]);

            // Simpan pembayaran sementara dengan status 'pending'
            $payment = Payment::create([
                'order_id' => $order->id,
                'payment_method' => 'midtrans',
                'amount' => $request->total,
                'status' => 'pending',
                'invoice' => 'INV-' . strtoupper(uniqid()),
            ]);

            // Konfigurasi Midtrans
            Config::$serverKey = config('services.midtrans.server_key');
            Config::$isProduction = false;
            Config::$isSanitized = true;
            Config::$is3ds = true;

            // Data transaksi Midtrans
            $transactionDetails = [
                'order_id' => $order->id,
                'gross_amount' => $request->total,
            ];

            $customerDetails = [
                'first_name' => $validatedData['name'],
                'email' => $validatedData['email'],
                'phone' => $validatedData['phone'],
                'address' => $validatedData['address'],
            ];

            $snapToken = Snap::getSnapToken([
                'transaction_details' => $transactionDetails,
                'customer_details' => $customerDetails,
            ]);

            DB::commit();

            // Kirim token Snap ke view
            return view('checkout.midtrans', compact('snapToken', 'order'));
        } catch (\Exception $e) {
            DB::rollBack();
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
