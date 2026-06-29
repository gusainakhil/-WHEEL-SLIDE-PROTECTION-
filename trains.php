<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Train Management - Wheel Slide Protection System (WSPS)</title>
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
            <h1>Train Management</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Train Management</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-primary" data-bs-toggle="modal" data-bs-target="#trainModal"><i class="bi bi-plus-circle"></i> Add New Train</button>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('trainsTable', 'wsps-trains-list')"><i class="bi bi-file-earmark-excel"></i> Export Excel</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Trains</span>
                <span class="stat-value">52</span>
                <span class="stat-desc">Registered in WSPS Database</span>
            </div>
            <div class="stat-icon"><i class="bi bi-list-ul"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Active Monitoring</span>
                <span class="stat-value">18</span>
                <span class="stat-desc text-success"><i class="bi bi-wifi"></i> Onboard telemetry live</span>
            </div>
            <div class="stat-icon"><i class="bi bi-play-circle"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">In Maintenance</span>
                <span class="stat-value">4</span>
                <span class="stat-desc">Calibration & sensor tuning</span>
            </div>
            <div class="stat-icon"><i class="bi bi-wrench"></i></div>
        </div>
        <div class="stat-card danger">
            <div class="stat-info">
                <span class="stat-label">Critical Warnings</span>
                <span class="stat-value">1</span>
                <span class="stat-desc text-danger"><i class="bi bi-exclamation-circle"></i> High slip event</span>
            </div>
            <div class="stat-icon"><i class="bi bi-exclamation-octagon"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">System Coverage</span>
                <span class="stat-value">98.2%</span>
                <span class="stat-desc">All divisions configured</span>
            </div>
            <div class="stat-icon"><i class="bi bi-globe-asia-australia"></i></div>
        </div>
    </div> -->

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label-custom" for="trainSearchInput">Search Trains</label>
                    <input type="text" id="trainSearchInput" class="form-control-custom" placeholder="Type Train No. or Name...">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="divisionFilter">Filter by Division</label>
                    <select id="divisionFilter" class="form-control-custom">
                        <option value="">All Divisions</option>
                        <option value="Delhi (DLI)">Delhi (DLI)</option>
                        <option value="Firozpur (FZR)">Firozpur (FZR)</option>
                        <option value="Kota (KOTA)">Kota (KOTA)</option>
                        <option value="Sealdah (SDAH)">Sealdah (SDAH)</option>
                        <option value="Mumbai Central (MMCT)">Mumbai Central (MMCT)</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="statusFilter">Filter by Status</label>
                    <select id="statusFilter" class="form-control-custom">
                        <option value="">All Statuses</option>
                        <option value="ACTIVE">Active</option>
                        <option value="MAINTENANCE">Maintenance</option>
                        <option value="DECOMMISSIONED">Decommissioned</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Trains Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-train-front"></i> Trains Configured in protect-network</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 5 Active Trains</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="trainsTable">
                    <thead>
                        <tr>
                            <th>Train No</th>
                            <th>Train Name</th>
                            <th>Source</th>
                            <th>Destination</th>
                            <th>Current Division</th>
                            <th>Monitored Coaches</th>
                            <th>Sensor Grid</th>
                            <th>Protection System</th>
                            <th>Status</th>
                            <th class="no-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>12002</strong></td>
                            <td>NDLS Bhopal Shatabdi</td>
                            <td>New Delhi (NDLS)</td>
                            <td>Bhopal Habibganj (HBJ)</td>
                            <td>Delhi (DLI)</td>
                            <td class="text-center fw-bold text-primary">16</td>
                            <td><span class="badge-custom badge-success"><i class="bi bi-check-circle"></i> 64/64 OK</span></td>
                            <td><span class="badge-custom badge-danger">SLIP ACTION ACTIVE</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <a href="coaches.php?train_no=12002" class="btn-wsps btn-wsps-secondary btn-wsps-xs" title="View Coaches"><i class="bi bi-box-seam"></i></a>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editTrain('12002', 'NDLS Bhopal Shatabdi', 'NDLS', 'HBJ', 'Delhi (DLI)', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('12002')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>12952</strong></td>
                            <td>Mumbai Rajdhani Exp</td>
                            <td>New Delhi (NDLS)</td>
                            <td>Mumbai Central (MMCT)</td>
                            <td>Kota (KOTA)</td>
                            <td class="text-center fw-bold text-primary">20</td>
                            <td><span class="badge-custom badge-success"><i class="bi bi-check-circle"></i> 80/80 OK</span></td>
                            <td><span class="badge-custom badge-success">NORMAL</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <a href="coaches.php?train_no=12952" class="btn-wsps btn-wsps-secondary btn-wsps-xs" title="View Coaches"><i class="bi bi-box-seam"></i></a>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editTrain('12952', 'Mumbai Rajdhani Exp', 'NDLS', 'MMCT', 'Kota (KOTA)', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('12952')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>12056</strong></td>
                            <td>Dehradun Jan Shatabdi</td>
                            <td>Dehradun (DDN)</td>
                            <td>New Delhi (NDLS)</td>
                            <td>Delhi (DLI)</td>
                            <td class="text-center fw-bold text-primary">10</td>
                            <td><span class="badge-custom badge-warning"><i class="bi bi-exclamation-triangle"></i> 38/40 Live</span></td>
                            <td><span class="badge-custom badge-warning">DEGRADED PROTECTION</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <a href="coaches.php?train_no=12056" class="btn-wsps btn-wsps-secondary btn-wsps-xs" title="View Coaches"><i class="bi bi-box-seam"></i></a>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editTrain('12056', 'Dehradun Jan Shatabdi', 'DDN', 'NDLS', 'Delhi (DLI)', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('12056')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>12260</strong></td>
                            <td>Sealdah Duronto Exp</td>
                            <td>New Delhi (NDLS)</td>
                            <td>Sealdah (SDAH)</td>
                            <td>Sealdah (SDAH)</td>
                            <td class="text-center fw-bold text-primary">18</td>
                            <td><span class="badge-custom badge-success"><i class="bi bi-check-circle"></i> 72/72 OK</span></td>
                            <td><span class="badge-custom badge-success">NORMAL</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <a href="coaches.php?train_no=12260" class="btn-wsps btn-wsps-secondary btn-wsps-xs" title="View Coaches"><i class="bi bi-box-seam"></i></a>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editTrain('12260', 'Sealdah Duronto Exp', 'NDLS', 'SDAH', 'Sealdah (SDAH)', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('12260')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>12424</strong></td>
                            <td>NDLS Dibrugarh Rajdhani</td>
                            <td>New Delhi (NDLS)</td>
                            <td>Dibrugarh (DBRT)</td>
                            <td>Guwahati (GHY)</td>
                            <td class="text-center fw-bold text-primary">18</td>
                            <td><span class="badge-custom badge-secondary"><i class="bi bi-slash-circle"></i> 0/72 Config</span></td>
                            <td><span class="badge-custom badge-secondary">OFFLINE</span></td>
                            <td><span class="badge-custom badge-warning">MAINTENANCE</span></td>
                            <td class="no-export">
                                <a href="coaches.php?train_no=12424" class="btn-wsps btn-wsps-secondary btn-wsps-xs" title="View Coaches"><i class="bi bi-box-seam"></i></a>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editTrain('12424', 'NDLS Dibrugarh Rajdhani', 'NDLS', 'DBRT', 'Guwahati (GHY)', 'Maintenance')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('12424')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-custom no-print">
                <span>Showing 1 to 5 of 52 trains</span>
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

<!-- Add / Edit Train Modal -->
<div class="modal fade" id="trainModal" tabindex="-1" aria-labelledby="trainModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="trainModalLabel"><i class="bi bi-train-front-fill text-primary"></i> Add New Train Configuration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="trainForm" onsubmit="handleFormSubmit(event)">
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalTrainNo">Train Number <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalTrainNo" required placeholder="e.g., 12002">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalTrainName">Train Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalTrainName" required placeholder="e.g., NDLS Bhopal Shatabdi">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalSource">Source Station <span class="text-danger">*</span></label>
                                <input type="text" class="form-control-custom" id="modalSource" required placeholder="e.g., NDLS">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalDest">Destination Station <span class="text-danger">*</span></label>
                                <input type="text" class="form-control-custom" id="modalDest" required placeholder="e.g., HBJ">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalDivision">Current Division <span class="text-danger">*</span></label>
                        <select id="modalDivision" class="form-control-custom" required>
                            <option value="Delhi (DLI)">Delhi (DLI)</option>
                            <option value="Firozpur (FZR)">Firozpur (FZR)</option>
                            <option value="Kota (KOTA)">Kota (KOTA)</option>
                            <option value="Sealdah (SDAH)">Sealdah (SDAH)</option>
                            <option value="Mumbai Central (MMCT)">Mumbai Central (MMCT)</option>
                        </select>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalStatus">Status</label>
                        <select id="modalStatus" class="form-control-custom">
                            <option value="Active">Active</option>
                            <option value="Maintenance">Maintenance</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary" id="modalSubmitBtn">Save Configuration</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('trainSearchInput', 'trainsTable');

    // Filter by division
    const divFilter = document.getElementById('divisionFilter');
    const statFilter = document.getElementById('statusFilter');

    function applyFilters() {
        const divVal = divFilter.value.toLowerCase();
        const statVal = statFilter.value.toLowerCase();
        const rows = document.querySelectorAll('#trainsTable tbody tr');

        rows.forEach(row => {
            const divCell = row.cells[4].textContent.toLowerCase();
            const statCell = row.cells[8].textContent.toLowerCase();
            
            const matchesDiv = divVal === "" || divCell.indexOf(divVal) > -1;
            const matchesStat = statVal === "" || statCell.indexOf(statVal) > -1;

            row.style.display = (matchesDiv && matchesStat) ? "" : "none";
        });
    }

    divFilter.addEventListener('change', applyFilters);
    statFilter.addEventListener('change', applyFilters);

    function resetFilters() {
        divFilter.value = "";
        statFilter.value = "";
        document.getElementById('trainSearchInput').value = "";
        applyFilters();
        // Reset search display
        document.querySelectorAll('#trainsTable tbody tr').forEach(r => r.style.display = "");
    }

    // Modal Operations
    function editTrain(no, name, src, dest, div, status) {
        document.getElementById('trainModalLabel').innerHTML = `<i class="bi bi-pencil-fill text-primary"></i> Edit Train Configuration`;
        document.getElementById('modalTrainNo').value = no;
        document.getElementById('modalTrainNo').disabled = true;
        document.getElementById('modalTrainName').value = name;
        document.getElementById('modalSource').value = src;
        document.getElementById('modalDest').value = dest;
        document.getElementById('modalDivision').value = div;
        document.getElementById('modalStatus').value = status;
        document.getElementById('modalSubmitBtn').textContent = "Update Configuration";
        
        const modal = new bootstrap.Modal(document.getElementById('trainModal'));
        modal.show();
    }

    function confirmDelete(trainNo) {
        if (confirm(`Are you sure you want to delete train #${trainNo} from WSPS protection?`)) {
            alert(`Train #${trainNo} deleted successfully.`);
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault();
        alert('Train configuration saved successfully!');
        bootstrap.Modal.getInstance(document.getElementById('trainModal')).hide();
    }
</script>

</body>
</html>
