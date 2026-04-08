<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Kategori;

class KategoriSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Fasilitas', 'Kebersihan', 'Keamanan'] as $k) {
            Kategori::create(['nama_kategori' => $k]);
        }
    }
}
