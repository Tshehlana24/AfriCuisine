<?php
// Start session
session_start();

// Database connection
$conn = mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');

// Check if the recipe ID is set in the URL
if (isset($_GET['id'])) {
    $recipeId = $_GET['id'];
}
    // Database connection
    $conn = mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');

    if (!$conn) {
        die('Connection failed: ' . mysqli_connect_error());
    }

    // Fetch the recipe details based on the ID
    $sql = "SELECT DishName, CuisineOrigin, DishPicture, Description, PrepTime, Ingredients, Instructions FROM dishes WHERE dish_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $recipeId);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Fetch recipe details
        $row = $result->fetch_assoc();
        $dishName = $row['DishName'];
        $cuisineOrigin = $row['CuisineOrigin'];
        $dishPicture = $row['DishPicture'];
        $description = $row['Description'];
        $prepTime = $row['PrepTime'];
        $ingredients = $row['Ingredients'];
        $instructions = $row['Instructions'];

        // Convert BLOB data to base64 encoding for the image
        $imageData = base64_encode($dishPicture);
        $imageSrc = 'data:image/jpeg;base64,' . $imageData;

    } else {
        echo "Recipe not found.";
    }


 
$ratingprompt = "SELECT  users.Name, users.Surname, ratings.rating, ratings.comment, ratings.date_created
 FROM users
 Join ratings on ratings.user_id = users.user_id 
 WHERE ratings.recipe_id = ?";


$stmt = $conn->prepare($ratingprompt);
$stmt->bind_param("s", $recipeId);
$stmt->execute();
$ratings = $stmt->get_result();







?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="styling.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="view.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.2.0/remixicon.css" referrerpolicy="no-referrer" />
    
    <title><?php echo $dishName; ?></title>
</head>
<body>
    <div class="container-view">
            <header>
        <? include 'include/header.php' ?>
    </header>

<?php

echo "


   <h1 class='display-4'>{$dishName}</h1>
   <div class='recipe'>
   
    <div class='container'>
        <div class='mainPicture'>
        
        <img class= 'imageDisplay' src='{$imageSrc}' alt='{$dishName}' class='img-fluid rounded mb-3'>
        </div>

        <div class='otherpictures'>

        </div>
    </div>
    <div class='recipeMeta'>
    <div class='TimeandOrigin'>


    <div class='time'>
        <i class='ri-time-fill'></i>
        <p><strong>Prep Time:</strong> {$prepTime}</p>
    </div>

    <div class='origin'>
        <i class='ri-map-pin-fill'></i>
        <p><strong>Origin:</strong> {$cuisineOrigin}</p>
    
    </div>


</div>
        <div class='username'>
            <i class='ri-user-fill'></i>
            <p><strong>Username:</strong> {$dishName}</p>
        </div>

        <div class='rating'>
            <i class='ri-star-fill'></i>
            <p><strong>Rating:</strong> 4.5</p>
        </div>
        

    <div class='ingridients'>
        <h3>Ingredients</h3>
        <p>{$ingredients}</p>
        <p>{$ingredients}</p>
        <p>{$ingredients}</p>
        <p>{$ingredients}</p>
    </div>

    <div class='instructions'>
        <h3>Instructions</h3>
        <p>{$instructions}</p>
        <p>{$instructions}</p>
        <p>{$instructions}</p>
        <p>{$instructions}</p>

        

  </div> 
";


$stmt->close(); ?>
  <button class="btn btn-warning" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasBottom" aria-controls="offcanvasBottom">Leave a Comment</button>

<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom" aria-labelledby="offcanvasBottomLabel">
  <div class="offcanvas-header">
    <h5 class="offcanvas-title" id="offcanvasBottomLabel">Comment Section</h5>
    <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
  </div>
  <div class="offcanvas-body small">

  <form action="ratingLogic.php" method="post" class="rating-form">
    <div class="ratingsend">
        <div class="rate">
            <label for="rate" class="rate-label">Rate This Recipe</label>
            <select name="rating" id="rate" class="rate-select">
                <option value="" selected disabled>Choose a rating</option>
                <option value="1">1 - Bad</option>
                <option value="2">2 - Meh</option>
                <option value="3">3 - Good</option>
                <option value="4">4 - Tasty</option>
                <option value="5">5 - Awesome</option>
            </select>
        </div>

        <!-- Hidden Recipe ID -->
        <input type="hidden" name="recipeID" value="<?php echo $recipeId; ?>">

        <textarea id="comment" name="comment" placeholder="Leave a comment..." rows="4" class="comment-box"></textarea>

        <input type="submit" value="Submit Rating" name="Rate" class="submit-rate">
    </div>
</form>


<hr>

<div class="name"><?php  
                if ($ratings->num_rows > 0) {
                    while ($row2 = $ratings->fetch_assoc()) {
                        echo"<div class= 'reviewHead'><div class='reviewName'>{$row2['Name']} {$row2['Surname'] }</div><div class='reviewDate'>{$row2['date_created']}</div></div>";
                         
                         switch($row2['rating'] ){
                          case 1:  echo "<p class='star'>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span></p>";
                            break;
                         case 2:  echo "<p class='star'>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span></p>";
                            break;

                        case 3:  echo "<p class='star'>
                        <span class='fa fa-star' style='color: gold; '></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star'></span>
                            <span class='fa fa-star'></span></p> ";
                            break;

                        case 4:  echo "<p class='star'>
                        <span class='fa fa-star' style='color: gold; '></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star'></span></p> ";
                            break;

                        case 5:  echo "<p class='star'>
                        <span class='fa fa-star'  style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span>
                            <span class='fa fa-star' style='color: gold;'></span></p> ";
                            break;
                     
                        };
                         echo "<p id = 'text'>{$row2['comment'] }</p> ";
                        echo "<hr>";
                    }
                } else {
                    echo "No reviews yet.";
                }
                ?>
            </div>
  </div>
</div>




  </div>

  
 </div>



   </div>
    


    <?php include 'include/footer.php';
    $conn->close(); 
    
    ?>



    
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>