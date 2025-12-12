@extends('layouts.app')

@push('styles')
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
<style>
    :root {
        --primary: #292df1;
        --primary-dark: #0d04b9;
        --secondary: #008dce;
        --success: #10b981;
        --warning: #f59e0b;
        --danger: #ef4444;
        --dark: #1e293b;
        --darker: #0f172a;
        --light: #f8fafc;
        --gray: #64748b;
        --card-bg: #ffffff;
        --border: #e2e8f0;
        --shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        --shadow-lg: 0 10px 15px -3px rgb(0 0 0 / 0.1), 0 4px 6px -4px rgb(0 0 0 / 0.1);
    }

    body {
        font-family: 'Plus Jakarta Sans', sans-serif;
        background: linear-gradient(135deg, #f0f4ff 0%, #faf5ff 50%, #fdf4ff 100%);
        min-height: 100vh;
    }

    .dashboard-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 2rem;
    }

    /* Hero Welcome Section */
    .welcome-hero {
        background: linear-gradient(135deg, var(--primary) 0%, #5c66f6 50%, #5565f7 100%);
        border-radius: 24px;
        padding: 3rem;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 20px 40px -12px rgba(99, 102, 241, 0.35);
    }

    .welcome-hero::before {
        content: '';
        position: absolute;
        top: -50%;
        right: -20%;
        width: 500px;
        height: 500px;
        background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-hero::after {
        content: '';
        position: absolute;
        bottom: -30%;
        left: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(255,255,255,0.08) 0%, transparent 70%);
        border-radius: 50%;
    }

    .welcome-content {
        position: relative;
        z-index: 1;
    }

    .welcome-badge {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        background: rgba(255,255,255,0.2);
        backdrop-filter: blur(10px);
        padding: 0.5rem 1rem;
        border-radius: 50px;
        color: white;
        font-size: 0.875rem;
        font-weight: 500;
        margin-bottom: 1rem;
    }

    .welcome-title {
        color: white;
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        letter-spacing: -0.025em;
    }

    .welcome-subtitle {
        color: rgba(255,255,255,0.85);
        font-size: 1.125rem;
        font-weight: 400;
    }

    .welcome-date {
        color: rgba(255,255,255,0.7);
        font-size: 0.9rem;
        margin-top: 1rem;
    }

    /* Admin Panel */
    .admin-panel {
        background: linear-gradient(135deg, var(--darker) 0%, #1a1a2e 100%);
        border-radius: 20px;
        padding: 2rem;
        margin-bottom: 2rem;
        border: 1px solid rgba(255,255,255,0.1);
        position: relative;
        overflow: hidden;
    }

    .admin-panel::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, var(--primary), var(--secondary), var(--success));
    }

    .admin-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .admin-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, var(--primary), var(--secondary));
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .admin-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 600;
        margin: 0;
    }

    .admin-subtitle {
        color: var(--gray);
        font-size: 0.875rem;
        margin: 0;
    }

    .admin-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .admin-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.75rem;
        padding: 0.875rem 1.5rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
    }

    .admin-btn-primary {
        background: linear-gradient(135deg, var(--primary), var(--primary-dark));
        color: white;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
    }

    .admin-btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
        color: white;
    }

    .admin-btn-secondary {
        background: rgba(255,255,255,0.1);
        color: white;
        border: 1px solid rgba(255,255,255,0.2);
    }

    .admin-btn-secondary:hover {
        background: rgba(255,255,255,0.15);
        transform: translateY(-2px);
        color: white;
    }

    /* Section Title */
    .section-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 1.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .section-title i {
        color: var(--primary);
    }

    /* Cards Grid */
    .cards-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(320px, 1fr));
        gap: 1.5rem;
    }

    /* Feature Card */
    .feature-card {
        background: var(--card-bg);
        border-radius: 20px;
        padding: 2rem;
        box-shadow: var(--shadow);
        border: 1px solid var(--border);
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        position: relative;
        overflow: hidden;
    }

    .feature-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--card-accent, var(--primary));
        transform: scaleX(0);
        transition: transform 0.4s ease;
    }

    .feature-card:hover {
        transform: translateY(-8px);
        box-shadow: var(--shadow-lg), 0 20px 40px -15px rgba(99, 102, 241, 0.15);
    }

    .feature-card:hover::before {
        transform: scaleX(1);
    }

    .card-header-custom {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
    }

    .card-icon {
        width: 56px;
        height: 56px;
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
        color: white;
        flex-shrink: 0;
    }

    .card-icon.projects {
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
    }

    .card-icon.sales {
        background: linear-gradient(135deg, #0ea5e9, #06b6d4);
    }

    .card-title-group h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0 0 0.25rem 0;
    }

    .card-title-group p {
        font-size: 0.875rem;
        color: var(--gray);
        margin: 0;
    }

    /* Action Buttons */
    .action-buttons {
        display: flex;
        flex-direction: column;
        gap: 0.75rem;
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 0.875rem;
        padding: 1rem 1.25rem;
        border-radius: 12px;
        font-weight: 600;
        font-size: 0.95rem;
        text-decoration: none;
        transition: all 0.3s ease;
        border: none;
        cursor: pointer;
        position: relative;
        overflow: hidden;
    }

    .action-btn::after {
        content: '';
        position: absolute;
        right: 1rem;
        opacity: 0;
        transform: translateX(-10px);
        transition: all 0.3s ease;
    }

    .action-btn:hover::after {
        opacity: 1;
        transform: translateX(0);
        content: '→';
    }

    .action-btn i {
        font-size: 1.1rem;
        transition: transform 0.3s ease;
    }

    .action-btn:hover i {
        transform: scale(1.1);
    }

    /* Button Variants */
    .btn-projects {
        background: linear-gradient(135deg, rgba(99, 102, 241, 0.1), rgba(139, 92, 246, 0.1));
        color: var(--primary);
        border: 1px solid rgba(99, 102, 241, 0.2);
    }

    .btn-projects:hover {
        background: linear-gradient(135deg, var(--primary), #8b5cf6);
        color: white;
        transform: translateX(4px);
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.3);
    }

    .btn-tasks {
        background: linear-gradient(135deg, rgba(168, 85, 247, 0.1), rgba(217, 70, 239, 0.1));
        color: #a855f7;
        border: 1px solid rgba(168, 85, 247, 0.2);
    }

    .btn-tasks:hover {
        background: linear-gradient(135deg, #a855f7, #d946ef);
        color: white;
        transform: translateX(4px);
        box-shadow: 0 8px 20px rgba(168, 85, 247, 0.3);
    }

    .btn-customers {
        background: linear-gradient(135deg, rgba(14, 165, 233, 0.1), rgba(6, 182, 212, 0.1));
        color: var(--secondary);
        border: 1px solid rgba(14, 165, 233, 0.2);
    }

    .btn-customers:hover {
        background: linear-gradient(135deg, var(--secondary), #06b6d4);
        color: white;
        transform: translateX(4px);
        box-shadow: 0 8px 20px rgba(14, 165, 233, 0.3);
    }

    .btn-orders {
        background: linear-gradient(135deg, rgba(245, 158, 11, 0.1), rgba(251, 191, 36, 0.1));
        color: var(--warning);
        border: 1px solid rgba(245, 158, 11, 0.2);
    }

    .btn-orders:hover {
        background: linear-gradient(135deg, var(--warning), #fbbf24);
        color: white;
        transform: translateX(4px);
        box-shadow: 0 8px 20px rgba(245, 158, 11, 0.3);
    }

    .btn-finance {
        background: linear-gradient(135deg, rgba(16, 185, 129, 0.1), rgba(52, 211, 153, 0.1));
        color: var(--success);
        border: 1px solid rgba(16, 185, 129, 0.2);
    }

    .btn-finance:hover {
        background: linear-gradient(135deg, var(--success), #34d399);
        color: white;
        transform: translateX(4px);
        box-shadow: 0 8px 20px rgba(16, 185, 129, 0.3);
    }

    /* Decorative Elements */
    .floating-shapes {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        pointer-events: none;
        z-index: -1;
        overflow: hidden;
    }

    .shape {
        position: absolute;
        border-radius: 50%;
        opacity: 0.5;
        animation: float 20s ease-in-out infinite;
    }

    .shape-1 {
        width: 400px;
        height: 400px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent);
        top: -100px;
        right: -100px;
        animation-delay: 0s;
    }

    .shape-2 {
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(139, 92, 246, 0.1), transparent);
        bottom: -50px;
        left: -50px;
        animation-delay: -5s;
    }

    .shape-3 {
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(14, 165, 233, 0.1), transparent);
        top: 50%;
        left: 50%;
        animation-delay: -10s;
    }

    @keyframes float {
        0%, 100% { transform: translate(0, 0) rotate(0deg); }
        25% { transform: translate(20px, -20px) rotate(5deg); }
        50% { transform: translate(-10px, 20px) rotate(-5deg); }
        75% { transform: translate(-20px, -10px) rotate(3deg); }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .welcome-hero {
            padding: 2rem 1.5rem;
        }

        .welcome-title {
            font-size: 1.75rem;
        }

        .admin-actions {
            flex-direction: column;
        }

        .admin-btn {
            justify-content: center;
        }

        .cards-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Animation on load */
    .animate-in {
        animation: slideUp 0.6s ease forwards;
        opacity: 0;
    }

    @keyframes slideUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .delay-1 { animation-delay: 0.1s; }
    .delay-2 { animation-delay: 0.2s; }
    .delay-3 { animation-delay: 0.3s; }
    .delay-4 { animation-delay: 0.4s; }
</style>
@endpush

@section('content')
<div class="floating-shapes">
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
</div>

<div class="dashboard-container">
    {{-- Welcome Hero Section --}}
    <div class="welcome-hero animate-in">
        <div class="welcome-content">
            <div class="welcome-badge">
                <i class="bi bi-stars"></i>
                <span>Selamat Datang Kembali</span>
            </div>
            <h1 class="welcome-title">Halo, {{ Auth::user()->name }}! 👋</h1>
            <p class="welcome-subtitle">Siap untuk produktif hari ini? Semua menu ada di bawah.</p>
            <p class="welcome-date">
                <i class="bi bi-calendar3"></i>
                {{ now()->locale('id')->isoFormat('dddd, D MMMM Y') }}
            </p>
        </div>
    </div>

    {{-- Admin Panel (Super Admin Only) --}}
    @role('Super Admin')
    <div class="admin-panel animate-in delay-1">
        <div class="admin-header">
            <div class="admin-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <div>
                <h2 class="admin-title">Panel Administrator</h2>
                <p class="admin-subtitle">Kelola pengguna dan akses sistem</p>
            </div>
        </div>
        <div class="admin-actions">
            <a href="{{ route('users.index') }}" class="admin-btn admin-btn-primary">
                <i class="bi bi-people"></i>
                Kelola Pengguna
            </a>
            <a href="{{ route('reports.index') }}" class="admin-btn admin-btn-secondary">
                <i class="bi bi-file-earmark-bar-graph"></i>
                Laporan Keuangan
            </a>
        </div>
    </div>
    @endrole

    {{-- Main Cards Section --}}
    <h2 class="section-title animate-in delay-2">
        <i class="bi bi-grid-3x3-gap"></i>
        Menu Utama
    </h2>

    <div class="cards-grid">
        {{-- Project Management Card --}}
        <div class="feature-card animate-in delay-3" style="--card-accent: linear-gradient(135deg, #6366f1, #8b5cf6);">
            <div class="card-header-custom">
                <div class="card-icon projects">
                    <i class="bi bi-kanban"></i>
                </div>
                <div class="card-title-group">
                    <h3>Manajemen Proyek</h3>
                    <p>Kelola proyek dan tugas tim</p>
                </div>
            </div>
            <div class="action-buttons">
                <a href="{{ route('projects.index') }}" class="action-btn btn-projects">
                    <i class="bi bi-folder2-open"></i>
                    <span>Daftar Proyek</span>
                </a>
                <a href="{{ route('tasks.index') }}" class="action-btn btn-tasks">
                    <i class="bi bi-check2-square"></i>
                    <span>Daftar Tugas</span>
                </a>
            </div>
        </div>

        {{-- Sales & Finance Card --}}
        <div class="feature-card animate-in delay-4" style="--card-accent: linear-gradient(135deg, #0ea5e9, #06b6d4);">
            <div class="card-header-custom">
                <div class="card-icon sales">
                    <i class="bi bi-graph-up-arrow"></i>
                </div>
                <div class="card-title-group">
                    <h3>Penjualan & Keuangan</h3>
                    <p>Kelola pelanggan dan transaksi</p>
                </div>
            </div>
            <div class="action-buttons">
                <a href="{{ route('customers.index') }}" class="action-btn btn-customers">
                    <i class="bi bi-person-badge"></i>
                    <span>Data Pelanggan</span>
                </a>
                <a href="{{ route('orders.index') }}" class="action-btn btn-orders">
                    <i class="bi bi-cart3"></i>
                    <span>Daftar Pesanan</span>
                </a>
                @hasanyrole('Super Admin|Manager')
                <a href="{{ route('finances.index') }}" class="action-btn btn-finance">
                    <i class="bi bi-wallet2"></i>
                    <span>Catatan Keuangan</span>
                </a>
                @endhasanyrole
            </div>
        </div>
    </div>
</div>
@endsection
