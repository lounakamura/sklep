const accountButtons = parent.document.querySelectorAll(".header-account");
const accountContainer = document.querySelector(".account-container");

const accountPanelCloseBtns = document.querySelectorAll(".account-controls-close"); //Sooo i fucked up i dk whats going on here

let isOverPreview = false;
let isOverButton = false;
let timer;

accountButtons.forEach(accountButton => {
    accountButton.onmouseenter = function() {
        if(accountButton.getAttribute("data-fixed") == 'yes') {
            $(accountContainer).addClass('fixed');
        } else {
            $(accountContainer).removeClass('fixed');
        }

        timer = setTimeout(() => {
            isOverButton = true;
            $(accountContainer).removeClass('hidden');
        }, 200)
    }

    accountButton.onmouseleave = function() {
        clearTimeout(timer);
        isOverButton = false;
        setTimeout(() => {
            if(isOverPreview == false) {
                $(accountContainer).addClass('hidden');
            }
        }, 200)
    }
});

accountContainer.onmouseenter = function() {
    isOverPreview = true;
}

accountContainer.onmouseleave = function() {
    isOverPreview = false;
    setTimeout(() => {
        if(isOverButton == false) {
            $(accountContainer).addClass('hidden');
        }
    }, 200)
}

accountPanelCloseBtns.forEach(accountPanelCloseBtn => {
    accountPanelCloseBtn.onclick = function(){
        if(loginPanelOpen == true){
            $(loginContainer).addClass('hidden'); 
        } else if(registerPanelOpen == true){
            $(registerContainer).addClass('hidden'); 
        }
    }
});