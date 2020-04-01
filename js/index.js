let script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


const btn = document.querySelector('.btn');
const landingHeader = document.querySelector('#landingHeader');


function viewAllMovies() {
    $.ajax({
        url: 'http://localhost/videoteka/movies',
        contentType: 'json',
        method: 'GET',
        success: function(data) {
            window.localStorage.setItem('movies', JSON.stringify(data));
            window.location.href = 'http://localhost/videoteka/main.php';
        }
    })
}

setTimeout(function() {
    landingHeader.style.display = "block";
}, 2500);


btn.addEventListener('click', viewAllMovies)