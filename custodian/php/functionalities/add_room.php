<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Add Room</title>
  <link rel="stylesheet" href="../public/styles/room.css" />
</head>

<body>
  <h1>Add Room</h1>

  <form action="add_room_process.php" method="post" enctype="multipart/form-data">
        <label for="roomNo">Room Number:</label>
        <input type="text" name="roomNo" required>

        <label for="roomType">Room Type:</label>
        <input type="text" name="roomType">

        <label for="roomLocation">Room Location:</label>
        <input type="text" name="roomLocation">

        <label for="capacity">Capacity:</label>
        <input type="number" name="capacity" required>

        <label for="roomStatus">Room Status:</label>
        <select name="roomStatus" required>
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select>

        <label for="roomPhoto">Room Photo:</label>
        <input type="file" name="roomPhoto">

        <button type="submit">Add Room</button>
    </form>
</body>

</html>
