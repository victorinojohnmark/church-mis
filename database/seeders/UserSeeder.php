<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'birth_date' => '2023-05-23',
            'address' => 'Cavite',
            'contact_number' => '091234567890',
            'email' => 'admin@admin.com',
            'password' => Hash::make('P@ssw0rd'),
            'is_admin' => true
        ]);
    }
}
