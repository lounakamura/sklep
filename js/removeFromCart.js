//          Removing product from cart

let removeButtons = document.querySelectorAll('.remove-from-cart');

removeButtons.forEach(removeButton => {
    removeButton.onclick = function() {
        removeButtons = document.querySelectorAll('.remove-from-cart');
        const REQUEST = new XMLHttpRequest();
        REQUEST.open("POST", "php/remove-from-cart.php");
        REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        REQUEST.send("cart_id="+removeButton.getAttribute("data-cart_id"));
        REQUEST.onload = function() {
            const cartPreview = parent.document.querySelector(".preview-cart-container");
            amountValue = document.cookie.split('; ').find((row) => row.startsWith('cart-amount='))?.split('=')[1];
            removeButton.parentElement.parentElement.remove();
            if( parseInt(amountValue) == 0 ) {
                $(cartPreview).addClass('hidden');
            }
            displayLoadingScreen();
            document.location.reload();
            updateCartValue();
        }
    }
});