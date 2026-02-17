<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Νέος Σύνδεσμος - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin-teamlinks/teamlinks-create.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <header class="admin-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="admin-logo">
                <h1>Πίνακας Διαχείρισης</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('admin.logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Αποσύνδεση</button>
                </form>
            </div>
        </div>
    </header>

    <div class="admin-layout">
        <aside class="admin-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ route('admin.dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z"/>
                    </svg>
                    Πίνακας Ελέγχου
                </a>

                <a href="{{ route('admin.users.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14.1667 17.5V15.8333C14.1667 14.9493 13.8155 14.1014 13.1904 13.4763C12.5652 12.8512 11.7174 12.5 10.8333 12.5H4.16667C3.28261 12.5 2.43476 12.8512 1.80964 13.4763C1.18452 14.1014 0.833336 14.9493 0.833336 15.8333V17.5"/>
                        <path d="M7.50001 9.16667C9.34096 9.16667 10.8333 7.67428 10.8333 5.83333C10.8333 3.99238 9.34096 2.5 7.50001 2.5C5.65906 2.5 4.16667 3.99238 4.16667 5.83333C4.16667 7.67428 5.65906 9.16667 7.50001 9.16667Z"/>
                    </svg>
                    Χρήστες
                </a>

                <a href="{{ route('admin.posts.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z"/>
                    </svg>
                    Άρθρα
                </a>

                <a href="{{ route('admin.comments.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M17.5 11.6667C17.5 12.1087 17.3244 12.5326 17.0118 12.8452C16.6993 13.1577 16.2754 13.3333 15.8333 13.3333H5.83333L2.5 16.6667V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H15.8333C16.2754 2.5 16.6993 2.67559 17.0118 2.98816C17.3244 3.30072 17.5 3.72464 17.5 4.16667V11.6667Z"/>
                    </svg>
                    Σχόλια
                </a>

                <a href="{{ route('admin.team-links.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5"/>
                        <path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5"/>
                    </svg>
                    Σύνδεσμοι Ομάδας
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

        <main class="admin-main">
            <div class="page-header">
                <h2>Νέος Σύνδεσμος</h2>
                <p class="page-subtitle">Προσθέστε νέο σύνδεσμο για την ομάδα</p>
            </div>

            <div class="form-container">
                <form action="{{ route('admin.team-links.store', ['locale' => app()->getLocale()]) }}" method="POST">
                    @csrf
                    <div class="form-grid">
                        <!-- Title -->
                        <div class="form-group">
                            <label for="title">Τίτλος <span class="required">*</span></label>
                            <input type="text"
                                   id="title"
                                   name="title"
                                   class="form-input @error('title') error @enderror"
                                   value="{{ old('title') }}"
                                   placeholder="π.χ. Google Drive"
                                   required>
                            @error('title')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- URL -->
                        <div class="form-group">
                            <label for="url">URL <span class="required">*</span></label>
                            <input type="url"
                                   id="url"
                                   name="url"
                                   class="form-input @error('url') error @enderror"
                                   value="{{ old('url') }}"
                                   placeholder="https://..."
                                   required>
                            @error('url')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Description -->
                        <div class="form-group full-width">
                            <label for="description">Περιγραφή</label>
                            <textarea id="description"
                                      name="description"
                                      class="form-input @error('description') error @enderror"
                                      placeholder="Σύντομη περιγραφή του συνδέσμου...">{{ old('description') }}</textarea>
                            @error('description')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Icon -->
                        <div class="form-group">
                            <label for="icon">Εικονίδιο (Emoji)</label>
                            <input type="text"
                                   id="icon"
                                   name="icon"
                                   class="form-input @error('icon') error @enderror"
                                   value="{{ old('icon') }}"
                                   placeholder="π.χ. 🔗 📁 💬"
                                   maxlength="10"
                                   oninput="updateIconPreview(this.value)">
                            <span class="help-text">Εισάγετε ένα emoji ως εικονίδιο</span>
                            <div class="icon-preview-container">
                                <div class="icon-preview" id="iconPreview">🔗</div>
                                <span class="icon-preview-label">Προεπισκόπηση εικονιδίου</span>
                            </div>
                            @error('icon')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Order -->
                        <div class="form-group">
                            <label for="order">Σειρά Εμφάνισης</label>
                            <input type="number"
                                   id="order"
                                   name="order"
                                   class="form-input @error('order') error @enderror"
                                   value="{{ old('order', 0) }}"
                                   min="0"
                                   placeholder="0">
                            <span class="help-text">Χαμηλότερος αριθμός = πρώτος στη λίστα</span>
                            @error('order')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Category -->
                        <div class="form-group full-width">
                            <label>Κατηγορία <span class="required">*</span></label>
                            <div class="category-options">
                                <div class="category-option">
                                    <input type="radio" id="cat_tools" name="category" value="tools" {{ old('category', 'tools') === 'tools' ? 'checked' : '' }}>
                                    <label for="cat_tools">
                                        <span class="category-emoji">🛠️</span>
                                        Εργαλεία
                                    </label>
                                </div>
                                <div class="category-option">
                                    <input type="radio" id="cat_documentation" name="category" value="documentation" {{ old('category') === 'documentation' ? 'checked' : '' }}>
                                    <label for="cat_documentation">
                                        <span class="category-emoji">📚</span>
                                        Τεκμηρίωση
                                    </label>
                                </div>
                                <div class="category-option">
                                    <input type="radio" id="cat_communication" name="category" value="communication" {{ old('category') === 'communication' ? 'checked' : '' }}>
                                    <label for="cat_communication">
                                        <span class="category-emoji">💬</span>
                                        Επικοινωνία
                                    </label>
                                </div>
                                <div class="category-option">
                                    <input type="radio" id="cat_resources" name="category" value="resources" {{ old('category') === 'resources' ? 'checked' : '' }}>
                                    <label for="cat_resources">
                                        <span class="category-emoji">📦</span>
                                        Πόροι
                                    </label>
                                </div>
                                <div class="category-option">
                                    <input type="radio" id="cat_other" name="category" value="other" {{ old('category') === 'other' ? 'checked' : '' }}>
                                    <label for="cat_other">
                                        <span class="category-emoji">🔗</span>
                                        Άλλο
                                    </label>
                                </div>
                            </div>
                            @error('category')
                                <span class="error-message">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Is Active -->
                        <div class="form-group full-width">
                            <label>Κατάσταση</label>
                            <div class="toggle-group">
                                <label class="toggle-switch">
                                    <input type="checkbox" name="is_active" id="is_active" {{ old('is_active', true) ? 'checked' : '' }}>
                                    <span class="toggle-slider"></span>
                                </label>
                                <div>
                                    <div class="toggle-label">Ενεργός Σύνδεσμος</div>
                                    <div class="toggle-desc">Ο σύνδεσμος θα εμφανίζεται στην ομάδα</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="form-actions">
                        <a href="{{ route('admin.team-links.index', ['locale' => app()->getLocale()]) }}" class="btn-cancel">
                            Ακύρωση
                        </a>
                        <button type="submit" class="btn-submit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M16.6667 5L7.50004 14.1667L3.33337 10"/>
                            </svg>
                            Δημιουργία Συνδέσμου
                        </button>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        function updateIconPreview(value) {
            const preview = document.getElementById('iconPreview');
            preview.textContent = value || '🔗';
        }
    </script>
</body>
</html>