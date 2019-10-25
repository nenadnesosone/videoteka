<?php

require_once 'config/config.php';
require_once 'data/moviedata.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Movie Title</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Kelly+Slab&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Forum&display=swap" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="http://localhost/videoteka/css/singleMovie.css">
    <script src="http://localhost/videoteka/js/singleMovie.js" type="text/javascript"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous">


</head>

<body>

    <?php
    require 'php\partials\mainheader.php';

    ?>


    <div class="container m-auto">

        <div class="row">

            <div class="col-lg-5">
                <img id="posterUrl" src="" class="img-fluid rounded" alt="" width="350px" height="550px">
            </div>
            <div class="col-lg-6">

                <h1 id="title"></h1>
                <h5 id="directorsH">Directed by: <span id="director"></span></h5>


                <div class="bottomAlign">
                    <p class="lead" id="summary"></p>

                    <h5>Stars: <span id="leadingActor"></span></h5>

                    <h5>Released: <span id="releaseYear"></span><span id="country"></span></h5>

                    <h5>Genre: <span id="genre"></span></h5>

                    <h5 id="lastH">IMDB rating: <span id="imdbRating"></span></h5>

                    <button class="stick1 btn btn-block hover-shadow mb-0" onclick="currentSlide(1)" id="open">Movie Cuts - View Gallery</button>

                    <button class="stick btn btn-block hover-shadow" onclick="showLink()" id="shareOff">Share</button>

                    <button class="stick btn btn-block hover-shadow" id="shareOn" style="display:none" onmouseout="hideLink()">
                        <!-- link iz baze -->
                        <input type="text" value="http://tiny.cc/uk52dz" readonly spellcheck="false"></button>
                </div>
            </div>
        </div>
    </div>


    <!-- galerija -->

    <div id="modal" class="modal m-auto">
        <span class="close cursor" id="close">&times;</span>
        <div class="modal-content">
            <!-- slike ce biti iz baze -->
            <div class="slides">
                <div class="numbertext">1 / 5</div>
                <img src="" id="imgG1" style="width:100%" class="rounded">
            </div>

            <div class="slides">
                <div class="numbertext">2 / 5</div>
                <img src="" id="imgG2" style="width:100%" class="rounded">
            </div>

            <div class="slides">
                <div class="numbertext">3 / 5</div>
                <img src="" id="imgG3" style="width:100%" class="rounded">
            </div>

            <div class="slides">
                <div class="numbertext">4 / 5</div>
                <img src="" id="imgG4" style="width:100%" class="rounded">
            </div>

            <div class="slides">
                <div class="numbertext">5 / 5</div>
                <img src="" id="imgG5" style="width:100%" class="rounded">
            </div>

            <a class="prev" onclick="plusSlides(-1)">&#10094;</a>
            <a class="next" onclick="plusSlides(1)">&#10095;</a>

            <!-- Ime filma iz baze -->
            <div class="caption-container">
                <p id="titleGallery"></p>
            </div>

            <div class="column">
                <img class="demo" id="img1" src="" onclick="currentSlide(1)" alt="blabla">
            </div>

            <div class="column">
                <img class="demo" id="img2" src="" onclick="currentSlide(2)" alt="img2">
            </div>

            <div class="column">
                <img class="demo" id="img3" src="" onclick="currentSlide(3)" alt="img3">
            </div>

            <div class="column">
                <img class="demo" id="img4" src="" onclick="currentSlide(4)" alt="img4">
            </div>

            <div class="column">
                <img class="demo" id="img5" src="" onclick="currentSlide(5)" alt="img5">
            </div>
        </div>
    </div>
    </div>


    <script>
        // jquery
        $("#open").click(() => {
            $("#modal").fadeIn('slow');
        });
        $("#close").click(() => {
            $("#modal").fadeOut('slow');
        });


        // dohvatanje podataka

        let country = window.localStorage.getItem('country');
        let director = window.localStorage.getItem('director');
        let genre = window.localStorage.getItem('Genre');
        let posterUrl = window.localStorage.getItem('posterUrl');
        let imdbRating = window.localStorage.getItem('imdbRating');
        let leadingActor = window.localStorage.getItem('leadingActor');
        let title = window.localStorage.getItem('title');
        let summary = window.localStorage.getItem('summary');
        let releaseYear = window.localStorage.getItem('releaseYear');
        let imageUrl_1 = window.localStorage.getItem('imageUrl_1');
        let imageUrl_2 = window.localStorage.getItem('imageUrl_2');
        let imageUrl_3 = window.localStorage.getItem('imageUrl_3');
        let imageUrl_4 = window.localStorage.getItem('imageUrl_4');
        let imageUrl_5 = window.localStorage.getItem('imageUrl_5');

        // smestanje podataka u html

        document.querySelector('#country').textContent = " (" + country + ")";
        document.querySelector('#director').textContent = director;
        document.querySelector('#genre').textContent = genre;
        document.querySelector('#imdbRating').textContent = imdbRating;
        document.querySelector('#leadingActor').textContent = leadingActor
        document.querySelector('#title').textContent = title;
        document.querySelector('#titleGallery').textContent = title;
        document.querySelector('#summary').textContent = summary;
        document.querySelector('#releaseYear').textContent = releaseYear;
        document.querySelector('#posterUrl')['src'] = posterUrl;
        document.querySelector('#img1')['src'] = imageUrl_1;
        document.querySelector('#img2')['src'] = imageUrl_2;
        document.querySelector('#img3')['src'] = imageUrl_3;
        document.querySelector('#img4')['src'] = imageUrl_4;
        document.querySelector('#img5')['src'] = imageUrl_5;
        document.querySelector('#imgG1')['src'] = imageUrl_1;
        document.querySelector('#imgG2')['src'] = imageUrl_2;
        document.querySelector('#imgG3')['src'] = imageUrl_3;
        document.querySelector('#imgG4')['src'] = imageUrl_4;
        document.querySelector('#imgG5')['src'] = imageUrl_5;
    </script>



    <?php
    require 'php\partials\footer.php';

    ?>

    <script type="text/javascript">
        let showChar = 140;
        let ellipsestext = "...";
        let moretext = "Show more";
        let lesstext = "Show less";
        $('.lead').each(function() {
            let content = $(this).html();

            if (content.length > showChar) {

                let c = content.substr(0, showChar);
                let h = content.substr(showChar - 1, content.length - showChar);

                let html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>'+ h +'</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

                $(this).html(html);
            }

        });

        $(".morelink").click(function() {
            if ($(this).hasClass("less")) {
                $(this).removeClass("less");
                $(this).html(moretext);
            } else {
                $(this).addClass("less");
                $(this).html(lesstext);
            }
            $(this).parent().prev().toggle();
            $(this).prev().toggle();
            return false;
        });
    </script>

</body>