<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Wheel Slide Protection System (WSPS)</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <!-- Chart.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.9.1/chart.min.js"></script>
    <!-- Custom CSS -->
    <link href="assets/css/styles.css" rel="stylesheet">
</head>
<body>

<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<main class="main-content">
    <!-- Page Header & Breadcrumbs -->
    <div class="page-header">
        <div class="page-header-title-area">
            <h1>WSPS Dashboard Overview</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-secondary" onclick="window.print()"><i class="bi bi-printer"></i> Print</button>
            <button class="btn-wsps btn-wsps-primary" onclick="exportTableToExcel('liveAlertsTable', 'wsps-dashboard-alerts')"><i class="bi bi-download"></i> Export Data</button>
        </div>
    </div>

    <!-- Stats Grid (High Density Upgraded Click-Through Cards) -->
    <div class="stats-grid" style="grid-template-columns: repeat(auto-fill, minmax(200px, 1fr)); gap: 12px; margin-bottom: 20px;">
        <!-- Monitored Trains -->
        <a href="trains.php" class="stat-card text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Total Trains</span>
                <span class="stat-value text-dark" style="font-size: 18px;">52 Trains</span>
                <!-- <span class="stat-desc text-success"><i class="bi bi-wifi"></i> 18 Live Telemetry</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-train-front"></i></div>
        </a>

        <!-- Coach Monitoring -->
        <a href="coaches.php" class="stat-card success text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">ToTal Coaches</span>
                <span class="stat-value text-dark" style="font-size: 18px;">544 Coaches</span>
                <!-- <span class="stat-desc">420 LHB | 124 ICF</span> -->
            </div>
            <div class="stat-icon text-success"><i class="bi bi-box-seam"></i></div>
        </a>

        <!-- Depot Inventory -->
        <a href="inventory.php" class="stat-card secondary text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Depot Inventory</span>
                <span class="stat-value text-dark" style="font-size: 18px;">982 Items</span>
                <!-- <span class="stat-desc">₹24,500 Valuation</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-boxes"></i></div>
        </a>

        <!-- MMI Error Codes -->
        <a href="error-codes.php" class="stat-card secondary text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">MMI Error Codes</span>
                <span class="stat-value text-dark" style="font-size: 18px;">42 Event Codes</span>
                <!-- <span class="stat-desc">MB04B & EB01A spares</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-bug"></i></div>
        </a>

        <!-- Create Schedule -->
        <a href="inspection-schedule.php" class="stat-card warning text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Complete Schedule</span>
                <span class="stat-value text-dark" style="font-size: 18px;">5 Complete</span>
                <!-- <span class="stat-desc text-danger">Calibration needed</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
        </a>

        <!-- Active Schedules -->
        <a href="schedule-list.php" class="stat-card warning text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Pending Schedule</span>
                <span class="stat-value text-dark" style="font-size: 18px;">3 In Pending</span>
                <!-- <span class="stat-desc text-success">Diagnostics active</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-calendar-range"></i></div>
        </a>

        <!-- Active Alarms / Alerts -->
        <a href="alerts.php" class="stat-card danger text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Component Ok</span>
                <span class="stat-value text-dark" style="font-size: 18px;">45</span>
                <!-- <span class="stat-desc text-danger">1 Critical, 2 Warnings</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-bell"></i></div>
        </a>

        <!-- Wheel Protection Activity -->
        <a href="monitoring.php" class="stat-card danger text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Total Components</span>
                <span class="stat-value text-dark" style="font-size: 18px;">14</span>
                <!-- <span class="stat-desc text-warning">Dumping valve pulses</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-wind"></i></div>
        </a>

        <!-- Speed Sensors Grid -->
        <a href="sensors.php" class="stat-card success text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Total Sensors</span>
                <span class="stat-value text-dark" style="font-size: 18px;">2,176</span>
                <!-- <span class="stat-desc text-success">2,170 Online | 6 Offline</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-broadcast-pin"></i></div>
        </a>

        <!-- User Accounts -->
        <a href="users.php" class="stat-card secondary text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Authorized Users</span>
                <span class="stat-value text-dark" style="font-size: 18px;">14 Accounts</span>
                <!-- <span class="stat-desc text-success">3 Active Session logs</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-people"></i></div>
        </a>

        <!-- Subscription Status -->
        <a href="settings.php" class="stat-card warning text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Subscription Status</span>
                <span class="stat-value text-dark" style="font-size: 18px;">30 Days Pending</span>
                <!-- <span class="stat-desc text-danger"><i class="bi bi-exclamation-triangle"></i> Renew license soon</span> -->
            </div>
            <div class="stat-icon text-warning"><i class="bi bi-credit-card"></i></div>
        </a>

        <!-- Used Inventory -->
        <a href="inventory.php" class="stat-card secondary text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Used Inventory</span>
                <span class="stat-value text-dark" style="font-size: 18px;">45 Units </span>
            </div>
            <div class="stat-icon"><i class="bi bi-clipboard-check"></i></div>
        </a>

        <!-- Total OEM Makes -->
        <a href="manufacturers.php" class="stat-card secondary text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Total OEM Makes</span>
                <span class="stat-value text-dark" style="font-size: 18px;">5 OEMs</span>
            </div>
            <div class="stat-icon"><i class="bi bi-building"></i></div>
        </a>

        <!-- Warranty Claimed -->
        <a href="reports.php" class="stat-card success text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Warranty Claimed</span>
                <span class="stat-value text-dark" style="font-size: 18px;">18 Claims</span>
            </div>
            <div class="stat-icon text-success"><i class="bi bi-shield-check"></i></div>
        </a>

        <!-- Under Warranty -->
        <a href="inventory.php" class="stat-card success text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Under Warranty</span>
                <span class="stat-value text-dark" style="font-size: 18px;">142 Spares</span>
            </div>
            <div class="stat-icon text-success"><i class="bi bi-shield-lock"></i></div>
        </a>

        <!-- Total Defects / Broken -->
        <a href="error-codes.php" class="stat-card danger text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Total Defects / Broken</span>
                <span class="stat-value text-dark" style="font-size: 18px;">8 Faults Active</span>
            </div>
            <div class="stat-icon text-danger"><i class="bi bi-tools"></i></div>
        </a>

        <!-- Detached Coaches -->
        <a href="coaches.php" class="stat-card danger text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Detached Coaches</span>
                <span class="stat-value text-dark" style="font-size: 18px;">4 Coaches</span>
            </div>
            <div class="stat-icon text-danger"><i class="bi bi-journal-x"></i></div>
        </a>

        <!-- In-Service / Intact Coaches -->
        <a href="coaches.php" class="stat-card success text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">In-Service Coaches</span>
                <span class="stat-value text-dark" style="font-size: 18px;">540 Coaches</span>
            </div>
            <div class="stat-icon text-success"><i class="bi bi-journal-check"></i></div>
        </a>
    </div>

    <!-- Core Grid: Charts & Live Events -->
    <div class="row g-3">
        <!-- Main Chart Block -->
        <div class="col-lg-8">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-calendar2-check-fill"></i> Maintenance & Calibration Schedule Trend (Completed vs Pending)</h5>
                    <span class="badge-custom badge-primary no-print">Daily Activity</span>
                </div>
                <div class="card-body">
                    <div style="height: 235px; position: relative;">
                        <canvas id="performanceChart"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <!-- WSP Spares Inventory Widget -->
        <div class="col-lg-4">
            <div class="content-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="bi bi-boxes"></i> Used vs Unused Inventory</h5>
                    <a href="inventory.php" class="btn btn-wsps btn-wsps-xs btn-wsps-secondary text-decoration-none no-print" style="font-size: 9px; padding: 2px 6px;">Ledger <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive-custom" style="max-height: 235px; overflow-y: auto;">
                        <table class="table-custom mb-0" style="font-size: 11px;">
                            <thead>
                                <tr style="background-color: #f8f9fa;">
                                    <th>Spares Description</th>
                                    <th class="text-center" style="width: 100px;">Used (Deployed)</th>
                                    <th class="text-center" style="width: 100px;">Unused (In Stock)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>Main Processor Card</strong><br><span class="text-muted" style="font-size: 9px;">Processor Cards</span></td>
                                    <td class="text-center"><span class="badge bg-secondary text-white" style="font-size: 9px; padding: 3px 6px;">45 Deployed</span></td>
                                    <td class="text-center"><span class="badge bg-success text-white" style="font-size: 9px; padding: 3px 6px; background-color: #198754 !important;">5 Available</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Solenoid Dump Valve</strong><br><span class="text-muted" style="font-size: 9px;">Pneumatic Valves</span></td>
                                    <td class="text-center"><span class="badge bg-secondary text-white" style="font-size: 9px; padding: 3px 6px;">198 Deployed</span></td>
                                    <td class="text-center"><span class="badge bg-warning text-dark" style="font-size: 9px; padding: 3px 6px; background-color: #ffc107 !important;">2 Low Stock</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Speed Sensor Probe</strong><br><span class="text-muted" style="font-size: 9px;">Sensing Probes</span></td>
                                    <td class="text-center"><span class="badge bg-secondary text-white" style="font-size: 9px; padding: 3px 6px;">1,940 Deployed</span></td>
                                    <td class="text-center"><span class="badge bg-success text-white" style="font-size: 9px; padding: 3px 6px; background-color: #198754 !important;">12 Available</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Junction Box JB-02</strong><br><span class="text-muted" style="font-size: 9px;">Bogie Junctions</span></td>
                                    <td class="text-center"><span class="badge bg-secondary text-white" style="font-size: 9px; padding: 3px 6px;">200 Deployed</span></td>
                                    <td class="text-center"><span class="badge bg-danger text-white" style="font-size: 9px; padding: 3px 6px; background-color: #dc3545 !important;">0 Out of Stock</span></td>
                                </tr>
                                <tr>
                                    <td><strong>Extension Board EB-01A</strong><br><span class="text-muted" style="font-size: 9px;">Processor Cards</span></td>
                                    <td class="text-center"><span class="badge bg-secondary text-white" style="font-size: 9px; padding: 3px 6px;">42 Deployed</span></td>
                                    <td class="text-center"><span class="badge bg-success text-white" style="font-size: 9px; padding: 3px 6px; background-color: #198754 !important;">3 Available</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <!-- Recent 5 Inspections Table -->
        <div class="col-lg-12">
            <div class="content-card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5><i class="bi bi-shield-check text-success"></i> Recent 5 Inspections</h5>
                    <div class="d-flex gap-2 no-print">
                        <input type="text" id="inspSearchInput" class="form-control-custom" placeholder="Search Inspections..." style="width: 200px;">
                        <select id="statusFilter" class="form-control-custom" style="width: 160px;">
                            <option value="">All Statuses</option>
                            <option value="Passed">Passed</option>
                            <option value="Attention Required">Attention Required</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive-custom">
                        <table class="table-custom" id="recentInspectionsTable">
                            <thead>
                                <tr>
                                    <th>Inspection ID</th>
                                    <th>Date & Time</th>
                                    <th>Train No / Name</th>
                                    <th>Coach No</th>
                                    <th>Inspection Type</th>
                                    <th>Inspected By</th>
                                    <th>Status/Result</th>
                                    <th>Remarks / Actions Taken</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><strong>#INSP-3041</strong></td>
                                    <td>29-Jun-2026 16:45</td>
                                    <td>12002 - Shatabdi Exp</td>
                                    <td>CR-223456 (AC)</td>
                                    <td>Solenoid Actuation Test</td>
                                    <td>akhil golu</td>
                                    <td><span class="badge-custom badge-success">Passed</span></td>
                                    <td>Tested dump valve firing. Adhesion coefficient normal.</td>
                                </tr>
                                <tr>
                                    <td><strong>#INSP-3040</strong></td>
                                    <td>28-Jun-2026 11:30</td>
                                    <td>12952 - Mumbai Rajdhani</td>
                                    <td>WR-193425 (AC)</td>
                                    <td>Speed Sensor Calibration</td>
                                    <td>beatle team</td>
                                    <td><span class="badge-custom badge-success">Passed</span></td>
                                    <td>Sensor coil resistance verified (1050 ohms).</td>
                                </tr>
                                <tr>
                                    <td><strong>#INSP-3039</strong></td>
                                    <td>27-Jun-2026 09:15</td>
                                    <td>12056 - Dehradun Jan Shatabdi</td>
                                    <td>NR-142211 (Gen)</td>
                                    <td>Main Board Diagnostic</td>
                                    <td>akhil golu</td>
                                    <td><span class="badge-custom badge-danger">Attention Required</span></td>
                                    <td>Extension board EB01A-A2 has communication lag.</td>
                                </tr>
                                <tr>
                                    <td><strong>#INSP-3038</strong></td>
                                    <td>26-Jun-2026 15:20</td>
                                    <td>12260 - Sealdah Duronto</td>
                                    <td>ER-202115 (3A)</td>
                                    <td>Bogie Cabling Check</td>
                                    <td>beatle team</td>
                                    <td><span class="badge-custom badge-success">Passed</span></td>
                                    <td>Re-insulated speed sensor plug connection.</td>
                                </tr>
                                <tr>
                                    <td><strong>#INSP-3037</strong></td>
                                    <td>25-Jun-2026 10:10</td>
                                    <td>12626 - Kerala Express</td>
                                    <td>SR-181123 (SL)</td>
                                    <td>Routine Trip Inspection</td>
                                    <td>akhil golu</td>
                                    <td><span class="badge-custom badge-success">Passed</span></td>
                                    <td>WSP system check normal. No display errors.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    // 1. Calibration & Maintenance Schedule Trend Chart
    const performanceCtx = document.getElementById('performanceChart').getContext('2d');
    new Chart(performanceCtx, {
        type: 'line',
        data: {
            labels: ['18-Jun', '19-Jun', '20-Jun', '21-Jun', '22-Jun', '23-Jun', '24-Jun', '25-Jun', '26-Jun', '27-Jun', '28-Jun', '29-Jun'],
            datasets: [
                {
                    label: 'Completed Schedules',
                    data: [12, 15, 10, 18, 14, 20, 25, 22, 18, 15, 24, 28],
                    borderColor: '#198754',
                    backgroundColor: 'rgba(25, 135, 84, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                },
                {
                    label: 'Pending / Assigned',
                    data: [5, 4, 6, 3, 5, 2, 4, 3, 5, 6, 4, 5],
                    borderColor: '#FFC107',
                    backgroundColor: 'rgba(255, 193, 7, 0.05)',
                    borderWidth: 2,
                    fill: true,
                    tension: 0.3
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'top',
                    labels: { boxWidth: 15, font: { family: 'Inter', size: 11 } }
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#F1F5F9' },
                    ticks: { font: { family: 'Inter', size: 10 } }
                },
                x: {
                    grid: { display: false },
                    ticks: { font: { family: 'Inter', size: 10 } }
                }
            }
        }
    });



    // 3. Live search and filtering implementation for Recent Inspections
    searchTable('inspSearchInput', 'recentInspectionsTable');

    const statusFilter = document.getElementById('statusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            const val = statusFilter.value;
            const rows = document.querySelectorAll('#recentInspectionsTable tbody tr');
            rows.forEach(row => {
                const cell = row.querySelector('td:nth-child(7) .badge-custom');
                if (!cell) return;
                const matches = val === "" || cell.textContent.trim() === val;
                row.style.display = matches ? "" : "none";
            });
        });
    }
</script>

</body>
</html>
