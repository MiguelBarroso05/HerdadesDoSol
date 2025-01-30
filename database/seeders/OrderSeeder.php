<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\OrderActivity;
use App\Models\OrderProduct;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Order::create([
            'id' => "LSDMMSL11",
            'user_id' => 2,
            'status' => 0,
            'price' => 5,
            'estate_id' => 2,
        ]);

        Order::create([
            'id' => "AAAWESA23",
            'user_id' => 2,
            'status' => 1,
            'price' => 5,
            'estate_id' => 2,
        ]);

        Order::create([
            'id' => "BBBTRS45",
            'user_id' => 2,
            'status' => 2,
            'price' => 5,
            'estate_id' => 2,
        ]);

        Order::create([
            'id' => "LLL45TSJA",
            'user_id' => 2,
            'status' => 3,
            'price' => 5,
            'estate_id' => 2,
        ]);

        OrderProduct::create([
            'order_id' => "LSDMMSL11",
            'product_id' => 1,
            'quantity' => 2,
        ]);

        OrderProduct::create([
            'order_id' => "AAAWESA23",
            'product_id' => 2,
            'quantity' => 3,
        ]);

        OrderActivity::create([
            'order_id' => "BBBTRS45",
            'activity_id' => 1,
            'date' => now(),
        ]);

        OrderActivity::create([
            'order_id' => "LLL45TSJA",
            'activity_id' => 2,
            'date' => now(),
        ]);
    }
}
