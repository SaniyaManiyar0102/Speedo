<?php
// booking.php

$servername = "localhost";
$username = "root"; // XAMPP default
$password = "";     // XAMPP default
$dbname = "speedo_db"; // your DB name

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $pickup = mysqli_real_escape_string($conn, $_POST['pickup']);
    $destination = mysqli_real_escape_string($conn, $_POST['destination']);
    $city = mysqli_real_escape_string($conn, $_POST['city']);
    $state = mysqli_real_escape_string($conn, $_POST['state']);
    $pin = mysqli_real_escape_string($conn, $_POST['pin']);
    $car_type = mysqli_real_escape_string($conn, $_POST['car_type']);

    $sql = "INSERT INTO bookings (username, pickup, destination, city, state, pin, car_type)
            VALUES ('$username', '$pickup', '$destination', '$city', '$state', '$pin', '$car_type')";

    if ($conn->query($sql) === TRUE) {
        echo "<h2 style='color:green;'>Booking Successful!</h2>";
        echo "<p>Name: $username</p>";
        echo "<p>Pickup: $pickup</p>";
        echo "<p>Destination: $destination</p>";
        echo "<p>City: $city</p>";
        echo "<p>State: $state</p>";
        echo "<p>Pin: $pin</p>";
        echo "<p>Car Type: $car_type</p>";
        echo "<br><a href='booking.html'>← Back to Booking Page</a>";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
