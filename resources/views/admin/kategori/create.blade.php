@extends('layout')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Tambah Kategori</h4>
            <div class="text-muted">Buat kategori baru untuk aspirasi.</div>
        </div>
        <a href="/admin/kategori" class="btn btn-outline-secondary rounded-pill px-4">
            ← Kembali
        </a>
    </div>

    <div class="row justify-content-center">
        <div class="col-12 col-md-8 col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <form method="POST" action="/admin/kategori">
                        @csrf

                        <div class="mb-4">
                            <label class="form-label small text-muted">Nama Kategori</label>
                            <input name="nama_kategori"
                                   class="form-control form-control-lg"
                                   placeholder="masukan nama kategori"
                                   required>
                        </div>

                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <a href="/admin/kategori" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                            <button class="btn btn-primary btn-lg rounded-pill px-5">
                                Simpan
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
