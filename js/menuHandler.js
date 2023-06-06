//          Categories displayed when hovering navbar

const categoryButtons = document.querySelectorAll(".category");

categoryButtons.forEach((category_button)=>{
    let timer;
    let delay = 300;
    category_button.onmouseenter = function(){
        timer = setTimeout (function() {
            closeAll();
            category_button.setAttribute('active', 'yes');
            category_button.children[1].classList.remove('off');
        }, delay);
    }
    category_button.onmouseleave = function(){
        closeAll();
        clearTimeout(timer);
    }    
})

function closeAll(){
    const categoryPannels = document.querySelectorAll('.categories-bg');
    categoryPannels.forEach((category_pannel)=>{
        category_pannel.classList.add('off');
    })
    categoryButtons.forEach((category_button)=>{
        category_button.setAttribute('active', 'no');
    })
}