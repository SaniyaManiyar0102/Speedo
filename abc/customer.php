<?php
if (isset($_POST['submit1'])) {
    include 'amg.php';
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pas = $_POST['password'];
    $pno = $_POST['phone'];
    $add2 = $_POST['add2'];
    $city = $_POST['city'];
    $zip = $_POST['zip'];
    $address = $add2 . " " . $city . " " . $zip;
    $image = "khalid1.jpg";

    if (empty($name) || empty($email) || empty($pas) || empty($pno) || empty($add2) || empty($city) || empty($zip)) {
        echo "<script>alert('Please fill all the entries properly.'); window.location.href='../home1.php';</script>";
        exit();
    }

    $conn = mysqli_connect("localhost", "root", "", "yocab");

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    $sql = "INSERT INTO customer (email, name, password, contact_number, address, image)
            VALUES ('$email', '$name', '$pas', '$pno', '$address', '$image')";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION['email'] = $email;
        header("Location: transaction_helper.php");
        exit();
    } else {
        echo "Error inserting data: " . mysqli_error($conn);
    }

    mysqli_close($conn);
}
?>
