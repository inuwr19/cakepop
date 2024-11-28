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
        // Validasi data checkout
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string',
        ]);

        // Proses data checkout (misalnya, simpan ke database atau lakukan pembayaran)

        // Redirect ke halaman konfirmasi atau sukses
        return redirect()->route('checkout.success')->with('message', 'Checkout berhasil! Terima kasih atas pesanan Anda.');
    }

    public function success()
    {
        return view('checkout.success');
    }
}
