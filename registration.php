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
	$name = $email = $client_category = $pass = $repeat = "";
	$nameer = $emailer = $passer = $confirmer = "";
	
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["register_acc"])) {  
	$nameer = NameCheck();							// Checking name input
	$emailer = EmailCheck();							// Checking email input
	$passer = PasswordCheck();							// Checking password input
	$confirmer = ConfirmCheck();						// Checking confirm password input
	if($nameer=="" && $emailer=="" && $passer=="" && $confirmer=="")		// If the string is empty then it mean no error
	{	
		$name = $_POST["name"];
		$email = $_POST["email"];
		$pass = $_POST["pass"];
		
		// Insert the record
		$adding= "INSERT INTO users (user_name, user_email, password) VALUES 
		('$name','$email','$pass');";
		$queryResult=mysqli_query($conn,$adding);
		$query = "SELECT * FROM users WHERE user_email='$email'";	// Check if the the email exist in the database
		$results= mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($results);
		// Assign the Session variable so the page it direct can recieve the info
		$_SESSION["user_name"] = $row["user_name"];
		$_SESSION["user_id"] = $row["user_id"];
		$_SESSION["user_email"] = $row["user_email"];
		header("Location: add_personal_detail.php");
	}
}

function NameCheck()
{
	$name = $_POST["name"];
	if (!preg_match ("/^[a-zA-Z\s]+$/",$name)){			// Checking the name format, it can only contain letter
		return "Name can only contain letter ";
	}
		
	
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
		if((mysqli_num_rows($results))>0)
		{
			return "The input mail already exist";
		}
	}
}

function PasswordCheck()
{
	$pass = $_POST["pass"];
	if (preg_match('/^[a-zA-Z0-9]+/', $pass) == false) {	// Check password input, it must only contain letters and numbers
      return "Invalid Password format";
	}
}

function ConfirmCheck()
{	// Checking if teh confirm password input is exactly match the password input
	$confirm = $_POST["repeat"];
	$pass = $_POST["pass"];
	if ($confirm != $pass)
	{
		return "The confirm password and the password does not match";
	}
}

?>
	<!-- registration form -->
	<form action="registration.php" method="post">
		<div class="container">
			<h1>Sign Up</h1>

			<hr>

			<input type="radio" name="client_category" value="individual" required> Individual</input>
			<input type="radio" name="client_category" value="company" required>Company</input>
		
			<br><br><label for="name"><b>Name</b></label>
			<input type="name" placeholder="Enter Name" name="name" id="name" required><span style="color:red"><?php echo $nameer ?></span><br>
	
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span><br>

			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" id="pass" required><span style="color:red"><?php echo $passer ?></span><br>

			<label for="repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="Repeat Password" name="repeat" id="repeat" required><span style="color:red"><?php echo $confirmer ?></span><br>
			<hr>
			<p>By creating an account, you are agreeing to our <a href="#">Terms & Conditions</a>.</p>

			<button type="submit" class="registerbtn" name="register_acc">Register</button>
		</div>
	</form>
	</body>
</html>