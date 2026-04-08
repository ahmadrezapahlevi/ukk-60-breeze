<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;

class SiswaAspirasiController extends Controller
{
    public function index(Request $r)
    {
        $q = $r->get('q');

        $aspirasis = Aspirasi::with(['kategori'])
            ->where('siswa_id', auth()->id())
            ->when($q, function ($query) use ($q) {
                $query->where(function ($sub) use ($q) {
                    $sub->where('lokasi', 'like', "%{$q}%")
                        ->orWhere('status', 'like', "%{$q}%")
                        ->orWhereHas('kategori', function ($kategoriQuery) use ($q) {
                            $kategoriQuery->where('nama_kategori', 'like', "%{$q}%");
                        });
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        return view('siswa.aspirasi.index', compact('aspirasis', 'q'));
    }

    public function create()
    {
        return view('siswa.aspirasi.create', [
            'kategoris' => Kategori::orderBy('nama_kategori')->get()
        ]);
    }

    public function store(Request $r)
    {
        $r->validate([
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required'
        ]);

        Aspirasi::create([
            'siswa_id' => auth()->id(),
            'kategori_id' => $r->kategori_id,
            'lokasi' => $r->lokasi,
            'keterangan' => $r->keterangan
        ]);

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil dikirim');
    }

    public function show(Aspirasi $aspirasi)
    {
        if ($aspirasi->siswa_id !== auth()->id()) {
            abort(403);
        }

        $aspirasi->load(['kategori', 'feedbacks.admin']);
        return view('siswa.aspirasi.show', compact('aspirasi'));
    }

    public function edit(Aspirasi $aspirasi)
    {
        if ($aspirasi->siswa_id !== auth()->id()) {
            abort(403);
        }

        if ($aspirasi->status !== 'menunggu') {
            return redirect('/aspirasi')->with('error', 'Aspirasi hanya bisa diedit saat status masih menunggu');
        }

        return view('siswa.aspirasi.edit', [
            'aspirasi' => $aspirasi,
            'kategoris' => Kategori::orderBy('nama_kategori')->get()
        ]);
    }

    public function update(Request $r, Aspirasi $aspirasi)
    {
        if ($aspirasi->siswa_id !== auth()->id()) {
            abort(403);
        }

        if ($aspirasi->status !== 'menunggu') {
            return redirect('/aspirasi')->with('error', 'Aspirasi hanya bisa diedit saat status masih menunggu');
        }

        $r->validate([
            'kategori_id' => 'required',
            'lokasi' => 'required',
            'keterangan' => 'required'
        ]);

        $aspirasi->update([
            'kategori_id' => $r->kategori_id,
            'lokasi' => $r->lokasi,
            'keterangan' => $r->keterangan
        ]);

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil diperbarui');
    }

    public function destroy(Aspirasi $aspirasi)
    {
        if ($aspirasi->siswa_id !== auth()->id()) {
            abort(403);
        }

        if ($aspirasi->status !== 'menunggu') {
            return redirect('/aspirasi')->with('error', 'Aspirasi hanya bisa dihapus saat status masih menunggu');
        }

        $aspirasi->delete();

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil dihapus');
    }
}
