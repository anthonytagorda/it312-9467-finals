<!-- edit_room.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Edit Room</title>
  <link rel="stylesheet" href="../public/styles/room.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <h1>Edit Room</h1>

    <?php
    include 'room.php';

    // Check if the room ID is provided in the URL
    if (isset($_GET['id'])) {
      $roomId = $_GET['id'];

      // Retrieve room information based on the ID
      $sql = "SELECT * FROM rooms WHERE room_id = $roomId";  // Adjusted to use 'room_id' as the column name
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    ?>
        <form action="edit_room_process.php" method="post">
          <!-- Include hidden input field for the room ID -->
          <input type="hidden" name="room_id" value="<?php echo $roomId; ?>"> <!-- Adjusted to use 'room_id' as the input name -->

          <label for="room_no">Room Number:</label>
          <input type="text" id="room_no" name="room_no" value="<?php echo $row['room_no']; ?>" required>

          <label for="room_location">Room Location:</label>
          <input type="text" id="room_location" name="room_location" value="<?php echo $row['room_location']; ?>" required>

          <label for="room_type">Room Type:</label>
          <input type="text" id="room_type" name="room_type" value="<?php echo $row['room_type']; ?>" required>

          <label for="capacity">Capacity:</label>
          <input type="number" id="capacity" name="capacity" value="<?php echo $row['capacity']; ?>" required>

          <label for="room_status">Availability:</label>
          <select id="room_status" name="room_status" required>
            <option value="1" <?php echo $row['room_status'] ? 'selected' : ''; ?>>Available</option>
            <option value="0" <?php echo !$row['room_status'] ? 'selected' : ''; ?>>Not Available</option>
          </select>

          <label for="room_photo">Room Photo:</label>
          <input type="text" id="room_photo" name="room_photo" value="<?php echo $row['room_photo']; ?>" required>

          <!-- Additional fields can be added based on your database schema -->

          <button type="submit">Update Room</button>
        </form>
    <?php
      } else {
        echo 'Room not found.';
      }
    } else {
      echo 'Room ID not provided.';
    }
    ?>
  </div>
</body>

</html>
