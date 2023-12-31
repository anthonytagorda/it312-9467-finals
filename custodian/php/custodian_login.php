<?php
session_start();

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    
    $mysqli = require __DIR__ . "\database.php";

    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = sprintf("SELECT * FROM custodian
                    WHERE email = '%s'",
        $mysqli->real_escape_string($email));

    $result = $mysqli->query($sql);

    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user["password_hash"])) {

        session_regenerate_id();

        $_SESSION["user_id"] = $user["id"];

        header("Location: ../php/pages/custodian_dashboard.php");
        exit;
    }

    $is_invalid = true;
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Custodian Login</title>
    <link rel="icon" href='public/assets/images/r-icon.svg' type="image/svg">
    <link rel="stylesheet" href="public/styles/custodian_login.css">
</head>

<body>
    <div class="background">
        <img src='public/assets/images/samcis-bg.JPG' alt="SAMCIS img">
    </div>
    <div class="wrapper">
        <?php if ($is_invalid): ?>
            <script>
                alert("Invalid Login");
            </script>
        <?php endif; ?>
        <div class="form-box login">
        <img src='public/assets/images/r-icon.svg' alt="Rentify Logo" class="logo-img">
            <h2>Hi there! Welcome back </h2>
            <h4>Log in to Rentify</h4>
            <form method="POST">
                <div class="input-box">
                    <span class="icon"><ion-icon name="id-card-outline"></ion-icon></span>
                    <label>Custodian ID</label>
                    <input type="number" name="custodian_id" id="custodian_id" value="<?= htmlspecialchars($_POST["custodian_id"] ?? "") ?>"
                        placeholder="Custodian ID" required>
                </div>
                <div class="input-box">
                    <span class="icon"><ion-icon name="lock-closed"></ion-icon></span>
                    <label>Password</label>
                    <input type="password" name="password" placeholder="Password" required>
                </div>
                <div class="forgot">
                    <a href="../php/pages/contact_admin.php">Forgot Password?</a>
                </div>
                <button type="submit" class="login-button">Login</button>
                <div class="login-register">
                    <p> Don't have an account?
                        <a href="../php/pages/contact_admin.php" class="register-link">Register</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <!--Ionics Icons [https://ionic.io/ionicons/usage]-->
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
</body>

</html>