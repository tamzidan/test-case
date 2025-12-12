@extends('layouts.app')

@push('styles')
<style>
    .reports-container {
        max-width: 1400px;
        margin: 0 auto;
        padding: 0 1rem;
    }

    /* Page Header */
    .page-header {
        margin-bottom: 2rem;
    }

    .page-title {
        font-size: 2rem;
        font-weight: 800;
        color: var(--gray-900, #0f172a);
        letter-spacing: -0.025em;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .page-title-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
        box-shadow: 0 8px 20px rgba(99, 102, 241, 0.35);
    }

    .page-subtitle {
        color: #64748b;
        margin-top: 0.5rem;
        font-size: 1rem;
    }

    /* Filter Card */
    .filter-card {
        background: white;
        border-radius: 20px;
        padding: 1.75rem;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        border: 1px solid #e2e8f0;
        margin-bottom: 2rem;
        position: relative;
        overflow: hidden;
    }

    .filter-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: linear-gradient(90deg, #6366f1, #8b5cf6, #a855f7);
    }

    .filter-title {
        font-size: 1.1rem;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 1.25rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .filter-title i {
        color: #6366f1;
    }

    .filter-form {
        display: flex;
        flex-wrap: wrap;
        gap: 1.25rem;
        align-items: flex-end;
    }

    .filter-group {
        flex: 1;
        min-width: 200px;
    }

    .filter-label {
        display: block;
        font-size: 0.875rem;
        font-weight: 600;
        color: #475569;
        margin-bottom: 0.5rem;
    }

    .filter-input {
        width: 100%;
        padding: 0.75rem 1rem;
        border: 2px solid #e2e8f0;
        border-radius: 12px;
        font-size: 0.95rem;
        font-family: inherit;
        color: #1e293b;
        background: #f8fafc;
        transition: all 0.3s ease;
    }

    .filter-input:focus {
        outline: none;
        border-color: #6366f1;
        background: white;
        box-shadow: 0 0 0 4px rgba(99, 102, 241, 0.1);
    }

    .filter-btn {
        padding: 0.75rem 2rem;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 0.95rem;
        font-weight: 600;
        font-family: inherit;
        cursor: pointer;
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        box-shadow: 0 4px 15px rgba(99, 102, 241, 0.4);
        transition: all 0.3s ease;
        min-width: 160px;
        justify-content: center;
    }

    .filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 8px 25px rgba(99, 102, 241, 0.5);
    }

    .filter-btn:active {
        transform: translateY(0);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
    }

    /* Stat Card */
    .stat-card {
        background: white;
        border-radius: 20px;
        padding: 1.75rem;
        position: relative;
        overflow: hidden;
        box-shadow: 0 4px 6px -1px rgb(0 0 0 / 0.1), 0 2px 4px -2px rgb(0 0 0 / 0.1);
        border: 1px solid #e2e8f0;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .stat-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 40px -15px rgba(0, 0, 0, 0.15);
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        background: var(--stat-gradient);
    }

    .stat-card.income {
        --stat-gradient: linear-gradient(135deg, #10b981, #34d399);
        --stat-color: #10b981;
        --stat-bg: rgba(16, 185, 129, 0.1);
    }

    .stat-card.expense {
        --stat-gradient: linear-gradient(135deg, #ef4444, #f87171);
        --stat-color: #ef4444;
        --stat-bg: rgba(239, 68, 68, 0.1);
    }

    .stat-card.profit {
        --stat-gradient: linear-gradient(135deg, #6366f1, #8b5cf6);
        --stat-color: #6366f1;
        --stat-bg: rgba(99, 102, 241, 0.1);
    }

    .stat-card.loss {
        --stat-gradient: linear-gradient(135deg, #f59e0b, #fbbf24);
        --stat-color: #f59e0b;
        --stat-bg: rgba(245, 158, 11, 0.1);
    }

    .stat-header {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        margin-bottom: 1.25rem;
    }

    .stat-icon {
        width: 56px;
        height: 56px;
        background: var(--stat-bg);
        border-radius: 16px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--stat-color);
        font-size: 1.5rem;
    }

    .stat-badge {
        padding: 0.35rem 0.75rem;
        background: var(--stat-bg);
        color: var(--stat-color);
        border-radius: 50px;
        font-size: 0.75rem;
        font-weight: 600;
        display: flex;
        align-items: center;
        gap: 0.25rem;
    }

    .stat-label {
        font-size: 0.9rem;
        font-weight: 600;
        color: #64748b;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .stat-value {
        font-size: 1.85rem;
        font-weight: 800;
        color: #1e293b;
        letter-spacing: -0.025em;
        line-height: 1.2;
    }

    .stat-value small {
        font-size: 1rem;
        font-weight: 600;
        color: #64748b;
    }

    .stat-footer {
        margin-top: 1rem;
        padding-top: 1rem;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        font-size: 0.85rem;
        color: #64748b;
    }

    .stat-footer i {
        color: var(--stat-color);
    }

    /* Decorative Background */
    .stat-card-bg {
        position: absolute;
        bottom: -20px;
        right: -20px;
        width: 120px;
        height: 120px;
        background: var(--stat-bg);
        border-radius: 50%;
        opacity: 0.5;
    }

    .stat-card-bg-2 {
        position: absolute;
        bottom: 20px;
        right: 40px;
        width: 60px;
        height: 60px;
        background: var(--stat-bg);
        border-radius: 50%;
        opacity: 0.3;
    }

    /* Summary Section */
    .summary-card {
        background: linear-gradient(135deg, #1e293b 0%, #0f172a 100%);
        border-radius: 20px;
        padding: 2rem;
        position: relative;
        overflow: hidden;
        margin-bottom: 2rem;
    }

    .summary-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 3px;
        background: linear-gradient(90deg, #6366f1, #0ea5e9, #10b981);
    }

    .summary-card::after {
        content: '';
        position: absolute;
        top: -50%;
        right: -10%;
        width: 300px;
        height: 300px;
        background: radial-gradient(circle, rgba(99, 102, 241, 0.1), transparent);
        border-radius: 50%;
    }

    .summary-header {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .summary-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #6366f1, #8b5cf6);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.25rem;
    }

    .summary-title {
        color: white;
        font-size: 1.25rem;
        font-weight: 700;
        margin: 0;
    }

    .summary-subtitle {
        color: #94a3b8;
        font-size: 0.875rem;
        margin: 0;
    }

    .summary-content {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 1.5rem;
        position: relative;
        z-index: 1;
    }

    .summary-item {
        text-align: center;
        padding: 1rem;
        background: rgba(255, 255, 255, 0.05);
        border-radius: 12px;
        border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .summary-item-label {
        font-size: 0.8rem;
        color: #94a3b8;
        text-transform: uppercase;
        letter-spacing: 0.05em;
        margin-bottom: 0.5rem;
    }

    .summary-item-value {
        font-size: 1.5rem;
        font-weight: 700;
        color: white;
    }

    .summary-item-value.positive {
        color: #34d399;
    }

    .summary-item-value.negative {
        color: #f87171;
    }

    /* Progress Bar */
    .progress-section {
        margin-top: 1.5rem;
        padding-top: 1.5rem;
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        position: relative;
        z-index: 1;
    }

    .progress-label {
        display: flex;
        justify-content: space-between;
        margin-bottom: 0.75rem;
        font-size: 0.875rem;
    }

    .progress-label span:first-child {
        color: #94a3b8;
    }

    .progress-label span:last-child {
        color: white;
        font-weight: 600;
    }

    .progress-bar-custom {
        height: 10px;
        background: rgba(255, 255, 255, 0.1);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        border-radius: 10px;
        transition: width 1s ease;
    }

    .progress-fill.positive {
        background: linear-gradient(90deg, #10b981, #34d399);
    }

    .progress-fill.negative {
        background: linear-gradient(90deg, #ef4444, #f87171);
    }

    /* Quick Actions */
    .quick-actions {
        display: flex;
        gap: 1rem;
        flex-wrap: wrap;
    }

    .quick-action-btn {
        display: inline-flex;
        align-items: center;
        gap: 0.5rem;
        padding: 0.75rem 1.25rem;
        background: rgba(255, 255, 255, 0.1);
        border: 1px solid rgba(255, 255, 255, 0.2);
        border-radius: 10px;
        color: white;
        font-size: 0.9rem;
        font-weight: 500;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .quick-action-btn:hover {
        background: rgba(255, 255, 255, 0.15);
        transform: translateY(-2px);
        color: white;
    }

    /* Animation */
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
    .delay-5 { animation-delay: 0.5s; }

    /* Responsive */
    @media (max-width: 768px) {
        .page-title {
            font-size: 1.5rem;
        }

        .stat-value {
            font-size: 1.5rem;
        }

        .filter-form {
            flex-direction: column;
        }

        .filter-group {
            width: 100%;
        }

        .filter-btn {
            width: 100%;
        }
    }
</style>
@endpush

@section('content')
<div class="reports-container">
    {{-- Page Header --}}
    <div class="page-header animate-in">
        <h1 class="page-title">
            <div class="page-title-icon">
                <i class="bi bi-graph-up-arrow"></i>
            </div>
            Laporan Keuangan
        </h1>
        <p class="page-subtitle">Analisis pendapatan, pengeluaran, dan profitabilitas bisnis Anda</p>
    </div>

    {{-- Filter Card --}}
    <div class="filter-card animate-in delay-1">
        <h3 class="filter-title">
            <i class="bi bi-funnel"></i>
            Filter Periode Laporan
        </h3>
        <form action="{{ route('reports.index') }}" method="GET" class="filter-form">
            <div class="filter-group">
                <label class="filter-label">
                    <i class="bi bi-calendar-event me-1"></i>Tanggal Mulai
                </label>
                <input type="date" name="start_date" class="filter-input" value="{{ $startDate }}">
            </div>
            <div class="filter-group">
                <label class="filter-label">
                    <i class="bi bi-calendar-check me-1"></i>Tanggal Akhir
                </label>
                <input type="date" name="end_date" class="filter-input" value="{{ $endDate }}">
            </div>
            <div class="filter-group" style="flex: 0 0 auto;">
                <button type="submit" class="filter-btn">
                    <i class="bi bi-search"></i>
                    Terapkan Filter
                </button>
            </div>
        </form>
    </div>

    {{-- Stats Grid --}}
    <div class="stats-grid">
        {{-- Total Income --}}
        <div class="stat-card income animate-in delay-2">
            <div class="stat-card-bg"></div>
            <div class="stat-card-bg-2"></div>
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-arrow-down-circle"></i>
                </div>
                <div class="stat-badge">
                    <i class="bi bi-check-circle-fill"></i>
                    Income
                </div>
            </div>
            <p class="stat-label">Total Pendapatan</p>
            <h3 class="stat-value">
                <small>Rp</small> {{ number_format($totalIncome, 0, ',', '.') }}
            </h3>
            <div class="stat-footer">
                <i class="bi bi-info-circle"></i>
                <span>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Total Expense --}}
        <div class="stat-card expense animate-in delay-3">
            <div class="stat-card-bg"></div>
            <div class="stat-card-bg-2"></div>
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-arrow-up-circle"></i>
                </div>
                <div class="stat-badge">
                    <i class="bi bi-exclamation-circle-fill"></i>
                    Expense
                </div>
            </div>
            <p class="stat-label">Total Pengeluaran</p>
            <h3 class="stat-value">
                <small>Rp</small> {{ number_format($totalExpense, 0, ',', '.') }}
            </h3>
            <div class="stat-footer">
                <i class="bi bi-info-circle"></i>
                <span>Periode: {{ \Carbon\Carbon::parse($startDate)->format('d M') }} - {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</span>
            </div>
        </div>

        {{-- Net Profit/Loss --}}
        <div class="stat-card {{ $netProfit >= 0 ? 'profit' : 'loss' }} animate-in delay-4">
            <div class="stat-card-bg"></div>
            <div class="stat-card-bg-2"></div>
            <div class="stat-header">
                <div class="stat-icon">
                    <i class="bi bi-{{ $netProfit >= 0 ? 'graph-up-arrow' : 'graph-down-arrow' }}"></i>
                </div>
                <div class="stat-badge">
                    <i class="bi bi-{{ $netProfit >= 0 ? 'trophy-fill' : 'exclamation-triangle-fill' }}"></i>
                    {{ $netProfit >= 0 ? 'Profit' : 'Loss' }}
                </div>
            </div>
            <p class="stat-label">{{ $netProfit >= 0 ? 'Laba Bersih' : 'Rugi Bersih' }}</p>
            <h3 class="stat-value">
                <small>Rp</small> {{ number_format(abs($netProfit), 0, ',', '.') }}
            </h3>
            <div class="stat-footer">
                <i class="bi bi-{{ $netProfit >= 0 ? 'arrow-up' : 'arrow-down' }}"></i>
                <span>{{ $netProfit >= 0 ? 'Bisnis menguntungkan' : 'Perlu evaluasi pengeluaran' }}</span>
            </div>
        </div>
    </div>

    {{-- Summary Card --}}
    <div class="summary-card animate-in delay-5">
        <div class="summary-header">
            <div class="summary-icon">
                <i class="bi bi-pie-chart"></i>
            </div>
            <div>
                <h3 class="summary-title">Ringkasan Finansial</h3>
                <p class="summary-subtitle">Analisis cepat performa keuangan</p>
            </div>
        </div>

        <div class="summary-content">
            <div class="summary-item">
                <p class="summary-item-label">Total Transaksi Masuk</p>
                <p class="summary-item-value positive">
                    +Rp {{ number_format($totalIncome, 0, ',', '.') }}
                </p>
            </div>
            <div class="summary-item">
                <p class="summary-item-label">Total Transaksi Keluar</p>
                <p class="summary-item-value negative">
                    -Rp {{ number_format($totalExpense, 0, ',', '.') }}
                </p>
            </div>
            <div class="summary-item">
                <p class="summary-item-label">Margin Keuntungan</p>
                <p class="summary-item-value {{ $netProfit >= 0 ? 'positive' : 'negative' }}">
                    @if($totalIncome > 0)
                        {{ number_format(($netProfit / $totalIncome) * 100, 1) }}%
                    @else
                        0%
                    @endif
                </p>
            </div>
        </div>

        {{-- Progress Bar --}}
        @if($totalIncome > 0 || $totalExpense > 0)
        <div class="progress-section">
            <div class="progress-label">
                <span>Rasio Pengeluaran terhadap Pendapatan</span>
                <span>
                    @if($totalIncome > 0)
                        {{ number_format(($totalExpense / $totalIncome) * 100, 1) }}%
                    @else
                        100%
                    @endif
                </span>
            </div>
            <div class="progress-bar-custom">
                <div class="progress-fill {{ $totalExpense <= $totalIncome ? 'positive' : 'negative' }}"
                     style="width: {{ $totalIncome > 0 ? min(($totalExpense / $totalIncome) * 100, 100) : 100 }}%">
                </div>
            </div>
        </div>
        @endif

        {{-- Quick Actions --}}
        <div class="progress-section">
            <p class="summary-item-label" style="margin-bottom: 1rem;">Aksi Cepat</p>
            <div class="quick-actions">
                <a href="{{ route('finances.index') }}" class="quick-action-btn">
                    <i class="bi bi-wallet2"></i>
                    Lihat Keuangan
                </a>
                <a href="{{ route('orders.index') }}" class="quick-action-btn">
                    <i class="bi bi-cart3"></i>
                    Lihat Pesanan
                </a>
                <a href="#" class="quick-action-btn" onclick="window.print()">
                    <i class="bi bi-printer"></i>
                    Cetak Laporan
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
