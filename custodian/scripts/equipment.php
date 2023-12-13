<!-- equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Equipment Dashboard</title>
  <link rel="stylesheet" href="../styles/equipment.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
  <style>
    /* Add a CSS rule to set the fixed size for the images */
    .equipment img {
      width: 100px; /* Set the desired width */
      height: 100px; /* Set the desired height */
      object-fit: cover; /* Preserve aspect ratio and cover the entire container */
      border: 1px solid #ddd; /* Add a border for better visibility */
      border-radius: 5px; /* Optional: Add border-radius for rounded corners */
    }
  </style>
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

    <!-- Equipment List -->
    <div class="equipment-list">
      <?php
      include 'equipment_db.php';

      // Retrieve and display equipment information
      $sql = "SELECT * FROM equipment";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<div class="equipment">';
          echo '<h2>' . $row['equipment_name'] . '</h2>';
          echo '<p>QUANTITY: ' . $row['quantity'] . '</p>';

          // Check if an image is available
          if ($row['image_path'] !== null) {
            echo '<img src="' . $row['image_path'] . '" alt="Equipment Image">';
          }

          echo '<a href="edit_equipment.php?id=' . $row['id'] . '">Edit Equipment</a>';
          echo '</div>';
        }
      } else {
        echo 'No equipment available';
      }
      ?>
    </div>

    <!-- Add Equipment button -->
    <button class="add-equipment-btn" onclick="location.href='add_equipment.php'">Add Equipment</button>
  </div>
</body>

</html>

