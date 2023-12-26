<!-- edit_room.php -->
<?php
session_start();
include '../db.php';

if (isset($_GET['id'])) {
  $roomId = $_GET['id'];

  // Retrieve room information based on the ID
  $sql = "SELECT * FROM rooms WHERE room_id = ?";
  $stmt = $mysqli->prepare($sql);
  $stmt->bind_param('i', $roomId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();

    // The HTML form for editing the room
    echo '<link rel="stylesheet" href="../public/styles/room.css">';
    echo '<div id="room-form" class="container">';
    echo '<form action="edit_room_process.php" method="post">';
    echo '<input type="hidden" name="room_id" value="' . $row['room_id'] . '">';

    echo '<label for="room_no">Room Number:</label>';
    echo '<input type="text" id="room_no" name="room_no" value="' . $row['room_no'] . '" required>';

    echo '<label for="room_location">Room Location:</label>';
    echo '<input type="text" id="room_location" name="room_location" value="' . $row['room_location'] . '" required>';

    echo '<label for="room_type">Room Type:</label>';
    echo '<input type="text" id="room_type" name="room_type" value="' . $row['room_type'] . '" required>';

    echo '<label for="capacity">Capacity:</label>';
    echo '<input type="number" id="capacity" name="capacity" value="' . $row['capacity'] . '" required>';

    echo '<label for="room_status">Availability:</label>';
    echo '<select id="room_status" name="room_status" required>';
    echo '<option value="1" ' . ($row['room_status'] ? 'selected' : '') . '>Available</option>';
    echo '<option value="0" ' . (!$row['room_status'] ? 'selected' : '') . '>Not Available</option>';
    echo '</select>';

    echo '<label for="room_photo">Room Photo:</label>';
    echo '<input type="text" id="room_photo" name="room_photo" value="' . $row['room_photo'] . '" required>';

    echo '<button type="submit">Update Room</button>';
    echo '</form>';
    echo '</div>';
  } else {
    echo 'Room not found.';
  }

  $stmt->close();
} else {
  echo 'Room ID not provided.';
}

$mysqli->close();
?>
