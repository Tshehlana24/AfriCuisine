<?php
session_start();
echo $_SESSION['user_id'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" href="styling.css">

</head>
<body>
    <header>
        <section class="et-hero-tabs">
            <h1>AFRI CUISINE</h1>
            <h3>Recipe Meals From All Over Africa</h3>
            <nav class="navbar navbar-expand-lg bg-body-tertiary navbar-custom">
              <div class="container-fluid">
                <a class="navbar-brand" href="#"><img src="images/fri.png" id ="logo" alt="logo"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                  <ul class="navbar-nav ms-auto">

                  <?php

                    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== '') {
                      echo  '<li class="nav-link" style="color: white;">Hi, '.$_SESSION['name'].'!</li>';
                    }
                  ?>
                    <li class="nav-item">

                      <a class="nav-link " aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="recipe.php">Recipes</a>
                    </li>
                    <li class="nav-item dropdown">
                      <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" aria-expanded="false">Cuisines</a>
                      <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">South African</a></li>
                        <li><a class="dropdown-item" href="#">Nigerian</a></li>
                        <li><a class="dropdown-item" href="#">Ghanian</a></li>
                        <li><a class="dropdown-item" href="#">Egyptian</a></li>
                        
                      </ul>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#">Newsletter</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link " href="#">About Us</a>
                    </li>
                    <?php 
                    if (isset($_SESSION['user_id']) && $_SESSION['user_id'] !== '') {
                      echo '<li class="nav-item"> <a class="nav-link " href="authenticate/index.php">Log Out</a></li>';
                    }else{
                     echo '<li class="nav-item"> <a class="nav-link " href="authenticate/login.html">Log In</a></li>';
                    }
                    ?>
                    
                  </ul>
                </div>
              </div>
            </nav>
            
          </section>
        
        </header>
          <!-- Main -->
          <main class="et-main">
            <section class="et-slide" id="tab-es6">
              <h1>WHat To Cook Today</h1>
    
            </section>

            <section id="carousel" class="p-3 m-auto border-0 bd-example m-auto border-0">
          
              <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel" data-bs-interval="3000">
                <div class="carousel-indicators">
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                  <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                </div>
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/carousel/meat.jpg" class="d-block w-100" alt="First slide">
                    <div class="carousel-overlay">
                      <div class="carousel-caption d-md-block">
                        <h5>For All The Meatetarians Out There</h5>
                        <p>Delve into recipes for all the meat lovers.</p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="images/carousel/vegetarian.jpg" class="d-block w-100" alt="Second slide">
                    <div class="carousel-overlay">
                      <div class="carousel-caption  d-md-block">
                        <h5>Vegetarian Peoples</h5>
                        <p>Have a gaze at some of the best African Vegetarian-based recipes</p>
                      </div>
                    </div>
                  </div>
                  <div class="carousel-item">
                    <img src="images/carousel/vegan.jpg" class="d-block w-100" alt="Third slide">
                    <div class="carousel-overlay">
                      <div class="carousel-caption  d-md-block">
                        <h5>The Vegans</h5>
                        <p>Into Veganism? We've got you covered as well</p>
                      </div>
                    </div>
                  </div>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                  <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Previous</span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                  <span class="carousel-control-next-icon" aria-hidden="true"></span>
                  <span class="visually-hidden">Next</span>
                </button>
              </div>
              
          
            </section>
            <section style="background-color: #eee;">
              <div class="container py-5">
                <div class="row">
                  <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="card">
                      <div class="d-flex justify-content-between p-3">
                        <p class="lead mb-0">Today's Combo Offer</p>
                        <div
                          class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                          style="width: 35px; height: 35px;">
                          <p class="text-white mb-0 small">x4</p>
                        </div>
                      </div>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/4.webp"
                        class="card-img-top" alt="Laptop" />
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                          <p class="small text-danger"><s>$1099</s></p>
                        </div>
            
                        <div class="d-flex justify-content-between mb-3">
                          <h5 class="mb-0">HP Notebook</h5>
                          <h5 class="text-dark mb-0">$999</h5>
                        </div>
            
                        <div class="d-flex justify-content-between mb-2">
                          <p class="text-muted mb-0">Available: <span class="fw-bold">6</span></p>
                          <div class="ms-auto text-warning">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                    <div class="card">
                      <div class="d-flex justify-content-between p-3">
                        <p class="lead mb-0">Today's Combo Offer</p>
                        <div
                          class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                          style="width: 35px; height: 35px;">
                          <p class="text-white mb-0 small">x2</p>
                        </div>
                      </div>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/7.webp"
                        class="card-img-top" alt="Laptop" />
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                          <p class="small text-danger"><s>$1199</s></p>
                        </div>
            
                        <div class="d-flex justify-content-between mb-3">
                          <h5 class="mb-0">HP Envy</h5>
                          <h5 class="text-dark mb-0">$1099</h5>
                        </div>
            
                        <div class="d-flex justify-content-between mb-2">
                          <p class="text-muted mb-0">Available: <span class="fw-bold">7</span></p>
                          <div class="ms-auto text-warning">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="far fa-star"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-6 col-lg-4 mb-4 mb-md-0">
                    <div class="card">
                      <div class="d-flex justify-content-between p-3">
                        <p class="lead mb-0">Today's Combo Offer</p>
                        <div
                          class="bg-info rounded-circle d-flex align-items-center justify-content-center shadow-1-strong"
                          style="width: 35px; height: 35px;">
                          <p class="text-white mb-0 small">x3</p>
                        </div>
                      </div>
                      <img src="https://mdbcdn.b-cdn.net/img/Photos/Horizontal/E-commerce/Products/5.webp"
                        class="card-img-top" alt="Gaming Laptop" />
                      <div class="card-body">
                        <div class="d-flex justify-content-between">
                          <p class="small"><a href="#!" class="text-muted">Laptops</a></p>
                          <p class="small text-danger"><s>$1399</s></p>
                        </div>
            
                        <div class="d-flex justify-content-between mb-3">
                          <h5 class="mb-0">Toshiba B77</h5>
                          <h5 class="text-dark mb-0">$1299</h5>
                        </div>
            
                        <div class="d-flex justify-content-between mb-2">
                          <p class="text-muted mb-0">Available: <span class="fw-bold">5</span></p>
                          <div class="ms-auto text-warning">
                            <i class="fa fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star-half-alt"></i>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </section>

          
           
       <?php include 'include/footer.php' ?>

      

        <script src="app.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

</body>
</html>

