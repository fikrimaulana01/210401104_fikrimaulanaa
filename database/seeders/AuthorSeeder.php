<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AuthorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('authors')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'tanggal_lahir' => '2003-02-10',
            'password' => Hash::make('12345678'),
            // ...
        ]);
        DB::table('authors')->insert([
            'name' => 'Fikri maulana',
            'email' => 'fikri@gmail.com',
            'tanggal_lahir' => '2003-02-10',
            'password' => Hash::make('12345678'),
            // ...
        ]);
    }
}