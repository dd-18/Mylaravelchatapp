@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>Edit Profile</h3>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
            @csrf

            <!-- Current Profile Image -->
            <div class="mb-3">
                <label for="user_image" class="form-label">Profile Picture</label><br>
                <img src="{{ Auth::user()->user_image
                    ? asset('storage/users/' . Auth::user()->user_image)
                    : 'https://ui-avatars.com/api/?name=' . urlencode(Auth::user()->name) }}"
                    alt="profile" width="100" height="100">

                <input type="file" name="user_image" class="form-control">

            </div>

            <!-- Name -->
            <div class="mb-3">
                <label for="name">Name</label>
                <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
            </div>

            <!-- Email -->
            <div class="mb-3">
                <label for="email">Email</label>
                <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
            </div>

            <!-- Password -->
            <div class="mb-3">
                <label for="password">New Password (leave empty if not changing)</label>
                <input type="password" name="password" class="form-control">
            </div>

            <div class="mb-3">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" class="form-control">
            </div>

            <button type="submit" class="btn btn-primary">Save Changes</button>
            <a href="{{ route('home') }}" class="btn btn-secondary">Back</a>
        </form>
    </div>
@endsection
