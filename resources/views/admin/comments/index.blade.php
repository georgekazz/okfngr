<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Διαχείριση Σχολίων - Admin Panel</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <style>
        :root {
            --color-cyan: #00D1FF;
            --color-mint: #ADFFED;
            --color-lime: #E4FF36;
            --color-purple: #E077FF;
            --color-dark: #1a1a1a;
            --color-gray: #666;
            --color-light: #f8f9fa;
            --color-border: #e0e0e0;
            --color-danger: #dc3545;
            --color-success: #28a745;
            --color-warning: #ffc107;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: var(--color-light);
            color: var(--color-dark);
        }

        /* Admin Header */
        .admin-header {
            background: white;
            border-bottom: 2px solid var(--color-border);
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-container {
            max-width: 100%;
            padding: 1.25rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 2rem;
        }

        .admin-logo {
            height: 45px;
        }

        .header-left h1 {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .user-name {
            font-weight: 600;
            color: var(--color-gray);
        }

        .logout-btn {
            padding: 0.625rem 1.5rem;
            background: white;
            border: 2px solid var(--color-border);
            border-radius: 8px;
            color: var(--color-dark);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .logout-btn:hover {
            border-color: var(--color-cyan);
            color: var(--color-cyan);
        }

        /* Layout */
        .admin-layout {
            display: grid;
            grid-template-columns: 280px 1fr;
            min-height: calc(100vh - 85px);
        }

        /* Sidebar */
        .admin-sidebar {
            background: var(--color-dark);
            color: white;
            padding: 2rem 0;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0 1.5rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 1rem;
            padding: 1rem 1.25rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            border-radius: 10px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .nav-link:hover {
            background: rgba(255, 255, 255, 0.1);
            color: white;
        }

        .nav-link.active {
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            color: white;
            box-shadow: 0 4px 15px rgba(0, 209, 255, 0.3);
        }

        .nav-link svg {
            flex-shrink: 0;
        }

        /* Main Content */
        .admin-main {
            padding: 2.5rem;
        }

        .page-header {
            margin-bottom: 2rem;
        }

        .page-header h2 {
            font-size: 2rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .page-subtitle {
            font-size: 1.1rem;
            color: var(--color-gray);
        }

        /* Alert Messages */
        .alert {
            padding: 1rem 1.5rem;
            border-radius: 10px;
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .alert-success {
            background: rgba(40, 167, 69, 0.1);
            border: 1px solid var(--color-success);
            color: #155724;
        }

        .alert svg {
            flex-shrink: 0;
        }

        /* Filter Section */
        .filter-section {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            margin-bottom: 2rem;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .filter-group {
            flex: 1;
        }

        .filter-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-gray);
            margin-bottom: 0.5rem;
            display: block;
        }

        .filter-select {
            width: 100%;
            padding: 0.75rem 1rem;
            border: 2px solid var(--color-border);
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
        }

        .filter-select:focus {
            outline: none;
            border-color: var(--color-cyan);
        }

        /* Comments Table */
        .comments-table-container {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            overflow: hidden;
        }

        .comments-table {
            width: 100%;
            border-collapse: collapse;
        }

        .comments-table thead {
            background: #f8f9fa;
        }

        .comments-table th {
            padding: 1.25rem 1.5rem;
            text-align: left;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid var(--color-border);
        }

        .comments-table td {
            padding: 1.5rem;
            border-bottom: 1px solid #f0f0f0;
            vertical-align: top;
        }

        .comments-table tbody tr:hover {
            background: #f8f9fa;
        }

        .comment-author {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-cyan), var(--color-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.1rem;
        }

        .author-info {
            display: flex;
            flex-direction: column;
        }

        .author-name {
            font-weight: 600;
            color: var(--color-dark);
        }

        .author-email {
            font-size: 0.85rem;
            color: var(--color-gray);
        }

        .comment-content {
            color: var(--color-dark);
            line-height: 1.6;
            max-width: 400px;
        }

        .post-link {
            color: var(--color-cyan);
            text-decoration: none;
            font-weight: 500;
            display: block;
            margin-bottom: 0.25rem;
        }

        .post-link:hover {
            text-decoration: underline;
        }

        .comment-date {
            font-size: 0.85rem;
            color: var(--color-gray);
        }

        .status-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .status-approved {
            background: rgba(40, 167, 69, 0.1);
            color: var(--color-success);
        }

        .status-pending {
            background: rgba(255, 193, 7, 0.1);
            color: #856404;
        }

        /* Action Buttons */
        .action-buttons {
            display: flex;
            gap: 0.5rem;
        }

        .btn-action {
            width: 36px;
            height: 36px;
            border: 2px solid var(--color-border);
            background: white;
            border-radius: 8px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .btn-action:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }

        .btn-approve:hover {
            border-color: var(--color-success);
            color: var(--color-success);
            background: rgba(40, 167, 69, 0.05);
        }

        .btn-delete:hover {
            border-color: var(--color-danger);
            color: var(--color-danger);
            background: rgba(220, 53, 69, 0.05);
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 4rem 2rem;
        }

        .empty-state svg {
            color: var(--color-border);
            margin-bottom: 1.5rem;
        }

        .empty-state h3 {
            font-size: 1.5rem;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--color-gray);
        }

        /* Pagination */
        .pagination-wrapper {
            padding: 1.5rem;
            display: flex;
            justify-content: center;
        }

        /* Responsive */
        @media (max-width: 1024px) {
            .admin-layout {
                grid-template-columns: 250px 1fr;
            }
        }

        @media (max-width: 768px) {
            .admin-layout {
                grid-template-columns: 1fr;
            }

            .admin-sidebar {
                display: none;
            }

            .admin-main {
                padding: 1.5rem;
            }

            .filter-section {
                flex-direction: column;
            }

            .comments-table {
                font-size: 0.9rem;
            }

            .comments-table th,
            .comments-table td {
                padding: 1rem;
            }

            .comment-content {
                max-width: 100%;
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
                        <option
                            value="{{ route('admin.comments.index', ['locale' => app()->getLocale(), 'status' => 'approved']) }}"
                            {{ request('status') === 'approved' ? 'selected' : '' }}>Εγκεκριμένα</option>
                        <option
                            value="{{ route('admin.comments.index', ['locale' => app()->getLocale(), 'status' => 'pending']) }}"
                            {{ request('status') === 'pending' ? 'selected' : '' }}>Σε Αναμονή</option>
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
                                                {{ strtoupper(substr($comment->name, 0, 1)) }}
                                            </div>
                                            <div class="author-info">
                                                <span class="author-name">{{ $comment->name }}</span>
                                                <span class="author-email">{{ $comment->email }}</span>
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
                                        <span class="status-badge status-{{ $comment->is_approved ? 'approved' : 'pending' }}">
                                            {{ $comment->is_approved ? 'Εγκεκριμένο' : 'Σε Αναμονή' }}
                                        </span>
                                    </td>
                                    <td>
                                        <div class="action-buttons">
                                            @if(!$comment->is_approved)
                                                <form
                                                    action="{{ route('admin.comments.approve', ['locale' => app()->getLocale(), 'comment' => $comment->id]) }}"
                                                    method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('PATCH')
                                                    <button type="submit" class="btn-action btn-approve" title="Έγκριση">
                                                        <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                                                            stroke="currentColor" stroke-width="2">
                                                            <path d="M16.6667 5L7.50004 14.1667L3.33337 10" stroke-linecap="round"
                                                                stroke-linejoin="round" />
                                                        </svg>
                                                    </button>
                                                </form>
                                            @endif

                                            <form
                                                action="{{ route('admin.comments.destroy', ['locale' => app()->getLocale(), 'comment' => $comment->id]) }}"
                                                method="POST" style="display: inline;"
                                                onsubmit="return confirm('Είστε σίγουροι ότι θέλετε να διαγράψετε αυτό το σχόλιο;')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn-action btn-delete" title="Διαγραφή">
                                                    <svg width="18" height="18" viewBox="0 0 20 20" fill="none"
                                                        stroke="currentColor" stroke-width="2">
                                                        <path d="M2.5 5H4.16667H17.5" stroke-linecap="round"
                                                            stroke-linejoin="round" />
                                                        <path
                                                            d="M6.66667 5V3.33333C6.66667 2.89131 6.84226 2.46738 7.15482 2.15482C7.46738 1.84226 7.89131 1.66667 8.33333 1.66667H11.6667C12.1087 1.66667 12.5326 1.84226 12.8452 2.15482C13.1577 2.46738 13.3333 2.89131 13.3333 3.33333V5M15.8333 5V16.6667C15.8333 17.1087 15.6577 17.5326 15.3452 17.8452C15.0326 18.1577 14.6087 18.3333 14.1667 18.3333H5.83333C5.39131 18.3333 4.96738 18.1577 4.65482 17.8452C4.34226 17.5326 4.16667 17.1087 4.16667 16.6667V5H15.8333Z"
                                                            stroke-linecap="round" stroke-linejoin="round" />
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
                        <svg width="80" height="80" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
                            <path
                                d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z" />
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