<?php
include 'connection.php';

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $pas = $_POST['password'];

    // Check in customer table
    $sql = "SELECT * FROM customer WHERE email='$email' AND password='$pas'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        session_start();
        $_SESSION["flag"] = 1;
        $_SESSION["username"] = $row["email"];
        $_SESSION["userid"] = $row["userid"];
        $_SESSION["name"] = $row["name"];
        $_SESSION["img"] = $row["image"];
        echo "<script>window.open('home1.php', '_self');</script>";
    } else {
        // Check in driver table
        $sql = "SELECT * FROM driver WHERE email='$email' AND password='$pas'";
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            session_start();
            $_SESSION["flag"] = 2;
            $_SESSION["username"] = $row["email"];
            $_SESSION["name"] = $row["name"];
            $_SESSION["img"] = $row["image"];
            echo "<script>window.open('home1.php', '_self');</script>";
        } else {
            echo "<script>alert('Please enter valid email or password...'); window.open('home1.php', '_self');</script>";
        }
    }

    mysqli_close($conn);
}
?>
