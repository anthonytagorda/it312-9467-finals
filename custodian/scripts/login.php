<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "/database.php";
    
    $sql = sprintf("SELECT * FROM custodian
                    WHERE email = '%s'",
                   $mysqli->real_escape_string($_POST["email"]));
    
    $result = $mysqli->query($sql);
    
    $user = $result->fetch_assoc();
    
    if ($user) {
        
        if (password_verify($_POST["password"], $user["password_hash"])) {
            
            session_start();
            
            session_regenerate_id();
            
            $_SESSION["user_id"] = $user["id"];
            
            header("Location: ../pages/custodian_dashboard.html");
            exit;
        }
    }
    
    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentify Login</title>
    <link rel="icon" href='/assets/images/r-icon.png' type="image/png">
    <link rel="stylesheet" href="../public/styles/custodian_login.css">
</head>
<body>
    <div class="wrapper">
    <?php if ($is_invalid): ?>
        <script>
            alert("Invalid Login");
        </script>
    <?php endif; ?>
        <div class="form-box login">
            <img src='/assets/images/rentify-icon.png' alt="Rentify Logo" class="logo-img">
            <h2>Hi there! Welcome back </h2>
            <h4>Log in to Rentify with your School ID</h4>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                    <label>Username</label>
                    <input type="email" name="email" id="email" value="<?= htmlspecialchars($_POST["email"] ?? "") ?>" placeholder ="Username" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="forgot">
                    <a href="/contact_admin">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">Login</button>
                <div class="login-register">
                    <p> Don't have an account?
                        <a href="/contact_admin" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <!--Ionics Icons [https://ionic.io/ionicons/usage]-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>
</html>