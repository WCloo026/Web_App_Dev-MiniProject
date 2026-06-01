/**
 * validation.js
 * Restoran SUP TULANG ZZ
 * Covers: Login | Register | Checkout
 */

// ══════════════════════════════════════════
// HELPERS
// ══════════════════════════════════════════

function showError(inputId, errorId, message) {
    const input = document.getElementById(inputId);
    const errEl = document.getElementById(errorId);
    if (input)  { input.closest('.input-wrapper')?.classList.add('input-error'); }
    if (errEl)  { errEl.textContent = message; errEl.style.display = 'block'; }
}

function clearError(inputId, errorId) {
    const input = document.getElementById(inputId);
    const errEl = document.getElementById(errorId);
    if (input)  { input.closest('.input-wrapper')?.classList.remove('input-error'); }
    if (errEl)  { errEl.textContent = ''; errEl.style.display = 'none'; }
}

function clearAllErrors() {
    document.querySelectorAll('.error-message').forEach(el => {
        el.textContent = ''; el.style.display = 'none';
    });
    document.querySelectorAll('.input-error').forEach(el => el.classList.remove('input-error'));
}

// ══════════════════════════════════════════
// RULES
// ══════════════════════════════════════════

function isValidEmail(val) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val.trim());
}

function isValidPhone(val) {
    return /^(01[0-9])\d{7,8}$/.test(val.replace(/[\s\-]/g, ''));
}

// ══════════════════════════════════════════
// LOGIN VALIDATION
// ══════════════════════════════════════════

function validateLogin() {
    clearAllErrors();
    let ok = true;

    const email = document.getElementById('email')?.value.trim() || '';
    const pass  = document.getElementById('password')?.value || '';

    if (!email) {
        showError('email', 'emailError', 'Email address is required.'); ok = false;
    } else if (!isValidEmail(email)) {
        showError('email', 'emailError', 'Please enter a valid email address.'); ok = false;
    }

    if (!pass) {
        showError('password', 'passwordError', 'Password is required.'); ok = false;
    } else if (pass.length < 8) {
        showError('password', 'passwordError', 'Password must be at least 8 characters.'); ok = false;
    }

    return ok;
}

// ══════════════════════════════════════════
// REGISTER VALIDATION
// ══════════════════════════════════════════

function validateRegister() {
    clearAllErrors();
    let ok = true;

    const name    = document.getElementById('fullName')?.value.trim() || '';
    const email   = document.getElementById('email')?.value.trim() || '';
    const phone   = document.getElementById('phone')?.value.trim() || '';
    const pass    = document.getElementById('password')?.value || '';
    const confirm = document.getElementById('confirmPassword')?.value || '';
    const terms   = document.getElementById('agreeTerms')?.checked;

    if (!name || name.length < 2) {
        showError('fullName', 'nameError', 'Please enter your full name (min 2 characters).'); ok = false;
    }

    if (!email) {
        showError('email', 'emailError', 'Email address is required.'); ok = false;
    } else if (!isValidEmail(email)) {
        showError('email', 'emailError', 'Please enter a valid email address.'); ok = false;
    }

    if (!phone) {
        showError('phone', 'phoneError', 'Phone number is required.'); ok = false;
    } else if (!isValidPhone(phone)) {
        showError('phone', 'phoneError', 'Enter a valid Malaysian number (e.g. 012-3456789).'); ok = false;
    }

    if (!pass) {
        showError('password', 'passwordError', 'Password is required.'); ok = false;
    } else if (pass.length < 8) {
        showError('password', 'passwordError', 'Password must be at least 8 characters.'); ok = false;
    }

    if (!confirm) {
        showError('confirmPassword', 'confirmPasswordError', 'Please confirm your password.'); ok = false;
    } else if (confirm !== pass) {
        showError('confirmPassword', 'confirmPasswordError', 'Passwords do not match.'); ok = false;
    }

    if (!terms) {
        const termsErr = document.getElementById('termsError');
        if (termsErr) { termsErr.textContent = 'You must agree to the Terms & Conditions.'; termsErr.style.display = 'block'; }
        ok = false;
    }

    return ok;
}

// ══════════════════════════════════════════
// CHECKOUT VALIDATION
// ══════════════════════════════════════════

function validateCheckout() {
    clearAllErrors();
    let ok = true;

    // Must have items in cart
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    if (cart.length === 0) {
        alert('Your cart is empty! Please add items before checking out.');
        return false;
    }

    const name      = document.getElementById('custName')?.value.trim() || '';
    const phone     = document.getElementById('custPhone')?.value.trim() || '';
    const orderType = document.querySelector('input[name="orderType"]:checked')?.value || '';
    const payment   = document.querySelector('input[name="paymentMethod"]:checked')?.value || '';

    if (!name || name.length < 2) {
        showError('custName', 'custNameError', 'Please enter your full name.'); ok = false;
    }

    if (!phone) {
        showError('custPhone', 'custPhoneError', 'Phone number is required.'); ok = false;
    } else if (!isValidPhone(phone)) {
        showError('custPhone', 'custPhoneError', 'Enter a valid Malaysian number (e.g. 012-3456789).'); ok = false;
    }

    // Delivery address required
    if (orderType === 'delivery') {
        const address = document.getElementById('address')?.value.trim() || '';
        if (!address) {
            showError('address', 'addressError', 'Delivery address is required.'); ok = false;
        }
    }

    // Table number required for dine-in
    if (orderType === 'dine-in') {
        const table = document.getElementById('tableNumber')?.value.trim() || '';
        if (!table || parseInt(table) < 1) {
            showError('tableNumber', 'tableError', 'Please enter a valid table number.'); ok = false;
        }
    }

    // Receipt upload required for online transfer
    if (payment === 'online_transfer') {
        const receipt = document.getElementById('receipt')?.files[0];
        if (!receipt) {
            showError('receipt', 'receiptError', 'Please upload your payment receipt.'); ok = false;
        } else {
            const allowed = ['image/jpeg', 'image/png', 'application/pdf'];
            if (!allowed.includes(receipt.type)) {
                showError('receipt', 'receiptError', 'Invalid file type. Accepted: JPG, PNG, PDF.'); ok = false;
            } else if (receipt.size > 5 * 1024 * 1024) {
                showError('receipt', 'receiptError', 'File size must not exceed 5MB.'); ok = false;
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
        // Live clear on input
        ['email','password'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', function () {
                clearError(id, id + 'Error');
            });
        });
    }

    // ── Register ──
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            if (!validateRegister()) e.preventDefault();
        });
        // Live clear on input
        ['fullName','email','phone','password','confirmPassword'].forEach(id => {
            const errId = id === 'fullName' ? 'nameError' : id + 'Error';
            document.getElementById(id)?.addEventListener('input', function () {
                clearError(id, errId);
            });
        });
        // Live password match check
        document.getElementById('confirmPassword')?.addEventListener('input', function () {
            const pass    = document.getElementById('password')?.value || '';
            const confirm = this.value;
            if (confirm && confirm !== pass) {
                showError('confirmPassword', 'confirmPasswordError', 'Passwords do not match.');
            } else {
                clearError('confirmPassword', 'confirmPasswordError');
            }
        });
    }

    // ── Checkout ──
    const checkoutForm = document.getElementById('checkoutForm');
    if (checkoutForm) {
        checkoutForm.addEventListener('submit', function (e) {
            if (!validateCheckout()) e.preventDefault();
        });
        // Live clear on input
        ['custName','custPhone','address','tableNumber'].forEach(id => {
            document.getElementById(id)?.addEventListener('input', function () {
                clearError(id, id + 'Error');
            });
        });
    }

});
