@extends('layout')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h4 class="fw-bold mb-1">Manajemen Siswa</h4>
                <div class="text-muted">Kelola data user siswa.</div>
            </div>

            <div class="d-flex flex-wrap gap-2 align-items-center">
                <form class="d-flex gap-2" method="GET" action="/admin/users">
                    <input name="q" value="{{ $q ?? '' }}" class="form-control"
                        placeholder="Cari nama / NISN / kelas">
                    <button type="submit" class="btn btn-outline-primary">
                        Cari
                    </button>
                </form>

                <a href="/admin/users/create" class="btn btn-primary rounded-pill px-4">
                    + Tambah Siswa
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
                                <th>Nama</th>
                                <th width="180">NISN</th>
                                <th width="160">Kelas</th>
                                <th class="text-end pe-4" width="220">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $i => $u)
                                <tr>
                                    <td class="ps-4">{{ $users->firstItem() + $i }}</td>
                                    <td class="fw-semibold">{{ $u->name }}</td>
                                    <td>{{ $u->username }}</td>
                                    <td>{{ $u->kelas ?? '-' }}</td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2 align-items-center">
                                            <a href="/admin/users/{{ $u->id }}"
                                                class="btn btn-info btn-sm rounded-pill px-3 text-white">
                                                Detail
                                            </a>

                                            <a href="/admin/users/{{ $u->id }}/edit"
                                                class="btn btn-warning btn-sm rounded-pill px-3">
                                                Edit
                                            </a>

                                            <form method="POST" action="/admin/users/{{ $u->id }}" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm rounded-pill px-3"
                                                    onclick="return confirm('Hapus siswa ini?')"
                                                    {{ $u->id == auth()->id() ? 'disabled' : '' }}>
                                                    Hapus
                                                </button>
                                            </form>
                                        </div>

                                        @if ($u->id == auth()->id())
                                            <div class="small text-muted mt-2">
                                                * Akun ini sedang login, tombol hapus dinonaktifkan.
                                            </div>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="text-center text-muted py-4">
                                        Belum ada data siswa.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($users->hasPages())
            <div class="mt-3 d-flex justify-content-end">
                {{ $users->links() }}
            </div>
        @endif

    </div>
@endsection