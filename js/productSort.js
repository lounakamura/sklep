document.getElementById('sort').onchange = function() {
    localStorage.setItem('selectedItem', document.getElementById('sort').value);
    this.form.submit();
};

if (localStorage.getItem('selectedItem')) {
    let selected = localStorage.getItem('selectedItem');
    $(".sort option[value='"+selected+"']").attr("selected", "true");
} 

document.getElementById('pageAmt').onchange = function() {
    localStorage.setItem('pageAmt', document.getElementById('pageAmt').value);
    this.form.submit();
};

if (localStorage.getItem('pageAmt')) {
    let selected = localStorage.getItem('pageAmt');
    $(".pageAmt option[value='"+selected+"']").attr("selected", "true");
}

const selects = Array.from($("option[selected='selected']"));

selects.forEach(select => {
    if($(select).parent().hasClass("pageAmt")){
        $('#select2-pageAmt-container').text($(select).text());
    }
    if($(select).parent().hasClass("sort")){
        $('#select2-sort-container').text($(select).text());
    }
});