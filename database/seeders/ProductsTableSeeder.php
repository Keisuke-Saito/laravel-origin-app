<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            [
                'product_name' => 'やきとり',
                'price' => '200',
                'image' => 'yakitori.jpg',
                'content' => 'やきとりです',
            ],

            [
                'product_name' => 'そうめん',
                'price' => '300',
                'image' => 'somen.jpg',
                'content' => '麺です',
            ],

            [
                'product_name' => 'うどん',
                'price' => '400',
                'image' => 'udon.jpg',
                'content' => 'うどんです',
            ],

            [
                'product_name' => 'わらび餅',
                'price' => '500',
                'image' => 'warabimoti.jpg',
                'content' => '餅です',
            ],

            [
                'product_name' => '鮎',
                'price' => '1000',
                'image' => 'ayu.jpg',
                'content' => '魚です',
            ],

            [
                'product_name' => '腕時計',
                'price' => '2000',
                'image' => 'udedokei.jpg',
                'content' => '時計です',
            ],

            [
                'product_name' => '扇風機',
                'price' => '3000',
                'image' => 'senpuki.jpg',
                'content' => '扇風機です',
            ],
        ];

        foreach ($products as $product) {
            $product['created_at'] = Carbon::now();
            $product['updated_at'] = Carbon::now();
            DB::table('products')->insert([$product]);
        }
    }
}
