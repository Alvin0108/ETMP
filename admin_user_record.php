<?php 
session_start();
$admin_email = $admin_id = "";
$admin_email = $_SESSION["admin_email"];
$admin_id = $_SESSION["admin_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> Expert.com </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="training record">
	<meta name="keywords" content="ETMP, training record">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>

<header>
	<?php include ("admin_navigation.php"); ?>
</header>

<body>
	<?php
	
	//Dclare variable
	$name = $email = $password =  $desc = $gender = "";
	$emailerr = "";
	
	//Variable to autofill if data exist
	$namer = $emailr = $passwordr =  $descr = $genderr = "";
	$conn = mysqli_connect("localhost","root","","portal_database");//Connect to database
		
	if(isset($_POST["add"])) 
	{ 

		$emailerr = EmailCheck();
		
		$name = $_POST['name'];
		$email = $_POST['email'];
		$password = $_POST['password'];
		$password = hash('sha256',$password);
		$desc = $_POST['desc'];
		$gender = $_POST['gender'];

		
		if($emailerr=="")
		{
			// Insert the record
			$adding = "INSERT INTO users (user_name, user_email, password, description, gender) 
			VALUES ('$name','$email','$password','$desc','$gender');";
			$queryResult=mysqli_query($conn,$adding);
			echo "<script>alert('Success adding new record')</script>";
		}
		
		else
		{
			$namer = $_POST['name'];
			$emailr = $_POST['email'];
			$passwordr = $_POST['password'];
			$descr = $_POST['desc'];
			$genderr = $_POST['gender'];
			echo "<script>alert('User email exist')</script>";
			
		}
	}

	function EmailCheck()
	{
		$email = $_POST["email"];
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) 
		{		
			// Check email input, it must fit the standard email format
			return "Invalid email format ";
		}
		
		else 
		{
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
	
	?>
	
	<!-- registration form -->
	<br/><br/><br/><br/><br/>
	<section class="section">
		<div class="container">
			<form action="admin_user_record.php" method="post">
				<div class="center">
					<h2>Add New User Record</h2>
					<hr>
						<fieldset>
							<br/><label for="name"><b>User Name</b></label>
							<input type="name" placeholder="User Name" name="name" id="name" value="<?php echo $namer;?>" required><br><br/>

							<label for="email"><b>Email</b></label>
							<input type="email" placeholder="User Email" name="email" id="email" value="<?php echo $emailr;?>" required><br><br/>
							
							<label for="password"><b>Password</b></label>
							<input type="password" placeholder="User password" name="password" id="password" value="<?php echo $passwordr;?>" required><br><br/>

							<label for="desc"><b>Description</b></label>
							<input type="desc" placeholder="About" name="desc" id="desc" value="<?php echo $descr;?>" required><br><br/>
							
							<label for="gender"><b>Gender</b></label>
							<input type="radio" id="male" name="gender" value="male" required>
							<label for="male">Male</label>
							<input type="radio" id="female" name="gender" value="female" required>
							<label for="female">Female</label>
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
						<br/>
						<hr>
				</div>
			<div class="center">
				<button type="submit" class="register_acc" name="add">Add Record</button>
			</div>
			</form>
		</div>
	</section>
	<br/><br/>
	
	
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
