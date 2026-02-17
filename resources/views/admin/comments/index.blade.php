<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Διαχείριση Σχολίων - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
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
                <form action="{{ url('/' . app()->getLocale() . '/admin/logout') }}" method="POST"
                    style="display: inline;">
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
                <a href="{{ url('/' . app()->getLocale() . '/admin/dashboard') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Πίνακας Ελέγχου
                </a>

                <a href="{{ url('/' . app()->getLocale() . '/admin/posts') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M14.1667 2.5H5.83333C4.91667 2.5 4.16667 3.25 4.16667 4.16667V15.8333C4.16667 16.75 4.91667 17.5 5.83333 17.5H14.1667C15.0833 17.5 15.8333 16.75 15.8333 15.8333V4.16667C15.8333 3.25 15.0833 2.5 14.1667 2.5Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Άρθρα
                </a>

                <a href="{{ url('/' . app()->getLocale() . '/admin/comments') }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M17.5 11.6667C17.5 12.1087 17.3244 12.5326 17.0118 12.8452C16.6993 13.1577 16.2754 13.3333 15.8333 13.3333H5.83333L2.5 16.6667V4.16667C2.5 3.72464 2.67559 3.30072 2.98816 2.98816C3.30072 2.67559 3.72464 2.5 4.16667 2.5H15.8333C16.2754 2.5 16.6993 2.67559 17.0118 2.98816C17.3244 3.30072 17.5 3.72464 17.5 4.16667V11.6667Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Σχόλια
                </a>

                <a href="{{ url('/' . app()->getLocale() . '/admin/users') }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M14.1667 17.5V15.8333C14.1667 14.9493 13.8155 14.1014 13.1904 13.4763C12.5652 12.8512 11.7174 12.5 10.8333 12.5H4.16667C3.28261 12.5 2.43476 12.8512 1.80964 13.4763C1.18452 14.1014 0.833336 14.9493 0.833336 15.8333V17.5"
                            stroke-linecap="round" stroke-linejoin="round" />
                        <path
                            d="M7.50001 9.16667C9.34096 9.16667 10.8333 7.67428 10.8333 5.83333C10.8333 3.99238 9.34096 2.5 7.50001 2.5C5.65906 2.5 4.16667 3.99238 4.16667 5.83333C4.16667 7.67428 5.65906 9.16667 7.50001 9.16667Z"
                            stroke-linecap="round" stroke-linejoin="round" />
                    </svg>
                    Χρήστες
                </a>

                <a href="{{ route('admin.team-links.index', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5"><path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5"/><path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5"/></svg>
                    Σύνδεσμοι Ομάδας
                </a>

                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333" />
                        <path
                            d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667"
                            stroke-linecap="round" />
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <!-- Main Content -->
        <main class="admin-main">
            <div class="page-header">
                <h2>Διαχείριση Σχολίων</h2>
                <p class="page-subtitle">Εγκρίνετε ή διαγράψτε σχόλια από τους χρήστες</p>
            </div>

            @if(session('success'))
            <div class="alert alert-success">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14" />
                    <polyline points="22 4 12 14.01 9 11.01" />
                </svg>
                {{ session('success') }}
            </div>
            @endif

            <!-- Filter Section -->
            <div class="filter-section">
                <div class="filter-group">
                    <label class="filter-label">Φιλτράρισμα κατά κατάσταση</label>
                    <select class="filter-select" onchange="window.location.href=this.value">
                        <option value="{{ route('admin.comments.index', ['locale' => app()->getLocale()]) }}" {{ !request('status') ? 'selected' : '' }}>Όλα τα Σχόλια</option>
                        <option value="{{ route('admin.comments.index', ['locale' => app()->getLocale(), 'status' => 'approved']) }}" {{ request('status') === 'approved' ? 'selected' : '' }}>Εγκεκριμένα</option>
                        <option value="{{ route('admin.comments.index', ['locale' => app()->getLocale(), 'status' => 'pending']) }}" {{ request('status') === 'pending' ? 'selected' : '' }}>Σε Αναμονή</option>
                    </select>
                </div>
            </div>

            <!-- Comments Table -->
            <div class="comments-table-container">
                @if($comments->count() > 0)
                <table class="comments-table">
                    <thead>
                        <tr>
                            <th>Συγγραφέας</th>
                            <th>Σχόλιο</th>
                            <th>Άρθρο</th>
                            <th>Κατάσταση</th>
                            <th>Ενέργειες</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($comments as $comment)
                        <tr>
                            <td>
                                <div class="comment-author">
                                    <div class="author-avatar">
                                        {{ strtoupper(substr($comment->author_name, 0, 1)) }}
                                    </div>
                                    <div class="author-info">
                                        <span class="author-name">{{ $comment->author_name }}</span>
                                        <span class="author-email">{{ $comment->author_email }}</span>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="comment-content">{{ $comment->content }}</div>
                            </td>
                            <td>
                                <a href="{{ route('posts.show', ['locale' => app()->getLocale(), 'post' => $comment->post->slug]) }}"
                                    target="_blank" class="post-link">
                                    {{ $comment->post->title }}
                                </a>
                                <div class="comment-date">{{ $comment->created_at->format('d/m/Y H:i') }}</div>
                            </td>
                            <td>
                                <span class="status-badge status-{{ $comment->status }}">
                                    @if($comment->status === 'approved')
                                    Εγκεκριμένο
                                    @elseif($comment->status === 'pending')
                                    Σε Αναμονή
                                    @elseif($comment->status === 'rejected')
                                    Απορριφθέν
                                    @else
                                    {{ ucfirst($comment->status) }}
                                    @endif
                                </span>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    @if($comment->status !== 'approved')
                                    <form action="{{ route('admin.comments.approve', ['locale' => app()->getLocale(), 'comment' => $comment->id]) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('PATCH')
                                        <button type="submit" class="btn-action btn-approve" title="Έγκριση">
                                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke-linecap="round" stroke-linejoin="round" />
                                            </svg>
                                        </button>
                                    </form>
                                    @endif

                                    <form action="{{ route('admin.comments.destroy', ['locale' => app()->getLocale(), 'comment' => $comment->id]) }}" method="POST" style="display: inline;" onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτό το σχόλιο;')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn-action btn-delete" title="Διαγραφή">
                                            <svg width="18" height="18" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="2">
                                                <path d="M2.5 5H4.16667H17.5" stroke-linecap="round" stroke-linejoin="round" />
                                                <path d="M6.66667 5V3.33333C6.66667 2.89131 6.84226 2.46738 7.15482 2.15482C7.46738 1.84226 7.89131 1.66667 8.33333 1.66667H11.6667C12.1087 1.66667 12.5326 1.84226 12.8452 2.15482C13.1577 2.46738 13.3333 2.89131 13.3333 3.33333V5M15.8333 5V16.6667C15.8333 17.1087 15.6577 17.5326 15.3452 17.8452C15.0326 18.1577 14.6087 18.3333 14.1667 18.3333H5.83333C5.39131 18.3333 4.96738 18.1577 4.65482 17.8452C4.34226 17.5326 4.16667 17.1087 4.16667 16.6667V5H15.8333Z" stroke-linecap="round" stroke-linejoin="round" />
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
                    {{ $comments->links() }}
                </div>
                @else
                <div class="empty-state">
                    <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
                    </svg>
                    <h3>Δεν υπάρχουν σχόλια</h3>
                    <p>Δεν βρέθηκαν σχόλια με τα επιλεγμένα φίλτρα</p>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>

</html>