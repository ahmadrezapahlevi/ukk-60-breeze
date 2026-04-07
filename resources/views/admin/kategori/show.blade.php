@extends('layout')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Detail Kategori</h4>
            <div class="text-muted">Informasi lengkap kategori aspirasi.</div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/admin/kategori" class="btn btn-outline-secondary rounded-pill px-4">
                ← Kembali
            </a>
            <a href="/admin/kategori/{{ $kategori->id }}/edit" class="btn btn-warning rounded-pill px-4">
                Edit
            </a>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="mb-4">
                        <div class="small text-muted mb-1">ID Kategori</div>
                        <div class="fw-semibold fs-5">{{ $kategori->id }}</div>
                    </div>

                    <div class="mb-4">
                        <div class="small text-muted mb-1">Nama Kategori</div>
                        <div class="fw-semibold fs-5">{{ $kategori->nama_kategori }}</div>
                    </div>

                    <div class="mb-4">
                        <div class="small text-muted mb-1">Jumlah Aspirasi Terkait</div>
                        <div>
                            <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
                                {{ $jumlahAspirasi }} Aspirasi
                            </span>
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="small text-muted mb-1">Dibuat / Diperbarui</div>
                        <div class="fw-semibold">
                            {{ optional($kategori->created_at)->format('d M Y H:i') ?? '-' }}
                        </div>
                        <div class="text-muted small mt-1">
                            Update terakhir:
                            {{ optional($kategori->updated_at)->format('d M Y H:i') ?? '-' }}
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <a href="/admin/kategori" class="btn btn-light border rounded-pill px-4">
                            Kembali ke daftar
                        </a>

                        <form method="POST" action="/admin/kategori/{{ $kategori->id }}"
                              onsubmit="return confirm('Yakin hapus kategori ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger rounded-pill px-4"
                                {{ $jumlahAspirasi > 0 ? 'disabled' : '' }}>
                                Hapus Kategori
                            </button>
                        </form>
                    </div>

                    @if($jumlahAspirasi > 0)
                        <div class="small text-danger mt-3">
                            * Kategori tidak bisa dihapus karena sudah digunakan oleh aspirasi.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection