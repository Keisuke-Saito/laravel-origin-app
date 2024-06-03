<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\ProductQuantity;

class CartItemController extends Controller
{
    public function showCartItem()
    {
        $user = User::find(Auth::id());
        $carts = $user->products;

        $total = $carts->map(function($cart) {
            return $cart->price * $cart->pivot->quantity;
        })->sum();

        return view('cartitems.cart', [
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function changeQuantity(CartItem $cart_item, ProductQuantity $request)
    {
        $cart_item->quantity = $request->quantity;
        $cart_item->save();

        return redirect()->route('cartitems.cart');
    }

    public function destroyProduct(CartItem $cart_item)
    {
        $cart_item->delete();

        return redirect()->route('cartitems.cart');
    }
}
