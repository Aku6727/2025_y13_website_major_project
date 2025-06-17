<?php
include('db_connect.php');
session_start();

if (isset($_GET['action']) && $_GET['action'] === 'log-out') {
    unset($_SESSION['user']);
    header('Location: account.php');
    exit();
}
elseif (isset($_SESSION['user'])) {
    header('Location: orders.php?user=' . urlencode($_SESSION['user']));
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    // SIGN UP 
    if (isset($_POST['new_email'], $_POST['create-pass'])) {
        $new_user = mysqli_real_escape_string($dbconnect, $_POST['new_email']);
        $new_pass = $_POST['create-pass'];
        
        if ($new_user && $new_pass) {
            $hash = password_hash($new_pass, PASSWORD_DEFAULT);
            $sql  = "INSERT INTO `account` (`user`,`pass`) VALUES ('$new_user','$hash')";
            
            if (mysqli_query($dbconnect, $sql)) {
                header('Location: account.php');
                exit();
            } else {
                echo "Error creating account: " . mysqli_error($dbconnect);
            }
        } else {
            echo "Please fill in both username and password.";
            echo "User: $new_user. Password: $new_pass";
        }
        exit();
    }
    
    //LOG IN
    if (isset($_POST['user'], $_POST['pass'])) {
        $user_req = mysqli_real_escape_string($dbconnect, $_POST['user']);
        $pass_req = $_POST['pass'];
        
        $query = "SELECT `pass` 
                  FROM `account` 
                  WHERE `user` = '$user_req' 
                  LIMIT 1";
        $result = mysqli_query($dbconnect, $query);
        
        if (!$result) {
            die("SQL error: " . mysqli_error($dbconnect));
        }
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            if (password_verify($pass_req, $row['pass'])) {
                $_SESSION['user'] = $user_req;
                header('Location: orders.php?user=' . urlencode($user_req));
                exit();
            } else {
                echo "Incorrect password.";
            }
        } else {
            echo "User not found.";
        }
    }
}
?>
