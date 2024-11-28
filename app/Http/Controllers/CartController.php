<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index()
    {
        // Ambil item dari session untuk ditampilkan di halaman Cart
        $cart = session()->get('cart', []);
        $totalPrice = array_reduce($cart, function ($carry, $item) {
            return $carry + ($item['price'] * $item['quantity']);
        }, 0);

        return view('cart.index', compact('cart', 'totalPrice'));
    }

    public function add(Request $request)
    {
        $cake = Cake::findOrFail($request->input('cake_id'));

        $cart = session()->get('cart', []);
        if (isset($cart[$cake->id])) {
            $cart[$cake->id]['quantity']++;
        } else {
            $cart[$cake->id] = [
                "name" => $cake->name,
                "price" => $cake->price,
                "quantity" => 1,
                "image" => $cake->image,
            ];
        }
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item added to cart!');
    }

    public function update(Request $request)
    {
        $cart = session()->get('cart');
        $cart[$request->input('cake_id')]["quantity"] = $request->input('quantity');
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Cart updated!');
    }

    public function remove(Request $request)
    {
        $cart = session()->get('cart');
        unset($cart[$request->input('cake_id')]);
        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Item removed from cart!');
    }

    public function confirmation()
    {
        $cartItems = session()->get('cart', []);
        $total = array_reduce($cartItems, function ($sum, $item) {
            return $sum + $item['price'] * $item['quantity'];
        }, 0);

        return view('cart.confirmation', compact('cartItems', 'total'));
    }
}
