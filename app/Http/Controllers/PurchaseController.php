<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\PurchaseConfirm;

class PurchaseController extends Controller
{
    public function showDeliveryAdress(Request $request)
    {
        return view('cartitems.delivery', [
            'user' => $request->user(),
        ]);
    }

    public function confirm(PurchaseConfirm $request)
    {
        $user = User::find(Auth::id());
        $address = $request->address;
        $payment = $request->payment;
        $carts = $user->products;

        $total = $carts->map(function($cart) {
            return $cart->price * $cart->pivot->quantity;
        })->sum();

        return view('cartitems.confirm', [
            'user' => $user,
            'address' => $address,
            'payment' => $payment,
            'carts' => $carts,
            'total' => $total,
        ]);
    }

    public function done(Request $request)
    {
        $request->session()->regenerateToken();
        $user = User::find(Auth::id());
        $carts = $user->products;

        // ordersテーブルに保存
        $order = new Order();

        $order->name = $request->name;
        $order->delivery_address = $request->address;
        $order->payment = $request->payment;
        $order->total_amount = $request->total;

        Auth::user()->orders()->save($order);

        // order_detailsテーブルに保存
        $orderId = Order::latest('id')->first();

        foreach ($carts as $cart)
        {
            $order_detail = new OrderDetail();

            $order_detail->product_id = $cart->id;
            $order_detail->order_id = $orderId->id;
            $order_detail->quantity = $cart->pivot->quantity;

            $order_detail->save();
        }

        // カートから商品を全て削除
        $cart_items = CartItem::where('user_id', Auth::id())->delete();


        return view('cartitems.done');
    }
}
