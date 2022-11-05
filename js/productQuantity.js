const quantityControllers = document.querySelectorAll('.quantity-input-container');

quantityControllers.forEach(quantityController => {
  const subtractBtn = quantityController.querySelector('.subtract')
  const input = quantityController.querySelector('input')
  const addBtn = quantityController.querySelector('.add')

  const min = parseInt(input.min);
  const max = parseInt(input.max);
  const step = parseInt(input.step);

  subtractBtn.onclick = function () {
    if ( parseInt(input.getAttribute('data-value')) - step >= min ) {
        input.setAttribute('data-value', parseInt(input.getAttribute('data-value')) - step);
        input.value = parseInt(input.getAttribute('data-value')) - step;
    }
  }
  addBtn.onclick = function () {
    if ( parseInt(input.getAttribute('data-value')) + step <= max ) {
        input.setAttribute('data-value', parseInt(input.getAttribute('data-value')) + step);
        input.value = parseInt(input.getAttribute('data-value')) + step;
    }
  }
  input.onchange = function () {
    if ( parseInt(input.getAttribute('data-value')) < min ) {
        input.setAttribute('data-value', min);
        input.value = min;
    }
    if ( parseInt(input.getAttribute('data-value')) > max ) {
        input.setAttribute('data-value', max);
        input.value = max;
    }
  }
})