@extends('layouts.public')

@section('title', 'Pricing - Free Until 2025')
@section('meta_description', 'Get full access to ' . config('app.name', 'ChatApp') . ' completely free until December 31, 2025. No credit card required. Experience premium messaging features at no cost.')

@push('styles')
<style>
    .pricing-hero {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 50%, #6f42c1 100%);
        position: relative;
        overflow: hidden;
    }

    .pricing-card {
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .pricing-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 20px 40px rgba(0,0,0,0.1);
    }

    .popular-badge {
        position: absolute;
        top: -15px;
        left: 50%;
        transform: translateX(-50%);
        background: linear-gradient(45deg, #28a745, #20c997);
        color: white;
        padding: 8px 24px;
        border-radius: 25px;
        font-size: 0.85rem;
        font-weight: 600;
        box-shadow: 0 4px 15px rgba(40, 167, 69, 0.3);
    }

    .feature-icon {
        width: 24px;
        height: 24px;
        background: linear-gradient(45deg, #0d6efd, #6f42c1);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 12px;
    }

    .countdown-timer {
        background: linear-gradient(45deg, #dc3545, #fd7e14);
        color: white;
        border-radius: 15px;
        padding: 20px;
        text-align: center;
        margin-bottom: 30px;
    }

    .countdown-number {
        font-size: 2rem;
        font-weight: 700;
        display: block;
    }
</style>
@endpush

@section('content')
<!-- Hero Section -->
<section class="pricing-hero text-white py-5 position-relative">
    <div class="container py-5">
        <div class="row justify-content-center text-center">
            <div class="col-lg-8">
                <div class="badge bg-success text-white px-4 py-2 fs-6 mb-4">
                    🎉 LIMITED TIME OFFER
                </div>

                <h1 class="display-4 fw-bold mb-4">
                    Everything Free Until <span class="text-warning">December 2025</span>
                </h1>

                <p class="lead mb-4">
                    Get complete access to all premium features of {{ config('app.name', 'ChatApp') }} 
                    absolutely free until December 31, 2025. No credit card required.
                </p>

                <!-- Countdown Timer -->
                <div class="countdown-timer mx-auto" style="max-width: 500px;">
                    <h5 class="mb-3">⏰ Free Access Ends In:</h5>
                    <div class="row text-center">
                        <div class="col-3">
                            <span class="countdown-number" id="days">--</span>
                            <small>Days</small>
                        </div>
                        <div class="col-3">
                            <span class="countdown-number" id="hours">--</span>
                            <small>Hours</small>
                        </div>
                        <div class="col-3">
                            <span class="countdown-number" id="minutes">--</span>
                            <small>Minutes</small>
                        </div>
                        <div class="col-3">
                            <span class="countdown-number" id="seconds">--</span>
                            <small>Seconds</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Current Offer Section -->
<section class="py-5 bg-light">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="text-center mb-5">
                    <h2 class="h1 fw-bold text-dark mb-3">What You Get for Free</h2>
                    <p class="lead text-muted">
                        Full access to all premium features with no limitations until December 31, 2025
                    </p>
                </div>

                <!-- Free Tier Card -->
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="pricing-card bg-white rounded-4 p-5 position-relative">
                            <div class="popular-badge">
                                🔥 COMPLETELY FREE
                            </div>

                            <div class="text-center mb-4">
                                <h3 class="h2 fw-bold text-primary mb-2">Premium Access</h3>
                                <div class="mb-3">
                                    <span class="h1 fw-bold text-success">$0</span>
                                    <span class="text-muted">/month</span>
                                </div>
                                <p class="text-muted mb-4">Until December 31, 2025</p>

                                <div class="d-grid gap-2">
                                    @guest
                                        <a href="{{ route('register') }}" class="btn btn-primary btn-lg rounded-pill">
                                            <i class="bi bi-rocket-takeoff me-2"></i>Start Free Now
                                        </a>
                                        <small class="text-muted">No credit card required • Setup in 30 seconds</small>
                                    @else
                                        <a href="{{ route('dashboard') }}" class="btn btn-success btn-lg rounded-pill">
                                            <i class="bi bi-arrow-right-circle me-2"></i>Go to Dashboard
                                        </a>
                                    @endguest
                                </div>
                            </div>

                            <!-- Features List -->
                            <div class="row">
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Core Features</h5>
                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Unlimited Messages</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Real-time Messaging</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>HD Audio Calling</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Group Conversations</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>File Sharing (Up to 100MB)</span>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="fw-bold mb-3">Premium Features</h5>
                                    <ul class="list-unstyled">
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>End-to-End Encryption</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Dark Mode Interface</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Message History Backup</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Priority Support</span>
                                        </li>
                                        <li class="d-flex align-items-center mb-2">
                                            <div class="feature-icon me-3">
                                                <i class="bi bi-check"></i>
                                            </div>
                                            <span>Zero Ads Experience</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ Section -->
<section class="py-5">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="text-center mb-5">
                    <h2 class="h1 fw-bold text-dark mb-3">Frequently Asked Questions</h2>
                </div>

                <div class="accordion" id="pricingFAQ">
                    <div class="accordion-item mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                Is it really completely free until December 2025?
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Yes! You get full access to all premium features including unlimited messaging, HD audio calls, 
                                end-to-end encryption, and priority support absolutely free until December 31, 2025.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item mb-3">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                What happens after December 31, 2025?
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#pricingFAQ">
                            <div class="accordion-body">
                                Starting January 1, 2026, we'll introduce our paid subscription plans. However, users who sign up 
                                during the free period will receive special early bird pricing.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Final CTA Section -->
<section class="py-5 bg-primary text-white">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <h2 class="h1 fw-bold mb-4">Ready to Experience Premium Messaging?</h2>
                <p class="lead mb-4">
                    Join thousands of users already enjoying {{ config('app.name', 'ChatApp') }} for free.
                </p>

                <div class="d-flex flex-column flex-sm-row gap-3 justify-content-center">
                    @guest
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg rounded-pill px-5">
                            <i class="bi bi-rocket-takeoff me-2"></i>Start Free Now
                        </a>
                    @else
                        <a href="{{ route('dashboard') }}" class="btn btn-light btn-lg rounded-pill px-5">
                            <i class="bi bi-arrow-right-circle me-2"></i>Go to Dashboard
                        </a>
                    @endguest
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script>
// Countdown Timer
function updateCountdown() {
    const endDate = new Date('December 31, 2025 23:59:59').getTime();
    const now = new Date().getTime();
    const timeLeft = endDate - now;

    const days = Math.floor(timeLeft / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeLeft % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeLeft % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeLeft % (1000 * 60)) / 1000);

    document.getElementById('days').textContent = days.toString().padStart(2, '0');
    document.getElementById('hours').textContent = hours.toString().padStart(2, '0');
    document.getElementById('minutes').textContent = minutes.toString().padStart(2, '0');
    document.getElementById('seconds').textContent = seconds.toString().padStart(2, '0');
}

setInterval(updateCountdown, 1000);
updateCountdown();
</script>
@endpush
