const productSum = document.querySelector(".product-sum");
const shippingPrice = document.querySelector(".shipping-price");
const totalPrice = document.querySelector(".total-sum");

function calculateOrderValue() {
    let chosenShippingPrice = document.querySelector('input[name="shipping"]:checked').nextElementSibling.lastElementChild.firstElementChild.firstElementChild.innerHTML;
    let total = ((parseFloat((productSum.innerHTML).replace(',', '.'))+parseFloat((chosenShippingPrice).replace(',', '.'))).toFixed(2)).replace('.', ','); 

    shippingPrice.innerHTML = chosenShippingPrice;
    totalPrice.innerHTML = total;
}

calculateOrderValue();