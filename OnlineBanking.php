<!DOCTYPE html>
<html lang="en">

<head>
	<title> Online Banking </title>
	<meta charset ="utf-8">
	<meta name="author" content="Chen Jun Xue">
	<meta name="descrtiption" content="ETMP Online Banking">
	<meta name="keywords" content="ETMP, online banking">
	<link rel="stylesheet" href="style/style.css">
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
		<div class="container">
			<h1>PAYMENT</h1>

			<hr>
			
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
			<hr>
			
			<button type="submit" class="loginbtn" name="onlinebanking">Continue</button>
		</div>
	</form>
	</body>
</html>