// ========================================
// QR ORDER PAGE JS
// ========================================

const menuItems = [
    { id: 1, name: "Nasi Lemak", category: "main", price: 8.00, image: "../../assets/images/food1.jpg", badge: "bestseller" },
    { id: 2, name: "Chicken Chop", category: "main", price: 15.00, image: "../../assets/images/food2.jpg", badge: "" },
    { id: 3, name: "Mango Smoothie", category: "drinks", price: 6.50, image: "../../assets/images/food3.jpg", badge: "" },
    { id: 4, name: "Nasi Goreng Kampung", category: "main", price: 7.50, image: "../../assets/images/menu2.jpg", badge: "" },
    { id: 5, name: "Tom Yum Soup", category: "soup", price: 10.00, image: "../../assets/images/menu1.jpg", badge: "spicy" },
    { id: 6, name: "Iced Lemon Tea", category: "drinks", price: 3.50, image: "../../assets/images/menu3.jpg", badge: "" },
    { id: 7, name: "Chicken Satay", category: "snacks", price: 12.00, image: "../../assets/images/menu4.jpg", badge: "bestseller" },
    { id: 8, name: "Cendol Special", category: "dessert", price: 5.50, image: "../../assets/images/food1.jpg", badge: "new" },
    { id: 9, name: "Sup Tulang Gearbox", category: "main", price: 22.00, image: "../../assets/images/menu3.jpg", badge: "bestseller" },
    { id: 10, name: "Sirap Bandung", category: "drinks", price: 4.00, image: "../../assets/images/menu4.jpg", badge: "" },
];

let currentTable = 1;
let currentPax = 1;
let currentOrder = [];
let activeCategory = "all";
const MAX_TABLE = 30;
const MAX_PAX = 10;

document.addEventListener('DOMContentLoaded', () => {
    initScrollers();
    initDineIn();
    updateCartBadge();
    // Add to DOMContentLoaded:
    initQrNav();
});

// Add this function:
function initQrNav() {
    const navHome = document.getElementById('navHome');
    const navMenu = document.getElementById('navMenu');
    const navCart = document.getElementById('navCart');
    const navOrders = document.getElementById('navOrders');
    const navAll = [navHome, navMenu, navCart, navOrders];

    navHome.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('menuOrderScreen').style.display = 'none';
        document.getElementById('orderSummaryBar').style.display = 'none';
        document.getElementById('tableSelectionScreen').style.display = 'block';
        setActiveNav(navHome);
    });

    navMenu.addEventListener('click', (e) => {
        e.preventDefault();
        document.getElementById('tableSelectionScreen').style.display = 'none';
        document.getElementById('menuOrderScreen').style.display = 'block';
        document.getElementById('orderSummaryBar').style.display = 'block';
        setActiveNav(navMenu);
    });

    navCart.addEventListener('click', (e) => {
        e.preventDefault();
        const panel = document.getElementById('orderItemsPanel');
        const icon = document.getElementById('orderToggleIcon');
        panel.style.display = panel.style.display === 'none' ? 'block' : 'none';
        icon.classList.toggle('open', panel.style.display !== 'none');
        setActiveNav(navCart);
    });

    navOrders.addEventListener('click', (e) => {
        e.preventDefault();
        window.location.href = 'order-status.php';
    });

    function setActiveNav(active) {
        navAll.forEach(n => n.classList.remove('active'));
        active.classList.add('active');
    }
}

// ========================================
// TABLE & PAX SCROLLERS
// ========================================
function initScrollers() {
    document.querySelectorAll('.scroller-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            const target = this.dataset.target;
            const isUp = this.classList.contains('scroller-up');
            
            if (target === 'table') {
                currentTable += isUp ? 1 : -1;
                if (currentTable > MAX_TABLE) currentTable = 1;
                if (currentTable < 1) currentTable = MAX_TABLE;
                document.getElementById('tableValue').textContent = currentTable;
            } else if (target === 'pax') {
                currentPax += isUp ? 1 : -1;
                if (currentPax > MAX_PAX) currentPax = 1;
                if (currentPax < 1) currentPax = MAX_PAX;
                document.getElementById('paxValue').textContent = currentPax;
            }
        });
    });
}

// ========================================
// DINE IN BUTTON
// ========================================
function initDineIn() {
    document.getElementById('btnDineIn').addEventListener('click', () => {
        document.getElementById('tableSelectionScreen').style.display = 'none';
        document.getElementById('menuOrderScreen').style.display = 'block';
        document.getElementById('orderSummaryBar').style.display = 'block';
        document.getElementById('displayTableNumber').textContent = currentTable;
        document.getElementById('displayPax').textContent = currentPax + ' pax';
        document.getElementById('confirmTable').textContent = currentTable;
        document.getElementById('confirmPax').textContent = currentPax;
        
        renderMenu(menuItems);
        initCategoryFilter();
        initOrderPanel();
        initPlaceOrder();
        initChangeTable();
        initMobileMenu();
    });
}

// ========================================
// CHANGE TABLE
// ========================================
function initChangeTable() {
    document.getElementById('btnChangeTable').addEventListener('click', () => {
        document.getElementById('tableSelectionScreen').style.display = 'flex';
        document.getElementById('menuOrderScreen').style.display = 'none';
        document.getElementById('orderSummaryBar').style.display = 'none';
    });
}

// ========================================
// RENDER MENU
// ========================================
function renderMenu(items) {
    const grid = document.getElementById('menuGrid');
    const noResults = document.getElementById('noResults');
    let filtered = activeCategory === 'all' ? items : items.filter(i => i.category === activeCategory);

    if (filtered.length === 0) {
        grid.innerHTML = '';
        noResults.style.display = 'block';
        return;
    }
    noResults.style.display = 'none';

    grid.innerHTML = filtered.map(item => {
        const inOrder = currentOrder.find(o => o.id === item.id);
        const qty = inOrder ? inOrder.quantity : 0;
        return `
            <div class="menu-item-card">
                <div class="menu-item-image">
                    <img src="${item.image}" alt="${item.name}">
                    ${item.badge ? `<span class="menu-item-badge badge-${item.badge}">${getBadge(item.badge)}</span>` : ''}
                </div>
                <div class="menu-item-body">
                    <div class="menu-item-name">${item.name}</div>
                    <div class="menu-item-price">RM ${item.price.toFixed(2)}</div>
                    <div class="menu-item-footer">
                        ${qty > 0 ? `<span class="quantity-added">x${qty}</span>` : '<span></span>'}
                        <button class="btn-add-item ${qty > 0 ? 'added' : ''}" onclick="addToOrder(${item.id})">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                </div>
            </div>
        `;
    }).join('');
}

function getBadge(b) { const m = { bestseller: '🔥', new: '✨', spicy: '🌶️' }; return m[b] || ''; }

function initCategoryFilter() {
    document.querySelectorAll('#categoryFilter .filter-btn').forEach(btn => {
        btn.addEventListener('click', function() {
            document.querySelectorAll('#categoryFilter .filter-btn').forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            activeCategory = this.dataset.category;
            renderMenu(menuItems);
        });
    });
}

// ========================================
// ORDER MANAGEMENT
// ========================================
function addToOrder(id) {
    const item = menuItems.find(i => i.id === id);
    const existing = currentOrder.find(o => o.id === id);
    existing ? existing.quantity++ : currentOrder.push({ id: item.id, name: item.name, price: item.price, quantity: 1 });
    renderMenu(menuItems);
    updateOrderSummary();
    showToast(`${item.name} added!`);
}

function removeFromOrder(id) {
    const existing = currentOrder.find(o => o.id === id);
    if (existing) {
        existing.quantity--;
        if (existing.quantity <= 0) currentOrder = currentOrder.filter(o => o.id !== id);
    }
    renderMenu(menuItems);
    updateOrderSummary();
}

function initOrderPanel() {
    const btnToggle = document.getElementById('btnToggleOrder');
    const panel = document.getElementById('orderItemsPanel');
    const icon = document.getElementById('orderToggleIcon');
    
    btnToggle.addEventListener('click', () => {
        const isOpen = panel.style.display !== 'none';
        panel.style.display = isOpen ? 'none' : 'block';
        icon.classList.toggle('open', !isOpen);
    });
    
    document.getElementById('btnClearOrder').addEventListener('click', () => {
        currentOrder = [];
        renderMenu(menuItems);
        updateOrderSummary();
        panel.style.display = 'none';
        icon.classList.remove('open');
    });
}

function updateOrderSummary() {
    const count = currentOrder.reduce((s, i) => s + i.quantity, 0);
    const total = currentOrder.reduce((s, i) => s + i.price * i.quantity, 0);
    document.getElementById('orderCountBadge').textContent = count;
    document.getElementById('orderTotal').textContent = `RM ${total.toFixed(2)}`;
    document.getElementById('btnPlaceOrder').disabled = count === 0;
    
    const list = document.getElementById('orderItemsList');
    const empty = document.getElementById('orderEmpty');
    if (count === 0) {
        list.innerHTML = '';
        empty.style.display = 'block';
    } else {
        empty.style.display = 'none';
        list.innerHTML = currentOrder.map(o => `
            <div class="order-item-row">
                <span>${o.name}</span>
                <div style="display:flex;align-items:center;gap:0.5rem;">
                    <button class="qty-btn" onclick="removeFromOrder(${o.id})">−</button>
                    <span>${o.quantity}</span>
                    <button class="qty-btn" onclick="addToOrder(${o.id})">+</button>
                </div>
                <span class="order-item-price">RM ${(o.price * o.quantity).toFixed(2)}</span>
            </div>
        `).join('');
    }
}

// ========================================
// PLACE ORDER MODAL
// ========================================
function initPlaceOrder() {
    const btnPlace = document.getElementById('btnPlaceOrder');
    const modal = document.getElementById('placeOrderModal');
    const btnCancel = document.getElementById('btnCancelOrder');
    const btnConfirm = document.getElementById('btnConfirmOrder');
    const successModal = document.getElementById('successModal');
    
    btnPlace.addEventListener('click', () => {
        const count = currentOrder.reduce((s, i) => s + i.quantity, 0);
        const total = currentOrder.reduce((s, i) => s + i.price * i.quantity, 0);
        document.getElementById('confirmItems').textContent = count;
        document.getElementById('confirmTotal').textContent = `RM ${total.toFixed(2)}`;
        modal.style.display = 'flex';
    });
    
    btnCancel.addEventListener('click', () => modal.style.display = 'none');
    modal.addEventListener('click', e => { if (e.target === modal) modal.style.display = 'none'; });
    
    btnConfirm.addEventListener('click', () => {
        modal.style.display = 'none';
        successModal.style.display = 'flex';
        document.getElementById('successOrderId').textContent = '#' + Math.floor(Math.random() * 9000 + 1000);
        currentOrder = [];
        renderMenu(menuItems);
        updateOrderSummary();
        document.getElementById('orderItemsPanel').style.display = 'none';
    });
    
    document.getElementById('btnCloseSuccess').addEventListener('click', () => successModal.style.display = 'none');
    successModal.addEventListener('click', e => { if (e.target === successModal) successModal.style.display = 'none'; });
}

// ========================================
// HELPERS
// ========================================
function showToast(msg) {
    const container = document.getElementById('toastContainer');
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.textContent = msg;
    container.appendChild(toast);
    setTimeout(() => { if (toast.parentNode) toast.remove(); }, 1500);
}

function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((s, i) => s + i.quantity, 0);
    const badge = document.getElementById('cartBadge');
    if (badge) { badge.textContent = count; badge.style.display = count > 0 ? 'flex' : 'none'; }
}

function initMobileMenu() {
    const menuToggle = document.getElementById('menuToggle');
    const desktopNav = document.getElementById('desktopNav');
    if (menuToggle && desktopNav) {
        menuToggle.addEventListener('click', () => {
            desktopNav.classList.toggle('active');
            menuToggle.querySelector('i').className = desktopNav.classList.contains('active') ? 'fas fa-times' : 'fas fa-bars';
        });
    }
}