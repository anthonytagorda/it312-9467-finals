<?php
session_start();
include '../pages/room.php';

// Retrieve form data
$roomNo = $_POST['room_no'];
$roomType = $_POST['room_type'];
$roomLocation = $_POST['room_location'];
$capacity = $_POST['capacity'];
$roomStatus = $_POST['room_status'];

// Upload room photo
$targetDir = "../public/assets/uploads/"; //it312-9467-finals\it312-9467-finals\custodian\public\assets\uploads
$targetFile = $targetDir . basename($_FILES["room_photo"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

// Check if the directory exists; if not, create it
if (!file_exists($targetDir) && !is_dir($targetDir)) {
    mkdir($targetDir, 0777, true);
}

// Check if the file was successfully uploaded
if (move_uploaded_file($_FILES["room_photo"]["tmp_name"], $targetFile)) {
    echo "The file " . htmlspecialchars(basename($_FILES["room_photo"]["name"])) . " has been uploaded.";

// Initialize the database connection
$mysqli = require __DIR__ . "/../../php/db.php";

// Insert data into the database
    $sql = "INSERT INTO rooms (room_no, room_type, room_location, capacity, room_status, room_photo) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $mysqli->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sssiss", $roomNo, $roomType, $roomLocation, $capacity, $roomStatus, $targetFile);

        if ($stmt->execute()) {
            echo "Room added successfully!";
            echo '<br><br><a href="../pages/room.php"> Go back to Rooms.</a>';
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the prepared statement
        $stmt->close();
    } else {
        echo "Error: " . $mysqli->error;
    }

    // Close the database connection.
    $mysqli->close();
} else {
    echo "Sorry, there was an error uploading your file.";
}
?>
