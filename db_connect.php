<?php
    // Connect to the database
    $dbconnect = mysqli_connect("localhost", "root", "root", "voidtech.db");

    // Check the connection
    if (mysqli_connect_errno()) {
        // Log the error to a file
        error_log("Database connection failed: " . mysqli_connect_error(), 3, "error_log.txt");

        // Display a user-friendly message
        echo "<p>Database connection unsuccesfull, please try again later</p>";
    }
?>
