<!DOCTYPE html>
<html>
<head>
  <title>Customer Registration</title>
</head>
<body>

<?php
if (isset($_POST['submit1'])) {
    include 'connection.php';  // 🧩 central connection file

    $name   = mysqli_real_escape_string($conn, $_POST['name']);
    $email  = mysqli_real_escape_string($conn, $_POST['email']);
    $pas    = mysqli_real_escape_string($conn, $_POST['password']);
    $pno    = mysqli_real_escape_string($conn, $_POST['phone']);
    $add2   = mysqli_real_escape_string($conn, $_POST['add2']);
    $city   = mysqli_real_escape_string($conn, $_POST['city']);
    $zip    = mysqli_real_escape_string($conn, $_POST['zip']);

    $address = $add2 . " " . $city . " " . $zip;

    // Validation check
    if (empty($name) || empty($email) || empty($pas) || empty($pno) || empty($add2) || empty($city) || empty($zip)) {
        echo "<script>alert('Please fill all the entries properly.'); window.location.href='../home1.php';</script>";
        exit();
    }

    // Insert customer data (no image included now)
    $sql = "INSERT INTO customer (email, name, password, contact_number, address)
            VALUES ('$email', '$name', '$pas', '$pno', '$address')";

    if (mysqli_query($conn, $sql)) {
        session_start();
        $_SESSION['email'] = $email;
        header("Location: transaction_helper.php");
        exit();
    } else {
        echo "<p style='color:red;'>Error inserting data: " . mysqli_error($conn) . "</p>";
        echo "<p><a href='../home1.php'>Go back</a></p>";
    }

    mysqli_close($conn);
}
?>

</body>
</html>
