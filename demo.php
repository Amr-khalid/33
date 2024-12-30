<?php
// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'carrentaldb');

// التحقق من الاتصال
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// التحقق من إرسال البيانات عبر POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // استعلام للتحقق من بيانات المستخدم
    $query = "SELECT * FROM Customers WHERE Email = ? LIMIT 1";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    // التحقق من وجود المستخدم
    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // تحقق من كلمة المرور
        if (password_verify($password, $user['Password'])) {
            // تسجيل الدخول بنجاح
            session_start();
            $_SESSION['user_id'] = $user['customerID'];
            $_SESSION['name'] = $user['Name'];

            // إعادة توجيه إلى الصفحة الرئيسية
            header("Location: dashboard.php");
            exit();
        } else {
            echo "كلمة المرور غير صحيحة!";
        }
    } else {
        echo "البريد الإلكتروني غير موجود!";
    }
}

$conn->close();
?>
<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}

// الاتصال بقاعدة البيانات
$conn = new mysqli('localhost', 'root', '', 'carrentaldb');
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// استعلام لجلب السيارات المتاحة
$query = "SELECT * FROM Cars WHERE Status = 'active'";
$result = $conn->query($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['name']; ?>!</h1>
    <h2>Available Cars</h2>
    <table>
        <thead>
            <tr>
                <th>Model</th>
                <th>Year</th>
                <th>Plate ID</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><?php echo $row['Model']; ?></td>
                    <td><?php echo $row['Year']; ?></td>
                    <td><?php echo $row['plateID']; ?></td>
                    <td><?php echo $row['Status']; ?></td>
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</body>
</html>
