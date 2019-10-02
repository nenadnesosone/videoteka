const watchButtons = document.querySelectorAll('.watch');



function addToWatchlist(){
    this.classList.toggle('added');
    if(this.classList.contains('added')){
        this.textContent = 'Remove From Watchlist';
    }else{
        this.textContent = 'Add To Watchlist';
    }
}

watchButtons.forEach(btn => btn.addEventListener('click', addToWatchlist));
