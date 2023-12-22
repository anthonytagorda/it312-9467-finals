<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  include 'equipment_db.php'; // Include your database connection code

  // Retrieve data from the form
  $equipmentId = $_POST['id'];
  $equipmentName = $_POST['equipment_name'];
  $quantity = $_POST['quantity'];

  // Update data in the database
  $sql = "UPDATE equipment SET equipment_name='$equipmentName', quantity='$quantity' WHERE id=$equipmentId";

  if ($mysqli->query($sql) === TRUE) {
    echo "Equipment updated successfully!";
    echo '<br><br><a href="equipment.php">Go Back to Equipment List</a>';
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }

  // Close the database connection
  $mysqli->close();
}
?>
