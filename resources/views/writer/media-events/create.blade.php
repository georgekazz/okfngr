<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Νέα Εκδήλωση - Writer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/media-event-edit.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <div class="dashboard-container">
        <!-- Sidebar -->
        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ url('/el/writer/dashboard') }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 17.5V10H12.5V17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Πίνακας Ελέγχου
                </a>
                <a href="{{ route('writer.posts.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
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
                    Τα Άρθρα μου
                </a>
                <a href="{{ url('/el/writer/posts/create') }}" class="nav-link create-new">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Νέο Άρθρο
                </a>

                <!-- Media Events Section -->
                <a href="{{ route('writer.media-events.index', ['locale' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('*/writer/media-events*') && !request()->is('*/writer/media-events/create') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path
                            d="M17.5 5.83333H2.5V15.8333C2.5 16.2754 2.67559 16.6993 2.98816 17.0118C3.30072 17.3244 3.72464 17.5 4.16667 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V5.83333Z"
                            stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.3333 2.5V5.83333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M6.66667 2.5V5.83333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M2.5 9.16667H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Εκδηλώσεις Μέσων
                </a>

                <a href="{{ route('writer.media-events.create', ['locale' => app()->getLocale()]) }}"
                    class="nav-link create-new {{ request()->is('*/writer/media-events/create') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Νέα Εκδήλωση
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
            <div class="dashboard-header">
                <div>
                    <h1>Νέα Εκδήλωση</h1>
                    <p class="header-subtitle">Δημιουργήστε μια νέα εκδήλωση μέσων</p>
                </div>
            </div>

            <div class="form-container">
                <form action="{{ route('writer.media-events.store', ['locale' => app()->getLocale()]) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf

                    <div class="form-group">
                        <label for="title" class="required">Τίτλος Εκδήλωσης</label>
                        <input type="text" id="title" name="title" class="form-control" value="{{ old('title') }}"
                            required>
                        @error('title')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-row">
                        <div class="form-group">
                            <label for="event_date" class="required">Ημερομηνία</label>
                            <input type="date" id="event_date" name="event_date" class="form-control"
                                value="{{ old('event_date') }}" required>
                            @error('event_date')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="location">Τοποθεσία</label>
                            <input type="text" id="location" name="location" class="form-control"
                                value="{{ old('location') }}" placeholder="π.χ. Αθήνα, Ελλάδα">
                            @error('location')
                                <div class="error-message">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description" class="required">Περιγραφή</label>
                        <textarea id="description" name="description" class="form-control"
                            required>{{ old('description') }}</textarea>
                        <div class="form-help">Περιγράψτε την εκδήλωση με λεπτομέρεια</div>
                        @error('description')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="image">Εικόνα Εκδήλωσης</label>
                        <input type="file" id="image" name="image" class="form-control" accept="image/*"
                            onchange="previewImage(event)">
                        <div class="form-help">Προτεινόμενο μέγεθος: 1200x630px (JPG, PNG, GIF - Max 2MB)</div>
                        @error('image')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                        <div class="image-preview" id="imagePreview">
                            <img id="preview" src="" alt="Preview">
                        </div>
                    </div>

                    <div class="form-group">
                        <label>Σύνδεσμοι</label>
                        <div class="form-help" style="margin-bottom: 10px;">Προσθέστε συνδέσμους που σχετίζονται με την
                            εκδήλωση (άρθρα, φωτογραφίες, βίντεο κ.λπ.)</div>
                        <div class="links-container" id="linksContainer">
                            <div class="link-item">
                                <input type="url" name="links[]" class="form-control" placeholder="https://example.com"
                                    value="{{ old('links.0') }}">
                            </div>
                        </div>
                        <button type="button" class="btn-add-link" onclick="addLinkField()">
                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M10 4.16667V15.8333" stroke-linecap="round" stroke-linejoin="round" />
                                <path d="M4.16667 10H15.8333" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                            Προσθήκη Συνδέσμου
                        </button>
                        @error('links.*')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label>Σημαντική Εκδήλωση</label>
                        <div class="important-checkbox-wrapper">
                            <label class="important-checkbox-label" for="is_important">
                                <input type="checkbox"
                                    id="is_important"
                                    name="is_important"
                                    value="1"
                                    {{ old('is_important') ? 'checked' : '' }}>
                                <span class="important-checkbox-box">
                                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="3">
                                        <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </span>
                                <span class="important-checkbox-text">
                                    Σημαντική Εκδήλωση
                                    <small>Θα εμφανιστεί στην κεντρική σελίδα ως σημαντική ανακοίνωση</small>
                                </span>
                            </label>
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="required">Κατάσταση</label>
                        <div class="status-select">
                            <div class="status-option">
                                <input type="radio" id="draft" name="status" value="draft" {{ old('status', 'draft') === 'draft' ? 'checked' : '' }}>
                                <label for="draft">Πρόχειρο</label>
                            </div>
                            <div class="status-option">
                                <input type="radio" id="published" name="status" value="published" {{ old('status') === 'published' ? 'checked' : '' }}>
                                <label for="published">Δημοσίευση</label>
                            </div>
                        </div>
                        @error('status')
                            <div class="error-message">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-actions">
                        <button type="submit" class="btn-submit">
                            <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke-linecap="round"
                                    stroke-linejoin="round" />
                            </svg>
                            Δημιουργία Εκδήλωσης
                        </button>
                        <a href="{{ route('writer.media-events.index', ['locale' => app()->getLocale()]) }}"
                            class="btn-cancel">
                            Ακύρωση
                        </a>
                    </div>
                </form>
            </div>
        </main>
    </div>

    <script>
        let linkCount = 1;

        function addLinkField() {
            const container = document.getElementById('linksContainer');
            const newLink = document.createElement('div');
            newLink.className = 'link-item';
            newLink.innerHTML = `
                <input type="url" name="links[]" class="form-control" placeholder="https://example.com">
                <button type="button" class="btn-remove-link" onclick="removeLink(this)">
                    <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M15 5L5 15M5 5L15 15" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </button>
            `;
            container.appendChild(newLink);
            linkCount++;
        }

        function removeLink(button) {
            button.parentElement.remove();
        }

        function previewImage(event) {
            const preview = document.getElementById('preview');
            const previewContainer = document.getElementById('imagePreview');
            const file = event.target.files[0];

            if (file) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    previewContainer.style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                previewContainer.style.display = 'none';
            }
        }
    </script>
</body>

</html>