(function($){
  var form = document.forms["user-register-form"];
  var pubkey = drupalSettings.custom_stripe.stripe_pub_key;
  var handler = StripeCheckout.configure({
    key: pubkey,
    locale: 'auto',
    image: '/themes/oden/img/logo-circle.png',
    token: stripeToken
  });
  
  form.addEventListener("submit", submitEvent);
  createCostField();
  updateCostField();
  $(form).find("[name=field_membership_type], [name=field_operating_budget]").on("change blur", updateCostField);
  
  function submitEvent(e) {
    if (!$(form).valid()) {
      //if clientside validation fails, then do not continue to payment
      return;
    }
    e.preventDefault();
    handler.open({
      name: "ODEN",
      description: "ODEN Membership Fee",
      amount: calculateCost(),
      currency: "CAD"
    });
  }
  function calculateCost() {
    var membershipType = $(form).find("[name=field_membership_type]:checked").val();
    var budget = $(form).find("[name=field_operating_budget]:checked").val();
    if (!membershipType || !budget) return;
    var prices = drupalSettings.custom_stripe.price;
    switch (membershipType) {
      case "12":
        return prices["price_single"];
      case "13":
        return prices["price_corporate"];
      case "14":
        return prices["price_associate_"+budget];
      case "15":
        return prices["price_full_"+budget];
    }
  }
  function stripeToken(token) {
    form["stripe_token"].value = token.id;
    form.submit();
  }
  function createCostField() {
    $("#edit-field-operating-budget--wrapper").after("<div class='form-item field-cost'><label><strong>Membership Cost</strong> (calculated by selection above)</label><div class='field-value'></div></div>");
  }
  function updateCostField() {
    var cost = "$"+(calculateCost()/100).toFixed(2);
    $(form).find(".field-cost .field-value").text(cost);
  }
})(jQuery);
