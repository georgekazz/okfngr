<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Οι Άδειές μου - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <style>
        :root {
            --color-cyan: #00D1FF;
            --color-purple: #E077FF;
            --color-lime: #E4FF36;
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

        .alert svg {
            flex-shrink: 0;
        }

        .actions-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 2rem;
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

        .dayoffs-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .dayoffs-table {
            width: 100%;
            border-collapse: collapse;
        }

        .dayoffs-table thead {
            background: #f8f9fa;
        }

        .dayoffs-table th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e0e0e0;
        }

        .dayoffs-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: middle;
        }

        .dayoffs-table tbody tr:hover {
            background: #f8f9fa;
        }

        .date-range {
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 0.25rem;
        }

        .days-count {
            font-size: 0.9rem;
            color: var(--color-gray);
        }

        .type-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
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

        .reason-text {
            color: var(--color-dark);
            max-width: 300px;
        }

        .notes-text {
            color: var(--color-gray);
            font-size: 0.9rem;
            font-style: italic;
            max-width: 300px;
        }

        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-icon {
            width: 36px;
            height: 36px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            text-decoration: none;
            color: var(--color-gray);
        }

        .btn-icon:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-edit:hover {
            border-color: var(--color-cyan);
            color: var(--color-cyan);
            background: rgba(0, 209, 255, 0.05);
        }

        .btn-delete:hover {
            border-color: #dc3545;
            color: #dc3545;
            background: rgba(220, 53, 69, 0.05);
        }

        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
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
            margin-bottom: 2rem;
        }

        .pagination-wrapper {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: none;
            }

            .dayoffs-table {
                font-size: 0.9rem;
            }

            .dayoffs-table th,
            .dayoffs-table td {
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Οι Άδειές μου</h1>
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

                <a href="{{ route('user.day-offs.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z"/>
                        <path d="M13.3333 1.66666V5"/>
                        <path d="M6.66666 1.66666V5"/>
                        <path d="M2.5 8.33334H17.5"/>
                    </svg>
                    Οι Άδειές μου
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

                <a href="{{ route('user.team-links', ['locale' => app()->getLocale()]) }}" class="nav-link">
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
                <h2>Οι Άδειές μου</h2>
                <p class="page-subtitle">Διαχειριστείτε όλες τις άδειές σας</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <div class="actions-bar">
                <a href="{{ route('user.day-offs.create', ['locale' => app()->getLocale()]) }}" class="btn-primary">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 4.16667V15.8333"/>
                        <path d="M4.16667 10H15.8333"/>
                    </svg>
                    Νέα Άδεια
                </a>
            </div>

            <div class="dayoffs-container">
                @if($dayOffs->count() > 0)
                <table class="dayoffs-table">
                    <thead>
                        <tr>
                            <th>Ημερομηνίες</th>
                            <th>Τύπος</th>
                            <th>Λόγος</th>
                            <th>Σημειώσεις</th>
                            <th>Ενέργειες</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($dayOffs as $dayOff)
                        <tr>
                            <td>
                                <div class="date-range">
                                    {{ $dayOff->start_date->format('d/m/Y') }} - {{ $dayOff->end_date->format('d/m/Y') }}
                                </div>
                                <div class="days-count">
                                    {{ $dayOff->total_days }} {{ $dayOff->total_days == 1 ? 'μέρα' : 'μέρες' }}
                                </div>
                            </td>
                            <td>
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
                            </td>
                            <td>
                                <div class="reason-text">{{ $dayOff->reason ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="notes-text">{{ $dayOff->notes ?? '-' }}</div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('user.day-offs.edit', ['locale' => app()->getLocale(), 'dayOff' => $dayOff->id]) }}" class="btn-icon btn-edit" title="Επεξεργασία">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M8.25 3H3C2.60218 3 2.22064 3.15804 1.93934 3.43934C1.65804 3.72064 1.5 4.10218 1.5 4.5V15C1.5 15.3978 1.65804 15.7794 1.93934 16.0607C2.22064 16.342 2.60218 16.5 3 16.5H13.5C13.8978 16.5 14.2794 16.342 14.5607 16.0607C14.842 15.7794 15 15.3978 15 15V9.75"/>
                                            <path d="M13.875 1.87498C14.1734 1.57661 14.5778 1.40918 15 1.40918C15.4222 1.40918 15.8266 1.57661 16.125 1.87498C16.4234 2.17336 16.5908 2.57782 16.5908 2.99998C16.5908 3.42215 16.4234 3.82661 16.125 4.12498L9 11.25L6 12L6.75 9L13.875 1.87498Z"/>
                                        </svg>
                                    </a>

                                    <form action="{{ route('user.day-offs.destroy', ['locale' => app()->getLocale(), 'dayOff' => $dayOff->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτή την άδεια;')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-icon btn-delete" title="Διαγραφή">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M2.25 4.5H3.75H15.75"/>
                                                <path d="M6 4.5V3C6 2.60218 6.15804 2.22064 6.43934 1.93934C6.72064 1.65804 7.10218 1.5 7.5 1.5H10.5C10.8978 1.5 11.2794 1.65804 11.5607 1.93934C11.842 2.22064 12 2.60218 12 3V4.5M14.25 4.5V15C14.25 15.3978 14.092 15.7794 13.8107 16.0607C13.5294 16.342 13.1478 16.5 12.75 16.5H5.25C4.85218 16.5 4.47064 16.342 4.18934 16.0607C3.90804 15.7794 3.75 15.3978 3.75 15V4.5H14.25Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    {{ $dayOffs->links() }}
                </div>
                @else
                <div class="empty-state">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
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