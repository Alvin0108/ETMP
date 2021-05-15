<!DOCTYPE html>
<html lang="en">

<head>
	<title> Account Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Gillian Tan">
	<meta name="descrtiption" content="ETMP login">
	<meta name="keywords" content="ETMP, login">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<!-- main css -->
	<link rel="stylesheet" href="css/sign.css">
</head>

<body>

	<?php
	session_start();
		//declare variables
		$name = $email = $pass = $repeat = "";
		$nameer = $emailer = $passer = $confirmer = "";
		
		$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	if(isset($_POST["signup"])) {  

		$nameer = NameCheck();							// Checking name input
		$emailer = EmailCheck();							// Checking email input
		$passer = PasswordCheck();							// Checking password input
		$confirmer = ConfirmCheck();						// Checking confirm password input
		if($nameer=="" && $emailer=="" && $passer=="" && $confirmer=="")		// If the string is empty then it mean no error
		{		
			$name = $_POST["name"];
			$email = $_POST["email"];
			$pass = $_POST["pass"];
			$pass = hash('sha256',$pass);
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
	
	<form action="registration.php" method="post">
	<div class="main">
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" class="register-form" id="register-form">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="name" id="name" placeholder="Your Name"/><?php echo $nameer?>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/><?php echo $emailer ?>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/><?php echo $passer ?>
                            </div>
                            <div class="form-group">
                                <label for="rerepeatpass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="repeat" id="repeat" placeholder="Repeat your password"/><?php echo $confirmer ?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signup" id="signup" class="form-submit" value="Register" required/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="image/signup-image.jpg" alt="sing up image"></figure>
                        <a href="login.php" class="signup-image-link">I am already a member</a>
                    </div>
                </div>
            </div>
        </section>
	</form>


	<!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
	
</body>
</html>
