<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', config('app.name', 'ChatApp'))</title>

    <!-- Favicon -->
    <link rel="icon" href="https://cdn-icons-png.flaticon.com/512/893/893257.png" type="image/png">

    <!-- Bootstrap CSS & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">

    @stack('styles')
</head>

<body class="d-flex flex-column min-vh-100 bg-light text-dark">

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top">
        <div class="container">
            <a class="navbar-brand fw-bold text-primary" href="{{ route('welcome') }}">
                <i class="bi bi-chat-dots me-1"></i> {{ config('app.name', 'ChatApp') }}
            </a>
            <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-lg-center">
                    <li class="nav-item">
                        <a href="{{ route('welcome') }}"
                            class="nav-link {{ request()->routeIs('welcome') ? 'active text-primary fw-bold' : '' }}">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('about') }}"
                            class="nav-link {{ request()->routeIs('about') ? 'active text-primary fw-bold' : '' }}">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('features') }}"
                            class="nav-link {{ request()->routeIs('features') ? 'active text-primary fw-bold' : '' }}">
                            Features
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('faq') }}"
                            class="nav-link {{ request()->routeIs('faq') ? 'active text-primary fw-bold' : '' }}">
                            FAQ
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('contact') }}"
                            class="nav-link {{ request()->routeIs('contact') ? 'active text-primary fw-bold' : '' }}">
                            Contact
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{ route('pricing') }}" class="nav-link">Pricing</a>
                    </li>
                    <li class="nav-item">
                        <button id="themeToggle" class="btn btn-sm btn-outline-secondary ms-lg-3 mt-2 mt-lg-0">
                            <i class="bi bi-moon-fill"></i>
                        </button>
                    </li>
                    @guest
                        <li class="nav-item">
                            <a href="{{ route('login') }}"
                                class="nav-link {{ request()->routeIs('login') ? 'active text-primary fw-bold' : '' }}">
                                Login
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="btn btn-primary ms-lg-3 mt-2 mt-lg-0 px-4">
                                Register
                            </a>
                        </li>
                    @else
                        <li class="nav-item">
                            <a href="{{ route('home') }}"
                                class="nav-link {{ request()->routeIs('home') ? 'active text-primary fw-bold' : '' }}">
                                Dashboard
                            </a>
                        </li>
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                @csrf
                                <button type="submit" class="btn btn-link nav-link">Logout</button>
                            </form>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main -->
    <main class="flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer bg-dark text-light mt-5 py-4">
        <div class="container text-center">
            <p class="mb-2">
                &copy; {{ date('Y') }} {{ config('app.name', 'ChatApp') }} |
                Built with ❤️ for meaningful conversations.
                <span class="d-block small text-secondary">Fast, private, and designed to keep you connected.</span>
            </p>
            <div class="d-flex justify-content-center gap-3 small flex-wrap">
                <a href="{{ route('about') }}" class="text-light text-decoration-none">About</a>
                <a href="{{ route('features') }}" class="text-light text-decoration-none">Features</a>
                <a href="{{ route('faq') }}" class="text-light text-decoration-none">FAQ</a>
                <a href="{{ route('contact') }}" class="text-light text-decoration-none">Contact</a>
                <a href="#" class="text-light text-decoration-none">Privacy Policy</a>
                <a href="#" class="text-light text-decoration-none">Terms</a>
                <a href="#" class="text-light text-decoration-none">Security</a>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" defer></script>

    <style>
        /* Simple dark mode styles */
        body.dark-mode {
            background-color: #1a1a1a !important;
            color: #e0e0e0 !important;
        }

        body.dark-mode .navbar {
            background-color: #2d2d2d !important;
        }

        body.dark-mode .navbar-brand,
        body.dark-mode .nav-link {
            color: #e0e0e0 !important;
        }

        body.dark-mode .nav-link.active {
            color: #66b3ff !important;
        }

        body.dark-mode .btn-primary {
            background-color: #0066cc;
            border-color: #0066cc;
        }

        body.dark-mode .btn-outline-secondary {
            border-color: #666;
            color: #e0e0e0;
        }

        body.dark-mode .btn-outline-secondary:hover {
            background-color: #666;
            color: #fff;
        }

        body.dark-mode .card {
            background-color: #2d2d2d !important;
            color: #e0e0e0 !important;
            border-color: #444;
        }

        body.dark-mode .footer {
            background-color: #111 !important;
        }

        /* Smooth transition */
        body,
        .navbar,
        .card {
            transition: all 0.3s ease;
        }
    </style>

    @stack('scripts')

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const toggleBtn = document.getElementById("themeToggle");
            const body = document.body;

            if (localStorage.getItem("theme") === "dark") {
                body.classList.add("dark-mode");
                toggleBtn.innerHTML = '<i class="bi bi-sun-fill"></i>';
            }

            toggleBtn.addEventListener("click", () => {
                body.classList.toggle("dark-mode");
                if (body.classList.contains("dark-mode")) {
                    localStorage.setItem("theme", "dark");
                    toggleBtn.innerHTML = '<i class="bi bi-sun-fill"></i>';
                } else {
                    localStorage.setItem("theme", "light");
                    toggleBtn.innerHTML = '<i class="bi bi-moon-fill"></i>';
                }
            });
        });
    </script>
</body>

</html>
