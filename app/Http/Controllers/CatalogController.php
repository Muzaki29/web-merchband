<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::where('is_active', true)->with('variants')->get();
        return view('catalog.index', compact('products'));
    }

    public function show(Product $product)
    {
        if (!$product->is_active) {
            abort(404);
        }
        
        $product->load('variants');
        return view('catalog.show', compact('product'));
    }
}
