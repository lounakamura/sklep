let header = document.querySelector(".header-small");
let sticky = 100;

window.addEventListener ("scroll", function () { // 
  if (window.pageYOffset > sticky) {
    header.classList.remove("off");
    closeAll();
  } else {
    header.classList.add("off");
  }
})

let toTop = document.querySelector(".to-top");

window.addEventListener ("scroll", function () { // pokazanie przycisku przewijającego do góry strony po przescrollowaniu
  if (window.pageYOffset > 100) {
    toTop.classList.add("active");
  } else {
    toTop.classList.remove("active");
  }
})

toTop.addEventListener("click", function() { // przewijanie do góry strony po kliknięciu przycisku
    $('window').animate({ scrollTop: 0 });
})