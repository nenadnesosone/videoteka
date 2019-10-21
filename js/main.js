var script = document.createElement('script');
script.src = 'https://code.jquery.com/jquery-3.4.1.min.js';
script.type = 'text/javascript';
document.getElementsByTagName('head')[0].appendChild(script);


const watchButtons = document.querySelectorAll('.watch');
const moreInfo = document.querySelectorAll('.moreInfo');


function addToWatchlist(){
    this.classList.toggle('added');
    if(this.classList.contains('added')){
        this.textContent = 'Remove From Watchlist';
    }else{
        this.textContent = 'Add To Watchlist';
    }
}

function displayMovie(){
    window.localStorage.setItem('movieId', this.dataset.id);
    let movieId = window.localStorage.getItem('movieId');

    $.ajax({
        // koji url treba?
    url: 'http://localhost/videoteka/movies/'+movieId,
    contentType:'json',
    method:'GET',
    success: function(resp){
        data = JSON.parse(resp);
        console.log(data);
    }
})
}

watchButtons.forEach(btn => btn.addEventListener('click', addToWatchlist));
moreInfo.forEach(btn => btn.addEventListener('click', displayMovie));







