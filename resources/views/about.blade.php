@extends('layouts.public')

@section('title', 'About Us')

@section('content')
    <div class="container py-5">
        <div class="text-center mb-5">
            <h1 class="fw-bold">About {{ config('app.name', 'ChatApp') }}</h1>
            <p class="text-muted fs-5">{{ config('app.name', 'ChatApp') }} is your next-gen real-time messaging solution. Stay connected securely,
                instantly, and anywhere in the world.</p>
        </div>

        <div class="row g-4 mb-5">
            @php
                $features = [
                    ['title' => 'Real-Time Messaging', 'text' => 'Send and receive messages instantly with no delays.'],
                    ['title' => 'User Presence', 'text' => 'Know who’s online and available to chat.'],
                    ['title' => 'Typing Indicators', 'text' => 'See when someone is typing in real-time.'],
                    ['title' => 'Emojis & Media', 'text' => 'Share emotions, images, and files effortlessly.'],
                    ['title' => 'Profile Customization', 'text' => 'Personalize your account with avatars and bios.'],
                    ['title' => 'Admin Tools', 'text' => 'Advanced moderation tools keep the community safe.'],
                ];
            @endphp
            @foreach ($features as $feature)
                <div class="col-md-6">
                    <div class="card shadow-sm border-0 p-4 h-100">
                        <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                        <p>{{ $feature['text'] }}</p>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Mission</h2>
            <p class="text-muted fs-5">To provide a secure, reliable, and enjoyable messaging platform that connects people
                while safeguarding their privacy.</p>
        </div>

        <div class="text-center">
            <a href="{{ route('register') }}" class="btn btn-primary btn-lg">Join {{ config('app.name', 'ChatApp') }} Today</a>
        </div>
    </div>

@endsection
