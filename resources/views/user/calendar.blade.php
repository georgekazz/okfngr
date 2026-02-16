<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ημερολόγιο Ομάδας - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
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

        .calendar-controls {
            background: white;
            padding: 1.5rem;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            margin-bottom: 2rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .current-month {
            font-size: 1.5rem;
            font-weight: 700;
            color: var(--color-dark);
        }

        .month-nav {
            display: flex;
            gap: 1rem;
        }

        .nav-btn {
            width: 40px;
            height: 40px;
            border: 2px solid #e0e0e0;
            background: white;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s;
            color: var(--color-gray);
        }

        .nav-btn:hover {
            border-color: var(--color-cyan);
            color: var(--color-cyan);
            background: rgba(0, 209, 255, 0.05);
        }

        .calendar-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
            margin-bottom: 2rem;
        }

        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 1px;
            background: #e0e0e0;
            border: 1px solid #e0e0e0;
            border-radius: 12px;
            overflow: hidden;
        }

        .calendar-day-header {
            background: #f8f9fa;
            padding: 1rem;
            text-align: center;
            font-weight: 700;
            font-size: 0.9rem;
            color: var(--color-dark);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .calendar-day {
            background: white;
            min-height: 100px;
            padding: 0.75rem;
            position: relative;
            cursor: pointer;
            transition: all 0.2s;
        }

        .calendar-day:hover {
            background: #f8f9fa;
        }

        .calendar-day.other-month {
            background: #fafafa;
            opacity: 0.5;
        }

        .calendar-day.today {
            background: rgba(0, 209, 255, 0.05);
        }

        .day-number {
            font-size: 0.9rem;
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 0.5rem;
        }

        .calendar-day.today .day-number {
            color: var(--color-cyan);
            font-weight: 900;
        }

        .day-events {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .event-bar {
            padding: 4px 8px;
            border-radius: 4px;
            font-size: 0.75rem;
            font-weight: 600;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            cursor: pointer;
            transition: all 0.2s;
        }

        .event-bar:hover {
            transform: translateY(-1px);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .event-vacation {
            background: rgba(0, 209, 255, 0.2);
            color: #007a99;
        }

        .event-sick {
            background: rgba(224, 119, 255, 0.2);
            color: #8a3db3;
        }

        .event-personal {
            background: rgba(228, 255, 54, 0.3);
            color: #6b5f00;
        }

        .event-other {
            background: rgba(173, 255, 237, 0.3);
            color: #00665a;
        }

        .legend {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 1.5rem;
            margin-bottom: 2rem;
        }

        .legend-title {
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 1rem;
        }

        .legend-items {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .legend-item {
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .legend-color {
            width: 20px;
            height: 20px;
            border-radius: 4px;
        }

        .legend-label {
            font-size: 0.9rem;
            color: var(--color-gray);
        }

        .upcoming-section {
            background: white;
            border-radius: 12px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
            padding: 2rem;
        }

        .upcoming-title {
            font-size: 1.3rem;
            font-weight: 700;
            color: var(--color-dark);
            margin-bottom: 1.5rem;
        }

        .upcoming-list {
            display: flex;
            flex-direction: column;
            gap: 1rem;
        }

        .upcoming-item {
            padding: 1.25rem;
            border: 2px solid #f0f0f0;
            border-radius: 12px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: all 0.3s;
        }

        .upcoming-item:hover {
            border-color: var(--color-cyan);
            box-shadow: 0 4px 12px rgba(0, 209, 255, 0.1);
        }

        .upcoming-info {
            display: flex;
            align-items: center;
            gap: 1rem;
        }

        .user-avatar {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--color-cyan), var(--color-purple));
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 1.2rem;
        }

        .upcoming-details h4 {
            font-size: 1rem;
            font-weight: 600;
            color: var(--color-dark);
            margin-bottom: 0.25rem;
        }

        .upcoming-dates {
            font-size: 0.9rem;
            color: var(--color-gray);
        }

        .type-badge {
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-size: 0.8rem;
            font-weight: 700;
            text-transform: uppercase;
        }

        .type-vacation {
            background: rgba(0, 209, 255, 0.1);
            color: var(--color-cyan);
        }

        .type-sick {
            background: rgba(224, 119, 255, 0.1);
            color: var(--color-purple);
        }

        .type-personal {
            background: rgba(228, 255, 54, 0.2);
            color: #9a8800;
        }

        .type-other {
            background: rgba(173, 255, 237, 0.2);
            color: #00998a;
        }

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

        @media (max-width: 768px) {
            .dashboard-layout {
                grid-template-columns: 1fr;
            }

            .dashboard-sidebar {
                display: none;
            }

            .calendar-grid {
                gap: 0;
            }

            .calendar-day {
                min-height: 80px;
                padding: 0.5rem;
            }

            .day-number {
                font-size: 0.8rem;
            }

            .event-bar {
                font-size: 0.65rem;
                padding: 2px 4px;
            }

            .legend-items {
                flex-direction: column;
                gap: 0.75rem;
            }

            .upcoming-item {
                flex-direction: column;
                align-items: flex-start;
                gap: 1rem;
            }
        }
    </style>
</head>
<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Ημερολόγιο Ομάδας</h1>
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
                        <path d="M2.5 7.5L10 2.5L17.5 7.5V16.25C17.5 16.5815 17.3683 16.8995 17.1339 17.1339C16.8995 17.3683 16.5815 17.5 16.25 17.5H3.75C3.41848 17.5 3.10054 17.3683 2.86612 17.1339C2.6317 16.8995 2.5 16.5815 2.5 16.25V7.5Z"/>
                    </svg>
                    Αρχική
                </a>

                <a href="{{ route('user.day-offs.index', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M15.8333 3.33334H4.16667C3.24619 3.33334 2.5 4.07954 2.5 5.00001V16.6667C2.5 17.5871 3.24619 18.3333 4.16667 18.3333H15.8333C16.7538 18.3333 17.5 17.5871 17.5 16.6667V5.00001C17.5 4.07954 16.7538 3.33334 15.8333 3.33334Z"/>
                        <path d="M13.3333 1.66666V5"/>
                        <path d="M6.66666 1.66666V5"/>
                        <path d="M2.5 8.33334H17.5"/>
                    </svg>
                    Οι Άδειές μου
                </a>

                <a href="{{ route('user.calendar', ['locale' => app()->getLocale()]) }}" class="nav-link active">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="14" height="14" rx="2" ry="2"/>
                        <line x1="3" y1="9" x2="17" y2="9"/>
                        <line x1="9" y1="4" x2="9" y2="18"/>
                    </svg>
                    Ημερολόγιο Ομάδας
                </a>

                <a href="{{ route('user.statistics', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <line x1="18" y1="20" x2="18" y2="10"/>
                        <line x1="12" y1="20" x2="12" y2="4"/>
                        <line x1="6" y1="20" x2="6" y2="14"/>
                    </svg>
                    Στατιστικά
                </a>

                <a href="{{ route('user.team-links', ['locale' => app()->getLocale()]) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <path d="M8.33333 10.8333C8.69094 11.3118 9.14715 11.7075 9.67121 11.9938C10.1953 12.28 10.7764 12.4499 11.3718 12.4924C11.9672 12.5348 12.5651 12.4488 13.1253 12.2401C13.6854 12.0315 14.195 11.7051 14.6167 11.2833L16.95 8.95C17.7003 8.17902 18.1171 7.14282 18.1079 6.06682C18.0986 4.99082 17.6641 3.96202 16.9011 3.20404C16.1381 2.44606 15.1038 2.02127 14.0228 2.02199C12.9418 2.0227 11.9081 2.45887 11.1458 3.21667L9.85833 4.5"/>
                        <path d="M11.6667 9.16667C11.3091 8.68815 10.8529 8.29254 10.3288 8.00626C9.80472 7.71998 9.22361 7.55007 8.62821 7.50761C8.03281 7.46515 7.43491 7.55115 6.87476 7.75982C6.31461 7.96849 5.80502 8.29491 5.38333 8.71667L3.05 11.05C2.29968 11.821 1.88292 12.8572 1.89215 13.9332C1.90138 15.0092 2.33586 16.038 3.09885 16.796C3.86183 17.554 4.8961 17.9787 5.97711 17.978C7.05812 17.9773 8.09193 17.5411 8.85417 16.7833L10.1333 15.5"/>
                    </svg>
                    Χρήσιμοι Σύνδεσμοι
                </a>

                <a href="{{ url('/' . app()->getLocale()) }}" class="nav-link">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none" stroke="currentColor" stroke-width="1.5">
                        <circle cx="10" cy="10" r="8.33333"/>
                        <path d="M10 13.3333C11.841 13.3333 13.3333 11.841 13.3333 10C13.3333 8.15905 11.841 6.66667 10 6.66667"/>
                    </svg>
                    Προβολή Ιστοτόπου
                </a>
            </nav>
        </aside>

        <main class="dashboard-main">
            <div class="page-header">
                <h2>Ημερολόγιο Ομάδας {{ date('Y') }}</h2>
                <p class="page-subtitle">Δείτε όλες τις άδειες των μελών της ομάδας</p>
            </div>

            <!-- Legend -->
            <div class="legend">
                <div class="legend-title">Τύποι Αδειών</div>
                <div class="legend-items">
                    <div class="legend-item">
                        <div class="legend-color" style="background: rgba(0, 209, 255, 0.2);"></div>
                        <span class="legend-label">Διακοπές</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: rgba(224, 119, 255, 0.2);"></div>
                        <span class="legend-label">Ασθένεια</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: rgba(228, 255, 54, 0.3);"></div>
                        <span class="legend-label">Προσωπική</span>
                    </div>
                    <div class="legend-item">
                        <div class="legend-color" style="background: rgba(173, 255, 237, 0.3);"></div>
                        <span class="legend-label">Άλλο</span>
                    </div>
                </div>
            </div>

            <!-- Calendar -->
            <div class="calendar-container">
                <div class="calendar-grid">
                    <!-- Day Headers -->
                    <div class="calendar-day-header">Δευ</div>
                    <div class="calendar-day-header">Τρί</div>
                    <div class="calendar-day-header">Τετ</div>
                    <div class="calendar-day-header">Πέμ</div>
                    <div class="calendar-day-header">Παρ</div>
                    <div class="calendar-day-header">Σάβ</div>
                    <div class="calendar-day-header">Κυρ</div>

                    @php
                        $currentDate = \Carbon\Carbon::now();
                        $firstDayOfMonth = $currentDate->copy()->startOfMonth();
                        $lastDayOfMonth = $currentDate->copy()->endOfMonth();
                        
                        // Get the first Monday before or on the first day of the month
                        $startDate = $firstDayOfMonth->copy()->startOfWeek(\Carbon\Carbon::MONDAY);
                        
                        // Get the last Sunday after or on the last day of the month
                        $endDate = $lastDayOfMonth->copy()->endOfWeek(\Carbon\Carbon::SUNDAY);
                        
                        $calendarDate = $startDate->copy();
                    @endphp

                    @while($calendarDate <= $endDate)
                        @php
                            $isToday = $calendarDate->isToday();
                            $isOtherMonth = $calendarDate->month != $currentDate->month;
                            
                            // Get day offs for this date
                            $dayEvents = $dayOffs->filter(function($dayOff) use ($calendarDate) {
                                return $calendarDate->between($dayOff->start_date, $dayOff->end_date);
                            });
                        @endphp
                        
                        <div class="calendar-day {{ $isToday ? 'today' : '' }} {{ $isOtherMonth ? 'other-month' : '' }}">
                            <div class="day-number">{{ $calendarDate->day }}</div>
                            <div class="day-events">
                                @foreach($dayEvents as $event)
                                    <div class="event-bar event-{{ $event->type }}" title="{{ $event->user->name }} - {{ $event->reason }}">
                                        {{ $event->user->name }}
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        
                        @php
                            $calendarDate->addDay();
                        @endphp
                    @endwhile
                </div>
            </div>

            <!-- Upcoming Day Offs -->
            <div class="upcoming-section">
                <div class="upcoming-title">Επερχόμενες Άδειες</div>
                
                @php
                    $upcomingDayOffs = $dayOffs->filter(function($dayOff) {
                        return $dayOff->start_date >= \Carbon\Carbon::today();
                    })->sortBy('start_date')->take(10);
                @endphp

                @if($upcomingDayOffs->count() > 0)
                <div class="upcoming-list">
                    @foreach($upcomingDayOffs as $dayOff)
                    <div class="upcoming-item">
                        <div class="upcoming-info">
                            <div class="user-avatar">
                                {{ strtoupper(substr($dayOff->user->name, 0, 1)) }}
                            </div>
                            <div class="upcoming-details">
                                <h4>{{ $dayOff->user->name }}</h4>
                                <div class="upcoming-dates">
                                    {{ $dayOff->start_date->format('d/m/Y') }} - {{ $dayOff->end_date->format('d/m/Y') }}
                                    ({{ $dayOff->total_days }} {{ $dayOff->total_days == 1 ? 'μέρα' : 'μέρες' }})
                                </div>
                                @if($dayOff->reason)
                                <div class="upcoming-dates">{{ $dayOff->reason }}</div>
                                @endif
                            </div>
                        </div>
                        <span class="type-badge type-{{ $dayOff->type }}">
                            @if($dayOff->type === 'vacation')
                                Διακοπές
                            @elseif($dayOff->type === 'sick')
                                Ασθένεια
                            @elseif($dayOff->type === 'personal')
                                Προσωπική
                            @else
                                Άλλο
                            @endif
                        </span>
                    </div>
                    @endforeach
                </div>
                @else
                <div class="empty-state">
                    <svg width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
                        <rect x="3" y="4" width="18" height="18" rx="2" ry="2"/>
                        <line x1="16" y1="2" x2="16" y2="6"/>
                        <line x1="8" y1="2" x2="8" y2="6"/>
                        <line x1="3" y1="10" x2="21" y2="10"/>
                    </svg>
                    <h3>Δεν υπάρχουν επερχόμενες άδειες</h3>
                    <p>Κανένα μέλος της ομάδας δεν έχει προγραμματισμένες άδειες</p>
                </div>
                @endif
            </div>
        </main>
    </div>
</body>
</html>