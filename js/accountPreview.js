const accPrev = document.querySelector(".account-container");
const accBtn = document.querySelector(".header-account");

let isOverAccPreview = false;
let isOverAccButton = false;
let accTimer;

accBtn.onmouseenter = function() {
    if(accBtn.getAttribute("data-fixed") == 'yes') {
        $(accPrev).addClass('fixed');
    } else {
        $(accPrev).removeClass('fixed');
    }

    accTimer = setTimeout(() => {
        isOverAccButton = true;
        $(accPrev).removeClass('hidden');
    }, 200)
}

accBtn.onmouseleave = function() {
    clearTimeout(accTimer);
    isOverAccButton = false;
    setTimeout(() => {
        if(isOverAccPreview == false) {
            $(accPrev).addClass('hidden');
        }
    }, 200)
}

accPrev.onmouseenter = function() {
    isOverAccPreview = true;
}

accPrev.onmouseleave = function() {
    isOverAccPreview = false;
    setTimeout(() => {
        if(isOverAccButton == false) {
            $(accPrev).addClass('hidden');
        }
    }, 200)
}