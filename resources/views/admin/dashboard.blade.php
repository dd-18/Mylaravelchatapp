@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="mb-4">📊 Admin Dashboard</h2>

    <div class="row g-4">
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">👥 Total Users</h5>
                    <h2 class="fw-bold text-primary">{{ $usersCount }}</h2>
                </div>
            </div>
        </div>

        <!-- Online Users -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">🟢 Online Users</h5>
                    <h2 class="fw-bold text-success">{{ $onlineUsers }}</h2>
                </div>
            </div>
        </div>

        <!-- Total Messages -->
        <div class="col-md-4">
            <div class="card shadow-sm border-0">
                <div class="card-body text-center">
                    <h5 class="card-title">💬 Total Messages</h5>
                    <h2 class="fw-bold text-info">{{ $messagesCount }}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
