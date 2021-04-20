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
	<title> Add Account Information </title>
	<meta charset ="utf-8">
	<meta name="descrtiption" content="php">
	<meta name="keywords" content="ETMP">
	<link rel="stylesheet" href="style/style.css">
</head>
	<body>
	<?php
	if(isset($_POST['add_info'])) {		
	$email = $_POST['email'];
	$desc = $_POST['desc'];
	$gender = $_POST['gender'];
	$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
//	
//	$sql = "UPDATE users SET description='".$desc."',gender='".$gender."' WHERE user_email=".$email;
//	$queryResult=mysqli_query($conn,$sql);
	
	$query= "SELECT * FROM users WHERE user_email='$email'";	// Check if email exist in database
	$results= mysqli_query($conn, $query);
	$row = mysqli_fetch_assoc($results);	
	

	// Saving important data into Session
	$_SESSION["user_name"] = $row["user_name"];
	$_SESSION["user_id"] = $row["user_id"];
	$_SESSION["user_email"] = $row["user_email"];
	header("Location: search.php");
}
	
	?>
	
	<!-- registration form -->
	<form action="add_personal_detail.php" method="post">
		<div class="container">
			<h1>Personal Detail</h1>
			<h2>Please fill in to complete basic information</h2>
			<hr>
		
			<br><br><label for="name"><b>Name</b></label>
			<input type="name" name="name" id="name" value=<?php echo $user_name?> disabled ><br>
	
			<label for="email"><b>Email</b></label>
			<input type="email" name="email" id="email" value="<?php echo $user_email?>" disabled><br>

			<label for="text"><b>Description</b></label>
			<input type="text" placeholder="Enter some descrtiption..." name="desc" id="desc" required /><br><br>
			
			<label for="gender"><b>Gender</b></label><br/>
			<input type="radio" id="male" name="gender" value="male" required>
			<label for="male">Male</label><br>
			<input type="radio" id="female" name="gender" value="female" required>
			<label for="female">Female</label><br>

			<hr>

			<button type="submit" class="registerbtn" name="add_info">Add account information</button>
		</div>
	</form>
	</body>
</html>