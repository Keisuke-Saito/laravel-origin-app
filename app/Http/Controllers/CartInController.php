<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductQuantity;

class CartInController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function cartIn(Product $product, ProductQuantity $request)
    {
        // 商品が既にカートに入っている場合は追加しない
        if (CartItem::where([
            ['product_id', $product->id],
            ['user_id', Auth::id()],
        ])->exists())
        {
            return redirect()->route('products.product-detail', [
                'product' => $product->id,
            ])->with('message.warning','すでにカートに入っています');
        } else {

            $cart_item = new CartItem();

            $cart_item->product_id = $product->id;
            $cart_item->quantity = $request->quantity;

            Auth::user()->cart_items()->save($cart_item);

            return redirect()->route('products.product-detail', [
                'product' => $product->id,
            ])->with('message.success','カートに追加しました');
        }
    }
}