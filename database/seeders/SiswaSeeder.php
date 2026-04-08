<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class SiswaSeeder extends Seeder
{
    public function run(): void
    {
        $siswas = [
            [
                'name' => 'Ahmad Fauzan',
                'username' => '100001',
                'kelas' => 'XIIRPL1',
                'role' => 'siswa',
                'password' => 'password',
            ],
            [
                'name' => 'Siti Rahma',
                'username' => '100002',
                'kelas' => 'XITKJ2',
                'role' => 'siswa',
                'password' => 'password',
            ],
            [
                'name' => 'Dimas Pratama',
                'username' => '100003',
                'kelas' => 'XMM1',
                'role' => 'siswa',
                'password' => 'password',
            ],
            [
                'name' => 'Nabila Aulia',
                'username' => '100004',
                'kelas' => 'XIRPL2',
                'role' => 'siswa',
                'password' => 'password',
            ],
            [
                'name' => 'Rizky Maulana',
                'username' => '100005',
                'kelas' => 'XIITKJ1',
                'role' => 'siswa',
                'password' => 'password',
            ],
        ];

        foreach ($siswas as $siswa) {
            User::updateOrCreate(
                ['username' => $siswa['username']],
                [
                    'name' => $siswa['name'],
                    'kelas' => $siswa['kelas'],
                    'role' => $siswa['role'],
                    'password' => $siswa['password'],
                ]
            );
        }
    }
}
