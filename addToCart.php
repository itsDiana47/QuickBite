<?php
session_start();

$response = ['cartCount' => 0];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['menu_id'])) {
    $id = (int) $_POST['menu_id'];

    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }

    if (isset($_SESSION['cart'][$id])) {
        $_SESSION['cart'][$id]++;
    } else {
        $_SESSION['cart'][$id] = 1;
    }

    $response['cartCount'] = array_sum($_SESSION['cart']);
}

header('Content-Type: application/json');
echo json_encode($response);
exit;
