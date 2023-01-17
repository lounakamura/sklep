const loginContainer = parent.document.querySelector(".login-popup");
const loginContainerTriggerBtn = document.querySelector(".login-button");

const loginPanelCloseBtn = parent.document.querySelector(".login-close");

let loginPanelOpen = false;

loginContainerTriggerBtn.onclick = function() {
    $(loginContainer).removeClass('not-displayed');
    loginPanelOpen = true;
}

loginPanelCloseBtn.onclick = function() {
    if(loginPanelOpen == true){
        $(loginContainer).addClass('not-displayed'); 
        loginPanelOpen = false;
    }
}