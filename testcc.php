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
	
	<!-- Header Area Start -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
				
                    <nav class="main-nav">
                        <!-- Logo Start -->
                        <a href="#" class="logo">Expert.com</a>
                        <!-- Logo End -->
						
                        <!-- Menu Start -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="search.php">Training Search</a></li>
                            <li ><a href="profile.php" >Profile</a></li>
                            <li ><a href="logout.php">Log Out</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- Menu End -->
                    </nav>
					
                </div>
            </div>
        </div>
    </header>
	
	
	<!-- cc section -->
	<section class="section" id="about">
		<div class="container">
			<form name="frmCC" action="testcc.php" method="POST">
				<div class="center">
			
					<h2>Profile / Credit Card Validation </h2>
					<hr>
				
					<fieldset>
						<br><label><b>Cardholder Name</b></label>
						<input type="text" name="ccName"><br>
						
						<br><label><b>Card Number</b></label>
						<input type="text" name="ccNum"><br>
					
						<br><label><b>Card Type</b></label> 
							<select name="ccType">
								<option value="1">Mastercard</option>
								<option value="2">Visa</option>
						   </select><br>
					   
						<br><label><b>Expire Date</b></label>
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
					</fieldset>
					<style>
			
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
			  
			.validatebtn{
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
								
			.validatebtn:hover{
				background-color: #0088e8;
				cursor: pointer;
			}
			</style>
			<br>
			<hr>
			</div>
			</form>
				<div class="center">
					<input type="submit" class="validatebtn" name="submit" value="Validate">
				</div>
			</div>
		</section>
		
	
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
	
	
	<!-- jQuery -->
    <script src="js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="js/owl-carousel.js"></script>
    <script src="js/scrollreveal.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imgfix.min.js"></script> 
    
    <!-- Global Init -->
    <script src="js/custom.js"></script>
	
	
</body>
</html>