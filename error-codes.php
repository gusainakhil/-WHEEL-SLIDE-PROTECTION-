<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Error Code Registry - Wheel Slide Protection System (WSPS)</title>
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
            <h1>MMI Error Code & Diagnostic Registry</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Error Codes</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-primary" id="addErrorBtn" data-bs-toggle="modal" data-bs-target="#errorModal"><i class="bi bi-plus-circle"></i> Add Error Code</button>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('errorTable', 'wsps-mmi-errors')"><i class="bi bi-file-earmark-excel"></i> Export Registry</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Error Codes</span>
                <span class="stat-value">42 Codes</span>
                <span class="stat-desc">Registered in WSPS firmware</span>
            </div>
            <div class="stat-icon"><i class="bi bi-bug"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Board / Hardware Events</span>
                <span class="stat-value">18 Events</span>
                <span class="stat-desc text-success">MB04B & EB01A diagnostics</span>
            </div>
            <div class="stat-icon"><i class="bi bi-cpu-fill"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Dump Valve Events</span>
                <span class="stat-value">12 Events</span>
                <span class="stat-desc text-success">Pneumatic valve timeouts</span>
            </div>
            <div class="stat-icon"><i class="bi bi-wind"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Speed Sensor Events</span>
                <span class="stat-value">12 Events</span>
                <span class="stat-desc text-success">Open/Short circuit detection</span>
            </div>
            <div class="stat-icon"><i class="bi bi-broadcast-pin"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">MMI Sync Status</span>
                <span class="stat-value">Synchronized</span>
                <span class="stat-desc text-success">Last: 29-Jun 12:00 PM</span>
            </div>
            <div class="stat-icon"><i class="bi bi-arrow-repeat"></i></div>
        </div>
    </div>

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label-custom" for="errSearchInput">Search Error Codes</label>
                    <input type="text" id="errSearchInput" class="form-control-custom" placeholder="Search by MMI code, Event name, Cause, or Instruction...">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom" for="errAxleFilter">Filter by Affected Axle</label>
                    <select id="errAxleFilter" class="form-control-custom">
                        <option value="">All Axles</option>
                        <option value="Axles 1 - 4">Axles 1 - 4</option>
                        <option value="Axle 1">Axle 1</option>
                        <option value="Axle 2">Axle 2</option>
                        <option value="Axle 3">Axle 3</option>
                        <option value="Axle 4">Axle 4</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Error Code Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-bug-fill"></i> Man-Machine Interface (MMI) Error Code Registry</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 4 Core WSPS Diagnostics</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="errorTable">
                    <thead>
                        <tr>
                            <th style="width: 120px;">Display Code on MMI</th>
                            <th style="width: 250px;">Event Name</th>
                            <th style="width: 120px;">Affected Axle</th>
                            <th>Cause of Event</th>
                            <th>Instruction to Railway</th>
                            <th class="no-export" style="width: 100px;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><span class="badge-custom badge-danger fs-6 fw-bold font-monospace" style="letter-spacing: 0.5px;">0101</span></td>
                            <td><strong>Internal board error on Main Board MB04B</strong></td>
                            <td class="text-center font-monospace">Axles 1 - 4</td>
                            <td>
                                <ul class="mb-0 ps-3" style="font-size: 11px;">
                                    <li>7401</li>
                                    <li>S301</li>
                                    <li>main Board MB04B-A1 defect</li>
                                </ul>
                            </td>
                            <td><span class="text-primary fw-bold">change Main Board MB04B-A1</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editError('0101', 'Internal board error on Main Board MB04B', 'Axles 1 - 4', '• 7401\n• S301\n• main Board MB04B-A1 defect', 'change Main Board MB04B-A1')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('0101')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge-custom badge-danger fs-6 fw-bold font-monospace" style="letter-spacing: 0.5px;">0202</span></td>
                            <td><strong>Internal board error on Extension Board EB01A</strong></td>
                            <td class="text-center font-monospace">Axles 1 - 4</td>
                            <td>
                                <ul class="mb-0 ps-3" style="font-size: 11px;">
                                    <li>Extension Board EB01A-A2 defect</li>
                                </ul>
                            </td>
                            <td>
                                <ul class="mb-0 ps-3" style="font-size: 11px; font-weight: 500;">
                                    <li>check the single messages</li>
                                    <li>change Extension Board EB01A-A2</li>
                                    <li>check if the WSP can be powered on after standby</li>
                                </ul>
                            </td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editError('0202', 'Internal board error on Extension Board EB01A', 'Axles 1 - 4', '• Extension Board EB01A-A2 defect', '• check the single messages\n• change Extension Board EB01A-A2\n• check if the WSP can be powered on after standby')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('0202')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge-custom badge-warning fs-6 fw-bold font-monospace" style="letter-spacing: 0.5px; color:#000;">1001</span></td>
                            <td><strong>Time-out at dump valve of axle 1</strong></td>
                            <td class="text-center font-monospace">Axle 1</td>
                            <td>
                                <ul class="mb-0 ps-3" style="font-size: 11px;">
                                    <li>extremely low adhesion coefficient between track and wheels causing dump valve to pull out of operation</li>
                                    <li>Main Board MB04B-A1 defect</li>
                                </ul>
                            </td>
                            <td>delete message by using the MMI and start the test run; if the message occurs again change Main Board MB04B-A1 and install the software afterward</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editError('1001', 'Time-out at dump valve of axle 1', 'Axle 1', '• extremely low adhesion coefficient between track and wheels causing dump valve to pull out of operation\n• Main Board MB04B-A1 defect', 'delete message by using the MMI and start the test run; if the message occurs again change Main Board MB04B-A1 and install the software afterward')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('1001')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><span class="badge-custom badge-warning fs-6 fw-bold font-monospace" style="letter-spacing: 0.5px; color:#000;">1101</span></td>
                            <td><strong>Short/Open circuit at frequency input of Main Board MB04B-A1 for speed sensor signal detection on axle 1</strong></td>
                            <td class="text-center font-monospace">Axle 1</td>
                            <td>
                                <ul class="mb-0 ps-3" style="font-size: 11px;">
                                    <li>cable break to speed sensor</li>
                                    <li>short circuit of speed sensor</li>
                                    <li>plugs from Main Board MB04B-A1 to speed sensor unfastened</li>
                                </ul>
                            </td>
                            <td>check cable connection, plugs and sensor resistance; clean or replace speed sensor assembly</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editError('1101', 'Short/Open circuit at frequency input of Main Board MB04B-A1 for speed sensor signal detection on axle 1', 'Axle 1', '• cable break to speed sensor\n• short circuit of speed sensor\n• plugs from Main Board MB04B-A1 to speed sensor unfastened', 'check cable connection, plugs and sensor resistance; clean or replace speed sensor assembly')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('1101')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-custom no-print">
                <span>Showing 1 to 4 of 42 error codes</span>
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

<!-- Add / Edit Error Code Modal -->
<div class="modal fade" id="errorModal" tabindex="-1" aria-labelledby="errorModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="errorModalLabel"><i class="bi bi-bug text-primary"></i> Register Diagnostic Event Code</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="errorForm" onsubmit="handleFormSubmit(event)">
                <div class="modal-body">
                    <div class="row g-2">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalCode">Display Code on MMI <span class="text-danger">*</span></label>
                                <input type="text" class="form-control-custom font-monospace" id="modalCode" required placeholder="e.g., 0101">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalAxle">Affected Axle <span class="text-danger">*</span></label>
                                <select id="modalAxle" class="form-control-custom" required>
                                    <option value="Axles 1 - 4">Axles 1 - 4</option>
                                    <option value="Axle 1">Axle 1</option>
                                    <option value="Axle 2">Axle 2</option>
                                    <option value="Axle 3">Axle 3</option>
                                    <option value="Axle 4">Axle 4</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalEventName">Event Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalEventName" required placeholder="e.g., Internal board error on Main Board MB04B">
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalCause">Cause of Event (Enter bullet points on separate lines) <span class="text-danger">*</span></label>
                        <textarea class="form-control-custom" id="modalCause" style="height: 100px;" required placeholder="e.g.,&#10;• 7401&#10;• S301&#10;• main Board MB04B-A1 defect"></textarea>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalInstruction">Instruction to Railway / Maintenance Action <span class="text-danger">*</span></label>
                        <textarea class="form-control-custom" id="modalInstruction" style="height: 100px;" required placeholder="e.g.,&#10;• change Main Board MB04B-A1"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary" id="errorSubmitBtn">Register Event Code</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('errSearchInput', 'errorTable');

    // Filter by affected axle
    const axleFilter = document.getElementById('errAxleFilter');
    if (axleFilter) {
        axleFilter.addEventListener('change', function() {
            const val = axleFilter.value.toLowerCase();
            const rows = document.querySelectorAll('#errorTable tbody tr');
            rows.forEach(row => {
                const axleText = row.cells[2].textContent.toLowerCase();
                const matches = val === "" || axleText.indexOf(val) > -1;
                row.style.display = matches ? "" : "none";
            });
        });
    }

    function resetFilters() {
        if (axleFilter) axleFilter.value = "";
        document.getElementById('errSearchInput').value = "";
        document.querySelectorAll('#errorTable tbody tr').forEach(r => r.style.display = "");
    }

    // Modal Operations
    const errorModalEl = document.getElementById('errorModal');
    const addErrorBtn = document.getElementById('addErrorBtn');
    const errorModalLabel = document.getElementById('errorModalLabel');
    const errorSubmitBtn = document.getElementById('errorSubmitBtn');

    function resetErrorForm() {
        document.getElementById('modalCode').value = "";
        document.getElementById('modalCode').disabled = false;
        document.getElementById('modalAxle').value = "Axles 1 - 4";
        document.getElementById('modalEventName').value = "";
        document.getElementById('modalCause').value = "";
        document.getElementById('modalInstruction').value = "";

        errorModalLabel.innerHTML = `<i class="bi bi-bug text-primary"></i> Register Diagnostic Event Code`;
        errorSubmitBtn.textContent = "Register Event Code";
    }

    function editError(code, name, axle, cause, instruction) {
        document.getElementById('modalCode').value = code;
        document.getElementById('modalCode').disabled = true;
        document.getElementById('modalAxle').value = axle;
        document.getElementById('modalEventName').value = name;
        document.getElementById('modalCause').value = cause;
        document.getElementById('modalInstruction').value = instruction;

        errorModalLabel.innerHTML = `<i class="bi bi-pencil-square text-primary"></i> Edit Diagnostic Event Code`;
        errorSubmitBtn.textContent = "Update Event Code";
        
        new bootstrap.Modal(errorModalEl).show();
    }

    function confirmDelete(code) {
        if (confirm(`Are you sure you want to delete event code '${code}' from firmware database registry?`)) {
            alert(`Event code '${code}' deleted successfully.`);
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault();
        alert('Event code successfully registered/updated in WSPS memory!');
        bootstrap.Modal.getInstance(errorModalEl).hide();
    }

    if (addErrorBtn) {
        addErrorBtn.addEventListener('click', resetErrorForm);
    }
    
    errorModalEl.addEventListener('hidden.bs.modal', resetErrorForm);
</script>

</body>
</html>
