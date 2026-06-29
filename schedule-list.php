<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Schedule - Wheel Slide Protection System (WSPS)</title>
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
            <h1>View Maintenance Work Orders</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="inspection-schedule.php">Create Schedule</a></li>
                    <li class="breadcrumb-item active" aria-current="page">View Schedule</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <a href="inspection-schedule.php" class="btn-wsps btn-wsps-primary"><i class="bi bi-calendar-plus"></i> Create Work Order</a>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('schedulesTable', 'wsps-work-orders')"><i class="bi bi-file-earmark-excel"></i> Export Work Orders</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Work Orders</span>
                <span class="stat-value">36</span>
                <span class="stat-desc">For current calendar month</span>
            </div>
            <div class="stat-icon"><i class="bi bi-list-task"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Completed Tasks</span>
                <span class="stat-value">28</span>
                <span class="stat-desc text-success"><i class="bi bi-check-circle"></i> Successfully resolved</span>
            </div>
            <div class="stat-icon"><i class="bi bi-check2-circle"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Assigned / Pending</span>
                <span class="stat-value">5</span>
                <span class="stat-desc">Awaiting execution</span>
            </div>
            <div class="stat-icon"><i class="bi bi-hourglass-split"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">In Progress</span>
                <span class="stat-value">3</span>
                <span class="stat-desc">Live on depot terminal</span>
            </div>
            <div class="stat-icon"><i class="bi bi-activity"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Maintenance Efficiency</span>
                <span class="stat-value">94.8%</span>
                <span class="stat-desc text-success">Target met</span>
            </div>
            <div class="stat-icon"><i class="bi bi-graph-up"></i></div>
        </div>
    </div>

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label-custom" for="schSearchInput">Search Schedules</label>
                    <input type="text" id="schSearchInput" class="form-control-custom" placeholder="Search by Coach, Engineer, or Work Order ID...">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="schStatusFilter">Filter by Status</label>
                    <select id="schStatusFilter" class="form-control-custom">
                        <option value="">All Statuses</option>
                        <option value="ASSIGNED">Assigned</option>
                        <option value="IN PROGRESS">In Progress</option>
                        <option value="COMPLETED">Completed</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="schTrainFilter">Filter by Train</label>
                    <select id="schTrainFilter" class="form-control-custom">
                        <option value="">All Trains</option>
                        <option value="12002">12002 - NDLS Shatabdi</option>
                        <option value="12952">12952 - Mumbai Rajdhani</option>
                        <option value="12056">12056 - Dehradun Jan Shatabdi</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Schedules Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-calendar2-range"></i> Maintenance & Calibration Work Orders List</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 5 Active Work Orders</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="schedulesTable">
                    <thead>
                        <tr>
                            <th>Work Order ID</th>
                            <th>Coach No</th>
                            <th>Assigned Train</th>
                            <th>Assigned Engineer</th>
                            <th>Scheduled Time</th>
                            <th>Test / Inspection Type</th>
                            <th>Priority</th>
                            <th>Status</th>
                            <th class="no-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr id="sch-101">
                            <td><strong>#WO-10101</strong></td>
                            <td>CR-223456</td>
                            <td>12002 - NDLS Shatabdi</td>
                            <td>Akhil Golu (SE)</td>
                            <td>28-Jun-2026 10:00 AM</td>
                            <td>Solenoid Calibration</td>
                            <td><span class="badge-custom badge-danger">EMERGENCY</span></td>
                            <td><span class="badge-custom badge-warning" id="stat-label-101">ASSIGNED</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" id="start-101" onclick="startWork('101')" title="Start"><i class="bi bi-play-fill"></i> Start</button>
                                <button class="btn-wsps btn-wsps-success btn-wsps-xs" id="complete-101" disabled onclick="completeWork('101')" title="Complete"><i class="bi bi-check-circle"></i> Complete</button>
                            </td>
                        </tr>
                        <tr id="sch-102">
                            <td><strong>#WO-10102</strong></td>
                            <td>WR-193425</td>
                            <td>12952 - Mumbai Rajdhani</td>
                            <td>Subhash Bose (SSE)</td>
                            <td>28-Jun-2026 11:30 AM</td>
                            <td>Speed Sensor Test</td>
                            <td><span class="badge-custom badge-warning">URGENT</span></td>
                            <td><span class="badge-custom badge-warning" id="stat-label-102">ASSIGNED</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" id="start-102" onclick="startWork('102')" title="Start"><i class="bi bi-play-fill"></i> Start</button>
                                <button class="btn-wsps btn-wsps-success btn-wsps-xs" id="complete-102" disabled onclick="completeWork('102')" title="Complete"><i class="bi bi-check-circle"></i> Complete</button>
                            </td>
                        </tr>
                        <tr id="sch-103">
                            <td><strong>#WO-10098</strong></td>
                            <td>NR-142211</td>
                            <td>12056 - Jan Shatabdi</td>
                            <td>Dinesh Meena (JE)</td>
                            <td>27-Jun-2026 09:30 AM</td>
                            <td>Full WSPS Diagnostic</td>
                            <td><span class="badge-custom badge-primary">NORMAL</span></td>
                            <td><span class="badge-custom badge-primary" id="stat-label-103">IN PROGRESS</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" disabled id="start-103" title="Start"><i class="bi bi-play-fill"></i> Start</button>
                                <button class="btn-wsps btn-wsps-success btn-wsps-xs" id="complete-103" onclick="completeWork('103')" title="Complete"><i class="bi bi-check-circle"></i> Complete</button>
                            </td>
                        </tr>
                        <tr id="sch-104">
                            <td><strong>#WO-10095</strong></td>
                            <td>ER-202115</td>
                            <td>12260 - Duronto Exp</td>
                            <td>Akhil Golu (SE)</td>
                            <td>26-Jun-2026 02:00 PM</td>
                            <td>Pneumatic Line Flush</td>
                            <td><span class="badge-custom badge-primary">NORMAL</span></td>
                            <td><span class="badge-custom badge-success" id="stat-label-104">COMPLETED</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" disabled title="Start"><i class="bi bi-play-fill"></i> Start</button>
                                <button class="btn-wsps btn-wsps-success btn-wsps-xs" disabled title="Complete"><i class="bi bi-check-circle"></i> Complete</button>
                            </td>
                        </tr>
                        <tr id="sch-105">
                            <td><strong>#WO-10092</strong></td>
                            <td>SR-220015</td>
                            <td>Detached / In Shop</td>
                            <td>Subhash Bose (SSE)</td>
                            <td>25-Jun-2026 04:30 PM</td>
                            <td>Solenoid Calibration</td>
                            <td><span class="badge-custom badge-primary">NORMAL</span></td>
                            <td><span class="badge-custom badge-success" id="stat-label-105">COMPLETED</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" disabled title="Start"><i class="bi bi-play-fill"></i> Start</button>
                                <button class="btn-wsps btn-wsps-success btn-wsps-xs" disabled title="Complete"><i class="bi bi-check-circle"></i> Complete</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-custom no-print">
                <span>Showing 1 to 5 of 36 work orders</span>
                <div class="pagination-buttons">
                    <a href="#" class="pagination-btn disabled"><i class="bi bi-chevron-left"></i></a>
                    <a href="#" class="pagination-btn active">1</a>
                    <a href="#" class="pagination-btn">2</a>
                    <a href="#" class="pagination-btn">3</a>
                    <a href="#" class="pagination-btn"><i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('schSearchInput', 'schedulesTable');

    // Filters
    const statusFilter = document.getElementById('schStatusFilter');
    const trainFilter = document.getElementById('schTrainFilter');

    function applyFilters() {
        const statVal = statusFilter.value.toLowerCase();
        const trainVal = trainFilter.value.toLowerCase();
        const rows = document.querySelectorAll('#schedulesTable tbody tr');

        rows.forEach(row => {
            const statCell = row.cells[7].textContent.toLowerCase();
            const trainCell = row.cells[2].textContent.toLowerCase();

            const matchesStat = statVal === "" || statCell.indexOf(statVal) > -1;
            const matchesTrain = trainVal === "" || trainCell.indexOf(trainVal) > -1;

            row.style.display = (matchesStat && matchesTrain) ? "" : "none";
        });
    }

    statusFilter.addEventListener('change', applyFilters);
    trainFilter.addEventListener('change', applyFilters);

    function resetFilters() {
        statusFilter.value = "";
        trainFilter.value = "";
        document.getElementById('schSearchInput').value = "";
        applyFilters();
        document.querySelectorAll('#schedulesTable tbody tr').forEach(r => r.style.display = "");
    }

    // Status management
    function startWork(id) {
        const label = document.getElementById(`stat-label-${id}`);
        const startBtn = document.getElementById(`start-${id}`);
        const compBtn = document.getElementById(`complete-${id}`);
        
        if (label) {
            label.textContent = "IN PROGRESS";
            label.className = "badge-custom badge-primary";
            startBtn.disabled = true;
            compBtn.disabled = false;
            alert(`Work order #WO-10${id} marked as In Progress.`);
        }
    }

    function completeWork(id) {
        const label = document.getElementById(`stat-label-${id}`);
        const startBtn = document.getElementById(`start-${id}`);
        const compBtn = document.getElementById(`complete-${id}`);
        
        if (label) {
            label.textContent = "COMPLETED";
            label.className = "badge-custom badge-success";
            startBtn.disabled = true;
            compBtn.disabled = true;
            alert(`Work order #WO-10${id} successfully completed and saved.`);
        }
    }
</script>

</body>
</html>
