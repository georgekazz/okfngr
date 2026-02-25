<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Εκδηλώσεις Μέσων - Writer Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/media-event.css') }}">
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
                    <h1>Εκδηλώσεις Μέσων</h1>
                    <p class="header-subtitle">Διαχειριστείτε τις εκδηλώσεις και τα γεγονότα μέσων</p>
                </div>
                <a href="{{ route('writer.media-events.create', ['locale' => app()->getLocale()]) }}"
                    class="btn-primary">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"
                            stroke-linejoin="round" />
                    </svg>
                    Νέα Εκδήλωση
                </a>
            </div>

            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($events->count() > 0)
                <div class="events-grid">
                    @foreach($events as $event)
                        <div class="event-card {{ $event->status }}">
                            @if($event->image)
                                <img src="{{ asset('storage/' . $event->image) }}" alt="{{ $event->title }}" class="event-image">
                            @endif

                            <div class="event-content">
                                <div class="event-header">
                                    <h2 class="event-title">{{ $event->title }}</h2>
                                    <span class="event-status {{ $event->status }}">
                                        {{ $event->status === 'published' ? 'Δημοσιευμένο' : 'Πρόχειρο' }}
                                    </span>
                                </div>

                                <div class="event-meta">
                                    <div class="event-meta-item">
                                        <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path
                                                d="M17.5 5.83333H2.5V15.8333C2.5 16.2754 2.67559 16.6993 2.98816 17.0118C3.30072 17.3244 3.72464 17.5 4.16667 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V5.83333Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        {{ $event->event_date->format('d/m/Y') }}
                                    </div>
                                    @if($event->location)
                                        <div class="event-meta-item">
                                            <svg viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path
                                                    d="M10 10.8333C11.3807 10.8333 12.5 9.71404 12.5 8.33333C12.5 6.95262 11.3807 5.83333 10 5.83333C8.61929 5.83333 7.5 6.95262 7.5 8.33333C7.5 9.71404 8.61929 10.8333 10 10.8333Z"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M10 17.5C13.3333 14.1667 16.6667 11.1548 16.6667 8.33333C16.6667 4.65143 13.6819 1.66667 10 1.66667C6.3181 1.66667 3.33333 4.65143 3.33333 8.33333C3.33333 11.1548 6.66667 14.1667 10 17.5Z"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            {{ $event->location }}
                                        </div>
                                    @endif
                                </div>

                                <p class="event-description">{{ $event->description }}</p>

                                @if($event->links && count($event->links) > 0)
                                    <div class="event-links">
                                        @foreach($event->links as $link)
                                            <a href="{{ $link }}" target="_blank" class="event-link">
                                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                    stroke-width="2">
                                                    <path
                                                        d="M10.8333 9.16667C10.3092 9.82926 9.56613 10.2845 8.73346 10.4588C7.90078 10.6331 7.03286 10.5159 6.28101 10.1271C5.52917 9.73829 4.94274 9.10306 4.62688 8.33438C4.31102 7.5657 4.28544 6.71437 4.55474 5.92894C4.82404 5.14351 5.37186 4.47529 6.09836 4.04265C6.82486 3.61001 7.68364 3.44149 8.52519 3.56482C9.36674 3.68815 10.1388 4.09574 10.7025 4.71667"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                    <path
                                                        d="M9.16667 10.8333C9.69084 10.1707 10.4339 9.71554 11.2666 9.54121C12.0992 9.36688 12.9672 9.48414 13.719 9.87292C14.4709 10.2617 15.0573 10.8969 15.3732 11.6656C15.689 12.4343 15.7146 13.2856 15.4453 14.071C15.176 14.8565 14.6282 15.5247 13.9017 15.9573C13.1752 16.39 12.3164 16.5585 11.4749 16.4352C10.6333 16.3118 9.86125 15.9042 9.29752 15.2833"
                                                        stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                                Σύνδεσμος
                                            </a>
                                        @endforeach
                                    </div>
                                @endif

                                <div class="event-actions">
                                    <a href="{{ route('writer.media-events.edit', ['locale' => app()->getLocale(), 'mediaEvent' => $event->id]) }}"
                                        class="btn-edit">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                            stroke-width="2">
                                            <path
                                                d="M14.1667 2.5C14.3856 2.28113 14.6454 2.10752 14.9314 1.98906C15.2173 1.87061 15.5238 1.80969 15.8333 1.80969C16.1429 1.80969 16.4493 1.87061 16.7353 1.98906C17.0213 2.10752 17.281 2.28113 17.5 2.5C17.7189 2.71887 17.8925 2.97863 18.0109 3.26461C18.1294 3.55059 18.1903 3.85706 18.1903 4.16667C18.1903 4.47627 18.1294 4.78274 18.0109 5.06872C17.8925 5.3547 17.7189 5.61446 17.5 5.83333L6.25 17.0833L1.66667 18.3333L2.91667 13.75L14.1667 2.5Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>
                                        Επεξεργασία
                                    </a>
                                    <form
                                        action="{{ route('writer.media-events.destroy', ['locale' => app()->getLocale(), 'mediaEvent' => $event->id]) }}"
                                        method="POST" style="flex: 1; display: inline;"
                                        onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτή την εκδήλωση;');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-delete">
                                            <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                                                stroke-width="2">
                                                <path d="M2.5 5H4.16667H17.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path
                                                    d="M6.66667 5V3.33333C6.66667 2.89131 6.84226 2.46738 7.15482 2.15482C7.46738 1.84226 7.89131 1.66667 8.33333 1.66667H11.6667C12.1087 1.66667 12.5326 1.84226 12.8452 2.15482C13.1577 2.46738 13.3333 2.89131 13.3333 3.33333V5M15.8333 5V16.6667C15.8333 17.1087 15.6577 17.5326 15.3452 17.8452C15.0326 18.1577 14.6087 18.3333 14.1667 18.3333H5.83333C5.39131 18.3333 4.96738 18.1577 4.65482 17.8452C4.34226 17.5326 4.16667 17.1087 4.16667 16.6667V5H15.8333Z"
                                                    stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                            Διαγραφή
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div style="margin-top: 30px;">
                    {{ $events->links() }}
                </div>
            @else
                <div class="empty-state">
                    <svg viewBox="0 0 20 20" fill="none" stroke="currentColor">
                        <path
                            d="M17.5 5.83333H2.5V15.8333C2.5 16.2754 2.67559 16.6993 2.98816 17.0118C3.30072 17.3244 3.72464 17.5 4.16667 17.5H15.8333C16.2754 17.5 16.6993 17.3244 17.0118 17.0118C17.3244 16.6993 17.5 16.2754 17.5 15.8333V5.83333Z"
                            stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M13.3333 2.5V5.83333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M6.66667 2.5V5.83333" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h3>Δεν υπάρχουν εκδηλώσεις</h3>
                    <p>Δημιουργήστε την πρώτη σας εκδήλωση για να ξεκινήσετε</p>
                    <a href="{{ route('writer.media-events.create', ['locale' => app()->getLocale()]) }}"
                        class="btn-primary">
                        Δημιουργία Εκδήλωσης
                    </a>
                </div>
            @endif
        </main>
    </div>
</body>

</html>