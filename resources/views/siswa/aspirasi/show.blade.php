@extends('layout')

@section('content')
<div class="container py-4">

    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Detail Aspirasi</h4>
            <div class="text-muted">Lihat detail laporan dan feedback admin.</div>
        </div>

        <div class="d-flex flex-wrap gap-2">
            <a href="/aspirasi" class="btn btn-outline-secondary rounded-pill px-4">
                ← Kembali
            </a>

            @if($aspirasi->status === 'menunggu')
                <a href="/aspirasi/{{ $aspirasi->id }}/edit" class="btn btn-warning rounded-pill px-4">
                    Edit
                </a>

                <form method="POST"
                      action="/aspirasi/{{ $aspirasi->id }}"
                      class="d-inline"
                      onsubmit="return confirm('Yakin ingin menghapus aspirasi ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger rounded-pill px-4">
                        Hapus
                    </button>
                </form>
            @endif
        </div>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger rounded-4 shadow-sm">{{ session('error') }}</div>
    @endif

    @php
        $badge =
            $aspirasi->status == 'menunggu'
                ? 'secondary'
                : ($aspirasi->status == 'proses'
                    ? 'warning'
                    : ($aspirasi->status == 'ditolak'
                        ? 'danger'
                        : 'success'));
    @endphp

    @if($aspirasi->status === 'menunggu')
        <div class="alert alert-warning rounded-4 shadow-sm border-0">
            Aspirasi ini masih <strong>menunggu</strong>, jadi masih bisa kamu edit atau hapus.
        </div>
    @endif

    <div class="row g-4">
        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white fw-bold border-0 pt-4 px-4">
                    Detail Aspirasi
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <div class="small text-muted mb-1">Tanggal</div>
                        <div class="fw-semibold">{{ $aspirasi->created_at->format('d-m-Y') }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="small text-muted mb-1">Kategori</div>
                        <div class="fw-semibold">{{ $aspirasi->kategori->nama_kategori }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="small text-muted mb-1">Lokasi</div>
                        <div class="fw-semibold">{{ $aspirasi->lokasi }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="small text-muted mb-1">Status</div>
                        <span class="badge text-bg-{{ $badge }} rounded-pill px-3 py-2">
                            {{ ucfirst($aspirasi->status) }}
                        </span>
                    </div>

                    <div class="mb-0">
                        <div class="small text-muted mb-1">Keterangan</div>
                        <div class="lh-lg">
                            {{ $aspirasi->keterangan }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-12 col-lg-6">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-header bg-white fw-bold border-0 pt-4 px-4">
                    Feedback
                </div>
                <div class="card-body px-4 pb-4">
                    @forelse($aspirasi->feedbacks as $f)
                        <div class="border-start border-3 ps-3 mb-3">
                            <div class="mb-1">{{ $f->feedback }}</div>
                            <small class="text-muted">
                                {{ \Carbon\Carbon::parse($f->created_at)->format('d-m-Y H:i') }}
                            </small>
                        </div>
                    @empty
                        <div class="text-muted">
                            Belum ada feedback.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>

</div>
@endsection