<?php
session_start();
include('db_connect.php');
// “remove from cart”
if (isset($_GET['remove_id'])) {
    $rid = (int)$_GET['remove_id'];
    unset($_SESSION['trolley'][$rid]);
    header('Location: cart.php');
    exit;
}
// Add item to cart from the product page (add +1 if already in session)
elseif (isset($_GET['prod_id']) && isset($_GET['qty'])) {
    $prod_id = (int) $_GET['prod_id'];
    $prod_quant = (int) $_GET['qty'];

    if (!isset($_SESSION['trolley'])) {
        $_SESSION['trolley'] = [];
    }
    if (isset($_SESSION['trolley'][$prod_id])) {
        $_SESSION['trolley'][$prod_id] += $prod_quant; 
    } else {
        $_SESSION['trolley'][$prod_id] = $prod_quant; 
    }

    header('Location: cart.php');
    exit;
}
// Adjust quantity of an item already in cart
elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
     if (isset($_POST['prod_id']) && isset($_POST['qty'])) {
        $prod_id = (int) $_POST['prod_id'];
        $prod_quant = (int) $_POST['qty'];
        // handle for if the quantity is 0
        if ((int)$prod_quant === 0){
            $rid = $prod_id;
            unset($_SESSION['trolley'][$rid]);
            header('Location: cart.php');
            exit;
        }
        // If the trolley is not set, create it
        if (!isset($_SESSION['trolley'])) {
            $_SESSION['trolley'] = [];
        }
        // If the product is already in the trolley, update the quantity
        if (isset($_SESSION['trolley'][$prod_id])) {
            $_SESSION['trolley'][$prod_id] = $prod_quant;
        }
        // If the product is not in the trolley, add it
        } else {
            $_SESSION['trolley'][$prod_id] = $prod_quant; 
        }
        // Redirect to cart page
        header('Location: cart.php');
        exit;
     }

// If there is a variable not set, redirect
header('Location: browse.php');
exit;
