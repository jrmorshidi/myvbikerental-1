<?php
$servername = "localhost";
$name = 'bikerentalsystem';
$username = "root";
$password = "";
$connect = mysqli_connect($servername, $username, $password, "myvbikerentalsystem");


if(!$connect){
  echo "Error: Unable to connect to MySQL." . PHP_EOL;
  echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
  echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
  exit;
}
?>


