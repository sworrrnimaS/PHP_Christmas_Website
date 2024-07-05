<?php
$login = 0;
$invalid = 0;
$username  = $password = '';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
  include 'connect.php';

  //retrieving data
  $username=htmlspecialchars($_POST['username']);
  $password=htmlspecialchars($_POST['password']);

  $sql = "Select * from users where username = '$username' and password='$password'";
  $result = mysqli_query($conn,$sql);
  if($result){
    $num = mysqli_num_rows($result);
    if($num > 0){
      //  echo "Login Successful";
      $login = 1;
      
      session_start();//store data in session
      $_SESSION['username'] = $username;
      header('location: userDash.php');
    
    }
    else{
    $invalid = 1;
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
    <link rel="stylesheet" href="assets/css/login.css" />
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
              <a href="register.php" class="nav__link">Register</a>
            </li>
            <li class="nav__item">
              <a href="login.php" class="nav__link active-link">Login</a>
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
      <h1 class="home__title">Log In</h1>
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

      <div class="login-form-container">
        <form action="login.php" method="post">
        <?php
        if ($invalid) {
        echo '<div style="color: 	#ff0505; display: inline;"><i class="ri-error-warning-fill"></i><p class="error-message" style="display: inline;">Invalid Username or Password</p></div>';
    }
    ?>
    <br>
          <label for="username">Username</label><br>
          <input type="text" name="username" placeholder="Username" required /><br>
        
    
          <label for="password">Password</label>
          <input
            type="password"
            name="password"
            placeholder="Password"
            required
          />
          <button type="submit">Continue</button>
        </form>
      </div>
      <img
        src="assets/img/snow-img.png"
        alt="login image"
        class="login__snow-1"
      />
      <img
        src="assets/img/snow-img.png"
        alt="login image"
        class="login__snow-2"
      />
      <img
        src="assets/img/snow-img.png"
        alt="login image"
        class="login__snow-3"
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
