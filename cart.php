<?php
session_start();
include('db_connect.php');
include('navbar.php');

// “remove from cart”
if (isset($_GET['remove_id'])) {
    $rid = (int)$_GET['remove_id'];
    unset($_SESSION['trolley'][$rid]);
    header('Location: cart.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
  <title>Cart</title>
  <style>
    /* make image hug the card’s full height, width auto */
    .cart-card-img {
      height: 100%;
      width: auto;
      object-fit: cover;
    }
    /* ensure the card body and img column stretch to same height */
    .cart-card .row {
      align-items: center;
    }
  </style>
</head>
<body class="bg-dark text-light">
  <div class="cart_container container cart_container">
    <h1>Your Cart</h1>

    <?php if (empty($_SESSION['trolley'])): ?>
      <p>Your cart is empty.</p>
    <?php else:
      $prod_ids   = array_keys($_SESSION['trolley']);
      $ids_string = implode(',', array_map('intval', $prod_ids));
      $query = "
        SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
        FROM products p
        JOIN product_type pt ON p.type_id = pt.type_id
        WHERE p.id IN ($ids_string)
      ";
      $result = mysqli_query($dbconnect, $query);

      if ($result && mysqli_num_rows($result) > 0):
        $total = 0;
        while ($row = mysqli_fetch_assoc($result)):
          $qty      = $_SESSION['trolley'][$row['id']];
          $subtotal = $row['price'] * $qty;
          $total   += $subtotal;
    ?>
      <div class="card mb-3 cart-card bg-secondary text-light">
        <div class="row g-0">
          <div class="col-auto">
            <img src="images/<?php echo htmlspecialchars($row['image']); ?>"
                 class="img-fluid cart-card-img"
                 style="max-height:200px;"  <!-- you can tweak max-height -->
                 alt="<?php echo htmlspecialchars($row['prod_name']); ?>">
          </div>
          <div class="col">
            <div class="card-body">
              <h3 class="card-title"><?php echo htmlspecialchars($row['prod_name']); ?></h3>
              <p class="card-text">Type: <?php echo htmlspecialchars($row['product_type']); ?></p>
              <p class="card-text">Price: $<?php echo number_format($row['price'],2); ?></p>
              <p class="card-text">Quantity: <?php echo $qty; ?></p>
              <p class="card-text mb-3">Subtotal: $<?php echo number_format($subtotal,2); ?></p>
              <a href="cart.php?remove_id=<?php echo $row['id']; ?>"
                 class="btn btn-sm btn-outline-danger">
                Remove
              </a>
            </div>
          </div>
        </div>
      </div>
    <?php
        endwhile;
        echo "<h2>Total: $" . number_format($total,2) . "</h2>";
        echo '<form action="account.php" method="post"><button class="btn btn-primary" type="submit">Checkout</button></form>';
      else:
        echo "<p>There was a problem loading your cart items.</p>";
      endif;
    endif;

    include('footer.php');
    ?>
  </div>
</body>
</html>
