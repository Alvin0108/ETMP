<!DOCTYPE html>
<html lang="en">

<head>
	<title> Log In </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="admin login">
	<meta name="keywords" content="ETMP, login">
	<link rel="stylesheet" href="style/style.css">
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

	<form action="admin_login.php" method="post">
		<!-- admin login form -->
		<div class="container">
			<h1>Log in</h1>

			<hr>
	
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required><?php echo $errEmail ?><br> 

			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" id="pass" required><?php echo $errPass ?>

			<hr>	
			<p><a href="#">Forgot password</a></p>
			<p><a href="admin_registration.php">Register new account</a></p>

			<button type="submit" class="loginbtn" name="login">Log In</button>
		</div>
	</form>

</body>
</html>