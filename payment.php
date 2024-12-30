<?php
$server = "localhost";
$username = "root";
$password = "";
$db = "carrentialdb";

$conn = new mysqli($server, $username, $password, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/payment.css">
</head>
<body>

<!-- display errors returned by createToken -->
<span class="payment-errors"></span>

<!-- stripe payment form -->
<div class="container">
        <nav>
            <a href="#" class="logo">Home Page</a>
            
        </nav>
        <div class="content">
        <div class="text">
        <h1>Payment</h1>

<!-- display errors returned by createToken -->
<span class="payment-errors"></span>

<!-- stripe payment form -->
<form method="POST" id="paymentFrm">
    <p>
        <label>Name</label>
        <input type="text" name="name" size="50" />
    </p>
    <p>
        <label>Email</label>
        <input type="text" name="email" size="50" />
    </p>
    <p>
        <label>Card Number</label>
        <input type="text" name="card_num" size="20" autocomplete="off" 
class="card-number" />
    </p>
    <p>
        <label>CVC</label>
        <input type="text" name="cvc" size="4" autocomplete="off" class="card-cvc" />
    </p>
    <p>
        <label>Expiration (MM/YYYY)</label>
        <input type="text" name="exp_month" size="2" class="card-expiry-month"/>
        <span> / </span>
        <input type="text" name="exp_year" size="4" class="card-expiry-year"/>
    </p>
    <button type="submit" id="payBtn">Submit Payment</button>
</form>
 
        </div>
        <div class="image">
            <img src="about.png">
        </div>
        </div>
    </div>
</body>
</html>