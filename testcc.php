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
<?php include('ccvalidation.php'); ?>
</header>

<body>
   <h2>Validate Credit Card</h2>

	<form name="frmCC" action="testcc.php" method="POST">
	
		Cardholders name: <input type="text" name="ccName"><br>
		Card number: <input type="text" name="ccNum"><br>
		Card type: 
			<select name="ccType">
				<option value="1">mastercard</option>
				<option value="2">Visa</option>
		   </select><br>
	   Expiry Date: 
		<select name="ccExpM">
		   <?php
			for($i = 1; $i < 13; $i++){
				echo '<option>' . $i . '</option>';
			}
			?>
		</select>
		
		<select name="ccExpY">
			<?php
				for($i = 2021; $i < 2031; $i++){
					echo '<option>' . $i . '</option>';
				}
			?>
		</select><br><br>

	<input type="submit" class="loginbtn" name="submit" value="Validate">

	</form>
	
<?php

	if($_SERVER["REQUEST_METHOD"] == "POST"){
	
		// Check if the card is valid
		// $cc = new CCreditCard($ccName, $ccType, $ccNum, $ccExpM, $ccExpY);
		$cc = new CCreditCard($_POST["ccName"], $_POST["ccType"], $_POST["ccNum"], $_POST["ccExpM"], $_POST["ccExpY"]);
		// echo "<pre>";
		// var_dump($_POST);
		// echo "</pre>";exit();
?>

		<h2>Validation Results</h2>

		<b>Name: </b><?=$cc->Name(); ?><br>
		<b>Number: </b><?=$cc->SafeNumber('x', 6); ?><br>
		<b>Type: </b><?=$cc->Type(); ?><br>
		<b>Expires: </b><?=$cc->ExpiryMonth() . '/' .$cc->ExpiryYear(); ?><br><br>

	<?php
		
		if($cc->IsValid()) {
			echo '<font color="blue" size="2"><b>';
			echo 'VALID CARD';
		} else {
			echo '<font color="red" size="2"><b>';
			echo 'INVALID CARD';
		}
		echo '</b></font>';
	}
	?>
</body>
</html>