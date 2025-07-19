<!DOCTYPE html>
<html lang="en">
<head>
  <title>SpeedO</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>
<body>

<?php
session_start();

if (isset($_SESSION['username'])) {
    include 'php/header_profile_myall.php';
    include 'connection.php';

    $email = mysqli_real_escape_string($conn, $_SESSION['username']);

    // Fetch user info
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $userid = $row["userid"];

        // Fetch trips for user
        $tripQuery = "SELECT * FROM trip WHERE userid = '$userid'";
        $tripResult = mysqli_query($conn, $tripQuery);

        if ($tripResult && mysqli_num_rows($tripResult) > 0) {
            echo '<div class="container mt-4">';
            echo '<h3>Your Trip History</h3>';
            echo '<table class="table table-bordered table-striped">';
            echo '<thead class="table-dark text-danger">';
            echo '<tr>
                    <th>Driver ID</th>
                    <th>Car Number</th>
                    <th>Destination</th>
                    <th>Fare</th>
                    <th>Booking ID</th>
                    <th>Trip Time</th>
                  </tr>';
            echo '</thead><tbody>';

            while ($trip = mysqli_fetch_assoc($tripResult)) {
                echo '<tr>
                        <td>' . htmlspecialchars($trip['driverid']) . '</td>
                        <td>' . htmlspecialchars($trip['car_number']) . '</td>
                        <td>' . htmlspecialchars($trip['destination']) . '</td>
                        <td>' . htmlspecialchars($trip['fare']) . '</td>
                        <td>' . htmlspecialchars($trip['bookingid']) . '</td>
                        <td>' . htmlspecialchars($trip['trip_time']) . '</td>
                      </tr>';
            }

            echo '</tbody></table></div>';
        } else {
            echo "<div class='container mt-4'><p class='text-muted'>No trips found for this user.</p></div>";
        }
    } else {
        echo "<div class='container mt-4'><p class='text-danger'>User not found.</p></div>";
    }

    mysqli_close($conn);
} else {
    echo "<div class='container mt-4'><p class='text-danger'>Please log in to view this page.</p></div>";
}
?>

</body>
</html>
