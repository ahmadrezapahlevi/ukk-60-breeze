@extends('layout')

@section('content')
    <div class="container py-4">

        <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
            <div>
                <h4 class="fw-bold mb-1">Data Aspirasi</h4>
                <div class="text-muted">Kelola semua laporan aspirasi dari siswa.</div>
            </div>

            <div class="d-flex flex-wrap gap-2 align-items-center">
                <form class="d-flex gap-2" method="GET" action="/admin/aspirasi">
                    <input name="q" value="{{ $q ?? '' }}" class="form-control"
                        placeholder="Cari nama siswa / NISN">
                    <button class="btn btn-outline-primary">Cari</button>
                </form>

                <span class="badge text-bg-primary rounded-pill px-3 py-2">
                    Total: {{ $aspirasis->total() }}
                </span>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" width="70">#</th>
                                <th>Nama Siswa</th>
                                <th width="140">Kelas</th>
                                <th width="180">NISN</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th width="140">Status</th>
                                <th class="text-end pe-4" width="140">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($aspirasis as $i => $a)
                                @php
                                    $badge =
                                        $a->status == 'menunggu'
                                            ? 'warning'
                                            : ($a->status == 'proses'
                                                ? 'primary'
                                                : ($a->status == 'ditolak'
                                                    ? 'danger'
                                                    : 'success'));
                                @endphp
                                <tr>
                                    <td class="ps-4">{{ $aspirasis->firstItem() + $i }}</td>
                                    <td class="fw-semibold">{{ $a->siswa->name }}</td>
                                    <td>{{ $a->siswa->kelas }}</td>
                                    <td>{{ $a->siswa->username }}</td>
                                    <td>{{ $a->kategori->nama_kategori }}</td>
                                    <td>{{ $a->lokasi }}</td>
                                    <td>
                                        <span class="badge text-bg-{{ $badge }} rounded-pill px-3 py-2">
                                            {{ ucfirst($a->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <a href="/admin/aspirasi/{{ $a->id }}"
                                            class="btn btn-info btn-sm rounded-pill px-3 text-white">
                                            Detail
                                        </a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="8" class="text-center text-muted py-4">
                                        Belum ada data aspirasi.
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        @if ($aspirasis->hasPages())
            <div class="mt-3 d-flex justify-content-end">
                {{ $aspirasis->links() }}
            </div>
        @endif

    </div>
@endsection
