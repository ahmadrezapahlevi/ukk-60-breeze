@extends('layout')

@section('content')
<div class="row justify-content-center w-100">
    <div class="col-12 col-md-8 col-lg-6 col-xl-5 mx-auto">
        <div class="card shadow-sm border-0 rounded-4">
            <div class="card-body p-4 p-md-5">
                <h3 class="text-center mb-4 fw-bold text-primary">Login SuaraKu</h3>

                @if(session('status'))
                    <div class="alert alert-success mt-3 rounded-3">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <!-- Role -->
                    <div class="mb-3">
                        <label for="role" class="form-label fw-semibold">Login Sebagai</label>
                        <select id="role" name="role" class="form-select @error('role') is-invalid @enderror" required autofocus>
                            <option value="siswa" {{ old('role') == 'siswa' ? 'selected' : '' }}>Siswa</option>
                            <option value="admin" {{ old('role') == 'admin' ? 'selected' : '' }}>Admin</option>
                        </select>
                        @error('role')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Username (NISN / NIP) -->
                    <div class="mb-3">
                        <label for="username" class="form-label fw-semibold">NISN / NIP</label>
                        <input type="text" id="username" name="username" class="form-control @error('username') is-invalid @enderror" value="{{ old('username') }}" required autocomplete="username">
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold">Password</label>
                        <input type="password" id="password" name="password" class="form-control @error('password') is-invalid @enderror" required autocomplete="current-password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="mb-4 form-check">
                        <input type="checkbox" class="form-check-input" id="remember_me" name="remember">
                        <label class="form-check-label text-muted" for="remember_me">Ingat saya</label>
                    </div>

                    <div class="d-grid gap-2 mb-4">
                        <button type="submit" class="btn btn-primary btn-lg rounded-pill fw-bold">Log in</button>
                    </div>

                    <div class="d-flex justify-content-between align-items-center text-sm">
                        <a href="{{ route('register') }}" class="text-decoration-none">Belum punya akun? Daftar</a>
                        {{-- @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-muted">Lupa password?</a>
                        @endif --}}
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
