<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */

    //  シーダーの一括実行

    public function run(): void
    {
        $this->call([
            UsersTableSeeder::class,
            ProductsTableSeeder::class,
            AdminsTableSeeder::class,
            CartItemsTableSeeder::class,
            OrdersTableSeeder::class,
            OrderDetailsTableSeeder::class,
        ]);
    }
}
