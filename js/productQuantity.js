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

    let isDown = false;
    let isDownTimer;


    // Subtract Button actions

    subtractBtn.onclick = function () {
      if(isDown === false){
        if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
        } else {
            quantityController.style.animation = 'shake-horizontal 0.7s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
        }
      }
    }

    subtractBtn.onmousedown = function () {
      isDown = false;
        isDownTimer = setTimeout(function(){
            isDown = true;
      }, 500);
      timer = setTimeout (function() {
        subractInterval = setInterval(() => {
          if ( parseInt(display.innerText) - step >= min ) {
            display.innerText = parseInt(display.innerText) - step;
          } else {
            quantityController.style.animation = 'shake-horizontal-delay-between 1.1s cubic-bezier(0.455, 0.030, 0.515, 0.955) infinite both';
          }
        }, 100);
      }, delay);
    }

    subtractBtn.onmouseup = function () {
      clearTimeout(isDownTimer);
      clearInterval(subractInterval);
      clearTimeout(timer);
      quantityController.style.animation = '';
    }

    subtractBtn.onmouseleave = function () {
      clearInterval(subractInterval);
      clearTimeout(timer);
      quantityController.style.animation = '';
    }


    // Add Button actions

    addBtn.onclick = function () {
      if(isDown === false){
        if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
        } else {
          quantityController.style.animation = 'shake-horizontal 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
          setTimeout(() => {
              quantityController.style.animation = '';
          }, 600);
        }
      }
    }

    addBtn.onmousedown = function () {
      isDown = false;
        isDownTimer = setTimeout(function(){
            isDown = true;
      }, 500);
      timer = setTimeout (function() {
        addInterval = setInterval(() => {
          if ( parseInt(display.innerText) + step <= max ) {
            display.innerText = parseInt(display.innerText) + step;
          } else {
            quantityController.style.animation = 'shake-horizontal 0.5s cubic-bezier(0.455, 0.030, 0.515, 0.955) both';
            setTimeout(() => {
                quantityController.style.animation = '';
            }, 600);
          }
        }, 100);
      }, delay);
    }
  
    addBtn.onmouseup = function () {
      clearTimeout(isDownTimer);
      clearInterval(addInterval);
      clearTimeout(timer);
    }

    addBtn.onmouseleave = function () {
      clearInterval(addInterval);
      clearTimeout(timer);
    }
});