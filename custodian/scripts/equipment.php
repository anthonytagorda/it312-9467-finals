<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Box Icons [https://boxicons.com/usage]-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Rooms</title>
  <link rel="icon" href='../public/assets/images/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href="../public/styles/custodian_dashboard.css">
</head>

<body>
  <!--START OF SIDEBAR-->
  <section id="sidebar">
    <a href="#" alt="Rentify Logo" class="logo-img">
      <img src='../public/assets/images/r-icon.svg' alt="Rentify Logo" class="logo-img">
    </a>
    <ul class="side-menu top">
      <li>
        <a href="../pages/custodian_dashboard.html">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="../scripts/room.php">
          <i class='bx bxs-door-open'></i>
          <span class="text">Rooms</span>
        </a>
      </li>
      <li class="active">
        <a href="../scripts/equipment.php">
          <i class='bx bxs-cabinet'></i>
          <span class="text">Equipments</span>
        </a>
      </li>
      <li>
        <a href="../scripts/transaction_history.php">
          <i class='bx bx-clipboard'></i>
          <span class="text">Transaction History</span>
        </a>
      </li>
      <ul class="side-menu bottom">
        <li>
          <a href="#" class="report">
            <i class='bx bxs-shield-minus'></i>
            <span class="text">Report</span>
          </a>
        </li>
        <li>
          <a href="#">
            <i class='bx bxs-cog'></i>
            <span class="text">Settings</span>
          </a>
        </li>
        <li>
          <a href="../pages/custodian_login.html" class="logout">
            <i class='bx bx-log-out'></i>
            <span class="text">Logout</span>
          </a>
        </li>
      </ul>
  </section>
  <!--END OF SIDEBAR-->
  <!--START OF CONTENT-->
  <section id="content">
    <nav>
      <i class='bx bx-menu-alt-left'></i>
      <a href="#" class="nav-link">Categories</a>
      <form action="#">
        <div class="form-input">
          <form action="equipment.php" method="GET" class="search-form">
            <div class="form-input">
              <input type="search" name="search" placeholder="Search for Room or Equipment"
                value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
              <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
            </div>
          </form>
        </div>
      </form>
      <!--Notification Feature-->
      <a href="#" class="notification">
        <i class='bx bxs-bell'></i>
        <!--UPDATEABLE BY NUMBER OF REQUESTS/ORDERS-->
        <span class="num">8</span>
      </a>
      <!--Profile Feature-->
      <a href="#" class="profile">
        <i class='bx bxs-user-circle'></i>
      </a>
    </nav>
  </section>
  <!--END OF CONTENT-->
  <!--ROOMS LIST-->
  <?php
  include 'equipment_db.php'; // Include your equipment database connection
  
  // Check for search query
  $search = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '';

  // Retrieve and display equipment information with search filter if provided, otherwise show all equipments
  if (!empty($search)) {
    $sql = "SELECT * FROM equipment WHERE equipment_name LIKE ? OR equip_type LIKE ?";
    $stmt = $mysqli->prepare($sql);
    $stmt->bind_param('ss', $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="equipment">';
        echo '<h2>' . $row['equipment_name'] . '</h2>';
        echo '<p>Type: ' . $row['equip_type'] . '</p>';
        echo '<p>Quantity: ' . $row['quantity'] . '</p>';
        echo '<p>Status: ' . ($row['equip_status'] ? 'Available' : 'Not Available') . '</p>';
        echo '<img src="' . $row['equip_photo'] . '" alt="Equipment Photo" class="equipment-photo">';
        // Add more details or actions as needed
        echo '</div>';
      }
    } else {
      echo 'No matching equipments found';
    }
  } else {
    $sql = "SELECT * FROM equipment";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        echo '<div class="equipment">';
        echo '<h2>' . $row['equipment_name'] . '</h2>';
        echo '<p>Type: ' . $row['equip_type'] . '</p>';
        echo '<p>Quantity: ' . $row['quantity'] . '</p>';
        echo '<p>Status: ' . ($row['equip_status'] ? 'Available' : 'Not Available') . '</p>';
        echo '<img src="' . $row['equip_photo'] . '" alt="Equipment Photo" class="equipment-photo">';
        // Add more details or actions as needed
        echo '</div>';
      }
    } else {
      echo 'No equipments available';
    }
  }

  if (isset($stmt)) {
    $stmt->close();
  }

  $mysqli->close();
  ?>
  </div>
</body>
<script src="../public/scripts/script.js"></script>

</html>