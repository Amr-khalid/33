<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "carrentialdb";

$conn = new mysqli($server, $username, $password, $db);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['submit'])) {
    $model = $_POST['model'];
    $YEAR_OF_MADE = $_POST['YEAR_OF_MADE'];
    
    $cars_status = isset($_POST['carstatus']) && trim($_POST['carstatus']) !== '' ? $_POST['carstatus'] : null;

    $stmt = $conn->prepare("INSERT INTO newcar (model, YEAR_OF_MADE, carstatus) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $model, $YEAR_OF_MADE, $cars_status);


    if ($stmt->execute()) {
        echo "Register successful!";
        header("Location: registernewcar.html");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }
    $stmt->close();
}

$conn->close();
?>