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

    <!-- ========== HEADER ========== -->
    <?php include '../../includes/header.php'; ?>

    <!-- ========== PROFILE PAGE ========== -->
    <main class="dashboard-page">
        <div class="container">
            <div class="dashboard-layout">
                <!-- Sidebar -->
                <aside class="dashboard-sidebar">
                    <div class="sidebar-profile">
                        <div class="profile-avatar"><i class="fas fa-user-circle"></i></div>
                        <h3>My Account</h3>
                    </div>
                    <nav class="sidebar-nav">
                        <a href="dashboard.php"><i class="fas fa-tachometer-alt"></i> Dashboard</a>
                        <a href="order-status.php"><i class="fas fa-receipt"></i> Order Status</a>
                        <a href="order-history.php"><i class="fas fa-history"></i> Order History</a>
                        <a href="profile.php" class="active"><i class="fas fa-user-edit"></i> Edit Profile</a>
                        <a href="../../backend/api/auth.php?action=logout" class="logout-link"><i class="fas fa-sign-out-alt"></i> Logout</a>
                    </nav>
                </aside>

                <!-- Main Content -->
                <div class="dashboard-main">
                    <div class="dashboard-header">
                        <h1>Edit Profile</h1>
                        <p>Update your personal information</p>
                    </div>

                    <!-- Profile Form -->
                    <div class="profile-card">
                        <form class="profile-form" id="profileForm" method="POST" action="../../backend/api/users.php">
                            <input type="hidden" name="action" value="update_profile">

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="profileName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="profileName" name="fullName" placeholder="Your full name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="profilePhone">Phone Number <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="profilePhone" name="phone" placeholder="01X-XXXXXXX" required>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="profileEmail">Email Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-envelope"></i>
                                    <input type="email" id="profileEmail" name="email" placeholder="your@email.com" readonly class="readonly-input">
                                </div>
                                <small class="field-note">Email address cannot be changed</small>
                            </div>

                            <div class="form-group">
                                <label for="profileAddress">Default Address</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="profileAddress" name="address" rows="3" placeholder="Your default delivery address"></textarea>
                                </div>
                            </div>

                            <div class="profile-section-divider">
                                <span>Change Password (optional)</span>
                            </div>

                            <div class="form-row">
                                <div class="form-group">
                                    <label for="currentPassword">Current Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="currentPassword" name="currentPassword" placeholder="Enter current password">
                                        <button type="button" class="toggle-password" data-target="currentPassword"><i class="fas fa-eye"></i></button>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="newPassword">New Password</label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-lock"></i>
                                        <input type="password" id="newPassword" name="newPassword" placeholder="Min 8 characters">
                                        <button type="button" class="toggle-password" data-target="newPassword"><i class="fas fa-eye"></i></button>
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

    <!-- ========== FOOTER ========== -->
    <?php include '../../includes/footer.php'; ?>

    <script>
        // Toggle password visibility
        document.querySelectorAll('.toggle-password').forEach(btn => {
            btn.addEventListener('click', function () {
                const target = document.getElementById(this.dataset.target);
                const icon = this.querySelector('i');
                if (target.type === 'password') {
                    target.type = 'text';
                    icon.className = 'fas fa-eye-slash';
                } else {
                    target.type = 'password';
                    icon.className = 'fas fa-eye';
                }
            });
        });
    </script>
</body>
</html>
