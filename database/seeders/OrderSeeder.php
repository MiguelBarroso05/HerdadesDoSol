<?php

namespace Database\Seeders;

use App\Models\Billing;
use App\Models\Invoice;
use App\Models\Order;
use App\Models\OrderActivity;
use App\Models\OrderProduct;
use App\Models\PaymentMethod;
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
        PaymentMethod::create([
            'user_id' => 2,
            'identifier' => 'cartao1',
            'type' => 'VISA',
            'name' => 'Marco Candido',
            'number' => '123412341234',
            'last4' => '1234',
            'validity' => '12/24'
        ]);

        Billing::create([
            'user_id' => 2,
            'address_id' => 1,
            'name' => 'Marco Candido',
            'nif' => '123412341',
            'email' => 'marcocandido@gmail.com',
            'phone' => '123123123'
        ]);

        Invoice::create([
            'billing_id' => 1,
            'payment_method_id' => 1,
            'payment_date' => now()
        ]);

        Order::create([
            'id' => "LSDMMSL11",
            'user_id' => 2,
            'status' => 0,
            'price' => 5,
            'estate_id' => 2,
            'invoice_id' => 1,
        ]);

        Order::create([
            'id' => "AAAWESA23",
            'user_id' => 2,
            'status' => 1,
            'price' => 5,
            'estate_id' => 2,
            'invoice_id' => 1,
        ]);

        Order::create([
            'id' => "BBBTRS45",
            'user_id' => 2,
            'status' => 2,
            'price' => 5,
            'estate_id' => 2,
            'invoice_id' => 1,
        ]);

        Order::create([
            'id' => "LLL45TSJA",
            'user_id' => 2,
            'status' => 3,
            'price' => 5,
            'estate_id' => 2,
            'invoice_id' => 1,
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
