<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ../login.php'); exit; }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>
    <?php include '../../includes/header.php'; ?>

    <main class="dashboard-page">
        <div class="container">
            <div class="dashboard-layout">
                <aside class="dashboard-sidebar">
                    <div class="sidebar-profile">
                        <div class="profile-avatar"><i class="fas fa-user-circle"></i></div>
                        <h3><?= htmlspecialchars($_SESSION['user_name']) ?></h3>
                        <p><?= htmlspecialchars($_SESSION['user_email']) ?></p>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="order-status.php"><i class="fas fa-receipt"></i> Order Status</a>
                        <a href="order-history.php" class="active"><i class="fas fa-history"></i> Order History</a>
                        <a href="profile.php"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../../backend/api/auth.php?action=logout" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </nav>
                </aside>

                <div class="dashboard-main">
                    <div class="dashboard-header">
                        <h1>Order History</h1>
                        <p>All your past orders in one place</p>
                    </div>

                    <div class="history-filters">
                        <div class="filter-group">
                            <label>Status</label>
                            <select id="filterStatus">
                                <option value="">All Status</option>
                                <option value="completed">Completed</option>
                                <option value="cancelled">Cancelled</option>
                            </select>
                        </div>
                        <div class="filter-group">
                            <label>From</label>
                            <input type="date" id="filterDateFrom">
                        </div>
                        <div class="filter-group">
                            <label>To</label>
                            <input type="date" id="filterDateTo">
                        </div>
                        <button class="btn-filter" id="btnApplyFilter">
                            <i class="fas fa-filter"></i> Filter
                        </button>
                    </div>

                    <div class="orders-table-wrapper">
                        <table class="orders-table">
                            <thead>
                                <tr>
                                    <th>Order ID</th>
                                    <th>Date &amp; Time</th>
                                    <th>Items</th>
                                    <th>Total</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody id="historyTableBody">
                                <tr class="table-placeholder">
                                    <td colspan="7">
                                        <i class="fas fa-history"></i>
                                        <p>No order history yet. <a href="../menu.php">Place your first order!</a></p>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="pagination" id="historyPagination"></div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>
