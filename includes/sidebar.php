<?php
$current_page = basename($_SERVER['PHP_SELF']);
?>
<aside class="sidebar">
    <div class="sidebar-logo">
        <div class="sidebar-logo-icon">
            <i class="bi bi-shield-fill-check"></i>
        </div>
        <div class="sidebar-logo-text">
            <strong>WSPS PANEL</strong>
            <small>Indian Railways</small>
        </div>
    </div>

    <ul class="sidebar-menu">
        <li>
            <a href="index.php" class="<?php echo ($current_page == 'index.php' || $current_page == '') ? 'active' : ''; ?>">
                <i class="bi bi-speedometer2"></i>
                <span>Dashboard</span>
            </a>
        </li>
        <li>
            <a href="manufacturers.php" class="<?php echo ($current_page == 'manufacturers.php') ? 'active' : ''; ?>">
                <i class="bi bi-building"></i>
                <span>OEM / Manufacturers</span>
            </a>
        </li>
        <li>
            <a href="trains.php" class="<?php echo ($current_page == 'trains.php') ? 'active' : ''; ?>">
                <i class="bi bi-train-freight-front"></i>
                <span>Train Management</span>
            </a>
        </li>
        <li>
            <a href="coaches.php" class="<?php echo ($current_page == 'coaches.php') ? 'active' : ''; ?>">
                <i class="bi bi-box-seam"></i>
                <span>Coach Management</span>
            </a>
        </li>
        <li>
            <a href="inventory.php" class="<?php echo ($current_page == 'inventory.php') ? 'active' : ''; ?>">
                <i class="bi bi-boxes"></i>
                <span>Inventory Depot</span>
            </a>
        </li>
        <li>
            <a href="inspection-schedule.php" class="<?php echo ($current_page == 'inspection-schedule.php') ? 'active' : ''; ?>">
                <i class="bi bi-calendar-check"></i>
                <span>Create Schedule</span>
            </a>
        </li>
        <li>
            <a href="schedule-list.php" class="<?php echo ($current_page == 'schedule-list.php') ? 'active' : ''; ?>">
                <i class="bi bi-calendar-range"></i>
                <span>View Schedule</span>
            </a>
        </li>
    
     
        <li>
            <a href="error-codes.php" class="<?php echo ($current_page == 'error-codes.php') ? 'active' : ''; ?>">
                <i class="bi bi-bug"></i>
                <span>MMI Error Codes</span>
            </a>
        </li>
        <li>
            <a href="reports.php" class="<?php echo ($current_page == 'reports.php') ? 'active' : ''; ?>">
                <i class="bi bi-file-earmark-bar-graph"></i>
                <span>Reports</span>
            </a>
        </li>
        <li>
            <a href="users.php" class="<?php echo ($current_page == 'users.php') ? 'active' : ''; ?>">
                <i class="bi bi-people"></i>
                <span>User Management</span>
            </a>
        </li>
  
        <li>
            <a href="settings.php" class="<?php echo ($current_page == 'settings.php') ? 'active' : ''; ?>">
                <i class="bi bi-sliders"></i>
                <span>Settings</span>
            </a>
        </li>
    </ul>
</aside>
