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

/*      Loading screen       */

const loadingScreen = document.querySelector(".loading-screen");

function displayLoadingScreen(){
    $(loadingScreen).removeClass("not-displayed");
}

/*      Select2 config     */

$('.sort').select2({
    minimumResultsForSearch: Infinity
});
$('.admin-select2').select2({
    language: "pl",
    minimumResultsForSearch: 5
});

/*      SmallPop config       */

spop.defaults = {
	autoclose : 3000,
	position  : 'bottom-left'
};