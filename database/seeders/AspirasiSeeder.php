<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Aspirasi;
use App\Models\User;
use App\Models\Kategori;

class AspirasiSeeder extends Seeder
{
    public function run(): void
    {
        $siswas = User::where('role', 'siswa')->get();
        $kategoris = Kategori::all();

        if ($siswas->count() === 0) {
            $this->command?->warn('Data siswa belum tersedia.');
            return;
        }

        if ($kategoris->count() === 0) {
            $this->command?->warn('Data kategori belum tersedia.');
            return;
        }

        $dataAspirasi = [
            [
                'username' => '100001',
                'kategori_nama' => 'Fasilitas',
                'lokasi' => 'Ruang Kelas XII RPL 1',
                'keterangan' => 'AC di kelas kurang dingin dan perlu diperbaiki.',
                'status' => 'menunggu',
            ],
            [
                'username' => '100002',
                'kategori_nama' => 'Kebersihan',
                'lokasi' => 'Toilet Lantai 2',
                'keterangan' => 'Toilet putri lantai 2 perlu dibersihkan lebih rutin.',
                'status' => 'proses',
            ],
            [
                'username' => '100003',
                'kategori_nama' => 'Keamanan',
                'lokasi' => 'Area Parkir Siswa',
                'keterangan' => 'Parkiran motor perlu penjagaan tambahan saat jam pulang.',
                'status' => 'selesai',
            ],
            [
                'username' => '100001',
                'kategori_nama' => 'Fasilitas',
                'lokasi' => 'Laboratorium Komputer',
                'keterangan' => 'Beberapa komputer di lab tidak bisa digunakan saat praktik.',
                'status' => 'ditolak',
            ],
            [
                'username' => '100004',
                'kategori_nama' => 'Kebersihan',
                'lokasi' => 'Kantin Sekolah',
                'keterangan' => 'Tempat sampah di area kantin kurang memadai.',
                'status' => 'menunggu',
            ],
        ];

        foreach ($dataAspirasi as $item) {
            $siswa = $siswas->firstWhere('username', $item['username']);
            $kategori = $kategoris->firstWhere('nama_kategori', $item['kategori_nama']);

            if (!$siswa || !$kategori) {
                continue;
            }

            Aspirasi::updateOrCreate(
                [
                    'siswa_id' => $siswa->id,
                    'kategori_id' => $kategori->id,
                    'lokasi' => $item['lokasi'],
                ],
                [
                    'keterangan' => $item['keterangan'],
                    'status' => $item['status'],
                ]
            );
        }
    }
}
