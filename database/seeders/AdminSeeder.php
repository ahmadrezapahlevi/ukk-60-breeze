<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminSeeder extends Seeder
{
    public function run(): void
    {

        User::updateOrCreate(
            ['username' => '1234567891'],
            [
                'name' => 'akuh ini guru',
                'role' => 'admin',
                'kelas' => null,
                'password' => Hash::make('password'),
            ]
        );
    }
}
