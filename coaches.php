<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Coach Management - Wheel Slide Protection System (WSPS)</title>
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
            <h1>Coach Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Coach Management</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-primary" data-bs-toggle="modal" data-bs-target="#coachModal"><i class="bi bi-plus-circle"></i> Add New Coach</button>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('coachesTable', 'wsps-coaches-list')"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Coaches</span>
                <span class="stat-value">544</span>
                <span class="stat-desc">Monitored by WSPS Nodes</span>
            </div>
            <div class="stat-icon"><i class="bi bi-box-seam"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Wheel Condition Index</span>
                <span class="stat-value">97.8%</span>
                <span class="stat-desc text-success"><i class="bi bi-check-circle"></i> 2,176 Wheels Monitored</span>
            </div>
            <div class="stat-icon"><i class="bi bi-disc"></i></div>
        </div>
        <div class="stat-card danger">
            <div class="stat-info">
                <span class="stat-label">Critical Wear / Flat Spot</span>
                <span class="stat-value">3</span>
                <span class="stat-desc text-danger"><i class="bi bi-exclamation-circle"></i> Requires immediate turning</span>
            </div>
            <div class="stat-icon"><i class="bi bi-exclamation-triangle"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Sensor Recalibrations</span>
                <span class="stat-value">14</span>
                <span class="stat-desc">Due for inspection this week</span>
            </div>
            <div class="stat-icon"><i class="bi bi-arrow-repeat"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Protection Valves OK</span>
                <span class="stat-value">2,170 / 2,176</span>
                <span class="stat-desc">Dump Valving active</span>
            </div>
            <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
        </div>
    </div>

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label-custom" for="coachSearchInput">Search Coach No.</label>
                    <input type="text" id="coachSearchInput" class="form-control-custom" placeholder="Type Coach No. (e.g., CR-223456)...">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="trainAssignFilter">Filter by Train Assignment</label>
                    <select id="trainAssignFilter" class="form-control-custom">
                        <option value="">All Trains</option>
                        <option value="12002">12002 - NDLS Bhopal Shatabdi</option>
                        <option value="12952">12952 - Mumbai Rajdhani Exp</option>
                        <option value="12056">12056 - Dehradun Jan Shatabdi</option>
                        <option value="12260">12260 - Sealdah Duronto Exp</option>
                        <option value="DETACHED">Detached / In Shop</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="typeFilter">Filter by Coach Type</label>
                    <select id="typeFilter" class="form-control-custom">
                        <option value="">All Types</option>
                        <option value="LHB-AC-2T">LHB AC 2 Tier (LWACCW)</option>
                        <option value="LHB-AC-3T">LHB AC 3 Tier (LWACCN)</option>
                        <option value="LHB-POWER">LHB Generator Car (LWRRM)</option>
                        <option value="ICF-GEN">ICF General Second Class (WGSCN)</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Coaches Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-box-seam"></i> Coach Registry & Protection Systems</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 5 Active Coaches</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="coachesTable">
                    <thead>
                        <tr>
                            <th>Coach No</th>
                            <th>Coach Type</th>
                            <th>Assigned Train</th>
                            <th>Axles</th>
                            <th>Wheel Condition Index</th>
                            <th>Dump Valves</th>
                            <th>Next Inspection</th>
                            <th>Status</th>
                            <th class="no-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>CR-223456</strong></td>
                            <td>LHB AC 3 Tier (LWACCN)</td>
                            <td>12002 - NDLS Bhopal Shatabdi</td>
                            <td class="text-center fw-bold">4 Axles</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 98%;"></div>
                                    </div>
                                    <span class="fw-bold text-success">98%</span>
                                </div>
                            </td>
                            <td><span class="badge-custom badge-success"><i class="bi bi-shield-check"></i> 4/4 OK</span></td>
                            <td>12-Jul-2026</td>
                            <td><span class="badge-custom badge-success">Active</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="openDiagnostic('CR-223456', '12002', 'LHB AC 3 Tier', 'Normal')" title="Visual Axle Grid"><i class="bi bi-cpu-fill"></i> Visual Diagnostics</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editCoach('CR-223456', 'LHB-AC-3T', '12002', '12-Jul-2026', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>WR-193425</strong></td>
                            <td>LHB AC 2 Tier (LWACCW)</td>
                            <td>12952 - Mumbai Rajdhani Exp</td>
                            <td class="text-center fw-bold">4 Axles</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px;">
                                        <div class="progress-bar bg-warning" style="width: 76%;"></div>
                                    </div>
                                    <span class="fw-bold text-warning">76%</span>
                                </div>
                            </td>
                            <td><span class="badge-custom badge-warning"><i class="bi bi-exclamation-triangle"></i> 3/4 OK (1 Active Slip)</span></td>
                            <td>08-Jul-2026</td>
                            <td><span class="badge-custom badge-success">Active</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="openDiagnostic('WR-193425', '12952', 'LHB AC 2 Tier', 'Warning')" title="Visual Axle Grid"><i class="bi bi-cpu-fill"></i> Visual Diagnostics</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editCoach('WR-193425', 'LHB-AC-2T', '12952', '08-Jul-2026', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>NR-142211</strong></td>
                            <td>LHB General Class (LWS)</td>
                            <td>12056 - Dehradun Jan Shatabdi</td>
                            <td class="text-center fw-bold">4 Axles</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 95%;"></div>
                                    </div>
                                    <span class="fw-bold text-success">95%</span>
                                </div>
                            </td>
                            <td><span class="badge-custom badge-success"><i class="bi bi-shield-check"></i> 4/4 OK</span></td>
                            <td>15-Jul-2026</td>
                            <td><span class="badge-custom badge-success">Active</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="openDiagnostic('NR-142211', '12056', 'LHB General Class', 'Normal')" title="Visual Axle Grid"><i class="bi bi-cpu-fill"></i> Visual Diagnostics</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editCoach('NR-142211', 'LHB-GEN', '12056', '15-Jul-2026', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>ER-202115</strong></td>
                            <td>LHB AC 3 Tier (LWACCN)</td>
                            <td>12260 - Sealdah Duronto Exp</td>
                            <td class="text-center fw-bold">4 Axles</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px;">
                                        <div class="progress-bar bg-success" style="width: 99%;"></div>
                                    </div>
                                    <span class="fw-bold text-success">99%</span>
                                </div>
                            </td>
                            <td><span class="badge-custom badge-success"><i class="bi bi-shield-check"></i> 4/4 OK</span></td>
                            <td>20-Jul-2026</td>
                            <td><span class="badge-custom badge-success">Active</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="openDiagnostic('ER-202115', '12260', 'LHB AC 3 Tier', 'Normal')" title="Visual Axle Grid"><i class="bi bi-cpu-fill"></i> Visual Diagnostics</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editCoach('ER-202115', 'LHB-AC-3T', '12260', '20-Jul-2026', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>SR-220015</strong></td>
                            <td>LHB Generator Car (LWRRM)</td>
                            <td><span class="text-muted">DETACHED</span></td>
                            <td class="text-center fw-bold">4 Axles</td>
                            <td>
                                <div class="d-flex align-items-center gap-2">
                                    <div class="progress w-100" style="height: 6px;">
                                        <div class="progress-bar bg-danger" style="width: 48%;"></div>
                                    </div>
                                    <span class="fw-bold text-danger">48%</span>
                                </div>
                            </td>
                            <td><span class="badge-custom badge-danger"><i class="bi bi-x-circle"></i> 0/4 Offline (Critical Wear)</span></td>
                            <td>28-Jun-2026</td>
                            <td><span class="badge-custom badge-danger">In Shop</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="openDiagnostic('SR-220015', 'DETACHED', 'LHB Generator Car', 'Critical')" title="Visual Axle Grid"><i class="bi bi-cpu-fill"></i> Visual Diagnostics</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editCoach('SR-220015', 'LHB-POWER', '', '28-Jun-2026', 'In Shop')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-custom no-print">
                <span>Showing 1 to 5 of 544 coaches</span>
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

<!-- Coach Modals: Add / Edit -->
<div class="modal fade" id="coachModal" tabindex="-1" aria-labelledby="coachModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="coachModalLabel"><i class="bi bi-box-seam-fill text-primary"></i> Register New Coach</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="coachForm" onsubmit="handleCoachSubmit(event)">
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalCoachNo">Coach Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalCoachNo" required placeholder="e.g., CR-223456">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalCoachType">Coach Type <span class="text-danger">*</span></label>
                        <select id="modalCoachType" class="form-control-custom" required>
                            <option value="LHB-AC-2T">LHB AC 2 Tier (LWACCW)</option>
                            <option value="LHB-AC-3T">LHB AC 3 Tier (LWACCN)</option>
                            <option value="LHB-POWER">LHB Generator Car (LWRRM)</option>
                            <option value="ICF-GEN">ICF General Second Class (WGSCN)</option>
                        </select>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalTrainAssign">Assign to Train</label>
                        <select id="modalTrainAssign" class="form-control-custom">
                            <option value="">Detached / In Shop</option>
                            <option value="12002">12002 - NDLS Shatabdi</option>
                            <option value="12952">12952 - Mumbai Rajdhani</option>
                            <option value="12056">12056 - Dehradun Jan Shatabdi</option>
                            <option value="12260">12260 - Sealdah Duronto</option>
                        </select>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalInspectionDate">Next Inspection Date <span class="text-danger">*</span></label>
                        <input type="date" class="form-control-custom" id="modalInspectionDate" required>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalCoachStatus">Status</label>
                        <select id="modalCoachStatus" class="form-control-custom">
                            <option value="Active">Active</option>
                            <option value="In Shop">In Shop</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary" id="coachSubmitBtn">Register Coach</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Dynamic Diagnostic Modal (Visual Axle Protection Grid) -->
<div class="modal fade" id="diagnosticModal" tabindex="-1" aria-labelledby="diagnosticModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="diagnosticModalLabel"><i class="bi bi-cpu-fill text-primary"></i> WSPS Visual Diagnostics: <span id="diagCoachNo">CR-223456</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="alert alert-info py-2 d-flex justify-content-between align-items-center" style="font-size: 11.5px;">
                    <div><strong>Train Assignment:</strong> <span id="diagTrain">12002 - Shatabdi</span> | <strong>Chassis Type:</strong> LHB Fiat Bogie</div>
                    <span class="badge-custom badge-success" id="diagStatusBadge">Normal</span>
                </div>

                <!-- Interactive Visual Axles (4 Axles per Coach) -->
                <div class="row g-2">
                    <div class="col-md-6">
                        <div class="card bg-light border-0">
                            <div class="card-body p-2">
                                <h6 class="fw-bold mb-2 text-primary" style="font-size: 12px;">Bogie 1 (Axle 1 & 2)</h6>
                                
                                <!-- Axle 1 -->
                                <span class="form-label-custom" style="font-size: 9px;">Axle #1 (Sensor ID: SR-WSPS-01)</span>
                                <div class="axle-layout mb-2" id="axle1Node">
                                    <div class="axle-shaft"></div>
                                    <div class="wheel-node wheel-left" title="Wheel Left 1">W1</div>
                                    <div class="wheel-node wheel-right" title="Wheel Right 2">W2</div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 10px; margin-top:-5px;">
                                    <span>L: <strong class="text-dark" id="w1_speed">95 km/h</strong></span>
                                    <span>Dump: <strong class="text-success">Clear</strong></span>
                                    <span>R: <strong class="text-dark" id="w2_speed">95 km/h</strong></span>
                                </div>
                                <hr class="my-2">
                                
                                <!-- Axle 2 -->
                                <span class="form-label-custom" style="font-size: 9px;">Axle #2 (Sensor ID: SR-WSPS-02)</span>
                                <div class="axle-layout" id="axle2Node">
                                    <div class="axle-shaft"></div>
                                    <div class="wheel-node wheel-left" title="Wheel Left 3">W3</div>
                                    <div class="wheel-node wheel-right" title="Wheel Right 4">W4</div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 10px; margin-top:-5px;">
                                    <span>L: <strong class="text-dark" id="w3_speed">95 km/h</strong></span>
                                    <span>Dump: <strong class="text-success">Clear</strong></span>
                                    <span>R: <strong class="text-dark" id="w4_speed">95 km/h</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card bg-light border-0">
                            <div class="card-body p-2">
                                <h6 class="fw-bold mb-2 text-primary" style="font-size: 12px;">Bogie 2 (Axle 3 & 4)</h6>
                                
                                <!-- Axle 3 -->
                                <span class="form-label-custom" style="font-size: 9px;">Axle #3 (Sensor ID: SR-WSPS-03)</span>
                                <div class="axle-layout mb-2" id="axle3Node">
                                    <div class="axle-shaft"></div>
                                    <div class="wheel-node wheel-left" title="Wheel Left 5">W5</div>
                                    <div class="wheel-node wheel-right" title="Wheel Right 6">W6</div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 10px; margin-top:-5px;">
                                    <span>L: <strong class="text-dark" id="w5_speed">95 km/h</strong></span>
                                    <span>Dump: <strong class="text-success">Clear</strong></span>
                                    <span>R: <strong class="text-dark" id="w6_speed">95 km/h</strong></span>
                                </div>
                                <hr class="my-2">
                                
                                <!-- Axle 4 -->
                                <span class="form-label-custom" style="font-size: 9px;">Axle #4 (Sensor ID: SR-WSPS-04)</span>
                                <div class="axle-layout" id="axle4Node">
                                    <div class="axle-shaft"></div>
                                    <div class="wheel-node wheel-left" title="Wheel Left 7">W7</div>
                                    <div class="wheel-node wheel-right" title="Wheel Right 8">W8</div>
                                </div>
                                <div class="d-flex justify-content-between text-muted" style="font-size: 10px; margin-top:-5px;">
                                    <span>L: <strong class="text-dark" id="w7_speed">95 km/h</strong></span>
                                    <span>Dump: <strong class="text-success">Clear</strong></span>
                                    <span>R: <strong class="text-dark" id="w8_speed">95 km/h</strong></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Simulation Trigger -->
                <div class="mt-3 text-center border-top pt-3">
                    <button class="btn-wsps btn-wsps-success" onclick="triggerTest()"><i class="bi bi-lightning-fill"></i> Trigger Dump Valve Protection Pulse Test</button>
                    <div class="text-muted mt-1" style="font-size: 10px;">Sends 5.0 bar pneumatic pulse to dump slide valves to verify solenoid action</div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('coachSearchInput', 'coachesTable');

    // Filter logic
    const trainFilter = document.getElementById('trainAssignFilter');
    const typeFilter = document.getElementById('typeFilter');

    function applyCoachesFilters() {
        const trainVal = trainFilter.value.toLowerCase();
        const typeVal = typeFilter.value.toLowerCase();
        const rows = document.querySelectorAll('#coachesTable tbody tr');

        rows.forEach(row => {
            const trainCell = row.cells[2].textContent.toLowerCase();
            const typeCell = row.cells[1].textContent.toLowerCase();

            const matchesTrain = trainVal === "" || trainCell.indexOf(trainVal) > -1;
            const matchesType = typeVal === "" || typeCell.indexOf(typeVal) > -1;

            row.style.display = (matchesTrain && matchesType) ? "" : "none";
        });
    }

    trainFilter.addEventListener('change', applyCoachesFilters);
    typeFilter.addEventListener('change', applyCoachesFilters);

    function resetFilters() {
        trainFilter.value = "";
        typeFilter.value = "";
        document.getElementById('coachSearchInput').value = "";
        applyCoachesFilters();
        document.querySelectorAll('#coachesTable tbody tr').forEach(r => r.style.display = "");
    }

    // Modal Operations
    function editCoach(no, type, train, date, status) {
        document.getElementById('coachModalLabel').innerHTML = `<i class="bi bi-pencil-fill text-primary"></i> Edit Registered Coach`;
        document.getElementById('modalCoachNo').value = no;
        document.getElementById('modalCoachNo').disabled = true;
        document.getElementById('modalCoachType').value = type;
        document.getElementById('modalTrainAssign').value = train;
        document.getElementById('modalInspectionDate').value = date;
        document.getElementById('modalCoachStatus').value = status;
        document.getElementById('coachSubmitBtn').textContent = "Update Coach";
        
        new bootstrap.Modal(document.getElementById('coachModal')).show();
    }

    function handleCoachSubmit(event) {
        event.preventDefault();
        alert('Coach registration successfully saved!');
        bootstrap.Modal.getInstance(document.getElementById('coachModal')).hide();
    }

    // Interactive Axle Diagnostic Modal
    function openDiagnostic(coachNo, trainNo, type, state) {
        document.getElementById('diagCoachNo').textContent = coachNo;
        document.getElementById('diagTrain').textContent = trainNo === 'DETACHED' ? 'Detached / Workshop' : `Train #${trainNo}`;
        
        const badge = document.getElementById('diagStatusBadge');
        badge.textContent = state;

        // Reset elements
        const a1 = document.getElementById('axle1Node');
        const a2 = document.getElementById('axle2Node');
        const a3 = document.getElementById('axle3Node');
        const a4 = document.getElementById('axle4Node');
        
        a1.className = "axle-layout mb-2";
        a2.className = "axle-layout mb-2";
        a3.className = "axle-layout mb-2";
        a4.className = "axle-layout";

        // Reset Speed Text
        const speedIds = ['w1_speed', 'w2_speed', 'w3_speed', 'w4_speed', 'w5_speed', 'w6_speed', 'w7_speed', 'w8_speed'];
        speedIds.forEach(id => document.getElementById(id).innerHTML = "95 km/h");

        if (state === 'Normal') {
            badge.className = "badge-custom badge-success";
        } else if (state === 'Warning') {
            badge.className = "badge-custom badge-warning";
            a2.className = "axle-layout warning-active mb-2";
            document.getElementById('w3_speed').innerHTML = `<span class="text-warning"><i class="bi bi-exclamation-triangle"></i> 84 km/h</span>`;
            document.getElementById('w4_speed').innerHTML = `95 km/h`;
        } else if (state === 'Critical' || state === 'In Shop') {
            badge.className = "badge-custom badge-danger";
            a1.className = "axle-layout slide-active mb-2";
            document.getElementById('w1_speed').innerHTML = `<span class="text-danger"><i class="bi bi-shield-slash"></i> 25 km/h (SLIDE!)</span>`;
            document.getElementById('w2_speed').innerHTML = `95 km/h`;
        }

        new bootstrap.Modal(document.getElementById('diagnosticModal')).show();
    }

    function triggerTest() {
        alert('Protection Solenoid Diagnostic Triggered!\nSensing micro-currents... Solenoids Actuated.\nResult: 4/4 Solenoids Functional. Dump Valves Cleared.');
    }
</script>

</body>
</html>
