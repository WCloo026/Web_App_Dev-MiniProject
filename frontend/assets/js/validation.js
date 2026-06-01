// ========================================
// VALIDATION.JS — Form Validation
// Member 1: Login, Register, QR Order
// ========================================

document.addEventListener('DOMContentLoaded', function () {

    // ========================================
    // 1. LOGIN FORM VALIDATION
    // ========================================
    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function (e) {
            e.preventDefault();
            let valid = true;

            // Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            if (!email.value.trim()) {
                showError(email, emailError, 'Email is required');
                valid = false;
            } else if (!isValidEmail(email.value.trim())) {
                showError(email, emailError, 'Please enter a valid email address');
                valid = false;
            } else {
                clearError(email, emailError);
            }

            // Password
            const password = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            if (!password.value) {
                showError(password, passwordError, 'Password is required');
                valid = false;
            } else if (password.value.length < 6) {
                showError(password, passwordError, 'Password must be at least 6 characters');
                valid = false;
            } else {
                clearError(password, passwordError);
            }

            if (valid) {
                alert('✅ Login successful! (Demo)');
                // loginForm.submit();
            }
        });
    }

    // ========================================
    // 2. REGISTRATION FORM VALIDATION
    // ========================================
    const registerForm = document.getElementById('registerForm');
    if (registerForm) {
        registerForm.addEventListener('submit', function (e) {
            e.preventDefault();
            let valid = true;

            // Full Name
            const fullName = document.getElementById('fullName');
            const nameError = document.getElementById('nameError');
            if (!fullName.value.trim()) {
                showError(fullName, nameError, 'Full name is required');
                valid = false;
            } else if (fullName.value.trim().length < 3) {
                showError(fullName, nameError, 'Name must be at least 3 characters');
                valid = false;
            } else {
                clearError(fullName, nameError);
            }

            // Email
            const email = document.getElementById('email');
            const emailError = document.getElementById('emailError');
            if (!email.value.trim()) {
                showError(email, emailError, 'Email is required');
                valid = false;
            } else if (!isValidEmail(email.value.trim())) {
                showError(email, emailError, 'Please enter a valid email address');
                valid = false;
            } else {
                clearError(email, emailError);
            }

            // Phone
            const phone = document.getElementById('phone');
            const phoneError = document.getElementById('phoneError');
            if (!phone.value.trim()) {
                showError(phone, phoneError, 'Phone number is required');
                valid = false;
            } else if (!/^01\d{8,9}$/.test(phone.value.replace(/[- ]/g, ''))) {
                showError(phone, phoneError, 'Enter a valid phone (e.g. 0123456789)');
                valid = false;
            } else {
                clearError(phone, phoneError);
            }

            // Password
            const password = document.getElementById('password');
            const passwordError = document.getElementById('passwordError');
            if (!password.value) {
                showError(password, passwordError, 'Password is required');
                valid = false;
            } else if (password.value.length < 8) {
                showError(password, passwordError, 'Password must be at least 8 characters');
                valid = false;
            } else {
                clearError(password, passwordError);
            }

            // Confirm Password
            const confirmPassword = document.getElementById('confirmPassword');
            const confirmPasswordError = document.getElementById('confirmPasswordError');
            if (!confirmPassword.value) {
                showError(confirmPassword, confirmPasswordError, 'Please confirm your password');
                valid = false;
            } else if (confirmPassword.value !== password.value) {
                showError(confirmPassword, confirmPasswordError, 'Passwords do not match');
                valid = false;
            } else {
                clearError(confirmPassword, confirmPasswordError);
            }

            // Terms Checkbox
            const agreeTerms = document.getElementById('agreeTerms');
            const termsError = document.getElementById('termsError');
            if (!agreeTerms.checked) {
                showError(null, termsError, 'You must agree to the Terms & Conditions');
                valid = false;
            } else {
                clearError(null, termsError);
            }

            if (valid) {
                alert('✅ Registration successful! (Demo)');
                // registerForm.submit();
            }
        });
    }

    // ========================================
    // 3. QR ORDER VALIDATION
    // ========================================
    // Table number & Pax handled by scrollers (always have a value)
    // Ensure Place Order has at least 1 item
    const btnPlaceOrder = document.getElementById('btnPlaceOrder');
    if (btnPlaceOrder) {
        btnPlaceOrder.addEventListener('click', function (e) {
            const countBadge = document.getElementById('orderCountBadge');
            const count = countBadge ? parseInt(countBadge.textContent) : 0;
            if (count === 0) {
                e.preventDefault();
                e.stopPropagation();
                alert('⚠️ Please add at least 1 item to your order.');
                return false;
            }
        }, true); // Capture phase to run before other handlers
    }

    // ========================================
    // CLEAR ERRORS ON INPUT
    // ========================================
    document.querySelectorAll('input').forEach(input => {
        input.addEventListener('input', function () {
            const errorEl = this.closest('.form-group')?.querySelector('.error-message');
            if (errorEl) {
                clearError(this, errorEl);
            }
        });
    });

    // Checkbox clear error
    const agreeTerms = document.getElementById('agreeTerms');
    if (agreeTerms) {
        agreeTerms.addEventListener('change', function () {
            const termsError = document.getElementById('termsError');
            if (this.checked && termsError) {
                clearError(null, termsError);
            }
        });
    }

});

// ========================================
// HELPER FUNCTIONS
// ========================================
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

function isValidEmail(email) {
    return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
}