@extends('layouts.admin')

@section('admin-content')
    <h2 class="mb-4 fw-bold">📊 Admin Dashboard</h2>

    <div class="row g-4">
        <!-- Total Users -->
        <div class="col-md-4">
            <div class="card stat-card border-0 h-100 text-center p-4">
                <div class="icon-wrapper bg-primary text-white mb-3">
                    <i class="bi bi-people"></i>
                </div>
                <a href="{{ route('admin.users') }}" style="text-decoration: none;">Total Users</a>
                <h2 class="fw-bold text-primary">{{ $usersCount }}</h2>
            </div>
        </div>

        <!-- Online Users -->
        <div class="col-md-4">
            <div class="card stat-card border-0 h-100 text-center p-4">
                <div class="icon-wrapper bg-success text-white mb-3">
                    <i class="bi bi-circle-fill"></i>
                </div>
                <h6 class="text-muted">Online Users</h6>
                <h2 class="fw-bold text-success">{{ $onlineUsers }}</h2>
            </div>
        </div>

        <!-- Total Messages -->
        <div class="col-md-4">
            <div class="card stat-card border-0 h-100 text-center p-4">
                <div class="icon-wrapper bg-info text-white mb-3">
                    <i class="bi bi-chat-dots"></i>
                </div>
                <a href="{{ route('admin.messages') }}" style="text-decoration: none;">Total Messages</a>
                <h2 class="fw-bold text-info">{{ $messagesCount }}</h2>
            </div>
        </div>
    </div>

    {{-- Extra Styling --}}
    <style>
        /* Stat Cards */
        .stat-card {
            border-radius: 16px;
            background: var(--bs-light);
            box-shadow: 0 4px 15px rgba(0,0,0,0.08);
            transition: all 0.3s ease;
        }
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.15);
        }

        /* Icon Circles */
        .icon-wrapper {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            margin: 0 auto;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        /* Dark Mode Support */
        body.bg-light .stat-card {
            background: #fff;
        }
        body.bg-dark .stat-card {
            background: #1f2937;
            color: #f3f4f6;
        }
        body.bg-dark .text-muted {
            color: #9ca3af !important;
        }
    </style>
@endsection
