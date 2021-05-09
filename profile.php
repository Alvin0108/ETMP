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
		
		$sql = "SELECT count(training_id) AS total FROM registration WHERE user_id='$user_ID'";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_fetch_assoc($result);
		$total = $num['total'];
		
		// Assign the Session variable so the page it direct can recieve the info
		$desc = $row["description"];
		$gender = $row["gender"];
		
	?>
	<form>
		<div class="center">
			<h2>Profile</h2>
			<hr>
			<fieldset>
			<legend>Personal Information</legend>
			<br><label><b>Name</b></label>
			<input type="text" name="name" id="name" value=<?php echo $user_name ?> disabled><br/><br/>
	
			<label><b>Email</b></label>
			<input type="text" name="email" id="email" value=<?php echo $user_email ?> disabled><br/><br/>

			<label><b>Gender</b></label>
			<input type="text" name="gender" id="gender" value=<?php echo $gender ?> disabled><br/><br/>
			
			<label><b>About</b></label>
			<input type="text" name="desc" id="desc" value=<?php echo $desc ?> disabled><br/><br/>
			
			<label><b>Total Training</b></label>
			<input type="text" name="num" id="num" value=<?php echo $total ?> disabled><br/><br/>
			</fieldset>

			<br>
			<hr>
			</div>
	</form>
	<div class="center">
		<a href="account.php" class="tab">Edit Account</a>
		<a href="registered_training.php" class="tab">View Registered Training</a>
	</div><br/><br/>
	</body>
</html>