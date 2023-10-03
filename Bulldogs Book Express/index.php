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
  <div class="school-logo">
          <img src="NU 2 LINER_OB.png" alt="School Logo" width="350px" height="auto" style="float: left; margin-right: 10px;">
  </div>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form action="#">
        <h1>This is NUFV LRC!</h1>
        <p>At NUFV, we believe that knowledge is the key to success, and our Learning Resource Center is here to help you unlock your full potential. Whether you're a student, faculty member, or a lifelong learner, our center is your gateway to a world of knowledge and resources.</p>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form method="post" action="">
        <h1>Sign in</h1>
        <input type="text" name="id" class="fields" value= "<?php echo $row ['sid']; ?>" size="25" placeholder="Enter Student ID" required="required" />
        <input type="text" name="name" class="fields" value= "<?php echo $row ['name']; ?>" size="25" placeholder=" Name " required="required" />
        <button type="submit" value="Sign In" class="fields">Sign In</button>
        <div class="msg-container" id="msg-container">
          <div class="msg"><?php echo $msg ?></div>
          <a href="Redirect_into_admin.php" class="link">Admin Sign In</a>
        </div>
      </form>
    </div>
    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>To keep connected with us please login with your personal info</p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hello, Bulldog!</h1>
          <p>Enter your personal details and start journey with us</p>
          <button class="ghost" id="signUp">See More!</button>
        </div>
      </div>
    </div>
  </div>

  <script>
          const signUpButton = document.getElementById('signUp');
          const signInButton = document.getElementById('signIn');
          const container = document.getElementById('container');

          signUpButton.addEventListener('click', () => {
              container.classList.add("right-panel-active");
          });

          signInButton.addEventListener('click', () => {
              container.classList.remove("right-panel-active");
          });
  </script>
    
</body>
</html>