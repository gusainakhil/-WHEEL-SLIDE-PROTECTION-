<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Schedule - Wheel Slide Protection System (WSPS)</title>
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
            <h1>Create Diagnostic & Inspection Schedule</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Create Schedule</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-toggle="modal" data-bs-target="#roundTripModal">
                <i class="bi bi-arrow-repeat"></i> Round Trip Schedule
            </button>
        </div>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="stats-grid">
        <div class="stat-card danger">
            <div class="stat-info">
                <span class="stat-label">Coaches Overdue Test</span>
                <span class="stat-value">5</span>
                <span class="stat-desc text-danger"><i class="bi bi-exclamation-triangle"></i> Calibration window expired</span>
            </div>
            <div class="stat-icon"><i class="bi bi-exclamation-diamond"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Scheduled This Week</span>
                <span class="stat-value">24</span>
                <span class="stat-desc text-success"><i class="bi bi-calendar2-check"></i> Standard inspection</span>
            </div>
            <div class="stat-icon"><i class="bi bi-calendar-event"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Available Engineers</span>
                <span class="stat-value">8</span>
                <span class="stat-desc">On-duty roster (Delhi Depot)</span>
            </div>
            <div class="stat-icon"><i class="bi bi-people"></i></div>
        </div>
        <div class="stat-card warning">
            <div class="stat-info">
                <span class="stat-label">Avg Inspection Time</span>
                <span class="stat-value">45 Mins</span>
                <span class="stat-desc">Self-test & pneumatic flush</span>
            </div>
            <div class="stat-icon"><i class="bi bi-stopwatch"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Solenoid Solvency</span>
                <span class="stat-value">99.2%</span>
                <span class="stat-desc text-success">Pass rate in current cycle</span>
            </div>
            <div class="stat-icon"><i class="bi bi-shield-check"></i></div>
        </div>
    </div> -->

    <div class="row g-3">
        <!-- Create Schedule Form -->
        <div class="col-lg-5">
            <div class="content-card">
                <div class="card-header">
                    <h5><i class="bi bi-calendar-plus-fill"></i> Schedule Inspection Work Order</h5>
                </div>
                <div class="card-body">
                    <form onsubmit="handleScheduleSubmit(event)" id="scheduleForm">
                        <div class="form-group-custom">
                            <label class="form-label-custom" for="schCoachId">Select Due Coach <span class="text-danger">*</span></label>
                            <select id="schCoachId" class="form-control-custom" required onchange="autoFillTrain()">
                                <option value="">Select Coach</option>
                                <option value="CR-223456" data-train="12002 - NDLS Shatabdi">CR-223456 (Due: Overdue)</option>
                                <option value="WR-193425" data-train="12952 - Mumbai Rajdhani">WR-193425 (Due: Overdue)</option>
                                <option value="NR-142211" data-train="12056 - Jan Shatabdi">NR-142211 (Due: Today)</option>
                                <option value="ER-202115" data-train="12260 - Sealdah Duronto">ER-202115 (Due: In 2 Days)</option>
                            </select>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom" for="schTrain">Train Assigned (Auto-detect)</label>
                            <input type="text" id="schTrain" class="form-control-custom" disabled value="-">
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom" for="schAuditorId">Assign Section Engineer <span class="text-danger">*</span></label>
                            <select id="schAuditorId" class="form-control-custom" required>
                                <option value="">Select Engineer</option>
                                <option value="1">Akhil Golu (Section Engineer)</option>
                                <option value="2">Subhash Bose (Senior Section Engineer)</option>
                                <option value="3">Dinesh Meena (Junior Engineer)</option>
                            </select>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom" for="schDateTime">Scheduled Date & Time <span class="text-danger">*</span></label>
                            <input type="datetime-local" id="schDateTime" class="form-control-custom" required>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="schType">Inspection Type <span class="text-danger">*</span></label>
                                    <select id="schType" class="form-control-custom" required>
                                        <option value="Calibration">Solenoid Calibration</option>
                                        <option value="SensorTest">Speed Sensor Test</option>
                                        <option value="PneumaticFlush">Pneumatic Line Flush</option>
                                        <option value="FullCheck">Full WSPS Diagnostic</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group-custom">
                                    <label class="form-label-custom" for="schPriority">Priority</label>
                                    <select id="schPriority" class="form-control-custom">
                                        <option value="Normal">Normal</option>
                                        <option value="Urgent">Urgent</option>
                                        <option value="Emergency">Emergency</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group-custom">
                            <label class="form-label-custom" for="schRemarks">Special Instructions / Remarks</label>
                            <textarea id="schRemarks" class="form-control-custom" style="height: 50px;" placeholder="Optional instruction details..."></textarea>
                        </div>

                        <div class="border-top pt-3 text-end">
                            <button type="button" class="btn-wsps btn-wsps-secondary" onclick="resetScheduleForm()">Clear</button>
                            <button type="submit" class="btn-wsps btn-wsps-primary"><i class="bi bi-check2-circle"></i> Create Work Order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Overdue / Due List Table -->
        <div class="col-lg-7">
            <div class="content-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5><i class="bi bi-clock-history"></i> WSPS Systems Requiring Calibration / Test</h5>
                    <span class="badge-custom badge-danger">Actions Needed</span>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive-custom">
                        <table class="table-custom" id="dueCoachesTable">
                            <thead>
                                <tr>
                                    <th>Coach No</th>
                                    <th>Coach Type</th>
                                    <th>Assigned Train</th>
                                    <th>Last Inspected</th>
                                    <th>Next Due Date</th>
                                    <th>Days Overdue</th>
                                    <th class="no-export">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr class="table-row-alert">
                                    <td><strong>CR-223456</strong></td>
                                    <td>LHB AC 3T</td>
                                    <td>12002 - Shatabdi</td>
                                    <td>25-May-2026</td>
                                    <td class="text-danger fw-bold">24-Jun-2026</td>
                                    <td class="text-danger fw-bold text-center">3 Days</td>
                                    <td class="no-export">
                                        <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="quickSchedule('CR-223456', '12002 - NDLS Shatabdi')"><i class="bi bi-calendar-plus"></i> Schedule</button>
                                    </td>
                                </tr>
                                <tr class="table-row-alert">
                                    <td><strong>WR-193425</strong></td>
                                    <td>LHB AC 2T</td>
                                    <td>12952 - Rajdhani</td>
                                    <td>20-May-2026</td>
                                    <td class="text-danger fw-bold">19-Jun-2026</td>
                                    <td class="text-danger fw-bold text-center">8 Days</td>
                                    <td class="no-export">
                                        <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="quickSchedule('WR-193425', '12952 - Mumbai Rajdhani')"><i class="bi bi-calendar-plus"></i> Schedule</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>NR-142211</strong></td>
                                    <td>LHB General</td>
                                    <td>12056 - Jan Shatabdi</td>
                                    <td>28-May-2026</td>
                                    <td class="text-warning fw-bold">27-Jun-2026</td>
                                    <td class="text-warning fw-bold text-center">Today</td>
                                    <td class="no-export">
                                        <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="quickSchedule('NR-142211', '12056 - Jan Shatabdi')"><i class="bi bi-calendar-plus"></i> Schedule</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td><strong>ER-202115</strong></td>
                                    <td>LHB AC 3T</td>
                                    <td>12260 - Duronto</td>
                                    <td>30-May-2026</td>
                                    <td>29-Jun-2026</td>
                                    <td class="text-center text-muted">In 2 Days</td>
                                    <td class="no-export">
                                        <button class="btn-wsps btn-wsps-primary btn-wsps-xs" onclick="quickSchedule('ER-202115', '12260 - Sealdah Duronto')"><i class="bi bi-calendar-plus"></i> Schedule</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Round Trip Schedule Modal -->
<div class="modal fade" id="roundTripModal" tabindex="-1" aria-labelledby="roundTripModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="roundTripModalLabel"><i class="bi bi-arrow-repeat text-primary"></i> Create Round-Trip Telemetry Work Order</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form onsubmit="handleRoundTripSubmit(event)">
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="rtTrainId">Select Active Train <span class="text-danger">*</span></label>
                        <select id="rtTrainId" class="form-control-custom" required>
                            <option value="">Select Train</option>
                            <option value="12002">12002 - NDLS Shatabdi</option>
                            <option value="12952">12952 - Mumbai Rajdhani</option>
                            <option value="12056">12056 - Jan Shatabdi</option>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="rtCoachId">Select Coach (Active In Selected Train) <span class="text-danger">*</span></label>
                        <select id="rtCoachId" class="form-control-custom" required>
                            <option value="">Select Coach</option>
                            <option value="1">All Coaches of Rake (Full Telemetry Test)</option>
                            <option value="CR-223456">CR-223456</option>
                            <option value="WR-193425">WR-193425</option>
                            <option value="NR-142211">NR-142211</option>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="rtAuditorId">Assign Section Engineer <span class="text-danger">*</span></label>
                        <select id="rtAuditorId" class="form-control-custom" required>
                            <option value="">Select Engineer</option>
                            <option value="1">Akhil Golu (Section Engineer)</option>
                            <option value="2">Subhash Bose (Senior Section Engineer)</option>
                        </select>
                    </div>

                    <div class="form-group-custom">
                        <label class="form-label-custom" for="rtDateTime">Scheduled Date & Time <span class="text-danger">*</span></label>
                        <input type="datetime-local" id="rtDateTime" class="form-control-custom" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary">Generate Round-Trip Work Order</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    function autoFillTrain() {
        const select = document.getElementById('schCoachId');
        const trainInput = document.getElementById('schTrain');
        const selectedOption = select.options[select.selectedIndex];
        
        if (selectedOption && selectedOption.value !== "") {
            trainInput.value = selectedOption.getAttribute('data-train');
        } else {
            trainInput.value = "-";
        }
    }

    function quickSchedule(coachNo, trainName) {
        const select = document.getElementById('schCoachId');
        select.value = coachNo;
        autoFillTrain();
        
        // Auto-set time to tomorrow noon
        const tomorrow = new Date();
        tomorrow.setDate(tomorrow.getDate() + 1);
        tomorrow.setHours(10, 0, 0, 0);
        
        const localISO = new Date(tomorrow.getTime() - (tomorrow.getTimezoneOffset() * 60000)).toISOString().slice(0, 16);
        document.getElementById('schDateTime').value = localISO;
        
        // Scroll to form
        document.getElementById('scheduleForm').scrollIntoView({ behavior: 'smooth' });
    }

    function resetScheduleForm() {
        document.getElementById('scheduleForm').reset();
        document.getElementById('schTrain').value = "-";
    }

    function handleScheduleSubmit(event) {
        event.preventDefault();
        alert('Diagnostic Calibration Schedule Created Successfully!\nWork Order uploaded to field terminals.');
        resetScheduleForm();
    }

    function handleRoundTripSubmit(event) {
        event.preventDefault();
        alert('Round-Trip Telemetry Work Order Generated Successfully!');
        bootstrap.Modal.getInstance(document.getElementById('roundTripModal')).hide();
    }
</script>

</body>
</html>
