//      Custom product quantity controller

const quantityControllers = document.querySelectorAll('.quantity-input-container'); // Container holding each products' quantity and -+ buttons
let productTotals = document.querySelectorAll('.product-total'); // Product totals displayed on page load
const cheapestShipping = document.querySelector('.shipping-price');

const productSum = document.querySelector('.product-sum');
const totalSum = document.querySelector('.total-sum');
if ( path == '/sklep/cart.php' ) {
  shipping = parseFloat(cheapestShipping.innerHTML.replace(',', '.'));
}

quantityControllers.forEach(quantityController => {
  if($(quantityController).hasClass('available') || path == '/sklep/cart.php'){
    const subtractBtn = quantityController.querySelector('.subtract');
    const addBtn = quantityController.querySelector('.add');
    const display = quantityController.querySelector('.quantity-display');

    const min = parseInt(quantityController.getAttribute('data-min'));
    const max = parseInt(quantityController.getAttribute('data-max'));
    const step = parseInt(quantityController.getAttribute('data-step'));

    const productPrice = quantityController.parentElement.parentElement.querySelector('.price');
    const productTotal = quantityController.parentElement.parentElement.querySelector('.product-total');

    let addInterval;
    let subtractInterval;

    let timer;
    let delay = 300;

    let isDown = false;
    let isDownTimer;

    // Subtract Button actions

    // Takes action only if mousedown hasn't been triggered already
    subtractBtn.onclick = function () {
      if ( isDown === false ) { 
        if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
        } else {
            quantityController.style.animation = 'shake-horizontal 0.7s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
        }
      }
      if ( path == '/sklep/cart.php' ) {
        modifyQuantity();
      }
    }

    subtractBtn.onmousedown = function () {
      isDown = false;
      isDownTimer = setTimeout(function(){
            isDown = true;
      }, 300);
      timer = setTimeout (function() {
        let i = -8;
        subtractInterval = setInterval(() => {
          if ( parseInt(display.innerText) - parseInt(step*exponential(i)) >= min ) {
            display.innerText = parseInt(display.innerText) - parseInt(step*exponential(i));
            i++;
          } else if ( parseInt(display.innerText) - parseInt(step*exponential(i)) < min ) {
            display.innerText = min;
            quantityController.style.animation = 'shake-horizontal-delay-between 1.1s cubic-bezier(0.455, 0.030, 0.515, 0.955) infinite both';
          }
        }, 100);
      }, delay);
    }

    subtractBtn.onmouseup = function () {
      if ( path == '/sklep/cart.php' ) {
        modifyQuantity();
      }
      clearTimeout(isDownTimer);
      clearInterval(subtractInterval);
      clearTimeout(timer);
      quantityController.style.animation = '';
    }

    subtractBtn.onmouseleave = function () {
      clearInterval(subtractInterval);
      clearTimeout(timer);
      quantityController.style.animation = '';
    }


    // Add Button actions

    // Takes action only if mousedown hasn't been triggered already
    addBtn.onclick = function () {
      if(isDown === false){
        if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
        } else {
          quantityController.style.animation = 'shake-horizontal 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
        }
      }
      if ( path == '/sklep/cart.php' ) {
        modifyQuantity();
      }
    }

    addBtn.onmousedown = function () {
      isDown = false;
        isDownTimer = setTimeout(function(){
            isDown = true;
      }, 300);
      timer = setTimeout (function() {
        let i = -8;
        addInterval = setInterval(() => {
          if ( parseInt(display.innerText) + parseInt(step*exponential(i)) <= max ) {
            display.innerText = parseInt(display.innerText) + parseInt(step*exponential(i));
            i++;
          } else if ( parseInt(display.innerText) + parseInt(step*exponential(i)) > max ) {
            display.innerText = max;
            quantityController.style.animation = 'shake-horizontal-delay-between 1.1s cubic-bezier(0.455, 0.030, 0.515, 0.955) infinite both';
          }
        }, 100);
      }, delay);
    }

    addBtn.onmouseup = function () {
      if ( path == '/sklep/cart.php' ) {
        modifyQuantity();
      }
      clearTimeout(isDownTimer);
      clearInterval(addInterval);
      clearTimeout(timer);
      quantityController.style.animation = '';
    }

    addBtn.onmouseleave = function () {
      clearInterval(addInterval);
      clearTimeout(timer);
      quantityController.style.animation = '';
    }

    const modifyQuantity = function () {
      const REQUEST = new XMLHttpRequest();
      REQUEST.open("POST", "php/modify-quantity.php");
      REQUEST.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
      REQUEST.send("cart_id="+display.getAttribute("data-cart_id")+"&quantity="+parseInt(display.innerText));

      calculateProductTotal();
      calculateOrder();
    }

    const calculateProductTotal = function() {
      productTotal.innerText = Intl.NumberFormat('pl-PL', { style: 'decimal', minimumFractionDigits: '2' }).format(String((productPrice.innerHTML.replace(',', '.')*parseInt(display.innerText)).toFixed(2)));
    }
  }
});


// Function for exponential speed increase when holding a subtract or add buton
function exponential (x) {
  return Math.pow(2, (0.2*x-4))+1;
}

// Function for calculating order value
function calculateOrder () {
  let sum = 0;
  productTotals.forEach(productTotal => {
    sum += parseFloat(productTotal.innerHTML.replace(',', '.'));
  });
  sum = sum.toFixed(2);
  let total = (parseFloat(sum) + shipping).toFixed(2);
  productSum.innerText = Intl.NumberFormat('pl-PL', { style: 'decimal', minimumFractionDigits: '2' }).format(String(sum));
  totalSum.innerText = Intl.NumberFormat('pl-PL', { style: 'decimal', minimumFractionDigits: '2' }).format(String(total));
}