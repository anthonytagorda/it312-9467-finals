<!-- add_equipment_process.php -->
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "rentify";

// Create connection
$mysqli = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

  // Retrieve data from the form
  $equipName = $_POST['equipment_name'];
  $quantity = $_POST['quantity'];
  $equipType = $_POST['equip_type'];
  $equipStatus = $_POST['equip_status'];

  // File upload handling
  $targetDir = "../public/assets/uploads/";
  $targetFile = $targetDir . basename($_FILES["equip_photo"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

  // Check if the image file is a actual image or fake image
  if (isset($_POST["submit"])) {
    $check = getimagesize($_FILES["equip_photo"]["tmp_name"]);
    if ($check !== false) {
      echo "File is an image - " . $check["mime"] . ".";
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }
  }

  // Check if file already exists
  if (file_exists($targetFile)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  // Check file size
  if ($_FILES["equip_photo"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  // Allow certain file formats
  $allowedFormats = array("jpg", "jpeg", "png", "gif");
  if (!in_array($imageFileType, $allowedFormats)) {
    echo "Sorry, only JPG, JPEG, PNG, and GIF files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
  } else {
    // If everything is ok, try to upload file
    if (move_uploaded_file($_FILES["equip_photo"]["tmp_name"], $targetFile)) {
      echo "The file " . htmlspecialchars(basename($_FILES["equip_photo"]["name"])) . " has been uploaded.";
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

  // Insert data into the database
  $sql = "INSERT INTO equipment (equipment_name, quantity, equip_type, equip_status, equip_photo) 
          VALUES ('$equipName', '$quantity', '$equipType', '$equipStatus', '$targetFile')";

  if ($mysqli->query($sql) === TRUE) {
    echo "Equipment added successfully!";
    echo '<br><br><a href="../pages/equipment.php">Go Back to Equipment List</a>';
  } else {
    echo "Error: " . $sql . "<br>" . $mysqli->error;
  }

  // Close the database connection
  $mysqli->close();
?>
