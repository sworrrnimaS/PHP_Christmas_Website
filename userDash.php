<?php
session_start();
if(!isset($_SESSION['username'])){
    header('location: login.php');
    exit();
}
include 'connect.php';
$username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $recipient = htmlspecialchars($_POST['recipient']);
    $message = htmlspecialchars($_POST['message']);

    // Check if the recipient exists
    $checkRecipientSql = "SELECT u_id FROM users WHERE username = ?";
    $stmt = mysqli_prepare($conn, $checkRecipientSql);
    mysqli_stmt_bind_param($stmt, 's', $recipient);
    mysqli_stmt_execute($stmt);
    $recipientResult = mysqli_stmt_get_result($stmt);

    if (mysqli_num_rows($recipientResult) > 0) {
        $recipientRow = mysqli_fetch_assoc($recipientResult);
        $recipientId = $recipientRow['u_id'];

        // Insert postcard into the cards table
        $insertCardSql = "INSERT INTO card (recipient_id, senderUsername, receiverUsername, message) VALUES (?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $insertCardSql);
        mysqli_stmt_bind_param($stmt, 'isss', $recipientId, $username, $recipient, $message);
        if (mysqli_stmt_execute($stmt)) {
            $response = array('status' => 'success', 'message' => 'Postcard sent successfully!');
        } else {
            $response = array('status' => 'error', 'message' => 'Error: ' . $insertCardSql . '<br>' . mysqli_error($conn));
        }
    } else {
        $response = array('status' => 'error', 'message' => 'Recipient username not found!');
    }

    // Return JSON response
    header('Content-Type: application/json');
    echo json_encode($response);
    exit();
}

// Fetch received postcards
$fetchReceivedSql = "SELECT * FROM card WHERE receiverUsername = ?";
$stmt = mysqli_prepare($conn, $fetchReceivedSql);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$receivedResult = mysqli_stmt_get_result($stmt);

// Fetch sent postcards
$fetchSentSql = "SELECT * FROM card WHERE senderUsername = ?";
$stmt = mysqli_prepare($conn, $fetchSentSql);
mysqli_stmt_bind_param($stmt, 's', $username);
mysqli_stmt_execute($stmt);
$sentResult = mysqli_stmt_get_result($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Postcard Dashboard</title>
    <!-- Linking SwiperJS CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png" type="image/x-icon" />
    <!-- Remix Icons -->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet" />
    <!-- CSS -->
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
            <div class="nav__close" id="nav-close">
                <i class="ri-close-line"></i>
            </div>
            <img src="assets/img/snow-img.png" alt="nav image" class="nav__img-1" />
            <img src="assets/img/snow-img.png" alt="nav image" class="nav__img-2" />
        </div>
        <div class="nav__toggle" id="nav-toggle">
            <i class="ri-apps-2-line"></i>
        </div>
    </nav>
</header>
<main>
<section class="home section" id="home">
    <h1 class="welcome__title"> Welcome,
        <?php
        echo $_SESSION['username'];
        ?>
    </h1>
    <img src="assets/img/home-mountain-1.png" alt="home image" class="home__mountain-2 parallax home__image" data-rellax-speed="-8" />
    <img src="assets/img/home-trineo-santa.png" alt="home image" class="home__trineo parallax" data-rellax-speed="-2" />
    <img src="assets/img/home-mountain-3.png" alt="home image" class="home__mountain-3 parallax" data-rellax-speed="-8" />
    <img src="assets/img/home-mountain-2.png" alt="home image" class="home__mountain-2 parallax" data-rellax-speed="-8" />
    <img src="assets/img/home-mountain-1.png" alt="home image" class="home__mountain-1" />

    <section class="write__postcard-container">
        <div class="dash__container">
            <div class="postcard__container-1">
                <h2 class="title" >Write Postcard</h2>
                <form id="postcardForm" action="userDash.php" method="post">
                    <label for="recipient">Recipient Username</label>
                    <input type="text" id="recipient" name="recipient" placeholder="Recipient Username" required />
                    <label for="message">Send Love</label>
                    <textarea id="message" name="message" placeholder="Write your message here..." rows="6" required></textarea>
                    <button type="submit">Send Postcard</button>
                </form>
            </div>
            <div class="postcard__container-2">
                <h2 class="title" >Sent Postcard</h2>
                <?php
                if (mysqli_num_rows($sentResult) > 0) {
                    while ($row = mysqli_fetch_assoc($sentResult)) {
                        echo '<div class="card-item">';
                        echo '<h2 class="user-name">To: ' . htmlspecialchars($row['receiverUsername']) . '</h2>';
                        echo '<p class="user-sent-message">' . htmlspecialchars($row['message']) . '</p>';
                        echo '</div>';
                    }
                } else {
                    echo '<p>No postcards sent yet.</p>';
                }
                ?>  
            </div>
        </div>
    </section> 

    <section class="view__postcard-container">
        <div class="container swiper">
            <h2 class="title">Received Postcards</h2>
            <div class="slider-wrapper">
                <div class="card-list swiper-wrapper">
                    <?php
                    if (mysqli_num_rows($receivedResult) > 0) {
                        while ($row = mysqli_fetch_assoc($receivedResult)) {
                            echo '<div class="card-item swiper-slide">';
                            echo '<h2 class="user-name">From: ' . htmlspecialchars($row['senderUsername']) . '</h2>';
                            echo '<p class="user-received-message">' . htmlspecialchars($row['message']) . '</p>';
                            echo '</div>';
                        }
                    } else {
                        echo '<p>No postcards received yet.</p>';
                    }
                    ?>
                </div>
                <div class="swiper-pagination"></div>
            </div>
        </div>
        <div class="swiper-slide-button swiper-button-prev"></div>
        <div class="swiper-slide-button swiper-button-next"></div>
    </section>

    <img src="assets/img/snow-img.png" alt="register image" class="register__snow-1" />
    <img src="assets/img/snow-img.png" alt="register image" class="register__snow-2" />
    <img src="assets/img/snow-img.png" alt="register image" class="register__snow-3" />
    <img src="assets/img/snow-img.png" alt="register image" class="register__snow-4" />
</section>
</main>
<!-- Rellax JS -->
<script src="assets/js/rellax.min.js"></script>
<!-- GSAP -->
<script src="assets/js/gsap.min.js"></script>
<!-- ScrollReveal -->
<script src="assets/js/scrollreveal.min.js"></script>
<!-- SwiperJS -->
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
<!-- Custom script -->
<script src="assets/js/userDash.js"></script>
<script src="assets/js/main.js"></script>
<script>
document.getElementById('postcardForm').addEventListener('submit', function(event) {
    event.preventDefault();  // Prevent the default form submission

    var form = this;

    // Use Fetch API to send form data
    var formData = new FormData(form);

    fetch(form.action, {
        method: form.method,
        body: formData
    })
    .then(function(response) {
        return response.json();
    })
    .then(function(data) {
        if (data.status === 'success') {
            alert(data.message);
            window.location.reload();  // Refresh the page on success
        } else {
            alert(data.message);  // Show error message
        }
    })
    .catch(function(error) {
        console.error('There was a problem with the fetch operation:', error);
    });
});
</script>


</body>
</html>
