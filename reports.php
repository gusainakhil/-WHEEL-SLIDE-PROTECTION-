<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports - Wheel Slide Protection System (WSPS)</title>
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
            <h1>System Reports & Analytics</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Reports</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-secondary" onclick="window.print()"><i class="bi bi-printer"></i> Print Report</button>
            <button class="btn-wsps btn-wsps-primary" onclick="exportTableToExcel('reportPreviewTable', 'wsps-telemetry-report')"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Reports Generated</span>
                <span class="stat-value">312</span>
                <span class="stat-desc">This month</span>
            </div>
            <div class="stat-icon"><i class="bi bi-file-earmark-text"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Saved Configurations</span>
                <span class="stat-value">8</span>
                <span class="stat-desc text-success">Quick-generate templates</span>
            </div>
            <div class="stat-icon"><i class="bi bi-bookmark-star"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Scheduled Reports</span>
                <span class="stat-value">3</span>
                <span class="stat-desc">Daily/Weekly auto-email</span>
            </div>
            <div class="stat-icon"><i class="bi bi-calendar-check"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Log Volume</span>
                <span class="stat-value">1.4 GB</span>
                <span class="stat-desc">Telemetry database size</span>
            </div>
            <div class="stat-icon"><i class="bi bi-database"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Database Backup</span>
                <span class="stat-value">OK</span>
                <span class="stat-desc text-success">Last: 25-Jun 04:00 AM</span>
            </div>
            <div class="stat-icon"><i class="bi bi-cloud-arrow-up"></i></div>
        </div>
    </div>

    <!-- Configuration Panel -->
    <div class="content-card no-print">
        <div class="card-header">
            <h5><i class="bi bi-gear-fill"></i> Report Generation Criteria</h5>
        </div>
        <div class="card-body">
            <form onsubmit="generateReport(event)">
                <div class="row g-2">
                    <div class="col-md-3">
                        <label class="form-label-custom" for="reportType">Report Type</label>
                        <select id="reportType" class="form-control-custom" required>
                            <option value="daily">Daily Protection Summary</option>
                            <option value="sensor">Sensor Calibration & Health</option>
                            <option value="valves">Wheel Slide Protection Actuation</option>
                            <option value="wear">Wheel Wear & Flat Spots</option>
                        </select>
                    </div>
                    <div class="col-md-3">
                        <label class="form-label-custom" for="reportTrain">Select Train</label>
                        <select id="reportTrain" class="form-control-custom">
                            <option value="all">All Trains</option>
                            <option value="12002">12002 - NDLS Shatabdi</option>
                            <option value="12952">12952 - Mumbai Rajdhani</option>
                            <option value="12056">12056 - Dehradun Jan Shatabdi</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom" for="startDate">Start Date</label>
                        <input type="date" id="startDate" class="form-control-custom" required value="2026-06-01">
                    </div>
                    <div class="col-md-2">
                        <label class="form-label-custom" for="endDate">End Date</label>
                        <input type="date" id="endDate" class="form-control-custom" required value="2026-06-25">
                    </div>
                    <div class="col-md-2 d-flex align-items-end">
                        <button type="submit" class="btn-wsps btn-wsps-primary w-100"><i class="bi bi-file-earmark-bar-graph-fill"></i> Generate</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Preview Graphs -->
    <div class="row g-3">
        <div class="col-md-6">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-bar-chart-line"></i> Protection Actuations By Train</h5>
                </div>
                <div class="card-body">
                    <div style="height: 220px; position: relative;">
                        <canvas id="actuationsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-graph-down-arrow"></i> Average Wheel Condition Index</h5>
                </div>
                <div class="card-body">
                    <div style="height: 220px; position: relative;">
                        <canvas id="conditionChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Generated Report Data Preview -->
    <div class="content-card mt-1">
        <div class="card-header">
            <h5><i class="bi bi-table"></i> Report Summary Preview: <span id="reportTitleSpan">Daily Protection Summary</span></h5>
            <span class="text-muted" style="font-size: 11px;" id="reportPeriodSpan">Period: 01-Jun-2026 to 25-Jun-2026</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="reportPreviewTable">
                    <thead>
                        <tr>
                            <th>Train No</th>
                            <th>Coach No</th>
                            <th>Total Slip Events</th>
                            <th>Solenoid Exhausts</th>
                            <th>Avg Slip Speed Delta</th>
                            <th>Max Slip Duration</th>
                            <th>Critical Warnings</th>
                            <th>Sensor Faults</th>
                            <th>Protection Health Index</th>
                        </tr>
                    </thead>
                    <tbody id="reportTbody">
                        <tr>
                            <td><strong>12002 - Shatabdi</strong></td>
                            <td>CR-223456</td>
                            <td class="text-center">14</td>
                            <td class="text-center">56 pulses</td>
                            <td>12.4 km/h</td>
                            <td>880 ms</td>
                            <td class="text-center text-danger fw-bold">1</td>
                            <td class="text-center">0</td>
                            <td class="fw-bold text-success">98.5%</td>
                        </tr>
                        <tr>
                            <td><strong>12952 - Rajdhani</strong></td>
                            <td>WR-193425</td>
                            <td class="text-center">28</td>
                            <td class="text-center">112 pulses</td>
                            <td>14.1 km/h</td>
                            <td>1,240 ms</td>
                            <td class="text-center">0</td>
                            <td class="text-center text-danger fw-bold">1</td>
                            <td class="fw-bold text-warning">94.2%</td>
                        </tr>
                        <tr>
                            <td><strong>12056 - Jan Shatabdi</strong></td>
                            <td>NR-142211</td>
                            <td class="text-center">6</td>
                            <td class="text-center">24 pulses</td>
                            <td>8.5 km/h</td>
                            <td>420 ms</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="fw-bold text-success">99.8%</td>
                        </tr>
                        <tr>
                            <td><strong>12260 - Duronto Exp</strong></td>
                            <td>ER-202115</td>
                            <td class="text-center">8</td>
                            <td class="text-center">32 pulses</td>
                            <td>9.8 km/h</td>
                            <td>610 ms</td>
                            <td class="text-center">0</td>
                            <td class="text-center">0</td>
                            <td class="fw-bold text-success">99.5%</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    // 1. Actuations Chart
    const actuCtx = document.getElementById('actuationsChart').getContext('2d');
    const actuChart = new Chart(actuCtx, {
        type: 'bar',
        data: {
            labels: ['12002 Shatabdi', '12952 Rajdhani', '12056 Jan Shatabdi', '12260 Duronto'],
            datasets: [{
                label: 'Solenoid protection Cycles',
                data: [56, 112, 24, 32],
                backgroundColor: ['#0B4F8A', '#2F6DA6', '#198754', '#8c7512'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { beginAtZero: true, ticks: { font: { family: 'Inter', size: 10 } } },
                x: { ticks: { font: { family: 'Inter', size: 10 } } }
            }
        }
    });

    // 2. Wheel Condition Chart
    const condCtx = document.getElementById('conditionChart').getContext('2d');
    const condChart = new Chart(condCtx, {
        type: 'line',
        data: {
            labels: ['01-Jun', '05-Jun', '10-Jun', '15-Jun', '20-Jun', '25-Jun'],
            datasets: [{
                label: 'Avg Wear Index %',
                data: [99.5, 99.1, 98.7, 98.2, 97.9, 97.8],
                borderColor: '#198754',
                backgroundColor: 'rgba(25, 135, 84, 0.05)',
                borderWidth: 2,
                fill: true,
                tension: 0.1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: { legend: { display: false } },
            scales: {
                y: { min: 95, max: 100, ticks: { font: { family: 'Inter', size: 10 } } },
                x: { ticks: { font: { family: 'Inter', size: 10 } } }
            }
        }
    });

    // Report Generator Simulation
    function generateReport(event) {
        event.preventDefault();
        
        const type = document.getElementById('reportType').value;
        const train = document.getElementById('reportTrain').value;
        const start = document.getElementById('startDate').value;
        const end = document.getElementById('endDate').value;
        
        const titles = {
            daily: 'Daily Protection Summary',
            sensor: 'Sensor Calibration & Health Report',
            valves: 'Wheel Slide Protection Actuation Details',
            wear: 'Wheel Wear & Flat Spots Diagnostics'
        };
        
        document.getElementById('reportTitleSpan').textContent = titles[type];
        document.getElementById('reportPeriodSpan').textContent = `Period: ${start} to ${end}`;
        
        // Simulating data change in preview table
        const tbody = document.getElementById('reportTbody');
        if (type === 'sensor') {
            tbody.innerHTML = `
                <tr>
                    <td><strong>12002 - Shatabdi</strong></td>
                    <td>CR-223456</td>
                    <td class="text-center">SR-WSPS-01</td>
                    <td class="text-center">Axle-1</td>
                    <td>95.2 km/h</td>
                    <td>-38 dBm</td>
                    <td class="text-center">+0.0%</td>
                    <td class="text-center text-success">ONLINE</td>
                    <td class="fw-bold text-success">100%</td>
                </tr>
                <tr>
                    <td><strong>12952 - Rajdhani</strong></td>
                    <td>WR-193425</td>
                    <td class="text-center">SR-WSPS-24</td>
                    <td class="text-center">Axle-1</td>
                    <td>0.0 km/h</td>
                    <td>-95 dBm</td>
                    <td class="text-center">0.0%</td>
                    <td class="text-center text-danger">FAULTY</td>
                    <td class="fw-bold text-danger">25%</td>
                </tr>
            `;
            actuChart.data.datasets[0].data = [12, 28, 4, 9];
            actuChart.update();
        } else {
            // Restore default
            tbody.innerHTML = `
                <tr>
                    <td><strong>12002 - Shatabdi</strong></td>
                    <td>CR-223456</td>
                    <td class="text-center">14</td>
                    <td class="text-center">56 pulses</td>
                    <td>12.4 km/h</td>
                    <td>880 ms</td>
                    <td class="text-center text-danger fw-bold">1</td>
                    <td class="text-center">0</td>
                    <td class="fw-bold text-success">98.5%</td>
                </tr>
                <tr>
                    <td><strong>12952 - Rajdhani</strong></td>
                    <td>WR-193425</td>
                    <td class="text-center">28</td>
                    <td class="text-center">112 pulses</td>
                    <td>14.1 km/h</td>
                    <td>1,240 ms</td>
                    <td class="text-center">0</td>
                    <td class="text-center text-danger fw-bold">1</td>
                    <td class="fw-bold text-warning">94.2%</td>
                </tr>
            `;
            actuChart.data.datasets[0].data = [56, 112, 24, 32];
            actuChart.update();
        }
        
        alert('Report Generated Successfully!\nPreview updated below.');
    }
</script>

</body>
</html>
