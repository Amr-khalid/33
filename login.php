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
if (!empty($_SESSION["id"])) {
    header("Location: homepage.html");
}
if(isset($_POST["submit"])){
    $email = $_POST["email"];
    $password = $_POST["password"];
    $result = mysqli_query($conn, "SELECT * FROM customers WHERE Email = '$email'");
    $row = mysqli_fetch_assoc($result);
    if (mysqli_num_rows($result) > 0) {
        if ($password == $row["Password"]) {
            $_SESSION["login"] = true;
            $_SESSION["id"] = $row["customerID"];
            header("Location: homepage.html");
        } else {
            echo
            "<script> alert('wrong password');</script>";
            header("Location: login.html");
        }
    } else {
        echo
        "<script> alert('User Not Registered'); </script>";
    }
}
?> 