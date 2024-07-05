<?php
session_start();
if(!isset($_SESSION['username'])){
  header('location: login.php');
  exit();
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
    <link rel="stylesheet" href="assets/css/userDash.css" />
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
              <a href="logout.php" class="nav__link">Log Out</a>
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
    <h1 > Welcome
      <?php
      echo $_SESSION['username'];
      ?>
    </h1>
      <!-- <img
        src="assets/img/home-moon.png"
        alt="home image"
        class="home__moon parallax home__image"
        data-rellax-speed="-15"
      /> -->
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
      <div class="dash__container">
        <div class="write__postcard-container">
          <p class="title">Write Postcard</p>
          <div class="postcard__container-1">
            <form>
              <label for="username">Username</label><br />
              <input
                type="text"
                name="recipient"
                placeholder="Recipient Username"
                required
              /><br />
              <label for="message">Send Love</label><br />
              <textarea
                name="message"
                type="text"
                placeholder="Write your message here..."
                rows="6"
                required
              ></textarea
              ><br />
              <button type="submit">Send Postcard</button>
            </form>
          </div>
        </div>
        <div class="view__postcard-container">
          <p class="title">Received Postcard</p>
          <div class="postcard__container-2">
            <div class="postcard">
              <h3>From: Username1</h3>
              <p class="received__msg">
                Happy Holidays! Wishing you all the best.
              </p>
            </div>
            <div class="postcard">
              <h3>From: Username2</h3>
              <p class="received__msg">
                Merry Christmas! Hope you have a wonderful time.
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- <img
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
      /> -->
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
