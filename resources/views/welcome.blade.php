@extends('layouts.public')

@section('title', 'Welcome')
@section('meta_description',
    'Welcome to ' .
    config('app.name', 'ChatApp') .
    ' — the secure, fast, and real-time
    messaging platform for teams and individuals.')

@section('content')
    <!-- Hero Section -->
    <section
        class="hero d-flex align-items-center justify-content-center text-white text-center position-relative overflow-hidden"
        style="min-height: 90vh; background: linear-gradient(135deg, #0d6efd, #0b5ed7);">

        <!-- Background Illustration -->
        <div class="hero-bg position-absolute top-0 start-0 w-100 h-100" aria-hidden="true">
            <img src="{{ asset('images/hero-bg.png') }}" alt="Abstract chat background" class="opacity-25"
                style="object-fit: cover; width:100%; height:100%;">
        </div>

        <!-- Floating Elements -->
        <div class="floating-elements position-absolute w-100 h-100" aria-hidden="true">
            <div class="floating-circle" style="top: 20%; left: 10%; animation: float 6s ease-in-out infinite;"></div>
            <div class="floating-circle" style="top: 60%; right: 15%; animation: float 8s ease-in-out infinite reverse;"></div>
            <div class="floating-square" style="top: 80%; left: 20%; animation: float 7s ease-in-out infinite;"></div>
        </div>

        <!-- Hero Content -->
        <div class="container position-relative" style="z-index: 2;">
            <div class="badge bg-white text-primary px-3 py-2 fs-6 mb-3" data-aos="fade-down">
                🎉 Join 10,000+ users already chatting securely
            </div>
            
            <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">
                Communication Reimagined for the <span class="text-warning">Modern World</span>
            </h1>
            
            <p class="lead mb-4" data-aos="fade-up" data-aos-delay="100">
                Experience lightning-fast messaging with military-grade encryption. 
                <br class="d-none d-md-block">
                Where privacy meets performance, and every conversation matters.
            </p>

            <div class="hero-features d-flex justify-content-center flex-wrap gap-4 mb-4" data-aos="fade-up" data-aos-delay="150">
                <div class="feature-pill">
                    <i class="bi bi-lightning-charge-fill text-warning"></i>
                    Sub-second delivery
                </div>
                <div class="feature-pill">
                    <i class="bi bi-shield-lock-fill text-success"></i>
                    End-to-end encrypted
                </div>
                <div class="feature-pill">
                    <i class="bi bi-globe text-info"></i>
                    Works everywhere
                </div>
            </div>
            
            <div data-aos="fade-up" data-aos-delay="200">
                <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 me-3 shadow-lg hero-cta-primary">
                    <i class="bi bi-rocket-takeoff me-2"></i>
                    Start Free Trial
                </a>
                <a href="{{ route('login') }}" class="btn btn-outline-light btn-lg px-4">
                    <i class="bi bi-box-arrow-in-right me-2"></i>
                    Sign In
                </a>
            </div>
            
            <p class="mt-4 text-white-75" data-aos="fade-up" data-aos-delay="300">
                <i class="bi bi-check-circle-fill text-success me-2"></i>
                No credit card required • 
                <i class="bi bi-check-circle-fill text-success me-2 ms-2"></i>
                Setup in 30 seconds • 
                <i class="bi bi-check-circle-fill text-success me-2 ms-2"></i>
                Cancel anytime
            </p>

            <!-- Enhanced Trust badges / quick stats -->
            <div class="hero-stats d-flex justify-content-center gap-5 mt-5" data-aos="fade-up" data-aos-delay="350">
                <div class="text-center stat-item">
                    <div class="fw-bold display-6">10k+</div>
                    <small class="text-white-75">Active users</small>
                    <div class="stat-indicator bg-success"></div>
                </div>
                <div class="text-center stat-item">
                    <div class="fw-bold display-6">99.99%</div>
                    <small class="text-white-75">Uptime SLA</small>
                    <div class="stat-indicator bg-info"></div>
                </div>
                <div class="text-center stat-item">
                    <div class="fw-bold display-6">50ms</div>
                    <small class="text-white-75">Avg latency</small>
                    <div class="stat-indicator bg-warning"></div>
                </div>
            </div>
        </div>
    </section>

    <!-- Social Proof Section -->
    <section class="py-3 bg-white border-bottom">
        <div class="container">
            <div class="text-center text-muted small">
                <span class="me-4">Trusted by teams at:</span>
                <span class="fw-bold me-4">🏢 TechCorp</span>
                <span class="fw-bold me-4">🚀 StartupLab</span>
                <span class="fw-bold me-4">🎓 University</span>
                <span class="fw-bold">🏥 MedCenter</span>
            </div>
        </div>
    </section>

    <!-- Enhanced Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <div class="badge bg-primary text-white px-3 py-2 fs-6 mb-3" data-aos="fade-up">
                    ✨ Powerful Features
                </div>
                <h2 class="fw-bold mb-3" data-aos="fade-up" style="color: #333;">Why {{ config('app.name') }} is Different</h2>
                <p class="text-muted fs-5" data-aos="fade-up" data-aos-delay="100">
                    Built for the future of work, with features that actually matter
                </p>
            </div>
            
            <div class="row g-4">
                @php
                    $features = [
                        [
                            'icon' => 'bi-lightning-charge-fill',
                            'title' => 'Instant Delivery',
                            'text' => 'Messages delivered in under 100ms using WebSocket magic and global edge infrastructure.',
                            'color' => 'warning',
                            'stat' => '< 100ms latency'
                        ],
                        [
                            'icon' => 'bi-shield-lock-fill',
                            'title' => 'Military-Grade Security',
                            'text' => 'AES-256 encryption with perfect forward secrecy. Even we can\'t read your messages.',
                            'color' => 'success',
                            'stat' => 'Zero breaches'
                        ],
                        [
                            'icon' => 'bi-people-fill',
                            'title' => 'Smart Group Management',
                            'text' => 'Organize teams with roles, channels, and advanced moderation tools that scale.',
                            'color' => 'primary',
                            'stat' => 'Unlimited users'
                        ],
                        [
                            'icon' => 'bi-phone-fill',
                            'title' => 'Universal Access',
                            'text' => 'Native-quality experience on every device. Your conversations, everywhere.',
                            'color' => 'info',
                            'stat' => 'All platforms'
                        ],
                        [
                            'icon' => 'bi-rocket-takeoff-fill',
                            'title' => 'Enterprise Performance',
                            'text' => 'Auto-scaling infrastructure that grows with you. From startup to enterprise.',
                            'color' => 'danger',
                            'stat' => '99.99% uptime'
                        ],
                        [
                            'icon' => 'bi-bell-fill',
                            'title' => 'Intelligent Notifications',
                            'text' => 'Smart alerts that know when to notify and when to stay quiet. Focus on what matters.',
                            'color' => 'secondary',
                            'stat' => 'AI-powered'
                        ],
                    ];
                @endphp

                @foreach ($features as $i => $feature)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 100 }}">
                        <div class="card h-100 text-center shadow-sm border-0 p-4 feature-card-enhanced">
                            <div class="feature-icon-wrapper mb-3">
                                <div class="feature-icon-bg bg-{{ $feature['color'] }}-subtle rounded-circle p-3 d-inline-flex">
                                    <i class="bi {{ $feature['icon'] }} fs-1 text-{{ $feature['color'] }}"></i>
                                </div>
                                <span class="badge bg-{{ $feature['color'] }} position-absolute top-0 end-0.1 translate-middle">
                                    {{ $feature['stat'] }}
                                </span>
                            </div>
                            <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                            <p class="text-com-muted">{{ $feature['text'] }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="text-center mt-5" data-aos="fade-up" data-aos-delay="600">
                <h4 class="fw-bold mb-3" style="color: #333;">
                    Join <span class="text-primary counter" data-target="10000">0</span>+ professionals who've upgraded their communication
                </h4>
                <p class="text-muted">From Fortune 500 companies to innovative startups, teams choose {{ config('app.name') }} for mission-critical conversations.</p>
                <div class="d-flex justify-content-center gap-3 mt-4">
                    <div class="rating-stars">
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <i class="bi bi-star-fill text-warning"></i>
                        <span class="ms-2 text-muted">4.9/5 from 2,500+ reviews</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Security Section -->
    <section class="py-5 bg-primary text-white position-relative overflow-hidden">
        <div class="security-bg position-absolute w-100 h-100 opacity-10"></div>
        <div class="container position-relative">
            <div class="row align-items-center">
                <div class="col-lg-6" data-aos="fade-right">
                    <div class="security-badge mb-3">
                        <span class="badge bg-success px-3 py-2">
                            <i class="bi bi-shield-check me-2"></i>SOC 2 Compliant
                        </span>
                        <span class="badge bg-warning text-dark px-3 py-2 ms-2">
                            <i class="bi bi-award me-2"></i>ISO 27001
                        </span>
                    </div>
                    <h2 class="fw-bold mb-3">Your Privacy is Our Promise</h2>
                    <p class="lead mb-4">
                        Zero-knowledge architecture means we can't access your messages even if we wanted to. 
                        Your conversations are yours alone.
                    </p>
                    <div class="security-features">
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                            <span>End-to-end encryption for all messages</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                            <span>Perfect forward secrecy with automatic key rotation</span>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                            <span>Minimal data retention and GDPR compliance</span>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-check-circle-fill text-success fs-5 me-3"></i>
                            <span>Regular third-party security audits</span>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left" data-aos-delay="200">
                    <div class="security-visual text-center">
                        <div class="security-shield position-relative d-inline-block">
                            <div class="shield-icon display-1 text-warning">
                                <i class="bi bi-shield-lock-fill"></i>
                            </div>
                            <div class="security-rings"></div>
                        </div>
                        <div class="mt-4">
                            <div class="badge bg-light text-dark px-3 py-2 me-2">AES-256</div>
                            <div class="badge bg-light text-dark px-3 py-2 me-2">TLS 1.3</div>
                            <div class="badge bg-light text-dark px-3 py-2">Zero Trust</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced App Preview Section -->
    <section class="py-5 bg-white">
        <div class="container">
            <div class="text-center mb-5">
                <div class="badge bg-info text-white px-3 py-2 fs-6 mb-3" data-aos="fade-up">
                    🎨 Beautiful Design
                </div>
                <h2 class="fw-bold mb-4" data-aos="fade-up" style="color: #333;">Experience {{ config('app.name') }} in Action</h2>
                <p class="text-muted mb-5" data-aos="fade-up" data-aos-delay="100">
                    A thoughtfully crafted interface that makes complex communication feel effortless
                </p>
            </div>

            <div class="row align-items-center">
                <div class="col-lg-8" data-aos="fade-right">
                    <!-- Desktop Preview -->
                    <div class="device-mockup desktop-mockup shadow-lg">
                        <div class="device-frame">
                            <div class="device-screen">
                                <img src="{{ asset('images/chatapp-desktop.png') }}" alt="ChatApp Desktop Interface" class="img-fluid">
                            </div>
                        </div>
                        <div class="feature-callouts">
                            <div class="callout callout-1" data-aos="fade-up" data-aos-delay="300" style="color: #333;">
                                <div class="callout-dot"></div>
                                <div class="callout-text">Real-time typing indicators</div>
                            </div>
                            <div class="callout callout-2" data-aos="fade-up" data-aos-delay="500" style="color: #333;">
                                <div class="callout-dot"></div>
                                <div class="callout-text">Rich media previews</div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-4" data-aos="fade-left" data-aos-delay="200">
                    <!-- Mobile Preview -->
                    <div class="device-mockup mobile-mockup shadow-lg mb-4">
                        <div class="device-frame">
                            <div class="device-screen">
                                <img src="{{ asset('images/chatapp-mobile.png') }}" alt="ChatApp Mobile Interface" class="img-fluid">
                            </div>
                        </div>
                    </div>
                    
                    <div class="preview-features">
                        <div class="feature-highlight mb-3">
                            <i class="bi bi-palette text-primary me-2"></i>
                            <span class="fw-medium" style="color: #333;">Dark & light themes</span>
                        </div>
                        <div class="feature-highlight mb-3">
                            <i class="bi bi-phone-vibrate text-success me-2"></i>
                            <span class="fw-medium" style="color: #333;">Smart notifications</span>
                        </div>
                        <div class="feature-highlight">
                            <i class="bi bi-cloud-arrow-up text-info me-2"></i>
                            <span class="fw-medium" style="color: #333;">Instant sync</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Testimonials Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <div class="badge bg-success text-white px-3 py-2 fs-6 mb-3" data-aos="fade-up">
                    💬 Customer Love
                </div>
                <h2 class="fw-bold mb-3" data-aos="fade-up">What Our Users Say</h2>
                <p class="text-muted" data-aos="fade-up" data-aos-delay="100">
                    Real feedback from teams who've transformed their communication
                </p>
            </div>
            
            <div class="row g-4">
                @php
                    $testimonials = [
                        [
                            'quote' => 'ChatApp replaced three different tools for our team. The security features give us peace of mind when discussing sensitive projects.',
                            'name' => 'Sarah Johnson',
                            'role' => 'CTO at TechFlow',
                            'company' => 'Series B Startup',
                            'avatar' => '👩‍💼',
                            'rating' => 5,
                            'highlight' => 'Security First'
                        ],
                        [
                            'quote' => 'The speed difference is incredible. Messages appear instantly, and the typing indicators actually work. Our remote team feels more connected.',
                            'name' => 'Marcus Chen',
                            'role' => 'Head of Engineering',
                            'company' => 'Remote-first company',
                            'avatar' => '👨‍💻',
                            'rating' => 5,
                            'highlight' => 'Lightning Fast'
                        ],
                        [
                            'quote' => 'Finally, a chat app that doesn\'t drain my battery or spam me with notifications. The smart alerts are a game-changer.',
                            'name' => 'Lisa Rodriguez',
                            'role' => 'Product Manager',
                            'company' => 'Fortune 500',
                            'avatar' => '👩‍🚀',
                            'rating' => 5,
                            'highlight' => 'Smart Notifications'
                        ],
                    ];
                @endphp

                @foreach ($testimonials as $i => $testimonial)
                    <div class="col-md-4" data-aos="fade-up" data-aos-delay="{{ $i * 150 }}">
                        <div class="card shadow-sm border-0 p-4 h-100 testimonial-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="testimonial-stars">
                                    @for ($j = 0; $j < $testimonial['rating']; $j++)
                                        <i class="bi bi-star-fill text-warning"></i>
                                    @endfor
                                </div>
                                <span class="badge bg-primary-subtle text-primary">{{ $testimonial['highlight'] }}</span>
                            </div>
                            <blockquote class="blockquote">
                                <p class="fst-italic">"{{ $testimonial['quote'] }}"</p>
                            </blockquote>
                            <div class="d-flex align-items-center mt-auto">
                                <div class="testimonial-avatar me-3">
                                    {{ $testimonial['avatar'] }}
                                </div>
                                <div>
                                    <h6 class="fw-bold mb-0">{{ $testimonial['name'] }}</h6>
                                    <small class="text-muted">{{ $testimonial['role'] }}</small>
                                    <br>
                                    <small class="text-muted">{{ $testimonial['company'] }}</small>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="text-center mt-5" data-aos="fade-up">
                <div class="testimonial-summary p-4 bg-white rounded-3 shadow-sm d-inline-block">
                    <div class="row g-4 text-center">
                        <div class="col-4">
                            <div class="fw-bold text-primary fs-4">4.9/5</div>
                            <small class="text-muted">Average rating</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-success fs-4">2,500+</div>
                            <small class="text-muted">Happy customers</small>
                        </div>
                        <div class="col-4">
                            <div class="fw-bold text-info fs-4">98%</div>
                            <small class="text-muted">Would recommend</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Enhanced Call to Action -->
    <section class="py-5 bg-gradient-primary text-white position-relative overflow-hidden">
        <div class="cta-bg position-absolute w-100 h-100 opacity-20"></div>
        <div class="container position-relative text-center">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="badge bg-warning text-dark px-3 py-2 fs-6 mb-4" data-aos="fade-up">
                        🚀 Ready to Launch?
                    </div>
                    <h2 class="fw-bold mb-4" data-aos="fade-up" data-aos-delay="100">
                        Transform Your Team Communication Today
                    </h2>
                    <p class="lead mb-5" data-aos="fade-up" data-aos-delay="200">
                        Join thousands of teams who've already discovered the power of truly secure, 
                        lightning-fast messaging. Setup takes less than 2 minutes.
                    </p>
                    
                    <div class="cta-buttons d-flex justify-content-center gap-3 flex-wrap mb-4" data-aos="fade-up" data-aos-delay="300">
                        <a href="{{ route('register') }}" class="btn btn-light btn-lg px-5 cta-primary">
                            <i class="bi bi-rocket-takeoff me-2"></i>
                            Start Free Trial
                            <span class="badge bg-success ms-2">No Credit Card</span>
                        </a>
                        <a href="{{ route('contact') }}" class="btn btn-outline-light btn-lg px-4">
                            <i class="bi bi-calendar-check me-2"></i>
                            Schedule Demo
                        </a>
                    </div>
                    
                    <div class="cta-guarantees d-flex justify-content-center flex-wrap gap-4 text-white-75" data-aos="fade-up" data-aos-delay="400">
                        <div class="guarantee-item">
                            <i class="bi bi-shield-check text-success me-2"></i>
                            30-day free trial
                        </div>
                        <div class="guarantee-item">
                            <i class="bi bi-arrow-clockwise text-info me-2"></i>
                            Cancel anytime
                        </div>
                        <div class="guarantee-item">
                            <i class="bi bi-headset text-warning me-2"></i>
                            24/7 support
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection

@push('styles')
    <style>
        /* Hero Background & Animation */
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

        .floating-elements {
            pointer-events: none;
        }

        .floating-circle, .floating-square {
            position: absolute;
            width: 60px;
            height: 60px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
        }

        .floating-square {
            border-radius: 10px;
        }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-20px); }
        }

        /* Hero Elements */
        .feature-pill {
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            padding: 8px 16px;
            border-radius: 25px;
            color: white;
            font-size: 0.9rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .hero-cta-primary {
            background: white !important;
            color: var(--bs-primary) !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .hero-cta-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.2) !important;
        }

        .hero-stats .stat-item {
            position: relative;
        }

        .stat-indicator {
            width: 4px;
            height: 4px;
            border-radius: 50%;
            margin: 0 auto;
            margin-top: 8px;
        }

        /* Feature Cards */
        .feature-card-enhanced {
            transition: all 0.3s ease;
            border: 1px solid transparent;
        }

        .feature-card-enhanced:hover {
            transform: translateY(-5px);
            border-color: var(--bs-primary);
        }

        .feature-icon-wrapper {
            position: relative;
        }

        .feature-icon-bg {
            width: 80px;
            height: 80px;
        }

        /* Counter Animation */
        .counter {
            color: var(--bs-primary);
        }

        /* Security Section */
        .security-shield {
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }

        .security-rings::before {
            content: '';
            position: absolute;
            top: -20px;
            left: -20px;
            right: -20px;
            bottom: -20px;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50%;
            animation: ring 3s infinite;
        }

        @keyframes ring {
            0% { transform: scale(1); opacity: 1; }
            100% { transform: scale(1.5); opacity: 0; }
        }

        /* Device Mockups */
        .desktop-mockup {
            position: relative;
            max-width: 600px;
        }

        .mobile-mockup {
            max-width: 280px;
            margin: 0 auto;
        }

        .device-frame {
            background: #333;
            padding: 20px;
            border-radius: 12px;
        }

        .device-screen {
            background: white;
            border-radius: 8px;
            overflow: hidden;
        }

        .callout {
            position: absolute;
            background: white;
            padding: 8px 12px;
            border-radius: 20px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            font-size: 0.85rem;
            font-weight: 500;
        }

        .callout-1 { top: 30%; right: -20px; }
        .callout-2 { bottom: 30%; right: -20px; }

        .callout-dot {
            width: 8px;
            height: 8px;
            background: var(--bs-primary);
            border-radius: 50%;
            position: absolute;
            left: -4px;
            top: 50%;
            transform: translateY(-50%);
        }

        /* Testimonials */
        .testimonial-card {
            transition: transform 0.3s ease;
        }

        .testimonial-card:hover {
            transform: translateY(-3px);
        }

        .testimonial-avatar {
            font-size: 2rem;
            line-height: 1;
        }

        /* Backgrounds */
        .bg-gradient-primary {
            background: linear-gradient(135deg, var(--bs-primary), var(--bs-info)) !important;
        }
    </style>
@endpush

@push('scripts')
    <!-- AOS (Animate on Scroll) -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    <script>
        AOS.init({
            duration: 800,
            once: true
        });

        // Counter Animation
        function animateCounter(element) {
            const target = parseInt(element.getAttribute('data-target'));
            const increment = target / 200;
            let current = 0;
            
            const timer = setInterval(() => {
                current += increment;
                if (current >= target) {
                    current = target;
                    clearInterval(timer);
                }
                element.textContent = Math.floor(current).toLocaleString();
            }, 10);
        }

        // Trigger counter animation when element comes into view
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    observer.unobserve(entry.target);
                }
            });
        });

        document.querySelectorAll('.counter').forEach(counter => {
            observer.observe(counter);
        });
    </script>
@endpush