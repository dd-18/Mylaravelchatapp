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

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Custom Chat Styles -->
    <style>
/* Chat container */
.chat-messages {
    max-height: 500px;
    overflow-y: auto;
    padding: 1rem;
    background-color: #f9f9f9;
}

/* Message bubble base */
.chat-message-right,
.chat-message-left {
    display: flex;
    margin-bottom: 1rem;
    align-items: flex-end;
}

/* User avatar */
.chat-message-right img,
.chat-message-left img {
    border-radius: 50%;
    width: 40px;
    height: 40px;
}

/* Message content container */
.chat-message-right .message-content,
.chat-message-left .message-content {
    max-width: 70%;
    padding: 10px 15px;
    border-radius: 20px;
    position: relative;
    font-size: 14px;
    line-height: 1.4;
}

/* Right bubble (current user) */
.chat-message-right {
    justify-content: flex-end;
}

.chat-message-right .message-content {
    background: #0d6efd; /* Bootstrap primary */
    color: white;
    border-bottom-right-radius: 0;
}

/* Left bubble (other user) */
.chat-message-left {
    justify-content: flex-start;
}

.chat-message-left .message-content {
    background: #e4e6eb;
    color: #050505;
    border-bottom-left-radius: 0;
}

/* Sender name */
.chat-message-right .sender-name,
.chat-message-left .sender-name {
    font-weight: 600;
    margin-bottom: 5px;
}

/* Timestamp styling */
.chat-message-right .timestamp,
.chat-message-left .timestamp {
    font-size: 11px;
    color: #888;
    margin-top: 4px;
    text-align: right;
}

/* Margin between avatar and message bubble */
.chat-message-right img {
    margin-left: 10px;
}

.chat-message-left img {
    margin-right: 10px;
}
</style>

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/home') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
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
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
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
    <!-- ✅ Load jQuery BEFORE Bootstrap -->
    
    {{-- jquery --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    {{-- socket.io --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/socket.io/4.8.1/socket.io.js"
        integrity="sha512-8BHxHDLsOHx+flIrQ0DrZcea7MkHqRU5GbTHmbdzMRnAaoCIkZ97PqZcXJkKZckMMhqfoeaJE+DNUVuyoQsO3Q=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.6/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

    @yield('scripts')
</body>

</html>
