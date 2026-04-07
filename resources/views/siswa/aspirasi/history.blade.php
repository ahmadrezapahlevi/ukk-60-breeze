@extends('layout')

@section('content')
<h4 class="fw-bold mb-4">Histori Aspirasi</h4>

@if($aspirasis->count())
<div class="card shadow-sm">
    <div class="card-body p-0">
        <table class="table table-striped table-bordered mb-0 align-middle">
            <thead class="table-light">
                <tr>
                    <th>Tanggal</th>
                    <th>Kategori</th>
                    <th>Lokasi</th>
                    <th>Status</th>
                    <th>Feedback</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aspirasis as $a)
                <tr>
                    <td>{{ $a->created_at->format('d-m-Y') }}</td>
                    <td>{{ $a->kategori->nama_kategori }}</td>
                    <td>{{ $a->lokasi }}</td>
                    <td>
                        <span class="badge bg-{{
                            $a->status=='menunggu'?'secondary':
                            ($a->status=='proses'?'warning':'success')
                        }}">
                            {{ ucfirst($a->status) }}
                        </span>
                    </td>
                    <td>
                        @forelse($a->feedbacks as $f)
                            <div class="small">• {{ $f->feedback }}</div>
                        @empty
                            <em class="text-muted">Belum ada</em>
                        @endforelse
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@else
<div class="alert alert-secondary">
    Belum ada aspirasi.
</div>
@endif
@endsection
