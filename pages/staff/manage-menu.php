<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Menu - Restoran SUP TULANG ZZ</title>
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
                <button class="btn-add"><i class="fas fa-plus"></i> Add New Item</button>
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
                    <tbody>
                        <tr><td><img src="../../assets/images/food1.jpg" class="menu-thumb"></td><td>Nasi Lemak</td><td>Main Course</td><td>RM 8.00</td><td><span class="status-badge available">Available</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td><img src="../../assets/images/food2.jpg" class="menu-thumb"></td><td>Chicken Chop</td><td>Main Course</td><td>RM 15.00</td><td><span class="status-badge available">Available</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td><img src="../../assets/images/food3.jpg" class="menu-thumb"></td><td>Mango Smoothie</td><td>Drinks</td><td>RM 6.50</td><td><span class="status-badge available">Available</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
                        <tr><td><img src="../../assets/images/menu3.jpg" class="menu-thumb"></td><td>Sup Tulang Gearbox</td><td>Main Course</td><td>RM 22.00</td><td><span class="status-badge unavailable">Unavailable</span></td><td><button class="btn-edit"><i class="fas fa-edit"></i></button> <button class="btn-delete"><i class="fas fa-trash"></i></button></td></tr>
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