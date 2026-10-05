<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>QuickBite | Amman, Jordan</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header>
        <nav>
            <div class="logo">QuickBite</div>
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php">Home</a></li>
                <li><a href="menu.php">Menu</a></li>
                <li><a href="about.php">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php">Cart</a></li>
            </ul>
            <button class="btn btn-primary"><a href="cart.php">Order Now</a></button>
            <div class="menu-toggle" id="menuToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <!-- Hero Section -->
    <section class="hero" id="home">
        <div class="hero-content">
            <div class="hero-text">
                <h1>Delicious Food <span>Delivered Fast</span></h1>
                <p>Experience the finest cuisine in Amman, Jordan.  Fresh ingredients, authentic flavors, and lightning-fast delivery to your doorstep.</p>
                <div class="hero-buttons">
                    <button class="btn btn-primary" onclick="window.location.href='menu.php'">Order Now</button>
                </div>
            </div>
            <div class="hero-image">
                <img src="https://images.unsplash.com/photo-1504674900247-0877df9cc836?w=800&h=600&fit=crop" alt="Delicious food">
            </div>
        </div>
    </section>

    <!-- Footer -->
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
    <script src="j.js"></script>
</body>
</html>