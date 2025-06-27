<?php
include('db_connect.php');

$searchTerm = null;
$searchField = null;
$typeId = null;
$query = "";

// Search (searchbar)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (!empty($_POST['part_searched']) && !empty($_POST['table_search'])) {
      $searchTerm = mysqli_real_escape_string($dbconnect, $_POST['part_searched']);
      $searchField = mysqli_real_escape_string($dbconnect, $_POST['table_search']);

      // Search off product name
      if ($searchField === 'products') {
          $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                    FROM products p
                    JOIN product_type pt ON p.type_id = pt.type_id
                    WHERE p.prod_name LIKE '%$searchTerm%'";
      // Seach off manufacturer name
      } elseif ($searchField === 'manufacturer') {
          $manQuery = "SELECT manufacturer_id FROM manufacturer WHERE manufacturer_name LIKE '%$searchTerm%' LIMIT 1";
          $manResult = mysqli_query($dbconnect, $manQuery);

          if ($man = mysqli_fetch_assoc($manResult)) {
              $manId = $man['manufacturer_id'];
              $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                        FROM products p
                        JOIN product_type pt ON p.type_id = pt.type_id
                        WHERE p.manufacturer_id = $manId";
          } else {
              $query = "SELECT * FROM products WHERE 1=0";
          }
          // Search off connection type
      } elseif ($searchField === 'connection') {
          $connQuery = "SELECT connection_id FROM connection WHERE connection_type LIKE '%$searchTerm%' LIMIT 1";
          $connResult = mysqli_query($dbconnect, $connQuery);

          if (!$connResult) {
              die("Connection lookup failed: " . mysqli_error($dbconnect));
          }

          if ($conn = mysqli_fetch_assoc($connResult)) {
              $connId = $conn['connection_id'];
              $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                        FROM products p
                        JOIN product_type pt ON p.type_id = pt.type_id
                        WHERE p.connection_id = $connId";
          } else {
              $query = "SELECT * FROM products WHERE 1=0";
          }
      }
  }
}


// Handle category browsing
if (!$query && isset($_GET['type_id'])) {
    if ($_GET['type_id'] === 'All') {
        $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                  FROM products p
                  JOIN product_type pt ON p.type_id = pt.type_id";
    } else {
        $typeId = (int) $_GET['type_id'];
        $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                  FROM products p
                  JOIN product_type pt ON p.type_id = pt.type_id
                  WHERE p.type_id = $typeId";
    }
}

// Default: show all products
if (!$query) {
    $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
              FROM products p
              JOIN product_type pt ON p.type_id = pt.type_id";
}

$result = mysqli_query($dbconnect, $query) or die('Query error: ' . mysqli_error($dbconnect));

$len_results = mysqli_num_rows($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Browse Products</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
  <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-dark text-light d-flex flex-column min-vh-100">

<?php include('navbar.php'); ?>

<main class="container mt-5" style="padding-top: 120px; padding-bottom: 180px;">
  <h2 class="mb-4">
    <?php
    if ($searchTerm) {
        echo "Search results for '<em>" . htmlspecialchars($searchTerm) . "</em>'";
        echo "Number of results '<em>" . htmlspecialchars($len_results) . "</em>'";
    } elseif (!empty($typeId)) {
        $nameRes = mysqli_query($dbconnect, "SELECT product_type FROM product_type WHERE type_id = $typeId");
        $typeName = mysqli_fetch_assoc($nameRes)['product_type'] ?? 'Category';
        echo "Category: <em>$typeName</em>";
    } else {
        echo "All Products";
    }
    ?>
  </h2>

  <?php if (mysqli_num_rows($result) > 0): ?>
    <div class="row row-cols-1 row-cols-md-3 g-4">
    <?php while ($row = mysqli_fetch_assoc($result)): ?>
      <div class="col">
        <div class="card h-100 bg-secondary text-light">
          <img src="images/<?= htmlspecialchars($row['image']) ?>"
              class="card-img-top" alt="<?= htmlspecialchars($row['prod_name']) ?>">
          <div class="card-body">
            <h4 class="card-title"><?= htmlspecialchars($row['prod_name']) ?></h4>
            <p class="card-text">Type: <?= htmlspecialchars($row['product_type']) ?></p>
            <p class="card-text">Price: $<?= number_format($row['price'],2) ?></p>
            <a href="product.php?part_id=<?= $row['id'] ?>" class="btn btn-primary">View Details</a>
          </div>
        </div>
      </div>
    <?php endwhile; ?>
  </div>
  <?php else: ?>
    <p>No products found.</p>
  <?php endif; ?>
</main>

<?php include('footer.php'); ?>
</body>
</html>
