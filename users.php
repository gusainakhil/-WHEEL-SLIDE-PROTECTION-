<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Management - Wheel Slide Protection System (WSPS)</title>
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
            <h1>User Roster & Security Permissions</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">User Management</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-primary" data-bs-toggle="modal" data-bs-target="#userModal"><i class="bi bi-person-plus"></i> Add New User</button>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('usersTable', 'wsps-users-directory')"><i class="bi bi-file-earmark-excel"></i> Export Directory</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Users</span>
                <span class="stat-value">14</span>
                <span class="stat-desc">Configured in local registry</span>
            </div>
            <div class="stat-icon"><i class="bi bi-people"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">System Admins</span>
                <span class="stat-value">2</span>
                <span class="stat-desc text-success">Full superuser access</span>
            </div>
            <div class="stat-icon"><i class="bi bi-shield-lock"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Section Engineers</span>
                <span class="stat-value">8</span>
                <span class="stat-desc">Can calibrate and pulse test</span>
            </div>
            <div class="stat-icon"><i class="bi bi-person-gear"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Division Operators</span>
                <span class="stat-value">4</span>
                <span class="stat-desc">Read-only & alert ack rights</span>
            </div>
            <div class="stat-icon"><i class="bi bi-person-video2"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Online Sessions</span>
                <span class="stat-value">3</span>
                <span class="stat-desc text-success"><i class="bi bi-circle-fill fs-8 text-success pulse"></i> Active live telemetry</span>
            </div>
            <div class="stat-icon"><i class="bi bi-broadcast"></i></div>
        </div>
    </div> -->

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label-custom" for="userSearchInput">Search User Directory</label>
                    <input type="text" id="userSearchInput" class="form-control-custom" placeholder="Search by name, designation, or email...">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="roleFilter">Filter by Role</label>
                    <select id="roleFilter" class="form-control-custom">
                        <option value="">All Roles</option>
                        <option value="ADMIN">System Administrator</option>
                        <option value="ENGINEER">Section Engineer</option>
                        <option value="OPERATOR">Division Operator</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="userDivisionFilter">Filter by Division</label>
                    <select id="userDivisionFilter" class="form-control-custom">
                        <option value="">All Divisions</option>
                        <option value="Delhi">Delhi (DLI)</option>
                        <option value="Kota">Kota (KOTA)</option>
                        <option value="Firozpur">Firozpur (FZR)</option>
                        <option value="Sealdah">Sealdah (SDAH)</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Users Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-people-fill"></i> User Directory & Authorization Matrix</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 5 Active Accounts</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="usersTable">
                    <thead>
                        <tr>
                            <th>User ID</th>
                            <th>Full Name</th>
                            <th>Designation / Role</th>
                            <th>Email Address</th>
                            <th>Division / Station</th>
                            <th>Last Login</th>
                            <th>Status</th>
                            <th class="no-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>USR-001</strong></td>
                            <td>Akhil Golu</td>
                            <td><span class="badge-custom badge-primary">ENGINEER</span> Section Engineer (C&W)</td>
                            <td>akhil.golu@ir.gov.in</td>
                            <td>Delhi (DLI)</td>
                            <td>25-Jun-2026 14:59:42</td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="openPermissions('USR-001', 'Akhil Golu', 'ENGINEER', true, true, true, false)" title="Permissions"><i class="bi bi-shield-check"></i> Permissions</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editUser('USR-001', 'Akhil Golu', 'akhil.golu@ir.gov.in', 'ENGINEER', 'Delhi', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>USR-002</strong></td>
                            <td>Ram Sharan</td>
                            <td><span class="badge-custom badge-danger">ADMIN</span> Chief Technical Officer</td>
                            <td>ram.sharan@ir.gov.in</td>
                            <td>Northern Railway HQ</td>
                            <td>25-Jun-2026 14:30:11</td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="openPermissions('USR-002', 'Ram Sharan', 'ADMIN', true, true, true, true)" title="Permissions"><i class="bi bi-shield-check"></i> Permissions</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editUser('USR-002', 'Ram Sharan', 'ram.sharan@ir.gov.in', 'ADMIN', 'HQ', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>USR-005</strong></td>
                            <td>Dinesh Meena</td>
                            <td><span class="badge-custom badge-warning">OPERATOR</span> Division Operator (C&W)</td>
                            <td>dinesh.meena@ir.gov.in</td>
                            <td>Kota (KOTA)</td>
                            <td>25-Jun-2026 13:10:00</td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="openPermissions('USR-005', 'Dinesh Meena', 'OPERATOR', true, false, false, false)" title="Permissions"><i class="bi bi-shield-check"></i> Permissions</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editUser('USR-005', 'Dinesh Meena', 'dinesh.meena@ir.gov.in', 'OPERATOR', 'Kota', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>USR-008</strong></td>
                            <td>Subhash Bose</td>
                            <td><span class="badge-custom badge-primary">ENGINEER</span> Senior Section Engineer</td>
                            <td>subhash.bose@ir.gov.in</td>
                            <td>Sealdah (SDAH)</td>
                            <td>24-Jun-2026 18:45:22</td>
                            <td><span class="badge-custom badge-success">ACTIVE</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="openPermissions('USR-008', 'Subhash Bose', 'ENGINEER', true, true, true, false)" title="Permissions"><i class="bi bi-shield-check"></i> Permissions</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editUser('USR-008', 'Subhash Bose', 'subhash.bose@ir.gov.in', 'ENGINEER', 'Sealdah', 'Active')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>USR-012</strong></td>
                            <td>Vikram Singh</td>
                            <td><span class="badge-custom badge-secondary">OPERATOR</span> Junior Engineer (C&W)</td>
                            <td>vikram.singh@ir.gov.in</td>
                            <td>Firozpur (FZR)</td>
                            <td>20-Jun-2026 09:12:05</td>
                            <td><span class="badge-custom badge-secondary">SUSPENDED</span></td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="openPermissions('USR-012', 'Vikram Singh', 'OPERATOR', false, false, false, false)" title="Permissions"><i class="bi bi-shield-check"></i> Permissions</button>
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editUser('USR-012', 'Vikram Singh', 'vikram.singh@ir.gov.in', 'OPERATOR', 'Firozpur', 'Suspended')" title="Edit"><i class="bi bi-pencil"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>

<!-- User Add / Edit Modal -->
<div class="modal fade" id="userModal" tabindex="-1" aria-labelledby="userModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="userModalLabel"><i class="bi bi-person-plus-fill text-primary"></i> Create User Account</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="handleUserSubmit(event)">
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalUserId">User ID <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalUserId" required placeholder="e.g., USR-015">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalName">Full Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalName" required placeholder="e.g., Akhil Golu">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalEmail">Email Address <span class="text-danger">*</span></label>
                        <input type="email" class="form-control-custom" id="modalEmail" required placeholder="e.g., name@ir.gov.in">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalRole">Designation Role <span class="text-danger">*</span></label>
                                <select id="modalRole" class="form-control-custom" required>
                                    <option value="ADMIN">System Administrator</option>
                                    <option value="ENGINEER">Section Engineer</option>
                                    <option value="OPERATOR">Division Operator</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalUserDiv">Division <span class="text-danger">*</span></label>
                                <input type="text" class="form-control-custom" id="modalUserDiv" required placeholder="e.g., Delhi">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalUserStatus">Status</label>
                        <select id="modalUserStatus" class="form-control-custom">
                            <option value="Active">Active</option>
                            <option value="Suspended">Suspended</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary" id="userSubmitBtn">Register Account</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- User Permissions Modal -->
<div class="modal fade" id="permissionsModal" tabindex="-1" aria-labelledby="permissionsModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="permissionsModalLabel"><i class="bi bi-shield-check text-primary"></i> Edit Security Permissions: <span id="permUserName">Akhil Golu</span></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="handlePermissionsSubmit(event)">
                <div class="modal-body">
                    <div class="alert alert-secondary py-2" style="font-size:11px;">
                        <strong>User ID:</strong> <span id="permUserId">USR-001</span> | <strong>Assigned Role:</strong> <span id="permUserRole">ENGINEER</span>
                    </div>

                    <h6 class="form-label-custom border-bottom pb-1">Access Control Matrix</h6>
                    
                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="permRead" checked>
                        <label class="form-check-label" for="permRead">
                            <strong>Read Telemetry Data</strong>
                            <div class="text-muted" style="font-size: 10px;">Access dashboard, speed charts, and live slide tables</div>
                        </label>
                    </div>

                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="permAcknowledge" checked>
                        <label class="form-check-label" for="permAcknowledge">
                            <strong>Acknowledge & Clear Alerts</strong>
                            <div class="text-muted" style="font-size: 10px;">Acknowledge active slide events and input fault resolution logs</div>
                        </label>
                    </div>

                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="permCalibrate">
                        <label class="form-check-label" for="permCalibrate">
                            <strong>Sensor Calibration & Pulse Testing</strong>
                            <div class="text-muted" style="font-size: 10px;">Apply calibration offset and trigger dump valve solenoids self-test pulses</div>
                        </label>
                    </div>

                    <div class="form-check my-2">
                        <input class="form-check-input" type="checkbox" id="permConfig">
                        <label class="form-check-label" for="permConfig">
                            <strong>System Configurations & Threshold Settings</strong>
                            <div class="text-muted" style="font-size: 10px;">Full administrative rights to modify speed thresholds, main reservoir pressure settings, and register new trains</div>
                        </label>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary">Update Authorization</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('userSearchInput', 'usersTable');

    // Filters
    const roleFilter = document.getElementById('roleFilter');
    const divFilter = document.getElementById('userDivisionFilter');

    function applyUserFilters() {
        const roleVal = roleFilter.value.toLowerCase();
        const divVal = divFilter.value.toLowerCase();
        const rows = document.querySelectorAll('#usersTable tbody tr');

        rows.forEach(row => {
            const roleCell = row.cells[2].textContent.toLowerCase();
            const divCell = row.cells[4].textContent.toLowerCase();

            const matchesRole = roleVal === "" || roleCell.indexOf(roleVal) > -1;
            const matchesDiv = divVal === "" || divCell.indexOf(divVal) > -1;

            row.style.display = (matchesRole && matchesDiv) ? "" : "none";
        });
    }

    roleFilter.addEventListener('change', applyUserFilters);
    divFilter.addEventListener('change', applyUserFilters);

    function resetFilters() {
        roleFilter.value = "";
        divFilter.value = "";
        document.getElementById('userSearchInput').value = "";
        applyUserFilters();
        document.querySelectorAll('#usersTable tbody tr').forEach(r => r.style.display = "");
    }

    // Modal Operations
    function editUser(id, name, email, role, div, status) {
        document.getElementById('userModalLabel').innerHTML = `<i class="bi bi-pencil-fill text-primary"></i> Edit User Account`;
        document.getElementById('modalUserId').value = id;
        document.getElementById('modalUserId').disabled = true;
        document.getElementById('modalName').value = name;
        document.getElementById('modalEmail').value = email;
        document.getElementById('modalRole').value = role;
        document.getElementById('modalUserDiv').value = div;
        document.getElementById('modalUserStatus').value = status;
        document.getElementById('userSubmitBtn').textContent = "Update Account";
        
        new bootstrap.Modal(document.getElementById('userModal')).show();
    }

    function handleUserSubmit(event) {
        event.preventDefault();
        alert('User profile successfully saved.');
        bootstrap.Modal.getInstance(document.getElementById('userModal')).hide();
    }

    // Permissions Matrix
    function openPermissions(id, name, role, canRead, canAck, canCal, canConfig) {
        document.getElementById('permUserName').textContent = name;
        document.getElementById('permUserId').textContent = id;
        document.getElementById('permUserRole').textContent = role;
        
        document.getElementById('permRead').checked = canRead;
        document.getElementById('permAcknowledge').checked = canAck;
        document.getElementById('permCalibrate').checked = canCal;
        document.getElementById('permConfig').checked = canConfig;

        new bootstrap.Modal(document.getElementById('permissionsModal')).show();
    }

    function handlePermissionsSubmit(event) {
        event.preventDefault();
        alert('Security authorization matrix updated for user!');
        bootstrap.Modal.getInstance(document.getElementById('permissionsModal')).hide();
    }
</script>

</body>
</html>
