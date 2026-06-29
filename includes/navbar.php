<nav class="navbar-custom">
    <div class="navbar-left">
        <button class="toggle-sidebar-btn" id="toggleSidebarBtn" aria-label="Toggle Navigation Sidebar">
            <i class="bi bi-list"></i>
        </button>
        <a href="index.php" class="navbar-brand">
            <i class="bi bi-train-front-fill fs-4 text-white"></i>
            <span class="d-none d-sm-inline">WHEEL SLIDE PROTECTION SYSTEM (WSPS)</span>
            <span class="d-inline d-sm-none">WSPS Panel</span>
        </a>
    </div>

    <div class="navbar-right">
        <div class="system-time-ticker">
            <i class="bi bi-clock-fill text-warning"></i>
            <span id="wspsSystemTime">25-Jun-2026 15:00:00</span>
        </div>
        
        <div class="user-profile dropdown">
            <div class="d-flex align-items-center gap-2 text-white" id="userProfileMenu" data-bs-toggle="dropdown" aria-expanded="false">
                <div class="avatar-circle bg-white text-primary rounded-circle d-flex align-items-center justify-content-center" style="width: 32px; height: 32px; font-weight: 700; font-size: 14px;">
                    SE
                </div>
                <div class="user-details d-none d-md-flex">
                    <strong>Akhil Golu</strong>
                    <small>Section Engineer (C&W)</small>
                </div>
                <i class="bi bi-chevron-down ms-1 fs-8"></i>
            </div>
            <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="userProfileMenu">
                <li><a class="dropdown-item py-2 text-dark" href="settings.php"><i class="bi bi-gear me-2 text-primary"></i>Profile Settings</a></li>
                <li><a class="dropdown-item py-2 text-dark" href="audit-logs.php"><i class="bi bi-journal-text me-2 text-primary"></i>Activity Log</a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item py-2 text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a></li>
            </ul>
        </div>
    </div>
</nav>

<script>
    // Real-time system clock update
    function updateWSPSTime() {
        const timeSpan = document.getElementById('wspsSystemTime');
        if (timeSpan) {
            const now = new Date();
            const day = String(now.getDate()).padStart(2, '0');
            const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
            const month = months[now.getMonth()];
            const year = now.getFullYear();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            timeSpan.textContent = `${day}-${month}-${year} ${hours}:${minutes}:${seconds}`;
        }
    }
    setInterval(updateWSPSTime, 1000);
    updateWSPSTime();
</script>
