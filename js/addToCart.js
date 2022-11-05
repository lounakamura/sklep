let addButtons = document.querySelectorAll(".add-to-cart-button");
let quantityInput = document.querySelector("input.quantity");
let quantity;

if(quantityInput!=null) {
    quantity = quantityInput.value;
}

addButtons.forEach(addButton => {
    addButton.onclick = function() {
        console.log('pizda '+quantity);
        const REQUEST = new XMLHttpRequest();
        REQUEST.open("POST", "cart.php");
        REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        REQUEST.send("product_id="+addButton.getAttribute("data-product_id"));
    }
});