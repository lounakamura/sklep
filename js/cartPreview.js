//          Cart preview on icon hover

window.onload = function () {
    updateCartValue();
}

const path = window.location.pathname;

const cartPrev = document.querySelector(".preview-cart-container");
const cartBtn = document.querySelector(".header-cart");

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

if ( path != '/sklep/cart.php' ) {
    let isOverCartPrev = false;
    let isOverCartBtn = false;
    let cartTimer;

    cartBtn.onmouseenter = function() {
        if( cartBtn.getAttribute("data-fixed") == 'yes') {
            $(cartPrev).addClass('fixed');
        } else {
            $(cartPrev).removeClass('fixed');
        }
        if( parseInt(cartAmount.innerText) > 0 ) {
            cartTimer = setTimeout(() => {
                isOverCartBtn = true;
                $(cartPrev).removeClass('hidden');
            }, 200)
        }
    }

    cartBtn.onmouseleave = function() {
        clearTimeout(cartTimer);
        isOverCartBtn = false;
        setTimeout(() => {
            if(isOverCartPrev == false) {
                $(cartPrev).addClass('hidden');
            }
        }, 200)
    }

    cartPrev.onmouseenter = function() {
        isOverCartPrev = true;
    }

    cartPrev.onmouseleave = function() {
        isOverCartPrev = false;
        setTimeout(() => {
            if(isOverCartBtn == false) {
                $(cartPrev).addClass('hidden');
            }
        }, 200)
    }
}