@extends('layouts.public')

@section('title','Contact Us')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Contact Us</h1>
        <p class="text-muted fs-5">We’d love to hear from you! Reach out with any questions or feedback.</p>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0 p-4">
                <form method="POST" action="#">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold">Full Name</label>
                        <input type="text" name="name" class="form-control" required placeholder="John Doe">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Email</label>
                        <input type="email" name="email" class="form-control" required placeholder="you@example.com">
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Message</label>
                        <textarea name="message" rows="5" class="form-control" required placeholder="Type your message here..."></textarea>
                    </div>
                    <button class="btn btn-primary w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
