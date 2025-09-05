@extends('layouts.public')

@section('title', 'Welcome')

@section('content')
    <!-- Hero Section -->
    <section class="hero d-flex align-items-center justify-content-center text-white text-center position-relative overflow-hidden"
             style="min-height: 90vh; background: linear-gradient(135deg, #0d6efd, #0b5ed7);">

        <!-- Background Illustration -->
        <div class="hero-bg position-absolute top-0 start-0 w-100 h-100">
            <img src="{{ asset('images/hero-bg.png') }}" alt="Chat Illustration" class="opacity-25" style="object-fit: cover; width:100%; height:100%;">
        </div>

        <!-- Hero Content -->
        <div class="container position-relative" style="z-index: 2;">
            <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">
                Welcome to {{ config('app.name', 'ChatApp') }}
            </h1>
            <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                The secure, fast, and real-time messaging platform.<br>
                Stay connected with friends, family, and colleagues anywhere in the world.
            </p>
            <div data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('login') }}" class="btn btn-light btn-lg px-4 me-2 shadow-sm">Login</a>
                <a href="{{ route('register') }}" class="btn btn-outline-light btn-lg px-4">Get Started</a>
            </div>
            <p class="mt-4 text-white-50" data-aos="fade-up" data-aos-delay="300">
                Trusted by thousands of users worldwide for private and secure communication.
            </p>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">Why Choose {{ config('app.name') }}?</h2>
            <div class="row g-4">
                @php
                    $features = [
                        ['icon' => 'bi-chat-dots', 'title' => 'Instant Messaging', 'text' => 'Messages are delivered in milliseconds, powered by WebSockets.'],
                        ['icon' => 'bi-shield-lock-fill', 'title' => 'End-to-End Encryption', 'text' => 'Your conversations stay private and secure.'],
                        ['icon' => 'bi-people-fill', 'title' => 'Group & Team Chats', 'text' => 'Create chat groups and collaborate seamlessly.'],
                        ['icon' => 'bi-phone-fill', 'title' => 'Cross-Platform', 'text' => 'Use ChatApp on mobile, tablet, or desktop.'],
                        ['icon' => 'bi-rocket-takeoff-fill', 'title' => 'High Performance', 'text' => 'Optimized servers ensure smooth communication even with heavy usage.'],
                        ['icon' => 'bi-bell-fill', 'title' => 'Smart Notifications', 'text' => 'Stay updated with real-time alerts and typing indicators.'],
                    ];
                @endphp

                @foreach ($features as $i => $feature)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="card h-100 text-center shadow-sm border-0 p-4">
                            <div class="mb-3 fs-1 text-primary feature-icon">
                                <i class="bi {{ $feature['icon'] }}"></i>
                            </div>
                            <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                            <p class="text-muted">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="600">
                <h4 class="fw-bold">
                    Join over <span class="text-primary">10,000+</span> active users today
                </h4>
                <p class="text-muted">Experience secure, fast, and reliable messaging like never before.</p>
            </div>
        </div>
    </section>

        <!-- App Preview Section -->
    <section class="py-5 bg-white">
        <div class="container text-center">
            <h2 class="fw-bold mb-4" data-aos="fade-up">See ChatApp in Action</h2>
            <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100">
                Experience a clean, modern chat interface designed for productivity and fun.
            </p>

            <div class="d-flex justify-content-center align-items-center flex-wrap gap-4">
                <!-- Laptop Mockup -->
                <div class="shadow-lg rounded overflow-hidden" data-aos="fade-up" data-aos-delay="200"
                     style="max-width: 800px; border: 2px solid #e9ecef; border-radius: 16px;">
                    <img src="{{ asset('images/chatapp-desktop.png') }}" alt="ChatApp Desktop Preview" class="img-fluid">
                </div>

                <!-- Mobile Mockup -->
                <div class="shadow-lg rounded overflow-hidden" data-aos="fade-up" data-aos-delay="300"
                     style="max-width: 280px; border: 2px solid #e9ecef; border-radius: 24px;">
                    <img src="{{ asset('images/chatapp-mobile.png') }}" alt="ChatApp Mobile Preview" class="img-fluid">
                </div>
            </div>
        </div>
    </section>

    <!-- Testimonials Section -->
    <section class="py-5">
        <div class="container">
            <h2 class="text-center fw-bold mb-5" data-aos="fade-up">What Our Users Say</h2>
            <div class="row g-4">
                @php
                    $testimonials = [
                        ['quote' => 'ChatApp makes staying connected with my team effortless. Messages arrive instantly and securely!', 'name' => 'Alice W.', 'role' => 'Product Manager'],
                        ['quote' => 'I love the clean design and simplicity. It\'s easy for anyone to start chatting immediately.', 'name' => 'John D.', 'role' => 'Freelancer'],
                        ['quote' => 'Fast, reliable, and secure. I trust ChatApp for both personal and work conversations.', 'name' => 'Maria L.', 'role' => 'Entrepreneur'],
                    ];
                @endphp

                @foreach ($testimonials as $i => $testimonial)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                        <div class="card shadow-sm border-0 p-4 h-100">
                            <p class="fst-italic">"{{ $testimonial['quote'] }}"</p>
                            <h6 class="fw-bold mt-3 mb-0">{{ $testimonial['name'] }}</h6>
                            <small class="text-muted">{{ $testimonial['role'] }}</small>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
@endsection

@push('styles')
<style>
    /* Hero Background */
    .hero-bg img {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 1;
    }
    .hero .container {
        z-index: 2;
    }

    /* Feature Icons */
    .feature-icon i {
        transition: transform 0.3s ease, color 0.3s ease;
    }
    .feature-icon:hover i {
        transform: scale(1.2) rotate(5deg);
        color: var(--bs-primary);
    }
</style>
@endpush

@push('scripts')
    <!-- AOS (Animate on Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        AOS.init({ duration: 800, once: true });
    </script>
@endpush
