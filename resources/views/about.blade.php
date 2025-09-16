@extends('layouts.public')

@section('title', 'About Us')
@section('meta_description',
    config('app.name', 'ChatApp') .
    ' — Learn about our mission, values, and the technology
    that powers secure, real-time messaging.')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">About {{ config('app.name', 'ChatApp') }}</h1>
            <p class="text-muted fs-5">
                {{ config('app.name', 'ChatApp') }} is a next-generation real-time messaging platform built for security,
                performance, and ease of use. Whether you're coordinating a team, running a community, or chatting with
                friends, we make communication instant and reliable.
            </p>
            <div class="badge bg-primary-subtle text-primary px-3 py-2 fs-6 mt-3">
                🚀 Trusted by 10,000+ users worldwide
            </div>
        </div>

        <!-- Enhanced Features Grid -->
        <div class="row g-4 mb-5">
            @php
                $features = [
                    [
                        'icon' => '⚡',
                        'title' => 'Real-Time Messaging', 
                        'text' => 'Messages delivered in under 100ms with WebSocket technology. No delays, no missed connections.',
                        'highlight' => 'Sub-second delivery'
                    ],
                    [
                        'icon' => '👀',
                        'title' => 'Smart Presence',
                        'text' => 'Advanced presence indicators show who\'s online, away, busy, or active. Know the perfect time to reach out.',
                        'highlight' => 'Real-time status'
                    ],
                    [
                        'icon' => '✍️',
                        'title' => 'Live Typing Indicators',
                        'text' => 'See when teammates are crafting replies with elegant, non-intrusive typing animations.',
                        'highlight' => 'Enhanced UX'
                    ],
                    [
                        'icon' => '🎨',
                        'title' => 'Rich Media & Emojis',
                        'text' => 'Express yourself with 3000+ emojis, drag-and-drop file sharing, and instant image previews.',
                        'highlight' => 'Full expression'
                    ],
                    [
                        'icon' => '🎭',
                        'title' => 'Profile Personalization',
                        'text' => 'Custom avatars, status messages, bios, and themes. Make your digital presence uniquely yours.',
                        'highlight' => 'Your style'
                    ],
                    [
                        'icon' => '🛡️',
                        'title' => 'Advanced Admin Tools',
                        'text' => 'Comprehensive moderation suite with role management, content filtering, and community safety features.',
                        'highlight' => 'Enterprise-ready'
                    ],
                ];
            @endphp
            @foreach ($features as $feature)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 p-4 h-100 feature-card">
                        <div class="d-flex align-items-start">
                            <div class="feature-icon me-3 fs-1">{{ $feature['icon'] }}</div>
                            <div class="flex-grow-1">
                                <div class="d-flex justify-content-between align-items-start mb-2">
                                    <h5 class="fw-bold mb-0">{{ $feature['title'] }}</h5>
                                    <span class="badge bg-success-subtle text-success small">{{ $feature['highlight'] }}</span>
                                </div>
                                <p class="mb-0 text-muted">{{ $feature['text'] }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <!-- Enhanced Mission Section -->
        <div class="text-center mb-5">
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <h2 class="fw-bold mb-4">Our Mission</h2>
                    <div class="card bg-primary-subtle border-0 p-4 mb-4">
                        <blockquote class="blockquote mb-0 text-center">
                            <p class="fs-4 fw-medium text-primary mb-3">
                                "To democratize secure communication and create a world where privacy isn't a luxury, but a fundamental right."
                            </p>
                        </blockquote>
                    </div>
                    <p class="text-muted fs-5">
                        We're building more than just a messaging app — we're crafting the future of digital communication. 
                        Our platform empowers individuals and organizations to connect authentically while maintaining complete 
                        control over their data and conversations.
                    </p>
                    <p class="text-muted fs-5">
                        Every feature we develop, every decision we make, is guided by three core principles: 
                        <strong class="text-primary">uncompromising security</strong>, 
                        <strong class="text-success">lightning-fast performance</strong>, and 
                        <strong class="text-warning">intuitive design</strong>. 
                        We believe technology should enhance human connection, not complicate it.
                    </p>
                </div>
            </div>
        </div>

        <!-- Enhanced Story Section -->
        <div class="mb-5">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <h2 class="fw-bold mb-4">Our Journey</h2>
                    <div class="timeline-story">
                        <div class="story-milestone mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-primary rounded-pill me-2">2023</span>
                                <h5 class="mb-0">The Beginning</h5>
                            </div>
                            <p class="text-muted mb-0">
                                Born from frustration with fragmented, insecure messaging platforms. Our founders, 
                                experienced developers from tech giants, envisioned something better.
                            </p>
                        </div>
                        
                        <div class="story-milestone mb-4">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-success rounded-pill me-2">2024</span>
                                <h5 class="mb-0">The Breakthrough</h5>
                            </div>
                            <p class="text-muted mb-0">
                                Achieved sub-100ms message delivery and implemented military-grade encryption 
                                without sacrificing user experience. First 1,000 users joined our private beta.
                            </p>
                        </div>
                        
                        <div class="story-milestone">
                            <div class="d-flex align-items-center mb-2">
                                <span class="badge bg-warning rounded-pill me-2">2025</span>
                                <h5 class="mb-0">Global Scale</h5>
                            </div>
                            <p class="text-muted mb-0">
                                Now serving 10,000+ users across 50+ countries. From startup teams to Fortune 500 
                                companies, organizations trust us with their most sensitive communications.
                            </p>
                        </div>
                    </div>
                </div>
                
                <div class="col-lg-6">
                    <div class="card bg-light border-0 p-4">
                        <h5 class="fw-bold mb-3">By the Numbers</h5>
                        <div class="row g-3">
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="display-6 fw-bold text-primary">99.99%</div>
                                    <small class="text-muted">Uptime achieved</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="display-6 fw-bold text-success">50ms</div>
                                    <small class="text-muted">Avg message latency</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="display-6 fw-bold text-info">24/7</div>
                                    <small class="text-muted">Security monitoring</small>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="text-center">
                                    <div class="display-6 fw-bold text-warning">0</div>
                                    <small class="text-muted">Data breaches ever</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Values Section -->
        <div class="row g-4 text-center mb-5">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4 h-100 value-card">
                    <div class="display-1 mb-3">🚀</div>
                    <h5 class="fw-bold">Relentless Innovation</h5>
                    <p class="mb-0 text-muted">
                        We ship new features weekly and constantly push the boundaries of what's possible in real-time communication.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4 h-100 value-card">
                    <div class="display-1 mb-3">🔒</div>
                    <h5 class="fw-bold">Privacy First</h5>
                    <p class="mb-0 text-muted">
                        Zero-knowledge architecture means we can't read your messages even if we wanted to. Your data belongs to you, period.
                    </p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow-sm border-0 p-4 h-100 value-card">
                    <div class="display-1 mb-3">🌍</div>
                    <h5 class="fw-bold">Global Community</h5>
                    <p class="mb-0 text-muted">
                        Building bridges across cultures and time zones. Every voice matters in our inclusive digital space.
                    </p>
                </div>
            </div>
        </div>

        <!-- Enhanced Technical Excellence Section -->
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100 tech-card">
                    <div class="d-flex align-items-center mb-3">
                        <span class="display-6 me-3">🛡️</span>
                        <h5 class="fw-bold mb-0">Military-Grade Security</h5>
                    </div>
                    <p class="mb-3 text-muted">
                        AES-256 encryption, perfect forward secrecy, and zero-knowledge architecture. 
                        We've implemented security protocols used by intelligence agencies.
                    </p>
                    <ul class="list-unstyled small text-success">
                        <li>✓ End-to-end encryption by default</li>
                        <li>✓ Automatic key rotation</li>
                        <li>✓ Minimal data retention policy</li>
                        <li>✓ Regular third-party security audits</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100 tech-card">
                    <div class="d-flex align-items-center mb-3">
                        <span class="display-6 me-3">⚡</span>
                        <h5 class="fw-bold mb-0">Lightning Performance</h5>
                    </div>
                    <p class="mb-3 text-muted">
                        Distributed infrastructure with edge caching and optimized protocols. 
                        Messages travel at the speed of thought, not internet latency.
                    </p>
                    <ul class="list-unstyled small text-info">
                        <li>✓ Global CDN with 100+ edge locations</li>
                        <li>✓ Auto-scaling WebSocket clusters</li>
                        <li>✓ Intelligent message routing</li>
                        <li>✓ 99.99% guaranteed uptime</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Enhanced Core Values Stats -->
        <div class="text-center mb-5">
            <h2 class="fw-bold mb-4">Why Teams Choose {{ config('app.name', 'ChatApp') }}</h2>
            <p class="text-muted fs-5 mb-4">
                Security, Simplicity, and Speed — because meaningful communication should be effortless and safe.
            </p>

            <div class="row g-4 justify-content-center">
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center p-3">
                        <h3 class="fw-bold mb-1 text-primary">10,000+</h3>
                        <small class="text-muted">Happy Users</small>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center p-3">
                        <h3 class="fw-bold mb-1 text-success">99.99%</h3>
                        <small class="text-muted">Uptime SLA</small>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-success" style="width: 99%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center p-3">
                        <h3 class="fw-bold mb-1 text-info">50ms</h3>
                        <small class="text-muted">Avg Latency</small>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-info" style="width: 95%"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6">
                    <div class="stat-card text-center p-3">
                        <h3 class="fw-bold mb-1 text-warning">AES-256</h3>
                        <small class="text-muted">Encryption</small>
                        <div class="progress mt-2" style="height: 4px;">
                            <div class="progress-bar bg-warning" style="width: 100%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Enhanced Team Section -->
        <div class="text-center mb-4">
            <h2 class="fw-bold">Meet Our Team</h2>
            <p class="text-muted">Passionate engineers and designers from leading tech companies, united by a vision for better communication.</p>
        </div>

        <div class="row g-3 mb-4 justify-content-center">
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm p-3 team-card">
                    <div class="rounded-circle bg-secondary mx-auto mb-3 position-relative" style="width:64px;height:64px;">
                        <img src="{{ asset('images/user2.jpg') }}" alt="Lead Engineer"
                            class="w-100 h-100 rounded-circle object-fit-cover" />
                        <span class="badge bg-success position-absolute bottom-0 end-0 rounded-pill"
                              style="width: 16px; height: 16px;"></span>
                    </div>
                    <h6 class="mb-0 fw-bold">Sarah Chen</h6>
                    <small class="text-muted">Lead Engineer</small>
                    <div class="text-muted small mt-1">Ex-Google, MIT CS</div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm p-3 team-card">
                    <div class="rounded-circle bg-secondary mx-auto mb-3 position-relative" style="width:64px;height:64px;">
                        <img src="{{ asset('images/user1.jpg') }}" alt="Product Designer"
                            class="w-100 h-100 rounded-circle object-fit-cover" />
                        <span class="badge bg-success position-absolute bottom-0 end-0 rounded-pill"
                              style="width: 16px; height: 16px;"></span>
                    </div>
                    <h6 class="mb-0 fw-bold">Marcus Kim</h6>
                    <small class="text-muted">Design Lead</small>
                    <div class="text-muted small mt-1">Ex-Apple, RISD</div>
                </div>
            </div>
        </div>

        <!-- Call to Action Enhancement -->
        <div class="text-center">
            <div class="card bg-primary text-white p-4 border-0 shadow-lg">
                <h3 class="fw-bold mb-3">Ready to Transform Your Communication?</h3>
                <p class="mb-4">Join thousands of teams who've already made the switch to secure, lightning-fast messaging.</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="{{ route('register') }}" class="btn btn-light btn-lg px-4">
                        Start Free Trial
                        <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="{{ route('features') }}" class="btn btn-outline-light btn-lg px-4">
                        Explore Features
                    </a>
                </div>
                <p class="text-white-50 small mt-3 mb-0">
                    For enterprise solutions and custom deployments, 
                    <a href="{{ route('contact') }}" class="text-white text-decoration-underline">contact our sales team</a>.
                </p>
            </div>
        </div>
    </div>

    @push('styles')
    <style>
        .feature-card:hover {
            transform: translateY(-2px);
            transition: transform 0.2s ease;
        }
        
        .feature-icon {
            filter: drop-shadow(0 2px 4px rgba(0,0,0,0.1));
        }
        
        .value-card:hover {
            transform: scale(1.02);
            transition: transform 0.2s ease;
        }
        
        .tech-card {
            background: linear-gradient(135deg, #f8f9fa 0%, #ffffff 100%);
            border-left: 4px solid var(--bs-primary);
        }
        
        .team-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0,0,0,0.1) !important;
            transition: all 0.3s ease;
        }
        
        .stat-card {
            background: rgba(255, 255, 255, 0.8);
            border-radius: 8px;
            backdrop-filter: blur(10px);
        }
        
        .timeline-story {
            border-left: 3px solid var(--bs-primary);
            padding-left: 1.5rem;
        }
        
        .story-milestone {
            position: relative;
        }
        
        .story-milestone::before {
            content: '';
            position: absolute;
            left: -1.875rem;
            top: 0.5rem;
            width: 12px;
            height: 12px;
            background: var(--bs-primary);
            border-radius: 50%;
            border: 3px solid white;
            box-shadow: 0 0 0 3px var(--bs-primary);
        }
    </style>
    @endpush

@endsection