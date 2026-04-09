<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Aspirasi;
use App\Models\Kategori;
use Illuminate\Support\Facades\Storage;

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
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|max:50',
            'keterangan' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $fotoPath = null;

        if ($r->hasFile('foto')) {
            $fotoPath = $r->file('foto')->store('aspirasi', 'public');
        }

        Aspirasi::create([
            'siswa_id' => auth()->id(),
            'kategori_id' => $r->kategori_id,
            'lokasi' => $r->lokasi,
            'keterangan' => $r->keterangan,
            'foto' => $fotoPath,
            'status' => 'menunggu',
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
            'kategori_id' => 'required|exists:kategoris,id',
            'lokasi' => 'required|max:50',
            'keterangan' => 'required|max:255',
            'foto' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ], [
            'foto.image' => 'File foto harus berupa gambar.',
            'foto.mimes' => 'Foto harus berformat jpg, jpeg, atau png.',
            'foto.max' => 'Ukuran foto maksimal 2MB.',
        ]);

        $data = [
            'kategori_id' => $r->kategori_id,
            'lokasi' => $r->lokasi,
            'keterangan' => $r->keterangan,
        ];

        if ($r->hasFile('foto')) {
            if ($aspirasi->foto && Storage::disk('public')->exists($aspirasi->foto)) {
                Storage::disk('public')->delete($aspirasi->foto);
            }

            $data['foto'] = $r->file('foto')->store('aspirasi', 'public');
        }

        $aspirasi->update($data);

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

        if ($aspirasi->foto && Storage::disk('public')->exists($aspirasi->foto)) {
            Storage::disk('public')->delete($aspirasi->foto);
        }

        $aspirasi->delete();

        return redirect('/aspirasi')->with('success', 'Aspirasi berhasil dihapus');
    }
}
