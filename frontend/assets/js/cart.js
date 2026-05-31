// ========================================
// CART PAGE JAVASCRIPT
// ========================================

document.addEventListener('DOMContentLoaded', function() {
    initCart();
    initClearCart();
    initCheckout();
    initMobileMenu();
    initOrderType();
});

// ========================================
// GET CART DATA
// ========================================
function getCart() {
    return JSON.parse(localStorage.getItem('restaurantCart') || '[]');
}

function saveCart(cart) {
    localStorage.setItem('restaurantCart', JSON.stringify(cart));
}

// ========================================
// INIT CART
// ========================================
function initCart() {
    const cart = getCart();
    const cartEmpty = document.getElementById('cartEmpty');
    const cartContent = document.getElementById('cartContent');
    
    if (cart.length === 0) {
        // Show empty state
        cartEmpty.style.display = 'block';
        cartContent.style.display = 'none';
        return;
    }
    
    // Show cart content
    cartEmpty.style.display = 'none';
    cartContent.style.display = 'block';
    
    renderCartItems(cart);
    updateCartSummary(cart);
    updateBadges(cart);
}

// ========================================
// RENDER CART ITEMS
// ========================================
function renderCartItems(cart) {
    const cartItemsList = document.getElementById('cartItemsList');
    const cartItemCount = document.getElementById('cartItemCount');
    
    const totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    cartItemCount.textContent = totalItems;
    
    cartItemsList.innerHTML = cart.map((item, index) => `
        <div class="cart-item" data-index="${index}">
            <div class="cart-item-image">
                <img src="${item.image || '../../assets/images/food-placeholder.jpg'}" alt="${item.name}" onerror="this.src='../../assets/images/food-placeholder.jpg'">
            </div>
            <div class="cart-item-details">
                <span class="cart-item-name">${item.name}</span>
                <span class="cart-item-price">RM ${item.price.toFixed(2)} each</span>
                <div class="cart-item-actions">
                    <div class="quantity-controls">
                        <button class="quantity-btn" onclick="updateQuantity(${index}, -1)">−</button>
                        <span class="quantity-value">${item.quantity}</span>
                        <button class="quantity-btn" onclick="updateQuantity(${index}, 1)">+</button>
                    </div>
                    <span class="cart-item-subtotal">RM ${(item.price * item.quantity).toFixed(2)}</span>
                    <button class="btn-remove-item" onclick="removeItem(${index})">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

// ========================================
// UPDATE QUANTITY
// ========================================
function updateQuantity(index, change) {
    const cart = getCart();
    
    if (index >= 0 && index < cart.length) {
        cart[index].quantity += change;
        
        if (cart[index].quantity <= 0) {
            removeItem(index);
            return;
        }
        
        saveCart(cart);
        renderCartItems(cart);
        updateCartSummary(cart);
        updateBadges(cart);
    }
}

// ========================================
// REMOVE ITEM
// ========================================
function removeItem(index) {
    const cart = getCart();
    
    if (index >= 0 && index < cart.length) {
        // Animate removal
        const cartItem = document.querySelector(`.cart-item[data-index="${index}"]`);
        if (cartItem) {
            cartItem.classList.add('removing');
        }
        
        setTimeout(() => {
            cart.splice(index, 1);
            saveCart(cart);
            
            if (cart.length === 0) {
                document.getElementById('cartEmpty').style.display = 'block';
                document.getElementById('cartContent').style.display = 'none';
            } else {
                renderCartItems(cart);
                updateCartSummary(cart);
            }
            updateBadges(cart);
        }, 300);
    }
}

// ========================================
// UPDATE CART SUMMARY
// ========================================
function updateCartSummary(cart) {
    const subtotal = cart.reduce((sum, item) => sum + (item.price * item.quantity), 0);
    const tax = subtotal * 0.06;
    const total = subtotal + tax;
    
    document.getElementById('summarySubtotal').textContent = `RM ${subtotal.toFixed(2)}`;
    document.getElementById('summaryTax').textContent = `RM ${tax.toFixed(2)}`;
    document.getElementById('summaryTotal').textContent = `RM ${total.toFixed(2)}`;
    
    // Update checkout button
    const btnCheckout = document.getElementById('btnCheckout');
    btnCheckout.disabled = cart.length === 0;
}

// ========================================
// UPDATE BADGES
// ========================================
function updateBadges(cart) {
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    document.querySelectorAll('.cart-badge').forEach(badge => {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    });
}

// ========================================
// CLEAR CART
// ========================================
function initClearCart() {
    const btnClearCart = document.getElementById('btnClearCart');
    const confirmModal = document.getElementById('confirmModal');
    const btnCancelClear = document.getElementById('btnCancelClear');
    const btnConfirmClear = document.getElementById('btnConfirmClear');
    
    if (!btnClearCart) return;
    
    btnClearCart.addEventListener('click', function() {
        confirmModal.style.display = 'flex';
    });
    
    btnCancelClear.addEventListener('click', function() {
        confirmModal.style.display = 'none';
    });
    
    btnConfirmClear.addEventListener('click', function() {
        localStorage.removeItem('restaurantCart');
        confirmModal.style.display = 'none';
        document.getElementById('cartEmpty').style.display = 'block';
        document.getElementById('cartContent').style.display = 'none';
        updateBadges([]);
    });
    
    // Close modal on overlay click
    confirmModal.addEventListener('click', function(e) {
        if (e.target === confirmModal) {
            confirmModal.style.display = 'none';
        }
    });
}

// ========================================
// CHECKOUT
// ========================================
function initCheckout() {
    const btnCheckout = document.getElementById('btnCheckout');
    
    if (!btnCheckout) return;
    
    btnCheckout.addEventListener('click', function() {
        const orderType = document.querySelector('input[name="orderType"]:checked');
        
        if (orderType && orderType.value === 'online') {
            window.location.href = '../checkout.html';
        } else {
            // Dine-in: go to table number page or directly place order
            alert('Please scan the QR code at your table to place a dine-in order.\n\nRedirecting to QR order page...');
            window.location.href = 'scan-order.html';
        }
    });
}

// ========================================
// ORDER TYPE
// ========================================
function initOrderType() {
    const orderTypeInputs = document.querySelectorAll('input[name="orderType"]');
    const btnCheckout = document.getElementById('btnCheckout');
    
    orderTypeInputs.forEach(input => {
        input.addEventListener('change', function() {
            if (this.value === 'online') {
                btnCheckout.innerHTML = '<i class="fas fa-lock"></i> Proceed to Checkout';
            } else {
                btnCheckout.innerHTML = '<i class="fas fa-qrcode"></i> Order at Table';
            }
        });
    });
}

// ========================================
// MOBILE MENU
// ========================================
function initMobileMenu() {
    const menuToggle = document.getElementById('menuToggle');
    const desktopNav = document.getElementById('desktopNav');
    
    if (menuToggle && desktopNav) {
        menuToggle.addEventListener('click', function() {
            desktopNav.classList.toggle('active');
            const icon = menuToggle.querySelector('i');
            icon.className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
        });
    }
}