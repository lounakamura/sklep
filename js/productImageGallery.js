$(function () {
    $(".xzoom, .xzoom-gallery").xzoom({
        zoomWidth: 500,
        zoomHeight: 500,
        tint: "#ddd",
        tintOpacity: 0.25,
        Xoffset: 15,
        smoothZoomMove: 4,
        smoothLensMove: 2,
        smoothScale: 6,
        defaultScale: 0.5,
    });
});

let galleryBackground = document.querySelector('.gallery-background');

let productImage = document.querySelector('.xzoom');

let closeButton = document.querySelector('.gallery-close');

productImage.onclick = function() {
    let displayedImage = $('.xzoom').attr('src');
    $('.gallery-displayed-img').attr("src", displayedImage);
    $(galleryBackground).removeClass('hidden');
    $('body').addClass('scroll-block');
}

closeButton.onclick = function() {
    $(galleryBackground).addClass('hidden');
    $('body').removeClass('scroll-block');
    console.log('wtf');
}