<?php
session_start();
include "db.php";

// تعديل الكمية
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id']) && isset($_POST['action'])) {
    $id = (int)$_POST['id'];
    if ($_POST['action'] === 'increase') {
        $_SESSION['cart'][$id] = ($_SESSION['cart'][$id] ?? 0) + 1;
    } elseif ($_POST['action'] === 'decrease') {
        $_SESSION['cart'][$id]--;
        if ($_SESSION['cart'][$id] <= 0) {
            unset($_SESSION['cart'][$id]);
        }
    }
}

// تفريغ الكارت بعد الطلب
if (isset($_GET['clear']) && $_GET['clear'] == 1) {
    unset($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Shopping Cart | QuickBite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">QuickBite</div>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="cart.php">Cart</a></li>
        </ul>
        <a href="menu.php" class="btn btn-primary">Order Now</a>
    </nav>
</header>

<section class="cart-page">
    <div class="cart-page-content">

        <!-- Items Section -->
        <div class="cart-items-section">
            <h2>Shopping Cart</h2>

            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty</p>
            <?php else: ?>
                <?php foreach ($_SESSION['cart'] as $id => $qty): ?>
                    <?php
                        $res = mysqli_query($conn, "SELECT * FROM menu WHERE id=$id");
                        $item = mysqli_fetch_assoc($res);
                        $itemTotal = $item['price'] * $qty;
                    ?>
                    <div class="cart-page-item">
                        <div class="cart-page-item-image"><?= $item['emoji'] ?></div>
                        <div class="cart-page-item-details">
                            <h3><?= $item['name'] ?></h3>
                            <p class="cart-page-item-price"><?= number_format($item['price'],2) ?> JD</p>
                        </div>
                        <div class="cart-page-item-controls">
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="hidden" name="action" value="decrease">
                                <button class="qty-btn">-</button>
                            </form>
                            <span class="quantity-display"><?= $qty ?></span>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?= $id ?>">
                                <input type="hidden" name="action" value="increase">
                                <button class="qty-btn">+</button>
                            </form>
                        </div>
                        <div class="cart-page-item-total"><?= number_format($itemTotal,2) ?> JD</div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>

        <!-- Summary Section -->
        <div class="cart-summary">
            <h3>Order Summary</h3>
            <?php
            $total = 0;
            if (!empty($_SESSION['cart'])) {
                foreach ($_SESSION['cart'] as $id => $qty) {
                    $res = mysqli_query($conn, "SELECT * FROM menu WHERE id=$id");
                    $item = mysqli_fetch_assoc($res);
                    $total += $item['price'] * $qty;
                }
            }
            ?>
            <div class="summary-row">
                <span>Subtotal:</span>
                <span><?= number_format($total,2) ?> JD</span>
            </div>
            <div class="summary-row">
                <span>Delivery:</span>
                <span>3.00 JD</span>
            </div>
            <div class="summary-total">
                <span>Total:</span>
                <span><?= number_format($total+3,2) ?> JD</span>
            </div>

            <?php if(!empty($_SESSION['cart'])): ?>
            <button type="button" class="btn btn-primary checkout-btn-page" onclick="placeOrder()">Get your order</button>
            <?php endif; ?>
        </div>

    </div>
</section>

<script>
function placeOrder() {
    alert("Your order is on the way! 🚀");
    window.location.href = "cart.php?clear=1";
}
</script>


<footer>
    <div class="footer-content">
        <div class="footer-section">
            <h3>QuickBite</h3>
            <p>Delivering happiness through delicious food in Amman, Jordan.</p>
        </div>
        <div class="footer-section">
            <h3>Quick Links</h3>
            <a href="index.php">Home</a>
            <a href="menu.php">Menu</a>
            <a href="about.php">About</a>
            <a href="contact.php">Contact</a>
        </div>
        <div class="footer-section">
            <h3>Contact Us</h3>
            <p>📍 Amman, Jordan</p>
            <p>📞 +962 123 456 789</p>
            <p>✉️ info@quickbite.jo</p>
        </div>
        <div class="footer-section">
            <h3>Follow Us</h3>
            <div class="social-links">
                <a href="#">f</a>
                <a href="#">t</a>
                <a href="#">i</a>
            </div>
        </div>
    </div>
    <div class="copyright">
        <p>&copy; 2025 QuickBite. All rights reserved.</p>
    </div>
</footer>
</body>
</html>
