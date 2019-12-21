<?php
session_start();

$email = $_POST['email'];
$password = $_POST['password'];

//Open a new connection to the MySQL server
$mysqli = new mysqli('localhost', 'root', '', 'business9ja');


//Output any connection error
if ($mysqli->connect_error) {
    die('Error : (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

$query = "SELECT * FROM members WHERE email='$email'";
$result = mysqli_query($mysqli, $query) or die(mysqli_error());
$num_row = mysqli_num_rows($result);
$row = mysqli_fetch_array($result);

if ($num_row >= 1) {

    if (password_verify($password, $row['password'])) {

        $_SESSION['login'] = $row['ID'];
        $_SESSION['fname'] = $row['fullName'];
        $_SESSION['lname'] = $row['lastName'];
        echo 'true';
    }
    else {
        echo 'false';
    }

} else {
    echo 'false';
}

?>