<!DOCTYPE html>
<html lang="en">

<head>
	<title> Online Banking </title>
	<meta charset ="utf-8">
	<meta name="author" content="Chen Jun Xue">
	<meta name="descrtiption" content="ETMP Online Banking">
	<meta name="keywords" content="ETMP, online banking">
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
	$accno = $name = $amount = "";
	$accnoc = $namec = $amountc = "";
	
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["online_banking"])) {  

	if (!empty($_POST["bank_name"])) {
	$bank_name = $_POST["bank_name"];
	}

	$accnoc = AccNoCheck();							// Checking account number input
	$namec = NameCheck();							// Checking name input
	$amountc = AmountCheck();							// Checking amount input
	if($accnoc=="" && $namec=="" && $amountc=="" )		// If the string is empty then it mean no error
	{		
		$accno = $_POST["accno"];
		$name = $_POST["name"];
		$amount = $_POST["amount"];
	}
	header("Location: payment_success.php");
}

function AccNoCheck()
{
	$accno = $_POST["accno"];
	if (preg_match ('/^[a-zA-Z0-9]+/',$accno)== false){			// Checking account format
		return "Invalid account number format ";
	}
		
}

function NameCheck()
{
	$name = $_POST["name"];
	if (!preg_match("/^[a-zA-Z\s]+$/",$name)) {	// Check name input
      return "Invalid name format";
	}
}

function AmountCheck()
{
	$amount = $_POST["amount"];
	if (preg_match('/^[0-9]+/', $amount) == false) {	// Check amount input
      return "Invalid amount format";
	}
}

?>
<form action="payment_success.php" method="post">
	<section class="section" id="about">
		<div class="container">
			
				<div class="center">
			
					<h2>Payment </h2>
					<hr>

					<fieldset>
						<br>
						<input type="radio" name="bank_name" value="RHB" required> RHB</input>
						<input type="radio" name="bank_name" value="May" required>May Bank</input>
						<input type="radio" name="bank_name" value="HongLeong" required> Hong Leong Bank</input>
						<input type="radio" name="bank_name" value="Citi" required>Citibank</input>
						<input type="radio" name="bank_name" value="Public" required> Public Bank</input>
						<input type="radio" name="bank_name" value="CIMB" required>CIMB</input>
		
						<br><br><label for="accno"><b>Bank Account</b></label>
						<input type="accno" placeholder="Enter Bank Account" name="accno" id="accno" required><span style="color:red"><?php echo $accnoc ?></span><br>
	
						<label for="name"><b>Name</b></label>
						<input type="name" placeholder="Enter name" name="name" id="name" required><span style="color:red"><?php echo $namec ?></span><br>

						<label for="amount"><b>Amount</b></label>
						<input type="amount" placeholder="Enter Amount(RM)" name="amount" id="amount" required><span style="color:red"><?php echo $amountc ?></span><br>
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
							  font-weight: bold; }
							 
							
														
						</style>
					<br>
					<hr>
				</div>
			</form>
			<div>
				<button type="submit" class="continuebtn" name="onlinebanking">Continue</button>
			</div>
		</div>
	</section>
	</body>
</html>