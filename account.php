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
	$name = $email = $client_category = $password = $repeat = "";
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
	<form action="account.php" method="post">
		<div class="container">
			<h1>Account edit</h1>

			<hr>
			<br><br><label for="email"><b>Email</b></label>
			<input type="email" placeholder="Enter Email" name="email" id="email" required><span style="color:red"><?php echo $emailer ?></span><br>
		
			<label for="name"><b>Name</b></label>
			<input type="name" placeholder="Enter Name" name="name" id="name" ><span style="color:red"><?php echo $nameer ?></span><br>
	

			<label for="pass"><b>Password</b></label>
			<input type="password" placeholder="Enter Password" name="pass" id="pass" ><span style="color:red"><?php echo $passer ?></span><br>

			<label for="desc"><b>Description</b></label>
			<input type="text" placeholder="Enter Description" name="desc" id="desc" ><span style="color:red"></span><br>

			<br><br>Gender:
			<input type="radio" name="gender" value="female">Female
			<input type="radio" name="gender" value="male">Male
			<input type="radio" name="gender" value="other">Other  
			<span class="error">* <?php echo $genderErr;?></span>
			<br><br>
			<hr>
			<p>By changing account information, you are agreeing to our <a href="#">Terms & Conditions</a>.</p>

			<button type="submit" class="registerbtn" name="register_acc">Change</button>
		</div>
	</form>
	</body>
</html>