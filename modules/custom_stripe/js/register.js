(function(){
  var form = document.forms["user-register-form"];
  var pubkey = drupalSettings.custom_stripe.stripe_pub_key;
  var handler = StripeCheckout.configure({
    key: pubkey,
    locale: 'auto',
    image: '/themes/oden/img/logo-circle.png',
    token: stripeToken
  });
  
  form.addEventListener("submit", submitEvent);
  
  function submitEvent(e) {
    e.preventDefault();
    console.log("cost: ", calculateCost());
    handler.open({
      name: "ODEN",
      description: "ODEN Membership Fee",
      amount: calculateCost(),
      currency: "CAD"
    });
  }
  function calculateCost() {
    var membershipType = form.field_membership_type.value;
    var budget = form.field_operating_budget.value;
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
})();
