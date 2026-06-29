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
    <!-- <div class="stats-grid">
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
    </div> -->

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
                            <option value="21010">21010 - Delhi Express</option>
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



    <!-- Generated Report Data Preview -->
    <div class="content-card mt-3">
        <!-- Gold Attention Paid Header Banner -->
        <div class="text-center py-2 fw-bold text-dark mb-1" style="background-color: #FFC107; font-size: 15px; letter-spacing: 0.5px; border-radius: 4px; border: 1px solid #e0a800; font-family: 'Inter', sans-serif;">
            WSPS COMPONENT DIAGNOSTIC & RESOLUTION REPORT @ DEPOT
        </div>
        <div class="d-flex justify-content-between align-items-center px-3 py-1 bg-light border border-bottom-0 text-muted" style="font-size: 11px; font-weight: 500; font-family: 'Inter', sans-serif; border-radius: 4px 4px 0 0;">
            <div id="recordCountSpan"><i class="bi bi-list-ol"></i> 4 records</div>
            <div id="reportPeriodSpan">01.06.2026 - 29.06.2026</div>
        </div>
        <div class="card-body p-0 border" style="border-radius: 0 0 4px 4px;">
            <div class="table-responsive-custom">
                <table class="table-custom report-format-table" id="reportPreviewTable" style="font-size: 11px; margin-bottom: 0;">
                    <thead style="background-color: #f8f9fa;">
                        <tr>
                            <th style="width: 40px; text-align: center;">SL.</th>
                            <th style="width: 80px; text-align: center;">Date</th>
                            <th style="width: 100px;">Train No.</th>
                            <th style="width: 130px;">Type & Coach No.</th>
                            <th style="width: 120px;">OEM Make</th>
                            <th>Inventory Issue / Fault & Error Code</th>
                            <th>Actually Issue</th>
                            <th>Action Taken</th>
                            <th style="width: 100px; text-align: center;">Status</th>
                            <th style="width: 130px;">Auditor</th>
                        </tr>
                    </thead>
                    <tbody id="reportTbody">
                        <tr>
                            <td class="text-center fw-bold">1</td>
                            <td class="text-center">23.06.2026</td>
                            <td><strong>12002</strong><br><small class="text-muted" style="font-size:9px;">SHATABDI EXP</small></td>
                            <td>TYPE <strong>LHB AC 3T</strong><br><small class="text-muted">COACH </small><strong>CR-223456</strong></td>
                            <td>Faiveley Transport</td>
                            <td>
                                <strong>Main Board MB04B-A1 Defect</strong><br>
                                <span class="text-muted">Internal board error</span><br>
                                <span class="badge bg-danger text-white" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 0101</span>
                            </td>
                            <td>Verify board seating, clean input contacts, or replace Main Board MB04B-A1</td>
                            <td>Replaced Main Board MB04B-A1 with spare from inventory depot</td>
                            <td class="text-center"><span class="badge bg-success text-white" style="font-size: 9px; padding: 4px 6px; background-color: #198754 !important;">RESOLVED</span></td>
                            <td>
                                <div style="font-size: 10px; line-height: 1.3;">
                                    <strong>akhil golu</strong><br>
                                    <span class="text-muted">SCH</span> <strong>#WO-10101</strong><br>
                                    <span class="text-muted">20.06.2026</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">2</td>
                            <td class="text-center">15.06.2026</td>
                            <td><strong>12952</strong><br><small class="text-muted" style="font-size:9px;">RAJDHANI EXP</small></td>
                            <td>TYPE <strong>LHB AC 2T</strong><br><small class="text-muted">COACH </small><strong>WR-193425</strong></td>
                            <td>Knorr-Bremse</td>
                            <td>
                                <strong>Solenoid dump valve timeout</strong><br>
                                <span class="text-muted">Axle 1 response failure</span><br>
                                <span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 1001</span>
                            </td>
                            <td>Start pneumatic self-test, verify track adhesion coefficient, clean dump valve assembly</td>
                            <td>Executed pneumatic self-test, cleared dump valve nozzle blockage</td>
                            <td class="text-center"><span class="badge bg-success text-white" style="font-size: 9px; padding: 4px 6px; background-color: #198754 !important;">RESOLVED</span></td>
                            <td>
                                <div style="font-size: 10px; line-height: 1.3;">
                                    <strong>akhil golu</strong><br>
                                    <span class="text-muted">SCH</span> <strong>#WO-10102</strong><br>
                                    <span class="text-muted">13.06.2026</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">3</td>
                            <td class="text-center">15.06.2026</td>
                            <td><strong>12056</strong><br><small class="text-muted" style="font-size:9px;">JAN SHATABDI</small></td>
                            <td>TYPE <strong>LHB GEN</strong><br><small class="text-muted">COACH </small><strong>NR-142211</strong></td>
                            <td>Medha Servo</td>
                            <td>
                                <strong>Extension Board EB01A-A2 Fault</strong><br>
                                <span class="text-muted">Internal board error</span><br>
                                <span class="badge bg-danger text-white" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 0202</span>
                            </td>
                            <td>Check standby power lines, inspect EB01A-A2 card components, change board if necessary</td>
                            <td>Awaiting spare Extension Board EB01A-A2 from division depot</td>
                            <td class="text-center"><span class="badge bg-warning text-dark" style="font-size: 9px; padding: 4px 6px; background-color: #ffc107 !important;">PENDING</span></td>
                            <td>
                                <div style="font-size: 10px; line-height: 1.3;">
                                    <strong>akhil golu</strong><br>
                                    <span class="text-muted">SCH</span> <strong>#WO-10103</strong><br>
                                    <span class="text-muted">13.06.2026</span>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td class="text-center fw-bold">4</td>
                            <td class="text-center">14.06.2026</td>
                            <td><strong>12260</strong><br><small class="text-muted" style="font-size:9px;">DURONTO EXP</small></td>
                            <td>TYPE <strong>LHB AC 3T</strong><br><small class="text-muted">COACH </small><strong>ER-202115</strong></td>
                            <td>Escorts Ltd</td>
                            <td>
                                <strong>Speed Sensor Open/Short circuit</strong><br>
                                <span class="text-muted">Axle 1 signal drop detection</span><br>
                                <span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 1101</span>
                            </td>
                            <td>Check sensor plug connection, measure coil resistance (800-1200 ohms), replace speed sensor</td>
                            <td>Cleaned speed sensor connector contacts and refastened plug</td>
                            <td class="text-center"><span class="badge bg-success text-white" style="font-size: 9px; padding: 4px 6px; background-color: #198754 !important;">RESOLVED</span></td>
                            <td>
                                <div style="font-size: 10px; line-height: 1.3;">
                                    <strong>akhil golu</strong><br>
                                    <span class="text-muted">SCH</span> <strong>#WO-10104</strong><br>
                                    <span class="text-muted">13.06.2026</span>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>


    // Report Generator Simulation
    const allReportRows = [
        {
            sl: 1,
            date: '23.06.2026',
            trainId: '12002',
            trainNo: '12002',
            trainName: 'SHATABDI EXP',
            coachType: 'LHB AC 3T',
            coachNo: 'CR-223456',
            make: 'Faiveley Transport',
            issue: '<strong>Main Board MB04B-A1 Defect</strong><br><span class="text-muted">Internal board error</span><br><span class="badge bg-danger" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 0101</span>',
            rec: 'Verify board seating, clean input contacts, or replace Main Board MB04B-A1',
            done: 'Replaced Main Board MB04B-A1 with spare from inventory depot',
            status: '<span class="badge bg-success text-white" style="font-size: 9px; padding: 4px 6px; background-color: #198754 !important;">RESOLVED</span>',
            auditorName: 'akhil golu',
            auditorSch: '#WO-10101',
            auditorDate: '20.06.2026'
        },
        {
            sl: 2,
            date: '15.06.2026',
            trainId: '12952',
            trainNo: '12952',
            trainName: 'RAJDHANI EXP',
            coachType: 'LHB AC 2T',
            coachNo: 'WR-193425',
            make: 'Knorr-Bremse',
            issue: '<strong>Solenoid dump valve timeout</strong><br><span class="text-muted">Axle 1 response failure</span><br><span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 1001</span>',
            rec: 'Start pneumatic self-test, verify track adhesion coefficient, clean dump valve assembly',
            done: 'Executed pneumatic self-test, cleared dump valve nozzle blockage',
            status: '<span class="badge bg-success text-white" style="font-size: 9px; padding: 4px 6px; background-color: #198754 !important;">RESOLVED</span>',
            auditorName: 'akhil golu',
            auditorSch: '#WO-10102',
            auditorDate: '13.06.2026'
        },
        {
            sl: 3,
            date: '15.06.2026',
            trainId: '12056',
            trainNo: '12056',
            trainName: 'JAN SHATABDI',
            coachType: 'LHB GEN',
            coachNo: 'NR-142211',
            make: 'Medha Servo',
            issue: '<strong>Extension Board EB01A-A2 Fault</strong><br><span class="text-muted">Internal board error</span><br><span class="badge bg-danger" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 0202</span>',
            rec: 'Check standby power lines, inspect EB01A-A2 card components, change board if necessary',
            done: 'Awaiting spare Extension Board EB01A-A2 from division depot',
            status: '<span class="badge bg-warning text-dark" style="font-size: 9px; padding: 4px 6px; background-color: #ffc107 !important;">PENDING</span>',
            auditorName: 'akhil golu',
            auditorSch: '#WO-10103',
            auditorDate: '13.06.2026'
        },
        {
            sl: 4,
            date: '14.06.2026',
            trainId: '12260',
            trainNo: '12260',
            trainName: 'DURONTO EXP',
            coachType: 'LHB AC 3T',
            coachNo: 'ER-202115',
            make: 'Escorts Ltd',
            issue: '<strong>Speed Sensor Open/Short circuit</strong><br><span class="text-muted">Axle 1 signal drop detection</span><br><span class="badge bg-warning text-dark" style="font-size: 9px; padding: 2px 4px; font-family: monospace;">ERROR: 1101</span>',
            rec: 'Check sensor plug connection, measure coil resistance (800-1200 ohms), replace speed sensor',
            done: 'Cleaned speed sensor connector contacts and refastened plug',
            status: '<span class="badge bg-success text-white" style="font-size: 9px; padding: 4px 6px; background-color: #198754 !important;">RESOLVED</span>',
            auditorName: 'akhil golu',
            auditorSch: '#WO-10104',
            auditorDate: '13.06.2026'
        }
    ];

    function generateReport(event) {
        event.preventDefault();
        
        const type = document.getElementById('reportType').value;
        const train = document.getElementById('reportTrain').value;
        const start = document.getElementById('startDate').value;
        const end = document.getElementById('endDate').value;
        
        document.getElementById('reportPeriodSpan').textContent = `${start.split('-').reverse().join('.')} - ${end.split('-').reverse().join('.')}`;
        
        let filteredRows = allReportRows;
        if (train !== 'all') {
            filteredRows = allReportRows.filter(row => row.trainId === train);
        }
        
        document.getElementById('recordCountSpan').innerHTML = `<i class="bi bi-list-ol"></i> ${filteredRows.length} records`;
        
        const tbody = document.getElementById('reportTbody');
        if (filteredRows.length === 0) {
            tbody.innerHTML = `
                <tr>
                    <td colspan="10" class="text-center text-muted py-4">No records found matching the criteria.</td>
                </tr>
            `;
        } else {
            tbody.innerHTML = filteredRows.map((row, index) => `
                <tr>
                    <td class="text-center fw-bold">${index + 1}</td>
                    <td class="text-center">${row.date}</td>
                    <td><strong>${row.trainNo}</strong><br><small class="text-muted" style="font-size:9px;">${row.trainName}</small></td>
                    <td>TYPE <strong>${row.coachType}</strong><br><small class="text-muted">COACH </small><strong>${row.coachNo}</strong></td>
                    <td>${row.make}</td>
                    <td>${row.issue}</td>
                    <td>${row.rec}</td>
                    <td>${row.done}</td>
                    <td class="text-center">${row.status}</td>
                    <td>
                        <div style="font-size: 10px; line-height: 1.3;">
                            <strong>${row.auditorName}</strong><br>
                            <span class="text-muted">SCH</span> <strong>${row.auditorSch}</strong><br>
                            <span class="text-muted">${row.auditorDate}</span>
                        </div>
                    </td>
                </tr>
            `).join('');
        }
        

        
        alert('Report Generated Successfully!\nPreview updated below.');
    }
</script>

</body>
</html>
