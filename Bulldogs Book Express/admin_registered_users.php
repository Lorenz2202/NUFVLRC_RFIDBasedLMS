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
<link href="stylesheet.css" rel="stylesheet" type="text/css" />
</head>

<body>
<div id="banner">
<span class="head">Bulldogs Book Express</span><br />
<h1><marquee class="clg" direction="right" behavior="alternate" scrollamount="1">BULLDOGS BOOK EXCHANGE</marquee></h1>
</div>
<br />

<div align="center">
<div id="wrapper">
<br />
<br />

<span class="SubHead">Registered Users</span>
<br />
<br />
<form method="post" action="">
<table border="0" class="table" cellpadding="10" cellspacing="10">
<tr style="background-color:#6fe2f1" ><td>Student ID</td><td>Student Name</td><td>Branch</td><td>Semester</td><td>Gmail</td></tr>
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
</body>
</html>
