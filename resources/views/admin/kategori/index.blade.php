@extends('layout')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h4 class="fw-bold mb-1">Data Kategori</h4>
                <div class="text-muted">Kelola kategori aspirasi yang digunakan siswa.</div>
            </div>

            <div class="d-flex flex-wrap gap-2 align-items-center">
                <form class="d-flex gap-2" method="GET" action="/admin/kategori">
                    <input name="q" value="{{ $q ?? '' }}" class="form-control" placeholder="Cari nama kategori">
                    <button class="btn btn-outline-primary">Cari</button>
                </form>

                <a href="/admin/kategori/create" class="btn btn-primary rounded-pill px-4">
                    + Tambah Kategori
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger rounded-4 shadow-sm">{{ session('error') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" width="70">#</th>
                                <th>Nama Kategori</th>
                                <th class="text-end pe-4" width="220">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($kategoris as $i => $k)
                                <tr>
                                    <td class="ps-4">{{ $kategoris->firstItem() + $i }}</td>
                                    <td class="fw-semibold">{{ $k->nama_kategori }}</td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2">
                                            <a href="/admin/kategori/{{ $k->id }}"
                                                class="btn btn-info btn-sm rounded-pill px-3 text-white">
                                                Detail
                                            </a>

                                            <a href="/admin/kategori/{{ $k->id }}/edit"
                                                class="btn btn-warning btn-sm rounded-pill px-3">
                                                Edit
                                            </a>

                                            <form method="POST" action="/admin/kategori/{{ $k->id }}"
                                                class="d-inline" onsubmit="return confirm('Yakin hapus kategori ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm rounded-pill px-3">
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" class="text-center text-muted py-4">
                                        Belum ada kategori.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($kategoris->hasPages())
            <div class="mt-3 d-flex justify-content-end">
                {{ $kategoris->links() }}
            </div>
        @endif

    </div>
@endsection