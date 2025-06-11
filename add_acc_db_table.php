<?php
// Enable error reporting for debugging purposes
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Include your existing database connection file
include('db_connect.php'); 

// Set the output file name
$filename = 'voidtech_backup_' . date('Y-m-d_H-i-s') . '.sql';

// Start the SQL dump file content
$sql_dump = "-- MySQL database backup for 'voidtech' \n";
$sql_dump .= "-- Generated on " . date('Y-m-d H:i:s') . " \n\n";

// Query to get all tables from the database
$sql = "SHOW TABLES";
$result = $conn->query($sql);

// Check if tables are found
if ($result->num_rows > 0) {
    // Loop through all tables
    while ($row = $result->fetch_assoc()) {
        $table = $row['Tables_in_voidtech']; // Replace 'voidtech' with your database name
        
        // Add table structure (CREATE TABLE)
        $sql_dump .= "\n-- Table structure for `$table` \n";
        
        // Fetch the table schema using SHOW CREATE TABLE
        $create_table_query = "SHOW CREATE TABLE `$table`";
        $createResult = $conn->query($create_table_query);
        $createRow = $createResult->fetch_assoc();
        $sql_dump .= $createRow['Create Table'] . ";\n\n";
    
        // Add data (INSERT INTO)
        $sql_dump .= "-- Data for `$table` \n";
        $data_query = "SELECT * FROM `$table`";
        $dataResult = $conn->query($data_query);
    
        // Loop through rows in each table
        while ($data_row = $dataResult->fetch_assoc()) {
            $columns = array_keys($data_row);
            $values = array_map(function($value) use ($conn) {
                return "'" . $conn->real_escape_string($value) . "'";  // Escape strings properly for MySQL
            }, array_values($data_row));
            $sql_dump .= "INSERT INTO `$table` (`" . implode("`, `", $columns) . "`) VALUES (" . implode(", ", $values) . ");\n";
        }
        $sql_dump .= "\n";
    }

    // Save the SQL dump to a file
    file_put_contents($filename, $sql_dump);

    // Provide the download link
    echo "Database backup completed! <a href='$filename' download>Download SQL file</a>";
} else {
    echo "No tables found in the database.";
}

// Close the MySQL database connection
$conn->close();
?>
