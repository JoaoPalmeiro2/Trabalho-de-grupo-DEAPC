<?php
session_start();

$servername = "localhost";
$dbusername = "root"; 
$dbpassword = "";     
$dbname = "login_db";


$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);


$usertrim = trim($_POST['username']);

$usertrip = stripcslashes($usertrim);
$finaluser=htmlspecialchars($usertrip);

$passwordtrim = trim($_POST['password']);

$passwordtrip = stripcslashes($passwordtrim);
$finalpass = htmlspecialchars($passwordtrip);

$sql = "SELECT * FROM login_ WHERE username='$finaluser' AND password='$finalpass'";
    
$result = mysqli_query($conn, $sql);


if (mysqli_num_rows($result) >=1) {
    $_SESSION['username'] = $finaluser;
    header("Location: login.html");
} else {
    echo "Invalid username or password.";
}

else{
    $_SESSION['error'] = "Invalid username or password."
    header("Location: login.html");
}
?>

