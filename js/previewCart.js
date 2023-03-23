window.onload = function () {
    updateCartValue();
}

const cartAmountContainer = parent.document.querySelector(".container-cart-items-amount");
const cartAmount = parent.document.querySelector(".cart-items-amount");

const cartAmountContainerSmall = parent.document.querySelectorAll(".container-cart-items-amount")[1];
const cartAmountSmall = parent.document.querySelectorAll(".cart-items-amount")[1];

function updateCartValue() {
    let amountValue = document.cookie.split('; ').find((row) => row.startsWith('cart-amount='))?.split('=')[1];

    if( amountValue > 0 ) {
        $(cartAmountContainer).css('opacity', 1);
        cartAmount.innerText = amountValue;
    } else {
        $(cartAmountContainer).css('opacity', 0);
        cartAmount.innerText = amountValue;
    }

    if ( !cartAmountContainerSmall.classList.contains('off') ) {
        if( amountValue > 0 ) {
            $(cartAmountContainerSmall).css('opacity', 1);
            cartAmountSmall.innerText = amountValue;
        } else {
            $(cartAmountContainerSmall).css('opacity', 0);
            cartAmountSmall.innerText = amountValue;
        }
    }
}

if ( path != '/sklep/cart.php' ) {
    const cartButtons = parent.document.querySelectorAll(".header-cart");
    const cartPreview = parent.document.querySelector(".preview-cart-container");

    let isOverPreview = false;
    let isOverButton = false;
    let timer;

    cartButtons.forEach(cartButton => {
        cartButton.onmouseenter = function() {
            if( cartButton.getAttribute("data-fixed") == 'yes') {
                $(cartPreview).addClass('fixed');
            } else {
                $(cartPreview).removeClass('fixed');
            }
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
    });

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