/**
 * WSPS Dashboard Shared JavaScript
 */

document.addEventListener('DOMContentLoaded', function () {
    // 1. Sidebar Toggle
    const toggleSidebarBtn = document.getElementById('toggleSidebarBtn');
    if (toggleSidebarBtn) {
        toggleSidebarBtn.addEventListener('click', function () {
            document.body.classList.toggle('sidebar-collapsed');
            
            // Save state to localStorage
            const isCollapsed = document.body.classList.contains('sidebar-collapsed');
            localStorage.setItem('wsps-sidebar-collapsed', isCollapsed ? 'true' : 'false');
        });
    }

    // Restore Sidebar State on Load
    const savedSidebarState = localStorage.getItem('wsps-sidebar-collapsed');
    if (savedSidebarState === 'true') {
        document.body.classList.add('sidebar-collapsed');
    }

    // 2. Alert Auto-Dismiss
    const alerts = document.querySelectorAll('.alert-dismissible');
    alerts.forEach(function (alert) {
        setTimeout(function () {
            const bsAlert = new bootstrap.Alert(alert);
            bsAlert.close();
        }, 5000);
    });
});

/**
 * Reusable Client-Side Table Search & Filter
 * @param {string} inputId - ID of the search input field
 * @param {string} tableId - ID of the table to filter
 * @param {number} colIndex - Index of the column to search (optional, searches all columns if null)
 */
function searchTable(inputId, tableId, colIndex = null) {
    const input = document.getElementById(inputId);
    const table = document.getElementById(tableId);
    if (!input || !table) return;

    input.addEventListener('keyup', function () {
        const filter = input.value.toLowerCase().trim();
        const rows = table.querySelectorAll('tbody tr');

        rows.forEach(row => {
            if (row.querySelector('td[colspan]')) return; // Skip empty/no data rows

            let textToSearch = "";
            if (colIndex !== null) {
                const cell = row.cells[colIndex];
                textToSearch = cell ? cell.textContent : "";
            } else {
                textToSearch = row.textContent;
            }

            if (textToSearch.toLowerCase().indexOf(filter) > -1) {
                row.style.display = "";
            } else {
                row.style.display = "none";
            }
        });
    });
}

/**
 * Export HTML Table to Excel (.xls) file
 * @param {string} tableId - ID of the table to export
 * @param {string} filename - Desired export filename
 */
function exportTableToExcel(tableId, filename) {
    const sourceTable = document.getElementById(tableId);
    if (!sourceTable) return;

    // Clone table to avoid modifying the visual UI
    const exportTable = sourceTable.cloneNode(true);

    // Remove elements marked as no-export
    exportTable.querySelectorAll('.no-export').forEach(el => el.remove());

    // Remove hidden rows (filtered out rows)
    const rows = Array.from(exportTable.querySelectorAll('tbody tr'));
    rows.forEach(row => {
        if (row.style.display === 'none') {
            row.remove();
        }
    });

    const date = new Date().toISOString().slice(0, 10);
    const finalFilename = `${filename}-${date}.xls`;

    const workbookHtml = `
        <html xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:x="urn:schemas-microsoft-com:office:excel" xmlns="http://www.w3.org/TR/REC-html40">
            <head>
                <meta charset="UTF-8">
                <!--[if gte mso 9]>
                <xml>
                    <x:ExcelWorkbook>
                        <x:ExcelWorksheets>
                            <x:ExcelWorksheet>
                                <x:Name>WSPS Report</x:Name>
                                <x:WorksheetOptions>
                                    <x:DisplayGridlines/>
                                </x:WorksheetOptions>
                            </x:ExcelWorksheet>
                        </x:ExcelWorksheets>
                    </x:ExcelWorkbook>
                </xml>
                <![endif]-->
                <style>
                    table { border-collapse: collapse; width: 100%; font-family: sans-serif; font-size: 11px; }
                    th { background-color: #0B4F8A; color: #ffffff; font-weight: bold; border: 1px solid #CBD5E1; padding: 6px; }
                    td { border: 1px solid #CBD5E1; padding: 6px; text-align: left; }
                </style>
            </head>
            <body>
                <h2>Wheel Slide Protection System (WSPS) - Exported Data</h2>
                <p>Report Generated: ${new Date().toLocaleString()}</p>
                ${exportTable.outerHTML}
            </body>
        </html>
    `;

    const blob = new Blob([workbookHtml], {
        type: 'application/vnd.ms-excel;charset=utf-8;'
    });
    
    const link = document.createElement('a');
    link.href = URL.createObjectURL(blob);
    link.download = finalFilename;
    document.body.appendChild(link);
    link.click();
    document.body.removeChild(link);
    URL.revokeObjectURL(link.href);
}
