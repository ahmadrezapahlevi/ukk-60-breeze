@extends('layout')

@section('content')
@php
    $isEdit = $mode === 'edit';
@endphp

<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">{{ $isEdit ? 'Edit Siswa' : 'Tambah Siswa' }}</h4>
            <div class="text-muted">Isi data siswa dengan benar.</div>
        </div>

        <a href="/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
            ← Kembali
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger rounded-4 shadow-sm">
            <div class="fw-bold mb-1">Validasi gagal:</div>
            <ul class="mb-0 ps-3">
                @foreach ($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7 col-xl-6">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <form method="POST" action="{{ $isEdit ? '/admin/users/'.$user->id : '/admin/users' }}">
                        @csrf
                        @if($isEdit)
                            @method('PUT')
                        @endif

                        <div class="mb-3">
                            <label class="form-label small text-muted">Nama Siswa</label>
                            <input name="name"
                                   class="form-control form-control-lg"
                                   value="{{ old('name', $user->name) }}"
                                   placeholder="Nama lengkap siswa"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">NISN</label>
                            <input name="username"
                                   class="form-control form-control-lg"
                                   value="{{ old('username', $user->username) }}"
                                   placeholder="Masukkan NISN"
                                   required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label small text-muted">Kelas</label>
                            <input name="kelas"
                                   class="form-control form-control-lg"
                                   value="{{ old('kelas', $user->kelas) }}"
                                   placeholder="Contoh: XII RPL 2"
                                   required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label small text-muted">
                                Password {{ $isEdit ? '(kosongkan jika tidak diubah)' : '' }}
                            </label>
                            <input type="password"
                                   name="password"
                                   class="form-control form-control-lg"
                                   placeholder="{{ $isEdit ? 'Biarkan kosong jika tidak mengganti' : 'Minimal 6 karakter' }}"
                                   {{ $isEdit ? '' : 'required' }}>
                        </div>

                        <div class="d-flex justify-content-between flex-wrap gap-2">
                            <a href="/admin/users" class="btn btn-light border rounded-pill px-4">
                                Batal
                            </a>
                            <button class="btn btn-primary btn-lg rounded-pill px-5">
                                {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Siswa' }}
                            </button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

</div>
@endsection