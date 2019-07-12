var stripe = Stripe('pk_test_4O2ygQ9StNqw7jU49BymIka800Muqq1MaT');



var elements = stripe.elements();
var cardElement = elements.create('card');
cardElement.mount('#card-element');

var cardholderName = document.getElementById('cardholder-name');
var cardButton = document.getElementById('card-button');
var clientSecret = cardButton.dataset.secret;

var loader = $('.loader');
var result = $('.payment-status');

cardButton.addEventListener('click', function(ev) {
  ev.preventDefault();
  loader.css('display','block');
  
  stripe.handleCardPayment(
    clientSecret, cardElement, {
      payment_method_data: {
        billing_details: {name: cardholderName.value}
      }
    }
  ).then(function(response) {

    if (response.error) {
      // Display error.message in your UI.
      loader.css('display','none');
      result.html("Payment Failed");
    } else {
      // The payment has succeeded. Display a success message.
      //console.log(response);
      // Show success message
      loader.css('display','none');
      result.html("Payment Status:" + response.paymentIntent.status );
    }
  });  



  /*stripe.createPaymentMethod('card', cardElement, {
    
    billing_details: {name: cardholderName.value}
  
  }).then(function(result) {
    
    if (result.error) {
      // Show error in payment form
    } else {
      // Otherwise send paymentMethod.id to your server (see Step 2)
      fetch('http://localhost/stripe-demo/payment-handler/intent.php', {
        
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ payment_method_id: result.paymentMethod.id })
      
      }).then(function(result) {
        
        // Handle server response (see Step 3)
        result.json().then(function(json) {
          handleServerResponse(json);
        })
      
      });
    }
  });*/


});


function handleServerResponse(response) {
  if (response.error) {
    // Show error from server on payment form
    loader.css('display','none');
    result.html("Payment Failed");
  
  } else if (response.requires_action) {
    
    // Use Stripe.js to handle required card action
    stripe.handleCardAction(
      response.payment_intent_client_secret
    ).then(function(result) {
      
      if (result.error) {
        // Show error in payment form
        loader.css('display','none');
        result.html("Payment Failed");
      
      } else {
        // The card action has been handled
        // The PaymentIntent can be confirmed again on the server
        fetch('http://localhost/stripe-demo/payment-handler/intent.php', {
        
          method: 'POST',
          headers: { 'Content-Type': 'application/json' },
          body: JSON.stringify({ payment_intent_id: result.paymentIntent.id })
        
        }).then(function(confirmResult) {
          return confirmResult.json();
        }).then(handleServerResponse);
      
      }
    });
  } else {
    // Show success message
    loader.css('display','none');
    result.html("Payment Completed");
    
  }
}