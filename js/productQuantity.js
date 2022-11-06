const quantityControllers = document.querySelectorAll('.quantity-input-container');

quantityControllers.forEach(quantityController => {
    const subtractBtn = quantityController.querySelector('.subtract');
    const addBtn = quantityController.querySelector('.add');
    const display = quantityController.querySelector('.quantity-display');

    const min = parseInt(quantityController.getAttribute('data-min'));
    const max = parseInt(quantityController.getAttribute('data-max'));
    const step = parseInt(quantityController.getAttribute('data-step'));

    subtractBtn.onclick = function () {
        if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
        }
    }
    subtractBtn.onmousedown = function () {
      setTimeout(() => {
        subractInterval = setInterval(() => {
          if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
        }
        }, 100);
      }, 150);
    }
    subtractBtn.onmouseup = function () {
      clearInterval(subractInterval);
    }

    addBtn.onclick = function () {
        if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
        }
    }
    addBtn.onmousedown = function () {
      setTimeout(() => {
        addInterval = setInterval(() => {
          if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
        }
        }, 100);
      }, 150);
    }
    addBtn.onmouseup = function () {
      clearInterval(addInterval);
    }
});