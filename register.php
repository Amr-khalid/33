<?php
$server="localhost";
$username ="root";
$password="";
$db="carrentialdb";
$conn=mysqli_connect($server,$username,$password,$db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if (isset($_POST['submit'])){
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $sql = "INSERT INTO customers (Name, Email, Password) VALUES ('$username', '$email', '$password')";
}

if ($conn->query($sql) === TRUE) {
    echo 'register succesfull';
    header("location: homepage.html");
} else {
    echo 'error: ' . $sql .$conn->error;
}

// end connection
$conn->close();
?>