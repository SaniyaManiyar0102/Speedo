<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: login.html");
    exit();
}
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>SpeedO</title>

  <link rel="icon" href="SpeedO.webp" type="image/gif" sizes="16x16">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.8/css/all.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.5.2/animate.css">

  <style>
    .head {
      height: 500px;
      background-image: url("1644974880_wallpaper.jpg");
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center center;
      margin-bottom: 30px;
    }
    .head h1 { padding-top: 30px; padding-left: 10px; color: white; }
    .head p { font-size: 28px; padding-left: 13px; color: white; }
    .footicon { float: right; display: inline-block; padding-right: 20px; }
  </style>
</head>
<body>

  <!-- Navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <a class="navbar-brand" href="home1.php">
      <img src="SpeedO.webp" width="30" height="30" class="d-inline-block align-top">
      <strong>SpeedO</strong>
    </a>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active"><a class="nav-link" href="home1.php"><i class="fas fa-home"></i> HOME</a></li>
        <li class="nav-item"><a class="nav-link" href="profile.php"><i class="fas fa-user"></i> <?php echo $_SESSION['fullname']; ?></a></li>
        <li class="nav-item"><a class="nav-link" href="booking.html"><i class="fas fa-car"></i> BOOK CAB</a></li>
        <li class="nav-item"><a class="nav-link" href="review.html"><i class="fas fa-comments"></i> <strong>REVIEW</strong></a></li>
      </ul>
      <a href="logout.php" class="btn btn-danger">Logout</a>
    </div>
  </nav>

  <!-- Header -->
  <div class="head">
    <h1 class="fadeInUp animated">Reliable. Safe. Transparent.</h1>
    <p class="fadeInUp animated">Your Trusted Ride for Every Occasion</p>
  </div>

  <!-- Footer -->
  <footer style="background-color: #282C35; color:white; padding:10px 0; text-align:center;">
    &copy; SpeedO 2025. All Rights Reserved.
    <div class="footicon mt-2">
      <a href="#"><i class="fab fa-facebook"></i></a>
      <a href="#"><i class="fab fa-twitter"></i></a>
      <a href="#"><i class="fab fa-instagram"></i></a>
    </div>
  </footer>

  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
