<!-- ID: 124167 -->
<!-- MYSQL Exercise 1 -->

<!-- Connect to the database -->

<?php
  $servername = "localhost:3307";
  $username = "root";
  $password = "";

  // Create connection
  $conn = mysqli_connect($servername, $username, $password);

  // Check connection
  if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  // echo "Connected successfully<br>";
?>