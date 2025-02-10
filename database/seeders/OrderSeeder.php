<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Faker\Factory as Faker;
use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create();

        // Get existing data
        $userIds = DB::table('users')->pluck('id')->toArray();
        $addressIds = DB::table('addresses')->pluck('id')->toArray();
        // Insert Billings
        $this->seedBillings($userIds, $addressIds, $faker);
        $billingIds = DB::table('billings')->pluck('id')->toArray();
        $paymentMethodTypeIds = DB::table('payment_method_types')->pluck('id')->toArray();
        $productIds = DB::table('products')->pluck('id')->toArray();

        // Validate necessary data
        if (empty($userIds) || empty($addressIds) || empty($billingIds) || empty($paymentMethodTypeIds) || empty($productIds)) {
            $this->outputMissingDataCount($userIds, $addressIds, $billingIds, $paymentMethodTypeIds, $productIds);
            return;
        }



        // Insert Payment Methods
        $paymentMethodIds = $this->seedPaymentMethods($userIds, $paymentMethodTypeIds, $faker);
        // Insert Invoices
        $invoiceIds = $this->seedInvoices($billingIds, $paymentMethodIds, $faker);

        // Insert Orders and Order_Products
        $this->seedOrders($userIds, $addressIds, $invoiceIds, $productIds, $faker);
    }

    /**
     * Output missing data counts if required.
     */
    private function outputMissingDataCount(array $userIds, array $addressIds, array $billingIds, array $paymentMethodTypeIds, array $productIds)
    {
        dump([
            'users' => count($userIds),
            'addresses' => count($addressIds),
            'billings' => count($billingIds),
            'payment_methods_types' => count($paymentMethodTypeIds),
            'products' => count($productIds),
        ]);
        $this->command->warn('Skipping seeding. Missing required data.');
    }

    /**
     * Seed Billings
     */
    private function seedBillings(array $userIds, array $addressIds, $faker)
    {
        $billings = array_map(function ($userId) use ($addressIds, $faker) {
            return [
                'user_id' => $userId,
                'address_id' => $faker->randomElement($addressIds), // Can be null or a valid id
                'name' => $faker->name(),
                'nif' => $faker->numberBetween(100000000, 999999999), // Random NIF
                'email' => $faker->email(),
                'phone' => $faker->phoneNumber(),
            ];
        }, $userIds);

        DB::table('billings')->insert($billings);
    }

    /**
     * Seed Payment Methods
     */
    private function seedPaymentMethods(array $userIds, array $paymentMethodTypeIds, $faker): array
    {
        $paymentMethods = array_map(function ($userId) use ($paymentMethodTypeIds, $faker) {
            return [
                'user_id' => $userId,
                'identifier' => 'Card',
                'payment_method_type_id' => $faker->randomElement($paymentMethodTypeIds),
                'name' => $faker->creditCardType(),
                'number' => $faker->creditCardNumber(),
                'last4' => substr($faker->creditCardNumber(), -4),
                'validity' => $faker->creditCardExpirationDateString(),
                'predefined' => rand(0, 1),
            ];
        }, $userIds);

        DB::table('payment_methods')->insert($paymentMethods);
        return DB::table('payment_methods')->pluck('id')->toArray();
    }

    /**
     * Seed Invoices
     */
    private function seedInvoices(array $billingIds, array $paymentMethodIds, $faker): array
    {
        $invoices = array_map(function () use ($billingIds, $paymentMethodIds, $faker) {
            return [
                'billing_id' => $faker->randomElement($billingIds),
                'payment_method_id' => $faker->randomElement($paymentMethodIds),
                'payment_date' => Carbon::now()->subDays(rand(1, 30)),

            ];
        }, range(1, 10));

        DB::table('invoices')->insert($invoices);
        return DB::table('invoices')->pluck('id')->toArray();
    }

    /**
     * Seed Orders and Order_Products
     */
    private function seedOrders(array $userIds, array $addressIds, array $invoiceIds, array $productIds, $faker)
    {
        foreach (range(1, 20) as $index) {
            $orderId = Str::random(12);
            $selectedProducts = $faker->randomElements($productIds, rand(1, 5));
            $totalPrice = 0;

            DB::table('orders')->insert([
                'id' => $orderId,
                'user_id' => $faker->randomElement($userIds),
                'address_id' => $faker->randomElement($addressIds),
                'status' => $faker->numberBetween(1, 5),
                'price' => 0, // Updated after adding products
                'invoice_id' => $faker->randomElement($invoiceIds),
                'delivered_at' => $faker->optional()->date(),
                'created_at' => now(),
                'updated_at' => now(),

            ]);

            $orderProducts = [];
            foreach ($selectedProducts as $productId) {
                $quantity = rand(1, 3);
                $productPrice = DB::table('products')->where('id', $productId)->value('price');

                $orderProducts[] = [
                    'order_id' => $orderId,
                    'product_id' => $productId,
                    'quantity' => $quantity,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                $totalPrice += $productPrice * $quantity;
            }

            DB::table('orders_products')->insert($orderProducts);
            DB::table('orders')->where('id', $orderId)->update(['price' => $totalPrice]);
        }
    }
}
