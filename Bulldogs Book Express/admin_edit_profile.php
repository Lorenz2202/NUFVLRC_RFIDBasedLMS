<?php
include("settings.php");
session_start();
if(!isset($_SESSION['aid']))
{
	header("location:index.php");
}
$aid=$_SESSION['aid'];
$a=mysqli_query($conn,"SELECT * FROM admin WHERE aid='$aid'");
$b=mysqli_fetch_array($a);

$sn=$b['name'];
$sc=$b['ContactNumber'];
$sg=$b['email'];

$sn1=$_POST["name"];
$sc1=$_POST["ContactNumber"];
$sg1=$_POST["email"];

if(!empty($_POST)) {
    if($_POST['name']!=$sn || $_POST['ContactNumber']!=$sc || $_POST['email']!=$sg)
{
    $sql=mysqli_query($conn,"update students set name = '$sn1',ContactNumber = '$sc1',email = '$sg1' where aid = '$aid'");
    if($sql)
	{
		$msg="Updated Successfully";
        header("refresh: 5");
	}
}
    else{
        $msg="NO UPDATE";
    }
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
            <li class="nav-item active">
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

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="nav.js"></script>



<div align="center">
<div id="wrapper">
<span class="SubHead">Edit Admin Data</span>
<br />
<br />
<form method="post" action="">
<table border="2px" class="table" cellpadding="10" cellspacing="40" border-radius = "8px";>
<tr><td class="msg" align="center" colspan="2"><?php echo $msg;?></td></tr>
<tr><td class="labels">Admin ID &nbsp&nbsp&nbsp&nbsp&nbsp: </td><td colspan="2" align="center" class="msg"><?php echo $b['aid'] ;?></td></tr>
<tr><td class="labels">Name &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </td><td><input type="text" name="name" class="fields" value= "<?php echo $b['name']; ?>" size="25" placeholder="Enter Student ID" required="required" /></td></tr>
<tr><td class="labels">Contact No &nbsp: </td><td><input type="text" name="ContactNumber" class="fields" value= "<?php echo $b['ContactNumber']; ?>" size="25" placeholder="Enter Student ID" required="required" /></td></tr>
<tr><td class="labels">Gmail &nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp: </td><td><input type="text" name="email" class="fields" value= "<?php echo $b['email']; ?>" size="25" placeholder="Enter Student ID" required="required" /></td></tr>
<tr><td colspan="2" align="center"><input type="submit" value="UPDATE" class="fields" /></td></tr>
</table>
</form>

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