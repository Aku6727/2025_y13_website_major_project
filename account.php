<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class = "bg-dark text-light">

    <!-- Include the database connection and Navbar -->
    <?php
        include('db_connect.php');
        include('navbar.php');
    ?>
    <?php
        session_start();
        if (isset($_SESSION['user'])) {
            header('Location: orders.php?user_id=' . $_SESSION['user']);
        }
    ?>
    <form style="margin-top: 200px" method="POST" action="verify_acc.php">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email address</label>
            <input type="user" name="user" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
        </div>
        <div class="mb-3">
            <label for="exampleInputPassword1" class="form-label">Password</label>
            <input type="pass" name="pass" class="form-control" id="exampleInputPassword1">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <?php
        include ('footer.php');
    ?>
</body>
</html>