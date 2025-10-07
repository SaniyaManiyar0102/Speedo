<?php
include 'db_connect.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Check if user exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? OR email=?");
    $stmt->bind_param("ss", $username, $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();

        // Verify password
        if (password_verify($password, $row['password'])) {
            $_SESSION['username'] = $row['username'];
            $_SESSION['fullname'] = $row['fullname'];
            header("Location: home1.php");
            exit();
        } else {
            echo "<script>alert('Incorrect password.'); window.location='login.html';</script>";
        }
    } else {
        echo "<script>alert('User not found. Please register first.'); window.location='register.html';</script>";
    }
}
?>
