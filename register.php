<?php
$success = 0;
$user = 0;
$username = $fullname = $email = $password = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'connect.php';

  //retrieving data
  $username=htmlspecialchars($_POST['username']);
  $fullname=htmlspecialchars($_POST['fullname']);
  $email=htmlspecialchars($_POST['email']);
  $password=htmlspecialchars($_POST['password']);

  $sql = "Select * from users where username = '$username'";
  $result = mysqli_query($conn,$sql);
  if($result){
    $num = mysqli_num_rows($result);
    if($num > 0){
      // echo "Username already taken";
      $user = 1;
    }
    else{
      $sql = "INSERT INTO `users` (`username`, `fullname`, `email`, `password`) VALUES ('$username', '$fullname', '$email', '$password')";
      $result = mysqli_query($conn,$sql);
      if($result){
        // echo'Registration Successful';
        $success = 1;
        $username = $fullname = $email = $password = '';
      }
      else{
            echo'Data Insert Error';
        }
  }
} 
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Christmas PostCard</title>

    <!--=============== FAVICON ===============-->
    <link
      rel="shortcut icon"
      href="assets/img/favicon.png"
      type="image/x-icon"
    />

    <!--=============== REMIXICONS ===============-->
    <link
      href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css"
      rel="stylesheet"
    />

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="assets/css/styles.css" />
    <link rel="stylesheet" href="assets/css/register.css" />
  </head>
  <body>
  

    <header class="header" id="header">
      <nav class="nav container">
        <a href="" class="nav__logo">
          <img src="assets/img/logo.png" alt="logo image" />Christmas
        </a>

        <div class="nav__menu" id="nav-menu">
          <ul class="nav__list">
            <li class="nav__item">
              <a href="index.html" class="nav__link">Home</a>
            </li>
            <li class="nav__item">
              <a href="register.html" class="nav__link active-link">Register</a>
            </li>
            <li class="nav__item">
              <a href="login.html" class="nav__link">Login</a>
            </li>
          </ul>
          <!--Close Button-->
          <div class="nav__close" id="nav-close">
            <i class="ri-close-line"></i>
          </div>
          <img
            src="assets/img/snow-img.png"
            alt="nav image"
            class="nav__img-1"
          />
          <img
            src="assets/img/snow-img.png"
            alt="nav image"
            class="nav__img-2"
          />
        </div>
        <!--Toggle Button-->
        <div class="nav__toggle" id="nav-toggle">
          <i class="ri-apps-2-line"></i>
        </div>
      </nav>
    </header>
    <section class="home section" id="home">
      <h1 class="home__title">Register</h1>
      <img
        src="assets/img/home-moon.png"
        alt="home image"
        class="home__moon parallax home__image"
        data-rellax-speed="-15"
      />
      <img
        src="assets/img/home-trineo-santa.png"
        alt="home image"
        class="home__trineo parallax home__image"
        data-rellax-speed="-2"
      />
      <img
        src="assets/img/home-mountain-3.png"
        alt="home image"
        class="home__mountain-3 parallax home__image"
        data-rellax-speed="-8"
      />
      <img
        src="assets/img/home-mountain-2.png"
        alt="home image"
        class="home__mountain-2 parallax home__image"
        data-rellax-speed="-8"
      />
      <img
        src="assets/img/home-pine-tree.png"
        alt="home image"
        class="home__pine parallax home__image"
        data-rellax-speed="-10"
      />
      <img
        src="assets/img/home-village.png"
        data-rellax-speed="-10"
        alt="home image"
        class="home__village parallax home__image"
      />
      <img
        src="assets/img/home-snow.png"
        alt="home image"
        class="home__snow parallax home__image"
      />
      <img
        src="assets/img/home-mountain-1.png"
        alt="home image"
        class="home__mountain-1 home__image"
      />

      <div class="register-form-container">
      <form action="register.php" method="post">
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Username" value="<?php echo htmlspecialchars($username); ?>" required />
        <?php
       if ($user) {
        echo '<div style="color: red; display: inline;"><i class="ri-error-warning-fill"></i><p class="error-message" style="display: inline;">Username already taken</p></div>';
    }
    
        ?>
        <br>
        <label for="fullname">Full Name</label>
        <input type="text" name="fullname" placeholder="Fullname" value="<?php echo htmlspecialchars($fullname); ?>" required />
        <label for="email">E-mail</label>
        <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($email); ?>" required />
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Password" value="<?php echo htmlspecialchars($password); ?>" required />
        <button type="submit">Register</button>
      </form>
    </div>
      <img
        src="assets/img/snow-img.png"
        alt="register image"
        class="register__snow-1"
      />
      <img
        src="assets/img/snow-img.png"
        alt="register image"
        class="register__snow-2"
      />
      <img
        src="assets/img/snow-img.png"
        alt="register image"
        class="register__snow-3"
      />
    </section>

    <!--=============== RELLAX JS ===============-->
    <script src="assets/js/rellax.min.js"></script>

    <!--=============== GSAP ===============-->
    <script src="assets/js/gsap.min.js"></script>

    <!--=============== SCROLLREVEAL ===============-->
    <script src="assets/js/scrollreveal.min.js"></script>

    <!--=============== MAIN JS ===============-->
    <script src="assets/js/main.js"></script>
  </body>
</html>
