<!DOCTYPE html>
<html lang="en">
<head>
  <title>Browse Products</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="styles.css">
</head>

<?php
include('db_connect.php');
include('navbar.php');

$searchTerm = null;
$searchField = null;
$typeId = null;
$query = "";

// Handle search
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!empty($_POST['part_searched']) && !empty($_POST['table_search'])) {
        $searchTerm = mysqli_real_escape_string($dbconnect, $_POST['part_searched']);
        $searchField = mysqli_real_escape_string($dbconnect, $_POST['table_search']);

        $validFields = [
            'products' => 'prod_name',
            'manufacturer' => 'manufacturer',
            'connection' => 'connection_type'
        ];
        

        if (array_key_exists($searchField, $validFields)) {
            $column = $validFields[$searchField];
            $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
                      FROM products p
                      JOIN product_type pt ON p.type_id = pt.type_id
                      WHERE p.$column LIKE '%$searchTerm%'";
        }
    }
}

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

if (!$query) {
    $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
              FROM products p
              JOIN product_type pt ON p.type_id = pt.type_id";
}

$result = mysqli_query($dbconnect, $query) or die('Query error: ' . mysqli_error($dbconnect));
?>

<body class="bg-dark text-light d-flex flex-column min-vh-100">

<main class="container mt-5" style="padding-top: 120px; padding-bottom: 180px;">
  <h2 class="mb-4">
    <?php
    if ($searchTerm) {
        echo "Search results for '<em>" . htmlspecialchars($searchTerm) . "</em>'";
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
          <div class="card h-100">
            <img src="<?= htmlspecialchars($row['image']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['prod_name']) ?>">
            <div class="card-body">
              <h5 class="card-title"><?= htmlspecialchars($row['prod_name']) ?></h5>
              <p class="card-text">Type: <?= htmlspecialchars($row['product_type']) ?></p>
              <p class="card-text">Price: $<?= number_format($row['price'], 2) ?></p>
              <a href="product.php?id=<?= $row['id'] ?>" class="btn btn-primary">View Details</a>
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
