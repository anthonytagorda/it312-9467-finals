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
      <a href="#" class="nav-link">Categories</a>
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
<!--ROOMS LIST-->
<div class="rooms-container">
  <button type="button" class="btn" onclick="window.location.href='../pages/room.php'">Retun</button>
    <form action="../functionalities/add_room_process.php" method="post" enctype="multipart/form-data">
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
</div>