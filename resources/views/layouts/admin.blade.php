@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-3 col-lg-2 bg-light vh-100 p-3 shadow-sm position-fixed">
            <h4 class="mb-4 text-center">⚙️ Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.dashboard') ? 'fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.dashboard') }}">
                        📊 <span class="ms-2">Dashboard</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.messages') ? 'fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.messages') }}">
                        💬 <span class="ms-2">Messages</span>
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link d-flex align-items-center {{ request()->routeIs('admin.users') ? 'fw-bold text-primary' : 'text-dark' }}" href="{{ route('admin.users') }}">
                        👥 <span class="ms-2">Users</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 offset-md-3 offset-lg-2 p-4">
            @yield('admin-content')
        </div>
    </div>
</div>
@endsection
