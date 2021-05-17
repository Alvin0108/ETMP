<!DOCTYPE html>
<html lang="en">

<head>
	<title> Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="admin registration">
	<meta name="keywords" content="ETMP, account registration">
	
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<!-- main css -->
	<link rel="stylesheet" href="css/sign.css">
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

	
	<form action="admin_registration.php" method="post">
		<div class="main">
			<!-- registration form -->
			<section class="signup">
				<div class="container">
					<div class="signup-content">
	
						<div class="signup-form">
						
							<h2 class="form-title">Expert.com <br>Admin Sign Up</h2>
							
							<form method="POST" class="register-form" id="register-form">	
							
								<div class="form-group"> 
									<label for="email"><i class="zmdi zmdi-email"></i></label>
									<input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span>
								</div>

								<div class="form-group">
									<label for="pass"><i class="zmdi zmdi-lock"></i></label>
									<input type="password" placeholder="Enter Password" name="pass" id="pass" required><span style="color:red"><?php echo $passer ?></span>
								</div>

								<div class="form-group">
									<label for="repeat"><i class="zmdi zmdi-lock-outline"></i></label>
									<input type="password" placeholder="Repeat Password" name="repeat" id="repeat" required><span style="color:red"><?php echo $confirmer ?></span>
								</div>
								
								<div class="form-group">
									<input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
									<label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
								</div>
								
								<div class="form-group">
									<input type="submit" name="register_acc" id="register_acc" class="form-submit" value="Register" required/>
								</div>
							</form>
						</div>	
						
						<div class="signup-image">
							<figure><img src="images/admin-register.png" alt="sign up image"></figure>
							<a href="admin_login.php" class="signup-image-link">Log in as admin</a>
						</div>
						
					</div>
				</div>
			</section>
		</div>
	</form>
	
	<!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
	
	</body>
</html>