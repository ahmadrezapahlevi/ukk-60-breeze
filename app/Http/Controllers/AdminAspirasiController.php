<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Feedback;

class AdminAspirasiController extends Controller
{
    public function index(Request $r)
    {
        $q = $r->get('q');

        $aspirasis = Aspirasi::with(['siswa', 'kategori'])
            ->when($q, function ($query) use ($q) {
                $query->whereHas('siswa', function ($siswaQuery) use ($q) {
                    $siswaQuery->where('name', 'like', "%{$q}%")
                        ->orWhere('username', 'like', "%{$q}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('admin.aspirasi.index', compact('aspirasis', 'q'));
    }

    public function show(Aspirasi $aspirasi)
    {
        $aspirasi->load(['siswa', 'kategori', 'feedbacks.admin']);
        return view('admin.aspirasi.show', compact('aspirasi'));
    }

    public function update(Request $r, Aspirasi $aspirasi)
    {
        $r->validate([
            'status' => 'required|in:menunggu,proses,selesai,ditolak'
        ]);

        $aspirasi->update([
            'status' => $r->status
        ]);

        return back()->with('success', 'Status diperbarui');
    }

    public function feedback(Request $r, Aspirasi $aspirasi)
    {
        $r->validate([
            'feedback' => 'required|min:3'
        ]);

        Feedback::create([
            'aspirasi_id' => $aspirasi->id,
            'admin_id' => auth()->id(),
            'feedback' => $r->feedback
        ]);

        return back()->with('success', 'Feedback terkirim');
    }
}
