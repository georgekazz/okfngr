<!DOCTYPE html>
<html lang="el">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Τα Άρθρα μου - OKFN Greece</title>
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
                <h1>Τα Άρθρα μου</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }}</span>
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
                <a href="{{ url('/el/writer/dashboard') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 17.5V10H12.5V17.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Πίνακας Ελέγχου
                </a>
                <a href="{{ route('writer.posts.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 7.5H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 10.8333H12.5" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M7.5 14.1667H10" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Τα Άρθρα μου
                </a>
                <a href="{{ url('/el/writer/posts/create') }}" class="nav-link create-new">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Νέο Άρθρο
                </a>
                <a href="{{ url('/el') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                        <path d="M18.3333 10C18.3333 14.6024 14.6024 18.3333 10 18.3333C5.39763 18.3333 1.66667 14.6024 1.66667 10C1.66667 5.39763 5.39763 1.66667 10 1.66667C14.6024 1.66667 18.3333 5.39763 18.3333 10Z" stroke="currentColor" stroke-width="1.5" />
                        <path d="M13.3333 10C13.3333 11.8409 11.8409 13.3333 10 13.3333C8.15905 13.3333 6.66667 11.8409 6.66667 10C6.66667 8.15905 8.15905 6.66667 10 6.66667" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" />
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="dashboard-main">
            @if(session('success'))
            <div class="alert alert-success" style="background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 15px; border-radius: 8px; margin-bottom: 20px;">
                {{ session('success') }}
            </div>
            @endif

            <!-- Posts Section -->
            <div class="posts-section">
                <div class="section-header">
                    <h2>Όλα τα Άρθρα</h2>
                    <a href="{{ url('/el/writer/posts/create') }}" class="btn-primary">
                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none">
                            <path d="M10 4.16667V15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            <path d="M4.16667 10H15.8333" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                        Νέο Άρθρο
                    </a>
                </div>

                @if($posts->count() > 0)
                <div class="posts-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Τίτλος</th>
                                <th>Κατηγορίες</th>
                                <th>Κατάσταση</th>
                                <th>Ημερομηνία</th>
                                <th>Προβολές</th>
                                <th>Ενέργειες</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($posts as $post)
                            <tr>
                                <td>
                                    <div class="post-title-cell">
                                        <strong>{{ Str::limit($post->title, 60) }}</strong>
                                        <small style="color: #6c757d; display: block; margin-top: 4px;">{{ $post->slug }}</small>
                                    </div>
                                </td>
                                <td>
                                    @if($post->categories->count() > 0)
                                        @foreach($post->categories->take(2) as $category)
                                            <span class="post-category">{{ $category->name }}</span>
                                        @endforeach
                                        @if($post->categories->count() > 2)
                                            <span class="post-category">+{{ $post->categories->count() - 2 }}</span>
                                        @endif
                                    @else
                                        <span style="color: #999;">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="status-badge status-{{ $post->status }}">
                                        {{ $post->status === 'published' ? 'Δημοσιευμένο' : 'Πρόχειρο' }}
                                    </span>
                                </td>
                                <td>{{ $post->created_at->format('d/m/Y') }}</td>
                                <td>{{ number_format($post->views_count) }}</td>
                                <td>
                                    <div class="action-buttons">
                                        <a href="{{ route('writer.posts.edit', ['locale' => app()->getLocale(), 'post' => $post->id]) }}" class="btn-icon" title="Επεξεργασία">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M8.25 3H3C2.60218 3 2.22064 3.15804 1.93934 3.43934C1.65804 3.72064 1.5 4.10218 1.5 4.5V15C1.5 15.3978 1.65804 15.7794 1.93934 16.0607C2.22064 16.342 2.60218 16.5 3 16.5H13.5C13.8978 16.5 14.2794 16.342 14.5607 16.0607C14.842 15.7794 15 15.3978 15 15V9.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M13.875 1.87498C14.1734 1.57661 14.5778 1.40918 15 1.40918C15.4222 1.40918 15.8266 1.57661 16.125 1.87498C16.4234 2.17336 16.5908 2.57782 16.5908 2.99998C16.5908 3.42215 16.4234 3.82661 16.125 4.12498L9 11.25L6 12L6.75 9L13.875 1.87498Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                        @if($post->status === 'published')
                                        <a href="{{ url('/el/posts/' . $post->slug) }}" class="btn-icon" target="_blank" title="Προβολή">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                <path d="M0.75 9C0.75 9 3.75 3 9 3C14.25 3 17.25 9 17.25 9C17.25 9 14.25 15 9 15C3.75 15 0.75 9 0.75 9Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M9 11.25C10.2426 11.25 11.25 10.2426 11.25 9C11.25 7.75736 10.2426 6.75 9 6.75C7.75736 6.75 6.75 7.75736 6.75 9C6.75 10.2426 7.75736 11.25 9 11.25Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </a>
                                        @endif
                                        <form action="{{ route('writer.posts.destroy', ['locale' => app()->getLocale(), 'post' => $post->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτό το άρθρο;')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn-icon btn-delete" title="Διαγραφή">
                                                <svg width="18" height="18" viewBox="0 0 18 18" fill="none">
                                                    <path d="M2.25 4.5H3.75H15.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                    <path d="M6 4.5V3C6 2.60218 6.15804 2.22064 6.43934 1.93934C6.72064 1.65804 7.10218 1.5 7.5 1.5H10.5C10.8978 1.5 11.2794 1.65804 11.5607 1.93934C11.842 2.22064 12 2.60218 12 3V4.5M14.25 4.5V15C14.25 15.3978 14.092 15.7794 13.8107 16.0607C13.5294 16.342 13.1478 16.5 12.75 16.5H5.25C4.85218 16.5 4.47064 16.342 4.18934 16.0607C3.90804 15.7794 3.75 15.3978 3.75 15V4.5H14.25Z" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="pagination-wrapper">
                    {{ $posts->links() }}
                </div>
                @else
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
                        <path d="M37.3333 10.6667H16C14.5855 10.6667 13.2289 11.2286 12.2287 12.2288C11.2286 13.229 10.6667 14.5855 10.6667 16V48C10.6667 49.4145 11.2286 50.7711 12.2287 51.7713C13.2289 52.7714 14.5855 53.3333 16 53.3333H48C49.4145 53.3333 50.7711 52.7714 51.7713 51.7713C52.7714 50.7711 53.3333 49.4145 53.3333 48V26.6667L37.3333 10.6667Z" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                        <path d="M37.3333 10.6667V26.6667H53.3333" stroke="currentColor" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    <h3>Δεν έχετε άρθρα ακόμα</h3>
                    <p>Ξεκινήστε να δημιουργείτε το πρώτο σας άρθρο</p>
                    <a href="{{ url('/el/writer/posts/create') }}" class="btn-primary">
                        Δημιουργία Πρώτου Άρθρου
                    </a>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>

</html>