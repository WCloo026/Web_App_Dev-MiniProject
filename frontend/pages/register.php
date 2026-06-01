<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <!-- ========== HEADER ========== -->
    <?php include '../includes/header.php'; ?>

    <!-- ========== REGISTER SECTION ========== -->
    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-card">
                <div class="auth-header">
                    <img src="../assets/images/Logo.jpeg" alt="Logo" class="auth-logo">
                    <h2>Create Account</h2>
                    <p>Join us and start ordering your favourite food!</p>
                </div>

                <form class="auth-form" id="registerForm" method="POST" action="../backend/api/auth.php">
                    <input type="hidden" name="action" value="register">

                    <div class="form-group">
                        <label for="fullName">Full Name <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-user"></i>
                            <input type="text" id="fullName" name="fullName" placeholder="Enter your full name" required>
                        </div>
                        <span class="error-message" id="nameError"></span>
                    </div>

                    <div class="form-group">
                        <label for="email">Email Address <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-envelope"></i>
                            <input type="email" id="email" name="email" placeholder="your@email.com" required>
                        </div>
                        <span class="error-message" id="emailError"></span>
                    </div>

                    <div class="form-group">
                        <label for="phone">Phone Number <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-phone"></i>
                            <input type="tel" id="phone" name="phone" placeholder="01X-XXXXXXX" required>
                        </div>
                        <span class="error-message" id="phoneError"></span>
                    </div>

                    <div class="form-group">
                        <label for="password">Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="password" name="password" placeholder="Minimum 8 characters" required>
                            <button type="button" class="toggle-password" data-target="password">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <span class="error-message" id="passwordError"></span>
                    </div>

                    <div class="form-group">
                        <label for="confirmPassword">Confirm Password <span class="required">*</span></label>
                        <div class="input-wrapper">
                            <i class="fas fa-lock"></i>
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Re-enter your password" required>
                            <button type="button" class="toggle-password" data-target="confirmPassword">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <span class="error-message" id="confirmPasswordError"></span>
                    </div>

                    <div class="form-group checkbox-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                            <span>I agree to the <a href="#">Terms & Conditions</a> and <a href="#">Privacy Policy</a></span>
                        </label>
                        <span class="error-message" id="termsError"></span>
                    </div>

                    <button type="submit" class="btn-auth">
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </form>

                <div class="auth-footer">
                    <p>Already have an account? <a href="login.php">Login here</a></p>
                </div>
            </div>
        </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <?php include '../includes/footer.php'; ?>

    <script src="../assets/js/validation.js"></script>
</body>
</html>
