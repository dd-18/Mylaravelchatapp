@extends('layouts.admin')

@section('admin-content')
    <h2 class="mb-4 fw-bold">👥 Manage Users</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light sticky-top">
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>Joined</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td class="fw-semibold" style="text-transform: capitalize;">{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                @if ($user->is_online)
                                    <span class="badge rounded-pill bg-success px-3">Online</span>
                                @else
                                    <span class="badge rounded-pill bg-secondary px-3">Offline</span>
                                @endif

                                @if ($user->is_blocked ?? false)
                                    <span class="badge rounded-pill bg-danger px-3 ms-1">Blocked</span>
                                @endif
                            </td>
                            <td>{{ $user->created_at->format('d M Y') }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.users.toggle', $user->id) }}">
                                    @csrf
                                    <button type="submit"
                                        class="btn btn-sm rounded-pill {{ $user->is_blocked ? 'btn-success' : 'btn-danger' }}">
                                        {{ $user->is_blocked ? 'Unblock' : 'Block' }}
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center mt-3">
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <style>
        table thead {
            border-radius: 12px;
            overflow: hidden;
        }
        table tbody tr:hover {
            background: #f8f9fa !important;
            transition: background 0.2s ease;
        }
    </style>
@endsection
