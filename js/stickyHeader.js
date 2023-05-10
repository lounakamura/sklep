/*      Sticky header & previews      */

const header = document.querySelector("header");
const sticky = 75;

const favBtn = document.querySelector(".header-fav");

window.addEventListener ("scroll", function () { // 
  if (window.pageYOffset > sticky) {
    $(header).addClass('header-small');
    $(accBtn).attr('data-fixed', 'yes');
    $(favBtn).attr('data-fixed', 'yes');
    $(cartBtn).attr('data-fixed', 'yes');
    $(cartPrev).addClass('fixed');
    closeAll();
  } else {
    $(header).removeClass('header-small');
    $(accBtn).attr('data-fixed', 'no');
    $(favBtn).attr('data-fixed', 'no');
    $(cartBtn).attr('data-fixed', 'no');
    $(cartPrev).removeClass('fixed');
  }
})