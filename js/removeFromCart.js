let removeButtons = document.querySelectorAll('.remove-from-cart');

removeButtons.forEach(removeButton => {
    removeButton.onclick = function() {
        removeButtons = document.querySelectorAll('.remove-from-cart');
        const REQUEST = new XMLHttpRequest();
        REQUEST.open("POST", "remove-from-cart.php");
        REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        REQUEST.send("cart_id="+removeButton.getAttribute("data-cart_id"));
        removeButton.parentElement.parentElement.remove();

        if(removeButtons.length == 1) {
            document.location.reload();
        }
    }
});
