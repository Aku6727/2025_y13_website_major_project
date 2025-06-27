<?php
// Include database connection and start session
include('db_connect.php');
session_start();
// Check if the user is logging out
if (isset($_GET['action']) && $_GET['action'] === 'log-out') {
    unset($_SESSION['user']);
    header('Location: account.php');
    exit();
}
// Check if the user is already logged in
elseif (isset($_SESSION['user'])) {
    // if so, redirect to checkout
    header('Location: checkout.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  
    // SIGN UP 
    if (isset($_POST['new_email'], $_POST['create-pass'])) {
        $new_user = mysqli_real_escape_string($dbconnect, $_POST['new_email']);
        $new_pass = $_POST['create-pass'];
        $sql_user_check  = "SELECT * 
                     FROM `account` 
                     WHERE `user` = '$new_user'";
        $result_user_check = mysqli_query($dbconnect, $sql_user_check);
        $user_num_results = mysqli_fetch_assoc($result_user_check);
        if (empty($user_num_results)){
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
        }else{
            header('Location: sign_up.php?error=user_taken');
        }
    }

        
    
    
    //LOG IN
    if (isset($_POST['user'], $_POST['pass'])) {
        $user_req = mysqli_real_escape_string($dbconnect, $_POST['user']);
        $pass_req = $_POST['pass'];
        // Check if user exists
        $query = "SELECT * 
                  FROM `account` 
                  WHERE `user` = '$user_req' 
                  LIMIT 1";
        $result = mysqli_query($dbconnect, $query);
        
        if (!$result) {
            header("Location: account.php");
            die("SQL error: " . mysqli_error($dbconnect));
        }
        if (mysqli_num_rows($result) === 1) {
            $row = mysqli_fetch_assoc($result);
            $_SESSION['user_id'] = $row['id'];
            if (password_verify($pass_req, $row['pass'])) {
                $_SESSION['user'] = $user_req;
                header('Location: account.php');
                exit();
            } else {
                echo "Incorrect password.";
                header('Location: account.php');
            }
        } else {
            echo "User not found.";
        }
    }
}
?>
