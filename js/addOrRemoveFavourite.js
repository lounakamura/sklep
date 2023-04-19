const favAmountContainer = document.querySelector(".container-favourites-amount");
const favAmount = document.querySelector(".favourites-amount");

function updateFavouritesValue() {
    let favAmountValue = document.cookie.split('; ').find((row) => row.startsWith('favourites-amount='))?.split('=')[1];

    if( favAmountValue > 0 ) {
        $(favAmountContainer).css('opacity', 1);
        favAmount.innerText = favAmountValue;
    } else {
        $(favAmountContainer).css('opacity', 0);
        favAmount.innerText = favAmountValue;
    }
}

const favouriteButtons = document.querySelectorAll(".add-to-fav");

favouriteButtons.forEach(favouriteButton => {
    favouriteButton.onclick = function() {
        const REQUEST = new XMLHttpRequest();
        REQUEST.open("POST", "/sklep/php/add-or-remove-favourite.php");
        REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        REQUEST.send("product_id="+favouriteButton.getAttribute("data-product_id"));
        REQUEST.onreadystatechange = function() {
            if (REQUEST.readyState == XMLHttpRequest.DONE) {
                if(REQUEST.responseText == 'not logged in'){
                    window.open(
                        '/sklep/user/favourites.php',
                        '_blank'
                    );
                } else {
                    if($(favouriteButton).hasClass('fav')){
                        $(favouriteButton).removeClass('fav');
                        $(favouriteButton).addClass('not-fav');
                    } else {
                        $(favouriteButton).removeClass('not-fav');
                        $(favouriteButton).addClass('fav');
                    }
                    updateFavouritesValue();
                }
            }
        }
    }
});


updateFavouritesValue();