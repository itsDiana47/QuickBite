<?php
$conn = mysqli_connect("localhost", "root", "", "quickbite");

if (!$conn) {
    die("Database connection failed: " . mysqli_connect_error());
}

// Check if table already exists
$check_table = mysqli_query($conn, "SHOW TABLES LIKE 'menu'");

if (mysqli_num_rows($check_table) == 0) {
    // Create table only if it doesn't exist
    $sql = "CREATE TABLE IF NOT EXISTS menu (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        name VARCHAR(100),
        description TEXT,
        price DECIMAL(6,2),
        emoji VARCHAR(10)
    )";

    if (mysqli_query($conn, $sql)) {
        echo "Table 'menu' created successfully. <br>";
    } else {
        echo "Error creating table: " . mysqli_error($conn) . "<br>";
    }

    // Insert data only if table is new
        $insert_sql = "INSERT INTO menu (name, description, price, emoji) VALUES
    ('Burger Deluxe', 'Juicy beef patty with fresh vegetables', 12.99, '🍔'),
    ('Margherita Pizza', 'Classic pizza with tomato and mozzarella', 14.99, '🍕'),
    ('Caesar Salad', 'Fresh romaine with parmesan and croutons', 9.99, '🥗'),
    ('Chicken Wings', 'Crispy wings with your choice of sauce', 11.99, '🍗'),
    ('Pasta Carbonara', 'Creamy pasta with bacon and parmesan', 13.99, '🍝'),
    ('Fish & Chips', 'Beer-battered fish with crispy fries', 15.99, '🟡'),
    ('Beef Tacos', 'Three soft tacos with seasoned beef', 10.99, '🌮'),
    ('Sushi Platter', 'Assorted fresh sushi rolls', 18.99, '🍣'),
    ('Grilled Steak', 'Premium cut steak with herbs', 22.99, '🥩'),
    ('Chicken Shawarma', 'Authentic Middle Eastern shawarma', 11.99, '🥙'),
    ('Falafel Wrap', 'Crispy falafel with tahini sauce', 9.99, '🧆'),
    ('Ice Cream Sundae', 'Triple scoop with toppings', 6.99, '🍨');";

    if (mysqli_query($conn, $insert_sql)) {
        echo "Menu items inserted successfully. ";
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }
} else {
    // Connection already established, just keep it open
}

// Don't close connection - keep it for other files
?>