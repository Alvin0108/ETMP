<?php 
session_start();
$admin_email = $admin_id = "";
$admin_email = $_SESSION["admin_email"];
$admin_id = $_SESSION["admin_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="training record">
	<meta name="keywords" content="ETMP, training record">
	<link rel="stylesheet" href="style/style.css">
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
$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	
if(isset($_POST["add"])) { 

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
	}else
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
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {		// Check email input, it must fit the standard email format
      return "Invalid email format ";
	}
	else {
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
	<form action="admin_user_record.php" method="post">
		<div class="center">
			<h2>Add new User Record</h1>
			<hr>	
			<label for="name"><b>User Name</b></label>
			<input type="name" placeholder="User Name" name="name" id="name" value="<?php echo $namer;?>" required><br>

			<label for="email"><b>Email</b></label>
			<input type="email" placeholder="User Email" name="email" id="email" value="<?php echo $emailr;?>" required><br>
			
			<label for="password"><b>Password</b></label>
			<input type="password" placeholder="User password" name="password" id="password" value="<?php echo $passwordr;?>" required><br>

			<label for="desc"><b>Description</b></label>
			<input type="desc" placeholder="About" name="desc" id="desc" value="<?php echo $descr;?>" required><br>
			
			<label for="gender"><b>Gender</b></label>
			<input type="radio" id="male" name="gender" value="male" required>
			<label for="male">Male</label>
			<input type="radio" id="female" name="gender" value="female" required>
			<label for="female">Female</label>
			<hr>

			<button type="submit" name="add">Add Record</button>
		</div>
	</form>
	</body>
</html>
