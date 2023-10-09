<?php
include("settings.php");
session_start();
if(!isset($_SESSION['aid']))
{
	header("location:admin.php");
}
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
			<li class="nav-item">
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
            <li class="nav-item active">
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
<div id="wrapper">
<br />
<br />

<span class="SubHead">Registered Users</span>
<br />
<br />
<form method="post" action="">
<table border="2px" class="table" cellpadding="10" cellspacing="40" border-radius = "8px";>
<tr style="background-color:#1fb0f5" ><td>Student ID</td><td>Student Name</td><td>Branch</td><td>Semester</td><td>Gmail</td></tr>
<?php
	$x=mysqli_query($conn,"SELECT * FROM students");
	while($y=mysqli_fetch_array($x))
	{
		echo "<tr>";
		echo "<td align='center' class='msg'>".$y['sid']."</td>";
		echo "<td align='center' class='msg'>".$y['name']."</td>";
		echo "<td align='center' class='msg'>".$y['branch']."</td>";
		echo "<td align='center' class='msg'>".$y['sem']."</td>";
		echo "<td align='center' class='msg'>".$y['email']."</td></tr>";
	}
?>

</table>
</form>
<br />
<br />
<a href="admin_home.php" class="link">Go Back</a>
<br />
<br />

</div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="nav.js"></script>

</body>
</html>
