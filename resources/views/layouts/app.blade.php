<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

    <!-- Custom Chat Styles -->
    <style>
        body {
            background: #f5f7fb;
            font-family: 'Nunito', sans-serif;
        }

        .card {
            border-radius: 18px;
            overflow: hidden;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        }

        /* Chat messages */
        .chat-messages {
            flex: 1;
            overflow-y: auto;
            padding: 1rem;
            background-color: #fff;
        }

        /* Chat header */
        .chat-header {
            background: #fff;
            border-bottom: 1px solid #eee;
            padding: 10px 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .chat-header img {
            border-radius: 50%;
            border: 2px solid #eee;
            width: 40px;
            height: 40px;
        }

        .chat-header strong {
            font-size: 1rem;
            color: #333;
            text-transform: capitalize;
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
            background: linear-gradient(135deg, #4f93ff, #1c72e8);
            color: #fff;
            padding: 10px 14px;
            border-radius: 20px 20px 0 20px;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.08);
            max-width: 100%;
            word-wrap: break-word;
        }

        .chat-message-left .message-content {
            background: #f1f1f1;
            color: #333;
            padding: 10px 14px;
            border-radius: 20px 20px 20px 0;
            font-size: 14px;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
            max-width: 100%;
            word-wrap: break-word;
        }

        /* Timestamp */
        .timestamp {
            font-size: 11px;
            color: #999;
            margin-top: 4px;
            text-align: right;
        }

        /* Input area */
        .chat-input {
            background: #fff;
            border-top: 1px solid #eee;
            padding: 10px;
            display: relative;
            align-items: center;
            gap: 10px;
        }

        .chat-input input[type="text"] {
            border-radius: 20px;
            border: 1px solid #ccc;
            padding: 8px 14px;
            flex: 1;
        }

        .chat-input button.btn {
            border-radius: 20px;
            padding: 8px 16px;
        }

        /* Friend list */
        .friend-item {
            display: flex;
            align-items: center;
            padding: 10px;
            gap: 10px;
            border-radius: 12px;
            cursor: pointer;
            transition: background 0.2s ease;
        }

        .friend-item:hover {
            background: #f0f5ff;
        }

        .friend-item img {
            border-radius: 50%;
            width: 40px;
            height: 40px;
        }

        .friend-name {
            font-weight: 600;
            color: #333;
        }

        .friend-status {
            font-size: 12px;
            color: #888;
        }

        .chat-online {
            color: #31a24c;
        }

        .chat-offline {
            color: #ccc;
        }

        /* Image preview */
        #image-preview-container {
            padding: 10px;
            background: #f8f9fa;
            border-radius: 10px;
            border: 1px dashed #ddd;
        }

        /* Responsive */
        @media (max-width: 768px) {

            .chat-message-right .message-content,
            .chat-message-left .message-content {
                max-width: 90%;
            }
        }
    </style>
</head>

<body>
    <div id="app">
        <!-- Navbar -->
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand fw-bold fs-4" href="{{ url('/home') }}">
                    ChatApp
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left -->
                    <ul class="navbar-nav me-auto"></ul>

                    <!-- Right -->
                    <ul class="navbar-nav ms-auto">
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('home') }}">Home</a>
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                                    @if (Auth::check() && Auth::user()->is_admin)
                                        <a class="dropdown-item" href="{{ route('admin.dashboard') }}">Admin Panel</a>
                                    @endif
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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
