<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;
use App\Models\User;
use App\Models\Kategori;

class AdminDashboardController extends Controller
{
    public function index()
    {
        return view('admin.dashboard.index', [
            'totalAspirasi' => Aspirasi::count(),
            'menunggu'      => Aspirasi::where('status', 'menunggu')->count(),
            'proses'        => Aspirasi::where('status', 'proses')->count(),
            'selesai'       => Aspirasi::where('status', 'selesai')->count(),
            'ditolak'       => Aspirasi::where('status', 'ditolak')->count(),
            'totalSiswa'    => User::where('role', 'siswa')->count(),
            'totalKategori' => Kategori::count(),
        ]);
    }
}
