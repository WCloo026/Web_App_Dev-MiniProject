<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Orders - Restoran SUP TULANG ZZ</title>
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
                <a href="manage-orders.php" class="nav-item active"><i class="fas fa-clipboard-list"></i> Manage Orders</a>
                <a href="manage-menu.php" class="nav-item"><i class="fas fa-utensils"></i> Manage Menu</a>
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
                <h1>Manage Orders</h1>
            </div>
            
            <!-- Filter Bar -->
            <div class="filter-bar">
                <input type="text" placeholder="Search orders..." class="filter-input">
                <select class="filter-select">
                    <option>All Status</option>
                    <option>Pending</option>
                    <option>Preparing</option>
                    <option>Ready</option>
                    <option>Completed</option>
                </select>
                <select class="filter-select">
                    <option>All Types</option>
                    <option>Dine-In</option>
                    <option>Online</option>
                </select>
            </div>
            
            <div class="table-responsive">
                <table class="staff-table">
                    <thead>
                        <tr>
                            <th>Order ID</th>
                            <th>Type</th>
                            <th>Table</th>
                            <th>Items</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Time</th>
                            <th>Update</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr><td>#1023</td><td>Dine-In</td><td>Table 5</td><td>Nasi Lemak x2, Iced Tea x1</td><td>RM 35.00</td><td><select class="status-select"><option selected>Pending</option><option>Preparing</option><option>Ready</option><option>Completed</option></select></td><td>10:30 AM</td><td><button class="btn-update">Update</button></td></tr>
                        <tr><td>#1024</td><td>Dine-In</td><td>Table 12</td><td>Chicken Chop x1, Tom Yum x1, Satay x2, Drinks x1</td><td>RM 62.50</td><td><select class="status-select"><option>Pending</option><option selected>Preparing</option><option>Ready</option><option>Completed</option></select></td><td>10:35 AM</td><td><button class="btn-update">Update</button></td></tr>
                        <tr><td>#1025</td><td>Dine-In</td><td>Table 3</td><td>Sup Tulang x1, Rice x1</td><td>RM 18.00</td><td><select class="status-select"><option>Pending</option><option>Preparing</option><option selected>Ready</option><option>Completed</option></select></td><td>10:20 AM</td><td><button class="btn-update">Update</button></td></tr>
                        <tr><td>#1026</td><td>Online</td><td>-</td><td>Nasi Goreng x2, Mango Smoothie x2</td><td>RM 45.00</td><td><select class="status-select"><option>Pending</option><option>Preparing</option><option>Ready</option><option selected>Completed</option></select></td><td>10:15 AM</td><td><button class="btn-update">Update</button></td></tr>
                        <tr><td>#1027</td><td>Online</td><td>-</td><td>Satay x3, Cendol x1</td><td>RM 41.50</td><td><select class="status-select"><option selected>Pending</option><option>Preparing</option><option>Ready</option><option>Completed</option></select></td><td>10:40 AM</td><td><button class="btn-update">Update</button></td></tr>
                    </tbody>
                </table>
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