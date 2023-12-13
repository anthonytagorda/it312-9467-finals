<!-- edit_room.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Edit Room</title>
  <link rel="stylesheet" href="../styles/room.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <h1>Edit Room</h1>

    <?php
    include 'room_db.php';

    // Check if the room ID is provided in the URL
    if (isset($_GET['id'])) {
      $roomId = $_GET['id'];

      // Retrieve room information based on the ID
      $sql = "SELECT * FROM rooms WHERE id = $roomId";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      ?>
        <form action="edit_room_process.php" method="post">
          <!-- Include hidden input field for the room ID -->
          <input type="hidden" name="id" value="<?php echo $roomId; ?>">

          <label for="room_name">Room Name:</label>
          <input type="text" id="room_name" name="room_name" value="<?php echo $row['room_name']; ?>" required>

          <label for="floor">Floor:</label>
          <input type="text" id="floor" name="floor" value="<?php echo $row['floor']; ?>" required>

          <label for="capacity">Capacity:</label>
          <input type="number" id="capacity" name="capacity" value="<?php echo $row['capacity']; ?>" required>

          <label for="availability">Availability:</label>
          <select id="availability" name="availability" required>
            <option value="1" <?php echo $row['available'] ? 'selected' : ''; ?>>Available</option>
            <option value="0" <?php echo !$row['available'] ? 'selected' : ''; ?>>Not Available</option>
          </select>

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
