let clearButton = document.querySelector('.clear-cart-button');

clearButton.onclick = function() {
    const REQUEST = new XMLHttpRequest();
    REQUEST.open("POST", "php/clear-cart.php");
    REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    REQUEST.send();
    document.location.reload();
}