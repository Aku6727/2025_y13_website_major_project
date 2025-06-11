<?php
session_start();
include('db_connect.php');
if (isset($_GET['action']) && $_GET['action'] === 'log-out') {
    unset($_SESSION['user']);
    header('Location: index.php');
    exit();
}
if (isset($_SESSION['user'])) {
    $set_user = $_SESSION['user'];
    header('Location: orders.php?user=' . urlencode($set_user));
    exit();
} else {
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $user_req = mysqli_real_escape_string($dbconnect, $_POST['user']);
        $pass_req = mysqli_real_escape_string($dbconnect, $_POST['pass']);
        echo $user_req;
        echo $pass_req;
        if (trim($user_req) !== '' && trim($pass_req) !== '') {
            $query = "SELECT * FROM account WHERE user = '$user_req'";

            $qry = mysqli_query($dbconnect, $query);
            $aa = mysqli_fetch_assoc($qry);

            $hashpass = $aa['pass'];
            $user_id = $aa['id'];
            if (password_verify($pass_req, $hashpass)) {

                $_SESSION['user'] = $aa['id'];
                header('Location: orders.php?user=' . urlencode($user_id));
            }
        } else{
            header('Location: account.php');
        }

    }
}