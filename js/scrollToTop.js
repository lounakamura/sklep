let toTop = document.querySelector(".to-top");

window.addEventListener ("scroll", function () {
  if (window.pageYOffset > 100) {
    toTop.classList.add("active");
  } else {
    toTop.classList.remove("active");
  }
})

toTop.addEventListener("click", function() {
    $('window').animate({ scrollTop: 0 });
})