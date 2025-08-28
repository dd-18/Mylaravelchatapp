@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="mb-4">👥 Manage Users</h2>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>Profile</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>
                                    <img src="{{ $user->user_image ?? 'https://via.placeholder.com/40' }}" alt="User Image"
                                        class="rounded-circle" width="40" height="40">
                                </td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if ($user->is_online)
                                        <span class="badge bg-success">Online</span>
                                    @else
                                        <span class="badge bg-secondary">Offline</span>
                                    @endif

                                    @if ($user->is_blocked ?? false)
                                        <span class="badge bg-danger ms-1">Blocked</span>
                                    @endif
                                </td>
                                <td>{{ $user->created_at->format('d M Y') }}</td>
                                <td>
                                    <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}">
                                        @csrf
                                        <button type="submit"
                                            class="btn btn-sm {{ $user->is_blocked ? 'btn-success' : 'btn-danger' }}">
                                            {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>

                </table>

                <div class="d-flex justify-content-center">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>
@endsection
