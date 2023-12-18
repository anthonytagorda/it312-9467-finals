<!-- login_process.php -->
<?php
session_start();

// Assuming you have a database connection established in your login_db.php
include 'login_db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Hash the entered password (replace 'password_hash' with your actual column name)
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Check the database for a matching user
    $sql = "SELECT name, email, password_hash FROM users WHERE email = '$email'";
    $result = $mysqli->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password_hash'])) {
            // Password is correct, set session variables
            $_SESSION['user_id'] = $row['user_id']; // Assuming you have a 'user_id' column in your table
            $_SESSION['user_name'] = $row['name'];
            header('Location: dashboard.php');
            exit();
        } else {
            // Password is incorrect
            echo "Incorrect password";
        }
    } else {
        // No user found with the provided email
        echo "No user found with the provided email";
    }

    // Close the database connection
    $mysqli->close();
}
?>
