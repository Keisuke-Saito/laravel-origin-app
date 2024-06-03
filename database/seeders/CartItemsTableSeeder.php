<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class CartItemsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = DB::table('users')->first();
        $product = DB::table('products')->first();

        DB::table('cart_items')->insert([
            'product_id' => $product->id,
            'quantity' => 1,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'user_id' => $user->id,
        ]);
    }
}
