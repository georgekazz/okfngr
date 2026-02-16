<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Στατιστικά - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <style>
        :root {
            --color-cyan: #00D1FF;
            --color-purple: #E077FF;
            --color-lime: #E4FF36;
            --color-mint: #ADFFED;
            --color-dark: #1a1a1a;
            --color-gray: #666;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background: #f8f9fa;
            margin: 0;
            padding: 0;
        }

        .dashboard-header {
            background: white;
            border-bottom: 1px solid #e0e0e0;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .header-container {
            max-width: 100%;
            padding: 1rem 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 1.5rem;
        }

        .dashboard-logo {
            height: 40px;
        }

        .dashboard-header h1 {
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
            padding: 0.625rem 1.25rem;
            background: transparent;
            border: 2px solid #e0e0e0;
            border-radius: 8px;
            color: var(--color-dark);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s;
        }

        .logout-btn:hover {
            border-color: var(--color-cyan);
            color: var(--color-cyan);
        }

        .dashboard-layout {
            display: grid;
            grid-template-columns: 250px 1fr;
            min-height: calc(100vh - 73px);
        }

        .dashboard-sidebar {
            background: var(--color-dark);
            padding: 2rem 0;
        }

        .sidebar-nav {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
            padding: 0 1rem;
        }

        .nav-link {
            display: flex;
            align-items: center;
            gap: 0.75rem;
            padding: 0.875rem 1rem;
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s;
            border-radius: 8px;
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

        .dashboard-main {
            padding: 2rem;
            background: #f8f9fa;
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

        /* Year Selector */
        .year-selector {
            background: white;
            padding: 1.25rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .year-label {
            font-weight: 700;
            color: var(--color-dark);
        }

        .year-display {
            font-size: 1.5rem;
            font-weight: 900;
            color: var(--color-cyan);
        }

        /* Stats Overview */
        .stats-overview {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 1.5rem;
            margin-bottom: 2rem;
        }

        .stat-box {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .stat-box-label {
            font-size: 0.85rem;
            font-weight: 600;
            color: var(--color-gray);
            margin-bottom: 0.75rem;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .stat-box-value {
            font-size: 2rem;
            font-weight: 900;
            color: var(--color-dark);
        }

        .stat-box-value.cyan {
            color: var(--color-cyan);
        }

        .stat-box-value.purple {
            color: var(--color-purple);
        }

        .stat-box-value.lime {
            color: #9a8800;
        }

        /* Charts */
        .charts-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .chart-container {
            background: white;
            padding: 2rem;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        }

        .chart-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 1.5rem;
        }

        .chart-wrapper {
            position: relative;
            height: 300px;
        }

        /* Team Table */
        .team-stats-section {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .section-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 1.5rem;
        }

        .team-stats-table {
            width: 100%;
            border-collapse: collapse;
        }

        .team-stats-table thead {
            background: #f8f9fa;
        }

        .team-stats-table th {
            padding: 1rem 1.25rem;
            text-align: left;
            font-size: 0.85rem;
            font-weight: 700;
            color: var(--color-gray);
            text-transform: uppercase;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #e0e0e0;
        }

        .team-stats-table td {
            padding: 1.25rem;
            border-bottom: 1px solid #f0f0f0;
        }

        .team-stats-table tbody tr:hover {
            background: #f8f9fa;
        }

        .user-cell {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
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

        .user-name-cell {
            font-weight: 600;
            color: var(--color-dark);
        }

        .days-cell {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-cyan);
        }

        .progress-bar-container {
            width: 100%;
            height: 8px;
            background: #f0f0f0;
            border-radius: 4px;
            overflow: hidden;
        }

        .progress-bar {
            height: 100%;
            background: linear-gradient(135deg, var(--color-cyan), #00b8e6);
            border-radius: 4px;
            transition: width 0.3s ease;
        }

        /* Empty State */
        .empty-state {
            text-align: center;
            padding: 3rem;
        }

        .empty-state svg {
            color: #ddd;
            margin-bottom: 1rem;
        }

        .empty-state h3 {
            font-size: 1.3rem;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .empty-state p {
            color: var(--color-gray);
        }

        @media (max-width: 1024px) {
            .charts-grid {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: none;
            }

            .stats-overview {
                grid-template-columns: 1fr;
            }

            .team-stats-table {
                font-size: 0.9rem;
            }

            .team-stats-table th,
            .team-stats-table td {
                padding: 0.75rem;
            }
        }
    </style>
</head>

<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Στατιστικά</h1>
            </div>
            <div class="header-right">
                <span class="user-name">{{ Auth::user()->name }}</span>
                <form action="{{ route('writer.logout', ['locale' => app()->getLocale()]) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="logout-btn">Αποσύνδεση</button>
                </form>
            </div>
        </div>
    </header>

    <div class="dashboard-layout">
        <aside class="dashboard-sidebar">
            <nav class="sidebar-nav">
                <a href="{{ route('user.dashboard', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z" />
                    </svg>
                    Αρχική
                </a>

                <a href="{{ route('user.day-offs.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z" />
                        <path d="M13.3333 1.66666V5" />
                        <path d="M6.66666 1.66666V5" />
                        <path d="M2.5 8.33334H17.5" />
                    </svg>
                    Οι Άδειές μου
                </a>

                <a href="{{ route('user.salary-calculator', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="2" y="5" width="16" height="12" rx="2" />
                        <path d="M2 10h16" />
                        <path d="M6 14h.01" />
                        <path d="M10 14h.01" />
                        <path d="M14 14h.01" />
                    </svg>
                    Υπολογισμός Μισθού
                </a>

                <a href="{{ route('user.calendar', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="14" height="14" rx="2" ry="2" />
                        <line x1="3" y1="9" x2="17" y2="9" />
                        <line x1="9" y1="4" x2="9" y2="18" />
                    </svg>
                    Ημερολόγιο Ομάδας
                </a>

                <a href="{{ route('user.statistics', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    Στατιστικά
                </a>

                <a href="{{ route('user.team-links', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5" />
                        <path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5" />
                    </svg>
                    Χρήσιμοι Σύνδεσμοι
                </a>

                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333" />
                        <path d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667" />
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <div class="page-header">
                <h2>Στατιστικά Αδειών</h2>
                <p class="page-subtitle">Ανάλυση χρήσης αδειών για το {{ date('Y') }}</p>
            </div>

            <!-- Year Selector -->
            <div class="year-selector">
                <span class="year-label">Έτος:</span>
                <span class="year-display">{{ date('Y') }}</span>
            </div>

            <!-- Stats Overview -->
            <div class="stats-overview">
                <div class="stat-box">
                    <div class="stat-box-label">Σύνολο Ομάδας</div>
                    <div class="stat-box-value cyan">
                        {{ $users->sum('total_days') ?? 0 }}
                        <span style="font-size: 1rem; font-weight: 600; color: var(--color-gray);">μέρες</span>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">Μέσος Όρος</div>
                    <div class="stat-box-value purple">
                        {{ $users->count() > 0 ? round($users->sum('total_days') / $users->count(), 1) : 0 }}
                        <span style="font-size: 1rem; font-weight: 600; color: var(--color-gray);">μέρες/άτομο</span>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">Μέλη Ομάδας</div>
                    <div class="stat-box-value lime">
                        {{ $users->count() }}
                        <span style="font-size: 1rem; font-weight: 600; color: var(--color-gray);">άτομα</span>
                    </div>
                </div>

                <div class="stat-box">
                    <div class="stat-box-label">Οι Άδειές μου</div>
                    <div class="stat-box-value cyan">
                        {{ $users->where('id', auth()->id())->first()->total_days ?? 0 }}
                        <span style="font-size: 1rem; font-weight: 600; color: var(--color-gray);">μέρες</span>
                    </div>
                </div>
            </div>

            <!-- Charts -->
            <div class="charts-grid">
                <!-- Monthly Chart -->
                <div class="chart-container">
                    <div class="chart-title">Άδειες ανά Μήνα ({{ date('Y') }})</div>
                    <div class="chart-wrapper">
                        <canvas id="monthlyChart"></canvas>
                    </div>
                </div>

                <!-- Type Distribution Chart -->
                <div class="chart-container">
                    <div class="chart-title">Κατανομή ανά Τύπο</div>
                    <div class="chart-wrapper">
                        <canvas id="typeChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Team Statistics Table -->
            <div class="team-stats-section">
                <div class="section-title">Στατιστικά Ομάδας</div>

                @if($users->count() > 0)
                <table class="team-stats-table">
                    <thead>
                        <tr>
                            <th>Μέλος</th>
                            <th>Σύνολο Ημερών</th>
                            <th>Ποσοστό</th>
                            <th>Πρόοδος</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                        $maxDays = $users->max('total_days') ?: 1;
                        @endphp
                        @foreach($users->sortByDesc('total_days') as $user)
                        <tr>
                            <td>
                                <div class="user-cell">
                                    <div class="user-avatar">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="user-name-cell">{{ $user->name }}</div>
                                </div>
                            </td>
                            <td>
                                <span class="days-cell">{{ $user->total_days ?? 0 }}</span>
                                <span style="color: var(--color-gray); font-size: 0.9rem;">μέρες</span>
                            </td>
                            <td>
                                <span style="font-weight: 600; color: var(--color-dark);">
                                    {{ $users->sum('total_days') > 0 ? round(($user->total_days / $users->sum('total_days')) * 100, 1) : 0 }}%
                                </span>
                            </td>
                            <td style="width: 200px;">
                                <div class="progress-bar-container">
                                    <div class="progress-bar" style="width: {{ ($user->total_days / $maxDays) * 100 }}%"></div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    <h3>Δεν υπάρχουν δεδομένα</h3>
                    <p>Δεν βρέθηκαν στατιστικά για το τρέχον έτος</p>
                </div>
                @endif
            </div>
        </main>
    </div>

    <script>
        // Monthly Statistics Data from Database
        const monthlyData = @json($monthlyStats);
        const months = ['Ιαν', 'Φεβ', 'Μαρ', 'Απρ', 'Μάι', 'Ιούν', 'Ιούλ', 'Αύγ', 'Σεπ', 'Οκτ', 'Νοε', 'Δεκ'];

        // Map database data to months array
        const monthlyValues = months.map((_, index) => {
            const monthNumber = index + 1;
            const monthData = monthlyData.find(m => m.month == monthNumber);
            return monthData ? parseInt(monthData.total) : 0;
        });

        // Monthly Chart
        const monthlyCtx = document.getElementById('monthlyChart').getContext('2d');
        new Chart(monthlyCtx, {
            type: 'bar',
            data: {
                labels: months,
                datasets: [{
                    label: 'Ημέρες Άδειας',
                    data: monthlyValues,
                    backgroundColor: 'rgba(0, 209, 255, 0.8)',
                    borderColor: 'rgba(0, 209, 255, 1)',
                    borderWidth: 2,
                    borderRadius: 8,
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return context.parsed.y + ' μέρες';
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            stepSize: 5,
                            callback: function(value) {
                                return value + ' μέρες';
                            }
                        },
                        grid: {
                            color: 'rgba(0, 0, 0, 0.05)'
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });

        // Type Distribution Chart - Real Data from Database
        const typeData = @json($typeData);

        const typeCtx = document.getElementById('typeChart').getContext('2d');
        new Chart(typeCtx, {
            type: 'doughnut',
            data: {
                labels: ['Διακοπές', 'Ασθένεια', 'Προσωπική', 'Άλλο'],
                datasets: [{
                    data: [
                        typeData.vacation || 0,
                        typeData.sick || 0,
                        typeData.personal || 0,
                        typeData.other || 0
                    ],
                    backgroundColor: [
                        'rgba(0, 209, 255, 0.8)',
                        'rgba(224, 119, 255, 0.8)',
                        'rgba(228, 255, 54, 0.8)',
                        'rgba(173, 255, 237, 0.8)'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            font: {
                                size: 12,
                                weight: 600
                            },
                            generateLabels: function(chart) {
                                const data = chart.data;
                                if (data.labels.length && data.datasets.length) {
                                    return data.labels.map((label, i) => {
                                        const value = data.datasets[0].data[i];
                                        const total = data.datasets[0].data.reduce((a, b) => a + b, 0);
                                        const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;

                                        return {
                                            text: `${label}: ${value} (${percentage}%)`,
                                            fillStyle: data.datasets[0].backgroundColor[i],
                                            hidden: false,
                                            index: i
                                        };
                                    });
                                }
                                return [];
                            }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                const label = context.label || '';
                                const value = context.parsed;
                                const total = context.dataset.data.reduce((a, b) => a + b, 0);
                                const percentage = total > 0 ? ((value / total) * 100).toFixed(1) : 0;
                                return `${label}: ${value} μέρες (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
    </script>
</body>

</html>