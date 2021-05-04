<!DOCTYPE html>
<html lang="en">

<head>
	<title> ETMP Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Chen Jun Xue">
	<meta name="descrtiption" content="ETMP CreditCardValidation">
	<meta name="keywords" content="ETMP, card validation">
	<link rel="stylesheet" href="style/style.css">
</head>

<header>
		
	<!-- ETMP logo -->	
	<img src="image/logo.png" alt="logo" class ="logo" width=10% height=auto>
	
	
	<nav class="topnav">
	<ul class="nav-links">
            <li>
                <a class="nav-link" href="homepage.html">Home</a>
            </li>
            <li>
                <a class="nav-link" href="#">Training</a>
            </li>
			<li>
                <a class="nav-link" href="#">About</a>
            </li>
            <li>
                <a class="nav-link" href="login.php">Sign In</a>
            </li>
        </ul>
	</nav>
	<a class="nav-link-active" href="registration.html"><button class="create-button">Create Account</button></a>



</header>

<body>
<?php
session_start();
	//declare variables
	$num = $cvv = $card_type = $pin = $repeat = "";
	$numc = $cvvc = $pinc = "";
	
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["card_validation"])) {  

	if (!empty($_POST["card_type"])) {
	$card_type = $_POST["card_type"];
	}

	$numc = CardNumCheck();							// Checking card number input
	$cvvc = CVVCheck();							// Checking cvv input
	$pinc = PinNumCheck();							// Checking pin number input
	if($numc=="" && $cvvc=="" && $pinc=="" )		// If the string is empty then it mean no error
	{		
		$num = $_POST["num"];
		$cvv = $_POST["cvv"];
		$pin = $_POST["pin"];
	}
}

function CardNumCheck()
{
	$num = $_POST["num"];
	if (!preg_match ('/^[0-9]+/',$num)){			// Checking card number format
		return "Invalid card number format ";
	}
		
}

function CVVCheck()
{
	$cvv = $_POST["cvv"];
	if (preg_match('/^[0-9]+/', $cvv) == false) {	// Check cvv input
      return "Invalid CVV format";
	}
}

function PinNumCheck()
{
	$pin = $_POST["pin"];
	if (preg_match('/^[0-9]+/', $pin) == false) {	// Check pin input
      return "Invalid Pin Number format";
	}
}

?>

	<form action="CreditCardValidation.php" method="post">
		<div class="container">
			<h1>PAYMENT</h1>

			<hr>

			<input type="radio" name="card_type" value="debit" required> Debit Card</input>
			<input type="radio" name="card_type" value="credit" required>Credit Card</input>
		
			<br><br><label for="num"><b>Card Number</b></label>
			<input type="num" placeholder="Enter Card Number" name="num" id="num" required><span style="color:red"><?php echo $numc ?></span><br>
	
			<label for="cvv"><b>CVV</b></label>
			<input type="cvv" placeholder="Enter CVV" name="cvv" id="cvv" required><span style="color:red"><?php echo $cvvc ?></span><br>

			<label for="pin"><b>Pin Number</b></label>
			<input type="pin" placeholder="Enter Pin Number" name="pin" id="pin" required><span style="color:red"><?php echo $pinc ?></span><br>
			<hr>

			<button type="submit" class="continuebtn" name="card_validation">Continue</button>
		</div>
	</form>
	</body>
</html>