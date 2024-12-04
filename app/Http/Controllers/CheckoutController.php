<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function show()
    {
        // Menampilkan halaman checkout
        return view('checkout.show');
    }

    public function process(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string|in:credit_card,bank_transfer,cash',
        ]);

        // Proses data checkout (contoh: simpan ke database)
        // Order::create($validatedData);

        // Hapus semua item di keranjang
        session()->forget('cart');

        // Redirect ke halaman sukses
        return redirect()->route('checkout.success')->with('message', 'Checkout berhasil! Terima kasih atas pesanan Anda.');
    }



    public function success()
    {
        return view('checkout.success');
    }
}
