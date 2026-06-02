<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Tables - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
    <link rel="stylesheet" href="../../assets/css/staff.css">
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
                <a href="manage-menu.php" class="nav-item"><i class="fas fa-utensils"></i> Manage Menu</a>
                <a href="manage-tables.php" class="nav-item active"><i class="fas fa-chair"></i> Manage Tables</a>
                <a href="manage-users.php" class="nav-item"><i class="fas fa-users"></i> Manage Users</a>
            </nav>
            <div class="sidebar-footer">
                <a href="../../index.php" class="nav-item"> <i class="fas fa-sign-out-alt"></i> Logout</a>
            </div>
        </aside>
        
        <button class="sidebar-toggle" id="sidebarToggle"><i class="fas fa-bars"></i></button>
        
        <main class="staff-main">
            <div class="staff-header">
                <h1>Manage Tables</h1>
            </div>
            
            <!-- Table Grid -->
            <div class="tables-grid">
                <!-- Set Maximum table HERE -->
                <?php for ($i = 1; $i <= 30; $i++): ?> 
                <div class="table-card <?php echo $i <= 8 ? 'occupied' : 'available'; ?>">
                    <i class="fas fa-chair"></i>
                    <span class="table-num">Table <?php echo $i; ?></span>
                    <span class="table-status"><?php echo $i <= 8 ? 'Occupied' : 'Available'; ?></span>
                    <?php if ($i <= 8): ?>
                    <small>3 pax • RM 45.00</small>
                    <?php endif; ?>
                    <button class="btn-table-action">View</button>
                </div>
                <?php endfor; ?>
            </div>
        </main>
    </div>

    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            document.getElementById('staffSidebar').classList.toggle('open');
        });
    </script>
</body>
</html>