<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i=0; $i<=9; $i++) {
            DB::table('users')->insert([
                'name' => strtolower('ced' . str_random(4)),
                'email' => strtolower('lumen' . str_random(5) . '@gmail.com'),
                'password' => Hash::make('secret'),
                'gender' => array_random(['male', 'female']),
                'phone' => '0915' . random_int(1234567, 9999999),
                'type' => array_random(['admin', 'standard']),
                'status' => 1,
                'created_at' => date('Y-m-d H:i:s'),
            ]);
        }
    }
}
