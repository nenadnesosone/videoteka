<?php
require 'config/config.php';

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Title</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/singleMovie.css">
    <script src="js/gallery.js" type="text/javascript"></script>
    
    

</head>

<body>

    <?php
    require 'php\partials\mainheader.php';

    ?>


    <div class="container m-auto">

        <div id="mainphoto">
        </div>

        <div class="row">
            <div class="col-md-3 offset-1">
                <img src="images/pseudoposter.JPG" class="img-fluid rounded" alt="" width="250px" height="450px">
            </div>
            <div class="col-sm-7">
                <!-- ime filma iz baze -->
                <h1>Once Upon A Time In Hollywod</h1>
                <!-- svi podaci iz baze -->
                <h5><span>2019</span>, Directed by <span>Quentin Tarantino</span></h5>
                <!--opis filma iz baze  -->
                <p class="lead">A faded television actor and his stunt double strive to achieve fame and success in the
                    film industry during the final years of Hollywood's Golden Age in 1969 Los Angeles.
                </p>
                <button class="btn hover-shadow" onclick="openModal();currentSlide(1)">Movie Cuts - View Gallery</button>
            </div>
        </div>


        <div id="modal" class="modal m-auto">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">
    <!-- slike ce biti iz baze -->
                <div class="slides">
                    <div class="numbertext">1 / 5</div>
                    <img src="images/demo1.jpg" style="width:100%" class="rounded">
                </div>

                <div class="slides">
                    <div class="numbertext">2 / 5</div>
                    <img src="images/demo2.jpg" style="width:100%" class="rounded">
                </div>

                <div class="slides">
                    <div class="numbertext">3 / 5</div>
                    <img src="images/demo3.jpg" style="width:100%" class="rounded">
                </div>

                <div class="slides">
                    <div class="numbertext">4 / 5</div>
                    <img src="images/demo4.jpg" style="width:100%" class="rounded">
                </div>

                <div class="slides">
                    <div class="numbertext">5 / 5</div>
                    <img src="images/demo5.jpg" style="width:100%" class="rounded">
                </div>

                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <!-- Ime filma iz baze -->
                <div class="caption-container">
                    <p>Once Upon A Time In Hollywood</p>
                </div>

                <div class="column">
                    <img class="demo" src="images/demo1.jpg" onclick="currentSlide(1)" alt="blabla">
                </div>

                <div class="column">
                    <img class="demo" src="images/demo2.jpg" onclick="currentSlide(2)" alt="img2">
                </div>

                <div class="column">
                    <img class="demo" src="images/demo3.jpg" onclick="currentSlide(3)" alt="img3">
                </div>

                <div class="column">
                    <img class="demo" src="images/demo4.jpg" onclick="currentSlide(4)" alt="img4">
                </div>

                <div class="column">
                    <img class="demo" src="images/demo5.jpg" onclick="currentSlide(5)" alt="img5">
                </div>
            </div>
        </div>
    </div>



</body>
<?php
require 'php\partials\footer.php';

?>