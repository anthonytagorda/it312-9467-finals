<!-- add_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Add Equipment</title>
  <link rel="stylesheet" href="../styles/equipment.css" />
</head>

<body>
  <div class="container">
    <h1>Add Equipment</h1>

    <form action="add_equipment_process.php" method="post" enctype="multipart/form-data">
        <label for="equip_name">Equipment Name:</label>
        <input type="text" name="equipment_name" id="equipment_name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <label for="equip_type">Equipment Type:</label>
        <input type="text" name="equip_type" id="equip_type" required>

        <label for="equip_description">Equipment Description:</label>
        <textarea name="equip_description" id="equip_description" required></textarea>

        <label for="equip_status">Equipment Status:</label>
        <select name="equip_status" id="equip_status" required>
            <option value="1">Available</option>
            <option value="0">Not Available</option>
        </select>

        <label for="equipment_image">Equipment Photo:</label>
        <input type="file" name="equip_photo" id="equipment_image" required>

        <button type="submit">Add Equipment</button>
    </form>
  </div>
</body>

</html>
