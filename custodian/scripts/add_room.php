<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Room</title>
  <link rel="stylesheet" href="../styles/room.css" />
</head>

<body>
  <h1>Add Room</h1>

  <form action="add_room_process.php" method="post">
    <label for="room_name">Room Name:</label>
    <input type="text" id="room_name" name="room_name" required>

    <label for="floor">Floor:</label>
    <input type="text" id="floor" name="floor" required>

    <label for="capacity">Capacity:</label>
    <input type="number" id="capacity" name="capacity" required>

    <label for="availability">Availability:</label>
    <select id="availability" name="availability" required>
      <option value="1">Available</option>
      <option value="0">Not Available</option>
    </select>

    <button type="submit">Add Room</button>
  </form>
</body>

</html>
