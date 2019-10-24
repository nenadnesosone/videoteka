var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


const addButtons = document.querySelectorAll('.watch');
const removeButtons = document.querySelectorAll('.remove');
const moreInfo = document.querySelectorAll('.moreInfo');


function addToWatchlist() {
    //css
    this.style.display = 'none';
    removeButtons.forEach(btn => {
        if (btn.dataset.id === this.dataset.id) {
            btn.style.display = 'block';
        }
    });

    //zahtev

    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');
    let token = window.localStorage.getItem('token');
    let userId = window.localStorage.getItem('userId');

    let data = {
        'movieId': movieId,
        'userId': userId
    }

    $.ajax({
        url: "http://localhost/videoteka/watchlist",
        method: 'POST',
        contentType: "application/json; charset=utf-8",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        data: JSON.stringify(data),
        dataType: "json",
        success: function(serverResponse) {
            console.log("Odgovor servera");
            console.log(serverResponse);
            if (serverResponse['success']) {
                alert("Uspesno dodat film!");
            } else {
                alert("Neuspesno dodat film!");
            }
        },

    })

}

function removeFromWatchlist() {
    // css
    this.style.display = 'none';
    addButtons.forEach(btn => {
        if (btn.dataset.id === this.dataset.id) {
            btn.style.display = 'block';
        }
    });

    // zahtev
    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');
    let token = window.localStorage.getItem('token');
    let userId = window.localStorage.getItem('userId');

    let data = {
        'movieId': movieId,
        'userId': userId
    }

    $.ajax({
        url: "http://localhost/videoteka/watchlist",
        type: 'DELETE',
        contentType: "application/json; charset=utf-8",
        beforeSend: function(xhr) {
            xhr.setRequestHeader("Authorization", "Bearer " + token);
        },
        data: JSON.stringify(data),
        dataType: "json",
        success: function(serverResponse) {
            console.log("Odgovor servera");
            console.log(serverResponse);
            if (serverResponse['success']) {
                alert("Uspesno dodat film!");
            } else {
                alert("Neuspesno dodat film!");
            }
        },


    })


}

function displayMovie() {

    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');

    $.ajax({
        url: 'http://localhost/videoteka/movies/' + movieId,
        contentType: 'json',
        method: 'GET',
        success: function(resp) {
            // ovde se hvataju podaci i smestaju u LS
            window.localStorage.setItem('country', resp.Country);
            window.localStorage.setItem('director', resp.Director);
            window.localStorage.setItem('Genre', resp.Genre);
            window.localStorage.setItem('imageUrl', resp.ImageUrl);
            window.localStorage.setItem('imdbRating', resp.ImdbRating);
            window.localStorage.setItem('leadingActor', resp.LeadingActor);
            window.localStorage.setItem('title', resp.Title);
            window.localStorage.setItem('summary', resp.Summary);
            window.localStorage.setItem('releaseYear', resp.ReleaseYear);
            console.log(resp);

            window.location.href = "http://localhost/videoteka/singleMovie.php";
        }
    })
}

addButtons.forEach(btn => btn.addEventListener('click', addToWatchlist));
removeButtons.forEach(btn => btn.addEventListener('click', removeFromWatchlist));
moreInfo.forEach(btn => btn.addEventListener('click', displayMovie));