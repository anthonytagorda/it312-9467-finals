<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'room_db.php';

  // Retrieve data from the form
  $roomId = $_POST['id'];
  $roomName = $_POST['room_name'];
  $floor = $_POST['floor'];
  $capacity = $_POST['capacity'];
  $availability = $_POST['availability'];

  // Update data in the database
  $sql = "UPDATE rooms SET room_name='$roomName', floor='$floor', capacity='$capacity', available='$availability' WHERE id=$roomId";

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
