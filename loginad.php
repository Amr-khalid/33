<?php
session_start();
$server="localhost";
$username="root";
$password="";
$db="carrentialdb";
$conn=mysqli_connect($server,$username,$password,$db);
if ($conn->connect_error) {
    die("Connection failed:" . $conn->connect_error);
}
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM admins WHERE Email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["Password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["adminID"];
            header("Location: adminpage.html");
        } else {
            echo
            "<script> alert('wrong password');</script>";
            header("Location: loginadmin.html");
        }
    } else {
        echo
        "<script> alert('User Not Registered'); </script>";
    }
}
?> 