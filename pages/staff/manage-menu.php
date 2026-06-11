<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/staff.css?v=2">
</head>
<body>

    <div class="staff-layout">
        <aside class="staff-sidebar" id="staffSidebar">
            <div class="sidebar-header">
                <img src="../../assets/images/Logo.jpeg" alt="Logo" class="sidebar-logo">
                <h2>Staff Panel</h2>
            </div>
            <nav class="sidebar-nav">
                <a href="dashboard.php" class="nav-item"><i class="fas fa-th-large"></i> Dashboard</a>
                <a href="manage-orders.php" class="nav-item"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
                <a href="manage-menu.php" class="nav-item active"><i class="fas fa-utensils"></i> Manage Menu</a>
                <a href="manage-tables.php" class="nav-item"><i class="fas fa-chair"></i> Manage Tables</a>
                <a href="manage-users.php" class="nav-item"><i class="fas fa-users"></i> Manage Users</a>
            </nav>
            <div class="sidebar-footer">
                <a href="../../index.php" class="nav-item"> <i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>
        
        <button class="sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        
        <main class="staff-main">
            <div class="staff-header">
                <h1>Manage Menu</h1>
            </div>
            
            <div class="table-responsive">
                <table class="staff-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="menuTableBody">
                        <!-- Loaded by JS -->
                    </tbody>
                </table>
            </div>
        </main>
    </div>

    <!-- Shared Menu Data -->
    <script src="../../assets/js/menu.js?v=2"></script>
    <script>
        // Sidebar toggle
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('staffSidebar').classList.toggle('open');
        });

        // Render menu table
        const tbody = document.getElementById('menuTableBody');
        tbody.innerHTML = menuData.map((item, index) => {
            const imgNum = index + 1; // item1.png, item2.png, ...
            return `
                <tr>
                    <td><img src="../../assets/images/menu-image/item${imgNum}.png" class="menu-thumb" alt="${item.name}" onerror="this.src='../../assets/images/menu-image/placeholder.png'"></td>
                    <td>${item.name}</td>
                    <td>${item.category.replace(/-/g, ' ').replace(/\b\w/g, c => c.toUpperCase())}</td>
                    <td>RM ${item.price.toFixed(2)}</td>
                    <td><span class="status-badge available">Available</span></td>
                    <td>
                        <button class="btn-edit"><i class="fas fa-edit"></i></button>
                        <button class="btn-delete"><i class="fas fa-trash"></i></button>
                    </td>
                </tr>
            `;
        }).join('');
    </script>
</body>
</html>