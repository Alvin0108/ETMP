<!DOCTYPE html>
<html lang="en">

<head>
	<title> ETMP Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Chen Jun Xue">
	<meta name="descrtiption" content="ETMP Online Banking">
	<meta name="keywords" content="ETMP, online banking">
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
	<a class="nav-link-active" href="registration.html"><button class="create-button">Create accnoount</button></a>



</header>

<body>
<?php
session_start();
	//declare variables
	$accno = $name = $bank_name = $amount = $repeat = "";
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
	if (!preg_match ('/^[0-9]+/',$accno)){			// Checking account format
		return "Invalid account number format ";
	}
		
}

function NameCheck()
{
	$name = $_POST["name"];
	if (preg_match("/^[a-zA-Z\s]+$/",$name) == false) {	// Check name input
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

	<form action="OnlineBanking.php" method="post">
		<div class="container">
			<h1>PAYMENT</h1>

			<hr>
			<h2>Transfer From</h2>
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
			
			<h2>Transfer To</h2>
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
			
			<button type="submit" class="continuebtn" name="card_validation">Continue</button>
		</div>
	</form>
	</body>
</html>