<?php
include("settings.php");
session_start();
if(!isset($_SESSION['sid']))
{
	header("location:index.php");
}
$sid=$_SESSION['sid'];
$a=mysqli_query($conn,"SELECT * FROM students WHERE sid='$sid'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Bulldogs Book Express</title>
  <link href="navbar.css" rel="stylesheet" type="text/css" />
</head>

<body>
<nav class="navbar navbar-expand-custom navbar-mainbg">
    <button class="navbar-toggler" type="button" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <i class="fas fa-bars text-white"></i>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav ml-auto">
            <div class="hori-selector"><div class="left"></div><div class="right"></div></div>
			<li class="nav-item active">
                <a class="nav-link" href="home.php"><i class="fas fa-tachometer-alt"></i>Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="view_profile.php"><i class="fas fa-tachometer-alt"></i>View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="edit_profile.php"><i class="far fa-address-book"></i>Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="issueBook.php"><i class="far fa-clone"></i>Issue Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="request.php"><i class="far fa-calendar-alt"></i>Request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="far fa-chart-bar"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="nav.js"></script>

</body>
</html>