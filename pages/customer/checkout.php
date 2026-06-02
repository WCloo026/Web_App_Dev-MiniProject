<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Checkout - Restoran SUP TULANG ZZ</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../../assets/css/style.css">
</head>
<body>

    <!-- ========== HEADER ========== -->
    <?php include '../../includes/header.php'; ?>

    <!-- ========== CHECKOUT PAGE ========== -->
    <main class="checkout-page">
        <div class="container">
            <div class="checkout-page-header">
                <h1><i class="fas fa-credit-card"></i> Checkout</h1>
                <a href="cart.php" class="back-link">
                    <i class="fas fa-arrow-left"></i> Back to Cart
                </a>
            </div>

            <div class="checkout-layout">
                <!-- Left: Customer Details Form -->
                <div class="checkout-form-section">
                    <!-- Delivery Details -->
                    <div class="checkout-card">
                        <h2><i class="fas fa-truck"></i> Delivery / Pickup Details</h2>

                        <form class="checkout-form" id="checkoutForm" method="POST" action="../../api/orders.php">
                            <input type="hidden" name="action" value="place_order">

                            <!-- Order Type -->
                            <div class="form-group">
                                <label>Order Type <span class="required">*</span></label>
                                <div class="order-type-toggle">
                                    <label class="order-type-btn">
                                        <input type="radio" name="orderType" value="dine-in" id="typeDineIn">
                                        <span><i class="fas fa-utensils"></i> Dine-In</span>
                                    </label>
                                    <label class="order-type-btn">
                                        <input type="radio" name="orderType" value="takeaway" id="typeTakeaway">
                                        <span><i class="fas fa-shopping-bag"></i> Takeaway</span>
                                    </label>
                                    <label class="order-type-btn">
                                        <input type="radio" name="orderType" value="delivery" id="typeDelivery" checked>
                                        <span><i class="fas fa-motorcycle"></i> Delivery</span>
                                    </label>
                                </div>
                            </div>

                            <!-- Customer Info -->
                            <div class="form-row">
                                <div class="form-group">
                                    <label for="custName">Full Name <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-user"></i>
                                        <input type="text" id="custName" name="custName" placeholder="Your full name" required>
                                    </div>
                                    <span class="error-message" id="custNameError"></span>
                                </div>
                                <div class="form-group">
                                    <label for="custPhone">Phone Number <span class="required">*</span></label>
                                    <div class="input-wrapper">
                                        <i class="fas fa-phone"></i>
                                        <input type="tel" id="custPhone" name="custPhone" placeholder="01X-XXXXXXX" required>
                                    </div>
                                    <span class="error-message" id="custPhoneError"></span>
                                </div>
                            </div>

                            <!-- Delivery Address (shown for delivery) -->
                            <div class="form-group" id="addressSection">
                                <label for="address">Delivery Address <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-map-marker-alt"></i>
                                    <textarea id="address" name="address" rows="3" placeholder="Enter your full delivery address"></textarea>
                                </div>
                                <span class="error-message" id="addressError"></span>
                            </div>

                            <!-- Table Number (shown for dine-in) -->
                            <div class="form-group" id="tableSection" style="display:none;">
                                <label for="tableNumber">Table Number <span class="required">*</span></label>
                                <div class="input-wrapper">
                                    <i class="fas fa-chair"></i>
                                    <input type="number" id="tableNumber" name="tableNumber" placeholder="Enter table number" min="1">
                                </div>
                                <span class="error-message" id="tableError"></span>
                            </div>

                            <!-- Special Notes -->
                            <div class="form-group">
                                <label for="notes">Special Requests / Allergies</label>
                                <div class="input-wrapper">
                                    <i class="fas fa-comment"></i>
                                    <textarea id="notes" name="notes" rows="2" placeholder="Any special requests or dietary requirements?"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Payment Section -->
                    <div class="checkout-card">
                        <h2><i class="fas fa-wallet"></i> Payment</h2>

                        <div class="payment-methods">
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="cash" id="paymentCash" checked>
                                <span class="payment-label">
                                    <i class="fas fa-money-bill-wave"></i>
                                    <div>
                                        <strong>Cash on Delivery / At Counter</strong>
                                        <small>Pay when you receive your order</small>
                                    </div>
                                </span>
                            </label>
                            <label class="payment-option">
                                <input type="radio" name="paymentMethod" value="online_transfer" id="paymentTransfer">
                                <span class="payment-label">
                                    <i class="fas fa-mobile-alt"></i>
                                    <div>
                                        <strong>Online Transfer / DuitNow</strong>
                                        <small>Upload payment receipt below</small>
                                    </div>
                                </span>
                            </label>
                        </div>

                        <!-- Receipt Upload (shown for online transfer) -->
                        <div class="receipt-upload" id="receiptSection" style="display:none;">
                            <div class="form-group">
                                <label for="receipt">Payment Receipt <span class="required">*</span></label>
                                <div class="upload-area" id="uploadArea">
                                    <i class="fas fa-cloud-upload-alt"></i>
                                    <p>Click or drag to upload receipt</p>
                                    <small>Accepted: JPG, PNG, PDF (Max 5MB)</small>
                                    <input type="file" id="receipt" name="receipt" accept=".jpg,.jpeg,.png,.pdf">
                                </div>
                                <div class="file-preview" id="filePreview" style="display:none;">
                                    <i class="fas fa-file-check"></i>
                                    <span id="fileName"></span>
                                    <button type="button" id="removeFile"><i class="fas fa-times"></i></button>
                                </div>
                                <span class="error-message" id="receiptError"></span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Order Summary -->
                <div class="checkout-summary-section">
                    <div class="checkout-summary-card">
                        <h2>Order Summary</h2>
                        <div class="summary-items" id="summaryItems">
                            <!-- Items loaded from localStorage via JS -->
                            <p class="summary-loading"><i class="fas fa-spinner fa-spin"></i> Loading cart...</p>
                        </div>

                        <div class="summary-divider"></div>

                        <div class="summary-row">
                            <span>Subtotal</span>
                            <span id="checkoutSubtotal">RM 0.00</span>
                        </div>
                        <div class="summary-row" id="deliveryFeeRow">
                            <span>Delivery Fee</span>
                            <span id="deliveryFee">RM 3.00</span>
                        </div>
                        <div class="summary-row">
                            <span>Tax (6% SST)</span>
                            <span id="checkoutTax">RM 0.00</span>
                        </div>
                        <div class="summary-row summary-total">
                            <span>Total</span>
                            <span id="checkoutTotal">RM 0.00</span>
                        </div>

                        <button type="submit" form="checkoutForm" class="btn-place-order" id="btnPlaceOrder">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- ========== FOOTER ========== -->
    <?php include '../../includes/footer.php'; ?>

    <script src="../../assets/js/cart.js"></script>
    <script src="../../assets/js/validation.js"></script>
    <script>
        // Load cart summary and handle order type toggle
        document.addEventListener('DOMContentLoaded', function () {
            loadCheckoutSummary();
            setupOrderTypeToggle();
            setupPaymentToggle();
            setupFileUpload();
        });

        function loadCheckoutSummary() {
            const cart = JSON.parse(localStorage.getItem('restaurantCart') || '[]');
            const container = document.getElementById('summaryItems');
            if (cart.length === 0) {
                container.innerHTML = '<p class="empty-cart-msg"><i class="fas fa-shopping-basket"></i> Your cart is empty. <a href="../menu.php">Browse menu</a></p>';
                document.getElementById('btnPlaceOrder').disabled = true;
                return;
            }
            let subtotal = 0;
            container.innerHTML = cart.map(item => {
                const lineTotal = item.price * item.quantity;
                subtotal += lineTotal;
                return `<div class="summary-item">
                    <span class="summary-item-name">${item.name} <span class="qty-badge">x${item.quantity}</span></span>
                    <span class="summary-item-price">RM ${lineTotal.toFixed(2)}</span>
                </div>`;
            }).join('');
            const deliveryType = document.querySelector('input[name="orderType"]:checked')?.value;
            const deliveryFee = deliveryType === 'delivery' ? 3.00 : 0.00;
            const tax = subtotal * 0.06;
            const total = subtotal + tax + deliveryFee;
            document.getElementById('checkoutSubtotal').textContent = 'RM ' + subtotal.toFixed(2);
            document.getElementById('checkoutTax').textContent = 'RM ' + tax.toFixed(2);
            document.getElementById('checkoutTotal').textContent = 'RM ' + total.toFixed(2);
            document.getElementById('deliveryFee').textContent = 'RM ' + deliveryFee.toFixed(2);
        }

        function setupOrderTypeToggle() {
            document.querySelectorAll('input[name="orderType"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    document.getElementById('addressSection').style.display = this.value === 'delivery' ? 'block' : 'none';
                    document.getElementById('tableSection').style.display = this.value === 'dine-in' ? 'block' : 'none';
                    document.getElementById('deliveryFeeRow').style.display = this.value === 'delivery' ? 'flex' : 'none';
                    loadCheckoutSummary();
                });
            });
        }

        function setupPaymentToggle() {
            document.querySelectorAll('input[name="paymentMethod"]').forEach(radio => {
                radio.addEventListener('change', function () {
                    document.getElementById('receiptSection').style.display = this.value === 'online_transfer' ? 'block' : 'none';
                });
            });
        }

        function setupFileUpload() {
            const fileInput = document.getElementById('receipt');
            const uploadArea = document.getElementById('uploadArea');
            const preview = document.getElementById('filePreview');
            const fileName = document.getElementById('fileName');
            const removeBtn = document.getElementById('removeFile');

            uploadArea.addEventListener('click', () => fileInput.click());
            uploadArea.addEventListener('dragover', e => { e.preventDefault(); uploadArea.classList.add('dragover'); });
            uploadArea.addEventListener('dragleave', () => uploadArea.classList.remove('dragover'));
            uploadArea.addEventListener('drop', e => {
                e.preventDefault();
                uploadArea.classList.remove('dragover');
                if (e.dataTransfer.files.length) {
                    fileInput.files = e.dataTransfer.files;
                    showFilePreview(e.dataTransfer.files[0]);
                }
            });
            fileInput.addEventListener('change', () => {
                if (fileInput.files.length) showFilePreview(fileInput.files[0]);
            });
            removeBtn.addEventListener('click', () => {
                fileInput.value = '';
                uploadArea.style.display = 'block';
                preview.style.display = 'none';
            });

            function showFilePreview(file) {
                fileName.textContent = file.name;
                uploadArea.style.display = 'none';
                preview.style.display = 'flex';
            }
        }
    </script>
</body>
</html>
