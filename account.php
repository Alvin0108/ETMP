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
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
	
</head>

	<body>
	
	<!-- Header Area Start -->
    <header class="header-area header-sticky">
        <div class="container">
            <div class="row">
                <div class="col-12">
				
                    <nav class="main-nav">
                        <!-- Logo Start -->
                        <a href="#" class="logo">Expert.com</a>
                        <!-- Logo End -->
						
                        <!-- Menu Start -->
                        <ul class="nav">
                            <li class="scroll-to-section"><a href="search.php">Training Search</a></li>
                            <li ><a href="profile.php" >Profile</a></li>
                            <li ><a href="logout.php">Log Out</a></li>
                        </ul>
                        <a class='menu-trigger'>
                            <span>Menu</span>
                        </a>
                        <!-- Menu End -->
                    </nav>
					
                </div>
            </div>
        </div>
    </header>
	
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
s
	
	<section class="section" id="about">
        <div class="container">
		
        <form>
		<div class="center">
			<h2>Profile / Edit Profile </h2>
			<hr>
			<fieldset>
				<br><label><b>Name</b></label>
				<input type="text" placeholder="Enter Name" name="name" id="name" ><span style="color:red"><?php echo $nameer ?></span><br/><br/>
				
				<label><b>Email</b></label>
                <input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span><br/><br/>
				
				<label><b>Password</b></label>
                <input type="password" placeholder="Enter Password" name="pass" id="pass" ><span style="color:red"><?php echo $passer ?></span><br/><br/>
			
				<label><b>About</b></label>
				<input type="text" placeholder="Enter Description" name="desc" id="desc" ><span style="color:red"></span><br/><br/>
				
				<input  class="gender" type="radio" id="male" name="gender" value="male" required>
				<label class="gender-male" for="male">Male</label>
				<input class="gender" type="radio" id="female" name="gender" value="female" required>
				<label class="gender-female" for="female">Female</label>
				<span class="error">* <?php echo $genderErr;?></span>
				
			</fieldset>
							<style>
							.register_acc{
								font-size: 13px;
								border-radius: 20px;
								padding: 12px 20px;
								background-color: #f55858;
								text-transform: uppercase;
								color: #fff;
								letter-spacing: 0.25px;
								-webkit-transition: all 0.3s ease 0s;
								-moz-transition: all 0.3s ease 0s;
								-o-transition: all 0.3s ease 0s;
								transition: all 0.3s ease 0s;
								width: 15%;
								text-align: center;
							}
								
							.register_acc:hover{
								background-color: #0088e8;
								cursor: pointer;
							}
							
							input {
							  width: 85%;
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
						<br>
						<hr>
			</div>
			</form>
			<div class="center">
                    <input  "type="submit" name="signup" id="signup" class="register_acc" value="Save Changes" />
			</div>
			</div>
		</section>
		
 <!-- jQuery -->
    <script src="js/jquery-2.1.0.min.js"></script>

    <!-- Bootstrap -->
    <script src="js/popper.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!-- Plugins -->
    <script src="js/owl-carousel.js"></script>
    <script src="js/scrollreveal.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/imgfix.min.js"></script> 
    
    <!-- Global Init -->
    <script src="js/custom.js"></script>

	
</body>
</html>