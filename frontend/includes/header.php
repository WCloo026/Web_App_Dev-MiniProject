<?php
// includes/header.php
// Shared header across all pages
// Usage: <?php include 'path/to/includes/header.php'; ?>

// Determine base path dynamically
$depth = substr_count($_SERVER['PHP_SELF'], '/') - 1;
$base = str_repeat('../', $depth - 1); // relative root from current file

// Active page detection
$currentPage = basename($_SERVER['PHP_SELF']);
function isActive($page) {
    global $currentPage;
    return $currentPage === $page ? 'active' : '';
}

// Cart count from session (set by backend after login)
$cartCount = isset($_SESSION['cart_count']) ? $_SESSION['cart_count'] : 0;
?>
<!-- ========== TOP HEADER with Glass Effect ========== -->
<header class="header">
    <div class="header-container">
        <a href="<?= $base ?>index.php" class="logo">
            <img src="<?= $base ?>assets/images/Logo.jpeg" alt="Restoran SUP TULANG ZZ Logo" class="logo-img">
            <h1>Restoran SUP TULANG ZZ</h1>
        </a>

        <div class="header-icons">
            <a href="<?= $base ?>pages/customer/cart.php" class="icon-link">
                <i class="fas fa-shopping-cart"></i>
                <span class="cart-badge" id="cartBadge"><?= $cartCount ?></span>
            </a>
            <button class="menu-toggle" id="menuToggle">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>

    <nav class="desktop-nav" id="desktopNav">
        <ul>
            <li><a href="<?= $base ?>index.php" class="<?= isActive('index.php') ?>">Home</a></li>
            <li><a href="<?= $base ?>pages/menu.php" class="<?= isActive('menu.php') ?>">Menu</a></li>
            <li><a href="<?= $base ?>pages/news-events.php" class="<?= isActive('news-events.php') ?>">News &amp; Events</a></li>
            <li><a href="<?= $base ?>pages/about.php" class="<?= isActive('about.php') ?>">About</a></li>
            <li><a href="<?= $base ?>pages/contact.php" class="<?= isActive('contact.php') ?>">Contact</a></li>
            <?php if (isset($_SESSION['user_id'])): ?>
                <li><a href="<?= $base ?>pages/customer/dashboard.php" class="btn-login">My Account</a></li>
                <li><a href="<?= $base ?>backend/api/auth.php?action=logout" class="btn-register">Logout</a></li>
            <?php else: ?>
                <li><a href="<?= $base ?>pages/login.php" class="btn-login <?= isActive('login.php') ?>">Login</a></li>
                <li><a href="<?= $base ?>pages/register.php" class="btn-register <?= isActive('register.php') ?>">Register</a></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- Mobile Menu Toggle Script -->
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuToggle = document.getElementById('menuToggle');
        const desktopNav = document.getElementById('desktopNav');
        if (menuToggle && desktopNav) {
            menuToggle.addEventListener('click', function () {
                desktopNav.classList.toggle('active');
                const icon = menuToggle.querySelector('i');
                icon.className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
            });
        }
        // Update cart badge from localStorage
        const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
        const count = cart.reduce((sum, item) => sum + item.quantity, 0);
        const badge = document.getElementById('cartBadge');
        if (badge) {
            badge.textContent = count;
            badge.style.display = count > 0 ? 'flex' : 'none';
        }
    });
</script>
