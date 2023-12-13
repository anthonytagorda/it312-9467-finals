<!-- forgot_password.php -->

<?php
$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $mysqli = require __DIR__ . "/database.php";

    // Validate and sanitize the email input
    $email = $mysqli->real_escape_string($_POST["email"]);

    // Check if the email exists in the custodian table
    $checkEmailSql = "SELECT id FROM custodian WHERE email = '$email'";
    $checkEmailResult = $mysqli->query($checkEmailSql);

    if ($checkEmailResult->num_rows > 0) {
        // Generate a unique reset token
        $resetToken = bin2hex(random_bytes(32));

        // Set expiration time (e.g., 1 hour from now)
        $expirationTime = date('Y-m-d H:i:s', strtotime('+1 hour'));

        // Update the custodian table with the reset token and expiration time
        $updateTokenSql = "UPDATE custodian SET reset_token = '$resetToken', reset_token_expiration = '$expirationTime' WHERE email = '$email'";
        $mysqli->query($updateTokenSql);

        // Insert the reset request into the password_reset table
        $userId = $checkEmailResult->fetch_assoc()["id"];
        $insertResetSql = "INSERT INTO password_reset (user_id, token, expiration_time) VALUES ('$userId', '$resetToken', '$expirationTime')";
        $mysqli->query($insertResetSql);

        // Send an email to the user with a link to the password reset page
        $resetLink = "http://yourdomain.com/reset_password.php?token=$resetToken";
        // Implement email sending logic here

        // Provide a success message to the user
        $successMessage = "Password reset link sent to your email. Please check your inbox.";
    } else {
        // Email not found in the custodian table
        $errorMessage = "Email not found. Please try again.";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentify Forgot Password</title>
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/forgot_password.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-box forgot-password">
            <!-- Display success or error message here -->
            <?php if (isset($successMessage)) : ?>
                <div class="success-message"><?= $successMessage ?></div>
            <?php elseif (isset($errorMessage)) : ?>
                <div class="error-message"><?= $errorMessage ?></div>
            <?php endif; ?>

            <h2>Forgot Password</h2>
            <form method="post">
                <div class="input-box">
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" required>
                </div>
                <button type="submit" class="submit-button">Reset Password</button>
            </form>
            <div class="login-link">
                <a href="login.php">Back to Login</a>
            </div>
        </div>
    </div>
</body>

</html>
