<!DOCTYPE html>
<html lang="en">

<head>
	<title> Registration </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="training record">
	<meta name="keywords" content="ETMP, account registration">
	<link rel="stylesheet" href="style/style.css">
</head>
<body>
<?php
//Dclare variable
$tid = $tname = $tdesc = $tfee = $sdate = $edate = $tmode = "";
$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
if(isset($_POST["add"])) {  

		$tid = $_POST['tID'];
		$tname = $_POST['tname'];
		$tdesc = $_POST['tdesc'];
		$tfee = $_POST['tfee'];
		$sdate = $_POST['sdate'];
		$edate = $_POST['edate'];
		$tmode = $_POST['tmode'];
		// Insert the record
		$adding = "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) 
		VALUES ('$tid','$tname','$tdesc','$tfee','$sdate','$edate','$tmode');";
		$queryResult=mysqli_query($conn,$adding);
}
?>
	<!-- registration form -->
	<form action="admin_training_record.php" method="post">
		<div class="center">
			<h1>Add new Training Record</h1>
			<hr>	
			<label for="tID"><b>Training ID</b></label>
			<input type="name" placeholder="Training ID" name="tID" id="tID" required><br>

			<label for="tname"><b>Training Name</b></label>
			<input type="name" placeholder="Training Name" name="tname" id="tname" required><br>

			<label for="tdesc"><b>Training Description</b></label>
			<input type="name" placeholder="About the training" name="tdesc" id="tdesc" required><br>
			
			<label for="tfee"><b>Training Fee</b></label>
			<input type="name" placeholder="Fee of training" name="tfee" id="tfee" required><br>
			
			<label for="sdate"><b>Starting Date</b></label>
			<input type="name" placeholder="Training start date" name="sdate" id="sdate" required><br>
			
			<label for="edate"><b>Ending Date</b></label>
			<input type="name" placeholder="Training end date" name="edate" id="edate" required><br>
			
			<label for="tmode"><b>Training Mode</b></label>
			<input type="name" placeholder="Training mode" name="tmode" id="tmode" required><br>
			<hr>

			<button type="submit" name="add">Add Record</button>
		</div>
	</form>
	</body>
</html>