
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styling.css">

    <link rel="stylesheet" href="style.css">

<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/5.3.0/css/bootstrap.min.css">


</head>
<body>

    <? include 'include/header.php' ?>

    <main>
    <section class="add-recipe ">
     

        
        <h1 class="text-center mb-5">Share Your Delicious African Recipes Here</h1>
        <div class="text-center desc">
            <p>Feel free to press the button below to add your recipe, or any other African cuisine recipe that ypu know of. We will try to add it to our list as soon as possible. <span><b>asante na furaha!!!</b></span></p>

            <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
    Share A Recipe
  </button>
  
  <!-- Modal -->
  <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="staticBackdropLabel">Modal title</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
           <form method="post" action="addRecipe.handle.php" enctype="multipart/form-data">
                <!-- Dish Name -->
                <div class="form-field">
                  <label for="dish-name">Dish Name:</label>
                  <input type="text" id="dish-name" name="dish-name" required>
                </div>


        <!-- Cuisine Origin -->
        <div class="form-field">
         <label for="cuisine-origin">Cuisine Origin:</label>
                <select name="cuisine-origin" id="cuisine-origin" required>
                  <option value="" selected disabled>Choose an option</option>
                  <option value="South Africa">South Africa</option>
                  <option value="Nigeria">Nigeria</option>
                  <option value="Ghana">Ghana</option>
                  <option value="Egypt">Egypt</option>
                </select>
            </div>    
                <!-- Type of dish -->
            <div class="form-field">
              <label for="dish-type">Type of Dish:</label>
                     <select name="dish-type" id="dish-type" required>
                       <option value="" selected disabled>Choose an option</option>
                       <option value="Breakfast">Breakfast</option>
                       <option value="Lunch">Lunch</option>
                       <option value="Dinner">Dinner</option>
                       <option value="Dessert">Dessert</option>
                       <option value="Snacks">Snacks</option>

                     </select>
                 </div> 
                
        
                <!-- Picture -->
                <div class="form-field">
                  <label for="picture">Main Picture:</label>
                  <input type="file" id="picture" name="picture" accept="image/*" required>
                  <span id="file-name" style= "color: black; text-align: left"></span>
                </div>
        
                <!-- Other Pictures -->
                <div class="form-field">
                  <label for="other-pictures">Other Pictures:</label>
                  <input type="file" id="other-pictures" name="other-pictures[]" accept="image/*" multiple required>
                  <span id="file-names" style= "color: black; text-align: left"></span>
                </div>
        
                <!-- Prep Time -->
                <div class="form-field">
                  <label for="prep-time">Preparation Time:</label>
                  <input type="text" id="prep-time" name="prep-time" placeholder="e.g., 30 minutes" required>
                </div>
        
                <!-- Short Description -->
                <div class="form-field">
                  <label for="description">Short Description:</label>
                  <textarea id="description" name="description" rows="3" placeholder="Briefly describe the dish" required></textarea>
                </div>
        
                <div class="form-field">
                  <label for="ingredients">Ingredients:</label>
                  <textarea id="instructions" name="ingredients" rows="5" placeholder="Provide a list of ingredients" required></textarea>
                </div>
                <!-- Instructions -->
                <div class="form-field">
                  <label for="instructions">Instructions:</label>
                  <textarea id="instructions" name="instructions" rows="5" placeholder="Provide step-by-step instructions" required></textarea>
                </div>
        
                <!-- Submit Button -->
                <button type="submit" class="submit-button" value="Submit" name="add-recipe">Submit</button>
              </form>
        </div>
        <div class="modal-footer">
           
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Understood</button>
        </div>
      </div>
    </div>
  </div>

   

        
</div>
    </section>
    <section class="container">
        <div class="container my-5">
            <h1 class="text-center mb-5">Delicious Recipes</h1>
            <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
       

                <?php
// Database connection
$conn = mysqli_connect('db', 'my_user', 'my_password', 'africuisine_db');

if (!$conn) {
    die('Connection failed: ' . mysqli_connect_error());
}

// Fetch all dishes
$sql = "SELECT dish_id, DishName, CuisineOrigin, DishPicture, Description, PrepTime FROM dishes";
$result = $conn->query($sql);

// Check if any results are returned
if ($result->num_rows > 0) {
    // Loop through each dish and display as a card
    while ($row = $result->fetch_assoc()) {
        // Assign variables from database row
        $dishId = $row['dish_id'];
        $dishName = $row['DishName'];
        $cuisineOrigin = $row['CuisineOrigin'];
        $dishPicture = $row['DishPicture']; // Assuming the image path is stored
        $description = substr($row['Description'], 0, 100); // Limit description length
        $totalTime = $row['PrepTime'];

         // Convert BLOB data to base64 encoding for the image
         $imageData = base64_encode($dishPicture);
         $imageSrc = 'data:image/jpeg;base64,' . $imageData;

        // Display the card for each recipe
        echo "
        <div class='col'>
        <a href='recipeView.php?id={$dishId}'>
            <div class='card h-100 shadow'>
                <img src='{$imageSrc}' class='card-img-top' alt='{$dishName}'>
                <span class='recipe-category'>{$cuisineOrigin}</span>
                <div class='card-body'>
                    <h5 class='card-title'>{$dishName}</h5>
                    <p class='card-text'>{$description}</p>
                    <p class='recipe-time'><i class='bi bi-clock'></i> {$totalTime}</p>
                </div>
                <div class='card-footer bg-transparent border-top-0'>
                    <a href='#' class='btn btn-primary'>View Recipe</a>
                </div>
            </div>
        </div>
        </a>";
       
    }
} else {
    echo "No recipes found!";
}

// Close the connection
$conn->close();
?>

            </div>
        </div>
    </section>
    </main>

    <footer>
      <? include 'include/footer.php' ?>
    </footer>

    <script>
       // Get the file input element
       document.getElementById('picture').addEventListener('change', function() {
    var fileName = this.value.split('\\').pop();
    document.getElementById('file-name').innerHTML = fileName;
  });


  // Get the file input element for multiple files
  document.getElementById('other-pictures').addEventListener('change', function() {
    var fileNames = [];
    for (var i = 0; i < this.files.length; i++) {
      fileNames.push(this.files[i].name);
    }
    document.getElementById('file-names').innerHTML = fileNames.join(', ');
  });
    </script>

</body>
</html>