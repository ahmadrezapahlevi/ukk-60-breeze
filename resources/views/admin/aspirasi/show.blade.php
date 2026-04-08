@extends('layout')

@section('content')
<div class="container py-4">

    {{-- Header --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-3">
        <div>
            <h4 class="fw-bold mb-1">Detail Aspirasi</h4>
            <div class="text-muted">Lihat detail laporan, update status, dan kirim feedback.</div>
        </div>
        <a href="/admin/aspirasi" class="btn btn-outline-secondary rounded-pill px-4">
            ← Kembali
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success rounded-4 shadow-sm">{{ session('success') }}</div>
    @endif

    @php
    $badge = $aspirasi->status=='menunggu' ? 'warning'
           : ($aspirasi->status=='proses' ? 'primary'
           : ($aspirasi->status=='selesai' ? 'success' : 'danger'));
@endphp

    <div class="row g-4">

        {{-- LEFT: Detail + Update Status --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">

                    <div class="d-flex flex-wrap justify-content-between align-items-center gap-2 mb-4">
                        <div>
                            <div class="text-muted small">Status saat ini</div>
                            <span class="badge text-bg-{{ $badge }} rounded-pill px-3 py-2">
                                {{ ucfirst($aspirasi->status) }}
                            </span>
                        </div>
                        <div class="text-muted small">
                            Dibuat: <span class="fw-semibold">{{ $aspirasi->created_at->format('d-m-Y H:i') }}</span>
                        </div>
                    </div>

                    <div class="row g-3">
                        <div class="col-md-6">
                            <div class="text-muted small">Nama Siswa</div>
                            <div class="fw-semibold">{{ $aspirasi->siswa->name }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Kelas</div>
                            <div class="fw-semibold">{{ $aspirasi->siswa->kelas }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Kategori</div>
                            <div class="fw-semibold">{{ $aspirasi->kategori->nama_kategori }}</div>
                        </div>
                        <div class="col-md-6">
                            <div class="text-muted small">Lokasi</div>
                            <div class="fw-semibold">{{ $aspirasi->lokasi }}</div>
                        </div>
                        <div class="col-12">
                            <div class="text-muted small">Keterangan</div>
                            <div class="border rounded-4 p-3 bg-light">
                                {{ $aspirasi->keterangan }}
                            </div>
                        </div>
                    </div>

                    <hr class="my-4">

                    <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/status">
                        @csrf
                        <label class="form-label small text-muted mb-2">Update Status</label>
                        <div class="d-flex flex-wrap gap-2">
                            <select name="status" class="form-select form-select-lg" style="max-width: 260px;">
                                <option value="menunggu" {{ $aspirasi->status=='menunggu'?'selected':'' }}>Menunggu</option>
                                <option value="proses" {{ $aspirasi->status=='proses'?'selected':'' }}>Proses</option>
                                <option value="selesai" {{ $aspirasi->status=='selesai'?'selected':'' }}>Selesai</option>
                                <option value="ditolak" {{ $aspirasi->status=='ditolak'?'selected':'' }}>Ditolak</option>
                            </select>
                            <button class="btn btn-warning btn-lg rounded-pill px-4">
                                Update
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

        {{-- RIGHT: Feedback --}}
        <div class="col-lg-6">

            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-body p-4 p-md-5">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <div class="fw-bold">Feedback</div>
                            <div class="text-muted small">Tanggapan admin untuk siswa.</div>
                        </div>
                        <span class="badge text-bg-light border rounded-pill px-3 py-2">
                            {{ $aspirasi->feedbacks->count() }} pesan
                        </span>
                    </div>

                    {{-- List feedback --}}
                    @if($aspirasi->feedbacks->count())
                        <div class="vstack gap-3 mb-4">
                            @foreach($aspirasi->feedbacks as $f)
                                <div class="border rounded-4 p-3">
                                    <div class="d-flex justify-content-between align-items-start gap-2">
                                        <div class="fw-semibold">
                                            {{ $f->admin?->name ?? 'Admin' }}
                                        </div>
                                        <small class="text-muted">
                                            {{ $f->created_at->format('d-m-Y H:i') }}
                                        </small>
                                    </div>
                                    <div class="mt-2">
                                        {{ $f->feedback }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <div class="alert alert-light border rounded-4 mb-4">
                            Belum ada feedback untuk aspirasi ini.
                        </div>
                    @endif

                    {{-- Form feedback --}}
                    <form method="POST" action="/admin/aspirasi/{{ $aspirasi->id }}/feedback">
                        @csrf
                        <label class="form-label small text-muted">Tulis Feedback</label>
                        <textarea name="feedback" class="form-control mb-3" rows="3" placeholder="Masukkan feedback..." required></textarea>
                        <div class="d-flex justify-content-end">
                            <button class="btn btn-success rounded-pill px-4">
                                Kirim Feedback
                            </button>
                        </div>
                    </form>

                </div>
            </div>

        </div>

    </div>

</div>
@endsection
