const personInputs = [$('div.name'), $('div.last-name')];
const companyInputs = [$('div.company-name'), $('div.nip')];

function changeFormDisplay(company) {
  personInputs.forEach(input => {
    if(company.value === "yes"){
      input.addClass("not-displayed");
      $(input).find('input').removeAttr("required");
    } else {
      input.removeClass("not-displayed");
      $(input).find('input').attr("required", "");
    }
  });

  companyInputs.forEach(input => {
    if(company.value === "yes"){
      input.removeClass("not-displayed");
      $(input).find('input').attr("required", "");
    } else {
      input.addClass("not-displayed");
      $(input).find('input').removeAttr("required");
    }
  });
}