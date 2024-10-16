<?php

session_start();

if(isset($_POST['add-recipe'])) {
    $name = $_SESSION['name']." ". $_SESSION['surname'];
    $DishName = $_POST['dish-name'];
    $CuisineOrigin = $_POST['cuisine-origin'];
    $DishType = $_POST['dish-type'];
    $DishPicture = $_POST['picture']; 
    $OtherPicturesArray = isset($_POST['other-pictures']) ? $_POST['other-pictures'] : [];
    $OtherPictures = implode(',', $OtherPicturesArray); 
    $PrepTime = $_POST['prep-time'];
    $Description = $_POST['description'];
    $Ingredients = $_POST['ingredients'];
    $Instructions = $_POST['instructions'];

      // Database connection
      $conn = mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');

      if (!$conn) {
          die('Connection failed: ' . mysqli_connect_error());
      }
  
      // Prepare an insert statement
      $stmt = $conn->prepare("INSERT INTO dishes (UserName, DishName, CuisineOrigin, DishType, DishPicture, OtherPictures, PrepTime,  Description, Ingredients, Instructions) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
      if (!$stmt) {
          die('Prepare failed: ' . $conn->error);
      }
  
      // Bind parameters
      $stmt->bind_param("ssssssssss", $name, $DishName, $CuisineOrigin, $DishType, $DishPicture, $OtherPictures, $PrepTime,  $Description, $Ingredients, $Instructions);
  
      // Execute the statement
      if ($stmt->execute()) {
          echo "<script>alert('Dish added successfully!'); window.location.href = './recipes.php';</script>";
      } else {
          echo "Error: " . $stmt->error;
      }
  
      // Close the statement and connection
      $stmt->close();
      $conn->close();
  }