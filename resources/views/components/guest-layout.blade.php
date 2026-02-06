<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'SIDEWA - Sistem Informasi Desa' }}</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
        rel="stylesheet">
    @livewireStyles
    <style>
        :root {
            --primary-color: #10b981;
            --primary-dark: #059669;
            --primary-light: #34d399;
            --secondary-color: #14b8a6;
            --success-color: #22c55e;
            --text-primary: #064e3b;
            --text-secondary: #047857;
            --text-muted: #6b7280;
            --border-color: #d1fae5;
            --bg-light: #ecfdf5;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
            color: var(--text-primary);
            background: white;
            overflow-x: hidden;
        }

        /* Navbar */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            padding: 1rem 0;
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .navbar-brand i {
            font-size: 1.75rem;
        }

        .nav-link {
            color: var(--text-secondary) !important;
            font-weight: 500;
            transition: color 0.3s ease;
            padding: 0.5rem 1rem !important;
        }

        .nav-link:hover {
            color: var(--primary-color) !important;
        }

        .btn-login {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white !important;
            border: none;
            border-radius: 8px;
            padding: 0.5rem 1.5rem !important;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 20px rgba(16, 185, 129, 0.4);
        }

        /* Hero Section */
        .hero-section {
            min-height: 100vh;
            background: linear-gradient(135deg, #ecfdf5 0%, #d1fae5 100%);
            display: flex;
            align-items: center;
            padding-top: 80px;
            position: relative;
            overflow: hidden;
        }

        .hero-shapes {
            position: absolute;
            width: 100%;
            height: 100%;
            overflow: hidden;
        }

        .hero-shapes .shape {
            position: absolute;
            border-radius: 50%;
            background: rgba(16, 185, 129, 0.1);
            animation: float 15s infinite ease-in-out;
        }

        .hero-shapes .shape:nth-child(1) {
            width: 400px;
            height: 400px;
            top: -100px;
            right: -100px;
        }

        .hero-shapes .shape:nth-child(2) {
            width: 300px;
            height: 300px;
            bottom: -50px;
            left: -50px;
            animation-delay: -5s;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            33% {
                transform: translateY(-30px) rotate(10deg);
            }

            66% {
                transform: translateY(20px) rotate(-5deg);
            }
        }

        .hero-content h1 {
            font-size: 3.5rem;
            font-weight: 800;
            color: var(--text-primary);
            line-height: 1.2;
            margin-bottom: 1.5rem;
        }

        .hero-content p {
            font-size: 1.25rem;
            color: var(--text-secondary);
            margin-bottom: 2rem;
            line-height: 1.7;
        }

        .hero-buttons {
            display: flex;
            gap: 1rem;
            flex-wrap: wrap;
        }

        .btn-hero-primary {
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            border: none;
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-hero-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.4);
            color: white;
        }

        .btn-hero-secondary {
            background: white;
            color: var(--primary-color);
            border: 2px solid var(--primary-color);
            border-radius: 12px;
            padding: 1rem 2rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-hero-secondary:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }

        .hero-image {
            position: relative;
            z-index: 1;
        }

        .hero-image img {
            max-width: 100%;
            height: auto;
        }

        /* Features Section */
        .features-section {
            padding: 6rem 0;
            background: white;
        }

        .section-title {
            text-align: center;
            margin-bottom: 4rem;
        }

        .section-title h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .section-title p {
            color: var(--text-muted);
            font-size: 1.1rem;
            max-width: 600px;
            margin: 0 auto;
        }

        .feature-card {
            background: white;
            border: 1px solid var(--border-color);
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            height: 100%;
        }

        .feature-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(16, 185, 129, 0.15);
            border-color: var(--primary-light);
        }

        .feature-icon {
            width: 80px;
            height: 80px;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            border-radius: 20px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 1.5rem;
        }

        .feature-icon i {
            font-size: 2rem;
            color: white;
        }

        .feature-card h3 {
            font-size: 1.25rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 1rem;
        }

        .feature-card p {
            color: var(--text-muted);
            font-size: 0.95rem;
            line-height: 1.6;
        }

        /* Services Section */
        .services-section {
            padding: 6rem 0;
            background: var(--bg-light);
        }

        .service-item {
            display: flex;
            align-items: start;
            gap: 1.5rem;
            padding: 1.5rem;
            background: white;
            border-radius: 12px;
            margin-bottom: 1rem;
            transition: all 0.3s ease;
        }

        .service-item:hover {
            transform: translateX(10px);
            box-shadow: 0 10px 30px rgba(16, 185, 129, 0.1);
        }

        .service-icon {
            width: 50px;
            height: 50px;
            background: var(--bg-light);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-shrink: 0;
        }

        .service-icon i {
            color: var(--primary-color);
            font-size: 1.25rem;
        }

        .service-content h4 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--text-primary);
            margin-bottom: 0.5rem;
        }

        .service-content p {
            color: var(--text-muted);
            font-size: 0.9rem;
            margin: 0;
        }

        /* CTA Section */
        .cta-section {
            padding: 6rem 0;
            background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
            color: white;
            text-align: center;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }

        .cta-section p {
            font-size: 1.1rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            background: white;
            color: var(--primary-color);
            border: none;
            border-radius: 12px;
            padding: 1rem 2.5rem;
            font-weight: 600;
            font-size: 1.1rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-cta:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            color: var(--primary-dark);
        }

        /* Footer */
        .footer {
            background: #064e3b;
            color: white;
            padding: 4rem 0 2rem;
        }

        .footer h5 {
            font-weight: 600;
            margin-bottom: 1.5rem;
        }

        .footer p,
        .footer a {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.95rem;
            text-decoration: none;
        }

        .footer a:hover {
            color: white;
        }

        .footer-bottom {
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            margin-top: 3rem;
            padding-top: 2rem;
            text-align: center;
        }

        .footer-bottom p {
            margin: 0;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-content h1 {
                font-size: 2.5rem;
            }

            .hero-buttons {
                flex-direction: column;
            }

            .section-title h2 {
                font-size: 2rem;
            }
        }
    </style>
</head>

<body>
    {{ $slot }}

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.2/js/bootstrap.bundle.min.js"></script>
    @livewireScripts
</body>

</html>