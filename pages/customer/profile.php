<?php
session_start();
if (!isset($_SESSION['user_id'])) { header('Location: ../login.php'); exit; }
$success = isset($_GET['success']);
$error   = $_GET['error'] ?? '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Restoran SUP TULANG ZZ</title>
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
                        <a href="order-history.php"><i class="fas fa-history"></i> Order History</a>
                        <a href="profile.php" class="active"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../../backend/api/auth.php?action=logout" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </nav>
                </aside>

                <div class="dashboard-main">
                    <div class="dashboard-header">
                        <h1>Edit Profile</h1>
                        <p>Update your personal information</p>
                    </div>

                    <?php if ($success): ?>
                        <div style="background:#d4edda;border:1px solid #c3e6cb;border-radius:8px;padding:12px 16px;margin-bottom:20px;color:#155724;display:flex;align-items:center;gap:8px;">
                            <i class="fas fa-check-circle"></i> Profile updated successfully!
                        </div>
                    <?php endif; ?>
                    <?php if ($error === 'wrong_pw'): ?>
                        <div style="background:#fde8e8;border:1px solid #f5c6c6;border-radius:8px;padding:12px 16px;margin-bottom:20px;color:#c0392b;display:flex;align-items:center;gap:8px;">
                            <i class="fas fa-exclamation-circle"></i> Current password is incorrect.
                        </div>
                    <?php endif; ?>

                    <div class="profile-card">
                        <form class="profile-form" method="POST" action="../../backend/api/auth.php">
                            <input type="hidden" name="action" value="update_profile">

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="fullName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="fullName" name="fullName"
                                               value="<?= htmlspecialchars($_SESSION['user_name']) ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone Number</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="phone" name="phone"
                                               value="<?= htmlspecialchars($_SESSION['user_phone'] ?? '') ?>">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" value="<?= htmlspecialchars($_SESSION['user_email']) ?>"
                                           readonly class="readonly-input">
                                </div>
                                <small class="field-note">Email cannot be changed</small>
                            </div>

                            <div class="form-group">
                                <label for="address">Default Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="address" name="address" rows="3"
                                              placeholder="Your default delivery address"></textarea>
                                </div>
                            </div>

                            <div class="profile-section-divider"><span>Change Password (optional)</span></div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="currentPassword" name="currentPassword"
                                               placeholder="Enter current password">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="newPassword" name="newPassword"
                                               placeholder="Min 8 characters">
                                    </div>
                                </div>
                            </div>

                            <div class="form-actions">
                                <button type="submit" class="btn-save-profile">
                                    <i class="fas fa-save"></i> Save Changes
                                </button>
                                <a href="dashboard.php" class="btn-cancel-profile">
                                    <i class="fas fa-times"></i> Cancel
                                </a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <?php include '../../includes/footer.php'; ?>
</body>
</html>
