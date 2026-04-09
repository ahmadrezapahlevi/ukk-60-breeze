@extends('layout')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Form Input Aspirasi</h4>
            <div class="text-muted">Isi laporan dengan jelas agar cepat diproses.</div>
        </div>
        <a href="/aspirasi" class="btn btn-outline-secondary rounded-pill px-4">
            ← Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm">
            <div class="fw-bold mb-2">Terjadi kesalahan:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-lg-9 col-xl-7">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="alert alert-light border rounded-4 mb-4">
                        Siswa: <strong>{{ auth()->user()->name }}</strong>
                    </div>

                    <form method="POST" action="/aspirasi" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label class="form-label small text-muted">Kategori</label>
                            <select name="kategori_id" class="form-select form-select-lg" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach ($kategoris as $k)
                                    <option value="{{ $k->id }}" {{ old('kategori_id') == $k->id ? 'selected' : '' }}>
                                        {{ $k->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Lokasi</label>
                            <input name="lokasi"
                                   class="form-control form-control-lg"
                                   value="{{ old('lokasi') }}"
                                   placeholder="Contoh: Ruang Kelas XII RPL 2"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Foto</label>
                            <input type="file"
                                   name="foto"
                                   class="form-control"
                                   accept=".jpg,.jpeg,.png,image/jpeg,image/png">
                            <div class="form-text">Opsional. Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted">Keterangan</label>
                            <textarea name="keterangan"
                                      class="form-control"
                                      rows="5"
                                      placeholder="Jelaskan masalah yang ditemukan..."
                                      required>{{ old('keterangan') }}</textarea>
                        </div>

                        <div class="d-flex justify-content-between align-items-center flex-wrap gap-2">
                            <a href="/aspirasi" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                            <button class="btn btn-primary btn-lg rounded-pill px-5">
                                Kirim Aspirasi
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>

</div>
@endsection
