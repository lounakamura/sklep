const mainCategorySelect = document.querySelector("select#category");
const categorySelect = document.querySelector("select#category1");
const subcategorySelect = document.querySelector("select#category2");

const mainCategories = Array.from(mainCategorySelect.querySelectorAll("option"));
const categories = Array.from(categorySelect.querySelectorAll("option"));
const subcategories = Array.from(subcategorySelect.querySelectorAll("option"));

mainCategorySelect.onchange = function(){
    displayCategories();
    displaySubcategories();
}

categorySelect.onchange = function(){
    displaySubcategories();
}

function displayCategories() {
    let parentId = mainCategorySelect.value;
    let count = 0;
    categories.forEach(category => {
        if($(category).attr('data-parent')!=parentId){
            category.setAttribute("hidden", true);
            category.removeAttribute("selected");
        } else {
            category.removeAttribute("hidden");
            if(count===0){
                category.setAttribute("selected", true);
            }
            count++;
        }
    });
}

function displaySubcategories() {
    let parentId = categorySelect.value;
    let count = 0;
    subcategories.forEach(subcategory => {
        if($(subcategory).attr('data-parent')!=parentId){
            subcategory.setAttribute("hidden", true);
            subcategory.removeAttribute("selected");
        } else {
            subcategory.removeAttribute("hidden");
            if(count===0){
                subcategory.setAttribute("selected", true);
            }
            count++;
        }
    });
}

displayCategories();
displaySubcategories();