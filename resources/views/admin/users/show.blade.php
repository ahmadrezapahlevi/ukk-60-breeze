@extends('layout')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Detail Siswa</h4>
            <div class="text-muted">Informasi lengkap data siswa.</div>
        </div>

        <div class="d-flex gap-2 flex-wrap">
            <a href="/admin/users" class="btn btn-outline-secondary rounded-pill px-4">
                ← Kembali
            </a>
            <a href="/admin/users/{{ $user->id }}/edit" class="btn btn-warning rounded-pill px-4">
                Edit
            </a>
        </div>
    </div>

    @if(session('error'))
        <div class="alert alert-danger rounded-4 shadow-sm">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="row justify-content-center">
        <div class="col-12 col-md-10 col-lg-7">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="mb-4">
                        <div class="small text-muted mb-1">ID User</div>
                        <div class="fw-semibold fs-5">{{ $user->id }}</div>
                    </div>

                    <div class="mb-4">
                        <div class="small text-muted mb-1">Nama Siswa</div>
                        <div class="fw-semibold fs-5">{{ $user->name }}</div>
                    </div>

                    <div class="mb-4">
                        <div class="small text-muted mb-1">NISN</div>
                        <div class="fw-semibold fs-5">{{ $user->username }}</div>
                    </div>

                    <div class="mb-4">
                        <div class="small text-muted mb-1">Kelas</div>
                        <div class="fw-semibold fs-5">{{ $user->kelas ?? '-' }}</div>
                    </div>

                    <div class="mb-4">
                        <div class="small text-muted mb-1">Role</div>
                        <span class="badge bg-primary fs-6 px-3 py-2 rounded-pill">
                            {{ ucfirst($user->role) }}
                        </span>
                    </div>

                    <div class="mb-0">
                        <div class="small text-muted mb-1">Dibuat / Diperbarui</div>
                        <div class="fw-semibold">
                            {{ optional($user->created_at)->format('d M Y H:i') ?? '-' }}
                        </div>
                        <div class="text-muted small mt-1">
                            Update terakhir:
                            {{ optional($user->updated_at)->format('d M Y H:i') ?? '-' }}
                        </div>
                    </div>

                    <hr class="my-4">

                    <div class="d-flex justify-content-between flex-wrap gap-2">
                        <a href="/admin/users" class="btn btn-light border rounded-pill px-4">
                            Kembali ke daftar
                        </a>

                        <form method="POST" action="/admin/users/{{ $user->id }}"
                              onsubmit="return confirm('Hapus siswa ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger rounded-pill px-4"
                                {{ $user->id == auth()->id() ? 'disabled' : '' }}>
                                Hapus Siswa
                            </button>
                        </form>
                    </div>

                    @if($user->id == auth()->id())
                        <div class="small text-muted mt-3">
                            * Akun ini sedang login, tombol hapus dinonaktifkan.
                        </div>
                    @endif

                </div>
            </div>
        </div>
    </div>

</div>
@endsection