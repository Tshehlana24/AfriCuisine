<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

<?php
if (isset($_POST['Rate'])) {
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    $recipeID = $_POST['recipeID'];

    // Database connection
    $conn = mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sqlRequest = "INSERT INTO ratings (user_id, recipe_id, rating, comment) VALUES (?, ?, ?, ?)";
    
    // Set user ID - make sure it's set correctly
    $_SESSION['user_id'] = 34; // Assuming this is set after user authentication

    // Prepare statement
    $stmt = $conn->prepare($sqlRequest);
    if ($stmt === false) {
        die("Failed to prepare statement: " . htmlspecialchars($conn->error));
    }

    // Bind parameters (user_id should be an integer)
    $stmt->bind_param("iiss", $_SESSION['user_id'], $recipeID, $rating, $comment);
    $stmt->execute();

    // Check if the insertion was successful
    if ($stmt->affected_rows > 0) {
        echo "<script>
                alert('Comment Added! Thank you for contributing to our community.');
                window.location.href = './recipeView.php?id={$recipeID}';
              </script>";
    } else {
        echo "<script>
                alert('Comment failed to add. Try again!');
                window.location.href = './recipeView.php?id={$recipeID}';
              </script>";
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    // If the form was not submitted, redirect or show an error
    echo "<script>
            alert('Invalid request. Please try again.');
            window.location.href = './recipeView.php?id={$recipeID}';
          </script>";
}
?>

</body>
</html>
