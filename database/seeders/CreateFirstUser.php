<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class CreateFirstUser extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'], // cek dulu berdasarkan email
            [
                'first_name' => 'Admin',
                'password' => Hash::make('admin1234567890'),
                'role' => 'Super Admin'
            ]
        );
    }
}
