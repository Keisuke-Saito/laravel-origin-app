<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use Carbon\Carbon;

class ManagementController extends Controller
{
    public function showOrder(Request $request)
    {
        $query = Order::query();
        $from = $request->order_from;
        $until = Carbon::parse($request->order_until)->endOfDay();

        // 注文ID
        if($order_id = $request->order_id) {
            $query->where('id', '=', $order_id);
        }

        // 注文日（始まり）
        if(isset($from)) {
            $query->where('created_at', '>=', $from);
        }

        // 注文日（終わり）
        if(isset($until)) {
            $query->where('created_at', '<=', $until);
        }

        // 注文者
        if($name = $request->name) {
            $query->where('name', 'LIKE', "{$name}");
        }

        // 支払い方法
        if($payment = $request->payment) {
            $query->where('payment', 'LIKE', "{$payment}");
        }

        // 最小金額
        if($min_price = $request->min_price) {
            $query->where('total_amount', '>=', $min_price);
        }

        // 最大金額
        if($max_price = $request->max_price) {
            $query->where('total_amount', '<=', $max_price);
        }

        // ステータス
        if($status = $request->status) {
            $query->where('status', '=', $status);
        }

        if($sort = $request->sort) {
            $direction = $request->direction == 'desc' ? 'desc' : 'asc';
            $query->orderBy($sort, $direction);
        }

        $orders = $query->paginate(10)->appends($request->all());

        return view('management.order', [
            'orders' => $orders,
        ]);
    }
}
