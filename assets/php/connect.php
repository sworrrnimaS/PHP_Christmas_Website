<?php
$SERVER="localhost";
$USERNAME="root";
$PASSWORD="";
$DATABASE="postcard";

$conn=mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DATABASE);

if($conn){
  echo "Connection Successful";
}else{
  die(mysqli_error($con));
}

?>