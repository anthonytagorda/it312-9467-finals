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
            
            header("Location: index.php");
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
    <link rel="icon" href="../../../common/assets/images/r-icon.png" type="image/png">
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/custodian_login.css">
</head>
<body>
    <div class="wrapper">
        <div class="form-box login">
            <img src="../../../common/assets/images/rentify-icon.png" alt="Rentify Logo" class="logo-img">
            <h2>Hi there! </h2>
            <h4>Log in to Rentify</h4>
            <form method="post">
                <div class="input-box">
                <label for="email">email</label>
                <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">
                </div>
                <div class="input-box">
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                </div>
                <div class="forgot">
                    <a href="contact_admin.html">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">Login</button>
                <div class="login-register">
                    <p> Don't have an account?
                        <a href="../pages/register.html" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
</body>
</html>