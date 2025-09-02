<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ChatApp - Real-Time Messaging Platform</title>
    <meta name="description" content="ChatApp - Secure, scalable, and modern real-time messaging platform built with Laravel.">
    <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/893/893257.png">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    
    <style>
        :root {
            --primary: #3b82f6;
            --primary-dark: #2563eb;
            --secondary: #64748b;
            --dark: #1e293b;
            --light: #f8fafc;
            --white: #ffffff;
            --gray-50: #f9fafb;
            --gray-100: #f1f5f9;
            --gray-600: #475569;
            --gray-800: #1e293b;
            --border: #e2e8f0;
            --shadow: 0 1px 3px 0 rgba(0, 0, 0, 0.1);
        }

        body {
            font-family: 'Inter', sans-serif;
            line-height: 1.6;
            color: var(--gray-800);
        }

        /* Hero Section */
        .hero {
            background: var(--primary);
            color: white;
            padding: 100px 0 80px;
            text-align: center;
        }

        .hero h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
        }

        .hero p {
            font-size: 1.2rem;
            margin-bottom: 2.5rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
            opacity: 0.95;
        }

        .btn-hero {
            display: inline-block;
            padding: 12px 30px;
            margin: 0 8px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-white {
            background: white;
            color: var(--primary);
        }

        .btn-white:hover {
            background: var(--gray-50);
            transform: translateY(-1px);
            color: var(--primary-dark);
        }

        .btn-outline {
            background: transparent;
            color: white;
            border: 2px solid white;
        }

        .btn-outline:hover {
            background: white;
            color: var(--primary);
        }

        /* Sections */
        .section {
            padding: 80px 0;
        }

        .section-title {
            font-size: 2.5rem;
            font-weight: 700;
            text-align: center;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .section-subtitle {
            text-align: center;
            font-size: 1.1rem;
            color: var(--secondary);
            margin-bottom: 3rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        /* Features */
        .features {
            background: var(--gray-50);
        }

        .feature-card {
            background: white;
            padding: 2rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            height: 100%;
            text-align: center;
            transition: all 0.2s ease;
        }

        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .feature-icon {
            width: 60px;
            height: 60px;
            background: var(--primary);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 1.5rem;
            color: white;
            font-size: 1.5rem;
        }

        .feature-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            color: var(--dark);
        }

        .feature-text {
            color: var(--gray-600);
            line-height: 1.6;
        }

        /* Tech Stack */
        .tech-card {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: var(--shadow);
            border: 1px solid var(--border);
            text-align: center;
            transition: all 0.2s ease;
        }

        .tech-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .tech-icon {
            font-size: 2rem;
            color: var(--primary);
            margin-bottom: 1rem;
        }

        .tech-name {
            font-weight: 500;
            color: var(--dark);
            text-decoration: none;
        }

        .tech-card:hover .tech-name {
            color: var(--primary);
        }

        /* About */
        .about {
            background: white;
        }

        .about-content {
            max-width: 700px;
            margin: 0 auto;
            text-align: center;
        }

        .about-text {
            font-size: 1.1rem;
            line-height: 1.7;
            color: var(--gray-600);
            margin-bottom: 1.5rem;
        }

        .highlight {
            color: var(--primary);
            font-weight: 600;
        }

        /* Footer */
        .footer {
            background: var(--dark);
            color: white;
            padding: 2rem 0;
            text-align: center;
        }

        .footer a {
            color: var(--primary);
            text-decoration: none;
        }

        .footer a:hover {
            text-decoration: underline;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            
            .hero p {
                font-size: 1.1rem;
            }
            
            .section-title {
                font-size: 2rem;
            }
            
            .btn-hero {
                display: block;
                margin: 0.5rem auto;
                max-width: 200px;
            }
        }
    </style>
</head>

<body>
    <!-- Hero -->
    <section class="hero">
        <div class="container">
            <h1>Welcome to ChatApp</h1>
            <p>Modern, secure, and fast real-time messaging platform built with Laravel and cutting-edge technologies.</p>
            <div>
                <a href="{{ route('login') }}" class="btn-hero btn-white">
                    <i class="bi bi-box-arrow-in-right me-2"></i>Login
                </a>
                <a href="{{ route('register') }}" class="btn-hero btn-outline">
                    <i class="bi bi-person-plus me-2"></i>Register
                </a>
            </div>
        </div>
    </section>

    <!-- Features -->
    <section class="section features">
        <div class="container">
            <h2 class="section-title">Key Features</h2>
            <p class="section-subtitle">Everything you need for modern communication</p>
            
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-chat-dots"></i>
                        </div>
                        <h3 class="feature-title">Real-Time Messaging</h3>
                        <p class="feature-text">Instant message delivery with Socket.io for seamless conversations.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-shield-lock-fill"></i>
                        </div>
                        <h3 class="feature-title">Secure Communication</h3>
                        <p class="feature-text">Advanced security with authentication and data protection.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-people-fill"></i>
                        </div>
                        <h3 class="feature-title">User Management</h3>
                        <p class="feature-text">Complete user control with role-based access management.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-phone-fill"></i>
                        </div>
                        <h3 class="feature-title">Responsive Design</h3>
                        <p class="feature-text">Perfect experience across all devices and screen sizes.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-rocket-takeoff-fill"></i>
                        </div>
                        <h3 class="feature-title">Fast Performance</h3>
                        <p class="feature-text">Optimized for speed and scalability with growing users.</p>
                    </div>
                </div>
                
                <div class="col-md-4">
                    <div class="feature-card">
                        <div class="feature-icon">
                            <i class="bi bi-gear-fill"></i>
                        </div>
                        <h3 class="feature-title">Easy to Use</h3>
                        <p class="feature-text">Intuitive interface designed for the best user experience.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Tech Stack -->
    <section class="section">
        <div class="container">
            <h2 class="section-title">Built With</h2>
            <p class="section-subtitle">Modern technologies for reliable performance</p>
            
            <div class="row g-4 justify-content-center">
                <div class="col-md-2 col-sm-6">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="bi bi-code-slash"></i>
                        </div>
                        <a href="https://laravel.com/" class="tech-name" target="_blank">Laravel</a>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="bi bi-database-fill"></i>
                        </div>
                        <a href="https://www.mysql.com/" class="tech-name" target="_blank">MySQL</a>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="bi bi-lightning-fill"></i>
                        </div>
                        <a href="https://socket.io/" class="tech-name" target="_blank">Socket.io</a>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="bi bi-filetype-html"></i>
                        </div>
                        <a href="https://developer.mozilla.org/en-US/docs/Web/HTML" class="tech-name" target="_blank">Html</a>
                    </div>
                </div>

                <div class="col-md-2 col-sm-6">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="bi bi-bootstrap-fill"></i>
                        </div>
                        <a href="https://getbootstrap.com/" class="tech-name" target="_blank">Bootstrap</a>
                    </div>
                </div>
                
                <div class="col-md-2 col-sm-6">
                    <div class="tech-card">
                        <div class="tech-icon">
                            <i class="bi bi-javascript"></i>
                        </div>
                        <a href="https://developer.mozilla.org/en-US/docs/Web/JavaScript" class="tech-name" target="_blank">JavaScript</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- About -->
    <section class="section about">
        <div class="container">
            <div class="about-content">
                <h2 class="section-title">About the Developer</h2>
                
                <p class="about-text">
                    Hi 👋 I'm <span class="highlight">Laravel Developer</span>, currently pursuing 
                    <span class="highlight">M.Sc. in IT & CA</span>. I completed my 
                    <span class="highlight">B.Sc. in IT</span> in 2024.
                </p>
                
                <p class="about-text">
                    ChatApp is my project to create a secure and efficient messaging solution. 
                    I'm passionate about building scalable web applications that connect people.
                </p>
                
                <p class="about-text">
                    My goal is to continuously learn and deliver apps that make digital communication better.
                </p>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2025 ChatApp | Built with ❤️ by <a href="{{ route('about') }}">Laravel Developer</a></p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
