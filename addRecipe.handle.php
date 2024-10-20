<?php

session_start();

if(isset($_POST['add-recipe'])) {
    $name = $_SESSION['name']="HELLO"." ". $_SESSION['surname']="GOOD MORNING";
    $DishName = $_POST['dish-name'];
    $CuisineOrigin = $_POST['cuisine-origin'];
    $DishType = $_POST['dish-type'];
    $PrepTime = $_POST['prep-time'];
    $Description = $_POST['description'];
    $Ingredients = $_POST['ingredients'];
    $Instructions = $_POST['instructions']; 

    $totalpictures = count($_FILES['other-pictures']['name']);
    $picturesArray = array();
    
    for ($i = 0; $i < $totalpictures; $i++) {
        $imageName = $_FILES['other-pictures']['name'][$i];
        $tmp_name = $_FILES['other-pictures']['tmp_name'][$i];
    
        $imageextension = explode('.', $imageName);
        $imageactualextension = strtolower(end($imageextension));
        
        $newfilename = uniqid() . '.' . $imageactualextension;
        move_uploaded_file($tmp_name, 'uploads/' . $newfilename);
    
        // Add the new file name to the array
        $picturesArray[] = $newfilename;
    }
    
    // Now encode the array as JSON after the loop is complete
    $picturesArray = json_encode($picturesArray);
    
    if ($picturesArray === false) {
        echo "Error encoding pictures array to JSON: " . json_last_error_msg();
    }
    
        // Handle the uploaded main dish picture
        if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
            // Get the image file content
            $DishPicture = file_get_contents($_FILES['picture']['tmp_name']);
        } else {
            // Handle file upload error or no file uploaded
            echo "Error uploading main dish picture.";
            exit;
        }
    

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
      $stmt->bind_param("ssssssssss", $name, $DishName, $CuisineOrigin, $DishType, $DishPicture, $picturesArray, $PrepTime,  $Description, $Ingredients, $Instructions);
  
      // Execute the statement
      if ($stmt->execute()) {
          echo "<script>alert('Dish added successfully!'); window.location.href = './recipe.php';</script>";
      } else {
          echo "Error: " . $stmt->error;
      }
  
      // Close the statement and connection
      $stmt->close();
      $conn->close();
  }