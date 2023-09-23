<?php
include("settings.php");
session_start();

$sid = mysqli_real_escape_string($conn, $_POST['id']);
$sname = mysqli_real_escape_string($conn, $_POST['name']);
$msg = ""; // Initialize the $msg variable

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT sid, name FROM students WHERE sid IN (SELECT rfid FROM dummy WHERE name='student')";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
}

if ($sid == NULL || $_POST['name'] == NULL) {
    // Handle the case where either $sid or $sname is NULL
    $msg = "Please fill in all the fields.";
} else {
    $sql = mysqli_query($conn, "SELECT * FROM students WHERE sid='$sid' AND name='$sname'");
    if (mysqli_num_rows($sql) == 1) {
        $_SESSION['sid'] = $_POST['id'];
        header("location: home.php"); // Redirect to home.php
        exit(); // Make sure to exit after redirection
    } else {
        $msg = "Incorrect Details";
    }
}

mysqli_close($conn);
?>

<!DOCTYPE html>
<html>
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <title>Bulldogs Book Express</title>
  <link href="stylesheet.css" rel="stylesheet" type="text/css" />
  <link href="css/normalize.css" rel="stylesheet" type="text/css">
  <link href="css/webflow.css" rel="stylesheet" type="text/css">
  <link href="css/book-project-css.webflow.css" rel="stylesheet" type="text/css">
  <style>
    /* Add custom CSS for scrolling to the book portion */
    body {
      overflow: hidden; /* Hide scrollbars on the body */
    }
    .scroll-container {
      overflow-y: scroll; /* Enable vertical scrolling for this container */
      height: 100vh; /* Set the container height to fill the viewport */
    }
    .book-content {
      padding: 20px; /* Add padding to the book content */
    }
  </style>
  <script src="https://ajax.googleapis.com/ajax/libs/webfont/1.4.7/webfont.js" type="text/javascript"></script>
  <script type="text/javascript">
    WebFont.load({
      google: {
        families: ["PT Sans:400,400italic,700,700italic"]
      }
    });
  </script>
  <script type="text/javascript">
    ! function(o, c) {
      var n = c.documentElement,
        t = " w-mod-";
      n.className += t + "js", ("ontouchstart" in o || o.DocumentTouch && c instanceof DocumentTouch) && (n.className += t + "touch")
    }(window, document);
  </script>
  <link href="https://daks2k3a4ib2z.cloudfront.net/img/favicon.ico" rel="shortcut icon" type="image/x-icon">
  <link href="https://daks2k3a4ib2z.cloudfront.net/img/webclip.png" rel="apple-touch-icon">
</head>
<body>
  <!-- Include the contents of book.php below -->
  <div id="banner">
			<span class="head">Bulldogs Book Express</span>
	</div>

  <div class="scene">
    <div class="book-wrap">
      <div class="left-side">
        <div class="book-cover-left"></div>
        <div class="layer1">
          <div class="page-left"></div>
        </div>
        <div class="layer2">
          <div class="page-left"></div>
        </div>
        <div class="layer3">
          <div class="page-left"></div>
        </div>
        <div class="layer4">
          <div class="page-left"></div>
        </div>
        <div class="layer-text">
          <div class="page-left-2">
            <div class="corner"></div>
            <div class="corner2"></div>
            <div class="corner-fold"></div>
            <div id="wrapper">
            <br />
            <br />
            <span class="SubHead">Student Sign In</span>
            <br />
            <br />
            <form method="post" action="">
              <table border="0" cellpadding="4" cellspacing="4" class="table">
                <tr><td colspan="2" align="center" class="msg"><?php echo $msg ?></td></tr>
                <tr><td class="labels">NU ID</td><td><input type="text" name="id" class="fields" value= "<?php echo $row ['sid']; ?>" size="25" placeholder="Enter Student ID" required="required" /></td></tr>
                <tr><td class="labels">NAME</td><td><input type="text" name="name" class="fields" value= "<?php echo $row ['name']; ?>" size="25" placeholder=" Name " required="required" /></td></tr>
                <tr><td colspan="2" align="center"><input type="submit" value="Sign In" class="fields" /></td></tr>
              </table>
            </form>
            <br />
            <br />
            <a href="Redirect_into_admin.php" class="link">Admin Sign In</a>
            <br />
            <br />
      </div>
          </div>
        </div>
      </div>
      <div class="center"></div>
      <div class="right-side">
        <div class="book-cover-right"></div>
        <div class="layer1">
          <div class="page-right"></div>
        </div>
        <div class="layer2 right">
          <div class="page-right"></div>
        </div>
        <div class="layer3 right">
          <div class="page-right"></div>
        </div>
        <div class="layer4 right">
          <div class="page-right"></div>
        </div>
        <div class="layer-text right">
          <div class="page-right-2">
            <div class="page-text w-richtext">
              <h3><strong>A Glimpse</strong></h3>
              <h6>BY <a href="https://www.poetryfoundation.org/poets/walt-whitman" target="_blank">WALT WHITMAN</a></h6>
              <p>‍</p>
              <p>A glimpse through an interstice caught, </p>
              <p>Of a crowd of workmen and drivers in a bar-room around the stove late of a winter night, and I unremark’d seated in a corner, </p>
              <p>‍</p>
              <p>Of a youth who loves me and whom I love, silently approaching and seating himself near, that he may hold me by the hand, </p>
              <p>‍</p>
              <p>A long while amid the noises of coming and going, of drinking and oath and smutty jest, </p>
              <p>‍</p>
              <p>There we two, content, happy in being together, speaking little, perhaps not a word. </p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript" intergrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
  <!-- End of book.php content -->

  <script src="https://code.jquery.com/jquery-3.3.1.min.js" type="text/javascript" intergrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
  <script src="js/webflow.js" type="text/javascript"></script>
  <!-- [if lte IE 9]><script src="https://cdnjs.cloudflare.com/ajax/libs/placeholders/3.0.2/placeholders.min.js"></script><![endif] -->
</body>
</html>