<?php 
session_start();
$user_email = $user_ID = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Profile </title>
	<meta charset ="utf-8">
	<meta name="descrtiption" content="php">
	<meta name="author" content="Alvin Chua Khai Chuen" />
	<meta name="keywords" content="ETMP">
	<link rel="stylesheet" href="style/style.css">
</head>
	<header>
	<!--navigation-->
	<?php include "navigation.php";?>

	</header>
	<body>
	<?php
		$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
		//Declare variable
		$desc = $gender = "";
		$query = "SELECT * FROM users WHERE user_email='$user_email'";
		$results= mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($results);
		// Assign the Session variable so the page it direct can recieve the info
		$desc = $row["description"];
		$gender = $row["gender"];
	?>
	<!-- registration form -->
	<form action="registration.php" method="post">
		<div class="center">
			<h1>Personal Information</h1>
			<hr>
		
			<br><label for="name"><b>Name</b></label>
			<input type="name" name="name" id="name" value=<?php echo $user_name ?> disabled><br>
	
			<label for="email"><b>Email</b></label>
			<input type="email" name="email" id="email" value=<?php echo $user_email ?> disabled><br>

			<label for="gender"><b>Gender</b></label>
			<input type="gender" name="gender" id="gender" value=<?php echo $gender ?> disabled><br>
			
			<label for="desc"><b>About</b></label>
			<input type="desc" name="desc" id="desc" value=<?php echo $desc ?> disabled><br>

			<br>
			<hr>
			</div>
	</form>
	<div class="center">
		<a href="account.php" class="tab">Edit Account</a>
		<a href="registered_training.php" class="tab">View Registered Training</a>
	</body>
</html>