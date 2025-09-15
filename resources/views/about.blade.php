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
                friends,
                we make communication instant and reliable.
            </p>
        </div>

        <div class="row g-4 mb-5">
            @php
                $features = [
                    ['title' => 'Real-Time Messaging', 'text' => 'Send and receive messages instantly with no delays.'],
                    [
                        'title' => 'User Presence',
                        'text' => 'See who’s online, away or active so you know when to reach out.',
                    ],
                    [
                        'title' => 'Typing Indicators',
                        'text' => 'Understand when someone is composing a reply with subtle indicators.',
                    ],
                    [
                        'title' => 'Emojis & Media',
                        'text' => 'Share emotions, images, and files effortlessly with drag & drop support.',
                    ],
                    [
                        'title' => 'Profile Customization',
                        'text' => 'Personalize your account with avatars, status messages, and bios.',
                    ],
                    [
                        'title' => 'Admin Tools',
                        'text' => 'Robust moderation and role tools help keep communities safe and organized.',
                    ],
                ];
            @endphp
            @foreach ($features as $feature)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                        <p class="mb-0">{{ $feature['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Mission</h2>
            <p class="text-muted fs-5">
                To provide a secure, reliable, and delightful messaging platform that empowers people to communicate freely
                while protecting their privacy.
            </p>
        </div>

        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Story</h2>
            <p class="text-muted fs-5">
                Founded by a team of passionate developers, {{ config('app.name', 'ChatApp') }} started as a small project
                to simplify communication.
                Today, we serve thousands of people who rely on fast, private, and delightful conversations every day.
            </p>
        </div>

        <div class="row g-4 text-center">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100">
                    <h5 class="fw-bold">Innovation</h5>
                    <p class="mb-0">
                        We constantly evolve to deliver cutting-edge chat experiences.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100">
                    <h5 class="fw-bold">Privacy</h5>
                    <p class="mb-0">
                        Your data and conversations always remain confidential and protected.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100">
                    <h5 class="fw-bold">Community</h5>
                    <p class="mb-0">
                        We believe in creating a safe, welcoming space for everyone.
                    </p>
                </div>
            </div>
        </div>
        <br>
        <div class="row g-4 mb-5">
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100">
                    <h5 class="fw-bold">Security & Privacy Commitment</h5>
                    <p class="mb-0">
                        End-to-end encryption by default, modern cryptography, and minimal data retention are our guiding
                        principles.
                        We design systems so users retain control of their conversations and personal data.
                    </p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card shadow-sm border-0 p-4 h-100">
                    <h5 class="fw-bold">Reliability & Performance</h5>
                    <p class="mb-0">
                        Our architecture is optimized for low latency and horizontal scalability — delivering messages in
                        milliseconds while
                        supporting thousands of concurrent connections.
                    </p>
                </div>
            </div>
        </div>

        <div class="text-center mb-5">
            <h2 class="fw-bold">Core Values</h2>
            <p class="text-muted fs-5">
                We focus on Security, Simplicity, and Speed — because meaningful communication should be effortless and
                safe.
            </p>

            <div class="d-flex justify-content-center gap-4 flex-wrap mt-4">
                <div class="text-center">
                    <h3 class="fw-bold mb-0">10k+</h3>
                    <small class="text-muted">Active users</small>
                </div>
                <div class="text-center">
                    <h3 class="fw-bold mb-0">99.99%</h3>
                    <small class="text-muted">Uptime target</small>
                </div>
                <div class="text-center">
                    <h3 class="fw-bold mb-0">End-to-End</h3>
                    <small class="text-muted">Encryption by default</small>
                </div>
            </div>
        </div>

        <div class="text-center mb-4">
            <h2 class="fw-bold">Team & Contributors</h2>
            <p class="text-muted">A small team of engineers and designers passionate about privacy-first communication.</p>
        </div>

        <div class="row g-3 mb-4 justify-content-center">
            <!-- Minimal team preview; keep layout simple and non-intrusive -->
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm p-3">
                    <div class="rounded-circle bg-secondary mx-auto mb-3" style="width:64px;height:64px;"></div>
                    <h6 class="mb-0 fw-bold">Lead Engineer</h6>
                    <small class="text-muted">System Architecture</small>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card text-center border-0 shadow-sm p-3">
                    <div class="rounded-circle bg-secondary mx-auto mb-3" style="width:64px;height:64px;"></div>
                    <h6 class="mb-0 fw-bold">Product Designer</h6>
                    <small class="text-muted">Design & UX</small>
                </div>
            </div>
        </div>

        <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Join {{ config('app.name', 'ChatApp') }}
                Today</a>
            <p class="text-muted small mt-3 mb-0">For enterprise inquiries, contact us via the Contact page and select
                "Sales / Partnerships".</p>
        </div>
    </div>

@endsection
