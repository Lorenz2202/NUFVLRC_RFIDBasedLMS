<?php
include("settings.php");
session_start();
if (!isset($_SESSION['sid'])) {
    header("location:index.php");
}

$bname = mysqli_real_escape_string($conn, $_POST['bname']);
$author = mysqli_real_escape_string($conn, $_POST['author']);
$msg = ""; // Initialize the $msg variable

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Search for the book in the "books" database only
$sql = "SELECT * FROM books WHERE name = ?";
$stmt = mysqli_prepare($conn, $sql);
mysqli_stmt_bind_param($stmt, "s", $bname);
mysqli_stmt_execute($stmt);
$result = mysqli_stmt_get_result($stmt);

if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
    $rfid = $row['rfid'];
} else {
    $rfid = ""; // Set $rfid to an empty string if no matching book is found
}

$sid = $_SESSION['sid'];

$bn = $_POST['bname'];

if ($bn != NULL) {
    if (!empty($rfid)) {
        $stmt = mysqli_prepare($conn, "SELECT * FROM books WHERE rfid = ? AND name = ?");
        mysqli_stmt_bind_param($stmt, "ss", $rfid, $bn);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if (mysqli_num_rows($result) == 1) {
            $q = mysqli_fetch_array($result);
            $bk = $q['name'];
            $ba = $q['author'];

            $stmt = mysqli_prepare($conn, "INSERT INTO issue(sid, bid, name, author, date) VALUES(?, ?, ?, ?, CURRENT_TIMESTAMP)");
            mysqli_stmt_bind_param($stmt, "ssss", $sid, $rfid, $bk, $ba);
            $sql = mysqli_stmt_execute($stmt);

            if ($sql) {
                $msg = "Successfully Issued";
                // No need to delete from "dummy" in this case
                $row['name'] = NULL;
                $row['author'] = NULL;
            } else {
                $msg = "Error Please Try Later";
            }
        } else {
            $msg = "Book is not present in the database";
        }
    } else {
        $msg = "No book matching your request found.";
    }
}

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
				<li class="nav-item">
                	<a class="nav-link" href="home.php"><i class="fas fa-tachometer-alt"></i>Home</a>
            	</li>	                
                <li class="nav-item">
                    <a class="nav-link" href="view_profile.php"><i class="fas fa-tachometer-alt"></i>View Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="edit_profile.php"><i class="far fa-address-book"></i>Edit Profile</a>
                </li>
                <li class="nav-item active">
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

    <div align="center">
        <div id="wrapper">

            <span class="SubHead">Issue Book</span>
            <br />
            <br />
            <form method="post" action="">
                <table border="0" class="table" cellpadding="10" cellspacing="10">
                    <tr>
                        <td></td>
                        <td colspan="2" align="center" class="msg"><?php echo $msg; ?></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="labels">Book Name : </td>
                        <td><input type="text" name="bname" class="fields" value="<?php echo $row['name']; ?>"
                                size="25" placeholder="Book Name" required="required" /></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td class="labels">Author : </td>
                        <td><input type="text" name="author" class="fields" value="<?php echo $row['author']; ?>"
                                size="25" placeholder="Author" required="required" /></td>
                    </tr>

                    <tr>
                        <td></td>
                        <td colspan="2" align="center"><input type="submit" value="ISSUE" class="fields" /></td>
                    </tr>

                    <?php
                    $x = mysqli_query($conn, "SELECT * FROM issue where sid='$sid'");
                    if (mysqli_num_rows($x) > 0) {
                    ?>
                    <tr style="background-color:#3996a2">
                        <td>sname</td>
                        <td>BookName</td>
                        <td>Author</td>
                        <td>Time</td>
                    </tr>
                    <?php
                        while ($y = mysqli_fetch_array($x)) {
                            echo "<tr style='background-color:#6ac7d4'>";
                            echo "<td>" . $y['sid'] . "</td>";
                            echo "<td>" . $y['name'] . "</td>";
                            echo "<td>" . $y['author'] . "</td>";
                            echo "<td>" . date("h:ia d-m-Y", strtotime($y['date'])) . "</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </table>
            </form>
            <br />
            <a href="home.php" class="link">Go Back</a>
            <br />
            <br />

        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="nav.js"></script>

</body>

</html>
