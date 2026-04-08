<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;

class AdminKategoriController extends Controller
{
    public function index(Request $request)
    {
        $q = $request->get('q');

        $kategoris = Kategori::query()
            ->when($q, function ($query) use ($q) {
                $query->where('nama_kategori', 'like', "%{$q}%");
            })
            ->orderBy('nama_kategori')
            ->paginate(10)
            ->withQueryString();

        return view('admin.kategori.index', compact('kategoris', 'q'));
    }

    public function create()
    {
        return view('admin.kategori.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kategori' => 'required|max:30'
        ]);

        Kategori::create([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/admin/kategori')
            ->with('success', 'Kategori berhasil ditambahkan');
    }

    public function show(Kategori $kategori)
    {
        $jumlahAspirasi = $kategori->aspirasis()->count();

        return view('admin.kategori.show', compact('kategori', 'jumlahAspirasi'));
    }

    public function edit(Kategori $kategori)
    {
        return view('admin.kategori.edit', compact('kategori'));
    }

    public function update(Request $request, Kategori $kategori)
    {
        $request->validate([
            'nama_kategori' => 'required|max:30'
        ]);

        $kategori->update([
            'nama_kategori' => $request->nama_kategori
        ]);

        return redirect('/admin/kategori')
            ->with('success', 'Kategori berhasil diperbarui');
    }

    public function destroy(Kategori $kategori)
    {
        if ($kategori->aspirasis()->count() > 0) {
            return back()->with('error', 'Kategori tidak dapat dihapus karena sudah digunakan');
        }

        $kategori->delete();

        return back()->with('success', 'Kategori berhasil dihapus');
    }
}
