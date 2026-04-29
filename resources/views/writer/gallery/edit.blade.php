{{-- resources/views/writer/gallery/edit.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Επεξεργασία Ομάδας - Writer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/writer-gallery.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>

    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Επεξεργασία Ομάδας</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('writer.logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display:inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Αποσύνδεση</button>
                </form>
            </div>
        </div>
    </header>

    <div class="dashboard-layout">

        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ url('/el/writer/dashboard') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 17.5V10H12.5V17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Πίνακας Ελέγχου
                </a>
                <a href="{{ route('writer.posts.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M7.5 7.5H12.5M7.5 10.8333H12.5M7.5 14.1667H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Τα Άρθρα μου
                </a>
                <a href="{{ url('/el/writer/posts/create') }}" class="nav-link create-new">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Νέο Άρθρο
                </a>
                <a href="{{ route('writer.media-events.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M17.5 5.83333H2.5V15.8333C2.5 16.2754 2.67559 16.6993 2.98816 17.0118C3.30072 17.3244 3.72464 17.5 4.16667 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V5.83333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.3333 2.5V5.83333M6.66667 2.5V5.83333M2.5 9.16667H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Εκδηλώσεις Μέσων
                </a>
                <a href="{{ route('writer.media-events.create', ['locale' => app()->getLocale()]) }}" class="nav-link create-new">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Νέα Εκδήλωση
                </a>
                <a href="{{ route('writer.gallery.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <rect x="2.5" y="2.5" width="15" height="15" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="7.08" cy="7.08" r="1.25" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M17.5 12.5L13.33 8.33L4.17 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Φωτογραφικό Αρχείο
                </a>
                <a href="{{ route('writer.gallery.create', ['locale' => app()->getLocale()]) }}" class="nav-link create-new">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Νέα Ομάδα Φωτογραφιών
                </a>
                <a href="{{ url('/el') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M18.3333 10C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39763 18.3333 1.66667 14.6024 1.66667 10C1.66667 5.39763 5.39763 1.66667 10 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10Z" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M13.3333 10C13.3333 11.8409 11.8409 13.3333 10 13.3333C8.15905 13.3333 6.66667 11.8409 6.66667 10C6.66667 8.15905 8.15905 6.66667 10 6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/>
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <main class="dashboard-main">

            <div class="page-header-row">
                <div>
                    <h2 class="page-title">Επεξεργασία: {{ $group->title }}</h2>
                    <p class="header-subtitle">{{ $group->date->translatedFormat('d F Y') }} · {{ $group->photos->count() }} φωτογραφίες</p>
                </div>
                <a href="{{ route('writer.gallery.index', ['locale' => app()->getLocale()]) }}" class="btn-back">
                    ← Πίσω στη λίστα
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <form action="{{ route('writer.gallery.update', ['locale' => app()->getLocale(), 'id' => $group->id]) }}"
                  method="POST" enctype="multipart/form-data">
                @csrf @method('PUT')

                <!-- Group details -->
                <div class="form-card">
                    <div class="form-card-title">Στοιχεία Ομάδας</div>

                    <div class="form-row-2">
                        <div class="form-group">
                            <label for="title">Τίτλος <span class="req">*</span></label>
                            <input type="text" id="title" name="title"
                                   value="{{ old('title', $group->title) }}" required>
                            @error('title')<span class="field-error">{{ $message }}</span>@enderror
                        </div>
                        <div class="form-group">
                            <label for="date">Ημερομηνία <span class="req">*</span></label>
                            <input type="date" id="date" name="date"
                                   value="{{ old('date', $group->date->format('Y-m-d')) }}" required>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="description">Περιγραφή <span class="optional">(προαιρετικό)</span></label>
                        <textarea id="description" name="description" rows="3">{{ old('description', $group->description) }}</textarea>
                    </div>
                </div>

                <!-- Existing photos -->
                @if($group->photos->count() > 0)
                <div class="form-card">
                    <div class="form-card-title">
                        Υπάρχουσες Φωτογραφίες
                        <span class="count-badge">{{ $group->photos->count() }}</span>
                    </div>

                    <div class="existing-grid" id="existingGrid">
                        @foreach($group->photos as $photo)
                            <div class="existing-item" id="photo-{{ $photo->id }}">
                                <img src="{{ asset('storage/' . $photo->path) }}"
                                     alt="{{ $group->title }}"
                                     onerror="this.parentElement.style.background='#f0f0f0'">
                                <button type="button"
                                        class="existing-delete"
                                        onclick="deletePhoto({{ $photo->id }}, this)"
                                        title="Διαγραφή">
                                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                                        <line x1="18" y1="6" x2="6" y2="18"/>
                                        <line x1="6" y1="6" x2="18" y2="18"/>
                                    </svg>
                                </button>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <!-- Add new photos -->
                <div class="form-card">
                    <div class="form-card-title">Προσθήκη Νέων Φωτογραφιών</div>

                    <div class="dropzone" id="dropzone" onclick="document.getElementById('newPhotos').click()">
                        <div class="dropzone-icon">
                            <svg width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                                <path d="M21 15v4a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2v-4"/>
                                <polyline points="17 8 12 3 7 8"/>
                                <line x1="12" y1="3" x2="12" y2="15"/>
                            </svg>
                        </div>
                        <p class="dropzone-text">Κάντε κλικ ή σύρετε νέες φωτογραφίες</p>
                        <p class="dropzone-hint">JPG, PNG, WEBP · Μέχρι 5MB ανά αρχείο</p>
                        <input type="file" id="newPhotos" name="new_photos[]"
                               accept="image/*" multiple style="display:none"
                               onchange="handleNewFiles(this.files)">
                    </div>

                    <div class="preview-grid" id="newPreviewGrid"></div>
                </div>

                <div class="form-actions">
                    <a href="{{ route('writer.gallery.index', ['locale' => app()->getLocale()]) }}" class="btn-back">
                        Ακύρωση
                    </a>
                    <button type="submit" class="btn-primary">
                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2.5">
                            <polyline points="16.67 5 7.5 14.17 3.33 10" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                        Αποθήκευση Αλλαγών
                    </button>
                </div>
            </form>

        </main>
    </div>

<script>
// ── Delete existing photo via AJAX ──
function deletePhoto(photoId, btn) {
    if (!confirm('Διαγραφή αυτής της φωτογραφίας;')) return;
    btn.disabled = true;

    fetch('{{ url("/" . app()->getLocale() . "/writer/gallery/photo") }}/' + photoId, {
        method: 'DELETE',
        headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
        }
    })
    .then(r => r.json())
    .then(data => {
        if (data.success) {
            const el = document.getElementById('photo-' + photoId);
            el.style.transform = 'scale(0)';
            el.style.opacity   = '0';
            el.style.transition = 'all 0.3s ease';
            setTimeout(() => el.remove(), 300);
        } else {
            btn.disabled = false;
            alert('Σφάλμα διαγραφής.');
        }
    })
    .catch(() => { btn.disabled = false; });
}

// ── New photos preview ──
let selectedFiles = new DataTransfer();

function handleNewFiles(files) {
    for (const file of files) {
        if (!file.type.startsWith('image/')) continue;
        selectedFiles.items.add(file);
    }
    document.getElementById('newPhotos').files = selectedFiles.files;
    renderNewPreviews();
}

function renderNewPreviews() {
    const grid = document.getElementById('newPreviewGrid');
    grid.innerHTML = '';
    Array.from(selectedFiles.files).forEach((file, i) => {
        const reader = new FileReader();
        reader.onload = e => {
            const item = document.createElement('div');
            item.className = 'preview-item';
            item.innerHTML = `
                <img src="${e.target.result}" alt="">
                <button type="button" class="preview-remove" onclick="removeNewFile(${i})">
                    <svg width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                        <line x1="18" y1="6" x2="6" y2="18"/><line x1="6" y1="6" x2="18" y2="18"/>
                    </svg>
                </button>
                <div class="preview-name">${file.name}</div>
            `;
            grid.appendChild(item);
        };
        reader.readAsDataURL(file);
    });
}

function removeNewFile(index) {
    const dt = new DataTransfer();
    Array.from(selectedFiles.files).forEach((f, i) => {
        if (i !== index) dt.items.add(f);
    });
    selectedFiles = dt;
    document.getElementById('newPhotos').files = selectedFiles.files;
    renderNewPreviews();
}

const dz = document.getElementById('dropzone');
dz.addEventListener('dragover',  e => { e.preventDefault(); dz.classList.add('drag-over'); });
dz.addEventListener('dragleave', () => dz.classList.remove('drag-over'));
dz.addEventListener('drop', e => {
    e.preventDefault();
    dz.classList.remove('drag-over');
    handleNewFiles(e.dataTransfer.files);
});
</script>

</body>
</html>