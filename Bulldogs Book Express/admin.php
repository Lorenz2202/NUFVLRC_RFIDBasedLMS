<?php
include("settings.php");
session_start();

$aid = mysqli_real_escape_string($conn, $_POST['aid']);
$aname = mysqli_real_escape_string($conn, $_POST['name']);

$sql = "SELECT aid , name FROM admin where aid in (select rfid from dummy where name='admin')";
$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
}

if ($aid == NULL || $_POST['name'] == NULL) {
    // Handle the case where either $aid or $aname is NULL
    //
} else {
    $sql = mysqli_query($conn, "SELECT * FROM admin WHERE aid='$aid' AND name='$aname'");
    if (mysqli_num_rows($sql) == 1) {
        $_SESSION['aid'] = $_POST['aid'];
        header("location: admin_home.php");
        exit(); // Make sure to exit after redirection
    } else {
        $msg = "Incorrect Details";
    }
}

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
<h2>BULLDOGS BOOK EXPRESS</h2>
  <div class="container" id="container">
    <div class="form-container sign-up-container">
      <form action="#">
        <h1>LRC OVERVIEW</h1>
      </form>
    </div>
    <div class="form-container sign-in-container">
      <form method="post" action="">
        <h1>ADMIN Sign in</h1>
        <input type="text" name="aid" class="fields" size="25" value= "<?php echo $row ['aid']; ?>" placeholder="Admin ID" required="required" />
        <input type="text" name="name" class="fields" size="25" value= "<?php echo $row ['name']; ?>" placeholder="Admin Name" required="required" />
        <button type="submit" value="Sign In" class="fields">Sign In</button>
        <div class="msg-container" id="msg-container">
          <div class="msg"><?php echo $msg ?></div>
          <a href="Redirect_into_index.php" class="link">Main Page</a>
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
          <h1>Hello, Admin!</h1>
          <p>See the latest system updates.</p>
          <button class="ghost" id="signUp">Overview</button>
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
