const urlParams = new URLSearchParams(window.location.search);

document.getElementById('sort').onchange = function() {
    localStorage.setItem('sort', document.getElementById('sort').value);
    this.form.submit();
};

if (localStorage.getItem('sort')==urlParams.get('sort')) {
    let selected = localStorage.getItem('sort');
    $(".sort option[value='"+selected+"']").attr("selected", "true");
} 

const selects = Array.from($("option[selected='selected']"));

selects.forEach(select => {
    if($(select).parent().hasClass("sort")){
        $('#select2-sort-container').text($(select).text());
    }
});