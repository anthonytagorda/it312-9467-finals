<!-- edit_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Edit Equipment</title>
  <link rel="stylesheet" href="../public/styles/equipment.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <h1>Edit Equipment</h1>

    <?php
    include 'equipment_db.php'; // Include your database connection code

    // Check if the equipment ID is provided in the URL
    if (isset($_GET['id'])) {
      $equipmentId = $_GET['id'];

      // Retrieve equipment information based on the ID
      $sql = "SELECT * FROM equipment WHERE id = $equipmentId";
      $result = $mysqli->query($sql);

      if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
      ?>
        <form action="edit_equipment_process.php" method="post">
          <!-- Include hidden input field for the equipment ID -->
          <input type="hidden" name="id" value="<?php echo $equipmentId; ?>">

          <label for="equipment_name">Equipment Name:</label>
          <input type="text" id="equipment_name" name="equipment_name" value="<?php echo $row['equipment_name']; ?>" required>

          <label for="quantity">Quantity:</label>
          <input type="number" id="quantity" name="quantity" value="<?php echo $row['quantity']; ?>" required>

          <button type="submit">Update Equipment</button>
        </form>
    <?php
      } else {
        echo 'Equipment not found.';
      }
    } else {
      echo 'Equipment ID not provided.';
    }
    ?>
  </div>
</body>

</html>
