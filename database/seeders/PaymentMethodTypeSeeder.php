<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use function Laravel\Prompts\table;

class PaymentMethodTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('payment_method_types')->insert([
            [
                'name' => 'Visa',
                'img' => '/imgs/paymentMethodTypes/Visa.png',
            ],
            [
                'name' => 'Mastercard',
                'img' => '/imgs/paymentMethodTypes/Mastercard.png',
            ]
    ]);
    }
}
