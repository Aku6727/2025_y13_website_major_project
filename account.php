<?php
// Include the necessary files and start the session
    include('db_connect.php');
    include('navbar.php');
    session_start();
// Check is the user is already logged in
    if (isset($_SESSION['user'])) {
        header('Location: checkout.php?user_id=' . $_SESSION['user']);
        exit;
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <title>Log In</title>
</head>
<body class="bg-dark text-light">
<!-- Container for log in form -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card text-bg-dark" style="max-width: 400px; width: 100%;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Log In</h2>
        <!-- Log in form -->
        <form method="POST" action="verify_acc.php">
          <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="email" name="user" class="form-control form-control-lg" id="exampleInputEmail1" aria-describedby="emailHelp" required>
            <div id="emailHelp" class="form-text">We'll never share your email.</div>
          </div>
          <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="password" name="pass" class="form-control form-control-lg" id="exampleInputPassword1" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Submit</button>
        </form>
        <!-- Link to sign up -->
        <p class="text-center mt-3">
          Or <a href="sign_up.php" class="link-primary">Sign Up</a>
        </p>
      </div>
    </div>
  </div>
<!-- Include footer -->
  <?php include('footer.php'); ?>
</body>
</html>
