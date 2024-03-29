/*      Loading screen       */

const loadingScreen = document.querySelector(".loading-screen");

function displayLoadingScreen(){
    $(loadingScreen).removeClass("not-displayed");
}

/*      Select2 config     */

$('.sort').select2({
    minimumResultsForSearch: Infinity
});
$('.admin-select2').select2({
    language: "pl",
    minimumResultsForSearch: 5
});

/*      SmallPop config       */

spop.defaults = {
	autoclose : 5000,
	position  : 'bottom-left'
};

/*        "Payment"          */

function payment(){
    displayLoadingScreen();
    setTimeout(function() {
            window.location.href = "/sklep/order/paymentSuccess.php";
        }, 2000
    );
    
}