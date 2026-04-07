<!doctype html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Aplikasi Aspirasi Sekolah</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light m-0">
@php
    $isAuthPage = request()->is('login') || request()->is('register');

    $role = auth()->user()->role ?? null;
    $userName = auth()->user()->name ?? null;

    $isActive = function ($pattern) {
        return request()->is($pattern);
    };

    $navItem = function ($href, $label, $pattern) use ($isActive) {
        $active = $isActive($pattern);
        return '
            <a href="'.$href.'"
               class="d-block text-decoration-none px-3 py-2 mb-2 '.(
                   $active
                    ? 'bg-white text-primary shadow-sm rounded-3 fw-semibold'
                    : 'text-white text-opacity-75'
               ).'">
                '.$label.'
            </a>
        ';
    };
@endphp

@if ($isAuthPage)
    <main class="container min-vh-100 d-flex align-items-center justify-content-center py-4">
        <div class="w-100">
            @yield('content')
        </div>
    </main>
@else
    <div class="container-fluid p-0">
        <div class="row g-0 vh-100">

            {{-- SIDEBAR --}}
            <aside class="col-12 col-md-3 col-lg-2 bg-primary d-flex flex-column vh-100">

                <div class="p-3 border-bottom border-white border-opacity-25">
                    <div class="text-white fw-bold">SuaraKu</div>
                    <small class="text-white-50">Aspirasi Siswa</small>
                </div>

                <div class="px-3 pt-3 flex-grow-1">
                    @if ($role === 'siswa')
                        {!! $navItem('/dashboard', 'Dashboard', 'dashboard') !!}
                        {!! $navItem('/aspirasi', 'Aspirasi Saya', 'aspirasi*') !!}
                    @endif

                    @if ($role === 'admin')
                        {!! $navItem('/admin/dashboard', 'Dashboard', 'admin/dashboard') !!}
                        {!! $navItem('/admin/aspirasi', 'Data Aspirasi', 'admin/aspirasi*') !!}
                        {!! $navItem('/admin/kategori', 'Kategori', 'admin/kategori*') !!}
                        {!! $navItem('/admin/users', 'Manajemen User', 'admin/users*') !!}
                    @endif
                </div>

                <div class="px-3 pb-3 mt-auto">
                    <div class="bg-white bg-opacity-10 rounded-3 p-3 text-white">
                        @if ($role)
                            <div class="fw-semibold text-truncate">{{ $userName }}</div>
                            <small class="text-white-50 text-capitalize">{{ $role }}</small>
                        @endif

                        <form method="POST" action="{{ route('logout') }}" class="mt-3">
                            @csrf
                            <button type="submit" class="btn btn-outline-light btn-sm w-100 rounded-pill">
                                Logout
                            </button>
                        </form>
                    </div>
                </div>

            </aside>

            {{-- MAIN --}}
            <main class="col-12 col-md-9 col-lg-10 vh-100 overflow-auto">

                {{-- TOPBAR KOSONG --}}
                <div class="bg-white border-bottom" style="height:56px;"></div>

                {{-- CONTENT --}}
                <div class="p-3 p-md-4">
                    @yield('content')
                </div>

            </main>

        </div>
    </div>
@endif

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
