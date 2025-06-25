<?php
session_start();
include('db_connect.php');

// Protect the page
if (!isset($_SESSION['user_id'])) {
  header('Location: account.php');
  exit;
}
$user_id = (int)$_SESSION['user_id'];

// Prepare & run the query
$sql = "
  SELECT
    o.id AS order_id,
    p.id AS product_id,
    p.prod_name,
    pt.product_type,
    m.manufacturer_name,
    c.connection_type,
    p.price,
    pu.quant,
    p.image
  FROM orders o
  JOIN purchased pu     ON o.id    = pu.order_id
  JOIN products p       ON pu.prod_id = p.id
  JOIN product_type pt  ON p.type_id  = pt.type_id
  JOIN manufacturer m   ON p.manufacturer_id = m.manufacturer_id
  JOIN connection c     ON p.connection_id   = c.connection_id
  WHERE o.user_id = ($user_id)
  ORDER BY o.id
";
$res = mysqli_query($dbconnect, $sql);

// Group rows by order
$orders = [];
while ($row = mysqli_fetch_assoc($res)) {
  $oid = $row['order_id'];
  if (!isset($orders[$oid])) {
    $orders[$oid] = [
      'items' => [],
      'total' => 0,
    ];
  }
  $subtotal = $row['price'] * $row['quant'];
  $orders[$oid]['items'][] = $row + ['subtotal' => $subtotal];
  $orders[$oid]['total']     += $subtotal;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
  <link rel="stylesheet" href="styles.css">
  <title>My Orders</title>
</head>
<body class="bg-dark text-light">
  <?php include('navbar.php'); ?>

  <div class="container py-5" style="margin-top:100px; margin-bottom:100px;">
    <h1 class="mb-4">Your Orders</h1>

    <?php if (empty($orders)): ?>
      <p>You have no orders yet.</p>
    <?php else: ?>
      <?php foreach ($orders as $oid => $order): ?>
        <div class="card mb-5">
          <div class="card-header">
            <strong>Order #<?= $oid ?></strong>
          </div>
          <div class="card-body">
            <!-- Mobile dropdown -->
            <div class="dropdown d-block d-md-none mb-3 text-center">
              <button
                class="btn btn-primary dropdown-toggle"
                type="button"
                id="orderDropdown-<?= $oid ?>"
                data-bs-toggle="dropdown"
                aria-expanded="false"
              >
                View items…
              </button>
              <ul 
                class="dropdown-menu" 
                aria-labelledby="orderDropdown-<?= $oid ?>"
              >
                <?php foreach ($order['items'] as $item): ?>
                  <li class="dropdown-item text-dark">
                    <?= htmlspecialchars($item['prod_name']) ?>
                    — Qty: <?= (int)$item['quant'] ?>
                    — $<?= number_format($item['subtotal'], 2) ?>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>
            <!-- Display total for portrait -->
            <div class="text-center fw-bold d-md-none mb-3 mt-5">
              Order Total: $<?= number_format($order['total'], 2) ?>
            </div>

            <!-- Desktop table -->
            <table class="table table_custom d-none d-md-table">
              <thead>
                <tr>
                  <th>Product</th>
                  <th>Type</th>
                  <th>Manufacturer</th>
                  <th>Connection</th>
                  <th>Price</th>
                  <th>Qty</th>
                  <th>Subtotal</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($order['items'] as $item): ?>
                  <tr>
                    <td>
                      <img 
                        src="images/<?= htmlspecialchars($item['image']) ?>"
                        alt="" width="60" class="me-2 align-middle"
                      >
                      <?= htmlspecialchars($item['prod_name']) ?>
                    </td>
                    <td><?= htmlspecialchars($item['product_type']) ?></td>
                    <td><?= htmlspecialchars($item['manufacturer_name']) ?></td>
                    <td><?= htmlspecialchars($item['connection_type']) ?></td>
                    <td>$<?= number_format($item['price'], 2) ?></td>
                    <td><?= (int)$item['quant'] ?></td>
                    <td>$<?= number_format($item['subtotal'], 2) ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
            <!-- Display total for landscape -->
            <div class="text-end fw-bold d-none d-md-table">
              Order Total: $<?= number_format($order['total'], 2) ?>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    <?php endif; ?>
  </div>

  <?php include('footer.php'); ?>
</body>
</html>
