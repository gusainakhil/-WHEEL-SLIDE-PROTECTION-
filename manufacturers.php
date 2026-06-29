<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OEM & Manufacturer Registry - Wheel Slide Protection System (WSPS)</title>
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
            <h1>OEM & Manufacturer Registry</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">OEM Registry</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-primary" id="addOEMBtn" data-bs-toggle="modal" data-bs-target="#oemModal"><i class="bi bi-building-add"></i> Add OEM Maker</button>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('oemTable', 'wsps-oem-registry')"><i class="bi bi-file-earmark-excel"></i> Export Registry</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total OEM Makers</span>
                <span class="stat-value">6</span>
                <span class="stat-desc">Registered suppliers</span>
            </div>
            <div class="stat-icon"><i class="bi bi-building"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Solenoid Suppliers</span>
                <span class="stat-value">4</span>
                <span class="stat-desc text-success">Pneumatic dump valves</span>
            </div>
            <div class="stat-icon"><i class="bi bi-wind"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Sensor Suppliers</span>
                <span class="stat-value">3</span>
                <span class="stat-desc">Phasing speed sensors</span>
            </div>
            <div class="stat-icon"><i class="bi bi-broadcast"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Warranty Claims</span>
                <span class="stat-value">2 Active</span>
                <span class="stat-desc">Under OEM evaluation</span>
            </div>
            <div class="stat-icon"><i class="bi bi-receipt"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Components Approved</span>
                <span class="stat-value">18 Types</span>
                <span class="stat-desc text-success">RDSO Standards compliant</span>
            </div>
            <div class="stat-icon"><i class="bi bi-patch-check"></i></div>
        </div>
    </div>

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-6">
                    <label class="form-label-custom" for="oemSearchInput">Search OEM Registry</label>
                    <input type="text" id="oemSearchInput" class="form-control-custom" placeholder="Search by Company, Representative, or Component Supplied...">
                </div>
                <div class="col-md-4">
                    <label class="form-label-custom" for="oemStatusFilter">Filter by Status</label>
                    <select id="oemStatusFilter" class="form-control-custom">
                        <option value="">All Statuses</option>
                        <option value="ACTIVE">Active</option>
                        <option value="INACTIVE">Inactive</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- OEM Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-building-gear"></i> RDSO Approved OEM / Manufacturer Directory</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 6 Configured Manufacturers</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="oemTable">
                    <thead>
                        <tr>
                            <th>Company Name</th>
                            <th>Contact Person</th>
                            <th>Mobile Number</th>
                            <th>Email ID</th>
                            <th>Address</th>
                            <th>Components Supplied</th>
                            <th>Status</th>
                            <th class="no-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>Faiveley Transport India</strong></td>
                            <td>R. K. Sharma</td>
                            <td>+91-9840123456</td>
                            <td>rk.sharma@faiveley.com</td>
                            <td>Plot No. 3, Industrial Area, Hosur, Tamil Nadu</td>
                            <td><span class="badge-custom badge-primary">Dump Valves</span> <span class="badge-custom badge-primary">WSPS Controller</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editOEM('Faiveley Transport India', 'R. K. Sharma', '+91-9840123456', 'rk.sharma@faiveley.com', 'Plot No. 3, Industrial Area, Hosur, Tamil Nadu', 'Dump Valves, WSPS Controller', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('Faiveley Transport India')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Knorr-Bremse India Pvt Ltd</strong></td>
                            <td>Sanjay Vasishth</td>
                            <td>+91-9811223344</td>
                            <td>sanjay.vasishth@knorr-bremse.com</td>
                            <td>51/4, Industrial Area, Faridabad, Haryana</td>
                            <td><span class="badge-custom badge-primary">Speed Sensors</span> <span class="badge-custom badge-primary">Dump Valves</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editOEM('Knorr-Bremse India Pvt Ltd', 'Sanjay Vasishth', '+91-9811223344', 'sanjay.vasishth@knorr-bremse.com', '51/4, Industrial Area, Faridabad, Haryana', 'Speed Sensors, Dump Valves', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('Knorr-Bremse India Pvt Ltd')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Medha Servo Drives</strong></td>
                            <td>Y. Srinivasa Rao</td>
                            <td>+91-9000155667</td>
                            <td>ysr@medha.com</td>
                            <td>P-4/5, IDA Nacharam, Hyderabad, Telangana</td>
                            <td><span class="badge-custom badge-primary">WSPS Controller Cards</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editOEM('Medha Servo Drives', 'Y. Srinivasa Rao', '+91-9000155667', 'ysr@medha.com', 'P-4/5, IDA Nacharam, Hyderabad, Telangana', 'WSPS Controller Cards', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('Medha Servo Drives')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Escorts Limited (RED)</strong></td>
                            <td>Anuj Kumar</td>
                            <td>+91-9958421098</td>
                            <td>anuj.kumar@escorts.co.in</td>
                            <td>15/5, Mathura Road, Faridabad, Haryana</td>
                            <td><span class="badge-custom badge-primary">Solenoid Dump Valves</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editOEM('Escorts Limited (RED)', 'Anuj Kumar', '+91-9958421098', 'anuj.kumar@escorts.co.in', '15/5, Mathura Road, Faridabad, Haryana', 'Solenoid Dump Valves', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('Escorts Limited (RED)')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>Siemens Mobility India</strong></td>
                            <td>Pranav Mehta</td>
                            <td>+91-9822456789</td>
                            <td>pranav.meeta@siemens.com</td>
                            <td>Thane Belapur Road, Navi Mumbai, Maharashtra</td>
                            <td><span class="badge-custom badge-primary">Speed Sensors</span> <span class="badge-custom badge-primary">Controller Cards</span></td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editOEM('Siemens Mobility India', 'Pranav Mehta', '+91-9822456789', 'pranav.meeta@siemens.com', 'Thane Belapur Road, Navi Mumbai, Maharashtra', 'Speed Sensors, Controller Cards', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('Siemens Mobility India')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>SAB WABCO India</strong></td>
                            <td>J. P. N. Sen</td>
                            <td>+91-9830099887</td>
                            <td>jpn.sen@sabwabco.in</td>
                            <td>Harita, Hosur, Tamil Nadu</td>
                            <td><span class="badge-custom badge-primary">Pneumatic Cylinders</span></td>
                            <td><span class="badge-custom badge-danger">INACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editOEM('SAB WABCO India', 'J. P. N. Sen', '+91-9830099887', 'jpn.sen@sabwabco.in', 'Harita, Hosur, Tamil Nadu', 'Pneumatic Cylinders', 'Inactive')" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('SAB WABCO India')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-custom no-print">
                <span>Showing 1 to 6 of 6 OEM makers</span>
                <div class="pagination-buttons">
                    <a href="#" class="pagination-btn disabled"><i class="bi bi-chevron-left"></i></a>
                    <a href="#" class="pagination-btn active">1</a>
                    <a href="#" class="pagination-btn disabled"><i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- OEM Add / Edit Modal -->
<div class="modal fade" id="oemModal" tabindex="-1" aria-labelledby="oemModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="oemModalLabel"><i class="bi bi-building-add text-primary"></i> Add OEM / Manufacturer</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="oemForm" onsubmit="handleFormSubmit(event)">
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalCompanyName">Company Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalCompanyName" required placeholder="e.g., Faiveley Transport">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalContactName">Contact Person Name</label>
                        <input type="text" class="form-control-custom" id="modalContactName" placeholder="e.g., R. K. Sharma">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalMobile">Mobile Number</label>
                                <input type="text" class="form-control-custom" id="modalMobile" placeholder="e.g., +91-9840123456">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalEmail">Email ID</label>
                                <input type="email" class="form-control-custom" id="modalEmail" placeholder="e.g., contact@company.com">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalAddress">Company Address</label>
                        <textarea class="form-control-custom" id="modalAddress" style="height: 60px; font-size:12px;" placeholder="Full postal address..."></textarea>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalComponents">Components Supplied</label>
                        <input type="text" class="form-control-custom" id="modalComponents" placeholder="e.g., Speed Sensors, Dump Valves">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalStatus">Status</label>
                        <select id="modalStatus" class="form-control-custom">
                            <option value="Active">Active</option>
                            <option value="Inactive">Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary" id="oemSubmitBtn">Save OEM Partner</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('oemSearchInput', 'oemTable');

    // Filter by status
    const statusFilter = document.getElementById('oemStatusFilter');
    if (statusFilter) {
        statusFilter.addEventListener('change', function() {
            const val = statusFilter.value.toLowerCase();
            const rows = document.querySelectorAll('#oemTable tbody tr');
            rows.forEach(row => {
                const stat = row.cells[6].textContent.toLowerCase();
                const matches = val === "" || stat.indexOf(val) > -1;
                row.style.display = matches ? "" : "none";
            });
        });
    }

    function resetFilters() {
        if (statusFilter) statusFilter.value = "";
        document.getElementById('oemSearchInput').value = "";
        document.querySelectorAll('#oemTable tbody tr').forEach(r => r.style.display = "");
    }

    // Modal Operations
    const oemModalEl = document.getElementById('oemModal');
    const addOEMBtn = document.getElementById('addOEMBtn');
    const oemModalLabel = document.getElementById('oemModalLabel');
    const oemSubmitBtn = document.getElementById('oemSubmitBtn');

    function resetOEMForm() {
        document.getElementById('modalCompanyName').value = "";
        document.getElementById('modalCompanyName').disabled = false;
        document.getElementById('modalContactName').value = "";
        document.getElementById('modalMobile').value = "";
        document.getElementById('modalEmail').value = "";
        document.getElementById('modalAddress').value = "";
        document.getElementById('modalComponents').value = "";
        document.getElementById('modalStatus').value = "Active";

        oemModalLabel.innerHTML = `<i class="bi bi-building-add text-primary"></i> Add OEM / Manufacturer`;
        oemSubmitBtn.textContent = "Save OEM Partner";
    }

    function editOEM(company, contact, mobile, email, address, components, status) {
        document.getElementById('modalCompanyName').value = company;
        document.getElementById('modalCompanyName').disabled = true;
        document.getElementById('modalContactName').value = contact;
        document.getElementById('modalMobile').value = mobile;
        document.getElementById('modalEmail').value = email;
        document.getElementById('modalAddress').value = address;
        document.getElementById('modalComponents').value = components;
        document.getElementById('modalStatus').value = status;

        oemModalLabel.innerHTML = `<i class="bi bi-pencil-square text-primary"></i> Edit OEM / Manufacturer`;
        oemSubmitBtn.textContent = "Update OEM Partner";
        
        new bootstrap.Modal(oemModalEl).show();
    }

    function confirmDelete(company) {
        if (confirm(`Are you sure you want to delete OEM partner '${company}'?\nAny components linked to this manufacturer may show warning status.`)) {
            alert(`OEM partner '${company}' deleted successfully.`);
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault();
        alert('OEM / Manufacturer details successfully saved!');
        bootstrap.Modal.getInstance(oemModalEl).hide();
    }

    if (addOEMBtn) {
        addOEMBtn.addEventListener('click', resetOEMForm);
    }
    
    oemModalEl.addEventListener('hidden.bs.modal', resetOEMForm);
</script>

</body>
</html>
