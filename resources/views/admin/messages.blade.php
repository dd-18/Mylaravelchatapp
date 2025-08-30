@extends('layouts.admin')

@section('admin-content')
    <h2 class="mb-4 fw-bold">💬 All Messages</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light sticky-top">
                    <tr>
                        {{-- <th>#</th> --}}
                        <th>From</th>
                        <th>To</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Sent At</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $msg)
                        <tr>
                            {{-- <td>{{ $msg->id }}</td> --}}
                            <td class="fw-semibold" style="text-transform: capitalize;">{{ $msg->user->name ?? 'Unknown' }}</td>
                            <td class="fw-semibold" style="text-transform: capitalize;">{{ $msg->recipient->name ?? 'Unknown' }}</td>
                            <td>
                                @if ($msg->message_type === 'image')
                                    <img src="{{ $msg->message }}" alt="image" class="rounded shadow-sm" width="50">
                                @else
                                    {{ \Illuminate\Support\Str::limit($msg->message, 50) }}
                                @endif
                            </td>
                            <td>
                                @if ($msg->is_read)
                                    <span class="badge rounded-pill bg-success px-3">Read</span>
                                @else
                                    <span class="badge rounded-pill bg-warning px-3">Unread</span>
                                @endif
                            </td>
                            <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                            <td class="text-center">
                                <form method="POST" action="{{ route('admin.messages.delete', $msg->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit"
                                        class="btn btn-sm btn-outline-danger rounded-pill px-3"
                                        onclick="return confirm('Are you sure you want to delete this message?')">
                                        <i class="bi bi-trash"></i> Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            @if ($messages->hasPages())
                <div class="d-flex justify-content-between align-items-center mt-3 flex-wrap">
                    <div class="small text-muted mb-2">
                        Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }} results
                    </div>
                    <div>
                        {{ $messages->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
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
