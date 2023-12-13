<!-- add_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Add Equipment</title>
  <link rel="stylesheet" href="../styles/equipment.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <div class="container">
    <h1>Add Equipment</h1>

    <form action="add_equipment_process.php" method="post" enctype="multipart/form-data">
      <label for="equipment_name">Equipment Name:</label>
      <input type="text" id="equipment_name" name="equipment_name" required>

      <label for="quantity">Quantity:</label>
      <input type="number" id="quantity" name="quantity" required>

      <label for="equipment_image">Upload Photo:</label>
      <input type="file" id="equipment_image" name="equipment_image">

      <button type="submit">Add Equipment</button>
    </form>
  </div>
</body>

</html>
