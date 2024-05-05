<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Illuminate\Support\Facades\Hash;  

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'nama'=> 'vincent',
            'email' => 'vincent@gmail.com',
            'nomorhp'  => '081259129393',
            'password' => Hash::make('halo123'),
            'isAdmin' => true
        ]);
    }
}
