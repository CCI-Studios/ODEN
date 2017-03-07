(function(){
  var form = document.forms["custom-stripe-renewal-form"];
  var pubkey = drupalSettings.custom_stripe.stripe_pub_key;
  var amount = drupalSettings.custom_stripe.renewal_price;
  var email = drupalSettings.custom_stripe.user_email;
  var handler = StripeCheckout.configure({
    key: pubkey,
    locale: 'auto',
    image: '/themes/oden/img/logo-circle.png',
    token: stripeToken
  });
  
  form.addEventListener("submit", submitEvent);
  
  function submitEvent(e) {
    e.preventDefault();
    handler.open({
      name: "ODEN",
      description: "ODEN Membership Fee",
      amount: amount,
      currency: "CAD",
      email: email
    });
  }
  function stripeToken(token) {
    form["stripe_token"].value = token.id;
    form.submit();
  }
})();
