<!DOCTYPE html>
<html lang="en">

<head>
	<title> Log In </title>
	<meta charset ="utf-8">
	<meta name="author" content="Gillian Tan">
	<meta name="descrtiption" content="ETMP login">
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
	$password = $_POST["pass"];
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	$query= "SELECT * FROM users WHERE user_email='$email'";	// Check if email exist in database
	$results= mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($results);		
	
	if((mysqli_num_rows($results)) > 0) {			// Check if email exist in database
		if( $row['password']==$password)			// Check if password is match
		{
			// Saving important data into Session
			$_SESSION["user_name"] = $row["user_name"];
			$_SESSION["user_id"] = $row["user_id"];
			$_SESSION["user_email"] = $row["user_email"];
			header("Location: search.php");	
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

	<form action="login.php" method="post">
		<!-- login form -->
		<div class="container">
			<h1>Log in</h1>

			<hr>
	
			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required><?php echo $errEmail ?><br> 

			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" id="pass" required><?php echo $errPass ?>

			<hr>
			<p><a href="#">Forgot password</a>.</p>

			<button type="submit" class="loginbtn" name="login">Log In</button>
		</div>
	</form>

</body>
</html>