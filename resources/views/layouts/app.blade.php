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
    <link href="https://fonts.bunny.net/css?family=Inter:400,500,600,700&display=swap" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Chat Styles -->
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --gray-50: #f9fafb;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #374151;
            --gray-800: #1f2937;
            --gray-900: #111827;
            --white: #ffffff;
            --green: #10b981;
            --border: #e5e7eb;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
            --shadow-lg: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        body {
            background: var(--gray-50);
            font-family: 'Inter', sans-serif;
            min-height: 100vh;
            color: var(--gray-800);
        }

        /* Navbar */
        .navbar {
            background: var(--white) !important;
            border-bottom: 1px solid var(--border);
            box-shadow: var(--shadow);
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary) !important;
        }

        .nav-link {
            color: var(--gray-600) !important;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .nav-link:hover {
            color: var(--primary) !important;
        }

        /* User Profile in Navbar */
        .navbar-user-profile {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--gray-700) !important;
            text-decoration: none;
            font-weight: 500;
            padding: 0.5rem;
            border-radius: 8px;
            transition: all 0.2s ease;
        }

        .navbar-user-profile:hover {
            background: var(--gray-100);
            color: var(--gray-800) !important;
            text-decoration: none;
        }

        .navbar-profile-image {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid var(--border);
            transition: border-color 0.2s ease;
        }

        .navbar-user-profile:hover .navbar-profile-image {
            border-color: var(--primary);
        }

        .navbar-profile-fallback {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--gray-200);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--gray-600);
            font-size: 1rem;
            border: 2px solid var(--border);
            transition: all 0.2s ease;
        }

        .navbar-user-profile:hover .navbar-profile-fallback {
            background: var(--primary);
            color: var(--white);
            border-color: var(--primary);
        }

        .dropdown-menu {
            border: 1px solid var(--border);
            border-radius: 8px;
            box-shadow: var(--shadow-lg);
            padding: 0.5rem 0;
            margin-top: 0.5rem;
        }

        .dropdown-item {
            color: var(--gray-700);
            padding: 0.5rem 1rem;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
        }

        .dropdown-item:hover {
            background: var(--gray-100);
            color: var(--gray-800);
        }

        .dropdown-item.text-danger {
            color: #dc3545 !important;
        }

        .dropdown-item.text-danger:hover {
            background: #dc3545 !important;
            color: var(--white) !important;
        }

        .dropdown-divider {
            margin: 0.5rem 0;
            border-color: var(--border);
        }

        /* Cards */
        .card {
            border-radius: 12px;
            background: var(--white);
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            overflow: hidden;
        }

        /* Message Actions */
        .chat-message-right:hover .message-actions,
        .chat-message-left:hover .message-actions {
            display: block !important;
        }

        .message-actions .btn {
            border-radius: 50%;
            width: 28px;
            height: 28px;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            margin-left: 2px;
            background: white;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .message-actions .btn:hover {
            transform: scale(1.1);
        }

        .message-edit-mode {
            background: #fff3cd !important;
            border: 1px solid #ffeaa7 !important;
        }

        .edit-input {
            background: transparent;
            border: none;
            outline: none;
            width: 100%;
            color: inherit;
            font-size: inherit;
        }


        /* Chat Messages */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            background: var(--white);
            border-radius: 12px;
        }

        /* Chat Header */
        .chat-header {
            background: var(--gray-100);
            border-bottom: 1px solid var(--border);
            padding: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .chat-header img {
            border-radius: 50%;
            border: 2px solid var(--border);
            width: 42px;
            height: 42px;
        }

        .chat-header strong {
            font-size: 1.1rem;
            color: var(--gray-800);
            font-weight: 600;
        }

        /* Message Bubbles */
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
            background: var(--primary);
            color: var(--white);
            padding: 0.75rem 1rem;
            border-radius: 18px 18px 4px 18px;
            font-size: 0.95rem;
            max-width: 100%;
            word-wrap: break-word;
            box-shadow: var(--shadow);
        }

        .chat-message-left .message-content {
            background: var(--gray-100);
            color: var(--gray-800);
            padding: 0.75rem 1rem;
            border-radius: 18px 18px 18px 4px;
            font-size: 0.95rem;
            max-width: 100%;
            word-wrap: break-word;
            box-shadow: var(--shadow);
        }

        /* Timestamp */
        .timestamp {
            font-size: 0.75rem;
            color: #9da4b4;
            margin-top: 0.25rem;
            text-align: right;
        }

        /* Chat Input */
        .chat-input {
            background: var(--white);
            border-top: 1px solid var(--border);
            padding: 1rem;
            display: relative;
            align-items: center;
            gap: 0.75rem;
        }

        .typing-in {
            font-size: 0.85rem;
            color: #4caf50;
            /* Green typing text */
            font-style: italic;
            height: 18px;
            /* Reserve space to avoid layout shift */
            margin-top: 2px;
        }

        .chat-input input[type="text"] {
            border-radius: 24px;
            border: 1px solid var(--border);
            padding: 0.75rem 1rem;
            flex: 1;
            font-size: 0.95rem;
            transition: all 0.2s ease;
            background: var(--white);
        }

        .chat-input input[type="text"]:focus {
            border-color: var(--primary);
            outline: none;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .chat-input button.btn {
            border-radius: 50%;
            width: 50px;
            height: 45px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--primary);
            color: var(--white);
            border: none;
            transition: all 0.2s ease;
        }

        .chat-input button.btn:hover {
            background: var(--primary-dark);
            transform: translateY(-1px);
        }

        .message-status {
            font-size: 12px;
            color: #64748b;
            margin-left: 5px;
        }

        .status-sent {
            color: #64748b;
        }

        .status-delivered {
            color: #10b981;
        }

        .status-read {
            color: #3b82f6;
        }


        /* Friend List */
        .friend-item {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            gap: 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .friend-item:hover {
            background: var(--gray-100);
        }

        .friend-item img {
            border-radius: 50%;
            width: 42px;
            height: 42px;
            border: 2px solid var(--border);
        }

        .friend-name {
            font-weight: 600;
            color: var(--gray-800);
            text-transform: capitalize;
        }

        .friend-status {
            font-size: 0.8rem;
            color: var(--gray-500);
        }

        .chat-online {
            color: var(--green);
        }

        .chat-offline {
            color: var(--gray-300);
        }

        /* Image Preview */
        #image-preview-container {
            padding: 1rem;
            background: var(--gray-100);
            border-radius: 8px;
            border: 2px dashed var(--border);
            text-align: center;
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
            color: var(--gray-800);
        }

        .about-hero p {
            color: var(--gray-600);
            font-size: 1.1rem;
        }

        .about-features .card {
            transition: all 0.2s ease;
        }

        .about-features .card:hover {
            transform: translateY(-2px);
            box-shadow: var(--shadow-lg);
        }

        @keyframes bounce {

            0%,
            100% {
                transform: translateY(0);
            }

            50% {
                transform: translateY(-5px);
            }
        }

        .animate-bounce {
            animation: bounce 0.5s ease infinite;
        }

        /* Scale-up effect for updates */
        .scale-up {
            transform: scale(1.3);
            transition: transform 0.3s ease;
        }

        @keyframes flash {
            0% {
                transform: scale(1);
                background-color: #dc3545;
            }

            50% {
                transform: scale(1.3);
                background-color: #ff6b6b;
            }

            100% {
                transform: scale(1);
                background-color: #dc3545;
            }
        }

        .flash-badge {
            animation: flash 0.5s ease;
        }

        /* Responsive Design */
        @media (max-width: 768px) {

            .chat-message-right .message-content,
            .chat-message-left .message-content {
                max-width: 85%;
            }

            .navbar-brand {
                font-size: 1.25rem;
            }

            .chat-input {
                padding: 0.75rem;
            }

            .chat-header {
                padding: 0.75rem;
            }

            .navbar-user-profile {
                padding: 0.25rem;
            }

            .navbar-profile-image,
            .navbar-profile-fallback {
                width: 28px;
                height: 28px;
            }
        }

        @media (max-width: 576px) {

            .chat-message-right .message-content,
            .chat-message-left .message-content {
                max-width: 90%;
                font-size: 0.9rem;
            }

            .about-hero h1 {
                font-size: 2rem;
            }
        }

        /* Utilities */
        .text-primary {
            color: var(--primary) !important;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .border-primary {
            border-color: var(--primary) !important;
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white">
            <div class="container">
                <a class="navbar-brand fw-bold" href="{{ url('/home') }}">
                    <i class="fa-brands fa-rocketchat me-2"></i>ChatApp
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('home') }}">
                                <i class="fa-solid fa-house me-1"></i>Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('about') }}">
                                <i class="fa-solid fa-circle-info me-1"></i>About Us
                            </a>
                        </li>
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">
                                        <i class="fa-solid fa-right-to-bracket me-1"></i>Login
                                    </a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">
                                        <i class="fa-solid fa-user-plus me-1"></i>Register
                                    </a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="navbar-user-profile dropdown-toggle" href="#"
                                    role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"
                                    v-pre>
                                    @if (Auth::user()->user_image)
                                        <img src="{{ asset('storage/users/' . Auth::user()->user_image) }}"
                                            alt="{{ Auth::user()->name }}" class="navbar-profile-image">
                                    @else
                                        <div class="navbar-profile-fallback">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                    @endif
                                    <span style="text-transform: capitalize;">{{ Auth::user()->name }}</span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">
                                        <i class="fa-solid fa-house me-2"></i>Home
                                    </a>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        <i class="fa-solid fa-user-pen me-2"></i>Edit Profile
                                    </a>
                                    @if (Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                            <i class="fa-solid fa-gauge me-2"></i>Admin Panel
                                        </a>
                                    @endif
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item text-danger" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        <i class="fa-solid fa-right-from-bracket me-2"></i>Logout
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
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.bundle.js"></script>

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
