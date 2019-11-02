let script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


const addButtons = document.querySelectorAll('.watch');
const removeButtons = document.querySelectorAll('.remove');
const moreInfo = document.querySelectorAll('.moreInfo');
const signout = document.querySelector('.signout');


let token = window.localStorage.getItem('token');
let userId = window.localStorage.getItem('userId');


function addToWatchlist() {
    //css
    // this.style.display = 'none';
    // removeButtons.forEach(btn => {
    //     if (btn.dataset.id === this.dataset.id) {
    //         btn.style.display = 'block';
    //     }
    // });

    //dodavanje filma u watchlistu

    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');


    let data = {
        movieId: movieId,
        userId: userId
    }

    $.ajax({
        url: "http://localhost/videoteka/watchlist",
        method: 'POST',
        contentType: "application/json; charset=utf-8",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        data: JSON.stringify(data),
        dataType: "application/json",
        success: function(serverResponse) {
            console.log("Odgovor servera");
            console.log(serverResponse);
            if (serverResponse['success']) {
                alert("Uspesno dodat film!");
            } else {
                alert("Neuspesno dodat film!");
            }
        },

    });

}



function removeFromWatchlist() {
    // css
    // this.style.display = 'none';
    // addButtons.forEach(btn => {
    //     if (btn.dataset.id === this.dataset.id) {
    //         btn.style.display = 'block';
    //     }
    // });

    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');

    let data = {
        movieId: movieId,
        userId: userId
    }

    $.ajax({
        url: "http://localhost/videoteka/watchlist/" + data['userId'] + '/' + data['movieId'],
        type: 'DELETE',
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        success: function(serverResponse) {
            console.log("Odgovor servera");
            console.log(serverResponse);
            if (serverResponse['success']) {
                alert("Uspesno obrisan film!");
            } else {
                alert("Neuspesno obrisan film!");
            }
        },
    })
}




function displayMovie() {

    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');

    $.ajax({
        url: 'http://localhost/videoteka/movies/' + movieId,
        method: 'GET',
        success: function(resp) {
            // ovde se hvataju podaci i smestaju u LS
            window.localStorage.setItem('country', resp.Country);
            window.localStorage.setItem('director', resp.Director);
            window.localStorage.setItem('Genre', resp.Genre);
            window.localStorage.setItem('posterUrl', resp.PosterUrl);
            window.localStorage.setItem('imdbRating', resp.ImdbRating);
            window.localStorage.setItem('leadingActor', resp.LeadingActor);
            window.localStorage.setItem('title', resp.Title);
            window.localStorage.setItem('summary', resp.Summary);
            window.localStorage.setItem('releaseYear', resp.ReleaseYear);
            window.localStorage.setItem('imageUrl_1', resp.ImageUrl_1);
            window.localStorage.setItem('imageUrl_2', resp.ImageUrl_2);
            window.localStorage.setItem('imageUrl_3', resp.ImageUrl_3);
            window.localStorage.setItem('imageUrl_4', resp.ImageUrl_4);
            window.localStorage.setItem('imageUrl_5', resp.ImageUrl_5);

            window.location.href = "http://localhost/videoteka/singleMovie.php";
        }
    })
}



function displayWatchlist() {
    let userId = window.localStorage.getItem('userId');
    console.log(userId)

    $.ajax({
        url: 'http://localhost/videoteka/watchlist/' + userId,
        contentType: "application/json; charset=utf-8",
        method: 'GET',
        success: function(resp) {
            console.log(resp);
            window.localStorage.setItem('watchlist', JSON.stringify(resp));
            window.location.href = "http://localhost/videoteka/watchlist.php"
        }
    })
}



addButtons.forEach(btn => btn.addEventListener('click', addToWatchlist));
removeButtons.forEach(btn => btn.addEventListener('click', removeFromWatchlist));
moreInfo.forEach(btn => btn.addEventListener('click', displayMovie));