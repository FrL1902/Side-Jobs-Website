<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('admins')->insert([
            'email' => 'user3@gmail.com',
            'password' => Hash::make('user3'),
            'role' => 3, #admin
            'first_name' => 'admin',
            'last_name' => 'Admin',
            'phone_number' => '0218541732',
            'city_id' => 2,
            'address' => 'gamprit',
            'account_activated' => 'yes',
            'image_path' => 'https://cdn.discordapp.com/attachments/1211571942965125160/1244616830744530944/image.png?ex=66566c00&is=66551a80&hm=b5df70e02b873174ec84debad2d0d360c34217178046057ce80232cd0c2721d3&',
        ]);
    }
}
