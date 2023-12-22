<?php

session_start();

if (isset($_SESSION["user_id"])) {

    $mysqli = require __DIR__ . "../database.php";

    $sql = "SELECT * FROM custodian
            WHERE id = {$_SESSION["user_id"]}";

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--Box Icons [https://boxicons.com/usage]-->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Custodian Dashboard</title>
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
            <li class="active">
                <a href="custodian_dashboard.php">
                    <i class='bx bxs-dashboard'></i>
                    <span class="text">Dashboard</span>
                </a>
            </li>
            <li>
                <a href="room.php">
                    <i class='bx bxs-door-open'></i>
                    <span class="text">Rooms</span>
                </a>
            </li>
            <li>
                <a href="equipment.php">
                    <i class='bx bxs-cabinet'></i>
                    <span class="text">Equipments</span>
                </a>
            </li>
            <li>
                <a href="transaction_history">
                    <i class='bx bx-clipboard'></i>
                    <span class="text">Transaction History</span>
                </a>
            </li>
            <ul class="side-menu bottom">
                <li>
                    <a href="report.php" class="report">
                        <i class='bx bxs-shield-minus'></i>
                        <span class="text">Report</span>
                    </a>
                </li>
                <li>
                    <a href="settings.php">
                        <i class='bx bxs-cog'></i>
                        <span class="text">Settings</span>
                    </a>
                </li>
                <li>
                    <a href="#" class="logout" onclick="openLogoutModal()">
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
                    <input type="search" placeholder="Search for Room or Equipment">
                    <button type="submit" class="search-btn"><i class='bx bx-search'></i></button>
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
        <!-- DASHBOARD GREETING-->
        <div class="content-box">
            <h1>Hello
                <?= htmlspecialchars($user["name"]) ?>
            </h1>
            <p></p>
        </div>
        <!--END OF CONTENT-->

</body>
<script src="../public/scripts/script.js"></script>

</html>