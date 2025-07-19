<?php
  // booking.php

  // Assuming you want to handle form submissions and maybe save to a database
  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $pickup = $_POST['pickup'];
    $destination = $_POST['destination'];
    $name = $_POST['name'];
    $email = $_POST['email'];

    // Process the booking (e.g., save it to the database, or send an email)
    // Example: save the data (You should validate and sanitize inputs)
    // For simplicity, I'm just showing a success message

    echo "Booking received successfully!<br>";
    echo "Name: $name<br>";
    echo "Email: $email<br>";
    echo "Pickup Location: $pickup<br>";
    echo "Destination Location: $destination<br>";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Page</title>
    <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places&callback=initMap" async defer></script>
    <style>
        /* Style for the map container */
        #map {
            height: 400px;
            width: 100%;
        }
    </style>
</head>
<body>
    <h1>Booking Page</h1>

    <form method="POST" action="booking.php">
        <label for="name">Full Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>
        
        <label for="email">Email Address:</label><br>
        <input type="email" id="email" name="email" required><br><br>
        
        <label for="pickup">Pickup Location:</label><br>
        <input type="text" id="origin-input" name="pickup" required><br><br>

        <label for="destination">Destination Location:</label><br>
        <input type="text" id="destination-input" name="destination" required><br><br>

        <div id="map"></div><br>

        <input type="submit" value="Book Now">
    </form>

    <script>
        var map;
        var originPlaceId;
        var destinationPlaceId;
        var travelMode = 'DRIVING';

        function initMap() {
            map = new google.maps.Map(document.getElementById('map'), {
                center: {lat: -33.8688, lng: 151.2195},  // Default location (Sydney)
                zoom: 13
            });

            var directionsRenderer = new google.maps.DirectionsRenderer();
            directionsRenderer.setMap(map);

            var directionsService = new google.maps.DirectionsService();

            var originInput = document.getElementById('origin-input');
            var destinationInput = document.getElementById('destination-input');
            var originAutocomplete = new google.maps.places.Autocomplete(originInput);
            var destinationAutocomplete = new google.maps.places.Autocomplete(destinationInput);
            
            originAutocomplete.setFields(['place_id']);
            destinationAutocomplete.setFields(['place_id']);
            
            originAutocomplete.addListener('place_changed', function() {
                var place = originAutocomplete.getPlace();
                if (place.place_id) {
                    originPlaceId = place.place_id;
                    calculateRoute(directionsService, directionsRenderer);
                }
            });

            destinationAutocomplete.addListener('place_changed', function() {
                var place = destinationAutocomplete.getPlace();
                if (place.place_id) {
                    destinationPlaceId = place.place_id;
                    calculateRoute(directionsService, directionsRenderer);
                }
            });
        }

        function calculateRoute(directionsService, directionsRenderer) {
            if (!originPlaceId || !destinationPlaceId) return;

            var request = {
                origin: {placeId: originPlaceId},
                destination: {placeId: destinationPlaceId},
                travelMode: travelMode
            };

            directionsService.route(request, function(response, status) {
                if (status === 'OK') {
                    directionsRenderer.setDirections(response);
                } else {
                    alert('Directions request failed due to ' + status);
                }
            });
        }
    </script>

</body>
</html>
