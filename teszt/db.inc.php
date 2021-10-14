<?php
  $servername = "localhost";
  $username = "php";
  $password = "RTB)fy8oQYVR/[fJ";
  $database = "ulesrend";
  $conn = new mysqli($servername, $username, $password, $database);
  if ($conn->connect_error) {
    die(mysql_error());
  }
 ?>