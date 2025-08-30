<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>ChatApp - Real-Time Messaging Platform</title>
  <meta name="description"
    content="ChatApp - Secure, scalable, and modern real-time messaging platform built with Laravel, MySQL, Socket.io, Bootstrap, and JavaScript.">
  <meta name="author" content="Flutter Developer">
  <link rel="icon" type="image/png" href="https://cdn-icons-png.flaticon.com/512/893/893257.png">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: 'Nunito', sans-serif;
      background-color: #f5f7fa;
      color: #1e293b;
      scroll-behavior: smooth;
    }

    /* Hero */
    .hero {
      text-align: center;
      padding: 100px 20px 80px;
      background: linear-gradient(135deg, #2563eb, #4e54c8);
      color: #fff;
      position: relative;
    }

    .hero h1 {
      font-size: 3.2rem;
      font-weight: 800;
      margin-bottom: 20px;
    }

    .hero p {
      font-size: 1.2rem;
      margin-bottom: 40px;
      line-height: 1.6;
      max-width: 700px;
      margin-left: auto;
      margin-right: auto;
    }

    .hero-buttons a {
      display: inline-block;
      margin: 10px;
      padding: 14px 32px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 50px;
      color: #fff;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .btn-login {
      background: #1e40af;
    }

    .btn-login:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(30, 64, 175, 0.6);
    }

    .btn-register {
      background: #9333ea;
    }

    .btn-register:hover {
      transform: translateY(-3px);
      box-shadow: 0 8px 25px rgba(147, 51, 234, 0.5);
    }

    /* Features */
    .features {
      background-color: #fff;
      padding: 80px 20px;
      text-align: center;
    }

    .features h2 {
      font-size: 2.6rem;
      font-weight: 700;
      margin-bottom: 60px;
      color: #1e40af;
    }

    .feature-item {
      background: #f9fafb;
      border-radius: 16px;
      padding: 30px 20px;
      margin: 15px;
      transition: transform 0.3s ease, box-shadow 0.3s ease;
    }

    .feature-item:hover {
      transform: translateY(-6px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .feature-item i {
      font-size: 3rem;
      color: #2563eb;
      margin-bottom: 20px;
    }

    .feature-item h5 {
      font-weight: 700;
      margin-bottom: 15px;
    }

    .feature-item p {
      color: #64748b;
      font-size: 1rem;
      line-height: 1.6;
    }

    /* Tech Stack */
    .tech-stack {
      background: #f9fafb;
      padding: 80px 20px;
      text-align: center;
    }

    .tech-stack h2 {
      font-size: 2.4rem;
      font-weight: 700;
      margin-bottom: 40px;
      color: #1e293b;
    }

    .stack-icons {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 30px;
    }

    .stack-icons .stack-card {
      background: #fff;
      border-radius: 16px;
      padding: 25px;
      width: 180px;
      transition: all 0.3s ease;
    }

    .stack-icons .stack-card:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    }

    .stack-icons i {
      font-size: 2.5rem;
      color: #2563eb;
      margin-bottom: 10px;
    }

    .stack-icons p {
      font-size: 0.95rem;
      font-weight: 600;
      color: #334155;
    }

    /* About */
    .about {
      background: #fff;
      padding: 80px 20px;
      text-align: center;
    }

    .about h2 {
      font-size: 2.4rem;
      font-weight: 700;
      margin-bottom: 20px;
      color: #1e40af;
    }

    .about p {
      max-width: 800px;
      margin: 0 auto 20px;
      font-size: 1.1rem;
      color: #475569;
      line-height: 1.8;
    }

    .about strong {
      color: #9333ea;
    }

    footer {
      background: #1e293b;
      color: #fff;
      text-align: center;
      padding: 25px;
      font-size: 0.9rem;
    }

    footer a {
      color: #93c5fd;
      text-decoration: none;
    }

    @media (max-width: 992px) {
      .hero h1 {
        font-size: 2.2rem;
      }

      .hero p {
        font-size: 1rem;
      }

      .hero-buttons a {
        width: 100%;
        max-width: 250px;
      }
    }

    /* Scroll Animation */
    [data-aos] {
      opacity: 0;
      transform: translateY(30px);
      transition: opacity 0.8s ease, transform 0.8s ease;
    }

    [data-aos].aos-animate {
      opacity: 1;
      transform: translateY(0);
    }
  </style>
</head>

<body>

  <!-- Hero Section -->
  <section class="hero">
    <h1 data-aos="fade-up">Welcome to ChatApp</h1>
    <p data-aos="fade-up" data-aos-delay="200">
      ChatApp is a <b>modern real-time messaging platform</b> built with <b>Laravel, MySQL, Socket.io, Bootstrap,</b>
      and <b>JavaScript</b>. Secure, instant, and seamless communication across devices.
    </p>
    <div class="hero-buttons" data-aos="fade-up" data-aos-delay="400">
      <a href="{{ route('login') }}" class="btn-login"><i class="bi bi-box-arrow-in-right me-2"></i>Login</a>
      <a href="{{ route('register') }}" class="btn-register"><i class="bi bi-person-plus me-2"></i>Register</a>
    </div>
  </section>

  <!-- Features -->
  <section class="features">
    <h2 data-aos="fade-up">Key Features</h2>
    <div class="row justify-content-center">
      <div class="col-md-4 feature-item" data-aos="zoom-in">
        <i class="bi bi-chat-dots"></i>
        <h5>Instant Messaging</h5>
        <p>Send and receive messages in real-time with lightning-fast delivery powered by Socket.io.</p>
      </div>
      <div class="col-md-4 feature-item" data-aos="zoom-in" data-aos-delay="200">
        <i class="bi bi-shield-lock-fill"></i>
        <h5>Secure Communication</h5>
        <p>End-to-end security with authentication and database protection to keep your data safe.</p>
      </div>
      <div class="col-md-4 feature-item" data-aos="zoom-in" data-aos-delay="400">
        <i class="bi bi-people-fill"></i>
        <h5>User Management</h5>
        <p>Manage user accounts with role-based access for better control and community engagement.</p>
      </div>
      <div class="col-md-4 feature-item" data-aos="zoom-in" data-aos-delay="600">
        <i class="bi bi-phone-fill"></i>
        <h5>Responsive Design</h5>
        <p>Seamless experience across mobile, tablet, and desktop with a fully responsive layout.</p>
      </div>
      <div class="col-md-4 feature-item" data-aos="zoom-in" data-aos-delay="800">
        <i class="bi bi-rocket-takeoff-fill"></i>
        <h5>Fast & Scalable</h5>
        <p>Optimized architecture ensures smooth performance even with growing users and messages.</p>
      </div>
    </div>
  </section>

  <!-- Tech Stack -->
  <section class="tech-stack">
    <h2 data-aos="fade-up">Our Technology Stack</h2>
    <p class="mb-5" data-aos="fade-up" data-aos-delay="200">Built with cutting-edge technologies for speed, scalability,
      and security.</p>
    <div class="stack-icons">
      <div class="stack-card" data-aos="zoom-in"><i class="bi bi-code-slash"></i>
        <a href="https://laravel.com/" style="text-decoration: none;">Laravel</a>
      </div>
      <div class="stack-card" data-aos="zoom-in" data-aos-delay="200"><i class="bi bi-database-fill"></i>
        <a href="https://www.mysql.com/" style="text-decoration: none;">MySQL</a>
      </div>
      <div class="stack-card" data-aos="zoom-in" data-aos-delay="400"><i class="bi bi-lightning-fill"></i>
        <a href="https://socket.io/" style="text-decoration: none;">Socket.io</a>
      </div>
      <div class="stack-card" data-aos="zoom-in" data-aos-delay="600"><i class="bi bi-bootstrap-fill"></i>
        <a href="https://getbootstrap.com/" style="text-decoration: none;">Bootstrap</a>
      </div>
      <div class="stack-card" data-aos="zoom-in" data-aos-delay="800"><i class="bi bi-javascript"></i>
        <a href="https://www.javascript.com/" style="text-decoration: none;">JavaScript</a>
      </div>
    </div>
  </section>

  <!-- About -->
  <section class="about">
    <h2 data-aos="fade-up">About the Developer</h2>
    <p data-aos="fade-up" data-aos-delay="200">
      Hi 👋 I’m <strong>Flutter Developer</strong>, currently pursuing <strong>M.Sc. in IT &amp; CA</strong>. I
      completed my <strong>B.Sc. in IT</strong> in 2024, and I’m passionate about building <b>scalable, real-time web
        applications</b>.
    </p>
    <p data-aos="fade-up" data-aos-delay="400">
      ChatApp is my initiative to create a secure, modern, and efficient messaging solution inspired by today’s top
      platforms — but with simplicity and performance at its core.
    </p>
    <p data-aos="fade-up" data-aos-delay="600">
      My mission is to innovate, learn continuously, and deliver apps that transform the way people connect in the
      digital world.
    </p>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; 2025 ChatApp | Built with ❤️ by <a href="{{ route('about') }}">Flutter Developer</a></p>
  </footer>

  <!-- Scripts -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // Simple AOS-like fade animation
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add("aos-animate");
        }
      });
    }, { threshold: 0.2 });

    document.querySelectorAll("[data-aos]").forEach(el => observer.observe(el));
  </script>
</body>

</html>
