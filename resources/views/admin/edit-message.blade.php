@extends('layouts.admin')

@section('admin-content')
    <h2 class="mb-4 fw-bold">✏️ Edit Message</h2>

    <div class="card shadow-lg border-0 rounded-4">
        <div class="card-body">
            <form action="{{ route('admin.messages.update', $msg->id) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="message" class="form-label">Message</label>
                    <textarea id="message" name="message" class="form-control" rows="5">{{ old('message', $msg->message) }}</textarea>
                    @error('message')
                        <div class="text-danger">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn btn-primary">Update Message</button>
                <a href="{{ route('admin.messages') }}" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
@endsection
