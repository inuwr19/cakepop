<?php

namespace App\Http\Controllers;

use App\Models\Cake;
use Illuminate\Http\Request;

class CakeController extends Controller
{
    public function index()
    {
        $cakes = Cake::all();
        return view('cakes.index', compact('cakes'));
    }
    public function dashboard()
    {
        $cakes = Cake::all();
        return view('cakes.index', compact('cakes'));
    }

    public function search(Request $request)
    {
        $query = $request->input('query');
        $cakes = Cake::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->paginate(10); // Sesuai kebutuhan

        return view('cakes.search', compact('cakes', 'query'));
    }

    public function product()
    {
        $cakes = Cake::all();
        return view('cakes.product', compact('cakes'));
    }

    public function about()
    {
        // Return the About Us view
        return view('cakes.about');
    }

    public function show($id)
    {
        // Ambil data cake berdasarkan ID
        $cake = Cake::findOrFail($id);

        // Ambil produk terkait berdasarkan kategori yang sama (kecuali produk yang sedang ditampilkan)
        $relatedCakes = Cake::where('category_id', $cake->category_id)
            ->where('id', '!=', $cake->id)
            ->take(4)
            ->get();

        // Ambil produk lain untuk bagian "Anda Mungkin Juga Suka"
        $otherCakes = Cake::where('id', '!=', $cake->id)
            ->inRandomOrder()
            ->take(4)
            ->get();

        return view('cakes.product-detail', compact('cake', 'relatedCakes', 'otherCakes'));
    }
}
