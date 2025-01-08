<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function edit()
    {
        return view('profile.edit');
    }
    public function history()
    {
        return view('profile.history');
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
        ]);

        $user = Auth::user();
        $user->update($request->only(['name', 'email']));

        return redirect()->route('profile.user')->with('status', 'Informasi pengguna berhasil diperbarui.');
    }

    public function updateAddress(Request $request)
    {
        // Validasi input
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
            'phone' => 'required|string|max:15', // Validasi tambahan untuk phone
        ]);

        // Dapatkan pengguna yang sedang login
        $user = Auth::user();

        // Perbarui atau buat alamat
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            [
                'address' => $request->address,
                'city' => $request->city,
                'postal_code' => $request->postal_code,
                'phone' => $request->phone, // Simpan nomor telepon
            ]
        );

        return redirect()->route('profile.user')->with('status', 'Alamat berhasil diperbarui.');
    }
}
