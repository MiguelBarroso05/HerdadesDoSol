<?php

namespace Database\Seeders;

use App\Models\Estate;
use App\Models\user\Address;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EstatesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('estates')->insert([
            'name' => 'Herdade Verão',
            'address_id' => 1,
        ]);
        DB::table('estates')->insert([
            'name' => 'Herdade Inverno',
            'address_id' => 2,

        ]);
        DB::table('estates')->insert([
            'name' => 'Herdade Primavera',
            'address_id' => 3,
        ]);
        DB::table('estates')->insert([
            'name' => 'Herdade Outono',
            'address_id' => 4,
        ]);
    }
}
