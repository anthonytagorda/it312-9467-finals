<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Box Icons [https://boxicons.com/usage]-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Rooms</title>
  <link rel="icon" href='../public/assets/images/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href='../public/styles/custodian_dashboard.css'>
</head>

<body>
  <!--START OF SIDEBAR-->
  <section id="sidebar">
    <a href="#" alt="Rentify Logo" class="logo-img">
      <img src='../public/assets/images/r-icon.svg' alt="Rentify Logo" class="logo-img">
    </a>
    <ul class="side-menu top">
      <li>
        <a href="../pages/custodian_dashboard.php">
          <i class='bx bxs-dashboard'></i>
          <span class="text">Dashboard</span>
        </a>
      </li>
      <li class="active">
        <a href="../pages/room.php">
          <i class='bx bxs-door-open'></i>
          <span class="text">Rooms</span>
        </a>
      </li>
      <li>
        <a href="../pages/equipment.php">
          <i class='bx bxs-cabinet'></i>
          <span class="text">Equipments</span>
        </a>
      </li>
      <li>
        <a href="../pages/transaction_history.php">
          <i class='bx bx-clipboard'></i>
          <span class="text">Transaction History</span>
        </a>
      </li>
      <ul class="side-menu bottom">
        <li>
          <a href="../custodian_login.php" class="logout">
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
    <form action="#">
      <div class="form-input">
        <form action="room.php" method="GET" class="search-form">
          <div class="form-input">
            <input type="search" name="search" placeholder="Search for Room or Equipment"
              value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
          </div>
        </form>
      </div>
    </form>
      <!--Profile Feature-->
      <a href="#" class="profile">
        <i class='bx bxs-user-circle'></i>
      </a>
    </nav>
  </div>
<!--ROOMS LIST-->
<div class="add-rooms">
  <button type="button" class="btn" onclick="window.location.href='../functionalities/add_room.php'">Add Rooms</button>
</div>

<?php
// Check for room addition success and display notification
  if (isset($_SESSION['room_added']) && $_SESSION['room_added']) {
    echo '<div class="notification">Room added successfully!</div>';
    unset($_SESSION['room_added']);  // Reset the session variable
  }
  include '../db.php';

  $search = isset($_GET['search']) ? '%' . $mysqli->real_escape_string($_GET['search']) . '%' : '';

  $sqlBase = "SELECT * FROM rooms";
  $whereClause = "";
  
  if (!empty($search)) {
    $sqlBase .= " WHERE room_no LIKE ? OR room_location LIKE ? OR room_type LIKE ?";
    $whereClause = "sss";
  }

  $stmt = $mysqli->prepare($sqlBase . $whereClause);
  if (!empty($search)) {
    $stmt->bind_param('sss', $search, $search, $search);
  }

  $stmt->execute();
  $result = $stmt->get_result();

  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<div class="room">';
        echo '<h2>' . $row['room_no'] . '</h2>';
        echo '<p>' . $row['room_location'] . '</p>';
        echo '<p>TYPE: ' . $row['room_type'] . '</p>';
        echo '<p>CAPACITY: ' . $row['capacity'] . '</p>';
        echo '<p>' . ($row['room_status'] ? 'Available' : 'Not Available') . '</p>';
        echo '<img src="' . $row['room_photo'] . '" alt="Room Photo" class="room-photo">';
        echo '<a href="../functionalities/edit_room.php?id=' . $row['room_id'] . '" class="edit-room-btn">Edit Room</a>';
        echo '</div>';
    }
  } else {
    echo 'No ' . (!empty($search) ? 'matching ' : '') . 'rooms found';
  }

    $stmt->close();
    $mysqli->close();
  ?>
  </section>
</div>
<!--END OF CONTENT-->
</body>
<script src="../public/scripts/script.js"></script>

</html>