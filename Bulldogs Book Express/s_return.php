<?php
include("settings.php");
session_start();
if(!isset($_SESSION['sid']))
{
	header("location:index.php");
}
$sid=$_SESSION['sid'];
//$a=mysqli_query($conn,"SELECT * FROM  WHERE aid='$aid'");
//$b=mysqli_fetch_array($a);
//$name=$b['name'];

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
<h1><marquee class="clg" direction="right" behavior="alternate" scrollamount="1">BULLDOGS BOOK EXPRESS</marquee></h1>
</div>
<br />

<div align="center">
<div id="wrapper">
<br />
<br />

<span class="SubHead">Issued Books</span>
<br />
<br />

<table border="0" class="table" cellpadding="10" cellspacing="10">
<tr class="labels" style="text-decoration:underline;"><th>Book Name</th><th>Author</th><th>Issued By<br>Student ID</th><th>IssuedDate</th><th>Fine Amount</th><th>Return</th></tr>
<?php
$x=$_SESSION['sid'];
$x=mysqli_query($conn,"SELECT * FROM issue where sid='$x'");
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
     $days=$days-15;
	$fine=$days*10;
 }else{
    $fine=0 ;
 }
 echo $fine;
?>
</td>
<?php
if($fine>0)
{
    ?>
    <td>Pay to admin</td>
    </tr>
    <?php
}
else{
    ?>
    <td><a href="s_return_book.php?r=<?php echo $y['id'];?>" class="link">Return</a></td>
    </tr>
    <?php
}
?>                    
<?php
}
?>
</table><br />
<br />
<a href="home.php" class="link">Go Back</a>
<br />
<br />

</div>
</div>
</body>
</html>