const path = window.location.pathname;
const cartAmount = document.querySelector(".cart-items-amount");

if ( path != '/sklep/shopping-cart.php' ) {
    const cartButton = document.querySelector(".header-cart");
    const cartPreview = document.querySelector(".preview-cart-container");

    let isOverPreview = false;
    let isOverButton = false;
    let timer;

    cartButton.onmouseenter = function() {
        timer = setTimeout(() => {
            isOverButton = true;
            $(cartPreview).removeClass("off");
        }, 200)
    }

    cartButton.onmouseleave = function() {
        clearTimeout(timer);
        isOverButton = false;
        setTimeout(() => {
            if(isOverPreview == false) {
                $(cartPreview).addClass("off");
            }
        }, 200)
    }

    cartPreview.onmouseenter = function() {
        isOverPreview = true;
    }

    cartPreview.onmouseleave = function() {
        isOverPreview = false;
        setTimeout(() => {
            if(isOverButton == false) {
                $(cartPreview).addClass("off");
            }
        }, 200)
    }
}

function changeAmount() {
    
}