$(document).ready(function() {
    $('#sort').select2({
        minimumResultsForSearch: Infinity
    });
    $('.admin-select2').select2({
        language: "pl",
        minimumResultsForSearch: 5
    });
});