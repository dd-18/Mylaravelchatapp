@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card shadow-sm p-4" style="max-width: 600px; margin: auto; border-radius: 12px;">
        <h3 class="mb-4 fw-bold text-center">Edit Profile</h3>

        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Profile Image -->
            <div class="mb-4 text-center">
                <img src="{{ Auth::user()->user_image 
                    ? asset('storage/users/' . Auth::user()->user_image) 
                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="profile" 
                    class="rounded-circle mb-2" 
                    width="100" height="100">

                <div class="mt-2">
                    <input type="file" name="user_image" class="form-control @error('user_image') is-invalid @enderror">
                    @error('user_image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name" class="form-label fw-semibold">Name</label>
                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                    value="{{ old('name', Auth::user()->name) }}" required>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email" class="form-label fw-semibold">Email</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                    value="{{ old('email', Auth::user()->email) }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password" class="form-label fw-semibold">New Password <small class="text-muted">(leave blank if unchanged)</small></label>
                <input type="password" name="password" class="form-control @error('password') is-invalid @enderror">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <!-- Confirm Password -->
            <div class="mb-4">
                <label for="password_confirmation" class="form-label fw-semibold">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <!-- Actions -->
            <div class="d-flex justify-content-between">
                <a href="{{ route('home') }}" class="btn btn-outline-secondary">
                    <i class="fa fa-arrow-left me-1"></i> Back
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fa fa-save me-1"></i> Save Changes
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
