<?php
session_start();

// Check if the form is submitted
if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $db = "treasury";
    $connect = mysqli_connect("localhost", "root", "") or die("Could not connect to the server");
    mysqli_select_db($connect, $db) or die("Database could not be found");

    $userquery = mysqli_query($connect, "SELECT * FROM users WHERE username='$username' AND password='$password'") or die("Query cannot be completed");

    if (mysqli_num_rows($userquery) != 1) {
        echo "<script language=\"JavaScript\">\n";
        echo "alert('Username or Password was incorrect!');\n";
        echo "window.location='login.html'";
        echo "</script>";
    } else {
        $row = mysqli_fetch_array($userquery, MYSQLI_ASSOC);
        $_SESSION['username'] = $row['username'];
        $_SESSION['password'] = $row['password'];
        // $_SESSION['idNumber'] = $row['idNumber'];
        // $_SESSION['fullname'] = $row['fullname'];

        mysqli_close($connect);

        header("Location: myDashboard.php"); // Redirect to the dashboard
        exit();
    }
}
?>
