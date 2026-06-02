// ========================================
// MENU PAGE JAVASCRIPT
// ========================================

// Mock Menu Data (Replace with API call later)
const menuData = [
    // Main Course
    { id: 1, name: "Nasi Lemak", category: "main", price: 8.00, image: "../assets/images/food1.jpg", description: "Fragrant coconut rice with sambal, egg, and anchovies", badge: "bestseller", rating: 4.8, spicy: false },
    { id: 2, name: "Chicken Chop", category: "main", price: 15.00, image: "../assets/images/food2.jpg", description: "Grilled chicken with mushroom sauce", badge: "", rating: 4.5, spicy: false },
    { id: 4, name: "Nasi Goreng Kampung", category: "main", price: 7.50, image: "../assets/images/menu2.jpg", description: "Traditional fried rice with anchovies", badge: "", rating: 4.6, spicy: true },
    { id: 5, name: "Mee Goreng Mamak", category: "main", price: 6.50, image: "../assets/images/menu1.jpg", description: "Spicy fried noodles Malaysian style", badge: "spicy", rating: 4.3, spicy: true },
    { id: 9, name: "Sup Tulang Gearbox", category: "main", price: 22.00, image: "../assets/images/menu3.jpg", description: "Signature bone marrow soup - our specialty!", badge: "bestseller", rating: 4.9, spicy: false },
    
    // Drinks
    { id: 3, name: "Mango Smoothie", category: "drinks", price: 6.50, image: "../assets/images/food3.jpg", description: "Fresh mango blended with yogurt", badge: "", rating: 4.7, spicy: false },
    { id: 7, name: "Iced Lemon Tea", category: "drinks", price: 3.50, image: "../assets/images/menu3.jpg", description: "Refreshing homemade lemon tea", badge: "", rating: 4.9, spicy: false },
    { id: 8, name: "Sirap Bandung", category: "drinks", price: 4.00, image: "../assets/images/menu4.jpg", description: "Rose syrup with milk - a classic!", badge: "", rating: 4.4, spicy: false },
    
    // Desserts
    { id: 14, name: "Cendol Special", category: "dessert", price: 5.50, image: "../assets/images/food1.jpg", description: "Shaved ice with pandan jelly and coconut milk", badge: "new", rating: 4.6, spicy: false },
    { id: 15, name: "Sago Gula Melaka", category: "dessert", price: 5.00, image: "../assets/images/food2.jpg", description: "Sago pearls with palm sugar syrup", badge: "", rating: 4.5, spicy: false },
    
    // Snacks
    { id: 10, name: "Chicken Satay", category: "snacks", price: 12.00, image: "../assets/images/menu4.jpg", description: "Grilled skewers with peanut sauce (10 pcs)", badge: "bestseller", rating: 4.6, spicy: false },
    { id: 11, name: "Curry Puff", category: "snacks", price: 4.00, image: "../assets/images/food3.jpg", description: "Crispy pastry with spicy potato filling (3 pcs)", badge: "", rating: 4.2, spicy: true },
    { id: 12, name: "Pisang Goreng", category: "snacks", price: 5.00, image: "../assets/images/menu2.jpg", description: "Crispy banana fritters with honey", badge: "", rating: 4.3, spicy: false },
    
    // Soup
    { id: 6, name: "Tom Yum Soup", category: "soup", price: 10.00, image: "../assets/images/menu1.jpg", description: "Spicy and sour Thai-inspired soup", badge: "spicy", rating: 4.8, spicy: true },
    { id: 13, name: "Sup Daging", category: "soup", price: 9.00, image: "../assets/images/food1.jpg", description: "Hearty beef soup with vegetables", badge: "", rating: 4.4, spicy: false },
];

let activeCategory = 'all';
let searchQuery = '';

// ========================================
// INITIALIZATION
// ========================================
document.addEventListener('DOMContentLoaded', function() {
    renderMenuItems(menuData);
    initCategoryFilter();
    initSearch();
    initMobileMenu();
    updateCartBadge();
    updateFloatingCart();
});

// ========================================
// RENDER MENU ITEMS
// ========================================
function renderMenuItems(items) {
    const menuGrid = document.getElementById('menuGrid');
    const resultsCount = document.getElementById('resultsCount');
    const noResults = document.getElementById('noResults');
    
    if (!menuGrid) return;
    
    // Filter items
    let filteredItems = items;
    if (activeCategory !== 'all') {
        filteredItems = filteredItems.filter(item => item.category === activeCategory);
    }
    if (searchQuery) {
        const query = searchQuery.toLowerCase();
        filteredItems = filteredItems.filter(item => 
            item.name.toLowerCase().includes(query) || 
            item.description.toLowerCase().includes(query)
        );
    }
    
    // Update results count
    if (filteredItems.length === 0) {
        resultsCount.style.display = 'none';
        noResults.style.display = 'block';
        menuGrid.innerHTML = '';
        return;
    }
    
    resultsCount.style.display = 'block';
    noResults.style.display = 'none';
    resultsCount.textContent = `Showing ${filteredItems.length} item(s)`;
    
    // Render cards
    menuGrid.innerHTML = filteredItems.map(item => `
        <div class="menu-item-card" data-category="${item.category}">
            <div class="menu-item-image">
                <img src="${item.image}" alt="${item.name}" loading="lazy">
                ${item.badge ? `<span class="menu-item-badge badge-${item.badge}">${getBadgeText(item.badge)}</span>` : ''}
            </div>
            <div class="menu-item-body">
                <div class="menu-item-header">
                    <h3 class="menu-item-name">${item.name}</h3>
                    <span class="menu-item-price">RM ${item.price.toFixed(2)}</span>
                </div>
                <p class="menu-item-description">${item.description}</p>
                <div class="menu-item-meta">
                    <span>⭐ ${item.rating}</span>
                    ${item.spicy ? '<span>🌶️ Spicy</span>' : ''}
                </div>
                <div class="menu-item-actions">
                    <button class="btn-view-detail" onclick="viewDetail(${item.id})">
                        <i class="fas fa-info-circle"></i> Details
                    </button>
                    <button class="btn-add-cart-sm" onclick="addToCartHandler(${item.id}, '${item.name}', ${item.price}, '${item.image}')">
                        <i class="fas fa-plus"></i> Add
                    </button>
                </div>
            </div>
        </div>
    `).join('');
}

function getBadgeText(badge) {
    const badges = {
        'bestseller': '🔥 Best Seller',
        'new': '✨ New',
        'spicy': '🌶️ Spicy'
    };
    return badges[badge] || badge;
}

// ========================================
// CATEGORY FILTER
// ========================================
function initCategoryFilter() {
    const filterBtns = document.querySelectorAll('.filter-btn');
    
    filterBtns.forEach(btn => {
        btn.addEventListener('click', function() {
            // Update active state
            filterBtns.forEach(b => b.classList.remove('active'));
            this.classList.add('active');
            
            // Update category and re-render
            activeCategory = this.dataset.category;
            renderMenuItems(menuData);
        });
    });
    
    // Check URL params for category
    const urlParams = new URLSearchParams(window.location.search);
    const categoryParam = urlParams.get('category');
    if (categoryParam) {
        const targetBtn = document.querySelector(`[data-category="${categoryParam}"]`);
        if (targetBtn) {
            targetBtn.click();
        }
    }
}

// ========================================
// SEARCH FUNCTIONALITY
// ========================================
function initSearch() {
    const searchInput = document.getElementById('menuSearch');
    const searchClear = document.getElementById('searchClear');
    
    if (!searchInput) return;
    
    searchInput.addEventListener('input', function() {
        searchQuery = this.value.trim();
        
        // Show/hide clear button
        if (searchClear) {
            searchClear.style.display = searchQuery ? 'block' : 'none';
        }
        
        renderMenuItems(menuData);
    });
    
    if (searchClear) {
        searchClear.addEventListener('click', function() {
            searchInput.value = '';
            searchQuery = '';
            this.style.display = 'none';
            renderMenuItems(menuData);
            searchInput.focus();
        });
    }
    
    // Check URL params for search
    const urlParams = new URLSearchParams(window.location.search);
    const searchParam = urlParams.get('search');
    if (searchParam) {
        searchInput.value = searchParam;
        searchQuery = searchParam;
        if (searchClear) searchClear.style.display = 'block';
        renderMenuItems(menuData);
    }
}

// ========================================
// ADD TO CART
// ========================================
function addToCartHandler(id, name, price, image) {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    
    const existingItem = cart.find(item => item.id === id);
    if (existingItem) {
        existingItem.quantity += 1;
    } else {
        cart.push({ id, name, price, image, quantity: 1 });
    }
    
    localStorage.setItem('restaurantCart', JSON.stringify(cart));
    updateCartBadge();
    updateFloatingCart();
    showToast(`${name} added to cart!`);
    
    // Animate button
    const buttons = document.querySelectorAll('.btn-add-cart-sm');
    buttons.forEach(btn => {
        if (btn.getAttribute('onclick') && btn.getAttribute('onclick').includes(`(${id},`)) {
            btn.classList.add('added');
            btn.innerHTML = '<i class="fas fa-check"></i> Added';
            setTimeout(() => {
                btn.classList.remove('added');
                btn.innerHTML = '<i class="fas fa-plus"></i> Add';
            }, 1500);
        }
    });
}

// ========================================
// VIEW DETAIL (Modal or redirect)
// ========================================
function viewDetail(id) {
    // For now, scroll to top and highlight
    // Later: open modal or redirect to detail page
    const item = menuData.find(i => i.id === id);
    if (item) {
        alert(`${item.name}\n\n${item.description}\n\nPrice: RM ${item.price.toFixed(2)}\nRating: ⭐ ${item.rating}`);
    }
}

// ========================================
// UPDATE CART BADGE & FLOATING CART
// ========================================
function updateCartBadge() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const badges = document.querySelectorAll('.cart-badge');
    badges.forEach(badge => {
        badge.textContent = count;
        badge.style.display = count > 0 ? 'flex' : 'none';
    });
}

function updateFloatingCart() {
    const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
    const count = cart.reduce((sum, item) => sum + item.quantity, 0);
    
    const floatingCount = document.getElementById('floatingCartCount');
    const floatingCart = document.getElementById('floatingCart');
    
    if (floatingCount) {
        floatingCount.textContent = count;
    }
    
    if (floatingCart) {
        floatingCart.style.display = count > 0 ? 'flex' : 'none';
    }
}

// ========================================
// TOAST NOTIFICATION
// ========================================
function showToast(message) {
    const container = document.getElementById('toastContainer');
    if (!container) return;
    
    const toast = document.createElement('div');
    toast.className = 'toast';
    toast.innerHTML = `<i class="fas fa-check-circle"></i> ${message}`;
    
    container.appendChild(toast);
    
    setTimeout(() => {
        if (toast.parentNode) {
            toast.parentNode.removeChild(toast);
        }
    }, 2000);
}

// ========================================
// MOBILE MENU (same as main.js)
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
        
        document.addEventListener('click', function(event) {
            if (!menuToggle.contains(event.target) && !desktopNav.contains(event.target)) {
                desktopNav.classList.remove('active');
                menuToggle.querySelector('i').className = 'fas fa-bars';
            }
        });
    }
}