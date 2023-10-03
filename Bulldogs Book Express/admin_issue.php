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
			<li class="nav-item">
                <a class="nav-link" href="admin_home.php"><i class="fas fa-tachometer-alt"></i>Admin Home</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_view_profile.php"><i class="fas fa-tachometer-alt"></i>View Profile</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="admin_edit_profile.php"><i class="far fa-address-book"></i>Edit Profile</a>
            </li>
            <li class="nav-item activ">
                <a class="nav-link" href="admin_issue.php"><i class="far fa-clone"></i>Admin Issue</a>
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
<div id="wrapper">
<br />
<br />

<span class="SubHead">Books Issued by Students</span>
<br />
<br />

<table border="0" class="table" cellpadding="10" cellspacing="10">
<tr class="labels" style="text-decoration:underline;"><th>Book Name</th><th>Author</th><th>Issued By<br>Student ID</th><th>IssuedDate</th><th>Fine Amount</th><th>Return</th></tr>
<?php
$x=mysqli_query($conn,"SELECT * FROM issue");
while($y=mysqli_fetch_array($x))
{
	?>
<tr class="labels" style="font-size:14px;">
<td><?php echo $y['name'];?></td>
<td><?php echo $y['author'];?></td><td><?php echo $y['sid'];?></td>
<td><?php echo date('h:ia - d/m/Y',strtotime($y['date']));?></td>
<td>
<?php
 $issuedDate=strtotime($y['date']);
 date_default_timezone_set('Asia/Calcutta'); 
 $returnDate=strtotime(date("Y-m-d H:i:s"));
 $days=floor(($returnDate-$issuedDate)/(60*60*24));
 if ( $days > 15){
	echo $days*10;
 }else{
	 echo 0 ;
 }
?>
</td>                    
<td><a href="return.php?r=<?php echo $y['id'];?>" class="link">Return</a></td>
</tr>
<?php
}
?>
</table><br />
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