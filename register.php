<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include 'db_connect.php';
?>

<?php
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Basic validation
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match!'); window.location='register.html';</script>";
        exit();
    }

    // Hash password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Check if username or email already exists
    $check = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $check->bind_param("ss", $username, $email);
    $check->execute();
    $result = $check->get_result();

    if ($result->num_rows > 0) {
        echo "<script>alert('Username or Email already exists!'); window.location='register.html';</script>";
    } else {
        $stmt = $conn->prepare("INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);
        if ($stmt->execute()) {
            echo "<script>alert('Registration successful! Please login.'); window.location='login.html';</script>";
        } else {
            echo "<script>alert('Error occurred. Please try again.'); window.location='register.html';</script>";
        }
    }
}
?>
