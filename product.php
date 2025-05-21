<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body class = "bg-dark text-light">

    <!-- Include the database connection and Navbar -->
    <?php
        include('db_connect.php');
        include('navbar.php');
    ?>
    
    <!-- Execute the query -->
    <?php 
        $item_chosen = isset($_GET['part_id']) ? $_GET['part_id'] : null;
        if (!is_null($item_chosen)){  
            $item_sql = "SELECT products.id, products.prod_name, product_type.product_type, products.price, manufacturer.manufacturer_name, products.weight, connection.connection_type, products.image FROM products 
            INNER JOIN manufacturer ON products.manufacturer_id = manufacturer.manufacturer_id 
            INNER JOIN product_type ON products.type_id = product_type.type_id
            INNER JOIN connection ON products.connection_id = connection.connection_id WHERE products.id = $item_chosen";
            $item_query = mysqli_query($dbconnect, $item_sql);
            if ($item_query && mysqli_num_rows($item_query) > 0) {
                $item_rs = mysqli_fetch_assoc($item_query);
                ?>
                <!-- Centered Container -->
                <div class="container product-container">
                    <div class="row justify-content-center">
                        <!-- Product Image on Left -->
                        <div class="col-lg-6 col-md-7">
                            <div class="product-image">
                                <img src="images/<?php echo $item_rs['image']; ?>" class="img-fluid" alt="item image">
                            </div>
                        </div>

                        <!-- Product Details on Right -->
                        <div class="col-lg-6 col-md-5">
                            <div class="card border-0 shadow-lg bg-dark text-light">
                                <div class="card-body">
                                    <h1 class="card-title"><?php echo $item_rs['prod_name']; ?></h1>
                                    <p class="card-text mb-4">
                                        At Voidtech, we take pride in delivering only the highest quality products, meticulously crafted for peak performance and durability. Every item we offer undergoes rigorous testing to ensure it meets our high standards and exceeds customer expectations. Our commitment to excellence guarantees that you receive only the best in innovation, reliability, and value.
                                        We stand firmly behind all our products with a no-hassle return policy. If you're not completely satisfied with your purchase, you can return it within 30 days for a full refund or exchange. Your satisfaction is our top priority, and we strive to ensure a seamless and stress-free shopping experience.
                                        Choose Voidtech for cutting-edge technology and superior customer service, knowing you're investing in quality you can trust.
                                    </p>
                                    <ul class="list-unstyled">
                                        <li><strong>Type:</strong> <?php echo $item_rs['product_type']; ?></li>
                                        <li><strong>Price:</strong> $<?php echo $item_rs['price']; ?></li>
                                        <li><strong>Manufacturer:</strong> <?php echo $item_rs['manufacturer_name']; ?></li>
                                        <li><strong>Weight Category:</strong> <?php echo $item_rs['weight']; ?>GB</li>
                                        <li><strong>Connection via:</strong> <?php echo $item_rs['connection_type']; ?></li>
                                    </ul>
                                    <!-- Add to cart button -->
                                   <a href="account.php?part_id=<?php $item_rs['id'] ?>" class="btn btn-primary">Add to cart</a>
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
            echo "<p>Error, please try again later or contact our support team (details below).</p>";
        }
    ?>

    <!-- Include the footer -->
    <?php
        include('footer.php');
    ?>
</body>
</html>
