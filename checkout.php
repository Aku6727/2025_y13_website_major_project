<?php
    session_start();
    include('db_connect.php');
    include('navbar.php');


    // Ensure user is logged in and cart exists
    if (!isset($_SESSION['user']) || empty($_SESSION['trolley'])) {
        header("Location: cart.php");
        exit();
    }
    // Set the user session variable
    $user_id = $_SESSION['user_id'];
    echo $user_id;

    //Insert new order
    $order_query = "INSERT INTO orders (user_id) VALUES ($user_id)";
    echo $order_query;
    if (!mysqli_query($dbconnect, $order_query)) {
        die("Failed to create order: " . mysqli_error($dbconnect));
    }

    $order_id = mysqli_insert_id($dbconnect); // get the order ID just created

    //Insert each item in the cart into the purchased table
    foreach ($_SESSION['trolley'] as $product_id => $quantity) {
        $product_id = (int)$product_id;
        $quantity = (int)$quantity;
        // Run sql session
        $purchase_query = "INSERT INTO purchased (order_id, prod_id, quant) VALUES ($order_id, $product_id, $quantity)";
        if (!mysqli_query($dbconnect, $purchase_query)) {
            die("Error adding product to order: " . mysqli_error($dbconnect));
        }
    }

    //Clear cart and redirect
    unset($_SESSION['trolley']);
    header("Location: orders.php?checkout=success");
    exit();
    
?>
