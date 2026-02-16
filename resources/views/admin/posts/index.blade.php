<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Διαχείριση Άρθρων - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/adminManage.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>
<body>
    <!-- Admin Header -->
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
        <!-- Sidebar -->
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
            <div class="page-header">
                <h2>Διαχείριση Άρθρων</h2>
                <p class="page-subtitle">Διαχειριστείτε όλα τα άρθρα του ιστοτόπου</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                    <polyline points="22 4 12 14.01 9 11.01"/>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-group">
                    <label class="filter-label">Φιλτράρισμα κατά κατάσταση</label>
                    <select class="filter-select" onchange="window.location.href=this.value">
                        <option value="{{ route('admin.posts.index', ['locale' => app()->getLocale()]) }}" {{ !request('status') ? 'selected' : '' }}>Όλα τα Άρθρα</option>
                        <option value="{{ route('admin.posts.index', ['locale' => app()->getLocale(), 'status' => 'published']) }}" {{ request('status') === 'published' ? 'selected' : '' }}>Δημοσιευμένα</option>
                        <option value="{{ route('admin.posts.index', ['locale' => app()->getLocale(), 'status' => 'draft']) }}" {{ request('status') === 'draft' ? 'selected' : '' }}>Πρόχειρα</option>
                    </select>
                </div>
            </div>

            <!-- Posts Table -->
            <div class="posts-table-container">
                @if($posts->count() > 0)
                <table class="posts-table">
                    <thead>
                        <tr>
                            <th>Άρθρο</th>
                            <th>Κατηγορίες</th>
                            <th>Κατάσταση</th>
                            <th>Στατιστικά</th>
                            <th>Ενέργειες</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($posts as $post)
                        <tr>
                            <td>
                                <div class="post-info">
                                    @if($post->featured_image)
                                    <img src="{{ asset('storage/' . $post->featured_image) }}" alt="{{ $post->title }}" class="post-thumbnail" onerror="this.style.display='none'">
                                    @else
                                    <img src="{{ asset('img/placeholder.jpg') }}" alt="No image" class="post-thumbnail" onerror="this.style.display='none'">
                                    @endif
                                    
                                    <div class="post-details">
                                        <h3>{{ Str::limit($post->title, 60) }}</h3>
                                        <div class="post-meta">
                                            <span class="post-meta-item">
                                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M16.6667 17.5V15.8333C16.6667 14.9493 16.3155 14.1014 15.6904 13.4763C15.0652 12.8512 14.2174 12.5 13.3333 12.5H6.66667C5.78261 12.5 4.93476 12.8512 4.30964 13.4763C3.68452 14.1014 3.33333 14.9493 3.33333 15.8333V17.5"/>
                                                    <circle cx="10" cy="5.83333" r="3.33333"/>
                                                </svg>
                                                {{ $post->user->name }}
                                            </span>
                                            <span class="post-meta-item">
                                                <svg width="14" height="14" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                                    <path d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z"/>
                                                </svg>
                                                {{ $post->created_at->format('d/m/Y') }}
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="post-categories">
                                    @if($post->categories->count() > 0)
                                        @foreach($post->categories as $category)
                                        <span class="category-badge">{{ $category->name }}</span>
                                        @endforeach
                                    @else
                                        <span style="color: #999;">Καμία</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $post->status }}">
                                    {{ $post->status === 'published' ? 'Δημοσιευμένο' : 'Πρόχειρο' }}
                                </span>
                            </td>
                            <td>
                                <div class="post-stats">
                                    <span class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M10 18.3333C14.6024 18.3333 18.3333 14.6024 18.3333 10C18.3333 5.39763 14.6024 1.66667 10 1.66667C5.39763 1.66667 1.66667 5.39763 1.66667 10C1.66667 14.6024 5.39763 18.3333 10 18.3333Z"/>
                                            <path d="M1.66667 10C1.66667 10 4.16667 5 10 5C15.8333 5 18.3333 10 18.3333 10C18.3333 10 15.8333 15 10 15C4.16667 15 1.66667 10 1.66667 10Z"/>
                                        </svg>
                                        {{ $post->views }} προβολές
                                    </span>
                                    <span class="stat-item">
                                        <svg width="16" height="16" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M17.5 9.58333C17.5029 10.6832 17.2459 11.7683 16.75 12.75C16.162 13.9265 15.2581 14.916 14.1395 15.6078C13.021 16.2995 11.7319 16.6662 10.4167 16.6667C9.31678 16.6696 8.23176 16.4126 7.25 15.9167L2.5 17.5L4.08333 12.75C3.58744 11.7683 3.33047 10.6832 3.33333 9.58333C3.33384 8.26812 3.70051 6.97904 4.39227 5.86045C5.08402 4.74187 6.07355 3.838 7.25 3.25C8.23176 2.75411 9.31678 2.49713 10.4167 2.5H10.8333C12.5703 2.59583 14.2109 3.32899 15.441 4.55906C16.671 5.78913 17.4042 7.42971 17.5 9.16667V9.58333Z"/>
                                        </svg>
                                        {{ $post->comments->count() }} σχόλια
                                    </span>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <a href="{{ route('admin.posts.edit', ['locale' => app()->getLocale(), 'post' => $post->id]) }}" class="btn-action btn-edit" title="Επεξεργασία">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M8.25 3H3C2.60218 3 2.22064 3.15804 1.93934 3.43934C1.65804 3.72064 1.5 4.10218 1.5 4.5V15C1.5 15.3978 1.65804 15.7794 1.93934 16.0607C2.22064 16.342 2.60218 16.5 3 16.5H13.5C13.8978 16.5 14.2794 16.342 14.5607 16.0607C14.842 15.7794 15 15.3978 15 15V9.75"/>
                                            <path d="M13.875 1.87498C14.1734 1.57661 14.5778 1.40918 15 1.40918C15.4222 1.40918 15.8266 1.57661 16.125 1.87498C16.4234 2.17336 16.5908 2.57782 16.5908 2.99998C16.5908 3.42215 16.4234 3.82661 16.125 4.12498L9 11.25L6 12L6.75 9L13.875 1.87498Z"/>
                                        </svg>
                                    </a>

                                    @if($post->status === 'published')
                                    <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $post->slug]) }}" target="_blank" class="btn-action btn-view" title="Προβολή">
                                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
                                            <path d="M0.75 9C0.75 9 3.75 3 9 3C14.25 3 17.25 9 17.25 9C17.25 9 14.25 15 9 15C3.75 15 0.75 9 0.75 9Z"/>
                                            <circle cx="9" cy="9" r="2.25"/>
                                        </svg>
                                    </a>
                                    @endif

                                    <form action="{{ route('admin.posts.destroy', ['locale' => app()->getLocale(), 'post' => $post->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτό το άρθρο;')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Διαγραφή">
                                            <svg width="18" height="18" viewBox="0 0 18 18" fill="none" stroke="currentColor" stroke-width="1.5">
                                                <path d="M2.25 4.5H3.75H15.75"/>
                                                <path d="M6 4.5V3C6 2.60218 6.15804 2.22064 6.43934 1.93934C6.72064 1.65804 7.10218 1.5 7.5 1.5H10.5C10.8978 1.5 11.2794 1.65804 11.5607 1.93934C11.842 2.22064 12 2.60218 12 3V4.5M14.25 4.5V15C14.25 15.3978 14.092 15.7794 13.8107 16.0607C13.5294 16.342 13.1478 16.5 12.75 16.5H5.25C4.85218 16.5 4.47064 16.342 4.18934 16.0607C3.90804 15.7794 3.75 15.3978 3.75 15V4.5H14.25Z"/>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="pagination-wrapper">
                    {{ $posts->links() }}
                </div>
                @else
                <div class="empty-state">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M14 2H6C5.46957 2 4.96086 2.21071 4.58579 2.58579C4.21071 2.96086 4 3.46957 4 4V20C4 20.5304 4.21071 21.0391 4.58579 21.4142C4.96086 21.7893 5.46957 22 6 22H18C18.5304 22 19.0391 21.7893 19.4142 21.4142C19.7893 21.0391 20 20.5304 20 20V8L14 2Z"/>
                        <path d="M14 2V8H20"/>
                    </svg>
                    <h3>Δεν υπάρχουν άρθρα</h3>
                    <p>Δεν βρέθηκαν άρθρα με τα επιλεγμένα φίλτρα</p>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>