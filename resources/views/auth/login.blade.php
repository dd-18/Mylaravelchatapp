@extends('layouts.public')

@section('title','Login')

@section('content')
<div class="d-flex align-items-center justify-content-center py-5" style="min-height:90vh; background:#f1f5f9;">
    <div class="card shadow-sm p-4" style="max-width:400px; width:100%; border-radius:12px;">
        <div class="text-center mb-4">
            <div class="fs-2 text-primary mb-2"><i class="bi bi-chat-dots"></i></div>
            <h3 class="fw-bold">Sign In to ChatApp</h3>
            <p class="text-muted">Enter your credentials to access your account</p>
        </div>
        <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                       name="email" value="{{ old('email') }}" required autofocus placeholder="you@example.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror"
                       name="password" required placeholder="Enter your password">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" name="remember" id="remember">
                <label class="form-check-label" for="remember">Remember me</label>
            </div>
            <button class="btn btn-primary w-100">Login</button>
            <div class="mt-3 text-center">
                <a href="{{ route('register') }}">Don't have an account? Create one</a>
            </div>
        </form>

        <!-- Show error for blocked user -->
        @if(session('errors') && session('errors')->has('email'))
            <div class="alert alert-danger mt-2">
                {{ session('errors')->first('email') }}
            </div>
        @endif
    </div>
</div>
@endsection
