<!DOCTYPE html>
<html lang="en">

<head>
	<title> ETMP Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Gillian Tan">
	<meta name="descrtiption" content="ETMP registration">
	<meta name="keywords" content="ETMP, account registration">
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
</head>

	<body>
	<?php
	//declare variables
	session_start();
	$name = $email = $client_category = $password = $repeat = $gender = "";
	$nameer = $emailer = $passer = $genderErr = "";
	$invalid = true;
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	
	
	if(isset($_POST["register_acc"])) {  
		
		$nameer = NameCheck();							// Checking name input
		$emailer = EmailCheck();							// Checking email input
		$passer = PasswordCheck();						// Checking password input
		
		$descer = $_POST["desc"];
		if ($emailer=="" && $nameer==""){
			$email = $_POST["email"];
			$name = $_POST["name"];
			$sql = "UPDATE users SET user_name='$name' WHERE user_email='$email'";
			if (!mysqli_query($conn, $sql)) {
			  echo "Error updating record: " . mysqli_error($conn);
			}
		}
		
		if ($emailer=="" && $passer==""){
			$email = $_POST["email"];
			$pass = $_POST["pass"];
			$pass = hash('sha256',$pass);
			$sql = "UPDATE users SET password='$pass' WHERE user_email='$email'";
			if (!mysqli_query($conn, $sql)) {
			  echo "Error updating record: " . mysqli_error($conn);
			}
		}
		
		if ($emailer=="" && $descer!=""){
			$email = $_POST["email"];
			$sql = "UPDATE users SET description='$descer' WHERE user_email='$email'";
			if (!mysqli_query($conn, $sql)) {
			  echo "Error updating record: " . mysqli_error($conn);
			}
		}
		
		if (isset($_POST["gender"])) {
			$gender = $_POST["gender"];
			$sql = "UPDATE users SET gender='$gender' WHERE user_email='$email'";
			if (!mysqli_query($conn, $sql)) {
			  echo "Error updating record: " . mysqli_error($conn);
			}
		}
	
		$query = "SELECT * FROM users WHERE user_email='$email'";	// Check if the the email exist in the database
		$results= mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($results);
		
		// Assign the Session variable so the page it direct can recieve the info
		$_SESSION["user_name"] = $row["user_name"];
		$_SESSION["user_id"] = $row["user_id"];
		$_SESSION["user_email"] = $row["user_email"];
		header("Location: profile.php");
		mysqli_close($conn);
	}

	function NameCheck()
	{
		$name = $_POST["name"];
		if (!preg_match ("/^[a-zA-Z\s]+$/",$name)){			// Checking the name format, it can only contain letter
			return "Name can only contain letter ";
		}
		if ($name == "") {return "No Changed";}
	}

	function EmailCheck()
	{
		$email = $_POST["email"];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		// Check email input, it must fit the standard email format
		  return "Invalid email format ";
		}
		else {
			$mysqli = mysqli_connect("localhost","root","","portal_database");
			$query= "SELECT * FROM users WHERE user_email='$email'";
			$results= mysqli_query($mysqli, $query);
			// Checking if the same email already exist in the database
			if((mysqli_num_rows($results))==0)
			{
				return "Mail cannot be found";
			}
		}
	}

	function PasswordCheck()
	{
		$pass = $_POST["pass"];
		if (preg_match('/^[a-zA-Z0-9]+/', $pass) == false) {	// Check password input, it must only contain letters and numbers
		  return "Invalid Password format";
		}
		if ($pass == "") {return "No Changed";}
	}
	?>
	
	
	<section class="section" id="about">
		<form action="account.php" method="post">
			<div class="container">
				<h2>Personal Information</h2>

				<hr>
				<br><br><label for="email"><b>Email</b></label>
				<input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span><br>
			
				<label for="name"><b>Name</b></label>
				<input type="name" placeholder="Enter Name" name="name" id="name" ><span style="color:red"><?php echo $nameer ?></span><br>
		

				<label for="pass"><b>Password</b></label>
				<input type="password" placeholder="Enter Password" name="pass" id="pass" ><span style="color:red"><?php echo $passer ?></span><br>

				<label for="desc"><b>Description</b></label>
				<input type="text" placeholder="Enter Description" name="desc" id="desc" ><span style="color:red"></span><br>

				<br><br>Gender:
				<input type="radio" name="gender" value="female">Female
				<input type="radio" name="gender" value="male">Male
				<input type="radio" name="gender" value="other">Other  
				<span class="error">* <?php echo $genderErr;?></span>
				<br><br>
				<hr>
				<p>By changing account information, you are agreeing to our <a href="#">Terms & Conditions</a>.</p>
					
				<style>
				input {
					width: 100%;
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
				
				<button type="submit" class="registerbtn" name="register_acc">Change</button>
			</div>
		</form>
	</section>

	
</body>
</html>