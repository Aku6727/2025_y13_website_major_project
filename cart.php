<?php
session_start();
include('db_connect.php');
include('navbar.php');
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
    .cart-card-img {
      height: 100%;
      width: auto;
      object-fit: cover;
    }
    .cart-card .row {
      align-items: center;
    }
  </style>
</head>
<body class="bg-dark text-light">
  <div class="cart_container container cart_container">
    <h1>Your Cart</h1>

<!-- Process the trolley array and seperate quantity and product ids -->
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
      <!-- Display 1 item including quantity, subtotal etc. -->
      <div class="card mb-3 cart-card bg-secondary text-light">
        <div class="row g-0">
          <div class="col-auto">
            <img src="images/<?php echo $row['image']; ?>" style="max-height:300px; width: auto; margin-left: 10px; justify-content: center;" alt="<?php echo $row['prod_name']; ?>">
          </div>
          <div class="col">
            <div class="card-body">
              <h3 class="card-title"><?php echo $row['prod_name']; ?></h3>
              <p class="card-text">Type: <?php echo $row['product_type']; ?></p>
              <p class="card-text">Price: $<?php echo number_format($row['price'],2); ?></p>
              <!-- Input to adjust Quantity -->
              <div class = "form-floating">
                <form method="POST" action="add_to_cart.php">
                  <input type="hidden" name="prod_id" value="<?php echo $row['id']; ?>">
                  <input type="number" name="qty" value="<?php echo $qty; ?>" min="0" max = "9999999999">
                  <button class="btn btn-outline-success btn-primary" type="submit">Update</button>
                </form>
              </div>
              <p class="card-text mb-3">Subtotal: $<?php echo number_format($subtotal,2); ?></p>
              <!-- Button to activate modal -->
              <button type="button" class="btn btn-primary bg-danger text-light" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Remove
              </button>

              <!-- Modal -->
              <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                  <div class="modal-content bg-dark text-light">
                    <div class="modal-header">
                      <h1 class="modal-title fs-5" id="exampleModalLabel">Remove from cart?</h1>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                      <p>Are you sure you want to remove this from your cart?</p>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                      <a href="add_to_cart.php?remove_id=<?php echo $row['id']; ?>" class="btn btn-sm btn-outline-danger bg-danger text-light"> Remove </a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    <?php
        endwhile;
        echo "<h2>Total: $" . number_format($total,2) . "</h2>";
        echo '<form action="account.php" method="post"><button class="btn bg-success text-light" type="submit">Checkout</button></form>';
      else:
        echo "<p>There was a problem loading your cart items.</p>";
      endif;
    endif;

    include('footer.php');
    ?>
  </div>
</body>
</html>
