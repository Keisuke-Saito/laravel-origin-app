<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use App\Models\Product;
use Carbon\Carbon;

class OrderDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (range(1,3) as $num)
        {
            $product = Product::find($num);
            $order = DB::table('orders')->first();

            DB::table('order_details')->insert([
                'product_id' => $product->id,
                'order_id' => $order->id,
                'quantity' => $num,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}