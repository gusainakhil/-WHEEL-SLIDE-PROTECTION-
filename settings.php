<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Settings - Wheel Slide Protection System (WSPS)</title>
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
            <h1>System Settings & Profiles</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>
    </div>

    <!-- Alert placeholder for save feedback -->
    <div id="saveAlertPlaceholder" class="no-print"></div>

    <div class="row g-3">
        <!-- Depot Profile & System Parameters -->
        <div class="col-lg-8">
            <!-- Depot details card -->
            <div class="content-card mb-3">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-building-fill text-primary"></i> Depot Profile Information</h5>
                </div>
                <div class="card-body">
                    <form onsubmit="saveDepotProfile(event)">
                        <div class="row g-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="stationName">Station / Depot Name <span class="text-danger">*</span></label>
                                    <input type="text" id="stationName" class="form-control-custom" required value="New Delhi Coaching Depot (NDLS)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="zoneName">Railway Zone <span class="text-danger">*</span></label>
                                    <input type="text" id="zoneName" class="form-control-custom" required value="Northern Railway (NR)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="divisionName">Division Name <span class="text-danger">*</span></label>
                                    <input type="text" id="divisionName" class="form-control-custom" required value="Delhi Division (DLI)">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="depotContact">Operator Contact <span class="text-danger">*</span></label>
                                    <input type="text" id="depotContact" class="form-control-custom" required value="+91-9876543210">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="depotEmail">Official Email Address <span class="text-danger">*</span></label>
                                    <input type="email" id="depotEmail" class="form-control-custom" required value="akhil.golu@ir.gov.in">
                                </div>
                            </div>
                        </div>
                        <div class="border-top pt-3 mt-3 text-end">
                            <button type="submit" class="btn-wsps btn-wsps-primary"><i class="bi bi-save"></i> Save Depot Profile</button>
                        </div>
                    </form>
                </div>
            </div>

            <!-- Asset Metrics and Stats -->
            <div class="content-card mb-3">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-cpu text-primary"></i> Registered WSPS System Assets Summary</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center bg-light">
                                <div class="text-muted small fw-bold uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Total Trains Monitored</div>
                                <div class="fs-4 fw-bold text-dark mt-1">52 Trains</div>
                                <div class="text-success small mt-1" style="font-size: 10px;"><i class="bi bi-check-circle"></i> Active Telemetry</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center bg-light">
                                <div class="text-muted small fw-bold uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Total Coaches Synced</div>
                                <div class="fs-4 fw-bold text-dark mt-1">544 Coaches</div>
                                <div class="text-success small mt-1" style="font-size: 10px;"><i class="bi bi-link-45deg"></i> WSP Networks Online</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="p-3 border rounded text-center bg-light">
                                <div class="text-muted small fw-bold uppercase" style="font-size: 10px; letter-spacing: 0.5px;">Total Speed Sensor Controllers (SSC)</div>
                                <div class="fs-4 fw-bold text-dark mt-1">2,176 SSC</div>
                                <div class="text-primary small mt-1" style="font-size: 10px;"><i class="bi bi-broadcast-pin"></i> 4 Sensors Per Coach</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Subscription parameters -->
            <div class="content-card">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-credit-card-2-front-fill text-primary"></i> Subscription & Licensing Parameters</h5>
                </div>
                <div class="card-body">
                    <div class="row g-3 align-items-center">
                        <div class="col-md-4">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Subscription Start Date</label>
                                <div class="form-control-custom bg-light fw-bold text-dark">01-Jan-2026</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group-custom">
                                <label class="form-label-custom">Subscription End Date</label>
                                <div class="form-control-custom bg-light fw-bold text-dark">31-Dec-2026</div>
                            </div>
                        </div>
                        <div class="col-md-4 text-center">
                            <div class="badge bg-success p-3 rounded" style="font-size: 12px; letter-spacing: 0.5px; width: 100%;">
                                <i class="bi bi-patch-check"></i> LICENSED ACTIVE<br>
                                <small style="font-size: 10px; font-weight: 400;">185 Days Remaining</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Side: Change Password Form -->
        <div class="col-lg-4">
            <div class="content-card">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-key-fill text-primary"></i> Update Profile Password</h5>
                </div>
                <div class="card-body">
                    <form onsubmit="updateProfilePassword(event)">
                        <div class="form-group-custom mb-3">
                            <label class="form-label-custom" for="currPass">Current Account Password <span class="text-danger">*</span></label>
                            <input type="password" id="currPass" class="form-control-custom" required placeholder="Enter current password">
                        </div>
                        <div class="form-group-custom mb-3">
                            <label class="form-label-custom" for="newPass">New Account Password <span class="text-danger">*</span></label>
                            <input type="password" id="newPass" class="form-control-custom" required placeholder="Enter new password">
                            <div class="text-muted" style="font-size: 9.5px; margin-top: 4px;">Password must contain at least 6 characters.</div>
                        </div>
                        <div class="form-group-custom mb-3">
                            <label class="form-label-custom" for="confirmPass">Confirm New Password <span class="text-danger">*</span></label>
                            <input type="password" id="confirmPass" class="form-control-custom" required placeholder="Confirm new password">
                        </div>
                        <div class="border-top pt-3 mt-3 text-end">
                            <button type="submit" class="btn-wsps btn-wsps-primary w-100 py-2"><i class="bi bi-shield-lock-fill"></i> Update Password</button>
                        </div>
                    </form>
                </div>
            </div>
            
            <!-- Standard backups widget -->
            <div class="content-card mt-3">
                <div class="card-header bg-light">
                    <h5><i class="bi bi-hdd-fill text-secondary"></i> System Actions</h5>
                </div>
                <div class="card-body d-flex flex-column gap-2">
                    <button class="btn-wsps btn-wsps-secondary w-100 py-2 text-start" onclick="triggerBackup()"><i class="bi bi-cloud-arrow-up"></i> Export Configuration XML</button>
                    <button class="btn-wsps btn-wsps-secondary w-100 py-2 text-start" onclick="confirmReset()"><i class="bi bi-arrow-counterclockwise"></i> Reset WSPS Defaults</button>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<!-- Bootstrap Bundle JS -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    function saveDepotProfile(event) {
        event.preventDefault();
        showFeedbackAlert('Depot profile parameters and official contact details updated successfully.');
    }

    function updateProfilePassword(event) {
        event.preventDefault();
        const curr = document.getElementById('currPass').value;
        const npass = document.getElementById('newPass').value;
        const cpass = document.getElementById('confirmPass').value;

        if (npass.length < 6) {
            alert('Error: New password must be at least 6 characters long.');
            return;
        }

        if (npass !== cpass) {
            alert('Error: Confirm password does not match new password.');
            return;
        }

        showFeedbackAlert('Account security password has been changed successfully.');
        document.getElementById('currPass').value = '';
        document.getElementById('newPass').value = '';
        document.getElementById('confirmPass').value = '';
    }

    function showFeedbackAlert(msg) {
        const container = document.getElementById('saveAlertPlaceholder');
        container.innerHTML = `
            <div class="alert alert-success alert-dismissible fade show d-flex align-items-center gap-2" role="alert">
                <i class="bi bi-check-circle-fill fs-5"></i>
                <div>${msg}</div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        `;
        // Auto dismiss after 4 seconds
        setTimeout(() => {
            const alertEl = container.querySelector('.alert');
            if (alertEl) {
                const bsAlert = new bootstrap.Alert(alertEl);
                bsAlert.close();
            }
        }, 4000);
    }

    function triggerBackup() {
        alert("Configuration backup successful!\nWSPS configuration file exported to secure memory: /boot/wsps/config_backup.xml");
    }

    function confirmReset() {
        if (confirm("Are you sure you want to restore all WSPS settings to standard Indian Railways standards?")) {
            showFeedbackAlert('All thresholds and parameters reset to standard LHB profile.');
        }
    }
</script>

</body>
</html>
