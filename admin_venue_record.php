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
	<meta name="author" content="Tay Yuan Long">
	<meta name="descrtiption" content="venue record">
	<meta name="keywords" content="ETMP, venue record">
	<link rel="stylesheet" href="style/style.css">
</head>
<header>
	<?php include ("admin_navigation.php"); ?>
</header>
<body>
<?php
//Declare variable
$vname = $vdesc = $vday = "";
$nameer = "";
$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	
if(isset($_POST["add"])) { 

	$nameer = NameCheck();
	$vname = $_POST["vname"];
	$vdesc = $_POST["vdesc"];
	$vday = $_POST["day"];
	
	if($nameer=="" )
	{
		// Insert the record
		$adding = "INSERT INTO venues (venue_name, day, description) 
		VALUES ('$vname','$vday','$vdesc');";
		$queryResult=mysqli_query($conn,$adding);
		echo "<script>alert('Success adding new record')</script>";
	}else
	{
		echo "<script>alert('The venue name already exist')</script>";
		
	}
}


function NameCheck()
{
	$vname = $_POST['vname'];
	$mysqli = mysqli_connect("localhost","root","","portal_database");
	$query= "SELECT * FROM venues WHERE venue_name='$vname'";
	$results= mysqli_query($mysqli, $query);
	// Checking if the same venue name already exist in the database
	if((mysqli_num_rows($results))>0)
	{
		return "exist";
	}
}
?>
	<!-- venue form -->
	<form action="admin_venue_record.php" method="post">
		<div class="center">
			<h2>Add new Venue Record</h1>
			<hr>	

			<label for="vname"><b>Venue Name</b></label>
			<input type="name" placeholder="Venue Name" name="vname" id="vname" value="<?php echo $vname;?>" required><br>

			<label for="vdesc"><b>Venue Description</b></label>
			<input type="name" placeholder="About the venue" name="vdesc" id="vdesc" value="<?php echo $vdesc;?>" required><br>
			
			<label for="day"><b>Choose a Day <b/></label>
				<select name="day" id="day" class="day">
				<option value="Tuesday">Tuesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Saturday">Saturday</option>
				<option value="Sunday">Sunday</option>
				</select><br><br>
			<button type="submit" name="add">Add Venue Record</button>
		</div>
	</form>
	</body>
</html>