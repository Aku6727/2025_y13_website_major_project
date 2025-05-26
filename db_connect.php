<?php


  $servername = "mysqlforest.hosts.net.nz";
  $username = "stacd342_user";
  $password = "@gidnUp4";
  $dbname = "stacd342_voidtech";

  // Create connection
  $dbconnect = new mysqli($servername, $username, $password, $dbname);

  // Check connection
  if ($dbconnect->connect_error) {
    die("Connection failed: " . $dbconnect->connect_error);
  }
 ?>