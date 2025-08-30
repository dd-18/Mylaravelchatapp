<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/893/893257.png">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito:400,600,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Chat Styles -->
    <style>
        body {
            background: linear-gradient(135deg, #f9fbfd, #eef3f9);
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
        }

        .navbar {
            border-bottom: 1px solid #e6e9f2;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: #2563eb !important;
        }

        .card {
            border-radius: 18px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 6px 24px rgba(0, 0, 0, 0.08);
        }

        /* Chat messages */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            background: #fff;
            border-radius: 16px;
        }

        /* Chat header */
        .chat-header {
            background: #f9fafc;
            border-bottom: 1px solid #eee;
            padding: 12px 16px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .chat-header img {
            border-radius: 50%;
            border: 2px solid #e2e8f0;
            width: 42px;
            height: 42px;
        }

        .chat-header strong {
            font-size: 1.05rem;
            color: #1e293b;
            font-weight: 600;
        }

        /* Message bubbles */
        .chat-message-right,
        .chat-message-left {
            display: flex;
            margin-bottom: 1rem;
            align-items: flex-end;
        }

        .chat-message-right {
            justify-content: flex-end;
        }

        .chat-message-left {
            justify-content: flex-start;
        }

        .chat-message-right .message-content {
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            padding: 10px 14px;
            border-radius: 20px 20px 4px 20px;
            font-size: 14px;
            box-shadow: 0 3px 8px rgba(37, 99, 235, 0.2);
            max-width: 100%;
            word-wrap: break-word;
        }

        .chat-message-left .message-content {
            background: #f1f5f9;
            color: #1e293b;
            padding: 10px 14px;
            border-radius: 20px 20px 20px 4px;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            max-width: 100%;
            word-wrap: break-word;
        }

        /* Timestamp */
        .timestamp {
            font-size: 11px;
            color: #94a3b8;
            margin-top: 4px;
            text-align: right;
        }

        /* Input area */
        .chat-input {
            background: #fff;
            border-top: 1px solid #e2e8f0;
            padding: 12px;
            display: relative;
            align-items: center;
            gap: 10px;
        }

        .chat-input input[type="text"] {
            border-radius: 20px;
            border: 1px solid #cbd5e1;
            padding: 10px 16px;
            flex: 1;
            font-size: 14px;
            transition: all 0.2s ease;
        }

        .chat-input input[type="text"]:focus {
            border-color: #2563eb;
            outline: none;
            box-shadow: 0 0 0 3px rgba(37, 99, 235, 0.15);
        }

        .chat-input button.btn {
            border-radius: 50%;
            width: 50px;
            height: 42px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #2563eb, #1e40af);
            color: #fff;
            box-shadow: 0 4px 10px rgba(37, 99, 235, 0.3);
            border: none;
            transition: transform 0.15s ease;
        }

        .chat-input button.btn:hover {
            transform: scale(1.05);
        }

        /* Friend list */
        .friend-item {
            display: flex;
            align-items: center;
            padding: 10px;
            gap: 12px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .friend-item:hover {
            background: #f1f5ff;
        }

        .friend-item img {
            border-radius: 50%;
            width: 42px;
            height: 42px;
        }

        .friend-name {
            font-weight: 900;
            color: #1e293b;
            text-transform: capitalize;
        }

        .friend-status {
            font-size: 12px;
            color: #64748b;
        }

        .chat-online {
            color: #22c55e;
        }

        .chat-offline {
            color: #cbd5e1;
        }

        /* Image preview */
        #image-preview-container {
            padding: 10px;
            background: #909193;
            border-radius: 10px;
            border: 1px dashed #cbd5e1;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .chat-message-right .message-content,
            .chat-message-left .message-content {
                max-width: 90%;
            }
        }

        /* About Page Styles */
        .about-hero {
            text-align: center;
            margin-bottom: 3rem;
        }

        .about-hero h1 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .about-hero p {
            color: #64748b;
            font-size: 1.1rem;
        }

        .about-features .card {
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .about-features .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 12px 32px rgba(0, 0, 0, 0.12);
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4" href="{{ url('/home') }}">
                    <i class="fa-brands fa-rocketchat"></i> ChatApp
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fa-solid fa-house me-1"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">
                                <i class="fa-solid fa-circle-info me-1"></i> About Us
                            </a>
                        </li>
                    </ul>

                    <!-- Right -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket me-1"></i> Login
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa-solid fa-user-plus me-1"></i> Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa-solid fa-user-circle me-1"></i> {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end shadow-sm" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        <i class="fa-solid fa-house me-1"></i> Home
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fa-solid fa-user-pen me-1"></i> Edit Profile
                                    </a>
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fa-solid fa-gauge me-1"></i> Admin Panel
                                        </a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-1"></i> Logout
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>

            </div>
        </nav>

        <!-- Main Content -->
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- jQuery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

    <!-- Socket.io -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.8.1/socket.io.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.min.js"></script>

    <!-- Push.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/push.js/1.0.12/push.min.js" crossorigin="anonymous"
        referrerpolicy="no-referrer"></script>

    <script>
        window.addEventListener('load', function() {
            if (typeof Push === 'undefined') {
                console.error('Push.js failed to load');
            } else {
                console.log('Push.js loaded. Permission:', Push.Permission.get());
            }
        });
    </script>

    @yield('scripts')
</body>

</html>
