<?php
require 'config/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>MovieCamp</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/main.css">

</head>

<body>
    <!-- NAV -->
    <?php
    require 'php\partials\mainheader.php';
    
    ?>

    <!-- GALERIJA -->


    <div class="container m-auto">
        <div class="row">
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="modal">
                        <div class="modal-content">
                            <button class="btn btn-small mb-2">Add To Watchlist</button>
                            <button role="button" class="btn btn-small"> <a href="singleMovie.php" class="btn-link">More Info</a></button>
                        </div>
                    </div>
                    <img src="./images/Posters/Amelie.jpg" alt="Card Image" class="card-img-top">
                    <div class="card-body">
                        <h6>Amelie</h6>
                        <p class="text-muted card-text">Glavni glumci</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="modal">
                        <div class="modal-content">
                            <button class="btn btn-small mb-2">Add To Watchlist</button>
                            <button href="singleMovie.php" role="button" class="btn btn-small">More Info</button>
                        </div>
                    </div>
                    <img src="./images/Posters/TheAbyss.jpg" alt="Card Image" class="card-img-top">
                    <div class="card-body">
                        <h6>The Abyss</h6>
                        <p class="text-muted card-text">Glavni glumci</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="modal">
                        <div class="modal-content">
                            <button class="btn btn-small mb-2">Add To Watchlist</button>
                            <button href="singleMovie.php" role="button" class="btn btn-small">More Info</button>
                        </div>
                    </div>
                    <img src="./images/Posters/YTuMamaTambien.jpg" alt="Card Image" class="card-img-top">
                    <div class="card-body">
                        <h6>Y Tu Mama Tambien</h6>
                        <p class="text-muted card-text">Glavni glumci</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="modal">
                        <div class="modal-content">
                            <button class="btn btn-small mb-2">Add To Watchlist</button>
                            <button href="singleMovie.php" role="button" class="btn btn-small">More Info</button>
                        </div>
                    </div>
                    <img src="./images/Posters/Cube.jpg" alt="Card Image" class="card-img-top">
                    <div class="card-body">
                        <h6>Cube</h6>
                        <p class="text-muted card-text">Glavni glumci</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="modal">
                        <div class="modal-content">
                            <button class="btn btn-small mb-2">Add To Watchlist</button>
                            <button href="singleMovie.php" role="button" class="btn btn-small">More Info</button>
                        </div>
                    </div>
                    <img src="./images/Posters/Dune.jpg" alt="Card Image" class="card-img-top">
                    <div class="card-body">
                        <h6>Dune</h6>
                        <p class="text-muted card-text">Glavni glumci</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-lg-3">
                <div class="card border-0">
                    <div class="modal">
                        <div class="modal-content">
                            <button class="btn btn-small mb-2">Add To Watchlist</button>
                            <button href="singleMovie.php" role="button" class="btn btn-small">More Info</button>
                        </div>
                    </div>
                    <img src="./images/Posters/RunLolaRun.jpg" alt="Card Image" class="card-img-top">
                    <div class="card-body">
                        <h6>Run Lola Run</h6>
                        <p class="text-muted card-text">Glavni glumci</p>
                    </div>
                </div>
            </div>
        </div>
    </div>



</body>