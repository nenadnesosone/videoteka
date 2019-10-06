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

</head>


<style>
    .mySlides img {
        height: 400px;
    }

    .demo {
        height: 100px;
        width: 130px;
    }

    /* Create four equal columns that floats next to eachother */
    .column {
        float: left;
        width: 20%;
    }

    /* The Modal (background) */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        padding-top: 20px;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.9);
    }

    /* Modal Content */
    .modal-content {
        position: relative;
        background-color: rgba(0, 0, 0, 0.9);
        margin: auto;
        padding: 0;
        width: 700px;
        display: block;
    }

    /* The Close Button */
    .close {
        color: #999;
        position: absolute;
        top: 0;
        right: 20;
        font-size: 55px;
        font-weight: bold;
    }

    .close:hover,
    .close:focus {
        color: #999;
        text-decoration: none;
        cursor: pointer;
    }

    /* Hide the slides by default */
    .mySlides {
        display: none;
    }

    /* Next & previous buttons */
    .prev,
    .next {
        cursor: pointer;
        position: absolute;
        top: 50%;
        width: auto;
        padding: 16px;
        margin-top: -50px;
        color: white;
        font-weight: bold;
        font-size: 20px;
        transition: 0.6s ease;
        border-radius: 0 3px 3px 0;
        user-select: none;
        -webkit-user-select: none;
    }

    /* Position the "next button" to the right */
    .next {
        right: 0;
        border-radius: 3px 0 0 3px;
    }

    /* On hover, add a black background color with a little bit see-through */
    .prev:hover,
    .next:hover {
        background-color: #14181C;
    }

    /* Number text (1/3 etc) */
    .numbertext {
        color: #999;
        font-size: 12px;
        padding: 8px 12px;
        position: absolute;
        top: 0;
    }

    /* Caption text */
    .caption-container {
        text-align: center;
        padding: 2px 16px;
        color: #999;
    }

    img.demo {
        opacity: 0.6;
    }

    .active,
    .demo:hover {
        opacity: 1;
    }

    img.hover-shadow {
        transition: 0.3s;
    }

    .hover-shadow:hover {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
    }
</style>

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
                <button class="btn hover-shadow" onclick="openModal();currentSlide(1)">Show gallery</button>
            </div>
        </div>


        <!-- The Modal/Lightbox -->
        <div id="myModal" class="modal m-auto">
            <span class="close cursor" onclick="closeModal()">&times;</span>
            <div class="modal-content">

                <div class="mySlides">
                    <div class="numbertext">1 / 5</div>
                    <img src="images/demo1.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">2 / 5</div>
                    <img src="images/demo2.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">3 / 5</div>
                    <img src="images/demo3.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">4 / 5</div>
                    <img src="images/demo4.jpg" style="width:100%">
                </div>

                <div class="mySlides">
                    <div class="numbertext">5 / 5</div>
                    <img src="images/demo5.jpg" style="width:100%">
                </div>

                <!-- Next/previous controls -->
                <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
                <a class="next" onclick="plusSlides(1)">&#10095;</a>

                <!-- Caption text -->
                <div class="caption-container">
                    <p id="caption">Once Upon A Time In Hollywood</p>
                </div>

                <!-- Thumbnail image controls -->
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




    <script>
        // Open the Modal
        function openModal() {
            document.getElementById("myModal").style.display = "block";
        }

        // Close the Modal
        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

                    var slideIndex = 1;
                    showSlides(slideIndex);

                    // Next/previous controls
                    function plusSlides(n) {
                        showSlides(slideIndex += n);
                    }

                    // Thumbnail image controls
                    function currentSlide(n) {
                        showSlides(slideIndex = n);
                    }

                    function showSlides(n) {
                        var i;
                        var slides = document.getElementsByClassName("mySlides");
                        var dots = document.getElementsByClassName("demo");
                        var captionText = document.getElementById("caption");
                        if (n > slides.length) {
                            slideIndex = 1
                        }
                        if (n < 1) {
                            slideIndex = slides.length
                        }
                        for (i = 0; i < slides.length; i++) {
                            slides[i].style.display = "none";
                        }
                        for (i = 0; i < dots.length; i++) {
                            dots[i].className = dots[i].className.replace(" active", "");
                        }
                        slides[slideIndex - 1].style.display = "block";
                        dots[slideIndex - 1].className += " active";
                        captionText.innerHTML = dots[slideIndex - 1].alt;
                    }
    </script>

</body>
<?php
require 'php\partials\footer.php';

?>