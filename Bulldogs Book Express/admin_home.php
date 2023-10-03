<?php
include("settings.php");
session_start();
if(!isset($_SESSION['aid']))
{
	header("location:admin.php");
}
$aid=$_SESSION['aid'];
$a=mysqli_query($conn,"SELECT * FROM admin WHERE aid='$aid'");
$b=mysqli_fetch_array($a);
$name=$b['name'];
?>

<!DOCTYPE >
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
                <a class="nav-link" href="admin_home.php"><i class="fas fa-tachometer-alt"></i>Admin Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_view_profile.php"><i class="fas fa-tachometer-alt"></i>View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_edit_profile.php"><i class="far fa-address-book"></i>Edit Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_issue.php"><i class="far fa-clone"></i>Issue Book</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_bookRequests.php"><i class="far fa-calendar-alt"></i>User Request</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_registered_users.php"><i class="far fa-calendar-alt"></i>Registered Users</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_available_books.php"><i class="far fa-calendar-alt"></i>Available Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_manage_books.php"><i class="far fa-calendar-alt"></i>Manage Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_addBooks.php"><i class="far fa-calendar-alt"></i>Add Books</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="logout.php"><i class="far fa-chart-bar"></i>Logout</a>
            </li>
        </ul>
    </div>
</nav>

<div align="center">

<span class="SubHead">Welcome <?php echo $name;?></span>
<br />
<br />
<table border="0" class="table" cellpadding="10" cellspacing="10">
    <tr>
    <td><a href="admin_registered_users.php" class="Command">Registered Users : 
    <?php 
        $x=mysqli_query($conn,"SELECT * FROM students");
        $rows=mysqli_num_rows($x);
        echo $rows;
    ?></a></td>
     <td><a href="admin_available_books.php" class="Command">Available Books :
     <?php
        $x=mysqli_query($conn,"SELECT * FROM books where rfid not in (select bid from issue)");
        $rows=mysqli_num_rows($x);
        echo $rows;
     ?></a></td></tr>
    <tr><td><a href="admin_addBooks.php" class="Command">Add Books</a></td> <td><a href="admin_manage_books.php" class="Command">Manage Books</a></td></tr>
    <tr>
    <td><a href="admin_bookRequests.php" class="Command">Books Requests :
    <?php 
        $x=mysqli_query($conn,"SELECT * FROM request");
        $rows=mysqli_num_rows($x);
        echo $rows;
    ?></a></td>
    <td><a href="admin_issue.php" class="Command">Issued Books :
    <?php
        $x=mysqli_query($conn,"SELECT * FROM issue");
        $rows=mysqli_num_rows($x);
        echo $rows;
    ?>
    </a></td></tr>
</table>
<br />
<br />

</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="nav.js"></script>

</body>
</html>