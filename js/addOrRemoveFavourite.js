let favouriteButtons = document.querySelectorAll(".add-to-fav");

favouriteButtons.forEach(favouriteButton => {
    favouriteButton.onclick = function() {
        const REQUEST = new XMLHttpRequest();
        REQUEST.open("POST", "/sklep/php/add-or-remove-favourite.php");
        REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        REQUEST.send("product_id="+favouriteButton.getAttribute("data-product_id"));
        REQUEST.onreadystatechange = function() {
            if (REQUEST.readyState == XMLHttpRequest.DONE) {
                if($(favouriteButton).hasClass('fav')){
                    $(favouriteButton).removeClass('fav');
                    $(favouriteButton).addClass('not-fav');
                } else {
                    $(favouriteButton).removeClass('not-fav');
                    $(favouriteButton).addClass('fav');
                }

                if(REQUEST.responseText == 'not logged in'){
                    document.location.href = '/sklep/user/favourites.php';
                } else {
                    console.log("działa");
                }
            }
        }
    }
});
