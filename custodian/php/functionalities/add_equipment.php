<!-- add_equipment.php -->
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <title>Add Equipment</title>
  <link rel="icon" href='../public/assets/images/r-icon.svg' type="image/svg">
  <link rel="stylesheet" href="../public/styles/equipment.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" />
</head>

<body>
  <header>
    <img src="../public/assets/images/rentify-icon.png" type="image/svg" alt="Rentify" id="logo">
    <h1>Add Equipment</h1>
  </header>
  <div class="container">

    <form action="add_equipment_process.php" method="post" enctype="multipart/form-data">
        <label for="equipment_name">Equipment Name:</label>
        <input type="text" placeholder="Ex. HDMI Cable" name="equipment_name" id="equipment_name" required>

        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" id="quantity" required>

        <label for="equip_type">Equipment Type:</label>
        <input type="text" placeholder="Ex. Cable" name="equip_type" id="equip_type" required>

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