@extends('layouts.public')

@section('title','Register')

@section('content')
<div class="d-flex align-items-center justify-content-center py-5" style="min-height:90vh; background:#f1f5f9;">
    <div class="card shadow-sm p-4" style="max-width:480px; width:100%; border-radius:12px;">
        <div class="text-center mb-4">
            <div class="fs-2 text-primary mb-2"><i class="bi bi-person-plus"></i></div>
            <h3 class="fw-bold">Create Your {{ config('app.name', 'ChatApp') }} Account</h3>
            <p class="text-muted">Join {{ config('app.name', 'ChatApp') }} and start chatting securely with friends and colleagues</p>
        </div>
        <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label class="form-label fw-bold">Full Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                       value="{{ old('name') }}" required placeholder="John Doe">
                @error('name') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email') }}" required placeholder="you@example.com">
                @error('email') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Password</label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                       required placeholder="Min 8 characters">
                @error('password') <div class="invalid-feedback">{{ $message }}</div> @enderror
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <div class="mb-3">
                <label class="form-label fw-bold">Profile Picture (Optional)</label>
                <input type="file" name="user_image" class="form-control">
            </div>
            <button class="btn btn-primary w-100">Register</button>
            <div class="mt-3 text-center">
                <a href="{{ route('login') }}">Already have an account? Login</a>
            </div>
        </form>
    </div>
</div>

@endsection
