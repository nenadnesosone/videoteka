<?php
require_once 'config/config.php';
require_once 'data/watchlistdata.php';
require_once 'data/moviedata.php';
if (isset($_SESSION['username'])) {
    $userLoggedIn = $_SESSION['username'];
    $user_details_query = mysqli_query($con, "SELECT * FROM users_data WHERE username= '$userLoggedIn'");
    $user = mysqli_fetch_array($user_details_query);
} else {
    header("location: register.php");
}
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


    <?php
    require_once 'php\partials\mainheader.php';
    ?>


    <div class="container m-auto">
        <div class="row">

        </div>
    </div>


    <div class="container m-auto">
        <div class="row">

        </div>
    </div>

    <script type="text/javascript">

    
        function createCard(movieId, posterUrl, title, leadingActor) {
            let theCard =
                `<div class='col-md-6 col-xl-3'>
                <div class='card border-0'>
                    <div class='modal'>
                        <div class='modal-content'>
                            <button class='btn btn-small mb-2 watch' data-id='` + movieId + `' style='display:none'>Add To Watchlist</button>
                            <button class='btn btn-small mb-2 remove' data-id='` + movieId + `'>Remove From Watchlist</button>
                            <button role='button' class='btn btn-small moreInfo' data-id='` + movieId + `'><a href='#'>More Info</a></button>
                        </div>
                    </div>
                    <img src='` + posterUrl + `' alt='Card Image' class='card-img-top' />
                    <div class='card-body'>
                        <h6>` + title + `</h6>
                        <p class='text-muted card-text'>` + leadingActor + `</p>
                    </div>
                </div>
            </div>`;
            return theCard;
        }

        let watchlist = JSON.parse(window.localStorage.getItem('watchlist'));
        let allMovies = document.querySelector('.row');
        let imgPoster = document.querySelector('#poster');

        watchlist.forEach(movie => {
            let cardContent = createCard(movie.MovieId, movie.PosterUrl,movie.Title, movie.LeadingActor);
            allMovies.innerHTML += cardContent;
        });


    </script>
    
    <script src="js/main.js" type="text/javascript"></script>







    <?php
    require_once 'php\partials\footer.php';

    ?>