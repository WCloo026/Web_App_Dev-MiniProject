<?php
session_start();
// Redirect if already logged in
if (isset($_SESSION['user_id'])) {
    header('Location: customer/dashboard.php');
    exit;
}
$errorMsg = '';
$errors = [
    'exists'    => 'This email is already registered. Please login instead.',
    'mismatch'  => 'Passwords do not match.',
    'short_pw'  => 'Password must be at least 8 characters.',
    'invalid_ph'=> 'Please enter a valid Malaysian phone number.',
    'db'        => 'Server error. Please try again later.',
];
if (isset($_GET['error']) && array_key_exists($_GET['error'], $errors)) {
    $errorMsg = $errors[$_GET['error']];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .auth-page {
            min-height: calc(100vh - 120px);
            display: flex; align-items: center; justify-content: center;
            padding: 40px 16px 80px;
            background: linear-gradient(135deg, #fdf6f0 0%, #fce8e6 100%);
        }
        .auth-container { width: 100%; max-width: 480px; }
        .auth-card {
            background: #fff; border-radius: 20px; padding: 40px 36px;
            box-shadow: 0 8px 40px rgba(0,0,0,0.13); border: 1px solid #f0ebe4;
        }
        .auth-header { text-align: center; margin-bottom: 24px; }
        .auth-logo {
            width: 80px; height: 80px; border-radius: 50%; object-fit: cover;
            display: block; margin: 0 auto 14px; border: 3px solid #c0392b;
        }
        .auth-header h2 { font-size: 1.5rem; font-weight: 800; color: #2c3e50; margin: 0 0 6px; }
        .auth-header p  { color: #777; font-size: 0.875rem; margin: 0; }
        .auth-form { display: flex; flex-direction: column; gap: 15px; }
        .form-group { display: flex; flex-direction: column; gap: 5px; }
        .form-group label { font-size: 0.85rem; font-weight: 600; color: #2c3e50; }
        .required { color: #c0392b; }
        .input-wrapper { position: relative; display: flex; align-items: center; }
        .input-wrapper > i:first-child {
            position: absolute; left: 14px; color: #999; font-size: 0.875rem; pointer-events: none;
        }
        .input-wrapper input {
            width: 100%; padding: 11px 44px 11px 40px;
            border: 2px solid #e8e0d8; border-radius: 8px;
            font-size: 0.9rem; outline: none; transition: border-color 0.25s; font-family: inherit;
        }
        .input-wrapper input:focus { border-color: #c0392b; }
        .input-wrapper.input-error input { border-color: #e74c3c; }
        .toggle-password {
            position: absolute; right: 12px; color: #999;
            font-size: 0.875rem; cursor: pointer; border: none; background: none;
        }
        .error-message { font-size: 0.78rem; color: #e74c3c; display: none; margin-top: 2px; }
        .checkbox-label {
            display: flex; align-items: flex-start; gap: 8px;
            font-size: 0.875rem; cursor: pointer; line-height: 1.4;
        }
        .checkbox-label input[type="checkbox"] { accent-color: #c0392b; width: 15px; height: 15px; margin-top: 2px; flex-shrink: 0; }
        .checkbox-label a { color: #c0392b; text-decoration: none; }
        .btn-auth {
            padding: 13px; background: #c0392b; color: #fff; border: none; border-radius: 8px;
            font-weight: 700; font-size: 1rem; display: flex; align-items: center;
            justify-content: center; gap: 8px; cursor: pointer;
            transition: background 0.25s, transform 0.2s; font-family: inherit; margin-top: 4px;
        }
        .btn-auth:hover { background: #96281b; transform: translateY(-2px); }

        .auth-error-banner {
            display: flex; align-items: center; gap: 10px;
            background: #fde8e8; border: 1px solid #f5c6c6;
            border-radius: 8px; padding: 12px 14px;
            font-size: 0.875rem; color: #c0392b;
            margin-bottom: 16px;
        }
        .auth-error-banner i { font-size: 1rem; flex-shrink: 0; }
        .auth-footer { text-align: center; margin-top: 20px; font-size: 0.875rem; color: #777; }
        .auth-footer a { color: #c0392b; font-weight: 600; text-decoration: none; }
    </style>
</head>
<body>

    <!-- ========== HEADER ========== -->
    <header class="header">
        <div class="header-container">
            <a href="../../index.php" class="logo">
                <img src="../assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
                <h1>Restoran SUP TULANG ZZ</h1>
            </a>
            <div class="header-icons">
                <a href="customer/cart.php" class="icon-link">
                    <i class="fas fa-shopping-cart"></i>
                    <span class="cart-badge" id="cartBadge">0</span>
                </a>
                <button class="menu-toggle" id="menuToggle"><i class="fas fa-bars"></i></button>
            </div>
        </div>
        <nav class="desktop-nav" id="desktopNav">
            <ul>
                <li><a href="../../index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="news-events.php">News &amp; Events</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login.php" class="btn-login">Login</a></li>
                <li><a href="register.php" class="btn-register active">Register</a></li>
            </ul>
        </nav>
    </header>

    <!-- ========== REGISTER FORM ========== -->
    <main class="auth-page">
        <div class="auth-container">
            <div class="auth-card">

                <div class="auth-header">
                    <img src="../assets/images/Logo.jpeg" alt="Logo" class="auth-logo">
                    <h2>Create Account</h2>
                    <p>Join us and start ordering your favourite food!</p>
                </div>

                
                <?php if ($errorMsg): ?>
                <div class="auth-error-banner">
                    <i class="fas fa-exclamation-circle"></i>
                    <span><?php echo htmlspecialchars($errorMsg); ?></span>
                </div>
                <?php endif; ?>
<form class="auth-form" id="registerForm" method="POST" action="../../backend/api/auth.php">
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
                            <button type="button" class="toggle-password" id="togglePwd">
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
                            <button type="button" class="toggle-password" id="toggleConfirm">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        <span class="error-message" id="confirmPasswordError"></span>
                    </div>

                    <div class="form-group">
                        <label class="checkbox-label">
                            <input type="checkbox" id="agreeTerms" name="agreeTerms" required>
                            <span>I agree to the <a href="#">Terms &amp; Conditions</a> and <a href="#">Privacy Policy</a></span>
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
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-section">
                    <h3><img src="../assets/images/Logo.jpeg" alt="Logo" style="height:50px;width:auto;vertical-align:middle;"> Restoran SUP TULANG ZZ</h3>
                    <p>Delicious food, excellent service, memorable experience.</p>
                </div>
                <div class="footer-section">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="../../index.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                        <li><a href="menu.php"><i class="fas fa-chevron-right"></i> Menu</a></li>
                        <li><a href="news-events.php"><i class="fas fa-chevron-right"></i> News &amp; Events</a></li>
                        <li><a href="about.php"><i class="fas fa-chevron-right"></i> About</a></li>
                        <li><a href="contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h3>Contact Us</h3>
                    <p><i class="fas fa-map-marker-alt"></i> Jalan Example, Taman Melaka Raya, 75000 Melaka</p>
                    <p><i class="fas fa-phone"></i> 012-3456789</p>
                    <p><i class="fas fa-envelope"></i> info@suptulangzz.com</p>
                </div>
                <div class="footer-section">
                    <h3>Follow Us</h3>
                    <div class="social-links">
                        <a href="https://www.facebook.com/" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://www.tiktok.com/en/" target="_blank"><i class="fab fa-tiktok"></i></a>
                    </div>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; 2026 Restaurant SUP TULANG ZZ. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <nav class="mobile-nav">
        <a href="../../index.php"><i class="fas fa-home"></i><span>Home</span></a>
        <a href="menu.php"><i class="fas fa-utensils"></i><span>Menu</span></a>
        <a href="customer/cart.php"><i class="fas fa-shopping-cart"></i><span>Cart</span></a>
        <a href="customer/order-status.php"><i class="fas fa-receipt"></i><span>Orders</span></a>
        <a href="login.php"><i class="fas fa-user"></i><span>Login</span></a>
    </nav>

    <script src="../assets/js/validation.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const count = cart.reduce((sum, i) => sum + i.quantity, 0);
            const badge = document.getElementById('cartBadge');
            if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'flex' : 'none'; }

            const menuToggle = document.getElementById('menuToggle');
            const desktopNav = document.getElementById('desktopNav');
            if (menuToggle && desktopNav) {
                menuToggle.addEventListener('click', function () {
                    desktopNav.classList.toggle('active');
                    this.querySelector('i').className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
                });
            }

            function setupToggle(btnId, inputId) {
                const btn = document.getElementById(btnId);
                const inp = document.getElementById(inputId);
                if (!btn || !inp) return;
                btn.addEventListener('click', function () {
                    const show = inp.type === 'password';
                    inp.type = show ? 'text' : 'password';
                    this.querySelector('i').className = show ? 'fas fa-eye-slash' : 'fas fa-eye';
                });
            }
            setupToggle('togglePwd', 'password');
            setupToggle('toggleConfirm', 'confirmPassword');
        });
    </script>
</body>
</html>
