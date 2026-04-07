@extends('layout')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Aspirasi Saya</h4>
            <div class="text-muted">Lihat daftar aspirasi yang sudah kamu kirim.</div>
        </div>

        <div class="d-flex flex-wrap gap-2 align-items-center">
            <form class="d-flex gap-2" method="GET" action="/aspirasi">
                <input
                    type="text"
                    name="q"
                    value="{{ $q ?? '' }}"
                    class="form-control"
                    placeholder="Cari kategori / lokasi / status">
                <button type="submit" class="btn btn-outline-primary">
                    Cari
                </button>
            </form>

            <a href="/aspirasi/create" class="btn btn-primary rounded-pill px-4">
                + Tambah Aspirasi
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-4 shadow-sm">{{ session('error') }}</div>
    @endif

    <div class="d-flex justify-content-end mb-3">
        <span class="badge text-bg-primary rounded-pill px-3 py-2">
            Total: {{ $aspirasis->total() }}
        </span>
    </div>

    @if($aspirasis->count())
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover align-middle mb-0">
                        <thead class="table-light">
                            <tr>
                                <th class="ps-4" width="70">#</th>
                                <th width="140">Tanggal</th>
                                <th>Kategori</th>
                                <th>Lokasi</th>
                                <th width="140">Status</th>
                                <th class="text-end pe-4" width="260">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($aspirasis as $i => $a)
                                @php
                                    $badge =
                                        $a->status == 'menunggu'
                                            ? 'secondary'
                                            : ($a->status == 'proses'
                                                ? 'warning'
                                                : ($a->status == 'ditolak'
                                                    ? 'danger'
                                                    : 'success'));
                                @endphp
                                <tr>
                                    <td class="ps-4">{{ $aspirasis->firstItem() + $i }}</td>
                                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                                    <td>{{ $a->kategori->nama_kategori }}</td>
                                    <td>{{ $a->lokasi }}</td>
                                    <td>
                                        <span class="badge text-bg-{{ $badge }} rounded-pill px-3 py-2">
                                            {{ ucfirst($a->status) }}
                                        </span>
                                    </td>
                                    <td class="text-end pe-4">
                                        <div class="d-inline-flex gap-2 flex-wrap justify-content-end">
                                            <a href="/aspirasi/{{ $a->id }}"
                                               class="btn btn-info btn-sm rounded-pill px-3 text-white">
                                                Detail
                                            </a>

                                            @if($a->status === 'menunggu')
                                                <a href="/aspirasi/{{ $a->id }}/edit"
                                                   class="btn btn-warning btn-sm rounded-pill px-3">
                                                    Edit
                                                </a>

                                                <form method="POST"
                                                      action="/aspirasi/{{ $a->id }}"
                                                      class="d-inline"
                                                      onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                            class="btn btn-danger btn-sm rounded-pill px-3">
                                                        Hapus
                                                    </button>
                                                </form>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
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
    @else
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 d-flex flex-wrap align-items-center justify-content-between gap-2">
                <div>
                    <div class="fw-bold">Belum ada aspirasi</div>
                    <div class="text-muted">
                        @if(!empty($q))
                            Tidak ada hasil yang cocok dengan pencarian "{{ $q }}".
                        @else
                            Klik “Tambah Aspirasi” untuk buat laporan pertama.
                        @endif
                    </div>
                </div>
                <a href="/aspirasi/create" class="btn btn-primary rounded-pill px-4">
                    + Tambah Aspirasi
                </a>
            </div>
        </div>
    @endif

</div>
@endsection