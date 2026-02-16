<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin Dashboard - OKFN Greece</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/welcome.css') }}">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <!-- Dashboard Header -->
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Admin Panel</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }} (Admin)</span>
                <form action="{{ url('/el/writer/logout') }}" method="POST" style="display: inline;">
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
                <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 17.5V10H12.5V17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Dashboard
                </a>
                <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M14 17.5V15.8333C14 14.9493 13.6488 14.1014 13.0237 13.4763C12.3986 12.8512 11.5507 12.5 10.6667 12.5H5C4.11595 12.5 3.2681 12.8512 2.64298 13.4763C2.01786 14.1014 1.66667 14.9493 1.66667 15.8333V17.5"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M7.83333 9.16667C9.67428 9.16667 11.1667 7.67428 11.1667 5.83333C11.1667 3.99238 9.67428 2.5 7.83333 2.5C5.99238 2.5 4.5 3.99238 4.5 5.83333C4.5 7.67428 5.99238 9.16667 7.83333 9.16667Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M18.3333 17.5V15.8333C18.3328 15.0948 18.0804 14.3773 17.6187 13.7936C17.157 13.2099 16.5126 12.793 15.7833 12.6083"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M12.95 2.60834C13.6808 2.79192 14.3266 3.20892 14.7891 3.79359C15.2517 4.37827 15.5042 5.09736 15.5042 5.8375C15.5042 6.57765 15.2517 7.29674 14.7891 7.88141C14.3266 8.46609 13.6808 8.88309 12.95 9.06667"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Χρήστες
                </a>
                <a href="{{ route('admin.posts.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 7.5H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M7.5 10.8333H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M7.5 14.1667H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Άρθρα
                </a>
                <a href="{{ route('admin.comments.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M17.5 9.58333C17.5029 10.6832 17.2459 11.7683 16.75 12.75C16.162 13.9265 15.2581 14.916 14.1395 15.6078C13.021 16.2995 11.7319 16.6662 10.4167 16.6667C9.31678 16.6696 8.23176 16.4126 7.25 15.9167L2.5 17.5L4.08333 12.75C3.58744 11.7683 3.33047 10.6832 3.33333 9.58333C3.33384 8.26812 3.70051 6.97904 4.39227 5.86045C5.08402 4.74187 6.07355 3.838 7.25 3.25C8.23176 2.75411 9.31678 2.49713 10.4167 2.5H10.8333C12.5703 2.59583 14.2109 3.32899 15.441 4.55906C16.671 5.78913 17.4042 7.42971 17.5 9.16667V9.58333Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Σχόλια
                </a>
                <a href="{{ url('/el') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M18.3333 10C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39763 18.3333 1.66667 14.6024 1.66667 10C1.66667 5.39763 5.39763 1.66667 10 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10Z"
                            stroke="currentColor" stroke-width="1.5" />
                        <path
                            d="M13.3333 10C13.3333 11.8409 11.8409 13.3333 10 13.3333C8.15905 13.3333 6.66667 11.8409 6.66667 10C6.66667 8.15905 8.15905 6.66667 10 6.66667"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            @if(session('success'))
                <div class="alert alert-success"
                    style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Stats Grid -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-icon published">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M17 21V19C17 17.9391 16.5786 16.9217 15.8284 16.1716C15.0783 15.4214 14.0609 15 13 15H5C3.93913 15 2.92172 15.4214 2.17157 16.1716C1.42143 16.9217 1 17.9391 1 19V21"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path
                                d="M9 11C11.2091 11 13 9.20914 13 7C13 4.79086 11.2091 3 9 3C6.79086 3 5 4.79086 5 7C5 9.20914 6.79086 11 9 11Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['total_users'] }}</div>
                        <div class="stat-label">Σύνολο Χρηστών</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon draft">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['total_posts'] }}</div>
                        <div class="stat-label">Σύνολο Άρθρων</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon total">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M21 15C21 15.5304 20.7893 16.0391 20.4142 16.4142C20.0391 16.7893 19.5304 17 19 17H7L3 21V5C3 4.46957 3.21071 3.96086 3.58579 3.58579C3.96086 3.21071 4.46957 3 5 3H19C19.5304 3 20.0391 3.21071 20.4142 3.58579C20.7893 3.96086 21 4.46957 21 5V15Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['total_comments'] }}</div>
                        <div class="stat-label">Σύνολο Σχολίων</div>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-icon" style="background: #fff3cd; color: #856404;">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path
                                d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z"
                                stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M12 8V12" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                            <path d="M12 16H12.01" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" />
                        </svg>
                    </div>
                    <div class="stat-content">
                        <div class="stat-value">{{ $stats['pending_comments'] }}</div>
                        <div class="stat-label">Σχόλια σε Αναμονή</div>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="posts-section" style="margin-top: 30px;">
                <div class="section-header">
                    <h2>Γρήγορες Ενέργειες</h2>
                </div>
                <div
                    style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 15px; margin-top: 20px;">
                    <a href="{{ route('admin.users.create', ['locale' => app()->getLocale()]) }}" class="btn-primary"
                        style="text-align: center;">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none" style="margin-right: 8px;">
                            <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Νέος Χρήστης
                    </a>
                    <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="btn-primary"
                        style="text-align: center; background: #6c757d;">
                        Διαχείριση Χρηστών
                    </a>
                    <a href="{{ route('admin.posts.index', ['locale' => app()->getLocale()]) }}" class="btn-primary"
                        style="text-align: center; background: #28a745;">
                        Διαχείριση Άρθρων
                    </a>
                    <a href="{{ route('admin.comments.index', ['locale' => app()->getLocale()]) }}" class="btn-primary"
                        style="text-align: center; background: #ffc107; color: #000;">
                        Έλεγχος Σχολίων
                    </a>
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="posts-section" style="margin-top: 30px;">
                <div class="section-header">
                    <h2>Πρόσφατοι Χρήστες</h2>
                </div>
                <div class="posts-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Όνομα</th>
                                <th>Email</th>
                                <th>Ρόλος</th>
                                <th>Ημερομηνία</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($recentUsers as $user)
                                <tr>
                                    <td><strong>{{ $user->name }}</strong></td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <span
                                            class="status-badge status-{{ $user->role === 'admin' ? 'published' : 'draft' }}">
                                            {{ ucfirst($user->role) }}
                                        </span>
                                    </td>
                                    <td>{{ $user->created_at->format('d/m/Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </main>
    </div>
</body>

</html>