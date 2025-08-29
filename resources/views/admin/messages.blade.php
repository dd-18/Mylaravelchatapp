@extends('layouts.admin')

@section('admin-content')
    <h2 class="mb-4">💬 All Messages</h2>

    <div class="card shadow-sm border-0">
        <div class="card-body">
            <table class="table table-striped align-middle">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Sent At</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($messages as $msg)
                        <tr>
                            <td>{{ $msg->id }}</td>
                            <td>{{ $msg->user->name ?? 'Unknown' }}</td>
                            <td>{{ $msg->recipient->name ?? 'Unknown' }}</td>
                            <td>
                                @if ($msg->message_type === 'image')
                                    <img src="{{ $msg->message }}" alt="image" width="50">
                                @else
                                    {{ \Illuminate\Support\Str::limit($msg->message, 50) }}
                                @endif
                            </td>
                            <td>
                                @if ($msg->is_read)
                                    <span class="badge bg-success">Read</span>
                                @else
                                    <span class="badge bg-warning">Unread</span>
                                @endif
                            </td>
                            <td>{{ $msg->created_at->format('d M Y, h:i A') }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.messages.delete', $msg->id) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                        onclick="return confirm('Are you sure you want to delete this message?')">
                                        Delete
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
                        Showing {{ $messages->firstItem() }} to {{ $messages->lastItem() }} of {{ $messages->total() }}
                        results
                    </div>
                    <div>
                        {{ $messages->onEachSide(1)->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
