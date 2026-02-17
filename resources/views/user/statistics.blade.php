<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Στατιστικά - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel/statistics.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
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
                <form action="{{ route('writer.logout', ['locale' => app()->getLocale()]) }}" method="POST"
                    style="display: inline;">
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
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z" />
                    </svg>
                    Αρχική
                </a>

                <a href="{{ route('user.day-offs.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z" />
                        <path d="M13.3333 1.66666V5" />
                        <path d="M6.66666 1.66666V5" />
                        <path d="M2.5 8.33334H17.5" />
                    </svg>
                    Οι Άδειές μου
                </a>

                <a href="{{ route('user.salary-calculator', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <rect x="2" y="5" width="16" height="12" rx="2" />
                        <path d="M2 10h16" />
                        <path d="M6 14h.01" />
                        <path d="M10 14h.01" />
                        <path d="M14 14h.01" />
                    </svg>
                    Υπολογισμός Μισθού
                </a>

                <a href="{{ route('user.calendar', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <rect x="3" y="4" width="14" height="14" rx="2" ry="2" />
                        <line x1="3" y1="9" x2="17" y2="9" />
                        <line x1="9" y1="4" x2="9" y2="18" />
                    </svg>
                    Ημερολόγιο Ομάδας
                </a>

                <a href="{{ route('user.statistics', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <line x1="18" y1="20" x2="18" y2="10" />
                        <line x1="12" y1="20" x2="12" y2="4" />
                        <line x1="6" y1="20" x2="6" y2="14" />
                    </svg>
                    Στατιστικά
                </a>

                <a href="{{ route('user.team-links', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <path
                            d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5" />
                        <path
                            d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5" />
                    </svg>
                    Χρήσιμοι Σύνδεσμοι
                </a>

                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor"
                        stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333" />
                        <path
                            d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667" />
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
                                            <div class="progress-bar"
                                                style="width: {{ ($user->total_days / $maxDays) * 100 }}%"></div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="empty-state">
                        <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.5">
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
            // monthlyData is an object keyed by month number
            return monthlyData[monthNumber] ? parseInt(monthlyData[monthNumber].total) : 0;
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
                            label: function (context) {
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
                            callback: function (value) {
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
                            generateLabels: function (chart) {
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
                            label: function (context) {
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