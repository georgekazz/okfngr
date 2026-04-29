{{-- resources/views/writer/gallery/index.blade.php --}}
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Φωτογραφικό Αρχείο - Writer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/writer-gallery.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>

    <!-- Header -->
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Φωτογραφικό Αρχείο</h1>
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

        <!-- Sidebar -->
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

                <a href="{{ route('writer.media-events.index', ['locale' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('*/writer/media-events*') && !request()->is('*/writer/media-events/create') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M17.5 5.83333H2.5V15.8333C2.5 16.2754 2.67559 16.6993 2.98816 17.0118C3.30072 17.3244 3.72464 17.5 4.16667 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V5.83333Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M13.3333 2.5V5.83333M6.66667 2.5V5.83333M2.5 9.16667H17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Εκδηλώσεις Μέσων
                </a>

                <a href="{{ route('writer.media-events.create', ['locale' => app()->getLocale()]) }}"
                    class="nav-link create-new {{ request()->is('*/writer/media-events/create') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Νέα Εκδήλωση
                </a>

                <a href="{{ route('writer.gallery.index', ['locale' => app()->getLocale()]) }}"
                    class="nav-link {{ request()->is('*/writer/gallery*') && !request()->is('*/writer/gallery/create') ? 'active' : '' }}">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <rect x="2.5" y="2.5" width="15" height="15" rx="2" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="7.08" cy="7.08" r="1.25" stroke="currentColor" stroke-width="1.5"/>
                        <path d="M17.5 12.5L13.33 8.33L4.17 17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Φωτογραφικό Αρχείο
                </a>

                <a href="{{ route('writer.gallery.create', ['locale' => app()->getLocale()]) }}"
                    class="nav-link create-new {{ request()->is('*/writer/gallery/create') ? 'active' : '' }}">
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

        <!-- Main -->
        <main class="dashboard-main">

            <div class="page-header-row">
                <div>
                    <h2 class="page-title">Φωτογραφικό Αρχείο</h2>
                    <p class="header-subtitle">Διαχείριση φωτογραφιών ανά ημερομηνία</p>
                </div>
                <a href="{{ route('writer.gallery.create', ['locale' => app()->getLocale()]) }}" class="btn-primary">
                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                        <path d="M10 4.16667V15.8333" stroke-linecap="round" stroke-linejoin="round"/>
                        <path d="M4.16667 10H15.8333" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                    Νέα Ομάδα Φωτογραφιών
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            @if($groups->count() > 0)
                <div class="gallery-groups-list">
                    @foreach($groups as $group)
                        <div class="group-card">
                            <div class="group-card-left">
                                <div class="group-thumbs">
                                    @if($group->photos->count() > 0)
                                        <div class="group-thumb main">
                                            <img src="{{ asset('storage/' . $group->photos->first()->path) }}"
                                                 alt="{{ $group->title }}"
                                                 onerror="this.parentElement.classList.add('empty-thumb')">
                                        </div>
                                        @foreach($group->photos->skip(1)->take(3) as $photo)
                                            <div class="group-thumb">
                                                <img src="{{ asset('storage/' . $photo->path) }}"
                                                     alt="{{ $group->title }}"
                                                     onerror="this.parentElement.style.display='none'">
                                            </div>
                                        @endforeach
                                    @else
                                        <div class="group-thumb main empty-thumb">
                                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <rect x="3" y="3" width="18" height="18" rx="2"/>
                                                <circle cx="8.5" cy="8.5" r="1.5"/>
                                                <polyline points="21 15 16 10 5 21"/>
                                            </svg>
                                        </div>
                                    @endif
                                </div>

                                <div class="group-info">
                                    <div class="group-date-badge">
                                        {{ $group->date->translatedFormat('d F Y') }}
                                    </div>
                                    <h3 class="group-title">{{ $group->title }}</h3>
                                    @if($group->description)
                                        <p class="group-desc">{{ Str::limit($group->description, 90) }}</p>
                                    @endif
                                    <span class="group-count">
                                        <svg width="13" height="13" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                            <rect x="3" y="3" width="18" height="18" rx="2"/>
                                            <circle cx="8.5" cy="8.5" r="1.5"/>
                                            <polyline points="21 15 16 10 5 21"/>
                                        </svg>
                                        {{ $group->photos->count() }} {{ $group->photos->count() == 1 ? 'φωτογραφία' : 'φωτογραφίες' }}
                                    </span>
                                </div>
                            </div>

                            <div class="group-card-actions">
                                <a href="{{ route('writer.gallery.edit', ['locale' => app()->getLocale(), 'id' => $group->id]) }}"
                                   class="btn-icon" title="Επεξεργασία">
                                    <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M14.1667 2.5C14.3856 2.28113 14.6454 2.10752 14.9314 1.98906C15.2173 1.87061 15.5238 1.80969 15.8333 1.80969C16.1429 1.80969 16.4493 1.87061 16.7353 1.98906C17.0213 2.10752 17.281 2.28113 17.5 2.5C17.7189 2.71887 17.8925 2.97863 18.0109 3.26461C18.1294 3.55059 18.1903 3.85706 18.1903 4.16667C18.1903 4.47627 18.1294 4.78274 18.0109 5.06872C17.8925 5.3547 17.7189 5.61446 17.5 5.83333L6.25 17.0833L1.66667 18.3333L2.91667 13.75L14.1667 2.5Z" stroke-linecap="round" stroke-linejoin="round"/>
                                    </svg>
                                </a>
                                <form action="{{ route('writer.gallery.destroy', ['locale' => app()->getLocale(), 'id' => $group->id]) }}"
                                      method="POST" style="display:inline;"
                                      onsubmit="return confirm('Διαγραφή όλης της ομάδας και των φωτογραφιών;')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn-icon btn-delete" title="Διαγραφή">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                            <path d="M2.5 5H4.16667H17.5" stroke-linecap="round" stroke-linejoin="round"/>
                                            <path d="M6.66667 5V3.33333C6.66667 2.89131 6.84226 2.46738 7.15482 2.15482C7.46738 1.84226 7.89131 1.66667 8.33333 1.66667H11.6667C12.1087 1.66667 12.5326 1.84226 12.8452 2.15482C13.1577 2.46738 13.3333 2.89131 13.3333 3.33333V5M15.8333 5V16.6667C15.8333 17.1087 15.6577 17.5326 15.3452 17.8452C15.0326 18.1577 14.6087 18.3333 14.1667 18.3333H5.83333C5.39131 18.3333 4.96738 18.1577 4.65482 17.8452C4.34226 17.5326 4.16667 17.1087 4.16667 16.6667V5H15.8333Z" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pagination-wrapper">
                    {{ $groups->links('vendor.pagination.custom') }}
                </div>

            @else
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.2">
                        <rect x="3" y="3" width="18" height="18" rx="2"/>
                        <circle cx="8.5" cy="8.5" r="1.5"/>
                        <polyline points="21 15 16 10 5 21"/>
                    </svg>
                    <h3>Δεν υπάρχουν φωτογραφίες</h3>
                    <p>Δημιουργήστε την πρώτη ομάδα φωτογραφιών</p>
                    <a href="{{ route('writer.gallery.create', ['locale' => app()->getLocale()]) }}" class="btn-primary">
                        Νέα Ομάδα Φωτογραφιών
                    </a>
                </div>
            @endif

        </main>
    </div>

</body>
</html>