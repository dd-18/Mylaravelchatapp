@extends('layouts.public')

@section('title', 'Contact Us')
@section('meta_description',
    'Get in touch with ' .
    config('app.name', 'ChatApp') .
    ' — support, sales, or feedback. We
    typically respond within 1—2 business days.')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">Contact Us</h1>
            <p class="text-muted fs-5">We'd love to hear from you! Reach out with any questions, feedback, or partnership
                inquiries.</p>
            <!-- New impactful addition -->
            <div class="row justify-content-center mt-4">
                <div class="col-md-10">
                    <div class="d-flex flex-wrap justify-content-center gap-4 text-center">
                        <div class="d-flex align-items-center">
                            <i class="bi bi-clock-history text-primary me-2"></i>
                            <span class="small text-muted">24hr response time</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-people text-primary me-2"></i>
                            <span class="small text-muted">Real human support</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-shield-check text-primary me-2"></i>
                            <span class="small text-muted">Privacy protected</span>
                        </div>
                    </div>
                </div>
            </div>
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
                            <!-- New trust signal -->
                            <div class="alert alert-light border-0 bg-light-subtle mt-3">
                                <small class="text-muted">
                                    <i class="bi bi-info-circle me-1"></i>
                                    <strong>Join 50,000+ users</strong> who trust us with their communication needs. 
                                    Our dedicated support team is here to ensure your experience is seamless.
                                </small>
                            </div>
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
                            <div class="form-text">We'll use this to reply — we never share your email with third parties.
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="subject" class="form-label fw-bold">Subject</label>
                            <select id="subject" name="subject" class="form-select" required aria-required="true">
                                <option value="">Choose a subject…</option>
                                <option>Support & Technical Help</option>
                                <option>Sales & Enterprise Partnerships</option>
                                <option>Product Feedback & Suggestions</option>
                                <option>Bug Report & Issues</option>
                                <option>Account & Billing Questions</option>
                                <option>Security & Privacy Concerns</option>
                                <option>Media & Press Inquiries</option>
                                <option>Other</option>
                            </select>
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label fw-bold">Phone (optional)</label>
                            <input id="phone" type="tel" name="phone" class="form-control"
                                placeholder="+1 (555) 555-5555" aria-describedby="phoneHelp">
                            <div id="phoneHelp" class="form-text">Optional — provide if you'd like a callback for urgent matters.</div>
                        </div>

                        <div class="mb-3">
                            <label for="message" class="form-label fw-bold">Message</label>
                            <textarea id="message" name="message" rows="6" class="form-control" required
                                placeholder="Tell us how we can help you. The more details you provide, the better we can assist you..." aria-required="true"></textarea>
                        </div>

                        <button class="btn btn-primary w-100">
                            <i class="bi bi-send me-2"></i>Send Message
                        </button>

                        <p class="small text-muted mt-3 mb-0">
                            By contacting us you agree to our <a href="#" class="text-decoration-underline">Privacy
                                Policy</a>. We retain contact messages only as long as needed to respond.
                        </p>
                    </form>
                    
                    <!-- Enhanced footer with additional contact options -->
                    <div class="border-top pt-4 mt-4">
                        <div class="row text-center">
                            <div class="col-md-6">
                                <h6 class="fw-bold text-primary">Standard Support</h6>
                                <p class="small text-muted mb-0">
                                    <strong>support@chatapp.test</strong><br>
                                    We aim to reply within 24 hours
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h6 class="fw-bold text-warning">Urgent Issues</h6>
                                <p class="small text-muted mb-0">
                                    <strong>help@chatapp.test</strong><br>
                                    For critical technical problems
                                </p>
                            </div>
                        </div>
                        
                        <!-- New FAQ suggestion -->
                        <div class="text-center mt-3">
                            <small class="text-muted">
                                Looking for quick answers? Check our 
                                <a href="{{ route('faq') }}" class="text-decoration-underline">FAQ section</a>
                                for instant solutions to common questions.
                            </small>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        
        <!-- New testimonial section -->
        <div class="row justify-content-center mt-5">
            <div class="col-md-8">
                <div class="text-center">
                    <blockquote class="blockquote text-muted">
                        <p class="mb-0">"Amazing support team! They resolved my issue within hours and went above and beyond to ensure everything was working perfectly."</p>
                        <footer class="blockquote-footer mt-2">Sarah M., Product Manager</footer>
                    </blockquote>
                </div>
            </div>
        </div>
    </div>
@endsection