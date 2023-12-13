<?php
// process_add_room.php

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include your database connection code
    include 'room_db.php';

    // Retrieve data from the form
    $roomName = $_POST['room_name'];
    $floor = $_POST['floor'];
    $capacity = $_POST['capacity'];
    $availability = $_POST['availability'];

    // Insert data into the database
    $sql = "INSERT INTO rooms (room_name, floor, capacity, available) VALUES ('$roomName', '$floor', '$capacity', '$availability')";

    if ($mysqli->query($sql) === TRUE) {
        echo "Room added successfully!";
        echo '<br><br><a href="room.php">Go Back</a>'; // Go Back button
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
}
?>
