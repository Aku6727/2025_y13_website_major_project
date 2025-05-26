<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to cart</title>
</head>
<body>
    <?php
        session_start();

        if (isset($_GET['prod_id'])) {
            $prod_id = (int)$_GET['prod_id'];

            // IMake a trolley if it doesn't exist
            if (!isset($_SESSION['trolley'])) {
                $_SESSION['trolley'] = [];
            }

            // Add or update product quantity
            if (isset($_SESSION['trolley'][$prod_id])) {
                $_SESSION['trolley'][$prod_id] += 1;
            } else {
                $_SESSION['trolley'][$prod_id] = 1;
            }
            header('Location: cart.php');
        } else {
            header( 'Location: browse.php');
        }
    ?>
</body>
</html>