<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            'country' => 'Portugal',
            'city' => 'Porto',
            'street' => 'Rua dos testes',
            'zipcode' => '1234-567',
        ]);

        DB::table('addresses')->insert([
            'country' => 'Portugal',
            'city' => 'Lisboa',
            'street' => 'Rua dos testes',
            'zipcode' => '1234-567',
        ]);

        DB::table('addresses')->insert([
            'country' => 'Portugal',
            'city' => 'Sintra',
            'street' => 'Rua dos testes',
            'zipcode' => '1234-567',
        ]);

        DB::table('addresses')->insert([
            'country' => 'Portugal',
            'city' => 'Guimaraes',
            'street' => 'Rua dos testes',
            'zipcode' => '1234-567',
        ]);
    }
}
