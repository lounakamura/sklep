const registerContainer = parent.document.querySelector(".register-popup");
const registerContainerTriggerBtns = document.querySelectorAll(".register-button");

let registerPanelOpen = false;

registerContainerTriggerBtns.forEach(registerContainerTriggerBtn => {
    registerContainerTriggerBtn.onclick = function() {
        $(registerContainer).removeClass('hidden'); 
        registerPanelOpen = true;
    }
});