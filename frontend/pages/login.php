<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!-- ========== HEADER ========== -->
    <?php include '../includes/header.php'; ?>

    <!-- ========== LOGIN SECTION ========== -->
    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <img src="../assets/images/Logo.jpeg" alt="Logo" class="auth-logo">
                    <h2>Welcome Back!</h2>
                    <p>Login to your account to place orders and track your meals</p>
                </div>

                <!-- Role Hint Banner -->
                <div class="role-hint">
                    <i class="fas fa-info-circle"></i>
                    <span>Staff members: use your assigned staff credentials</span>
                </div>

                <form class="auth-form" id="loginForm" method="POST" action="../backend/api/auth.php">
                    <input type="hidden" name="action" value="login">

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="your@email.com" required>
                        </div>
                        <span class="error-message" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Enter your password" required>
                            <button type="button" class="toggle-password" data-target="password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <span class="error-message" id="passwordError"></span>
                    </div>

                    <div class="form-group remember-row">
                        <label class="checkbox-label">
                            <input type="checkbox" id="rememberMe" name="rememberMe">
                            <span>Remember me</span>
                        </label>
                        <a href="forgot-password.php" class="forgot-link">Forgot password?</a>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Don't have an account? <a href="register.php">Register here</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <?php include '../includes/footer.php'; ?>

    <script src="../assets/js/validation.js"></script>
</body>
</html>
