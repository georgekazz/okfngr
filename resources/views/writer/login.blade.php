<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Σύνδεση Συντάκτη - OKFN Greece</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerlogin.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">

</head>

<body>
    <div class="login-page">
        <div class="login-container">
            <div class="login-header">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="login-logo">
                <h1 class="login-title">Σύνδεση Συντάκτη</h1>
                <p class="login-subtitle">Συνδεθείτε για να διαχειριστείτε τα άρθρα σας</p>
            </div>

            @if (session('errors') && session('errors')->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 1.5rem;">
                        @foreach (session('errors')->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ url('/el/writer/login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" id="email" name="email" value="{{ old('email') }}"
                        class="form-input {{ session('errors') && session('errors')->has('email') ? 'error' : '' }}"
                        required autofocus>
                    @if (session('errors') && session('errors')->has('email'))
                        <span class="error-message">{{ session('errors')->first('email') }}</span>
                    @endif
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Κωδικός</label>
                    <input type="password" id="password" name="password"
                        class="form-input {{ session('errors') && session('errors')->has('password') ? 'error' : '' }}"
                        required>
                    @if (session('errors') && session('errors')->has('password'))
                        <span class="error-message">{{ session('errors')->first('password') }}</span>
                    @endif
                </div>

                <div class="form-checkbox">
                    <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }}>
                    <label for="remember">Να με θυμάσαι</label>
                </div>

                <button type="submit" class="login-button">
                    Σύνδεση
                </button>
            </form>

            <div class="login-footer">
                <a href="/el" class="back-link">
                    ← Επιστροφή στην Αρχική
                </a>
            </div>
        </div>
    </div>
</body>

</html>