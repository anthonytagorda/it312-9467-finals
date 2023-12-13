<!-- reset_password.php -->

<?php
$isValidToken = false;
$errorMessage = '';

// Retrieve the token from the URL
$resetToken = $mysqli->real_escape_string($_GET["token"]);

// Check if the token exists in the password_reset table
$checkTokenSql = "SELECT user_id FROM password_reset WHERE token = '$resetToken' AND expiration_time > NOW()";
$checkTokenResult = $mysqli->query($checkTokenSql);

if ($checkTokenResult->num_rows > 0) {
    // Token is valid, allow the user to reset the password
    $isValidToken = true;
    $userId = $checkTokenResult->fetch_assoc()["user_id"];
} else {
    // Token is invalid or expired
    $errorMessage = "Invalid or expired token. Please request a new password reset link.";
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Validate and sanitize the password input
    $newPassword = $_POST["new_password"];
    $confirmPassword = $_POST["confirm_password"];

    if ($newPassword === $confirmPassword) {
        // Update the custodian table with the new password
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updatePasswordSql = "UPDATE custodian SET password_hash = '$hashedPassword', reset_token = NULL, reset_token_expiration = NULL WHERE id = $userId";
        $mysqli->query($updatePasswordSql);

        // Remove the used reset token from the password_reset table
        $deleteTokenSql = "DELETE FROM password_reset WHERE token = '$resetToken'";
        $mysqli->query($deleteTokenSql);

        // Provide a success message to the user
        $successMessage = "Password reset successfully. You can now login with your new password.";
    } else {
        // Passwords do not match
        $errorMessage = "Passwords do not match. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rentify Reset Password</title>
    <link rel="stylesheet" href="../styles/globals.css">
    <link rel="stylesheet" href="../styles/reset_password.css">
</head>

<body>
    <div class="wrapper">
        <div class="form-box reset-password">
            <!-- Display success or error message here -->
            <?php if ($isValidToken && isset($successMessage)) : ?>
                <div class="success-message"><?= $successMessage ?></div>
            <?php elseif (!$isValidToken && isset($errorMessage)) : ?>
                <div class="error-message"><?= $errorMessage ?></div>
            <?php endif; ?>

            <?php if ($isValidToken) : ?>
                <h2>Reset Password</h2>
                <form method="post">
                    <div class="input-box">
                        <label for="new_password">New Password</label>
                        <input type="password" name="new_password" id="new_password" required>
                    </div>
                    <div class="input-box">
                        <label for="confirm_password">Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" required>
                    </div>
                    <button type="submit" class="submit-button">Reset Password</button>
                </form>
            <?php endif; ?>

            <div class="login-link">
                <a href="login.php">Back to Login</a>
            </div>
        </div>
    </div>
</body>

</html>
