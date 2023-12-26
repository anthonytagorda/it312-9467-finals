<!-- add_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!--Box Icons [https://boxicons.com/usage]-->
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <title>Equipments</title>
  <link rel="icon" href='../public/assets/images/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href='../public/styles/equipment.css'>
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
      <li>
        <a href="../pages/room.php">
          <i class='bx bxs-door-open'></i>
          <span class="text">Rooms</span>
        </a>
      </li>
      <li class="active">
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
      <!--Profile Feature-->
      <a href="#" class="profile">
        <i class='bx bxs-user-circle'></i>
      </a>
    </nav>
<!--EQUIPMENTS LIST-->
<div id="equipment-form" class="container">
  <form action="../functionalities/add_equipment_process.php" method="post" enctype="multipart/form-data">
    <label for="equipment_name">Equipment Name:</label>
      <input type="text" placeholder="Ex. HDMI Cable" name="equipment_name" id="equipment_name" required>

      <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <label for="equip_type">Equipment Type:</label>
        <input type="text" placeholder="Ex. Cable" name="equip_type" id="equip_type" required>

        <label for="equip_status">Equipment Status:</label>
        <select name="equip_status" id="equip_status" required>
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select>

        <label for="equipment_image">Equipment Photo:</label>
        <input type="file" name="equip_photo" id="equipment_image" required>

        <button type="submit">Add Equipment</button>
  </form>
</div>
</body>

</html>