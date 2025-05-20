<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="styles.css">
</head>
<body>
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
            $item_rs = mysqli_fetch_assoc($item_query);
            ?>
            


            <?php
            echo "<div class='product_content'>";
            // Check if there are any results
            if ($item_query && mysqli_num_rows($item_query) > 0) {
                // If there are results, display the photo and specs
                echo "<div class='product_image'><img src='images/" . $item_rs['image'] . "' alt='item image'></div>";
                // Display a blurb and the specs
                echo "<div class='product_description'>
                        <div class='product_title'><h1>" . $item_rs['prod_name'] . "</h1></div>
                        <div class='product_specs'>
                            <p>All innovixus produts are made to be at the avsolute pinacle of performance. <br>
                                We are confident that all our products are the absolutely the best in the world 
                                and therefore give you the following guarntee: <br> If you are able to find a product that can outperform
                                our one we will mtach it's price</p>
                            <p>Type: " . $item_rs['product_type'] . "</p>
                            <p>Price: $" . $item_rs['price'] . "</p>
                            <p>Manufacturer: " . $item_rs['manufacturer_name'] . "</p>
                            <p>Weight Category: " . $item_rs['weight'] . "GB</p>    
                            <p>Connection via: " . $item_rs['connection_type'] . "</p>   
                        </div>
                    </div>";
            } else {
                echo "<p>Error: No results found</p>";
            }
            echo "</div>";
    } else{
        echo "<p>Error, please try again later or contact out support team <br> (details below)</p>";
    }
        ?>
        </div>
    <!-- Include the footer -->
    <?php
        include('footer.php')
    ?>
</body>
</html>
