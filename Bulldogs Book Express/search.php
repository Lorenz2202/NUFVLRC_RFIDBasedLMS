<?php
include("settings.php");
session_start();
if (!isset($_SESSION['sid'])) {
    header("location:index.php");
}
$sid = $_SESSION['sid'];
$a = mysqli_query($conn, "SELECT * FROM students WHERE sid='$sid'");
$b = mysqli_fetch_array($a);
$name = $b['name'];

if (isset($_POST['search_query'])) {
    $search_query = mysqli_real_escape_string($conn, $_POST['search_query']);

    // Perform the search query on your database
    $search_result = mysqli_query($conn, "SELECT * FROM books WHERE book_title LIKE '%$search_query%'");

    // Display search results
    if (mysqli_num_rows($search_result) > 0) {
        while ($row = mysqli_fetch_assoc($search_result)) {
            echo "<p>" . $row['book_title'] . "</p>";
        }
    } else {
        echo "No results found.";
    }
}
?>