//          Adding products to cart

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
                    if(REQUEST.responseText == 'error'){
                        spop("Błąd w dodawaniu produktu do koszyka!", "error");
                        addButton.style.animation = 'shake-horizontal 0.6s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
                        setTimeout(() => {
                            addButton.style.animation = '';
                            }, 600
                        )
                    } else {
                        spop("Produkt został dodany do koszyka.", "success");
                        cartPreviewIframe.contentWindow.location.reload();
                        updateCartValue();
                    }
                }
            }
        }
    }
});

updateCartValue();