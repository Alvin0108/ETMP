<!DOCTYPE html>
<html lang="en">

<head>
	<title> Log In </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="admin login">
	<meta name="keywords" content="ETMP, login">
	
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<!-- main css -->
	<link rel="stylesheet" href="css/sign.css">
	
</head>

<body>

<?php 
session_start();
$email = $password = "";
$errEmail = $errPass = "";
if(isset($_POST['login'])) {		
	$email = $_POST['email'];
	$password = hash('sha256',$_POST["pass"]);
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	$query= "SELECT * FROM admin WHERE admin_email='$email'";	// Check if email exist in database
	$results= mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($results);		
	
	if((mysqli_num_rows($results)) > 0) {			// Check if email exist in database
		if( $row['admin_password']==$password)			// Check if password is match
		{
			// Saving important data into Session
			$_SESSION["admin_id"] = $row["admin_id"];
			$_SESSION["admin_email"] = $row["admin_email"];
			header("Location: admin_dashboard.php");	
		}
		else
		{
			$errPass = "Password not correct";
		}
	}	
	else
	{
		$errEmail =  "Email not found";
	}
}
?>

		<style>
		.logo{
			color #1e1e1e !important;
			line-height: 80px;
			color: black;
			font-size: 28px;
			font-weight: 700;
			text-transform: uppercase;
			letter-spacing: 2px;
			float: left;
			text-decoration: none !important;
			margin-left: 20%;
			padding-top: 30px;
			
		}
	</style>

	<form action="admin_login.php" method="post">
		<div class="main">
			<!-- admin login form -->
			<section class="sign-in">
				<div class="container">
					<div class="signin-content">
						<div class="signin-image">
							<a href="#" class="logo">Expert.com</a>
							<figure><img src="images/admin-login.png" alt="sign in image"></figure>
							<a href="admin_registration.php" class="signup-image-link">Create new admin account</a>
						</div>
						
						<div class="signin-form">
						
							<h2 class="form-title">Admin Log in</h2>
							
							<form method="POST" class="register-form" id="login-form">
							
								<div class="form-group">
									<label for="email"><i class="zmdi zmdi-email"></i></label>
									<input type="email" placeholder="Enter Email" name="email" id="email" required><?php echo $errEmail ?>
								</div>

								<div class="form-group">
									<label for="pass"><i class="zmdi zmdi-lock"></i></label>
									<input type="password" placeholder="Enter Password" name="pass" id="pass" required><?php echo $errPass ?>
								</div>

								<div class="form-group">
									<a href="#">Forgot password</a>
								</div>
	
								<div class="form-group">
									<input type="submit" name="login" id="login" class="form-submit" value="Log In" required/>
								</div>
							</form>
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
