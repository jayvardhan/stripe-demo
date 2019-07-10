<?php 

require_once('vendor/autoload.php'); 

// Set your secret key: remember to change this to your live secret key in production
// See your keys here: https://dashboard.stripe.com/account/apikeys
\Stripe\Stripe::setApiKey('sk_test_9MSAry4rRJHTA2IesAlSxHpB00M9TiDQYq');

// Token is created using Checkout or Elements!
// Get the payment token ID submitted by the form:
$token = $_POST['stripeToken'];

$charge = \Stripe\Charge::create([
    'amount' => 999,
    'currency' => 'gbp',
    'description' => 'Example charge',
    'source' => $token,
]);

switch ($charge->status) {
	case 'succeeded':
		echo "Payment Status: Succeeded";
		break;
	
	case 'pending':
		echo "Payment Status: Pending";
		break;

	case 'failed':
		echo "Payment Status: Failed";
		break;

	default:
		echo "Something Went Wrong";
		break;
}

