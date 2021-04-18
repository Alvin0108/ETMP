<!DOCTYPE html>
<html lang="en">

<head>
	<title> ETMP Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Gillian Tan">
	<meta name="descrtiption" content="ETMP registration">
	<meta name="keywords" content="ETMP, account registration">
	<link rel="stylesheet" href="style/style.css">
</head>

	<body>
<?php
	//declare variables
	$name = $email = $client_category = $password = $repeat = "";
	$nameer = $emailer = $passer = $confirmer = "";
	$invalid = true;
	
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["register_acc"])) {  
	$nameer = NameCheck();							// Checking name input
	$emailer = EmailCheck();							// Checking email input
	$passer = PasswordCheck();							// Checking password input
						// Checking confirm password input

	if ($emailer=="" && $nameer==""){
		$email = $_POST["email"];
		$name = $_POST["name"];
		$sql = "UPDATE users SET user_name='$name' WHERE user_email='$email'";
		if (mysqli_query($conn, $sql)) {
		  echo "Record updated successfully";
		} else {
		  echo "Error updating record: " . mysqli_error($conn);
		}
	}
	if ($emailer=="" && $passer==""){
		$email = $_POST["email"];
		$pass = $_POST["pass"];
		$sql = "UPDATE users SET password='$pass' WHERE user_email='$email'";
		if (mysqli_query($conn, $sql)) {
		  echo "Record updated successfully";
		} else {
		  echo "Error updating record: " . mysqli_error($conn);
		}
	}
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
	<!-- registration form -->
	<form action="account.php" method="post">
		<div class="container">
			<h1>Account edit</h1>

			<hr>

			<input type="radio" name="client-category" value="individual" required> Individual</input>
			<input type="radio" name="client-category" value="company" required>Company</input>
			
			<br><br><label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span><br>
		
			<label for="name"><b>Name</b></label>
			<input type="name" placeholder="Enter Name" name="name" id="name" required><span style="color:red"><?php echo $nameer ?></span><br>
	

			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" id="pass" required><span style="color:red"><?php echo $passer ?></span><br>


			<hr>
			<p>By changing account information, you are agreeing to our <a href="#">Terms & Conditions</a>.</p>

			<button type="submit" class="registerbtn" name="register_acc">Change</button>
		</div>
	</form>
	</body>
</html>