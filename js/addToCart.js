updateCartValue();

const cartPreviewIframe = document.querySelector("[data-id='preview-cart']");
const addButtons = document.querySelectorAll(".add-to-cart-button");
const quantityDisplay = document.querySelector(".quantity-display");
let quantity;
let isPink;
let isWhite;

addButtons.forEach(addButton => {
    if($(addButton).hasClass('available')){
        addButton.onclick = function() {
            if(quantityDisplay){
                quantity = parseInt(quantityDisplay.innerText);
            } else {
                quantity = 1;
            }
            const REQUEST = new XMLHttpRequest();
            REQUEST.open("POST", "/sklep/php/add-to-cart.php");
            REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            REQUEST.send("product_id="+addButton.getAttribute("data-product_id")+"&quantity="+quantity);
            REQUEST.onreadystatechange = function() {
                if (REQUEST.readyState == XMLHttpRequest.DONE) {
                    if($(addButton).hasClass('pink-button')){
                        isPink = true;
                        isWhite = false;
                        $(addButton).removeClass('pink-button');
                    } else {
                        isPink = false;
                        isWhite = true;
                        $(addButton).removeClass('white-button');
                    }

                    setTimeout(() => {
                        if(isWhite){
                            $(addButton).addClass('white-button');
                        } else if(isPink) {
                            $(addButton).addClass('pink-button');
                        }
                        addButton.innerHTML = 'Dodaj do koszyka';
                        }, 2000
                    )

                    if(REQUEST.responseText == 'error'){
                        addButton.style.animation = 'shake-horizontal 0.6s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
                        $(addButton).addClass('add-to-cart-failure');
                        
                        addButton.innerHTML = 'Błąd dodawania!';
                        setTimeout(() => {
                            addButton.style.animation = '';
                            }, 600
                        )

                        setTimeout(() => {
                            $(addButton).removeClass('add-to-cart-failure');
                            }, 2000
                        ) 
                    } else {
                        cartPreviewIframe.contentWindow.location.reload();
                        updateCartValue();

                        addButton.innerHTML = 'Dodano!';
                        $(addButton).addClass('add-to-cart-success');
                        setTimeout(() => {
                            $(addButton).removeClass('add-to-cart-success');
                            }, 2000
                        )
                    }
                }
            }
        }
    }
});
