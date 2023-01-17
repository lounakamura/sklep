const registerContainer = parent.document.querySelector(".register-popup");
const registerContainerTriggerBtns = [ document.querySelector(".register-button"), parent.document.querySelector(".register-button") ]

const registerPanelCloseBtn = parent.document.querySelector(".register-close");

let registerPanelOpen = false;

registerContainerTriggerBtns.forEach(registerContainerTriggerBtn => {
    registerContainerTriggerBtn.onclick = function() {
        if(loginPanelOpen == true){
            $(loginContainer).addClass('not-displayed'); 
            loginPanelOpen = false;
        }
        $(registerContainer).removeClass('not-displayed'); 
        registerPanelOpen = true;
    }

    registerPanelCloseBtn.onclick = function() {
        $(registerContainer).addClass('not-displayed'); 
        registerPanelOpen = false;
    }
});





