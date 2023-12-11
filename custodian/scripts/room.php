<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Dashboard</title>
  <link rel="stylesheet" href="../styles/room.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <nav>
      <ul>
        <li><a href="#" class="logo">
            <img src="/logo.jpg" alt="">
            <span class="nav-item">DashBoard</span>
          </a></li>
        <li><a href="index.php">
            <i class="fas fa-home"></i>
            <span class="nav-item">Home</span>
          </a></li>
        <li><a href="room.php">
            <i class="fas fa-user"></i>
            <span class="nav-item">Add Rooms</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-wallet"></i>
            <span class="nav-item">Add Equipment</span>
          </a></li>
        <li><a href="">
            <i class="fas fa-chart-bar"></i>
            <span class="nav-item">Manage Rental</span>
          </a></li>
      </ul>
    </nav>

    <div class="room-list">
      <?php
      include 'room_db.php';

      // Retrieve and display room information
      $sql = "SELECT * FROM rooms";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="room">';
      echo '<h2>' . $row['room_name'] . '</h2>';
      echo '<p>' . $row['floor'] . '</p>';
      echo '<p>CAPACITY: ' . $row['capacity'] . '</p>';
      echo '<p>' . ($row['available'] ? 'Available' : 'Not Available') . '</p>';
      echo '<a href="edit_room.php?id=' . $row['id'] . '">Edit Room</a>'; // Edit Room link
      echo '</div>';
        }
      } else {
        echo 'No rooms available';
      }
      ?>
    </div>

    <!-- Add Room button -->
    <button class="add-room-btn" onclick="location.href='add_room.php'">Add Room</button>
  </div>
</body>

</html>
