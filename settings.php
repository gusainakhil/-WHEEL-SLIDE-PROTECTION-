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
            <h1>WSPS Configuration Settings</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Settings</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-secondary" onclick="restoreDefaults()"><i class="bi bi-arrow-counterclockwise"></i> Restore Defaults</button>
            <button class="btn-wsps btn-wsps-primary" onclick="triggerBackup()"><i class="bi bi-cloud-arrow-up"></i> Backup Config</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Active Config Profile</span>
                <span class="stat-value">LHB_V4_PROFILE</span>
                <span class="stat-desc">Modified on 25-Jun 14:35</span>
            </div>
            <div class="stat-icon"><i class="bi bi-file-earmark-code"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Calibration Backups</span>
                <span class="stat-value">6 Saved</span>
                <span class="stat-desc text-success">Stored in secure NVRAM</span>
            </div>
            <div class="stat-icon"><i class="bi bi-journal-album"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Integrity Check</span>
                <span class="stat-value">PASSED</span>
                <span class="stat-desc">Checksum verification OK</span>
            </div>
            <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Connected Nodes</span>
                <span class="stat-value">544 Coaches</span>
                <span class="stat-desc text-success"><i class="bi bi-check-circle"></i> Onboard controllers syncd</span>
            </div>
            <div class="stat-icon"><i class="bi bi-link-45deg"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Firmware Version</span>
                <span class="stat-value">v9.84-Fiat</span>
                <span class="stat-desc">Onboard processor microcode</span>
            </div>
            <div class="stat-icon"><i class="bi bi-cpu-fill"></i></div>
        </div>
    </div>

    <!-- Alert placeholder for save feedback -->
    <div id="saveAlertPlaceholder" class="no-print"></div>

    <div class="row g-3">
        <!-- System and Threshold Settings -->
        <div class="col-lg-8">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-sliders"></i> WSPS Solenoid & Speed Sensor Threshold Settings</h5>
                </div>
                <div class="card-body">
                    <form onsubmit="saveConfiguration(event)">
                        <!-- Section 1: System Config -->
                        <h6 class="form-label-custom border-bottom pb-1 mb-3 text-primary"><i class="bi bi-hdd-network"></i> Depot & Telemetry Parameters</h6>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="stationName">Depot / Station Name <span class="text-danger">*</span></label>
                                    <input type="text" id="stationName" class="form-control-custom" required value="New Delhi (NDLS) C&W Depot">
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
                                    <label class="form-label-custom" for="reservoirPressure">Main Reservoir Target Pressure (Bar) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" id="reservoirPressure" class="form-control-custom" required value="5.0">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="transmitInterval">Telemetry Transmit Interval (ms) <span class="text-danger">*</span></label>
                                    <input type="number" id="transmitInterval" class="form-control-custom" required value="500">
                                </div>
                            </div>
                        </div>

                        <!-- Section 2: Threshold Config -->
                        <h6 class="form-label-custom border-bottom pb-1 mb-3 text-primary"><i class="bi bi-shield-exclamation"></i> Protection Microcode Thresholds</h5>
                        <div class="row g-2 mb-3">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="speedThreshold">Slide Speed Differential (km/h) <span class="text-danger">*</span></label>
                                    <input type="number" step="0.1" id="speedThreshold" class="form-control-custom" required value="7.0">
                                    <div class="text-muted" style="font-size: 9.5px;">Trigger dump solenoids if wheel speed lags reference speed by this delta.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="sensorTimeout">Speed Sensor Pulse Timeout (ms) <span class="text-danger">*</span></label>
                                    <input type="number" id="sensorTimeout" class="form-control-custom" required value="200">
                                    <div class="text-muted" style="font-size: 9.5px;">Flag sensor fault if no pulse is received within this window.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="dumpDuration">Dump Valve Exhaust Pulse Duration (ms) <span class="text-danger">*</span></label>
                                    <input type="number" id="dumpDuration" class="form-control-custom" required value="300">
                                    <div class="text-muted" style="font-size: 9.5px;">Length of solenoid exhaust pulse to discharge brake cylinders.</div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="adhesionLimit">Slide protection Recovery Ratio (%) <span class="text-danger">*</span></label>
                                    <input type="number" id="adhesionLimit" class="form-control-custom" required value="90">
                                    <div class="text-muted" style="font-size: 9.5px;">Close exhaust valves once wheel matches reference speed by this ratio.</div>
                                </div>
                            </div>
                        </div>

                        <div class="border-top pt-3 text-end">
                            <button type="submit" class="btn-wsps btn-wsps-primary py-2 px-4"><i class="bi bi-save-fill"></i> Save Configuration</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Notification and Alerts Config -->
        <div class="col-lg-4">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-bell-fill"></i> Telemetry Alerts & Notifications</h5>
                </div>
                <div class="card-body">
                    <form onsubmit="saveNotifications(event)">
                        <div class="form-check my-2">
                            <input class="form-check-input" type="checkbox" id="smsAlerts" checked>
                            <label class="form-check-label" for="smsAlerts">
                                <strong>SMS Alerts on Critical Slide</strong>
                                <div class="text-muted" style="font-size: 9.5px;">SMS notifications sent to section engineers on dump valve failures.</div>
                            </label>
                        </div>

                        <div class="form-check my-2">
                            <input class="form-check-input" type="checkbox" id="emailAlerts" checked>
                            <label class="form-check-label" for="emailAlerts">
                                <strong>Email Alerts (Daily Summary)</strong>
                                <div class="text-muted" style="font-size: 9.5px;">Automated email summary sent to divisional head of safety.</div>
                            </label>
                        </div>

                        <div class="form-check my-2">
                            <input class="form-check-input" type="checkbox" id="sirenAlerts">
                            <label class="form-check-label" for="sirenAlerts">
                                <strong>Depot Alarm/Siren Trigger</strong>
                                <div class="text-muted" style="font-size: 9.5px;">Sound physical audio alarm on critical short circuits.</div>
                            </label>
                        </div>

                        <div class="form-group-custom mt-3">
                            <label class="form-label-custom" for="notifPhone">Operator Contact Number</label>
                            <input type="text" id="notifPhone" class="form-control-custom" value="+91-9876543210">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom" for="notifEmail">Operator Email Address</label>
                            <input type="email" id="notifEmail" class="form-control-custom" value="akhil.golu@ir.gov.in">
                        </div>

                        <div class="border-top pt-3 text-end mt-3">
                            <button type="submit" class="btn-wsps btn-wsps-primary"><i class="bi bi-bell"></i> Save Contacts</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'includes/footer.php'; ?>

<script>
    function saveConfiguration(event) {
        event.preventDefault();
        showFeedbackAlert('System threshold parameters uploaded to onboard WSPS processors successfully!');
    }

    function saveNotifications(event) {
        event.preventDefault();
        showFeedbackAlert('Divisional alert notification contacts saved.');
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

    function restoreDefaults() {
        if (confirm("Are you sure you want to restore all WSPS thresholds to Indian Railways Standard LHB defaults?\n\n- Speed differential: 5.0 km/h\n- Sensor Timeout: 200 ms\n- Solenoid Pulse: 300 ms")) {
            document.getElementById('speedThreshold').value = "5.0";
            document.getElementById('sensorTimeout').value = "200";
            document.getElementById('dumpDuration').value = "300";
            document.getElementById('adhesionLimit').value = "90";
            showFeedbackAlert('Default LHB configuration standards loaded.');
        }
    }

    function triggerBackup() {
        alert("Configuration backup successful!\nWSPS configuration file exported to secure memory: /boot/wsps/config_backup_250626.xml");
    }
</script>

</body>
</html>
