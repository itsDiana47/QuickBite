<?php
session_start();
include "db.php";

$cartCount = isset($_SESSION['cart']) ? array_sum($_SESSION['cart']) : 0;

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'])) {
    $id = (int) $_POST['menu_id'];
    if (!isset($_SESSION['cart'])) $_SESSION['cart'] = [];
    if (isset($_SESSION['cart'][$id])) $_SESSION['cart'][$id]++;
    else $_SESSION['cart'][$id] = 1;
    $cartCount = array_sum($_SESSION['cart']);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu | QuickBite</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header>
    <nav>
        <div class="logo">QuickBite</div>
        <ul class="nav-links" id="navLinks">
            <li><a href="index.php">Home</a></li>
            <li><a href="menu.php">Menu</a></li>
            <li><a href="about.php">About</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li>
                
            </li>
        </ul>
        <a href="cart.php" class="cart-button">
                    🛒 <span class="cart-count"><?= $cartCount ?></span>
                </a>
    </nav>
</header>

<section class="menu" id="menu">
    <div class="section-header">
        <h2>Our Popular Menu</h2>
        <p>Discover our most loved dishes</p>
    </div>
    <div class="menu-grid" id="menuGrid">
        <?php
        $result = mysqli_query($conn, "SELECT * FROM menu");
        while ($row = mysqli_fetch_assoc($result)):
        ?>
        <div class="menu-item">
            <div class="menu-item-image"><?= $row['emoji'] ?></div>
            <div class="menu-item-content">
                <h3><?= $row['name'] ?></h3>
                <p><?= $row['description'] ?></p>
                <div class="menu-item-footer">
                    <span class="price"><?= $row['price'] ?> JD</span>
                    <form method="POST">
                        <input type="hidden" name="menu_id" value="<?= $row['id'] ?>">
                        <button class="btn btn-small btn-primary" type="submit">Add to Cart</button>
                    </form>
                </div>
            </div>
        </div>
        <?php endwhile; ?>
    </div>
</section>

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
