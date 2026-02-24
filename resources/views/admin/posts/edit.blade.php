<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ isset($post) ? 'Επεξεργασία Άρθρου' : 'Δημιουργία Άρθρου' }} - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminManage.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.tiny.cloud/1/5seorlrf0fc75ossjv7xrxelfgubizejfpbn3bhrasuppiwa/tinymce/8/tinymce.min.js" referrerpolicy="origin" crossorigin="anonymous"></script>
    <style>
        /* ── Editor Layout ── */
        .editor-layout {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 2rem;
            align-items: start;
        }

        .editor-main {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
        }

        .editor-sidebar {
            display: flex;
            flex-direction: column;
            gap: 1.5rem;
            position: sticky;
            top: 105px;
        }

        /* ── Cards ── */
        .editor-card {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            overflow: hidden;
        }

        .editor-card-header {
            padding: 1.25rem 1.5rem;
            border-bottom: 2px solid var(--color-border);
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .editor-card-header h3 {
            font-size: 1rem;
            font-weight: 700;
            color: var(--color-dark);
        }

        .editor-card-header svg {
            color: var(--color-cyan);
            flex-shrink: 0;
        }

        .editor-card-body {
            padding: 1.5rem;
        }

        /* ── Form Elements ── */
        .form-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            margin-bottom: 1.25rem;
        }

        .form-group:last-child {
            margin-bottom: 0;
        }

        .form-label {
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .form-input,
        .form-textarea,
        .form-select {
            width: 100%;
            padding: 0.875rem 1rem;
            border: 2px solid var(--color-border);
            border-radius: 8px;
            font-size: 1rem;
            font-family: 'Roboto', sans-serif;
            color: var(--color-dark);
            background: white;
            transition: all 0.3s ease;
        }

        .form-input:focus,
        .form-textarea:focus,
        .form-select:focus {
            outline: none;
            border-color: var(--color-cyan);
            box-shadow: 0 0 0 3px rgba(0,209,255,0.1);
        }

        .form-input.error,
        .form-textarea.error {
            border-color: var(--color-danger);
        }

        .title-input {
            font-size: 1.4rem;
            font-weight: 700;
            padding: 1rem 1.25rem;
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
            line-height: 1.6;
        }

        .error-message {
            color: var(--color-danger);
            font-size: 0.85rem;
            font-weight: 500;
        }

        /* ── Alerts ── */
        .alert-error {
            background: rgba(220,53,69,0.08);
            border: 1px solid var(--color-danger);
            color: #721c24;
            padding: 1rem 1.5rem;
            border-radius: 10px;
        }

        .alert-error ul {
            margin: 0;
            padding-left: 1.25rem;
        }

        /* ── Publish Buttons ── */
        .publish-actions {
            display: flex;
            flex-direction: column;
            gap: 0.75rem;
        }

        .btn-primary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-primary:hover {
            background: linear-gradient(135deg, #00b8e6, #009fcc);
            transform: translateY(-1px);
            box-shadow: 0 4px 15px rgba(0,209,255,0.3);
        }

        .btn-secondary {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.5rem;
            padding: 0.875rem 1.5rem;
            background: white;
            color: var(--color-gray);
            border: 2px solid var(--color-border);
            border-radius: 8px;
            font-size: 0.95rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
        }

        .btn-secondary:hover {
            border-color: var(--color-cyan);
            color: var(--color-cyan);
        }

        .post-info-small {
            display: flex;
            flex-direction: column;
            gap: 0.4rem;
            margin-top: 1rem;
            padding-top: 1rem;
            border-top: 1px solid var(--color-border);
        }

        .post-info-small small {
            font-size: 0.8rem;
            color: var(--color-gray);
            display: flex;
            align-items: center;
            gap: 0.4rem;
        }

        /* ── Checkboxes ── */
        .checkbox-group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            max-height: 200px;
            overflow-y: auto;
        }

        .checkbox-label {
            display: flex;
            align-items: center;
            gap: 0.625rem;
            padding: 0.5rem 0.75rem;
            border-radius: 8px;
            cursor: pointer;
            transition: background 0.2s ease;
            font-size: 0.9rem;
            color: var(--color-dark);
        }

        .checkbox-label:hover {
            background: rgba(0,209,255,0.06);
        }

        .checkbox-label input[type="checkbox"] {
            width: 16px;
            height: 16px;
            accent-color: var(--color-cyan);
            cursor: pointer;
            flex-shrink: 0;
        }

        /* ── Featured Image ── */
        .current-image {
            margin-bottom: 1rem;
        }

        .current-image img {
            width: 100%;
            height: 160px;
            object-fit: cover;
            border-radius: 8px;
            border: 2px solid var(--color-border);
            margin-bottom: 0.5rem;
        }

        .file-input-wrapper {
            position: relative;
        }

        .file-input {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px dashed var(--color-border);
            border-radius: 8px;
            font-size: 0.9rem;
            cursor: pointer;
            transition: all 0.3s ease;
            background: #fafafa;
        }

        .file-input:hover {
            border-color: var(--color-cyan);
            background: rgba(0,209,255,0.03);
        }

        .file-hint {
            font-size: 0.78rem;
            color: var(--color-gray);
            margin-top: 0.5rem;
        }

        /* ── Status Badge in header ── */
        .status-indicator {
            display: inline-flex;
            align-items: center;
            gap: 0.4rem;
            padding: 0.3rem 0.75rem;
            border-radius: 20px;
            font-size: 0.78rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-indicator.published {
            background: rgba(40,167,69,0.12);
            color: var(--color-success);
        }

        .status-indicator.draft {
            background: rgba(255,193,7,0.12);
            color: #856404;
        }

        .status-indicator::before {
            content: '';
            width: 6px;
            height: 6px;
            border-radius: 50%;
            background: currentColor;
        }

        /* ── TinyMCE wrapper ── */
        .tinymce-wrapper {
            border: 2px solid var(--color-border);
            border-radius: 8px;
            overflow: hidden;
            transition: border-color 0.3s ease;
        }

        .tinymce-wrapper:focus-within {
            border-color: var(--color-cyan);
            box-shadow: 0 0 0 3px rgba(0,209,255,0.1);
        }

        .tinymce-wrapper textarea {
            border: none !important;
        }

        /* ── Back link ── */
        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            color: var(--color-gray);
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            margin-bottom: 1.25rem;
            transition: color 0.2s ease;
        }

        .back-link:hover { color: var(--color-cyan); }

        /* ── Responsive ── */
        @media (max-width: 1024px) {
            .editor-layout {
                grid-template-columns: 1fr;
            }
            .editor-sidebar {
                position: static;
            }
        }
    </style>
</head>
<body>
    <!-- Admin Header -->
    <header class="admin-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="admin-logo">
                <h1>{{ isset($post) ? 'Επεξεργασία Άρθρου' : 'Νέο Άρθρο' }}</h1>
            </div>
            <div class="header-right">
                @if(isset($post))
                    <span class="status-indicator {{ $post->status }}">
                        {{ $post->status === 'published' ? 'Δημοσιευμένο' : 'Πρόχειρο' }}
                    </span>
                @endif
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('admin.logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Αποσύνδεση</button>
                </form>
            </div>
        </div>
    </header>

    <div class="admin-layout">
        <!-- Sidebar Nav -->
        <aside class="admin-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Πίνακας Ελέγχου
                </a>
                <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14.1667 17.5V15.8333C14.1667 14.9493 13.8155 14.1014 13.1904 13.4763C12.5652 12.8512 11.7174 12.5 10.8333 12.5H4.16667C3.28261 12.5 2.43476 12.8512 1.80964 13.4763C1.18452 14.1014 0.833336 14.9493 0.833336 15.8333V17.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.50001 9.16667C9.34096 9.16667 10.8333 7.67428 10.8333 5.83333C10.8333 3.99238 9.34096 2.5 7.50001 2.5C5.65906 2.5 4.16667 3.99238 4.16667 5.83333C4.16667 7.67428 5.65906 9.16667 7.50001 9.16667Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Χρήστες
                </a>
                <a href="{{ route('admin.posts.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Άρθρα
                </a>
                <a href="{{ route('admin.comments.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17.5 11.6667C17.5 12.1087 17.3244 12.5326 17.0118 12.8452C16.6993 13.1577 16.2754 13.3333 15.8333 13.3333H5.83333L2.5 16.6667V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H15.8333C16.2754 2.5 16.6993 2.67559 17.0118 2.98816C17.3244 3.30072 17.5 3.72464 17.5 4.16667V11.6667Z" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Σχόλια
                </a>
                <a href="{{ route('admin.team-links.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5"/>
                        <path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5"/>
                    </svg>
                    Σύνδεσμοι Ομάδας
                </a>
                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333"/>
                        <path d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667" stroke-linecap="round"/>
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">

            <a href="{{ route('admin.posts.index', ['locale' => app()->getLocale()]) }}" class="back-link">
                <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                    <polyline points="12 4 6 10 12 16"/>
                </svg>
                Επιστροφή στα Άρθρα
            </a>

            <form action="{{ isset($post) ? route('admin.posts.update', ['locale' => app()->getLocale(), 'post' => $post->id]) : route('admin.posts.store', ['locale' => app()->getLocale()]) }}"
                  method="POST"
                  enctype="multipart/form-data">
                @csrf
                @if(isset($post))
                    @method('PUT')
                @endif

                <div class="editor-layout">

                    <!-- ── Main Editor Column ── -->
                    <div class="editor-main">

                        @if($errors->any())
                            <div class="alert-error">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <!-- Title Card -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3.33333 5H16.6667M3.33333 10H10M3.33333 15H13.3333" stroke-linecap="round"/>
                                </svg>
                                <h3>Τίτλος Άρθρου</h3>
                            </div>
                            <div class="editor-card-body">
                                <div class="form-group">
                                    <input type="text"
                                           name="title"
                                           id="title"
                                           class="form-input title-input @error('title') error @enderror"
                                           placeholder="Εισάγετε τον τίτλο του άρθρου..."
                                           value="{{ old('title', $post->title ?? '') }}"
                                           required>
                                    @error('title')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Excerpt Card -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M3.33333 5H16.6667M3.33333 10H13.3333M3.33333 15H10" stroke-linecap="round"/>
                                </svg>
                                <h3>Περίληψη</h3>
                            </div>
                            <div class="editor-card-body">
                                <div class="form-group">
                                    <textarea name="excerpt"
                                              id="excerpt"
                                              rows="3"
                                              class="form-textarea @error('excerpt') error @enderror"
                                              placeholder="Σύντομη περιγραφή του άρθρου (προαιρετικό)...">{{ old('excerpt', $post->excerpt ?? '') }}</textarea>
                                    @error('excerpt')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <!-- Content Card -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h3>Περιεχόμενο</h3>
                            </div>
                            <div class="editor-card-body">
                                <div class="form-group">
                                    <div class="tinymce-wrapper">
                                        <textarea name="content"
                                                  id="content"
                                                  class="@error('content') error @enderror">{{ old('content', $post->content ?? '') }}</textarea>
                                    </div>
                                    @error('content')
                                        <span class="error-message">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                    </div>

                    <!-- ── Sidebar Column ── -->
                    <aside class="editor-sidebar">

                        <!-- Publish Box -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M10 2.5L12.5 7.5H17.5L13.75 11.25L15 16.25L10 13.75L5 16.25L6.25 11.25L2.5 7.5H7.5L10 2.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h3>Δημοσίευση</h3>
                            </div>
                            <div class="editor-card-body">
                                <div class="publish-actions">
                                    <button type="submit" name="status" value="published" class="btn-primary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M15.75 3.75L6.75 12.75L2.25 8.25"/>
                                        </svg>
                                        {{ isset($post) && $post->status === 'published' ? 'Ενημέρωση' : 'Δημοσίευση' }}
                                    </button>
                                    <button type="submit" name="status" value="draft" class="btn-secondary">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M14.25 15.75H3.75C3.35218 15.75 2.97064 15.592 2.68934 15.3107C2.40804 15.0294 2.25 14.6478 2.25 14.25V3.75C2.25 3.35218 2.40804 2.97064 2.68934 2.68934C2.97064 2.40804 3.35218 2.25 3.75 2.25H11.25L15.75 6.75V14.25C15.75 14.6478 15.592 15.0294 15.3107 15.3107C15.0294 15.592 14.6478 15.75 14.25 15.75Z" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                        Αποθήκευση Προχείρου
                                    </button>
                                </div>

                                @if(isset($post))
                                    <div class="post-info-small">
                                        <small>
                                            <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="2.5" y="3.33" width="15" height="15" rx="2"/>
                                                <line x1="2.5" y1="8.33" x2="17.5" y2="8.33"/>
                                            </svg>
                                            Δημιουργήθηκε: {{ $post->created_at->format('d/m/Y H:i') }}
                                        </small>
                                        @if($post->updated_at != $post->created_at)
                                            <small>
                                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M10 3.33333V10L13.3333 13.3333M18.3333 10C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39763 18.3333 1.66667 14.6024 1.66667 10C1.66667 5.39763 5.39763 1.66667 10 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10Z"/>
                                                </svg>
                                                Ενημερώθηκε: {{ $post->updated_at->format('d/m/Y H:i') }}
                                            </small>
                                        @endif
                                        @if($post->published_at)
                                            <small>
                                                <svg width="13" height="13" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M16.6667 3.33333H3.33333C2.41286 3.33333 1.66667 4.07953 1.66667 5V16.6667C1.66667 17.5871 2.41286 18.3333 3.33333 18.3333H16.6667C17.5871 18.3333 18.3333 17.5871 18.3333 16.6667V5C18.3333 4.07953 17.5871 3.33333 16.6667 3.33333Z"/>
                                                </svg>
                                                Δημοσιεύθηκε: {{ $post->published_at->format('d/m/Y H:i') }}
                                            </small>
                                        @endif
                                    </div>
                                @endif
                            </div>
                        </div>

                        <!-- Categories -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M9.16667 2.5H3.33333C2.8731 2.5 2.5 2.8731 2.5 3.33333V9.16667C2.5 9.6269 2.8731 10 3.33333 10H9.16667C9.6269 10 10 9.6269 10 9.16667V3.33333C10 2.8731 9.6269 2.5 9.16667 2.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6667 2.5H10.8333C10.3731 2.5 10 2.8731 10 3.33333V9.16667C10 9.6269 10.3731 10 10.8333 10H16.6667C17.1269 10 17.5 9.6269 17.5 9.16667V3.33333C17.5 2.8731 17.1269 2.5 16.6667 2.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9.16667 10H3.33333C2.8731 10 2.5 10.3731 2.5 10.8333V16.6667C2.5 17.1269 2.8731 17.5 3.33333 17.5H9.16667C9.6269 17.5 10 17.1269 10 16.6667V10.8333C10 10.3731 9.6269 10 9.16667 10Z" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M16.6667 10H10.8333C10.3731 10 10 10.3731 10 10.8333V16.6667C10 17.1269 10.3731 17.5 10.8333 17.5H16.6667C17.1269 17.5 17.5 17.1269 17.5 16.6667V10.8333C17.5 10.3731 17.1269 10 16.6667 10Z" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h3>Κατηγορίες</h3>
                            </div>
                            <div class="editor-card-body">
                                @if($categories->count() > 0)
                                    <div class="checkbox-group">
                                        @foreach($categories as $category)
                                            <label class="checkbox-label">
                                                <input type="checkbox"
                                                       name="categories[]"
                                                       value="{{ $category->id }}"
                                                       {{ (isset($post) && $post->categories->contains($category->id)) || (is_array(old('categories')) && in_array($category->id, old('categories'))) ? 'checked' : '' }}>
                                                <span>{{ $category->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="color: var(--color-gray); font-size: 0.9rem;">Δεν υπάρχουν κατηγορίες.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Tags -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <path d="M10.5917 2.50833L17.4917 9.40833C17.8033 9.72004 17.9782 10.1415 17.9782 10.58C17.9782 11.0185 17.8033 11.44 17.4917 11.7517L11.7517 17.4917C11.44 17.8033 11.0185 17.9782 10.58 17.9782C10.1415 17.9782 9.72004 17.8033 9.40833 17.4917L2.50833 10.5917C2.19664 10.2798 2.02144 9.85804 2.02167 9.41833V3.85833C2.02167 3.41848 2.19726 2.99657 2.50982 2.68401C2.82238 2.37145 3.24429 2.19587 3.68413 2.19587H9.24413C9.68384 2.19565 10.1056 2.37085 10.4175 2.6825L10.5917 2.50833Z" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M5.43335 5.43333H5.44169" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h3>Ετικέτες</h3>
                            </div>
                            <div class="editor-card-body">
                                @if($tags->count() > 0)
                                    <div class="checkbox-group">
                                        @foreach($tags as $tag)
                                            <label class="checkbox-label">
                                                <input type="checkbox"
                                                       name="tags[]"
                                                       value="{{ $tag->id }}"
                                                       {{ (isset($post) && $post->tags->contains($tag->id)) || (is_array(old('tags')) && in_array($tag->id, old('tags'))) ? 'checked' : '' }}>
                                                <span>{{ $tag->name }}</span>
                                            </label>
                                        @endforeach
                                    </div>
                                @else
                                    <p style="color: var(--color-gray); font-size: 0.9rem;">Δεν υπάρχουν ετικέτες.</p>
                                @endif
                            </div>
                        </div>

                        <!-- Featured Image -->
                        <div class="editor-card">
                            <div class="editor-card-header">
                                <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                    <rect x="2.5" y="2.5" width="15" height="15" rx="2"/>
                                    <circle cx="7.5" cy="7.5" r="1.25"/>
                                    <path d="M17.5 12.5L13.3333 8.33333L5 16.6667" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h3>Εικόνα Επικεφαλίδας</h3>
                            </div>
                            <div class="editor-card-body">
                                @if(isset($post) && $post->featured_image)
                                    <div class="current-image">
                                        <img src="{{ asset('storage/' . $post->featured_image) }}" alt="Featured Image">
                                        <label class="checkbox-label" style="padding-left: 0;">
                                            <input type="checkbox" name="remove_image" value="1">
                                            <span style="color: var(--color-danger); font-size: 0.85rem;">Αφαίρεση εικόνας</span>
                                        </label>
                                    </div>
                                @endif
                                <div class="file-input-wrapper">
                                    <input type="file"
                                           name="featured_image"
                                           id="featured_image"
                                           accept="image/*"
                                           class="file-input">
                                </div>
                                <p class="file-hint">JPG, PNG, GIF, WebP · Μέγιστο 5MB</p>
                            </div>
                        </div>

                    </aside>
                </div>
            </form>
        </main>
    </div>

    <script>
    const uploadImageUrl = "{{ route('admin.upload-image', ['locale' => app()->getLocale()]) }}";
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

    tinymce.init({
        selector: '#content',
        height: 600,
        menubar: true,
        convert_urls: false,
        relative_urls: false,
        plugins: [
            'advlist', 'autolink', 'lists', 'link', 'image', 'charmap', 'preview',
            'anchor', 'searchreplace', 'visualblocks', 'code', 'fullscreen',
            'insertdatetime', 'media', 'table', 'help', 'wordcount'
        ],
        toolbar: 'undo redo | formatselect | bold italic backcolor | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | removeformat | image media | help',
        content_style: 'body { font-family: Roboto, Arial, sans-serif; font-size: 16px; line-height: 1.7; }',
        language: 'el',
        paste_data_images: false,
        automatic_uploads: true,
        images_reuse_filename: false,
        images_upload_url: uploadImageUrl,
        images_upload_handler: function(blobInfo, progress) {
            return new Promise(function(resolve, reject) {
                var formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());
                fetch(uploadImageUrl, {
                    method: 'POST',
                    headers: { 'X-CSRF-TOKEN': csrfToken },
                    body: formData
                })
                .then(function(res) { return res.json(); })
                .then(function(data) {
                    if (data.location) resolve(data.location);
                    else reject('Upload failed');
                })
                .catch(function(err) { reject('Upload error: ' + err); });
            });
        }
    });
    </script>
</body>
</html>