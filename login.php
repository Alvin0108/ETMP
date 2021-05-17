<!DOCTYPE html>
<html lang="en">

<head>

	<title> Sign In </title>
	<meta charset ="utf-8">
	<meta name="author" content="Gillian Tan">
	<meta name="descrtiption" content="ETMP login">
	<meta name="keywords" content="ETMP, login">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<link rel="stylesheet" href="css/sign.css">
	
</head>

<body>

	<?php 
	session_start();
	$email = $password = "";
	$errEmail = $errPass = "";
	if(isset($_POST['signin'])) {		
		$email = $_POST['email'];
		$password = hash('sha256',$_POST["pass"]);
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
	<div class="main">
	<!-- Sing in  Form -->
    <section class="sign-in">
            <div class="container">
                <div class="signin-content">
				
                    <div class="signin-image">
                        <figure><img src="images/signin-image.jpg" alt="sing up image"></figure>
                        <a href="registration.php" class="signup-image-link">Create an account</a>
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Expert.com <br>Sign In</h2>
                        <form method="POST" class="register-form" id="login-form">
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="email" id="email" placeholder="Your Email"/><?php echo $errEmail ?>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="pass" id="pass" placeholder="Password"/><?php echo $errPass ?>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                            </div>
                        </form>
                        <div class="social-login">
                            <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul>
                        </div>
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
