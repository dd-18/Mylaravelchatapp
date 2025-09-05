@extends('layouts.public')

@section('title','Features')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">ChatApp Features</h1>
        <p class="text-muted fs-5">Explore the tools that make ChatApp the most reliable and secure messaging platform.</p>
    </div>

    <div class="row g-4">
        @php
            $features = [
                ['icon'=>'bi-chat-dots','title'=>'Real-Time Messaging','text'=>'Send and receive messages instantly with no delays.'],
                ['icon'=>'bi-shield-lock-fill','title'=>'End-to-End Encryption','text'=>'Your conversations are safe and private.'],
                ['icon'=>'bi-people-fill','title'=>'Group & Team Chats','text'=>'Create and manage chat groups effortlessly.'],
                ['icon'=>'bi-bell-fill','title'=>'Smart Notifications','text'=>'Stay updated with real-time alerts and typing indicators.'],
                ['icon'=>'bi-phone-fill','title'=>'Cross-Platform','text'=>'Chat on desktop, mobile, or tablet seamlessly.'],
                ['icon'=>'bi-emoji-smile','title'=>'Emojis & Media','text'=>'Express yourself with emojis, images, and file sharing.'],
            ];
        @endphp

        @foreach($features as $feature)
            <div class="col-md-4">
                <div class="card h-100 text-center shadow-sm border-0 p-4">
                    <div class="fs-1 text-primary mb-3"><i class="bi {{ $feature['icon'] }}"></i></div>
                    <h5 class="fw-bold">{{ $feature['title'] }}</h5>
                    <p class="text-muted">{{ $feature['text'] }}</p>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
