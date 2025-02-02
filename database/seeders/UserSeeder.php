<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\user\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'firstname' => 'Admin',
            'lastname' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('Passw0rd!'),
            'birthdate' => '2002-08-13',
            'nationality' => 2,
            'language' => 2,
        ]);


        DB::table('users')->insert([
            'firstname' => 'Client',
            'lastname' => 'Client',
            'email' => 'client@client.com',
            'password' => bcrypt('Passw0rd!'),
            'birthdate' => '2002-08-13',
            'nationality' => 'Portugal',
            'language' => 2,
            'standard_group' => 2,
            'children' => 0,
            'fav_estate' => 1
        ]);

        User::all()->first()->addresses()->attach(Address::all()->first()->id);
        User::find(2)->addresses()->attach(Address::first()->id, [
            'addressPhone' => '936039048',
            'addressIdentifier' => 'Home',
            'order' => 1
        ]);
        User::factory(5)->create();

        foreach (User::all() as $user) {
            if ($user->id == 1) {
                $user->assignRole('admin');
            }
            else{
                $user->assignRole('client');
            }
        }

    }
}
