<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Υπολογισμός Μισθού - {{ Auth::user()->name }}</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/writerdashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/userPanel/salary-calculator.css') }}">
    <link rel="icon" href="{{ asset('img/favicon.ico') }}" type="image/x-icon">
</head>

<body>
    <header class="dashboard-header">
        <div class="header-container">
            <div class="header-left">
                <img src="{{ asset('img/OKGR-landscape-full-rgb.svg') }}" alt="OKFN Greece" class="dashboard-logo">
                <h1>Υπολογισμός Μισθού</h1>
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

                <a href="{{ route('user.salary-calculator', ['locale' => app()->getLocale()]) }}"
                    class="nav-link active">
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

                <a href="{{ route('user.statistics', ['locale' => app()->getLocale()]) }}" class="nav-link">
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
                <h2>Υπολογισμός Μισθού</h2>
                <p class="page-subtitle">Υπολογίστε το πραγματικό σας εισόδημα μετά τις παρακρατήσεις</p>
            </div>

            <div class="info-box">
                <div class="info-box-title">
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="12" cy="12" r="10" />
                        <line x1="12" y1="16" x2="12" y2="12" />
                        <line x1="12" y1="8" x2="12.01" y2="8" />
                    </svg>
                    Πληροφορίες
                </div>
                <div class="info-box-text">
                    <strong>Πανεπιστήμιο:</strong> Παρακράτηση 20% - Πληρωμή κάθε μήνα<br>
                    <strong>OKFN:</strong> Παρακράτηση 20% + ΦΠΑ 24% - Σύμβαση 3 μηνών - Πληρωμή: 50% στον 1.5 μήνα, 50%
                    στο τέλος
                </div>
            </div>

            <div class="calculator-grid">
                <!-- University Calculator -->
                <div class="calculator-card">
                    <div class="card-header">
                        <div class="card-icon university">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path d="M22 10v6M2 10l10-5 10 5-10 5z" />
                                <path d="M6 12v5c3 3 9 3 12 0v-5" />
                            </svg>
                        </div>
                        <div class="card-title">Πανεπιστήμιο</div>
                    </div>

                    <div class="form-group">
                        <label for="uni_contract">Ποσό Σύμβασης (μηνιαίο)</label>
                        <div class="currency-input">
                            <input type="number" id="uni_contract" class="form-input" placeholder="0.00" step="0.01"
                                min="0">
                        </div>
                    </div>

                    <div class="breakdown-section">
                        <div class="breakdown-title">Ανάλυση</div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Ποσό Σύμβασης</span>
                            <span class="breakdown-value" id="uni_gross">€0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Παρακράτηση 20%</span>
                            <span class="breakdown-value negative" id="uni_tax">-€0.00</span>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="total-label">Καθαρό Ποσό (μηνιαίο)</div>
                        <div class="total-amount" id="uni_net">€0.00</div>
                    </div>

                    <div class="payment-schedule">
                        <div class="schedule-title">Πληρωμή</div>
                        <div class="schedule-item">
                            <div class="schedule-icon">1</div>
                            <div class="schedule-details">
                                <div class="schedule-period">Κάθε Μήνα</div>
                                <div class="schedule-amount" id="uni_monthly">€0.00</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- OKFN Calculator -->
                <div class="calculator-card">
                    <div class="card-header">
                        <div class="card-icon okfn">
                            <svg width="28" height="28" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="2">
                                <path
                                    d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z" />
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96" />
                                <line x1="12" y1="22.08" x2="12" y2="12" />
                            </svg>
                        </div>
                        <div class="card-title">OKFN</div>
                    </div>

                    <div class="form-group">
                        <label for="okfn_contract">Ποσό Σύμβασης (3μηνο)</label>
                        <div class="currency-input">
                            <input type="number" id="okfn_contract" class="form-input" placeholder="0.00" step="0.01"
                                min="0">
                        </div>
                    </div>

                    <div class="breakdown-section">
                        <div class="breakdown-title">Ανάλυση</div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Ποσό Σύμβασης</span>
                            <span class="breakdown-value" id="okfn_gross">€0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">Παρακράτηση 20%</span>
                            <span class="breakdown-value negative" id="okfn_tax">-€0.00</span>
                        </div>
                        <div class="breakdown-item">
                            <span class="breakdown-label">ΦΠΑ 24%</span>
                            <span class="breakdown-value negative" id="okfn_vat">-€0.00</span>
                        </div>
                    </div>

                    <div class="total-section">
                        <div class="total-label">Καθαρό Ποσό (3μηνο)</div>
                        <div class="total-amount" id="okfn_net">€0.00</div>
                    </div>

                    <div class="payment-schedule">
                        <div class="schedule-title">Πληρωμές</div>
                        <div class="schedule-item">
                            <div class="schedule-icon">1</div>
                            <div class="schedule-details">
                                <div class="schedule-period">Στον 1.5 μήνα (50%)</div>
                                <div class="schedule-amount" id="okfn_first">€0.00</div>
                            </div>
                        </div>
                        <div class="schedule-item">
                            <div class="schedule-icon">2</div>
                            <div class="schedule-details">
                                <div class="schedule-period">Στο τέλος 3μήνου (50%)</div>
                                <div class="schedule-amount" id="okfn_second">€0.00</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>

    <script>
        // Format currency
        function formatCurrency(amount) {
            return '€' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
        }

        // University Calculator
        document.getElementById('uni_contract').addEventListener('input', function () {
            const contract = parseFloat(this.value) || 0;
            const tax = contract * 0.20;
            const net = contract - tax;

            document.getElementById('uni_gross').textContent = formatCurrency(contract);
            document.getElementById('uni_tax').textContent = '-' + formatCurrency(tax);
            document.getElementById('uni_net').textContent = formatCurrency(net);
            document.getElementById('uni_monthly').textContent = formatCurrency(net);
        });

        // OKFN Calculator
        document.getElementById('okfn_contract').addEventListener('input', function () {
            const contract = parseFloat(this.value) || 0;
            const tax = contract * 0.20;
            const vat = contract * 0.24;
            const net = contract - tax - vat;
            const firstPayment = net / 2;
            const secondPayment = net / 2;

            document.getElementById('okfn_gross').textContent = formatCurrency(contract);
            document.getElementById('okfn_tax').textContent = '-' + formatCurrency(tax);
            document.getElementById('okfn_vat').textContent = '-' + formatCurrency(vat);
            document.getElementById('okfn_net').textContent = formatCurrency(net);
            document.getElementById('okfn_first').textContent = formatCurrency(firstPayment);
            document.getElementById('okfn_second').textContent = formatCurrency(secondPayment);
        });
    </script>
</body>

</html>