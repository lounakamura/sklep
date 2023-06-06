//      Order information field display based on whether client is a private person or a company

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
      $(input).find('input').prop("disabled", false)
    } else {
      input.addClass("not-displayed");
      $(input).find('input').removeAttr("required");
      $(input).find('input').prop("disabled", true)
    }
  });
}