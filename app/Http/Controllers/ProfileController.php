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
        $request->validate([
            'address' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'postal_code' => 'required|string|max:10',
        ]);

        $user = Auth::user();

        // Update or create address
        $user->address()->updateOrCreate(
            ['user_id' => $user->id],
            $request->only(['address', 'city', 'postal_code'])
        );

        return redirect()->route('profile.user')->with('status', 'Alamat berhasil diperbarui.');
    }
}
