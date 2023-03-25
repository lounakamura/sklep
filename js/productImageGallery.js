const currentMainImg = document.querySelector('.gallery-main-img');
const thumbs = Array.from(document.querySelectorAll('.thumbnail'));

let currentIndex = 0;

thumbs.forEach(thumb => {
    thumb.onclick = function() {
        currentIndex = thumbs.indexOf(thumb, 0);
        $(currentMainImg).attr("src", $(thumb).attr('src'));
    }
});

const galleryCloseupContainer = document.querySelector('.gallery-closeup');
const closeupDisplayedImg = document.querySelector(".gallery-displayed-img");
const closeupThumbs = Array.from(document.querySelectorAll('.closeup-thumbnail'));

const closeButton = document.querySelector('.gallery-close');
const previousButton = document.querySelector('.gallery-previous');
const nextButton = document.querySelector('.gallery-next');

currentMainImg.onclick = function() {
    $(closeupDisplayedImg).attr("src", $(currentMainImg).attr('src'));
    $(galleryCloseupContainer).removeClass('hidden');
    $('body').addClass('scroll-block');
    closeupGalleryVisible = true;
}

closeupThumbs.forEach(thumb => {
    thumb.onclick = function() {
        currentIndex = closeupThumbs.indexOf(thumb, 0);
        $(closeupDisplayedImg).attr("src", $(thumb).attr('src'));
    }
});

closeButton.onclick = function() {
    $(galleryCloseupContainer).addClass('hidden');
    $('body').removeClass('scroll-block');
    closeupGalleryVisible = false;
    resetScale()
}

previousButton.onclick = function() {
    previousCloseup();
}

nextButton.onclick = function() {
    nextCloseup();
}

document.onkeydown = function(event) {
    if(closeupGalleryVisible === true) {
      if(event.keyCode == 37) {
        previousCloseup();
      }
      else if(event.keyCode == 39) {
        nextCloseup();
      }
    }
}

function previousCloseup() {
    if(currentIndex>0){
        currentIndex--;
        $(closeupDisplayedImg).attr("src", $(thumbs[currentIndex]).attr("src"));
        resetScale();
    }
}

function nextCloseup() {
    if(currentIndex<thumbs.length-1){
        currentIndex++;
        $(closeupDisplayedImg).attr("src", $(thumbs[currentIndex]).attr("src"));
        resetScale();
    }
}

let zoom = 1;
const zoomSpeed = 0.2;

galleryCloseupContainer.addEventListener("wheel", (e)=> {
    if (e.deltaY < 0) {
        if(zoom <= 4){
            closeupDisplayedImg.style.cursor = `zoom-in`;
            closeupDisplayedImg.style.transform = `scale(${(zoom += zoomSpeed)})`;
        } else {
            closeupDisplayedImg.style.cursor = `zoom-out`;
        }
    } else {
        if(zoom >= 0.5){
            closeupDisplayedImg.style.cursor = `zoom-out`;
            closeupDisplayedImg.style.transform = `scale(${(zoom -= zoomSpeed)})`;
        } else {
            closeupDisplayedImg.style.cursor = `zoom-in`;
        }
    }
});

function resetScale() {
    zoom = 1;
    closeupDisplayedImg.style.transform = `scale(1)`;
}