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
	<link rel="stylesheet" href="style/style.css">
</head>
<header>
	<?php include ("admin_navigation.php"); ?>
</header>
<body>
<?php
//Dclare variable
$tid = $tname = $tdesc = $tfee = $sdate = $edate = $tmode = "";
$ider = $nameer = "";
$tidr = $tnamer = $tdescr = $tfeer = $sdater = $edater = $tmoder = "";
$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	
if(isset($_POST["add"])) { 

	$ider = IDCheck();
	$nameer = NameCheck();
	$tid = $_POST['tID'];
	$tname = $_POST['tname'];
	$tdesc = $_POST['tdesc'];
	$tfee = $_POST['tfee'];
	$sdate = $_POST['sdate'];
	$edate = $_POST['edate'];
	$tmode = $_POST['tmode'];
	
	if($ider=="" && $nameer=="" )
	{
		// Insert the record
		$adding = "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) 
		VALUES ('$tid','$tname','$tdesc','$tfee','$sdate','$edate','$tmode');";
		$queryResult=mysqli_query($conn,$adding);
		echo "<script>alert('Success adding new record')</script>";
	}else
	{
		$tidr = $_POST['tID'];
		$tnamer = $_POST['tname'];
		$tdescr = $_POST['tdesc'];
		$tfeer = $_POST['tfee'];
		$sdater = $_POST['sdate'];
		$edater = $_POST['edate'];
		$tmoder = $_POST['tmode'];
		echo "<script>alert('The training id or training name already exist')</script>";
		
	}
}

function IDCheck()
{
	$tid = $_POST['tID'];
	$mysqli = mysqli_connect("localhost","root","","portal_database");
	$query= "SELECT * FROM training WHERE training_id='$tid'";
	$results= mysqli_query($mysqli, $query);
	// Checking if the same training id already exist in the database
	if((mysqli_num_rows($results))>0)
	{
		return "exist";
	}
}
function NameCheck()
{
	$tname = $_POST['tname'];
	$mysqli = mysqli_connect("localhost","root","","portal_database");
	$query= "SELECT * FROM training WHERE training_name='$tname'";
	$results= mysqli_query($mysqli, $query);
	// Checking if the same training name already exist in the database
	if((mysqli_num_rows($results))>0)
	{
		return "exist";
	}
}
?>
	<!-- registration form -->
	<form action="admin_training_record.php" method="post">
		<div class="center">
			<h2>Add new Training Record</h1>
			<hr>	
			<label for="tID"><b>Training ID</b></label>
			<input type="name" placeholder="Training ID" name="tID" id="tID" value="<?php echo $tidr;?>" required><br>

			<label for="tname"><b>Training Name</b></label>
			<input type="name" placeholder="Training Name" name="tname" id="tname" value="<?php echo $tnamer;?>" required><br>

			<label for="tdesc"><b>Description</b></label>
			<input type="name" placeholder="About the training" name="tdesc" id="tdesc" value="<?php echo $tdescr;?>" required><br>
			
			<label for="tfee"><b>Fee</b></label>
			<input type="name" placeholder="Fee of training" name="tfee" id="tfee" value="<?php echo $tfeer;?>" required><br>
			
			<label for="sdate"><b>Starting Date</b></label>
			<input type="date"  name="sdate" id="sdate" value="<?php echo $sdater;?>" required><br>
			
			<label for="edate"><b>Ending Date</b></label>
			<input type="date"  name="edate" id="edate" value="<?php echo $edater;?>" required><br>
			
			<label for="tmode"><b>Training Mode</b></label>
			<input type="name" placeholder="Training mode" name="tmode" id="tmode" value="<?php echo $tmoder;?>" required><br>
			<hr>

			<button type="submit" class="loginbtn" name="add">Add Record</button>
		</div>
	</form>
	</body>
</html>
