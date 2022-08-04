<?php 

  // connect to database
  $conn = mysqli_connect('localhost', 'cathy','Cathyfleur2','cathy_php');
  // check connection
  if(!$conn){
  	echo 'Connection error:' . mysqli_connect_error();
  }

 ?>