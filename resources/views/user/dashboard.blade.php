<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <style>
        :root {
            --color-cyan: #00D1FF;
            --color-mint: #ADFFED;
            --color-lime: #E4FF36;
            --color-purple: #E077FF;
            --color-dark: #1a1a1a;
            --color-gray: #666;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        /* Header */
        .dashboard-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-container {
            max-width: 100%;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .dashboard-logo {
            height: 40px;
        }

        .dashboard-header h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-name {
            font-weight: 600;
            color: var(--color-gray);
        }

        .logout-btn {
            padding: 0.625rem 1.25rem;
            background: transparent;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            color: var(--color-dark);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            border-color: var(--color-cyan);
            color: var(--color-cyan);
        }

        /* Layout */
        .dashboard-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: calc(100vh - 73px);
        }

        /* Sidebar */
        .dashboard-sidebar {
            background: var(--color-dark);
            padding: 2rem 0;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border-radius: 8px;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 209, 255, 0.3);
        }

        .nav-link svg {
            flex-shrink: 0;
        }

        /* Main Content */
        .dashboard-main {
            padding: 2rem;
            background: #f8f9fa;
        }

        /* Stats Grid */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 1.5rem;
            margin-bottom: 3rem;
        }

        .stat-card {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            display: flex;
            align-items: center;
            gap: 1.5rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s;
        }

        .stat-card:hover {
            transform: translateY(-5px);
        }

        .stat-icon {
            width: 60px;
            height: 60px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .stat-icon.cyan {
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
        }

        .stat-icon.purple {
            background: linear-gradient(135deg, var(--color-purple), #c061e6);
            color: white;
        }

        .stat-icon.lime {
            background: linear-gradient(135deg, var(--color-lime), #d4e632);
            color: var(--color-dark);
        }

        .stat-icon.mint {
            background: linear-gradient(135deg, var(--color-mint), #8fecd8);
            color: var(--color-dark);
        }

        .stat-value {
            font-size: 2.5rem;
            font-weight: 900;
            color: var(--color-dark);
        }

        .stat-label {
            color: var(--color-gray);
            font-size: 0.9rem;
            font-weight: 500;
        }

        /* Section */
        .section {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
        }

        .section-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .section-header h2 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
            border: none;
            border-radius: 8px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.3s;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 209, 255, 0.3);
        }

        /* Day Off List */
        .dayoff-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .dayoff-item {
            padding: 1.5rem;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .dayoff-item:hover {
            border-color: var(--color-cyan);
            box-shadow: 0 4px 12px rgba(0, 209, 255, 0.1);
        }

        .dayoff-info h3 {
            font-size: 1.1rem;
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .dayoff-meta {
            display: flex;
            gap: 1.5rem;
            font-size: 0.9rem;
            color: var(--color-gray);
        }

        .dayoff-meta span {
            display: flex;
            align-items: center;
            gap: 0.25rem;
        }

        .type-badge {
            padding: 0.375rem 0.875rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .type-vacation {
            background: rgba(0, 209, 255, 0.1);
            color: var(--color-cyan);
        }

        .type-sick {
            background: rgba(224, 119, 255, 0.1);
            color: var(--color-purple);
        }

        .type-personal {
            background: rgba(228, 255, 54, 0.2);
            color: #9a8800;
        }

        .type-other {
            background: #f0f0f0;
            color: var(--color-gray);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-state svg {
            color: #ddd;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--color-gray);
            margin-bottom: 1.5rem;
        }

        /* Alert */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 12px;
            margin-bottom: 1.5rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid #28a745;
            color: #155724;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: none;
            }

            .stats-grid {
                grid-template-columns: 1fr;
            }

            .dayoff-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>

<body>
    <!-- Dashboard Header -->
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Πίνακας Ελέγχου</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('writer.logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Αποσύνδεση</button>
                </form>
            </div>
        </div>
    </header>

    <div class="dashboard-layout">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ route('user.dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z" />
                    </svg>
                    Αρχική
                </a>

                <a href="{{ route('user.day-offs.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z" />
                        <path d="M13.3333 1.66666V5" />
                        <path d="M6.66666 1.66666V5" />
                        <path d="M2.5 8.33334H17.5" />
                    </svg>
                    Οι Άδειές μου
                </a>

                <a href="{{ route('user.salary-calculator', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="5" width="16" height="12" rx="2" />
                        <path d="M2 10h16" />
                        <path d="M6 14h.01" />
                        <path d="M10 14h.01" />
                        <path d="M14 14h.01" />
                    </svg>
                    Υπολογισμός Μισθού
                </a>

                <a href="{{ route('user.calendar', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="14" height="14" rx="2" ry="2" />
                        <line x1="3" y1="9" x2="17" y2="9" />
                        <line x1="9" y1="4" x2="9" y2="18" />
                    </svg>
                    Ημερολόγιο Ομάδας
                </a>

                <a href="{{ route('user.statistics', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    Στατιστικά
                </a>

                <a href="{{ route('user.team-links', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5" />
                        <path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5" />
                    </svg>
                    Χρήσιμοι Σύνδεσμοι
                </a>

                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333" />
                        <path d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667" />
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            @if(session('success'))
            <div class="alert alert-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon cyan">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2" />
                            <circle cx="12" cy="7" r="4" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['my_total_days'] }}</div>
                        <div class="stat-label">Μέρες Άδειας ({{ date('Y') }})</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon purple">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                            <line x1="16" y1="2" x2="16" y2="6" />
                            <line x1="8" y1="2" x2="8" y2="6" />
                            <line x1="3" y1="10" x2="21" y2="10" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['my_upcoming'] }}</div>
                        <div class="stat-label">Επερχόμενες Άδειες</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon lime">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['team_total_days'] }}</div>
                        <div class="stat-label">Σύνολο Ομάδας ({{ date('Y') }})</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon mint">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2" />
                            <circle cx="9" cy="7" r="4" />
                            <path d="M23 21v-2a4 4 0 0 0-3-3.87" />
                            <path d="M16 3.13a4 4 0 0 1 0 7.75" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['team_members'] }}</div>
                        <div class="stat-label">Μέλη Ομάδας</div>
                    </div>
                </div>
            </div>

            <!-- Recent Day Offs -->
            <div class="section">
                <div class="section-header">
                    <h2>Πρόσφατες Άδειες</h2>
                    <a href="{{ route('user.day-offs.create', ['locale' => app()->getLocale()]) }}" class="btn-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                            <path d="M10 4.16667V15.8333" />
                            <path d="M4.16667 10H15.8333" />
                        </svg>
                        Νέα Άδεια
                    </a>
                </div>

                @if($myDayOffs->count() > 0)
                <div class="dayoff-list">
                    @foreach($myDayOffs as $dayOff)
                    <div class="dayoff-item">
                        <div class="dayoff-info">
                            <h3>{{ $dayOff->start_date->format('d/m/Y') }} - {{ $dayOff->end_date->format('d/m/Y') }}</h3>
                            <div class="dayoff-meta">
                                <span>
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                        <rect x="3" y="4" width="14" height="14" rx="2" ry="2" />
                                    </svg>
                                    {{ $dayOff->total_days }} {{ $dayOff->total_days == 1 ? 'μέρα' : 'μέρες' }}
                                </span>
                                @if($dayOff->reason)
                                <span>{{ Str::limit($dayOff->reason, 50) }}</span>
                                @endif
                            </div>
                        </div>
                        <span class="type-badge type-{{ $dayOff->type }}">
                            @if($dayOff->type === 'vacation')
                            Διακοπές
                            @elseif($dayOff->type === 'sick')
                            Ασθένεια
                            @elseif($dayOff->type === 'personal')
                            Προσωπική
                            @else
                            Άλλο
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2" />
                        <line x1="16" y1="2" x2="16" y2="6" />
                        <line x1="8" y1="2" x2="8" y2="6" />
                        <line x1="3" y1="10" x2="21" y2="10" />
                    </svg>
                    <h3>Δεν έχετε άδειες</h3>
                    <p>Δημιουργήστε την πρώτη σας άδεια</p>
                    <a href="{{ route('user.day-offs.create', ['locale' => app()->getLocale()]) }}" class="btn-primary">
                        Νέα Άδεια
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>

</html>