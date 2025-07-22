<!-- Include database connection and navbar -->
<?php
    include('db_connect.php');
    include('navbar.php');
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
  <title>Sign Up</title>
</head> 
<body class="bg-dark text-light">
  <!-- Container for sign up form -->
  <div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card text-bg-dark shadow-lg" style="max-width: 400px; width: 100%;">
      <div class="card-body">
        <h2 class="card-title text-center mb-4">Sign Up</h2>
        <!-- Sign up form -->
        <form method="POST" action="verify_acc.php">
          <div class="mb-3">
            <label for="user" class="form-label">Email</label>
            <input type="email" name="new_email" id="user" class="form-control form-control-lg" required>
            <div id="emailHelp" class="form-text text-light">We'll never share your email.</div>
          </div>
          <?php
          if (isset($_GET['error'])){
          ?>
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
              <strong>Error!</strong> Email already taken, please try another one.
              <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
          <?php
          }
          ?>
          <div class="mb-4">
            <label for="pass" class="form-label">Password</label>
            <input type="password" name="create-pass" id="pass" class="form-control form-control-lg" required>
          </div>
          <button type="submit" class="btn btn-primary w-100">Sign Up</button>
        </form>
        <!-- Link for loggin in -->
        <p class="text-center mt-3">
          Already have an account? 
          <a href="account.php" class="link-primary">Log In</a>
        </p>
      </div>
    </div>
  </div>

  <?php include('footer.php'); ?>
</body>
</html>
