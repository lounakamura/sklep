const accordion = function() {
    const accordion = document.querySelector(".accordion-menu");
    const dropdownBtn = accordion.querySelectorAll(".dropdown-btn");

    dropdownBtn.forEach((button) => {
        button.addEventListener("mousedown", (e) => {
            const submenuItem = button.parentElement.nextElementSibling;
            submenuItem.style.display = submenuItem.style.display === "block" ? "none" : "block";
            button.parentElement.parentElement.classList.toggle("active");
        });
     });
};

accordion();