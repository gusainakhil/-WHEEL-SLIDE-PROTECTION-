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
    <style>
        .calendar-container {
            background: #fff;
            border-radius: 8px;
            border: 1px solid #dee2e6;
            padding: 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.02);
            font-family: 'Inter', sans-serif;
        }
        .calendar-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            border-bottom: 2px dashed #e9ecef;
            padding-bottom: 12px;
        }
        .calendar-header h3 {
            margin: 0;
            font-weight: 700;
            color: #0b4f8a;
        }
        .calendar-grid {
            display: grid;
            grid-template-columns: repeat(7, 1fr);
            gap: 8px;
        }
        .calendar-day-header {
            text-align: center;
            font-weight: 600;
            color: #6c757d;
            font-size: 11px;
            text-transform: uppercase;
            padding-bottom: 8px;
            border-bottom: 1px solid #dee2e6;
        }
        .calendar-day {
            min-height: 95px;
            background-color: #f8f9fa;
            border: 1px solid #e9ecef;
            border-radius: 4px;
            padding: 6px;
            display: flex;
            flex-direction: column;
            justify-content: flex-start;
            position: relative;
            transition: background-color 0.2s ease, border-color 0.2s ease;
        }
        .calendar-day:hover {
            background-color: #f1f3f5;
            border-color: #ced4da;
        }
        .calendar-day.empty {
            background-color: transparent;
            border: none;
            pointer-events: none;
        }
        .calendar-day-number {
            font-weight: 700;
            font-size: 12px;
            color: #495057;
            margin-bottom: 6px;
            text-align: right;
        }
        .calendar-day.today {
            background-color: #e8f4fd;
            border-color: #a5d0f5;
        }
        .calendar-day.today .calendar-day-number {
            color: #0b4f8a;
            font-size: 13px;
        }
        .calendar-badge {
            font-size: 9px;
            font-weight: 600;
            padding: 4px 6px;
            border-radius: 3px;
            margin-top: 4px;
            cursor: pointer;
            display: block;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            border-left: 3px solid transparent;
            text-align: left;
            transition: transform 0.15s ease;
        }
        .calendar-badge:hover {
            transform: scale(1.02);
            opacity: 0.9;
        }
        .calendar-badge.emergency {
            background-color: #fde8e8;
            color: #c81e1e;
            border-left-color: #c81e1e;
        }
        .calendar-badge.urgent {
            background-color: #fef3c7;
            color: #92400e;
            border-left-color: #d97706;
        }
        .calendar-badge.normal {
            background-color: #e1f5fe;
            color: #0277bd;
            border-left-color: #0288d1;
        }
        .calendar-badge.completed {
            background-color: #def7ec;
            color: #03543f;
            border-left-color: #31c48d;
        }
        .calendar-nav-btn {
            background: none;
            border: 1px solid #dee2e6;
            padding: 6px 12px;
            border-radius: 4px;
            font-size: 12px;
            color: #495057;
            font-weight: 500;
            transition: all 0.2s ease;
        }
        .calendar-nav-btn:hover {
            background-color: #f8f9fa;
            border-color: #ced4da;
        }
        .legend-container {
            display: flex;
            gap: 15px;
            margin-top: 15px;
            padding-top: 10px;
            border-top: 1px solid #eee;
            font-size: 11px;
            flex-wrap: wrap;
        }
        .legend-item {
            display: flex;
            align-items: center;
            gap: 6px;
            font-weight: 500;
            color: #495057;
        }
        .legend-color {
            width: 12px;
            height: 12px;
            border-radius: 3px;
            display: inline-block;
        }
    </style>
</head>
<body>

<?php include 'includes/navbar.php'; ?>
<?php include 'includes/sidebar.php'; ?>

<main class="main-content">
    <!-- Page Header & Breadcrumbs -->
    <div class="page-header">
        <div class="page-header-title-area">
            <h1>Maintenance & Calibration Calendar</h1>
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
            <button class="btn-wsps btn-wsps-secondary" onclick="window.print()"><i class="bi bi-printer"></i> Print Calendar</button>
        </div>
    </div>

    <!-- Calendar Card Container -->
    <div class="content-card">
        <div class="calendar-container">
            <div class="calendar-header">
                <button class="calendar-nav-btn" onclick="prevMonth()"><i class="bi bi-chevron-left"></i> Previous Month</button>
                <h3 id="calendarMonthYear">June 2026</h3>
                <button class="calendar-nav-btn" onclick="nextMonth()">Next Month <i class="bi bi-chevron-right"></i></button>
            </div>
            
            <div class="calendar-grid" id="calendarGridBody">
                <!-- Dynamically generated calendar month structure will reside here -->
            </div>

            <!-- Calendar Legend -->
            <div class="legend-container">
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #fde8e8; border-left: 3px solid #c81e1e;"></span>
                    <span>Emergency Priority</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #fef3c7; border-left: 3px solid #d97706;"></span>
                    <span>Urgent Priority</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #e1f5fe; border-left: 3px solid #0288d1;"></span>
                    <span>Normal Priority</span>
                </div>
                <div class="legend-item">
                    <span class="legend-color" style="background-color: #def7ec; border-left: 3px solid #31c48d;"></span>
                    <span>Completed Tasks</span>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Details Modal Viewer -->
<div class="modal fade" id="scheduleDetailModal" tabindex="-1" aria-labelledby="scheduleDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-light">
                <h5 class="modal-title fw-bold" id="scheduleDetailModalLabel"><i class="bi bi-calendar2-info text-primary"></i> Work Order Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-0">
                <table class="table table-bordered mb-0" style="font-size: 12px;">
                    <tbody>
                        <tr>
                            <td class="bg-light fw-bold" style="width: 150px;">Work Order ID</td>
                            <td id="modalWoId" class="fw-bold text-primary"></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Train No / Name</td>
                            <td id="modalTrain"></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Coach No</td>
                            <td id="modalCoach" class="fw-bold"></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Test / Inspection Type</td>
                            <td id="modalType"></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Assigned Engineer</td>
                            <td id="modalEngineer"></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Scheduled Time</td>
                            <td id="modalTime"></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Priority Level</td>
                            <td><span id="modalPriority"></span></td>
                        </tr>
                        <tr>
                            <td class="bg-light fw-bold">Status</td>
                            <td><span id="modalStatus"></span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer bg-light py-2">
                <button type="button" class="btn-wsps btn-wsps-secondary py-1" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>

<script>
    // Data list of all work orders
    const workOrders = [
        {
            id: 'WO-10101',
            coach: 'CR-223456',
            train: '12002 - NDLS Shatabdi',
            engineer: 'Akhil Golu (SE)',
            date: '2026-06-28',
            time: '10:00 AM',
            type: 'Solenoid Calibration',
            priority: 'EMERGENCY',
            status: 'ASSIGNED'
        },
        {
            id: 'WO-10102',
            coach: 'WR-193425',
            train: '12952 - Mumbai Rajdhani',
            engineer: 'Subhash Bose (SSE)',
            date: '2026-06-28',
            time: '11:30 AM',
            type: 'Speed Sensor Test',
            priority: 'URGENT',
            status: 'ASSIGNED'
        },
        {
            id: 'WO-10098',
            coach: 'NR-142211',
            train: '12056 - Jan Shatabdi',
            engineer: 'Dinesh Meena (JE)',
            date: '2026-06-27',
            time: '09:30 AM',
            type: 'Full WSPS Diagnostic',
            priority: 'NORMAL',
            status: 'IN PROGRESS'
        },
        {
            id: 'WO-10095',
            coach: 'ER-202115',
            train: '12260 - Duronto Exp',
            engineer: 'Akhil Golu (SE)',
            date: '2026-06-26',
            time: '02:00 PM',
            type: 'Pneumatic Line Flush',
            priority: 'NORMAL',
            status: 'COMPLETED'
        },
        {
            id: 'WO-10092',
            coach: 'SR-220015',
            train: 'Detached / In Shop',
            engineer: 'Subhash Bose (SSE)',
            date: '2026-06-25',
            time: '04:30 PM',
            type: 'Solenoid Calibration',
            priority: 'NORMAL',
            status: 'COMPLETED'
        },
        {
            id: 'WO-10085',
            coach: 'CR-223490',
            train: '12002 - NDLS Shatabdi',
            engineer: 'Dinesh Meena (JE)',
            date: '2026-06-15',
            time: '11:00 AM',
            type: 'Speed Sensor Test',
            priority: 'NORMAL',
            status: 'COMPLETED'
        },
        {
            id: 'WO-10080',
            coach: 'WR-193444',
            train: '12952 - Mumbai Rajdhani',
            engineer: 'Akhil Golu (SE)',
            date: '2026-06-10',
            time: '09:00 AM',
            type: 'Solenoid Calibration',
            priority: 'URGENT',
            status: 'COMPLETED'
        },
        {
            id: 'WO-10089',
            coach: 'ER-202188',
            train: '12260 - Duronto Exp',
            engineer: 'Subhash Bose (SSE)',
            date: '2026-06-22',
            time: '03:15 PM',
            type: 'Full WSPS Diagnostic',
            priority: 'NORMAL',
            status: 'COMPLETED'
        },
        {
            id: 'WO-10105',
            coach: 'NR-142289',
            train: '12056 - Jan Shatabdi',
            engineer: 'Akhil Golu (SE)',
            date: '2026-06-29',
            time: '08:30 AM',
            type: 'Pneumatic Line Flush',
            priority: 'NORMAL',
            status: 'ASSIGNED'
        },
        {
            id: 'WO-10106',
            coach: 'SR-220088',
            train: 'Detached / In Shop',
            engineer: 'Dinesh Meena (JE)',
            date: '2026-06-30',
            time: '02:00 PM',
            type: 'Solenoid Calibration',
            priority: 'EMERGENCY',
            status: 'ASSIGNED'
        }
    ];

    // Current displayed Month & Year
    let currentYear = 2026;
    let currentMonth = 5; // 0-indexed (June is 5)

    const monthNames = [
        "January", "February", "March", "April", "May", "June",
        "July", "August", "September", "October", "November", "December"
    ];

    function showScheduleDetail(id) {
        const item = workOrders.find(w => w.id === id);
        if (!item) return;

        document.getElementById('modalWoId').textContent = '#' + item.id;
        document.getElementById('modalCoach').textContent = item.coach;
        document.getElementById('modalTrain').textContent = item.train;
        document.getElementById('modalEngineer').textContent = item.engineer;
        document.getElementById('modalTime').textContent = `${item.date.split('-').reverse().join('.')} at ${item.time}`;
        document.getElementById('modalType').textContent = item.type;
        
        const priorityBadge = document.getElementById('modalPriority');
        priorityBadge.textContent = item.priority;
        if (item.priority === 'EMERGENCY') {
            priorityBadge.className = 'badge bg-danger';
        } else if (item.priority === 'URGENT') {
            priorityBadge.className = 'badge bg-warning text-dark';
        } else {
            priorityBadge.className = 'badge bg-primary';
        }

        const statusBadge = document.getElementById('modalStatus');
        statusBadge.textContent = item.status;
        if (item.status === 'COMPLETED') {
            statusBadge.className = 'badge bg-success';
        } else if (item.status === 'IN PROGRESS') {
            statusBadge.className = 'badge bg-info text-dark';
        } else {
            statusBadge.className = 'badge bg-warning text-dark';
        }

        const modal = new bootstrap.Modal(document.getElementById('scheduleDetailModal'));
        modal.show();
    }

    function renderCalendar(year, month) {
        const firstDay = new Date(year, month, 1).getDay();
        const daysInMonth = new Date(year, month + 1, 0).getDate();
        
        document.getElementById('calendarMonthYear').textContent = `${monthNames[month]} ${year}`;
        
        const grid = document.getElementById('calendarGridBody');
        grid.innerHTML = '';
        
        // Days of week header
        const daysOfWeek = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        daysOfWeek.forEach(d => {
            const h = document.createElement('div');
            h.className = 'calendar-day-header';
            h.textContent = d;
            grid.appendChild(h);
        });
        
        // Empty cells before first day
        for (let i = 0; i < firstDay; i++) {
            const emptyCell = document.createElement('div');
            emptyCell.className = 'calendar-day empty';
            grid.appendChild(emptyCell);
        }
        
        // Days cells
        for (let day = 1; day <= daysInMonth; day++) {
            const cell = document.createElement('div');
            cell.className = 'calendar-day';
            
            // Check if it's "today" (simulating 29-Jun-2026)
            if (year === 2026 && month === 5 && day === 29) {
                cell.className += ' today';
            }
            
            const num = document.createElement('div');
            num.className = 'calendar-day-number';
            num.textContent = day;
            cell.appendChild(num);
            
            // Format date string for search matching
            const dayStr = day < 10 ? '0' + day : '' + day;
            const monthStr = (month + 1) < 10 ? '0' + (month + 1) : '' + (month + 1);
            const dateStr = `${year}-${monthStr}-${dayStr}`;
            
            // Find items on this date
            const items = workOrders.filter(w => w.date === dateStr);
            items.forEach(item => {
                const badge = document.createElement('span');
                
                let pClass = 'normal';
                if (item.status === 'COMPLETED') {
                    pClass = 'completed';
                } else if (item.priority === 'EMERGENCY') {
                    pClass = 'emergency';
                } else if (item.priority === 'URGENT') {
                    pClass = 'urgent';
                }
                
                badge.className = `calendar-badge ${pClass}`;
                const trainNo = item.train.includes(' - ') ? item.train.split(' - ')[0] : item.train.split(' ')[0];
                badge.textContent = `${trainNo} / ${item.coach}`;
                badge.onclick = (e) => {
                    e.stopPropagation();
                    showScheduleDetail(item.id);
                };
                cell.appendChild(badge);
            });
            
            grid.appendChild(cell);
        }
    }

    function prevMonth() {
        currentMonth--;
        if (currentMonth < 0) {
            currentMonth = 11;
            currentYear--;
        }
        renderCalendar(currentYear, currentMonth);
    }

    function nextMonth() {
        currentMonth++;
        if (currentMonth > 11) {
            currentMonth = 0;
            currentYear++;
        }
        renderCalendar(currentYear, currentMonth);
    }

    // Initialize calendar
    document.addEventListener('DOMContentLoaded', () => {
        renderCalendar(currentYear, currentMonth);
    });
</script>

</body>
</html>
