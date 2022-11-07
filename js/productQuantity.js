const quantityControllers = document.querySelectorAll('.quantity-input-container');

quantityControllers.forEach(quantityController => {
    const subtractBtn = quantityController.querySelector('.subtract');
    const addBtn = quantityController.querySelector('.add');
    const display = quantityController.querySelector('.quantity-display');

    const min = parseInt(quantityController.getAttribute('data-min'));
    const max = parseInt(quantityController.getAttribute('data-max'));
    const step = parseInt(quantityController.getAttribute('data-step'));

    let addInterval;
    let subractInterval;

    let timer;
    let delay = 300;

    subtractBtn.onclick = function () {
        if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
        } else {
            quantityController.style.animation = 'shake-horizontal 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
            setTimeout(() => {
                quantityController.style.animation = '';
            }, 600);
        }
    }
    subtractBtn.onmousedown = function () {
      timer = setTimeout (function() {
        subractInterval = setInterval(() => {
          if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
          }
        }, 100);
      }, delay);
    }
    subtractBtn.onmouseup = function () {
      clearInterval(subractInterval);
      clearTimeout(timer);
    }
    subtractBtn.onmouseleave = function () {
      clearInterval(subractInterval);
      clearTimeout(timer);
    }

    addBtn.onclick = function () {
        if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
        } else {
          quantityController.style.animation = 'shake-horizontal 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
          setTimeout(() => {
              quantityController.style.animation = '';
          }, 600);
        }
    }
    addBtn.onmousedown = function () {
      timer = setTimeout (function() {
        addInterval = setInterval(() => {
          if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
          } 
        }, 100);
      }, delay);
    }
    
    addBtn.onmouseup = function () {
      clearInterval(addInterval);
      clearTimeout(timer);
    }
    addBtn.onmouseleave = function () {
      clearInterval(addInterval);
      clearTimeout(timer);
    }
});