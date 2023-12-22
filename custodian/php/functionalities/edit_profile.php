<?php
// edit_profile.php

session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: index.php"); // Redirect to the login page if not logged in
    exit();
}

$mysqli = require __DIR__ . "/database.php";

// Retrieve user information
$sql = "SELECT * FROM custodian WHERE id = {$_SESSION["user_id"]}";
$result = $mysqli->query($sql);
$user = $result->fetch_assoc();

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve form data
    $name = $_POST["name"];
    $email = $_POST["email"];
    $newPassword = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];

    // Validate and process the data (implement your validation logic)
    // ...

    // Update the user's profile in the database (example)
    $updateSql = "UPDATE custodian SET name = '$name', email = '$email' WHERE id = {$_SESSION["user_id"]}";

    if (!empty($newPassword) && $newPassword === $confirmPassword) {
        // Update password if a new password is provided and matches the confirmation
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $updateSql = "UPDATE custodian SET name = '$name', email = '$email', password_hash = '$hashedPassword' WHERE id = {$_SESSION["user_id"]}";
    }

    $updateResult = $mysqli->query($updateSql);

    if ($updateResult) {
        // Redirect back to the profile page after updating
        header("Location: edit_profile.php?update=success");
        exit();
    } else {
        // Handle update failure (display an error message, log, etc.)
        echo "Update failed. Please try again.";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Edit Profile</title>
    <link rel="stylesheet" href="../public/styles/edit_profile.css" /> <!-- Include your CSS file -->
</head>

<body>
        <main class="content">
            <div class="content-box">
                <h1>Edit Profile</h1>
                <?php if (isset($_GET['update']) && $_GET['update'] === 'success'): ?>
                    <div class="success-message">
                        Profile updated successfully!
                        <br>
                     <a href="index.php">Go Back to Home</a>
                    </div>
                <?php endif; ?>
                <form action="edit_profile.php" method="post">
                <label for="name">Name:</label>
                    <input type="text" name="name" value="<?= htmlspecialchars($user["name"]) ?>">

                     <label for="email">Email:</label>
                     <input type="email" name="email" value="<?= htmlspecialchars($user["email"]) ?>">

                    <label for="password">New Password:</label>
                    <input type="password" name="password">

                    <label for="confirm_password">Confirm New Password:</label>
                    <input type="password" name="confirm_password">

                    <button type="submit">Save Changes</button>
                </form>
            </div>
        </main>
    </div>
</body>
</html>
