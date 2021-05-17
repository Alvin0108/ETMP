<!DOCTYPE html>
<html lang="en">

<head>
	<title> ETMP Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Chen Jun Xue">
	<meta name="descrtiption" content="ETMP CreditCardValidation">
	<meta name="keywords" content="ETMP, card validation">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>

<body>
<?php
session_start();
	//declare variables
	$num = $cvv = $card_type = $amount = $pin = $repeat = "";
	$numc = $cvvc = $amoc = $pinc = "";
	
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["card_validation"])) {  

	if (!empty($_POST["card_type"])) {
	$card_type = $_POST["card_type"];
	}

	$numc = CardNumCheck();							// Checking card number input
	$cvvc = CVVCheck();							// Checking cvv input
	$pinc = PinNumCheck();							// Checking pin number input
	$amoc = AmountCheck();
	if($numc=="" && $cvvc=="" && $pinc=="" && $amoc=="" )		// If the string is empty then it mean no error
	{		
		$num = $_POST["num"];
		$cvv = $_POST["cvv"];
		$pin = $_POST["pin"];
		$amo = $_POST["amo"];
	}
}

function CardNumCheck()
{
	$num = $_POST["num"];
	if (!preg_match ("/^[0-9]{16}+/",$num)){			// Checking card number format
		return "Invalid card number format ";
	}
		
}

function CVVCheck()
{
	$cvv = $_POST["cvv"];
	if (preg_match('/^[0-9]{3}+/', $cvv) == false) {	// Check cvv input
      return "Invalid CVV format";
	}
}

function PinNumCheck()
{
	$pin = $_POST["pin"];
	if (preg_match('/^[0-9]{6}+/', $pin) == false) {	// Check pin input
      return "Invalid Pin Number format";
	}
}

function AmountCheck()
{
	$amo = $_POST["amo"];
	if (preg_match('/^[0-9]{6}+/', $amo) == false) {	// Check amount input
      return "Invalid amount format";
	}
}

?>


	<section class="section" id="about">
		<div class="container">
			<form action="payment_success.php" method="post">
				<div class="center">
				
					<h2>Payment </h2>
					<hr>

					<fieldset>
						<br>
						<input type="radio" class="card1" name="card_type" value="debit" required> Master Card</input>
						<input type="radio" class="card2" name="card_type" value="credit" required>Credit Card</input>

						<br><br><label for="num"><b>Card Number</b></label>
						<input type="num" placeholder="Enter Card Number" name="num" id="num" required><span style="color:red"><?php echo $numc ?></span><br>
			
						<label for="cvv"><b>CVV</b></label>
						<input type="cvv" placeholder="Enter CVV" name="cvv" id="cvv" required><span style="color:red"><?php echo $cvvc ?></span><br>
		
						<label for="pin"><b>Pin Number</b></label>
						<input type="pin" placeholder="Enter Pin Number" name="pin" id="pin" required><span style="color:red"><?php echo $pinc ?></span><br>

						<label for="amo"><b>Amount</b></label>
						<input type="amo" placeholder="Enter Amount(RM)" name="amo" id="amo" required><span style="color:red"><?php echo $amoc ?></span><br>
					</fieldset>

					<style>
							
							
							.continuebtn{
								font-size: 13px;
								border-radius: 20px;
								padding: 12px 20px;
								background-color: #f55858;
								text-transform: uppercase;
								color: #fff;
								letter-spacing: 0.25px;
								-webkit-transition: all 0.3s ease 0s;
								-moz-transition: all 0.3s ease 0s;
								-o-transition: all 0.3s ease 0s;
								transition: all 0.3s ease 0s;
								width: 15%;
								text-align: center;
							}
								
							.continuebtn:hover{
								background-color: #0088e8;
								cursor: pointer;
							}
							
							input {
							  width: 85%;
							  display: block;
							  border: none;
							  border-bottom: 1px solid #999;
							  padding: 6px 30px;
							  font-family: Poppins;
							  box-sizing: border-box; }
							  input::-webkit-input-placeholder {
								color: #999; }
							  input::-moz-placeholder {
								color: #999; }
							  input:-ms-input-placeholder {
								color: #999; }
							  input:-moz-placeholder {
								color: #999; }
							  input:focus {
								border-bottom: 1px solid #222; }
								input:focus::-webkit-input-placeholder {
								  color: #222; }
								input:focus::-moz-placeholder {
								  color: #222; }
								input:focus:-ms-input-placeholder {
								  color: #222; }
								input:focus:-moz-placeholder {
								  color: #222; }

							input[type=checkbox]:not(old) {
							  width: 2em;
							  margin: 0;
							  padding: 0;
							  font-size: 1em;
							  display: none; }

							input[type=checkbox]:not(old) + label {
							  display: inline-block;
							  line-height: 1.5em;
							  margin-top: 6px; }

							input[type=checkbox]:not(old) + label > span {
							  display: inline-block;
							  width: 13px;
							  height: 13px;
							  margin-right: 15px;
							  margin-bottom: 3px;
							  border: 1px solid #999;
							  border-radius: 2px;
							  -moz-border-radius: 2px;
							  -webkit-border-radius: 2px;
							  -o-border-radius: 2px;
							  -ms-border-radius: 2px;
							  background: white;
							  background-image: -moz-linear-gradient(white, white);
							  background-image: -ms-linear-gradient(white, white);
							  background-image: -o-linear-gradient(white, white);
							  background-image: -webkit-linear-gradient(white, white);
							  background-image: linear-gradient(white, white);
							  vertical-align: bottom; }

							input[type=checkbox]:not(old):checked + label > span {
							  background-image: -moz-linear-gradient(white, white);
							  background-image: -ms-linear-gradient(white, white);
							  background-image: -o-linear-gradient(white, white);
							  background-image: -webkit-linear-gradient(white, white);
							  background-image: linear-gradient(white, white); }

							input[type=checkbox]:not(old):checked + label > span:before {
							  content: '\f26b';
							  display: block;
							  color: #222;
							  font-size: 11px;
							  line-height: 1.2;
							  text-align: center;
							  font-family: 'Material-Design-Iconic-Font';
							  font-weight: bold; 
							}
						</style>
					<br>
					<hr>
				</div>
			</form>
			<div>
				<button type="submit" class="continuebtn" name="card_validation">Continue</button>
			</div>
		</div>
	</section>
	</body>
</html>