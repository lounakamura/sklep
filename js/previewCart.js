window.onload = function () {
    updateCartValue();
}

const cartAmountContainer = parent.document.querySelector(".container-cart-items-amount");
const cartAmount = parent.document.querySelector(".cart-items-amount");

function updateCartValue() {
    let amountValue = document.cookie.split('; ').find((row) => row.startsWith('cart-amount='))?.split('=')[1];

    if( amountValue > 0 ) {
        $(cartAmountContainer).css('opacity', 1);
        cartAmount.innerText = amountValue;
    } else {
        $(cartAmountContainer).css('opacity', 0);
        cartAmount.innerText = amountValue;
    }
}

if ( path != '/sklep/shopping-cart.php' ) {
    const cartButton = parent.document.querySelector(".header-cart");
    const cartPreview = parent.document.querySelector(".preview-cart-container");

    let isOverPreview = false;
    let isOverButton = false;
    let timer;

    cartButton.onmouseenter = function() {
        if( parseInt(cartAmount.innerText) > 0 ) {
            timer = setTimeout(() => {
                isOverButton = true;
                $(cartPreview).removeClass('hidden');
            }, 200)
        }
    }

    cartButton.onmouseleave = function() {
        clearTimeout(timer);
        isOverButton = false;
        setTimeout(() => {
            if(isOverPreview == false) {
                $(cartPreview).addClass('hidden');
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
                $(cartPreview).addClass('hidden');
            }
        }, 200)
    }
}