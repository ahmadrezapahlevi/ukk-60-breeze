@extends('layout')

@section('content')
<div class="row justify-content-center w-100">
    <div class="col-12 col-md-8 col-lg-7 col-xl-6 mx-auto">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <h3 class="text-center mb-4 fw-bold text-primary">Daftar Akun SuaraKu</h3>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <!-- Name (Nama Lengkap) -->
                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold">Nama Lengkap</label>
                        <input type="text" id="name" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus autocomplete="name">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username (NISN) -->
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">NISN</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Kelas -->
                    <div class="mb-3">
                        <label for="kelas" class="form-label fw-semibold">Kelas</label>
                        <input type="text" id="kelas" name="kelas" class="form-control @error('kelas') is-invalid @enderror" value="{{ old('kelas') }}" required autocomplete="kelas">
                        @error('kelas')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <!-- Password -->
                        <div class="col-12 col-md-6 mb-3">
                            <label for="password" class="form-label fw-semibold">Password</label>
                            <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="new-password">
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Confirm Password -->
                        <div class="col-12 col-md-6 mb-4">
                            <label for="password_confirmation" class="form-label fw-semibold">Konfirmasi Password</label>
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control @error('password_confirmation') is-invalid @enderror" required autocomplete="new-password">
                            @error('password_confirmation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">Register</button>
                    </div>

                    <div class="text-center text-sm">
                        <a href="{{ route('login') }}" class="text-decoration-none text-muted">Sudah punya akun? <span class="fw-semibold text-primary">Login sekarang</span></a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
