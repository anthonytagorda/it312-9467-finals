<?php

session_start();

if (isset($_SESSION["user_id"])) {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = "SELECT * FROM custodian
            WHERE id = {$_SESSION["user_id"]}";
            
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
}

?>


<span style="font-family: verdana, geneva, sans-serif;">
    
<!DOCTYPE html>
    <html lang="en">
    <head>
      <meta charset="UTF-8" />
      <title>Dashboard</title>
      <link rel="stylesheet" href="../styles/custodian_dashboard.css" />
     
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css"/>
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
            <li><a href="">
              <i class="fas fa-chart-bar"></i>
              <span class="nav-item">Manage Rental</span>
          </ul>
        </nav>

    <main class="content">
        <div class="content-box">
            <h1>Hello <?= htmlspecialchars($user["name"]) ?></h1>
            <img src="image.jpg" alt="Image" class="image">
            <p></p>
        </div>
    </main>
    
            </div>
          </div>
        </section>
      </div>

    </body>
    </html></span>
    
    
    
    
    
    
    
    
    
    
    