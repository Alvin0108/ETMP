<?php 
session_start();
$user_email = $user_ID = $user_name = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Add Account Information </title>
	<meta charset ="utf-8">
	<meta name="descrtiption" content="php">
	<meta name="keywords" content="ETMP">
	<link rel="stylesheet" href="css/sign.css">
</head>
	<body>
	<?php
	//Declare variable
	$desc = $gender = "";
	if(isset($_POST['add_info'])) {		
	$desc = $_POST['desc'];
	$gender = $_POST['gender'];
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	
	$sql = "UPDATE users SET description='$desc', gender='$gender' WHERE user_email='$user_email'";
	$queryResult=mysqli_query($conn,$sql);	
	
	header("Location: search.php");
}
	
	?>
	
	<!-- add info form -->
	<form action="add_personal_detail.php" method="post">
		<div class="center">
			<h1>Personal Detail</h1>
			<h2>Please fill in to complete basic information</h2>
			<hr>
		
			<br><br><label for="name"><b>Name</b></label>
			<input type="name" name="name" id="name" value="<?php echo $user_name;?>" disabled ><br>
	
			<label for="email"><b>Email</b></label>
			<input type="email" name="email" id="email" value="<?php echo $user_email;?>" disabled><br>

			<label for="desc"><b>About yourself</b></label>
			<input type="desc" placeholder="Enter some descrtiption..." name="desc" id="desc" required /><br>
			
			<label for="gender"><b>Gender</b></label>
			<input type="radio" id="male" name="gender" value="male" required>
			<label for="male">Male</label>
			<input type="radio" id="female" name="gender" value="female" required>
			<label for="female">Female</label><br>

			<hr>

			<button type="submit" class="registerbtn" name="add_info">Add account information</button>
		</div>
		
		

		
	</form>
	</body>
</html>
