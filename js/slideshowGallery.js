//      Slideshow gallery for the homepage with promo banners

const slides = Array.from(document.querySelectorAll(".promo-banner-container"));

let currentSlide = -1;

slides.forEach((slide, index) => {
  slide.style.transform = `translateX(${index * 100}%)`;
});

function changeSlide() {
    if(currentSlide < slides.length-1) {
        currentSlide++;
      } else {
        currentSlide = 0;
      }
      slides.forEach((slide, index) => {
        slide.style.display = 'block';
        slide.style.transform = `translateX(${100 * (index - currentSlide)}%)`;
    });

    setTimeout(changeSlide, 5000);
}

changeSlide();

