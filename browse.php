<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Browse Products</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class="bg-dark text-light">
<?php
include('navbar.php');
include('db_connect.php');
$searchTerm = null;
$typeId = null;
if (isset($_POST['part_searched']) && trim($_POST['part_searched']) !== '') {
    $searchTerm = mysqli_real_escape_string($dbconnect, $_POST['part_searched']);
}
if (isset($_GET['type_id']) && is_numeric($_GET['type_id'])) {
    $typeId = (int) $_GET['type_id'];
}
if ($searchTerm) {
    $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
              FROM products p
              JOIN product_type pt ON p.type_id = pt.type_id
              WHERE p.prod_name LIKE '%{$searchTerm}%'";
} elseif ($typeId) {
    $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
              FROM products p
              JOIN product_type pt ON p.type_id = pt.type_id
              WHERE pt.type_id = {$typeId}";
} else {
    $query = "SELECT p.id, p.prod_name, p.price, p.image, pt.product_type
              FROM products p
              JOIN product_type pt ON p.type_id = pt.type_id";
}
$result = mysqli_query($dbconnect, $query) or die('Query Error: '. mysqli_error($dbconnect));
?>
    <div class="container my-5">
        <h2 class="mb-4">
            <?php
            if ($searchTerm) {
                echo "Search results for '<em>" . htmlspecialchars($searchTerm) . "</em>'";
            } elseif ($typeId) {
                $typeRes = mysqli_query($dbconnect, "SELECT product_type FROM product_type WHERE type_id={$typeId}");
                $typeName = mysqli_fetch_assoc($typeRes)['product_type'] ?? 'Category';
                echo "Category: <em>" . htmlspecialchars($typeName) . "</em>";
            } else {
                echo 'All Products';
            }
            ?>
        </h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <div class="row row-cols-1 row-cols-md-3 g-4">
                <?php while ($row = mysqli_fetch_assoc($result)): ?>
                    <div class="col">
                        <div class="card h-100">
                            <img src="<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['prod_name']); ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo htmlspecialchars($row['prod_name']); ?></h5>
                                <p class="card-text">Type: <?php echo htmlspecialchars($row['product_type']); ?></p>
                                <p class="card-text">Price: $<?php echo number_format($row['price'], 2); ?></p>
                                <a href="product.php?id=<?php echo $row['id']; ?>" class="btn btn-primary">View Details</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            </div>
        <?php else: ?>
            <p>No items found.</p>
        <?php endif; ?>
    </div>
<?php include('footer.php'); ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>
