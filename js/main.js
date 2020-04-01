let script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


const signout = document.querySelector('.signout');

let token = window.localStorage.getItem('token');
let userId = window.localStorage.getItem('userId');


$(document).on('click', '.watch', ()=> {
    //css
    // this.style.display = 'none';
    // removeButtons.forEach(btn => {
    //     if (btn.dataset.id === this.dataset.id) {
    //         btn.style.display = 'block';
    //     }
    // });


    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');

    console.log(token)

    let data = {
        movieId: movieId,
        userId: userId
    }

    $.ajax({
        url: "http://localhost/videoteka/watchlist",
        method: 'POST',
        contentType: "application/json; charset=utf-8",
        beforeSend: (xhr) =>{
            xhr.setRequestHeader(`Authorization: Bearer ${token}`);
        },
        data: JSON.stringify(data),
        dataType: "application/json",
        success: (serverResponse) =>{
            console.log("Odgovor servera");
            console.log(serverResponse);
            if (serverResponse['success']) {
                alert("Uspesno dodat film!");
            } else {
                alert("Neuspesno dodat film!");
            }
        },

    });
})




$(document).on('click', 'remove', () => {
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
        url: `http://localhost/videoteka/watchlist/${data.userId}/${data.movieId}`,
        type: 'DELETE',
        beforeSend: (xhr) =>{
            xhr.setRequestHeader(`Authorization: Bearer ${token}`);
        },
        success: (serverResponse)=> {
            console.log("Odgovor servera");
            console.log(serverResponse);
            if (serverResponse['success']) {
                alert("Uspesno obrisan film!");
            } else {
                alert("Neuspesno obrisan film!");
            }
        },
    })
})



$(document).on('click', '.moreInfo', ()=> {

    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');

    $.ajax({
        url: `http://localhost/videoteka/movies/${movieId}`,
        method: 'GET',
        success: (data) =>{
            window.localStorage.setItem('country', data.Country);
            window.localStorage.setItem('director', data.Director);
            window.localStorage.setItem('Genre', data.Genre);
            window.localStorage.setItem('posterUrl', data.PosterUrl);
            window.localStorage.setItem('imdbRating', data.ImdbRating);
            window.localStorage.setItem('leadingActor', data.LeadingActor);
            window.localStorage.setItem('title', data.Title);
            window.localStorage.setItem('summary', data.Summary);
            window.localStorage.setItem('releaseYear', data.ReleaseYear);
            window.localStorage.setItem('imageUrl_1', data.ImageUrl_1);
            window.localStorage.setItem('imageUrl_2', data.ImageUrl_2);
            window.localStorage.setItem('imageUrl_3', data.ImageUrl_3);
            window.localStorage.setItem('imageUrl_4', data.ImageUrl_4);
            window.localStorage.setItem('imageUrl_5', data.ImageUrl_5);

            window.location.href = "http://localhost/videoteka/singleMovie.php";
        }
    })
})



 function displayWatchlist() {

    $.ajax({
        url: `http://localhost/videoteka/watchlist/${userId}`,
        contentType: "application/json; charset=utf-8",
        method: 'GET',
        success: (data)=> {
            window.localStorage.setItem('watchlist', JSON.stringify(data));
            window.location.href = "http://localhost/videoteka/watchlist.php"
        }
    })
}
