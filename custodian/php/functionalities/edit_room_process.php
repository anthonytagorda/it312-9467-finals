<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentify";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}
    // Retrieve data from the form
    $roomId = $_POST['room_id']; // Adjusted to use 'room_id' as the input name
    $roomNo = $_POST['room_no'];
    $roomLocation = $_POST['room_location'];
    $roomType = $_POST['room_type'];
    $capacity = $_POST['capacity'];
    $roomStatus = $_POST['room_status'];

    // Update data in the database
    $sql = "UPDATE rooms SET room_no=?, room_location=?, room_type=?, capacity=?, room_status=? WHERE room_id=?";

    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param("sssisi", $roomNo, $roomLocation, $roomType, $capacity, $roomStatus, $roomId);

    if ($stmt->execute()) {
        echo "Room updated successfully!";
        echo '<br><br><a href="../pages/room.php">Go Back to Room List</a>';
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the prepared statement
    $stmt->close();

    // Close the database connection
    $mysqli->close();
?>