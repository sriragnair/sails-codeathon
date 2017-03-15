<?php
$con = mysqli_connect("localhost","sails_db","Sails1119","sails-catdb");

// Check connection
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
} 
$result = mysqli_query($con,"SELECT * FROM `sc_users` WHERE firstname='Srirag'");
$row = mysqli_fetch_assoc($result);

echo "" . json_encode($row);
mysqli_close($con);
?>