<?php
session_start();
$id = (int)$_POST['id'];
$action = $_POST['action'];

if(isset($_SESSION['cart'][$id])){
    if($action==='increase') $_SESSION['cart'][$id]++;
    elseif($action==='decrease') {
        $_SESSION['cart'][$id]--;
        if($_SESSION['cart'][$id]<=0) unset($_SESSION['cart'][$id]);
    }
}

header("Location: cart.php");
exit;
?>