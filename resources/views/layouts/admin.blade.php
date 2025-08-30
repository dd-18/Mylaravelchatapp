<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel - ChatApp</title>
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/893/893257.png">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body {
            background: #f5f7fa;
            font-family: 'Inter', sans-serif;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: rgba(30, 30, 30, 0.95);
            backdrop-filter: blur(12px);
            color: #fff;
            padding: 20px 15px;
            box-shadow: 4px 0 12px rgba(0,0,0,0.1);
        }
        .sidebar h4 {
            font-weight: 700;
            margin-bottom: 30px;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .sidebar .nav-link {
            color: #cfd8dc;
            font-weight: 500;
            border-radius: 12px;
            padding: 10px 15px;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 10px;
            transition: all 0.3s ease;
        }
        .sidebar .nav-link.active,
        .sidebar .nav-link:hover {
            background: linear-gradient(135deg, #4e54c8, #8f94fb);
            color: #fff;
            box-shadow: 0 4px 12px rgba(79, 123, 255, 0.4);
        }

        /* Navbar */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
        }
        .navbar-brand {
            font-weight: 700;
            color: #333;
        }
        .navbar .dropdown-menu {
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        /* Content */
        .content {
            padding: 30px;
        }
    </style>
</head>
<body>
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar">
            <h4><i class="bi bi-gear-fill"></i> Admin Panel</h4>
            <nav class="nav flex-column">
                <a href="{{ route('admin.dashboard') }}" 
                   class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="bi bi-speedometer2"></i> Dashboard
                </a>
                <a href="{{ route('admin.messages') }}" 
                   class="nav-link {{ request()->routeIs('admin.messages') ? 'active' : '' }}">
                    <i class="bi bi-chat-dots"></i> Messages
                </a>
                <a href="{{ route('admin.users') }}" 
                   class="nav-link {{ request()->routeIs('admin.users') ? 'active' : '' }}">
                    <i class="bi bi-people"></i> Users
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-grow-1">
            <!-- Navbar -->
            <nav class="navbar navbar-expand-lg navbar-light px-4">
                <a class="navbar-brand" href="#">ChatApp</a>
                <div class="ms-auto dropdown">
                    <a href="#" class="d-flex align-items-center text-dark text-decoration-none dropdown-toggle"
                       id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-person-circle fs-4 me-2"></i>
                        admin
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li><a class="dropdown-item" href="{{ route('home') }}">Profile</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button class="dropdown-item text-danger">Logout</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- Page Content -->
            <div class="content">
                @yield('admin-content')
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
