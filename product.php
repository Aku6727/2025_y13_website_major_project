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
  <title>Product</title>
</head>
<body class="bg-dark text-light">
  <?php 
    $item_chosen = isset($_GET['part_id']) ? intval($_GET['part_id']) : null;
    if (!is_null($item_chosen)) {  
      $item_sql = "
        SELECT p.id, p.prod_name, pt.product_type, p.price,
               m.manufacturer_name, p.weight, c.connection_type, p.image
        FROM products p
        INNER JOIN manufacturer m ON p.manufacturer_id = m.manufacturer_id
        INNER JOIN product_type pt ON p.type_id = pt.type_id
        INNER JOIN connection c ON p.connection_id = c.connection_id
        WHERE p.id = $item_chosen
      ";
      $item_query = mysqli_query($dbconnect, $item_sql);
      if ($item_query && mysqli_num_rows($item_query) > 0) {
        $item_rs = mysqli_fetch_assoc($item_query);
  ?>
    <div class="container product-container">
      <div class="row justify-content-center">
        <div class="col-lg-6 col-md-7">
          <div class="product-image">
            <img src="images/<?php echo htmlspecialchars($item_rs['image']); ?>"
                 class="img-fluid" alt="item image">
          </div>
        </div>
        <div class="col-lg-6 col-md-5">
          <div class="card border-0 shadow-lg bg-dark text-light">
            <div class="card-body">
              <h1 class="card-title"><?php echo htmlspecialchars($item_rs['prod_name']); ?></h1>
              <p class="card-text mb-4">
                At Voidtech, we take pride in delivering only the highest quality products,
                meticulously crafted for peak performance and durability. …  
              </p>
              <ul class="list-unstyled">
                <li><strong>Type:</strong> <?php echo htmlspecialchars($item_rs['product_type']); ?></li>
                <li><strong>Price:</strong> $<?php echo number_format($item_rs['price'], 2); ?></li>
                <li><strong>Manufacturer:</strong> <?php echo htmlspecialchars($item_rs['manufacturer_name']); ?></li>
                <li><strong>Weight Category:</strong> <?php echo htmlspecialchars($item_rs['weight']); ?>GB</li>
                <li><strong>Connection via:</strong> <?php echo htmlspecialchars($item_rs['connection_type']); ?></li>
              </ul>
              <a href="add_to_cart.php?prod_id=<?php echo $item_rs['id']; ?>" class="btn btn-primary">
                Add to cart
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
      } else {
        echo "<p>Error: No results found.</p>";
      }
    } else {
      echo "<p>Error, please try again later or contact our support team.</p>";
    }

    include('footer.php');
  ?>
</body>
</html>
