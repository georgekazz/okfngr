<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Χρήσιμοι Σύνδεσμοι - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <style>
        :root {
            --color-cyan: #00D1FF;
            --color-purple: #E077FF;
            --color-lime: #E4FF36;
            --color-mint: #ADFFED;
            --color-dark: #1a1a1a;
            --color-gray: #666;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

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

        .dashboard-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: calc(100vh - 73px);
        }

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

        .dashboard-main {
            padding: 2rem;
            background: #f8f9fa;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: var(--color-gray);
        }

        /* Category Section */
        .category-section {
            margin-bottom: 3rem;
        }

        .category-header {
            display: flex;
            align-items: center;
            gap: 1rem;
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid #e0e0e0;
        }

        .category-icon {
            width: 45px;
            height: 45px;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.3rem;
        }

        .category-icon.tools {
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
        }

        .category-icon.documentation {
            background: linear-gradient(135deg, var(--color-purple), #c061e6);
            color: white;
        }

        .category-icon.communication {
            background: linear-gradient(135deg, var(--color-lime), #d4e632);
            color: var(--color-dark);
        }

        .category-icon.resources {
            background: linear-gradient(135deg, var(--color-mint), #8fecd8);
            color: var(--color-dark);
        }

        .category-icon.other {
            background: linear-gradient(135deg, #6c757d, #5a6268);
            color: white;
        }

        .category-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
        }

        .category-count {
            background: #f0f0f0;
            padding: 0.25rem 0.75rem;
            border-radius: 12px;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-gray);
        }

        /* Links Grid */
        .links-grid {
            display: grid;
            grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
            gap: 1.5rem;
        }

        .link-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            transition: all 0.3s ease;
            text-decoration: none;
            display: block;
            border: 2px solid transparent;
        }

        .link-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 25px rgba(0, 209, 255, 0.2);
            border-color: var(--color-cyan);
        }

        .link-card-header {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1rem;
        }

        .link-icon {
            width: 50px;
            height: 50px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.5rem;
            flex-shrink: 0;
        }

        .link-details {
            flex: 1;
            min-width: 0;
        }

        .link-title {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
            display: -webkit-box;
            line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .link-url {
            font-size: 0.85rem;
            color: var(--color-cyan);
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.25rem;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .link-description {
            color: var(--color-gray);
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1rem;
            display: -webkit-box;
            line-clamp: 3;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .link-footer {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding-top: 1rem;
            border-top: 1px solid #f0f0f0;
        }

        .link-meta {
            font-size: 0.8rem;
            color: var(--color-gray);
        }

        .link-arrow {
            width: 30px;
            height: 30px;
            border-radius: 8px;
            background: rgba(0, 209, 255, 0.1);
            color: var(--color-cyan);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s;
        }

        .link-card:hover .link-arrow {
            background: var(--color-cyan);
            color: white;
            transform: translateX(3px);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .empty-state svg {
            color: #ddd;
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--color-gray);
        }

        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: none;
            }

            .links-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Χρήσιμοι Σύνδεσμοι</h1>
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
        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ route('user.dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z"/>
                    </svg>
                    Αρχική
                </a>

                <a href="{{ route('user.day-offs.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z"/>
                        <path d="M13.3333 1.66666V5"/>
                        <path d="M6.66666 1.66666V5"/>
                        <path d="M2.5 8.33334H17.5"/>
                    </svg>
                    Οι Άδειές μου
                </a>

                <a href="{{ route('user.salary-calculator', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="5" width="16" height="12" rx="2"/>
                        <path d="M2 10h16"/>
                        <path d="M6 14h.01"/>
                        <path d="M10 14h.01"/>
                        <path d="M14 14h.01"/>
                    </svg>
                    Υπολογισμός Μισθού
                </a>

                <a href="{{ route('user.calendar', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="14" height="14" rx="2" ry="2"/>
                        <line x1="3" y1="9" x2="17" y2="9"/>
                        <line x1="9" y1="4" x2="9" y2="18"/>
                    </svg>
                    Ημερολόγιο Ομάδας
                </a>

                <a href="{{ route('user.statistics', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    Στατιστικά
                </a>

                <a href="{{ route('user.team-links', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5"/>
                        <path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5"/>
                    </svg>
                    Χρήσιμοι Σύνδεσμοι
                </a>

                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333"/>
                        <path d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667"/>
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <div class="page-header">
                <h2>Χρήσιμοι Σύνδεσμοι</h2>
                <p class="page-subtitle">Γρήγορη πρόσβαση σε όλα τα εργαλεία και πόρους της ομάδας</p>
            </div>

            @if($links->count() > 0)
                @foreach($links as $category => $categoryLinks)
                <div class="category-section">
                    <div class="category-header">
                        <div class="category-icon {{ $category }}">
                            @if($category === 'tools')
                                🛠️
                            @elseif($category === 'documentation')
                                📚
                            @elseif($category === 'communication')
                                💬
                            @elseif($category === 'resources')
                                📦
                            @else
                                🔗
                            @endif
                        </div>
                        <div class="category-title">
                            @if($category === 'tools')
                                Εργαλεία
                            @elseif($category === 'documentation')
                                Τεκμηρίωση
                            @elseif($category === 'communication')
                                Επικοινωνία
                            @elseif($category === 'resources')
                                Πόροι
                            @else
                                Άλλα
                            @endif
                        </div>
                        <div class="category-count">{{ $categoryLinks->count() }}</div>
                    </div>

                    <div class="links-grid">
                        @foreach($categoryLinks as $link)
                        <a href="{{ $link->url }}" target="_blank" rel="noopener noreferrer" class="link-card">
                            <div class="link-card-header">
                                <div class="link-icon">
                                    @if($link->icon)
                                        {!! $link->icon !!}
                                    @else
                                        🔗
                                    @endif
                                </div>
                                <div class="link-details">
                                    <div class="link-title">{{ $link->title }}</div>
                                    <div class="link-url">
                                        <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M18 13v6a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V8a2 2 0 0 1 2-2h6"/>
                                            <polyline points="15 3 21 3 21 9"/>
                                            <line x1="10" y1="14" x2="21" y2="3"/>
                                        </svg>
                                        {{ parse_url($link->url, PHP_URL_HOST) }}
                                    </div>
                                </div>
                            </div>

                            @if($link->description)
                            <div class="link-description">
                                {{ $link->description }}
                            </div>
                            @endif

                            <div class="link-footer">
                                <div class="link-meta">
                                    Προστέθηκε από {{ $link->creator->name }}
                                </div>
                                <div class="link-arrow">
                                    <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M5 12h14"/>
                                        <path d="m12 5 7 7-7 7"/>
                                    </svg>
                                </div>
                            </div>
                        </a>
                        @endforeach
                    </div>
                </div>
                @endforeach
            @else
                <div class="empty-state">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M10 13a5 5 0 0 0 7.54.54l3-3a5 5 0 0 0-7.07-7.07l-1.72 1.71"/>
                        <path d="M14 11a5 5 0 0 0-7.54-.54l-3 3a5 5 0 0 0 7.07 7.07l1.71-1.71"/>
                    </svg>
                    <h3>Δεν υπάρχουν σύνδεσμοι</h3>
                    <p>Δεν έχουν προστεθεί σύνδεσμοι ακόμα</p>
                </div>
            @endif
        </main>
    </div>
</body>
</html>