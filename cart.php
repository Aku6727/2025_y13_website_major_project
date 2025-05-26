<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
    <title>Cart</title>
</head>
<body>
<?php
    session_start();
    include('db_connect.php');
    include('navbar.php');
    $_SESSION['test']=5;
    echo $_SESSION['test'];
    echo "ASD";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <style>
        .cart-card {
            border: 1px solid #ccc;
            padding: 16px;
            margin: 12px 0;
            display: flex;
            align-items: center;
        }
        .cart-card img {
            width: 100px;
            height: auto;
            margin-right: 16px;
        }
    </style>
</head>
<body>
    <h1>Your Cart</h1>
    <?php
    if (!isset($_SESSION['trolley']) & empty($_SESSION['trolley'])) {
        echo "<p>Your cart is empty.</p>";
    } else {
        $prod_ids = array_keys($_SESSION['trolley']);
        $ids_string = implode(',', array_map('intval', $prod_ids));
        $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                  FROM products p
                  JOIN product_type pt ON p.type_id = pt.type_id
                  WHERE p.id IN ($ids_string)";
        $result = mysqli_query($dbconnect, $query);

        if ($result && mysqli_num_rows($result) > 0) {
            $total = 0;
            while ($row = mysqli_fetch_assoc($result)) {
                $prod_id = $row['id'];
                $quantity = $_SESSION['trolley'][$prod_id];
                $subtotal = $row['price'] * $quantity;
                $total += $subtotal;
                ?>
                <div class="cart-card">
                    <img src="<?php echo htmlspecialchars($row['image']); ?>" alt="<?php echo htmlspecialchars($row['prod_name']); ?>">
                    <div>
                        <h3><?php echo htmlspecialchars($row['prod_name']); ?></h3>
                        <p>Type: <?php echo htmlspecialchars($row['product_type']); ?></p>
                        <p>Price: $<?php echo number_format($row['price'], 2); ?></p>
                        <p>Quantity: <?php echo $quantity; ?></p>
                        <p>Subtotal: $<?php echo number_format($subtotal, 2); ?></p>
                    </div>
                </div>
                <?php
            }
            echo "<h2>Total: $" . number_format($total, 2) . "</h2>";
            echo '<form action="checkout.php" method="post"><button type="submit">Checkout</button></form>';
        } else {
            echo "<p>There was a problem loading your cart items.</p>";
        }
    }
    include('footer.php')
    ?>
</body>
</html>
</body>
</html>