const loginContainer = parent.document.querySelector(".login-popup");
const loginContainerTriggerBtn = document.querySelector(".login-button");

let loginPanelOpen = false;

loginContainerTriggerBtn.onclick = function() {
    $(loginContainer).removeClass('hidden');
    loginPanelOpen = true;
}