<!-- manage_rental.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Manage Rental</title>
  <link rel="stylesheet" href="../styles/manage_rental.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <!-- Navigation Bar -->
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

    <!-- Manage Rental Content -->
    <div class="manage-rental-content">
      <!-- Display Room Information -->
      <div class="room-list">
        <h2>Rooms for Rent</h2>
        <?php
        include 'room_db.php';

        // Retrieve and display room information
        $sqlRooms = "SELECT * FROM rooms";
        $resultRooms = $mysqli->query($sqlRooms);

        if ($resultRooms->num_rows > 0) {
          echo '<ul>';
          while ($rowRoom = $resultRooms->fetch_assoc()) {
            echo '<li>';
            echo '<h3>' . $rowRoom['room_name'] . '</h3>';
            echo '<p>Floor: ' . $rowRoom['floor'] . '</p>';
            echo '<p>Capacity: ' . $rowRoom['capacity'] . '</p>';
            echo '<p>' . ($rowRoom['available'] ? 'Available' : 'Not Available') . '</p>';
            echo '</li>';
          }
          echo '</ul>';
        } else {
          echo 'No rooms available for rent';
        }
        ?>
      </div>

      <!-- Display Equipment Information -->
      <div class="equipment-list">
        <h2>Equipment for Rent</h2>
        <?php
        include 'equipment_db.php';

        // Retrieve and display equipment information
        $sqlEquipment = "SELECT * FROM equipment";
        $resultEquipment = $mysqli->query($sqlEquipment);

        if ($resultEquipment->num_rows > 0) {
          echo '<ul>';
          while ($rowEquipment = $resultEquipment->fetch_assoc()) {
            echo '<li>';
            echo '<h3>' . $rowEquipment['equipment_name'] . '</h3>';
            echo '<p>Quantity: ' . $rowEquipment['quantity'] . '</p>';
            echo '</li>';
          }
          echo '</ul>';
        } else {
          echo 'No equipment available for rent';
        }
        ?>
      </div>
    </div>
  </div>
</body>

</html>
