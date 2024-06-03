<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use App\Http\Requests\EditOrder;
use App\Http\Requests\OrderProductQuantity;
use Illuminate\Validation\Rule;

class ManagementEditController extends Controller
{
    public function showOrderEdit(Order $order)
    {
        $user = User::find($order->user_id);
        $order_details = $order->products;
        $total = $order_details->map(function($order_detail) {
            return $order_detail->price * $order_detail->pivot->quantity;
        })->sum();

        return view('management.order-edit', [
            'order' => $order,
            'user' => $user,
            'order_details' => $order_details,
            'total' => $total,
        ]);
    }

    public function editOrder(Order $order, EditOrder $request)
    {
        $order->payment = $request->payment;
        $order->status = $request->status;

        $order->save();

        return redirect()->route('management.order-edit', [
            'order' => $order,
        ])->with('edit-order', 'updated');
    }

    public function changePurchaseQuantity(Order $order, OrderDetail $order_detail, Request $request)
    {
        $this->checkRelation($order, $order_detail);

        $quantity_rule = Rule::in(config('const.order_quantity'));

        $request->validateWithBag('changePurchaseQuantity', [
            'quantity' => 'required|' . $quantity_rule,
        ]);

        $order_detail->quantity = $request->quantity;
        $order_detail->save();

        $details = $order->products;
        $total = $details->map(function($detail) {
            return $detail->price * $detail->pivot->quantity;
        })->sum();

        $order->total_amount = $total;

        $order->save();

        return redirect()->route('management.order-edit', [
            'order' => $order,
        ])->with('change-purchase-quantity', 'changed');
    }

    private function checkRelation(Order $order, OrderDetail $order_detail)
    {
        if ($order->id !== $order_detail->order_id) {
            abort(404);
        }
    }
}
