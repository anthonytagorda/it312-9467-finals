<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include 'room_db.php';

    // Retrieve data from the form
    $roomId = $_POST['room_id']; // Adjusted to use 'room_id' as the input name
    $roomNo = $_POST['room_no'];
    $roomLocation = $_POST['room_location'];
    $roomType = $_POST['room_type'];
    $capacity = $_POST['capacity'];
    $roomStatus = $_POST['room_status'];

    // Update data in the database
    $sql = "UPDATE rooms SET room_no='$roomNo', room_location='$roomLocation', room_type='$roomType', capacity='$capacity', room_status='$roomStatus' WHERE room_id=$roomId";  // Adjusted to use 'room_id' as the column name

    if ($mysqli->query($sql) === TRUE) {
        echo "Room updated successfully!";
        echo '<br><br><a href="room.php">Go Back to Room List</a>';
    } else {
        echo "Error: " . $sql . "<br>" . $mysqli->error;
    }

    // Close the database connection
    $mysqli->close();
}
?>
