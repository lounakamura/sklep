document.getElementById('sort').onchange = function() {
    localStorage.setItem('selectedItem', document.getElementById('sort').value);
    this.form.submit();
};

if (localStorage.getItem('selectedItem')) {
    let selected = localStorage.getItem('selectedItem');
    $("#sort option[value='"+selected+"']").attr("selected", "true");
} 