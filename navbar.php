<?php include('db_connect.php'); 
  session_start();
?>
<!-- Company name -->
<nav class="navbar navbar-expand-xxl navbar_custom" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand company_name" href="index.php">Voidtech</a>
    <!-- Navbar toggle -->
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <!-- Collapse navbar -->
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
        <!-- Dropdown menu for categorys -->
        <li class="nav-item dropdown">
          <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
            Browse
          </a>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="browse.php?type_id=All">All</a></li>
            <li><hr class="dropdown-divider"></li>
            <?php
              $item_sql = "SELECT * FROM product_type";
              $item_query = mysqli_query($dbconnect, $item_sql);
              while ($item_rs = mysqli_fetch_assoc($item_query)) {
                  $item_id = $item_rs["type_id"];
                  $item_name = $item_rs["product_type"];
                  echo "<li><a class='dropdown-item' href='browse.php?type_id=$item_id'>$item_name</a></li>";
              }
            ?>
          </ul>
        </li>
        <!-- Link to cart -->
        <li class="nav-item">
          <a class="nav-link" href="cart.php">Cart</a>
        </li>
        <!-- Link to log in/out -->
        <li class="nav-item">
          <?php
          // If user is not logged in, show log-in link
          if (!isset($_SESSION['user'])){
            echo "<a class='nav-link' href='account.php'>Log-In</a>";
            }
          // If user is logged in, show log-out link
          else {
            echo "<a class='nav-link' href='verify_acc.php?action=log-out''>Log-out</a>";
          }
          ?>
        </li>
      </ul>
      <!-- Search form -->
      <form class="d-flex align-items-start" method="POST" action="browse.php" role="search">
        <div class="d-flex flex-column me-3">
          <input class="form-control mb-2" name="part_searched" type="search" placeholder="Search" required>
          <!-- Search categorys -->
          <div class="search-options d-flex gap-3">
            <div>
              <input type="radio" name="table_search" value="products" id="name" checked>
              <label for="name">Name</label>
            </div>
            <div>
              <input type="radio" name="table_search" value="manufacturer" id="manufacturer">
              <label for="manufacturer">Manufacturer</label>
            </div>
            <div>
              <input type="radio" name="table_search" value="connection" id="connection">
              <label for="connection">Connection Type</label>
            </div>
          </div>
        </div>
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>
