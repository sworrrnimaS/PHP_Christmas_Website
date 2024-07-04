<?php
$SERVER="localhost";
$USERNAME="root";
$PASSWORD="";
$DATABASE="postcard";

$conn=mysqli_connect($SERVER,$USERNAME,$PASSWORD,$DATABASE);

if(!$conn){
  die(mysqli_error($conn));
}

?>