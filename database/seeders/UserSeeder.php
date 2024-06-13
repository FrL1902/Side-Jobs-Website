<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([[
            'email' => 'user1@gmail.com',
            'password' => Hash::make('user1'),
            'role' => 1, #worker
            'first_name' => 'worker',
            'last_name' => 'Worker',
            'phone_number' => '0218541732',
            'city_id' => 1,
            'address' => 'jakarta',
            'account_activated' => 'yes',
            'image_path' => '-',
            'bank_id' => '-',
            'account_number' => '-',
        ], [
            'email' => 'user2@gmail.com',
            'password' => Hash::make('user2'),
            'role' => 2, #employer
            'first_name' => 'employer',
            'last_name' => 'Employer',
            'phone_number' => '0218541732',
            'city_id' => 2,
            'address' => 'bekasi',
            'account_activated' => 'yes',
            'image_path' => '-',
            'bank_id' => '-',
            'account_number' => '-',
        ], [
            'email' => 'user3@gmail.com',
            'password' => Hash::make('user3'),
            'role' => 3, #admin
            'first_name' => 'admin',
            'last_name' => 'Admin',
            'phone_number' => '0218541732',
            'city_id' => 2,
            'address' => 'gamprit',
            'account_activated' => 'yes',
            'image_path' => '-',
            'bank_id' => '-',
            'account_number' => '-',
        ]]);
    }
}
