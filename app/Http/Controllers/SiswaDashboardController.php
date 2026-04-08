<?php

namespace App\Http\Controllers;

use App\Models\Aspirasi;

class SiswaDashboardController extends Controller
{
    public function index()
    {
        $userId = auth()->id();

        $base = Aspirasi::query()->where('siswa_id', $userId);

        return view('siswa.dashboard.index', [
            'total'    => (clone $base)->count(),
            'menunggu' => (clone $base)->where('status', 'menunggu')->count(),
            'proses'   => (clone $base)->where('status', 'proses')->count(),
            'selesai'  => (clone $base)->where('status', 'selesai')->count(),
            'ditolak'  => (clone $base)->where('status', 'ditolak')->count(),
        ]);
    }
}
