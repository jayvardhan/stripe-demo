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
		<h1>Stripe Demo Using Charge API</h1>

		<div class="form-container">
			<form action="charge.php" method="post" id="payment-form">
			  <div class="form-row">
			    <label for="card-element">
			      Credit or debit card
			    </label>
			    <div id="card-element">
			      <!-- A Stripe Element will be inserted here. -->
			    </div>

			    <!-- Used to display form errors. -->
			    <div id="card-errors" role="alert"></div>
			  </div>

			  <button>Submit Payment</button>
			</form>
		</div>
	</div>

	<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
	<script src="https://js.stripe.com/v3/"></script>
	<script src="assets/js/script.js"></script>	
</body>
</html>