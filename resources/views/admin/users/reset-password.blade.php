<!DOCTYPE html>
<html lang="el">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Αλλαγή Κωδικού - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin/admin-dashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <style>
        .form-container {
            max-width: 600px;
            margin: 0 auto;
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        }
        .form-group {
            margin-bottom: 20px;
        }
        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            color: #333;
        }
        .form-group input {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 14px;
            font-family: 'Roboto', sans-serif;
        }
        .form-group input:focus {
            outline: none;
            border-color: #007bff;
        }
        .error-message {
            color: #dc3545;
            font-size: 13px;
            margin-top: 5px;
        }
        .form-actions {
            display: flex;
            gap: 10px;
            margin-top: 30px;
        }
        .required {
            color: #dc3545;
        }
        .user-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 4px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Αλλαγή Κωδικού</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }} (Admin)</span>
                <form action="{{ url('/'.app()->getLocale().'/writer/logout') }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Αποσύνδεση</button>
                </form>
            </div>
        </div>
    </header>

    <div class="dashboard-layout">
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
                <a href="{{ route('admin.team-links.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5"/><path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5"/></svg>
                    Σύνδεσμοι Ομάδας
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

        <main class="dashboard-main">
            <div class="form-container">
                <h2 style="margin-bottom: 20px;">Αλλαγή Κωδικού</h2>
                
                <div class="user-info">
                    <p style="margin: 0;"><strong>Χρήστης:</strong> {{ $user->name }}</p>
                    <p style="margin: 5px 0 0;"><strong>Email:</strong> {{ $user->email }}</p>
                </div>

                <form action="{{ route('admin.users.update-password', ['locale' => app()->getLocale(), 'user' => $user->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="password">Νέος Κωδικός <span class="required">*</span></label>
                        <input type="password" id="password" name="password" required>
                        <small style="color: #6c757d;">Τουλάχιστον 8 χαρακτήρες</small>
                        @error('password')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password_confirmation">Επιβεβαίωση Κωδικού <span class="required">*</span></label>
                        <input type="password" id="password_confirmation" name="password_confirmation" required>
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-primary">Αλλαγή Κωδικού</button>
                        <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="btn-primary" style="background: #6c757d; text-decoration: none;">Ακύρωση</a>
                    </div>
                </form>
            </div>
        </main>
    </div>
</body>
</html>