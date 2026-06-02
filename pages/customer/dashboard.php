<?php
session_start();
// Redirect to login if not logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Dashboard - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <?php include '../../includes/header.php'; ?>

    <main class="dashboard-page">
        <div class="container">
            <div class="dashboard-layout">

                <!-- Sidebar -->
                <aside class="dashboard-sidebar">
                    <div class="sidebar-profile">
                        <div class="profile-avatar"><i class="fas fa-user-circle"></i></div>
                        <h3><?= htmlspecialchars($_SESSION['user_name']) ?></h3>
                        <p><?= htmlspecialchars($_SESSION['user_email']) ?></p>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="dashboard.php" class="active"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="order-status.php"><i class="fas fa-receipt"></i> Order Status</a>
                        <a href="order-history.php"><i class="fas fa-history"></i> Order History</a>
                        <a href="profile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../../../backend/api/auth.php?action=logout" class="logout-link">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </nav>
                </aside>

                <!-- Main Content -->
                <div class="dashboard-main">
                    <div class="dashboard-header">
                        <h1>Welcome back, <?= htmlspecialchars($_SESSION['user_name']) ?>! 👋</h1>
                        <p>Here's a summary of your activity.</p>
                    </div>

                    <!-- Stats Cards -->
                    <div class="stats-grid">
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-blue"><i class="fas fa-shopping-bag"></i></div>
                            <div class="stat-info">
                                <span class="stat-value" id="totalOrders">--</span>
                                <span class="stat-label">Total Orders</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-orange"><i class="fas fa-hourglass-half"></i></div>
                            <div class="stat-info">
                                <span class="stat-value" id="pendingOrders">--</span>
                                <span class="stat-label">Pending</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-green"><i class="fas fa-check-circle"></i></div>
                            <div class="stat-info">
                                <span class="stat-value" id="completedOrders">--</span>
                                <span class="stat-label">Completed</span>
                            </div>
                        </div>
                        <div class="stat-card">
                            <div class="stat-icon stat-icon-red"><i class="fas fa-wallet"></i></div>
                            <div class="stat-info">
                                <span class="stat-value" id="totalSpent">--</span>
                                <span class="stat-label">Total Spent</span>
                            </div>
                        </div>
                    </div>

                    <!-- Recent Orders -->
                    <div class="dashboard-section">
                        <div class="section-title-row">
                            <h2>Recent Orders</h2>
                            <a href="order-history.php" class="view-all-link">View All <i class="fas fa-chevron-right"></i></a>
                        </div>
                        <div class="orders-table-wrapper">
                            <table class="orders-table">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Date</th>
                                        <th>Items</th>
                                        <th>Total</th>
                                        <th>Type</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="recentOrdersBody">
                                    <tr class="table-placeholder">
                                        <td colspan="7">
                                            <i class="fas fa-receipt"></i>
                                            <p>No orders yet. <a href="../menu.php">Place your first order!</a></p>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <!-- Quick Actions -->
                    <div class="dashboard-section">
                        <h2>Quick Actions</h2>
                        <div class="quick-actions-grid">
                            <a href="../menu.php" class="quick-action-card">
                                <i class="fas fa-utensils"></i><span>Order Now</span>
                            </a>
                            <a href="order-status.php" class="quick-action-card">
                                <i class="fas fa-map-marker-alt"></i><span>Track Order</span>
                            </a>
                            <a href="profile.php" class="quick-action-card">
                                <i class="fas fa-user-edit"></i><span>Edit Profile</span>
                            </a>
                            <a href="../contact.php" class="quick-action-card">
                                <i class="fas fa-headset"></i><span>Support</span>
                            </a>
                        </div>
                    </div>

                </div><!-- end dashboard-main -->
            </div><!-- end dashboard-layout -->
        </div><!-- end container -->
    </main>

    <?php include '../../includes/footer.php'; ?>

</body>
</html>
