<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<link rel="stylesheet" href="assets/css/style.css" />

	<title>Stripe Demo</title>
</head>
<body>
	<div class="container">
		<button> <a href="index.php">Home</a></button>
		<h1>Stripe Demo Using PaymentIntent API</h1>

		<?php
			require_once('vendor/autoload.php');

			\Stripe\Stripe::setApiKey('sk_test_9MSAry4rRJHTA2IesAlSxHpB00M9TiDQYq');

			$intent = \Stripe\PaymentIntent::create([
			    'amount' => 2099,
			    'currency' => 'gbp',
			    'payment_method_types' => ['card'],
			    'metadata' => ['order_id' => 6735],
			]);

			//var_dump($intent);
		?>

		<div class="intent-form-container">  	
			<input id="cardholder-name" type="text" class="StripeElement" placeholder="Cardholder Name" /> 
			<!-- placeholder for Elements -->
			<div id="card-element"></div>
			<button id="card-button" data-secret="<?= $intent->client_secret ?>">Submit Payment </button> 
			
			<div class="payment-status"><div class="loader"></div></div>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script src="assets/js/intent.js"></script>	
</body>
</html>