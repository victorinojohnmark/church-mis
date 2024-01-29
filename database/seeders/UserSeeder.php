<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;
use Carbon\Carbon;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::insert([
            [
                'name' => 'Admin',
                'birth_date' => '2023-05-23',
                'address' => 'Cavite',
                'contact_number' => '091234567890',
                'email' => 'saintgregoryparish.indang@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => true,
                'role' => 'Admin',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],
            [
                'name' => 'Catechist',
                'birth_date' => '2023-05-23',
                'address' => 'Cavite',
                'contact_number' => '091234567890',
                'email' => 'saintgregoryparish.indang.cathechist@gmail.com',
                'password' => Hash::make('password'),
                'is_admin' => false,
                'role' => 'Catechist',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
