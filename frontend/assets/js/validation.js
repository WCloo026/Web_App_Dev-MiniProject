/**
 * validation.js
 * Restoran SUP TULANG ZZ
 * Covers: Login | Register | QR Order | Checkout
 * Members 1 & 2
 */

// ══════════════════════════════════════════
// HELPERS
// ══════════════════════════════════════════

function showError(input, errorEl, message) {
    if (input) input.style.borderColor = '#e74c3c';
    if (errorEl) {
        errorEl.textContent = message;
        errorEl.style.display = 'block';
    }
}

function clearError(input, errorEl) {
    if (input) input.style.borderColor = '#e8e0d8';
    if (errorEl) {
        errorEl.textContent = '';
        errorEl.style.display = 'none';
    }
}

function clearAllErrors() {
    document.querySelectorAll('.error-message').forEach(el => {
        el.textContent = '';
        el.style.display = 'none';
    });
    document.querySelectorAll('input').forEach(el => {
        el.style.borderColor = '#e8e0d8';
    });
}

function isValidEmail(val) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val.trim());
}

function isValidPhone(val) {
    return /^(01[0-9])\d{7,8}$/.test(val.replace(/[\s\-]/g, ''));
}

// ══════════════════════════════════════════
// 1. LOGIN VALIDATION (Member 1)
// ══════════════════════════════════════════

function validateLogin() {
    clearAllErrors();
    let ok = true;

    const email = document.getElementById('email')?.value.trim() || '';
    const pass = document.getElementById('password')?.value || '';

    if (!email) {
        showError(document.getElementById('email'), document.getElementById('emailError'), 'Email is required');
        ok = false;
    } else if (!isValidEmail(email)) {
        showError(document.getElementById('email'), document.getElementById('emailError'), 'Please enter a valid email address');
        ok = false;
    }

    if (!pass) {
        showError(document.getElementById('password'), document.getElementById('passwordError'), 'Password is required');
        ok = false;
    } else if (pass.length < 6) {
        showError(document.getElementById('password'), document.getElementById('passwordError'), 'Password must be at least 6 characters');
        ok = false;
    }

    return ok;
}

// ══════════════════════════════════════════
// 2. REGISTER VALIDATION (Member 1)
// ══════════════════════════════════════════

function validateRegister() {
    clearAllErrors();
    let ok = true;

    const name = document.getElementById('fullName')?.value.trim() || '';
    const email = document.getElementById('email')?.value.trim() || '';
    const phone = document.getElementById('phone')?.value.trim() || '';
    const pass = document.getElementById('password')?.value || '';
    const confirm = document.getElementById('confirmPassword')?.value || '';
    const terms = document.getElementById('agreeTerms')?.checked;

    if (!name || name.length < 3) {
        showError(document.getElementById('fullName'), document.getElementById('nameError'), 'Name must be at least 3 characters');
        ok = false;
    }

    if (!email) {
        showError(document.getElementById('email'), document.getElementById('emailError'), 'Email is required');
        ok = false;
    } else if (!isValidEmail(email)) {
        showError(document.getElementById('email'), document.getElementById('emailError'), 'Please enter a valid email address');
        ok = false;
    }

    if (!phone) {
        showError(document.getElementById('phone'), document.getElementById('phoneError'), 'Phone number is required');
        ok = false;
    } else if (!isValidPhone(phone)) {
        showError(document.getElementById('phone'), document.getElementById('phoneError'), 'Enter a valid phone (e.g. 0123456789)');
        ok = false;
    }

    if (!pass) {
        showError(document.getElementById('password'), document.getElementById('passwordError'), 'Password is required');
        ok = false;
    } else if (pass.length < 8) {
        showError(document.getElementById('password'), document.getElementById('passwordError'), 'Password must be at least 8 characters');
        ok = false;
    }

    if (!confirm) {
        showError(document.getElementById('confirmPassword'), document.getElementById('confirmPasswordError'), 'Please confirm your password');
        ok = false;
    } else if (confirm !== pass) {
        showError(document.getElementById('confirmPassword'), document.getElementById('confirmPasswordError'), 'Passwords do not match');
        ok = false;
    }

    if (!terms) {
        const termsErr = document.getElementById('termsError');
        if (termsErr) {
            termsErr.textContent = 'You must agree to the Terms & Conditions';
            termsErr.style.display = 'block';
        }
        ok = false;
    }

    return ok;
}

// ══════════════════════════════════════════
// 3. QR ORDER VALIDATION (Member 1)
// ══════════════════════════════════════════

function validateQrOrder() {
    const countBadge = document.getElementById('orderCountBadge');
    const count = countBadge ? parseInt(countBadge.textContent) : 0;
    if (count === 0) {
        alert('⚠️ Please add at least 1 item to your order.');
        return false;
    }
    return true;
}

// ══════════════════════════════════════════
// 4. CHECKOUT VALIDATION (Member 2)
// ══════════════════════════════════════════

function validateCheckout() {
    clearAllErrors();
    let ok = true;

    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    if (cart.length === 0) {
        alert('Your cart is empty! Please add items before checking out.');
        return false;
    }

    const name = document.getElementById('custName')?.value.trim() || '';
    const phone = document.getElementById('custPhone')?.value.trim() || '';
    const orderType = document.querySelector('input[name="orderType"]:checked')?.value || '';
    const payment = document.querySelector('input[name="paymentMethod"]:checked')?.value || '';

    if (!name || name.length < 2) {
        showError(document.getElementById('custName'), document.getElementById('custNameError'), 'Please enter your full name');
        ok = false;
    }

    if (!phone) {
        showError(document.getElementById('custPhone'), document.getElementById('custPhoneError'), 'Phone number is required');
        ok = false;
    } else if (!isValidPhone(phone)) {
        showError(document.getElementById('custPhone'), document.getElementById('custPhoneError'), 'Enter a valid phone number');
        ok = false;
    }

    if (orderType === 'delivery') {
        const address = document.getElementById('address')?.value.trim() || '';
        if (!address) {
            showError(document.getElementById('address'), document.getElementById('addressError'), 'Delivery address is required');
            ok = false;
        }
    }

    if (orderType === 'dine-in') {
        const table = document.getElementById('tableNumber')?.value.trim() || '';
        if (!table || parseInt(table) < 1) {
            showError(document.getElementById('tableNumber'), document.getElementById('tableError'), 'Please enter a valid table number');
            ok = false;
        }
    }

    if (payment === 'online_transfer') {
        const receipt = document.getElementById('receipt')?.files[0];
        if (!receipt) {
            showError(document.getElementById('receipt'), document.getElementById('receiptError'), 'Please upload your payment receipt');
            ok = false;
        } else {
            const allowed = ['image/jpeg', 'image/png', 'application/pdf'];
            if (!allowed.includes(receipt.type)) {
                showError(document.getElementById('receipt'), document.getElementById('receiptError'), 'Invalid file type. Accepted: JPG, PNG, PDF');
                ok = false;
            } else if (receipt.size > 5 * 1024 * 1024) {
                showError(document.getElementById('receipt'), document.getElementById('receiptError'), 'File size must not exceed 5MB');
                ok = false;
            }
        }
    }

    return ok;
}

// ══════════════════════════════════════════
// ATTACH TO FORMS ON DOM READY
// ══════════════════════════════════════════

document.addEventListener('DOMContentLoaded', function () {

    // ── Login ──
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            if (!validateLogin()) e.preventDefault();
        });
        ['email', 'password'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', function () {
                clearError(this, document.getElementById(id + 'Error'));
            });
        });
    }

    // ── Register ──
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            if (!validateRegister()) e.preventDefault();
        });
        ['fullName', 'email', 'phone', 'password', 'confirmPassword'].forEach(id => {
            const errId = id === 'fullName' ? 'nameError' : id + 'Error';
            document.getElementById(id)?.addEventListener('input', function () {
                clearError(this, document.getElementById(errId));
            });
        });
        // Terms checkbox
        document.getElementById('agreeTerms')?.addEventListener('change', function () {
            if (this.checked) {
                const termsErr = document.getElementById('termsError');
                if (termsErr) { termsErr.textContent = ''; termsErr.style.display = 'none'; }
            }
        });
    }

    // ── QR Order ──
    const btnPlaceOrder = document.getElementById('btnPlaceOrder');
    if (btnPlaceOrder) {
        btnPlaceOrder.addEventListener('click', function (e) {
            if (!validateQrOrder()) {
                e.preventDefault();
                e.stopPropagation();
            }
        }, true);
    }

    // ── Checkout ──
    const checkoutForm = document.getElementById('checkoutForm');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function (e) {
            if (!validateCheckout()) e.preventDefault();
        });
        ['custName', 'custPhone', 'address', 'tableNumber'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', function () {
                clearError(this, document.getElementById(id + 'Error'));
            });
        });
    }

});