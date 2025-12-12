<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    {{-- Fonts --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    {{-- Bootstrap 5 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">

    {{-- DataTables --}}
    <link href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css" rel="stylesheet">

    <style>
        :root {
            --primary: #0004ff;
            --primary-dark: #0c00f3;
            --primary-light: #131e88;
            --secondary: #0ea5e9;
            --success: #10b981;
            --warning: #f59e0b;
            --danger: #ef4444;
            --dark: #1e293b;
            --darker: #0f172a;
            --light: #f8fafc;
            --gray-50: #f8fafc;
            --gray-100: #f1f5f9;
            --gray-200: #e2e8f0;
            --gray-300: #cbd5e1;
            --gray-400: #94a3b8;
            --gray-500: #64748b;
            --gray-600: #475569;
            --gray-700: #334155;
            --gray-800: #1e293b;
            --gray-900: #0f172a;
            --border-radius: 12px;
            --shadow-sm: 0 1px 2px 0 rgb(0 0 0 / 0.05);
            --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
            --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
            --navbar-height: 72px;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 50%, #fdf4ff 100%);
            min-height: 100vh;
            color: var(--gray-800);
            overflow-x: hidden;
        }

        /* ========== Navbar ========== */
        .navbar-custom {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.5);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.05);
            padding: 0.75rem 0;
            position: sticky;
            top: 0;
            z-index: 1000;
            transition: all 0.3s ease;
        }

        .navbar-custom.scrolled {
            background: rgba(255, 255, 255, 0.95);
            box-shadow: 0 4px 30px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            font-weight: 800;
            font-size: 1.35rem;
            color: var(--gray-900) !important;
            text-decoration: none;
            letter-spacing: -0.025em;
        }

        .brand-logo {
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1.25rem;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .navbar-brand-custom:hover .brand-logo {
            transform: scale(1.05) rotate(-5deg);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
        }

        /* Nav Links */
        .nav-link-custom {
            display: flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.6rem 1rem !important;
            color: var(--gray-600) !important;
            font-weight: 500;
            font-size: 0.925rem;
            border-radius: 10px;
            transition: all 0.25s ease;
            position: relative;
            margin: 0 0.15rem;
        }

        .nav-link-custom i {
            font-size: 1.1rem;
            transition: transform 0.25s ease;
        }

        .nav-link-custom:hover {
            color: var(--primary) !important;
            background: rgba(99, 102, 241, 0.08);
        }

        .nav-link-custom:hover i {
            transform: scale(1.1);
        }

        .nav-link-custom.active {
            color: var(--primary) !important;
            background: rgba(99, 102, 241, 0.1);
            font-weight: 600;
        }

        /* User Dropdown */
        .user-dropdown {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.5rem 0.75rem 0.5rem 0.5rem !important;
            border-radius: 50px;
            background: var(--gray-100);
            border: 1px solid var(--gray-200);
            transition: all 0.3s ease;
        }

        .user-dropdown:hover {
            background: white;
            border-color: var(--primary-light);
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.15);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 0.9rem;
        }

        .user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        .user-name {
            font-weight: 600;
            color: var(--gray-800);
            font-size: 0.9rem;
        }

        .user-role {
            font-size: 0.75rem;
            color: var(--gray-500);
            font-weight: 500;
        }

        /* Dropdown Menu */
        .dropdown-menu-custom {
            border: none;
            border-radius: 16px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
            padding: 0.5rem;
            min-width: 220px;
            margin-top: 0.5rem !important;
            background: white;
            animation: dropdownFade 0.2s ease;
        }

        @keyframes dropdownFade {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .dropdown-item-custom {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.75rem 1rem;
            border-radius: 10px;
            color: var(--gray-700);
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .dropdown-item-custom:hover {
            background: var(--gray-100);
            color: var(--gray-900);
        }

        .dropdown-item-custom i {
            font-size: 1.1rem;
            color: var(--gray-500);
        }

        .dropdown-item-custom.logout {
            color: var(--danger);
            margin-top: 0.25rem;
            border-top: 1px solid var(--gray-200);
            border-radius: 0 0 10px 10px;
            padding-top: 1rem;
        }

        .dropdown-item-custom.logout:hover {
            background: rgba(239, 68, 68, 0.1);
        }

        .dropdown-item-custom.logout i {
            color: var(--danger);
        }

        /* Mobile Toggle */
        .navbar-toggler-custom {
            border: none;
            padding: 0.5rem;
            border-radius: 10px;
            background: var(--gray-100);
            transition: all 0.3s ease;
        }

        .navbar-toggler-custom:hover {
            background: var(--gray-200);
        }

        .navbar-toggler-custom:focus {
            box-shadow: none;
        }

        /* Auth Buttons */
        .auth-buttons {
            display: flex;
            gap: 0.75rem;
        }

        .btn-auth {
            padding: 0.6rem 1.25rem;
            border-radius: 10px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.3s ease;
            text-decoration: none;
        }

        .btn-login {
            color: var(--gray-700);
            background: transparent;
        }

        .btn-login:hover {
            color: var(--primary);
            background: rgba(99, 102, 241, 0.08);
        }

        .btn-register {
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            color: white;
            box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        }

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(99, 102, 241, 0.5);
            color: white;
        }

        /* ========== Main Content ========== */
        .main-content {
            min-height: calc(100vh - var(--navbar-height));
            padding-top: 1.5rem;
            padding-bottom: 3rem;
        }

        /* ========== Footer ========== */
        .footer-custom {
            background: var(--darker);
            color: var(--gray-400);
            padding: 2rem 0;
            margin-top: auto;
        }

        .footer-content {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-brand {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .footer-brand-icon {
            width: 36px;
            height: 36px;
            background: linear-gradient(135deg, var(--primary), #8b5cf6);
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 1rem;
        }

        .footer-links {
            display: flex;
            gap: 1.5rem;
        }

        .footer-link {
            color: var(--gray-400);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-link:hover {
            color: white;
        }

        .footer-copyright {
            font-size: 0.875rem;
            color: var(--gray-500);
        }

        /* ========== Utilities ========== */
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.5);
        }

        /* ========== Toast/Alert Styles ========== */
        .alert-custom {
            border: none;
            border-radius: 12px;
            padding: 1rem 1.25rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
            box-shadow: var(--shadow);
        }

        .alert-success-custom {
            background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(52, 211, 153, 0.1));
            color: #065f46;
            border-left: 4px solid var(--success);
        }

        .alert-danger-custom {
            background: linear-gradient(135deg, rgba(239, 68, 68, 0.1), rgba(248, 113, 113, 0.1));
            color: #991b1b;
            border-left: 4px solid var(--danger);
        }

        .alert-warning-custom {
            background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(251, 191, 36, 0.1));
            color: #92400e;
            border-left: 4px solid var(--warning);
        }

        /* ========== DataTables Custom ========== */
        .dataTables_wrapper .dataTables_paginate .paginate_button.current {
            background: linear-gradient(135deg, var(--primary), #8b5cf6) !important;
            border-color: var(--primary) !important;
            color: white !important;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: var(--gray-100) !important;
            border-color: var(--gray-200) !important;
            color: var(--gray-800) !important;
            border-radius: 8px;
        }

        .dataTables_wrapper .dataTables_filter input {
            border-radius: 10px;
            border: 1px solid var(--gray-300);
            padding: 0.5rem 1rem;
        }

        .dataTables_wrapper .dataTables_filter input:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(99, 102, 241, 0.1);
            outline: none;
        }

        .dataTables_wrapper .dataTables_length select {
            border-radius: 8px;
            border: 1px solid var(--gray-300);
            padding: 0.4rem 2rem 0.4rem 0.75rem;
        }

        /* ========== Scrollbar ========== */
        ::-webkit-scrollbar {
            width: 8px;
            height: 8px;
        }

        ::-webkit-scrollbar-track {
            background: var(--gray-100);
        }

        ::-webkit-scrollbar-thumb {
            background: var(--gray-300);
            border-radius: 4px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: var(--gray-400);
        }

        /* ========== Responsive ========== */
        @media (max-width: 991.98px) {
            .navbar-collapse {
                background: white;
                border-radius: 16px;
                padding: 1rem;
                margin-top: 1rem;
                box-shadow: var(--shadow-lg);
            }

            .nav-link-custom {
                padding: 0.75rem 1rem !important;
            }

            .user-dropdown {
                margin-top: 0.5rem;
                width: 100%;
                justify-content: flex-start;
            }

            .auth-buttons {
                flex-direction: column;
                width: 100%;
            }

            .btn-auth {
                text-align: center;
            }

            .footer-content {
                flex-direction: column;
                text-align: center;
            }

            .footer-links {
                flex-wrap: wrap;
                justify-content: center;
            }
        }

        /* Page Transition */
        .page-transition {
            animation: pageIn 0.4s ease;
        }

        @keyframes pageIn {
            from {
                opacity: 0;
                transform: translateY(10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    @stack('styles')
</head>
<body>
    <div id="app">
        {{-- Navbar --}}
        <nav class="navbar navbar-expand-lg navbar-custom">
            <div class="container">
                {{-- Brand --}}
                <a class="navbar-brand-custom" href="{{ url('/') }}">
                    <div class="brand-logo">
                        <i class="bi bi-boxes"></i>
                    </div>
                    <span>{{ config('app.name', 'CV Akses Digital') }}</span>
                </a>

                {{-- Mobile Toggle --}}
                <button class="navbar-toggler navbar-toggler-custom" type="button" data-bs-toggle="collapse" data-bs-target="#navbarMain" aria-controls="navbarMain" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-4"></i>
                </button>

                {{-- Navbar Content --}}
                <div class="collapse navbar-collapse" id="navbarMain">
                    {{-- Left Nav --}}
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        @auth
                            <li class="nav-item">
                                <a class="nav-link nav-link-custom {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ route('dashboard') }}">
                                    <i class="bi bi-grid-1x2"></i>
                                    <span>Dashboard</span>
                                </a>
                            </li>

                            @if(Route::has('users.index'))
                                @role('Super Admin')
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('users.*') ? 'active' : '' }}" href="{{ route('users.index') }}">
                                        <i class="bi bi-people"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                                @endrole
                            @endif

                            @if(Route::has('customers.index'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('customers.*') ? 'active' : '' }}" href="{{ route('customers.index') }}">
                                        <i class="bi bi-person-badge"></i>
                                        <span>Customers</span>
                                    </a>
                                </li>
                            @endif

                            @if(Route::has('projects.index'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('projects.*') ? 'active' : '' }}" href="{{ route('projects.index') }}">
                                        <i class="bi bi-folder2-open"></i>
                                        <span>Projects</span>
                                    </a>
                                </li>
                            @endif

                            @if(Route::has('tasks.index'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('tasks.*') ? 'active' : '' }}" href="{{ route('tasks.index') }}">
                                        <i class="bi bi-check2-square"></i>
                                        <span>Tasks</span>
                                    </a>
                                </li>
                            @endif

                            @if(Route::has('orders.index'))
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('orders.*') ? 'active' : '' }}" href="{{ route('orders.index') }}">
                                        <i class="bi bi-cart3"></i>
                                        <span>Orders</span>
                                    </a>
                                </li>
                            @endif

                            @if(Route::has('finances.index'))
                                @hasanyrole('Super Admin|Manager')
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('finances.*') ? 'active' : '' }}" href="{{ route('finances.index') }}">
                                        <i class="bi bi-wallet2"></i>
                                        <span>Finances</span>
                                    </a>
                                </li>
                                @endhasanyrole
                            @endif

                            @if(Route::has('reports.index'))
                                @hasanyrole('Super Admin|Manager')
                                <li class="nav-item">
                                    <a class="nav-link nav-link-custom {{ request()->routeIs('reports.*') ? 'active' : '' }}" href="{{ route('reports.index') }}">
                                        <i class="bi bi-graph-up"></i>
                                        <span>Reports</span>
                                    </a>
                                </li>
                                @endhasanyrole
                            @endif
                        @endauth
                    </ul>

                    {{-- Right Nav --}}
                    <ul class="navbar-nav ms-auto">
                        @guest
                            <div class="auth-buttons">
                                @if (Route::has('login'))
                                    <a class="btn-auth btn-login" href="{{ route('login') }}">
                                        <i class="bi bi-box-arrow-in-right me-1"></i> Login
                                    </a>
                                @endif

                                @if (Route::has('register'))
                                    <a class="btn-auth btn-register" href="{{ route('register') }}">
                                        <i class="bi bi-person-plus me-1"></i> Register
                                    </a>
                                @endif
                            </div>
                        @else
                            <li class="nav-item dropdown">
                                <a class="nav-link user-dropdown" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                                    </div>
                                    <div class="user-info d-none d-md-flex">
                                        <span class="user-name">{{ Auth::user()->name }}</span>
                                        <span class="user-role">{{ Auth::user()->getRoleNames()->first() ?? 'User' }}</span>
                                    </div>
                                    <i class="bi bi-chevron-down ms-1" style="font-size: 0.75rem; color: var(--gray-500);"></i>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-custom dropdown-menu-end" aria-labelledby="userDropdown">
                                    <li>
                                        <a class="dropdown-item dropdown-item-custom" href="#">
                                            <i class="bi bi-person"></i>
                                            <span>Profil Saya</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item dropdown-item-custom" href="#">
                                            <i class="bi bi-gear"></i>
                                            <span>Pengaturan</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item dropdown-item-custom logout" href="{{ route('logout') }}"
                                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="bi bi-box-arrow-right"></i>
                                            <span>Keluar</span>
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        {{-- Flash Messages --}}
        @if(session('success'))
            <div class="container mt-3">
                <div class="alert alert-custom alert-success-custom alert-dismissible fade show" role="alert">
                    <i class="bi bi-check-circle-fill"></i>
                    <span>{{ session('success') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div class="container mt-3">
                <div class="alert alert-custom alert-danger-custom alert-dismissible fade show" role="alert">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    <span>{{ session('error') }}</span>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        @endif

        {{-- Main Content --}}
        <main class="main-content page-transition">
            @yield('content')
        </main>

        {{-- Footer --}}
        <footer class="footer-custom">
            <div class="container">
                <div class="footer-content">
                    <div class="footer-brand">
                        <div class="footer-brand-icon">
                            <i class="bi bi-boxes"></i>
                        </div>
                        <span>{{ config('app.name', 'CV Akses Digital') }}</span>
                    </div>

                    <div class="footer-links">
                        <a href="#" class="footer-link">Tentang Kami</a>
                        <a href="#" class="footer-link">Kebijakan Privasi</a>
                        <a href="#" class="footer-link">Syarat & Ketentuan</a>
                        <a href="#" class="footer-link">Kontak</a>
                    </div>

                    <div class="footer-copyright">
                        &copy; {{ date('Y') }} {{ config('app.name', 'CV Akses Digital') }}. All rights reserved.
                    </div>
                </div>
            </div>
        </footer>
    </div>

    {{-- Scripts --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>

    <script>
        // Navbar scroll effect
        window.addEventListener('scroll', function() {
            const navbar = document.querySelector('.navbar-custom');
            if (window.scrollY > 20) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });

        // Auto-hide alerts after 5 seconds
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('.alert-dismissible');
            alerts.forEach(function(alert) {
                setTimeout(function() {
                    const bsAlert = new bootstrap.Alert(alert);
                    bsAlert.close();
                }, 5000);
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
