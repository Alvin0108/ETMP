<!DOCTYPE html>
<html lang="en">

<head>
	<title> Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="admin registration">
	<meta name="keywords" content="ETMP, account registration">
	<link rel="stylesheet" href="style/style.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
<?php
session_start();
	//declare variables
	$email = $pass = $repeat = "";
	$emailer = $passer = $confirmer = "";
	
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["register_acc"])) {  
	$emailer = EmailCheck();							// Checking email input
	$passer = PasswordCheck();							// Checking password input
	$confirmer = ConfirmCheck();						// Checking confirm password input
	if($emailer=="" && $passer=="" && $confirmer=="")		// If the string is empty then it mean no error
	{		
		$email = $_POST["email"];
		$pass = $_POST["pass"];
		$pass = hash('sha256',$pass);
		// Insert the record
		$adding= "INSERT INTO admin (admin_email, admin_password) VALUES 
		('$email','$pass')";
		$queryResult=mysqli_query($conn,$adding);
		$query = "SELECT * FROM admin WHERE admin_email='$email'";	// Check if the the email exist in the database
		$results= mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($results);
		// Assign the Session variable so the page it direct can recieve the info
		$_SESSION["admin_id"] = $row["admin_id"];
		$_SESSION["admin_email"] = $row["admin_email"];
		header("Location: admin_dashboard.php");		
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
		$query= "SELECT * FROM admin WHERE admin_email='$email'";
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
	<form action="admin_registration.php" method="post">
		<div class="container">
			<h1>Sign Up as Admin</h1>
			<hr>	
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span><br>

			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" id="pass" required><span style="color:red"><?php echo $passer ?></span><br>

			<label for="repeat"><b>Repeat Password</b></label>
			<input type="password" placeholder="Repeat Password" name="repeat" id="repeat" required><span style="color:red"><?php echo $confirmer ?></span><br>
			<hr>
			<p>By creating an account, you are agreeing to our <a href="#">Terms & Conditions</a>.</p>
			<p>Log in as admin <i class="fa fa-hand-o-right"><a href="admin_login.php"> Login </a></i></p>

			<button type="submit" class="registerbtn" name="register_acc">Register</button>
		</div>
	</form>
	</body>
</html>