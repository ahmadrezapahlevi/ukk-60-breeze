@extends('layout')

@section('content')
    <div class="container py-4">



        {{-- STATS --}}
        <div class="row g-4">

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Total Aspirasi</div>
                                <div class="fw-bold display-6 mb-0">{{ $totalAspirasi }}</div>
                            </div>
                            <span class="badge text-bg-primary rounded-pill px-3 py-2">All</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Menunggu</div>
                                <div class="fw-bold display-6 mb-0">{{ $menunggu }}</div>
                            </div>
                            <span class="badge text-bg-warning rounded-pill px-3 py-2">Pending</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Diproses</div>
                                <div class="fw-bold display-6 mb-0">{{ $proses }}</div>
                            </div>
                            <span class="badge text-bg-primary rounded-pill px-3 py-2">Process</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Selesai</div>
                                <div class="fw-bold display-6 mb-0">{{ $selesai }}</div>
                            </div>
                            <span class="badge text-bg-success rounded-pill px-3 py-2">Done</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Ditolak</div>
                                <div class="fw-bold display-6 mb-0">{{ $ditolak }}</div>
                            </div>
                            <span class="badge text-bg-danger rounded-pill px-3 py-2">Reject</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Total Siswa</div>
                                <div class="fw-bold display-6 mb-0">{{ $totalSiswa }}</div>
                            </div>
                            <span class="badge text-bg-dark rounded-pill px-3 py-2">Users</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-6 col-xl-4">
                <div class="card border-0 shadow-sm rounded-4 h-100">
                    <div class="card-body p-4">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <div class="text-muted">Kategori</div>
                                <div class="fw-bold display-6 mb-0">{{ $totalKategori }}</div>
                            </div>
                            <span class="badge text-bg-info rounded-pill px-3 py-2">Types</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>

    </div>
@endsection
