{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
        <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html> --}}


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', '.: Pro Imran :.') }} - @yield('title')</title>

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=JetBrains+Mono:ital,wght@0,100..800;1,100..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">

    <!-- Chart.js for Graphs -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <!-- Phosphor Icons (Modern Icon Library) -->
    <script src="https://unpkg.com/@phosphor-icons/web"></script>

    <!-- Custom CSS get from resources -->
    @vite(['resources/css/style.css'])
</head>
<body>

    <!-- Sidebar Overlay for Mobile -->
    <div class="sidebar-overlay" id="sidebarOverlay"></div>

    <!-- Sidebar -->
    <aside class="sidebar" id="sidebar">
        <div class="logo">
            <i class="fas fa-chart-pie"></i>
            <div>
                Imran Pro
                <span class="logo-sub">Finance & Accounts</span>
            </div>
        </div>

        <nav class="nav-menu">
            <a href="#" class="nav-item active">
                <i class="ph ph-squares-four"></i> Dashboard
            </a>
            <a href="transactions.html" class="nav-item">
                <i class="ph ph-arrows-left-right"></i> Transactions
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-file-text"></i> Invoices
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-receipt"></i> Bills
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-bank"></i> Banking
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-users"></i> Customers
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-truck"></i> Suppliers
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-chart-bar"></i> Reports
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-shield-check"></i> Accounts
            </a>
            <a href="#" class="nav-item">
                <i class="ph ph-gear"></i> Settings
            </a>
        </nav>

        <div class="system-status">
            <div><span class="status-dot"></span> System Online</div>
            <div style="color: #9ca3af; margin-top: 4px;">Last sync: 10 Oct 2026, 10:24 AM</div>
        </div>
    </aside>

    <!-- Main Wrapper -->
    <div class="main-wrapper">

        <!-- Topbar -->
        <header class="topbar">
            <button class="mobile-menu-btn" id="mobileMenuBtn">
                <i class="ph ph-list"></i>
            </button>

            <div class="search-bar">
                <i class="ph ph-magnifying-glass"></i>
                <input type="text" placeholder="Search anything... (e.g. invoice, transaction, customer)">
            </div>

            <div class="topbar-right">
                <div class="notification">
                    <i class="ph ph-bell"></i>
                </div>

                <div class="user-profile" id="userProfileBtn">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150" alt="Imran Hossain">
                    <div class="user-info">
                        <span class="name">Imran Hossain</span>
                        <span class="role">Admin</span>
                    </div>
                    <i class="ph ph-caret-down" style="color: var(--text-muted); font-size: 14px;"></i>

                    <!-- Profile Dropdown -->
                    <div class="profile-dropdown" id="profileDropdown">
                        <a href="#"><i class="ph ph-user"></i> My Profile</a>
                        <a href="#"><i class="ph ph-lock-key"></i> Change Password</a>
                        <a href="#"><i class="ph ph-bell"></i> Notification Settings</a>
                        {{-- <a href="#"><i class="ph ph-sign-out"></i> Log Out</a> --}}
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="ph ph-sign-out"></i> Log Out
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </div>
            </div>
        </header>

        <!-- Content -->
        <main class="content">

            <div class="page-header">
                <div>
                    <h1>Dashboard</h1>
                    <p>Here's what's happening with your finances today.</p>
                </div>
                <div class="date-picker">
                    <i class="ph ph-calendar-blank"></i>
                    Oct 1, 2026 - Oct 31, 2026
                    <i class="ph ph-caret-down" style="font-size: 12px; margin-left: 8px;"></i>
                </div>
            </div>

            <!-- Stats Cards -->
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Income</span>
                        <div class="stat-icon green"><i class="ph ph-arrow-up-right"></i></div>
                    </div>
                    <div class="stat-value">৳ 4,86,320</div>
                    <div class="stat-trend trend-up">
                        <i class="ph ph-arrow-up"></i> 12% <span style="color: var(--text-muted);">vs. last month</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Total Expenses</span>
                        <div class="stat-icon red"><i class="ph ph-arrow-down-right"></i></div>
                    </div>
                    <div class="stat-value">৳ 3,21,450</div>
                    <div class="stat-trend trend-down">
                        <i class="ph ph-arrow-up"></i> 8% <span style="color: var(--text-muted);">vs. last month</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Net Profit</span>
                        <div class="stat-icon blue"><i class="ph ph-bank"></i></div>
                    </div>
                    <div class="stat-value">৳ 1,64,870</div>
                    <div class="stat-trend trend-up">
                        <i class="ph ph-arrow-up"></i> 15% <span style="color: var(--text-muted);">vs. last month</span>
                    </div>
                </div>

                <div class="stat-card">
                    <div class="stat-header">
                        <span class="stat-title">Outstanding Receivables</span>
                        <div class="stat-icon purple"><i class="ph ph-file-text"></i></div>
                    </div>
                    <div class="stat-value">৳ 98,400</div>
                    <div class="stat-trend trend-down">
                        <i class="ph ph-arrow-down"></i> 6% <span style="color: var(--text-muted);">vs. last month</span>
                    </div>
                </div>
            </div>

            <!-- Main Dashboard Grid -->
            <div class="dashboard-grid">

                <!-- Left Column -->
                <div class="left-column">

                    <!-- Charts Row -->
                    <div class="charts-row">
                        <div class="card" style="min-width: 0;">
                            <div class="card-header">
                                <h3><i class="ph ph-chart-bar"></i> Income vs Expenses</h3>
                            </div>
                            <!-- Chart Wrapper -->
                            <div class="chart-container">
                                <canvas id="incomeExpenseChart"></canvas> <!-- height/width অ্যাট্রিবিউট ছাড়া -->
                            </div>
                        </div>

                        <div class="card" style="min-width: 0;">
                            <div class="card-header">
                                <h3><i class="ph ph-chart-pie-slice"></i> Expense Breakdown</h3>
                            </div>
                            <!-- Chart Wrapper -->
                            <div class="chart-container">
                                <canvas id="expenseChart"></canvas>
                                <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center; pointer-events: none;">
                                    <div style="font-size: 12px; color: var(--text-muted);">Total Expenses</div>
                                    <div style="font-size: 16px; font-weight: 700;">৳ 3,21,450</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Transactions -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="ph ph-arrows-left-right"></i> Recent Transactions</h3>
                            <a href="#" class="view-all">View All</a>
                        </div>
                        <div class="table-responsive">
                            <table>
                                <thead>
                                    <tr>
                                        <th>Date</th>
                                        <th>Description</th>
                                        <th>Type</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>10 Oct 2026</td>
                                        <td>Office Supplies</td>
                                        <td><span class="badge expense">Expense</span></td>
                                        <td>৳ 12,450</td>
                                        <td><span class="badge completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>09 Oct 2026</td>
                                        <td>Client Payment - ABC Ltd</td>
                                        <td><span class="badge income">Income</span></td>
                                        <td>৳ 85,000</td>
                                        <td><span class="badge completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>08 Oct 2026</td>
                                        <td>Electricity Bill</td>
                                        <td><span class="badge expense">Expense</span></td>
                                        <td>৳ 8,320</td>
                                        <td><span class="badge completed">Completed</span></td>
                                    </tr>
                                    <tr>
                                        <td>07 Oct 2026</td>
                                        <td>Invoice #INV-1024</td>
                                        <td><span class="badge income">Income</span></td>
                                        <td>৳ 42,000</td>
                                        <td><span class="badge pending">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td>06 Oct 2026</td>
                                        <td>Rent Payment</td>
                                        <td><span class="badge expense">Expense</span></td>
                                        <td>৳ 50,000</td>
                                        <td><span class="badge completed">Completed</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="right-column">

                    <!-- Profile Card -->
                    <div class="profile-card">
                        <div class="profile-banner"></div>
                        <div class="profile-content">
                            <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?auto=format&fit=crop&q=80&w=150" alt="Imran Hossain">
                            <div class="profile-text">
                                <h4>Imran Hossain</h4>
                                <p>imran@company.com</p>
                                <p style="font-size: 11px; color: #9ca3af;">Admin</p>
                            </div>
                            <div class="profile-menu">
                                <a href="#"><i class="ph ph-user"></i> My Profile</a>
                                <a href="#"><i class="ph ph-lock-key"></i> Change Password</a>
                                <a href="#"><i class="ph ph-bell"></i> Notification Settings</a>
                                <a href="#"><i class="ph ph-sign-out"></i> Log Out</a>
                            </div>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="ph ph-lightning"></i> Quick Actions</h3>
                        </div>
                        <div class="quick-actions">
                            <div class="action-btn">
                                <i class="ph ph-file-plus"></i>
                                New Invoice
                            </div>
                            <div class="action-btn" style="background: #fef2f2;">
                                <i class="ph ph-receipt" style="color: var(--danger);"></i>
                                Add Expense
                            </div>
                            <div class="action-btn" style="background: #f0fdf4;">
                                <i class="ph ph-currency-circle-dollar" style="color: var(--primary);"></i>
                                Record Payment
                            </div>
                            <div class="action-btn">
                                <i class="ph ph-chart-line-up"></i>
                                New Report
                            </div>
                        </div>
                    </div>

                    <!-- Cash Flow -->
                    <div class="card">
                        <div class="card-header">
                            <h3><i class="ph ph-money"></i> Cash Flow</h3>
                            <a href="#" class="view-all">View Details</a>
                        </div>
                        <div class="cash-flow-list">
                            <div class="flow-item">
                                <span>Opening Balance</span>
                                <span>৳ 2,45,600</span>
                            </div>
                            <div class="flow-item">
                                <span>Total Inflow</span>
                                <span class="text-green">৳ 4,86,320</span>
                            </div>
                            <div class="flow-item">
                                <span>Total Outflow</span>
                                <span class="text-red">৳ 3,21,450</span>
                            </div>
                            <div class="flow-item total">
                                <span>Closing Balance</span>
                                <span>৳ 2,10,470</span>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </main>
    </div>

    <!-- JavaScript Actions -->
    @vite(['resources/js/customs.js'])
</body>
</html>
