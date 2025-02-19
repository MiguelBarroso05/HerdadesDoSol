<?php

namespace Database\Seeders;

use App\Models\Order;
use App\Models\PaymentMethodType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            RolesSeeder::class,
            AddressSeeder::class,
            EstatesSeeder::class,
            LanguageSeeder::class,
            UserSeeder::class,
            SaleSeeder::class,
            ActivityTypeSeeder::class,
            ActivitySeeder::class,
            AccommodationTypeSeeder::class,
            AccommodationSeeder::class,
            CategorySeeder::class,
            ProductSeeder::class,
            AllergySeeder::class,
            PaymentMethodTypeSeeder::class,
            OrderSeeder::class,
        ]);


    }
}
