<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CatalogController extends Controller
{
    public function index()
    {
        $products = Product::with('variants')->get();
        return view('catalog.index', compact('products'));
    }

    public function show(Product $product)
    {
        $product->load('variants');
        return view('catalog.show', compact('product'));
    }
}
