let cart = JSON.parse(localStorage.getItem("quickbite_cart") || "[]");

function updateCartCount() {
    let totalItems = cart.reduce((sum, item) => sum + item.quantity, 0);
    const cartCount = document.getElementById("cartCount");
    if (cartCount) {
        cartCount.textContent = totalItems;
        cartCount.style.display = totalItems > 0 ? "flex" : "none";
    }
}

function showCartNotification() {
    const notification = document.createElement("div");
    notification.className = "cart-notification";
    notification.textContent = "Item added!";
    document.body.appendChild(notification);

    setTimeout(() => {
        notification.classList.add("show");
    }, 10);

    setTimeout(() => {
        notification.classList.remove("show");
        setTimeout(() => notification.remove(), 300);
    }, 2000);
}


function updateQuantity(id, change) {
    let item = cart.find(i => i.id === id);
    if (item) {
        item.quantity += change;
        if (item.quantity <= 0) {
            cart = cart.filter(i => i.id !== id);
        }
        localStorage.setItem("quickbite_cart", JSON.stringify(cart));
        loadCartPage();
        updateCartCount();
    }
}

function loadCartPage() {
    const container = document.getElementById("cartItemsContainer");
    if (!container) return;

    if (cart.length === 0) {
        container.innerHTML = "<p>Your cart is empty</p>";
        return;
    }

    container.innerHTML = cart.map(item => {
        let menuItem = menuItems.find(m => m.id === item.id);
        return `
        <div class="cart-page-item">
            <div class="cart-page-item-name">${menuItem.name}</div>
            <div class="cart-page-item-controls">
                <button onclick="updateQuantity(${item.id}, -1)">-</button>
                <span>${item.quantity}</span>
                <button onclick="updateQuantity(${item.id}, 1)">+</button>
            </div>
            <span>${(menuItem.price * item.quantity).toFixed(2)} JD</span>
        </div>
        `;
    }).join('');
}

document.addEventListener("DOMContentLoaded", () => {
    updateCartCount();
    loadCartPage();
});

function placeOrder() {
    if (cart.length === 0) {
        alert("Your cart is empty!");
        return;
    }

    cart = [];
    localStorage.setItem("quickbite_cart", JSON.stringify(cart));
    updateCartCount();
    loadCartPage();

    alert("Order placed successfully! ✅");
}