const path = window.location.pathname;
let header = document.querySelector(".header-small");
let sticky = 100;
let miniCart = document.querySelector(".preview-cart-container");

window.addEventListener ("scroll", function () { // 
  if (window.pageYOffset > sticky) {
    header.classList.remove("off");
    $(miniCart).addClass('fixed');
    closeAll();
  } else {
    header.classList.add("off");
    $(miniCart).removeClass('fixed');
  }
})