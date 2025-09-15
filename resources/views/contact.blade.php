@extends('layouts.public')

@section('title', 'Contact Us')
@section('meta_description',
    'Get in touch with ' .
    config('app.name', 'ChatApp') .
    ' — support, sales, or feedback. We
    typically respond within 1–2 business days.')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Contact Us</h1>
            <p class="text-muted fs-5">We’d love to hear from you! Reach out with any questions, feedback, or partnership
                inquiries.</p>
        </div>

        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-sm border-0 p-4">
                    <div class="row mb-4">
                        <div class="col text-center">
                            <p class="text-muted">
                                Need help with your account, have ideas for new features, or just want to say hello?
                                Use the form below or email us at <strong>support@chatapp.test</strong>.
                            </p>
                        </div>
                    </div>

                    <form method="POST" action="#" aria-label="Contact form">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label fw-bold">Full Name</label>
                            <input id="name" type="text" name="name" class="form-control" required
                                placeholder="John Doe" aria-required="true">
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input id="email" type="email" name="email" class="form-control" required
                                placeholder="you@example.com" aria-required="true">
                            <div class="form-text">We’ll use this to reply — we never share your email with third parties.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold">Subject</label>
                            <select id="subject" name="subject" class="form-select" required aria-required="true">
                                <option value="">Choose a subject…</option>
                                <option>Support</option>
                                <option>Sales / Partnerships</option>
                                <option>Feedback</option>
                                <option>Bug Report</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone (optional)</label>
                            <input id="phone" type="tel" name="phone" class="form-control"
                                placeholder="+1 (555) 555-5555" aria-describedby="phoneHelp">
                            <div id="phoneHelp" class="form-text">Optional — provide if you'd like a callback.</div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">Message</label>
                            <textarea id="message" name="message" rows="6" class="form-control" required
                                placeholder="Type your message here..." aria-required="true"></textarea>
                        </div>

                        <button class="btn btn-primary w-100">Send Message</button>

                        <p class="small text-muted mt-3 mb-0">
                            By contacting us you agree to our <a href="#" class="text-decoration-underline">Privacy
                                Policy</a>. We retain contact messages only as long as needed to respond.
                        </p>
                    </form>
                    <p class="small text-muted mt-3 text-center">
                        We aim to reply within 24 hours. For urgent issues, please email <strong>help@chatapp.test</strong>.
                    </p>

                </div>
            </div>
        </div>
    </div>
@endsection
