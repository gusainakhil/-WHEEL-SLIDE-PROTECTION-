<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Management - Wheel Slide Protection System (WSPS)</title>
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
            <h1>Spare Component Inventory Depot</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Inventory</li>
                </ol>
            </nav>
        </div>
        <div class="page-header-actions no-print">
            <button class="btn-wsps btn-wsps-primary" id="addItemBtn" data-bs-toggle="modal" data-bs-target="#inventoryModal"><i class="bi bi-plus-circle"></i> Add Spare Component</button>
            <button class="btn-wsps btn-wsps-secondary" onclick="exportTableToExcel('inventoryTable', 'wsps-inventory-stock')"><i class="bi bi-file-earmark-excel"></i> Export Inventory</button>
        </div>
    </div>

    <!-- Stats Cards -->
    <!-- <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-info">
                <span class="stat-label">Total Stock Items</span>
                <span class="stat-value">182 Units</span>
                <span class="stat-desc">Across all categories</span>
            </div>
            <div class="stat-icon"><i class="bi bi-boxes"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Speed Sensors</span>
                <span class="stat-value">42 Units</span>
                <span class="stat-desc text-success">Phasing sensor spares</span>
            </div>
            <div class="stat-icon"><i class="bi bi-broadcast-pin"></i></div>
        </div>
        <div class="stat-card success">
            <div class="stat-info">
                <span class="stat-label">Solenoid Dump Valves</span>
                <span class="stat-value">18 Units</span>
                <span class="stat-desc text-success">Pneumatic valve assemblies</span>
            </div>
            <div class="stat-icon"><i class="bi bi-wind"></i></div>
        </div>
        <div class="stat-card danger">
            <div class="stat-info">
                <span class="stat-label">Low Stock Alerts</span>
                <span class="stat-value">2 Items</span>
                <span class="stat-desc text-danger"><i class="bi bi-exclamation-triangle"></i> Requires procurement release</span>
            </div>
            <div class="stat-icon"><i class="bi bi-x-octagon"></i></div>
        </div>
        <div class="stat-card secondary">
            <div class="stat-info">
                <span class="stat-label">Depot Valuation</span>
                <span class="stat-value">₹24,500</span>
                <span class="stat-desc text-success">RDSO verified stock</span>
            </div>
            <div class="stat-icon"><i class="bi bi-currency-rupee"></i></div>
        </div>
    </div> -->

    <!-- Filter & Search Panel -->
    <div class="content-card no-print">
        <div class="card-body">
            <div class="row g-2">
                <div class="col-md-4">
                    <label class="form-label-custom" for="invSearchInput">Search Inventory Depot</label>
                    <input type="text" id="invSearchInput" class="form-control-custom" placeholder="Search by Item Code, Name, or Category...">
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="invCategoryFilter">Filter by Category</label>
                    <select id="invCategoryFilter" class="form-control-custom">
                        <option value="">All Categories</option>
                        <option value="SENSORS">Sensing Systems</option>
                        <option value="VALVES">Valve Assemblies</option>
                        <option value="CONTROLLERS">Controller Spares</option>
                        <option value="CABLES">Wiring & Junctions</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label class="form-label-custom" for="invStatusFilter">Filter by Stock Status</label>
                    <select id="invStatusFilter" class="form-control-custom">
                        <option value="">All Statuses</option>
                        <option value="IN STOCK">In Stock</option>
                        <option value="LOW STOCK">Low Stock</option>
                        <option value="OUT OF STOCK">Out of Stock</option>
                    </select>
                </div>
                <div class="col-md-2 d-flex align-items-end">
                    <button class="btn-wsps btn-wsps-secondary w-100" onclick="resetFilters()"><i class="bi bi-arrow-counterclockwise"></i> Reset</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Inventory Table -->
    <div class="content-card">
        <div class="card-header">
            <h5><i class="bi bi-boxes"></i> WSPS Protective Components Inventory Ledger</h5>
            <span class="text-muted" style="font-size: 11px;">Showing 6 Component Items</span>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive-custom">
                <table class="table-custom" id="inventoryTable">
                    <thead>
                        <tr>
                            <th>Item Code</th>
                            <th>Category</th>
                            <th>Item Name</th>
                            <th>In Stock Qty</th>
                            <th>Unit Price</th>
                            <th>Reorder Threshold</th>
                            <th>Status</th>
                            <th>Last Updated</th>
                            <th class="no-export">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong>INV-WSPS-001</strong></td>
                            <td>Sensing Systems</td>
                            <td>Phasing Speed Sensor LHB (Fiat Bogie)</td>
                            <td class="text-center fw-bold">42</td>
                            <td>₹4,500</td>
                            <td class="text-center text-muted">15</td>
                            <td><span class="badge-custom badge-success">IN STOCK</span></td>
                            <td>25-Jun-2026 10:12 AM</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editItem('INV-WSPS-001', 'Sensing Systems', 'Phasing Speed Sensor LHB (Fiat Bogie)', 42, 4500, 15)" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('INV-WSPS-001')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>INV-WSPS-002</strong></td>
                            <td>Valve Assemblies</td>
                            <td>Solenoid Dump Valve LHB (Faiveley Standard)</td>
                            <td class="text-center fw-bold">18</td>
                            <td>₹12,000</td>
                            <td class="text-center text-muted">10</td>
                            <td><span class="badge-custom badge-success">IN STOCK</span></td>
                            <td>25-Jun-2026 10:12 AM</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editItem('INV-WSPS-002', 'Valve Assemblies', 'Solenoid Dump Valve LHB (Faiveley Standard)', 18, 12000, 10)" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('INV-WSPS-002')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="table-row-alert">
                            <td><strong>INV-WSPS-003</strong></td>
                            <td>Controller Spares</td>
                            <td>WSPS Main Processor Card v9.8 (Medha)</td>
                            <td class="text-center fw-bold text-danger">2</td>
                            <td>₹45,000</td>
                            <td class="text-center text-muted">5</td>
                            <td><span class="badge-custom badge-danger">LOW STOCK</span></td>
                            <td>24-Jun-2026 04:30 PM</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editItem('INV-WSPS-003', 'Controller Spares', 'WSPS Main Processor Card v9.8 (Medha)', 2, 45000, 5)" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('INV-WSPS-003')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>INV-WSPS-004</strong></td>
                            <td>Wiring & Junctions</td>
                            <td>Bogie Sensor Junction Box (LHB Fiat Type)</td>
                            <td class="text-center fw-bold">25</td>
                            <td>₹3,200</td>
                            <td class="text-center text-muted">10</td>
                            <td><span class="badge-custom badge-success">IN STOCK</span></td>
                            <td>25-Jun-2026 09:15 AM</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editItem('INV-WSPS-004', 'Wiring & Junctions', 'Bogie Sensor Junction Box (LHB Fiat Type)', 25, 3200, 10)" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('INV-WSPS-004')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr class="table-row-alert">
                            <td><strong>INV-WSPS-005</strong></td>
                            <td>Valve Assemblies</td>
                            <td>Solenoid Coil replacement (Knorr Type)</td>
                            <td class="text-center fw-bold text-danger">0</td>
                            <td>₹1,800</td>
                            <td class="text-center text-muted">8</td>
                            <td><span class="badge-custom badge-secondary">OUT OF STOCK</span></td>
                            <td>20-Jun-2026 11:00 AM</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editItem('INV-WSPS-005', 'Valve Assemblies', 'Solenoid Coil replacement (Knorr Type)', 0, 1800, 8)" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('INV-WSPS-005')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                        <tr>
                            <td><strong>INV-WSPS-006</strong></td>
                            <td>Sensing Systems</td>
                            <td>Axle Grounding Earth Brush Set (LHB Standard)</td>
                            <td class="text-center fw-bold">95</td>
                            <td>₹600</td>
                            <td class="text-center text-muted">20</td>
                            <td><span class="badge-custom badge-success">IN STOCK</span></td>
                            <td>25-Jun-2026 09:00 AM</td>
                            <td class="no-export">
                                <button class="btn-wsps btn-wsps-secondary btn-wsps-xs" onclick="editItem('INV-WSPS-006', 'Sensing Systems', 'Axle Grounding Earth Brush Set (LHB Standard)', 95, 600, 20)" title="Edit"><i class="bi bi-pencil"></i></button>
                                <button class="btn-wsps btn-wsps-danger btn-wsps-xs" onclick="confirmDelete('INV-WSPS-006')" title="Delete"><i class="bi bi-trash"></i></button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="pagination-custom no-print">
                <span>Showing 1 to 6 of 6 components</span>
                <div class="pagination-buttons">
                    <a href="#" class="pagination-btn disabled"><i class="bi bi-chevron-left"></i></a>
                    <a href="#" class="pagination-btn active">1</a>
                    <a href="#" class="pagination-btn disabled"><i class="bi bi-chevron-right"></i></a>
                </div>
            </div>
        </div>
    </div>
</main>

<!-- Inventory Add / Edit Modal -->
<div class="modal fade" id="inventoryModal" tabindex="-1" aria-labelledby="inventoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="inventoryModalLabel"><i class="bi bi-boxes text-primary"></i> Add Spare Component</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="inventoryForm" onsubmit="handleFormSubmit(event)">
                <div class="modal-body">
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalItemCode">Item Code <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalItemCode" required placeholder="e.g., INV-WSPS-007">
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalCategory">Category <span class="text-danger">*</span></label>
                        <select id="modalCategory" class="form-control-custom" required>
                            <option value="Sensing Systems">Sensing Systems</option>
                            <option value="Valve Assemblies">Valve Assemblies</option>
                            <option value="Controller Spares">Controller Spares</option>
                            <option value="Wiring & Junctions">Wiring & Junctions</option>
                        </select>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalItemName">Component Name <span class="text-danger">*</span></label>
                        <input type="text" class="form-control-custom" id="modalItemName" required placeholder="e.g., Sab WABCO cylinder replacement">
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalQty">Initial In Stock Qty <span class="text-danger">*</span></label>
                                <input type="number" class="form-control-custom" id="modalQty" required min="0" value="10">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group-custom">
                                <label class="form-label-custom" for="modalPrice">Unit Price (₹) <span class="text-danger">*</span></label>
                                <input type="number" class="form-control-custom" id="modalPrice" required min="0" value="4500">
                            </div>
                        </div>
                    </div>
                    <div class="form-group-custom">
                        <label class="form-label-custom" for="modalThreshold">Reorder Low Stock Threshold <span class="text-danger">*</span></label>
                        <input type="number" class="form-control-custom" id="modalThreshold" required min="1" value="5">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn-wsps btn-wsps-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn-wsps btn-wsps-primary" id="inventorySubmitBtn">Register Component</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'includes/footer.php'; ?>

<script>
    // Search table
    searchTable('invSearchInput', 'inventoryTable');

    // Filters
    const catFilter = document.getElementById('invCategoryFilter');
    const statusFilter = document.getElementById('invStatusFilter');

    function applyFilters() {
        const catVal = catFilter.value.toLowerCase();
        const statVal = statusFilter.value.toLowerCase();
        const rows = document.querySelectorAll('#inventoryTable tbody tr');

        rows.forEach(row => {
            const catCell = row.cells[1].textContent.toLowerCase();
            const statCell = row.cells[6].textContent.toLowerCase();

            const matchesCat = catVal === "" || catCell.indexOf(catVal) > -1;
            const matchesStat = statVal === "" || statCell.indexOf(statVal) > -1;

            row.style.display = (matchesCat && matchesStat) ? "" : "none";
        });
    }

    catFilter.addEventListener('change', applyFilters);
    statusFilter.addEventListener('change', applyFilters);

    function resetFilters() {
        catFilter.value = "";
        statusFilter.value = "";
        document.getElementById('invSearchInput').value = "";
        applyFilters();
        document.querySelectorAll('#inventoryTable tbody tr').forEach(r => r.style.display = "");
    }

    // Modal Operations
    const invModalEl = document.getElementById('inventoryModal');
    const addItemBtn = document.getElementById('addItemBtn');
    const invModalLabel = document.getElementById('inventoryModalLabel');
    const invSubmitBtn = document.getElementById('inventorySubmitBtn');

    function resetInventoryForm() {
        document.getElementById('modalItemCode').value = "";
        document.getElementById('modalItemCode').disabled = false;
        document.getElementById('modalCategory').value = "Sensing Systems";
        document.getElementById('modalItemName').value = "";
        document.getElementById('modalQty').value = "10";
        document.getElementById('modalPrice').value = "4500";
        document.getElementById('modalThreshold').value = "5";

        invModalLabel.innerHTML = `<i class="bi bi-boxes text-primary"></i> Add Spare Component`;
        invSubmitBtn.textContent = "Register Component";
    }

    function editItem(code, cat, name, qty, price, threshold) {
        document.getElementById('modalItemCode').value = code;
        document.getElementById('modalItemCode').disabled = true;
        document.getElementById('modalCategory').value = cat;
        document.getElementById('modalItemName').value = name;
        document.getElementById('modalQty').value = qty;
        document.getElementById('modalPrice').value = price;
        document.getElementById('modalThreshold').value = threshold;

        invModalLabel.innerHTML = `<i class="bi bi-pencil-square text-primary"></i> Edit Spare Component`;
        invSubmitBtn.textContent = "Update Component";
        
        new bootstrap.Modal(invModalEl).show();
    }

    function confirmDelete(code) {
        if (confirm(`Are you sure you want to delete component '${code}' from depot storage registry?`)) {
            alert(`Component '${code}' deleted successfully.`);
        }
    }

    function handleFormSubmit(event) {
        event.preventDefault();
        alert('Component stock registry successfully updated!');
        bootstrap.Modal.getInstance(invModalEl).hide();
    }

    if (addItemBtn) {
        addItemBtn.addEventListener('click', resetInventoryForm);
    }
    
    invModalEl.addEventListener('hidden.bs.modal', resetInventoryForm);
</script>

</body>
</html>
