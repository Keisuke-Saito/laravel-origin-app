<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        $query = Product::query();
        $search = $request->input('search');

        if (!empty($search))
        {
            $query->where('product_name', 'LIKE', "%{$search}%")->get();
        }

        $products = $query->paginate(6)->appends($request->all());

        return view('products.product-list', [
            'products' => $products,
            'search' => $search,
        ]);
    }

    public function showProductDetail(Product $product)
    {
        return view('products.product-detail', [
            'product' => $product,
        ]);
    }
}
