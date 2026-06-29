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
                <span class="stat-value text-dark" style="font-size: 18px;">5 Overdue</span>
                <!-- <span class="stat-desc text-danger">Calibration needed</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
        </a>

        <!-- Active Schedules -->
        <a href="schedule-list.php" class="stat-card warning text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Pending Schedule</span>
                <span class="stat-value text-dark" style="font-size: 18px;">3 In Progress</span>
                <!-- <span class="stat-desc text-success">Diagnostics active</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-calendar-range"></i></div>
        </a>

        <!-- Active Alarms / Alerts -->
        <a href="alerts.php" class="stat-card danger text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Active Alerts</span>
                <span class="stat-value text-dark" style="font-size: 18px;">3 Alarms</span>
                <!-- <span class="stat-desc text-danger">1 Critical, 2 Warnings</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-bell"></i></div>
        </a>

        <!-- Wheel Protection Activity -->
        <a href="monitoring.php" class="stat-card danger text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Wheel Protection</span>
                <span class="stat-value text-dark" style="font-size: 18px;">12 Solenoids Active</span>
                <!-- <span class="stat-desc text-warning">Dumping valve pulses</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-wind"></i></div>
        </a>

        <!-- Speed Sensors Grid -->
        <a href="sensors.php" class="stat-card success text-decoration-none">
            <div class="stat-info">
                <span class="stat-label">Speed Sensors</span>
                <span class="stat-value text-dark" style="font-size: 18px;">2,176 Grid</span>
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
                <span class="stat-value text-dark" style="font-size: 18px;">45 Units Deployed</span>
                <!-- <span class="stat-desc text-muted">Spares consumption logs</span> -->
            </div>
            <div class="stat-icon"><i class="bi bi-clipboard-check"></i></div>
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

        <!-- System Summary Cards -->
        <div class="col-lg-4">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-pie-chart"></i> Coach WSp Quality</h5>
                </div>
                <div class="card-body">
                    <div style="height: 235px; position: relative;">
                        <canvas id="signalQualityChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-3 mt-1">
        <!-- Live Alerts Table -->
        <div class="col-lg-12">
            <div class="content-card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                    <h5><i class="bi bi-exclamation-triangle-fill text-warning"></i> Live Slip Alert Monitoring Panel</h5>
                    <div class="d-flex gap-2 no-print">
                        <input type="text" id="alertSearchInput" class="form-control-custom" placeholder="Search Live Alerts..." style="width: 200px;">
                        <select id="severityFilter" class="form-control-custom" style="width: 130px;">
                            <option value="">All Severities</option>
                            <option value="CRITICAL">Critical</option>
                            <option value="WARNING">Warning</option>
                            <option value="RESOLVED">Resolved</option>
                        </select>
                    </div>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive-custom">
                        <table class="table-custom" id="liveAlertsTable">
                            <thead>
                                <tr>
                                    <th>Alert ID</th>
                                    <th>Train No</th>
                                    <th>Coach No</th>
                                    <th>Wheel No</th>
                                    <th>Axle No</th>
                                    <th>Sensor ID</th>
                                    <th>Division</th>
                                    <th>Alert Level</th>
                                    <th>Status</th>
                                    <th>Speed Diff</th>
                                    <th>Date Time</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row-alert">
                                    <td><strong>#ALT-9920</strong></td>
                                    <td>12002 - Shatabdi Exp</td>
                                    <td>CR-223456 (AC)</td>
                                    <td>W-3</td>
                                    <td>Axle-2</td>
                                    <td>SR-WSPS-09</td>
                                    <td>Firozpur (FZR)</td>
                                    <td><span class="badge-custom badge-danger">CRITICAL</span></td>
                                    <td><span class="badge-custom badge-danger"><i class="bi bi-shield-fill-exclamation"></i> Dumping Active</span></td>
                                    <td class="text-danger fw-bold">22 km/h</td>
                                    <td>25-Jun-2026 14:55:03</td>
                                </tr>
                                <tr class="table-row-alert">
                                    <td><strong>#ALT-9918</strong></td>
                                    <td>12952 - Mumbai Rajdhani</td>
                                    <td>WR-193425 (AC)</td>
                                    <td>W-1</td>
                                    <td>Axle-1</td>
                                    <td>SR-WSPS-24</td>
                                    <td>Kota (KOTA)</td>
                                    <td><span class="badge-custom badge-warning">WARNING</span></td>
                                    <td><span class="badge-custom badge-warning"><i class="bi bi-activity"></i> Slip Detected</span></td>
                                    <td class="text-warning fw-bold">11 km/h</td>
                                    <td>25-Jun-2026 14:52:12</td>
                                </tr>
                                <tr>
                                    <td><strong>#ALT-9915</strong></td>
                                    <td>12056 - Dehradun Jan Shatabdi</td>
                                    <td>NR-142211 (Gen)</td>
                                    <td>W-4</td>
                                    <td>Axle-2</td>
                                    <td>SR-WSPS-15</td>
                                    <td>Delhi (DLI)</td>
                                    <td><span class="badge-custom badge-warning">WARNING</span></td>
                                    <td><span class="badge-custom badge-warning"><i class="bi bi-activity"></i> Slip Detected</span></td>
                                    <td class="text-warning fw-bold">9 km/h</td>
                                    <td>25-Jun-2026 14:48:50</td>
                                </tr>
                                <tr>
                                    <td><strong>#ALT-9910</strong></td>
                                    <td>12260 - Sealdah Duronto</td>
                                    <td>ER-202115 (3A)</td>
                                    <td>W-2</td>
                                    <td>Axle-1</td>
                                    <td>SR-WSPS-45</td>
                                    <td>Sealdah (SDAH)</td>
                                    <td><span class="badge-custom badge-success">RESOLVED</span></td>
                                    <td><span class="badge-custom badge-success"><i class="bi bi-check-circle-fill"></i> Normal (Auto-Protected)</span></td>
                                    <td>1.2 km/h</td>
                                    <td>25-Jun-2026 14:32:00</td>
                                </tr>
                                <tr>
                                    <td><strong>#ALT-9904</strong></td>
                                    <td>12626 - Kerala Express</td>
                                    <td>SR-181123 (SL)</td>
                                    <td>W-3</td>
                                    <td>Axle-2</td>
                                    <td>SR-WSPS-08</td>
                                    <td>Thiruvananthapuram (TVC)</td>
                                    <td><span class="badge-custom badge-success">RESOLVED</span></td>
                                    <td><span class="badge-custom badge-success"><i class="bi bi-check-circle-fill"></i> Normal (Dump Clear)</span></td>
                                    <td>0.5 km/h</td>
                                    <td>25-Jun-2026 13:14:22</td>
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

    // 2. Signal Quality Pie Chart
    const signalQualityCtx = document.getElementById('signalQualityChart').getContext('2d');
    new Chart(signalQualityCtx, {
        type: 'doughnut',
        data: {
            labels: ['Excellent ( > 55dB)', 'Good ( 40-55dB)', 'Degraded ( 20-40dB)', 'Faulty ( < 20dB)'],
            datasets: [{
                data: [498, 38, 6, 2],
                backgroundColor: ['#198754', '#2F6DA6', '#FFC107', '#DC3545'],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, font: { family: 'Inter', size: 10 } }
                }
            },
            cutout: '65%'
        }
    });

    // 3. Live search and filtering implementation
    searchTable('alertSearchInput', 'liveAlertsTable');

    const severityFilter = document.getElementById('severityFilter');
    if (severityFilter) {
        severityFilter.addEventListener('change', function() {
            const val = severityFilter.value;
            const rows = document.querySelectorAll('#liveAlertsTable tbody tr');
            rows.forEach(row => {
                const cell = row.querySelector('td:nth-child(8) .badge-custom');
                if (!cell) return;
                const matches = val === "" || cell.textContent.trim() === val;
                row.style.display = matches ? "" : "none";
            });
        });
    }
</script>

</body>
</html>
