let quantityInputs = document.querySelectorAll(".product-quantity");
quantityInputs.forEach(quantityInput => {
    quantityInput.querySelector(".subtract").onclick = function () {
        quantityInput.querySelector("input").stepDown();
    };
    quantityInput.querySelector(".add").onclick = function () {
        quantityInput.querySelector("input").stepUp();
    };
});