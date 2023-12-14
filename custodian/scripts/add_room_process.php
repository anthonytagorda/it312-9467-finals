<?php include 'room_db.php';

// Retrieve form data
$roomNo = $_POST['roomNo'];
$roomType = $_POST['roomType'];
$roomLocation = $_POST['roomLocation'];
$capacity = $_POST['capacity'];
$roomStatus = $_POST['roomStatus'];

// Upload room photo
$targetDir = "uploads/";
$targetFile = $targetDir . basename($_FILES["roomPhoto"]["name"]);
move_uploaded_file($_FILES["roomPhoto"]["tmp_name"], $targetFile);

// Insert data into the database
$sql = "INSERT INTO rooms (room_no, room_type, room_location, capacity, room_status, room_photo) VALUES (?, ?, ?, ?, ?, ?)";
$stmt = $mysqli->prepare($sql);
$stmt->bind_param("sssiss", $roomNo, $roomType, $roomLocation, $capacity, $roomStatus, $targetFile);

if ($stmt->execute()) {
    header("Location: add_room.php?status=success");
} else {
    header("Location: add_room.php?status=error");
}

$stmt->close();
$mysqli->close();

?>

<?php
session_start();

// Your room addition logic here

// After successfully adding the room
$_SESSION['room_added'] = true;

// Redirect to room.php or wherever appropriate
header("Location: room.php");
exit();
?>

