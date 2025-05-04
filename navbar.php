<?php include('db_connect.php'); ?>
<nav class="navbar navbar-expand-lg navbar_custom" data-bs-theme="dark">
  <div class="container-fluid">
    <a class="navbar-brand company_name" href="index.php">Voidtech</a>

    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
      data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
      aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="index.php">Home</a>
        </li>
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
        <li class="nav-item">
          <a class="nav-link" href="log_in.php">Support</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="log_in.php">Log in/Sign up</a>
        </li>
      </ul>

      <form class="d-flex align-items-start" method="POST" action="browse.php" role="search">
        <div class="d-flex flex-column me-3">
          <input class="form-control mb-2" name="part_searched" type="search" placeholder="Search" required>

          <div class="search-options d-flex gap-3">
            <div>
              <input type="radio" name="table_search" value="products" id="name" required>
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
