<?php
session_start();

if (isset($_GET['prod_id'])) {
    $prod_id = (int) $_GET['prod_id'];

    if (!isset($_SESSION['trolley'])) {
        $_SESSION['trolley'] = [];
    }

    if (isset($_SESSION['trolley'][$prod_id])) {
        $_SESSION['trolley'][$prod_id]++;
    } else {
        $_SESSION['trolley'][$prod_id] = 1;
    }

    header('Location: cart.php');
    exit;
}

header('Location: browse.php');
exit;
