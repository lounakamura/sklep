const cartPreviewIframe = document.querySelector("[data-id='preview-cart']");
let addButtons = document.querySelectorAll(".add-to-cart-button");
let quantityDisplay = document.querySelector(".quantity-display");
let quantity;

addButtons.forEach(addButton => {
    addButton.onclick = function() {
        if(quantityDisplay){
            quantity = parseInt(quantityDisplay.innerText);
        } else {
            quantity = 1;
        }
        const REQUEST = new XMLHttpRequest();
        REQUEST.open("POST", "php/add-to-cart.php");
        REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        REQUEST.send("product_id="+addButton.getAttribute("data-product_id")+"&quantity="+quantity);
        REQUEST.onload = function() {
            cartPreviewIframe.contentWindow.location.reload();
            updateCartValue();
        }
    }
});

