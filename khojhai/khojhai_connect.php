<?php
$con = mysqli_connect("localhost", "root", "", "khojhai");

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }
  
  /*
  else{
  echo "Connected succesfully";
  }
  */
?> 