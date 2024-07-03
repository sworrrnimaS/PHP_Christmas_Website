<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'connect.php';

  //retrieving data
  $username=$_POST['username'];
  $fullname=$_POST['fullname'];
  $email=$_POST['email'];
  $password=$_POST['password'];

  $sql = "INSERT INTO `users` (`username`, `fullname`, `email`, `password`) VALUES ('$username', '$fullname', '$email', '$password')";


  if (mysqli_query($conn, $sql)) {
    echo "Registration successful!";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);  // Close database connection
}


?>