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
        <li><a href="equipment.php">
            <i class="fas fa-wallet"></i>
            <span class="nav-item">Add Equipment</span>
          </a></li>
        <li><a href="manage_rental.php">
            <i class="fas fa-chart-bar"></i>
            <span class="nav-item">Manage Rental</span>
          </a></li>
          <li><a href="logout.php">
            <i class="fas fa-chart-bar"></i>
            <span class="nav-item">Logout</span>
          </a></li>
      </ul>
    </nav>
<?php
        // Check for room addition success and display notification
        if (isset($_SESSION['room_added']) && $_SESSION['room_added']) {
            echo '<div class="notification">Room added successfully!</div>';
            // Reset the session variable
            unset($_SESSION['room_added']);
        }
?>

    <div class="room-list">
    <?php
            include 'room_db.php';

            // Retrieve and display room information
            $sql = "SELECT * FROM rooms";
            $result = $mysqli->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo '<div class="room">';
                    echo '<h2>' . $row['room_no'] . '</h2>';
                    echo '<p>' . $row['room_location'] . '</p>';
                    echo '<p>TYPE: ' . $row['room_type'] . '</p>';
                    echo '<p>CAPACITY: ' . $row['capacity'] . '</p>';
                    echo '<p>' . ($row['room_status'] ? 'Available' : 'Not Available') . '</p>';
                    echo '<img src="' . $row['room_photo'] . '" alt="Room Photo" class="room-photo">';
                    echo '<button>Edit Room</button>';
                    echo '</div>';
                }
            } else {
                echo 'No rooms available';
            }

            $mysqli->close();
            ?>
    </div>

    <!-- Add Room button -->
    <button class="add-room-btn" onclick="location.href='add_room.php'">Add Room</button>
  </div>
</body>

</html>
