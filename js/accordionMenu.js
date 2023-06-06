//          Accordion dropdown category menu for products display page

const accordion = function() {
    const accordion = document.querySelector(".accordion-menu");
    const dropdownBtn = accordion.querySelectorAll(".dropdown-btn");

    dropdownBtn.forEach((button) => {
        button.addEventListener("mousedown", (e) => {
            const submenuItem = button.parentElement.nextElementSibling;
            if(submenuItem.style.display === "block"){
                submenuItem.style.display = "none";
            } else {
                submenuItem.style.display = "block";
            }
            button.parentElement.parentElement.classList.toggle("active");
        });
     });
};

accordion();