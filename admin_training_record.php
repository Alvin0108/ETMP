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
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
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
			<br/><br/>
	<section class="section" id="about">
		<div class="container">
			<form action="admin_training_record.php" method="post">
				<div class="center">
					<h2>Add New Training Record</h2>
					<hr>
					<fieldset>
						<br/><label for="tID"><b>Training ID</b></label>
						<input type="name" placeholder="Training ID" name="tID" id="tID" value="<?php echo $tidr;?>" required><br/><br/>

						<label for="tname"><b>Training Name</b></label>
						<input type="name" placeholder="Training Name" name="tname" id="tname" value="<?php echo $tnamer;?>" required><br><br/>

						<label for="tdesc"><b>Description</b></label>
						<input type="name" placeholder="About the training" name="tdesc" id="tdesc" value="<?php echo $tdescr;?>" required><br><br/>
						
						<label for="tfee"><b>Fee</b></label>
						<input type="name" placeholder="Fee of training" name="tfee" id="tfee" value="<?php echo $tfeer;?>" required><br><br/>
						
						<label for="sdate"><b>Starting Date</b></label>
						<input type="date"  name="sdate" id="sdate" value="<?php echo $sdater;?>" required><br><br/>
						
						<label for="edate"><b>Ending Date</b></label>
						<input type="date"  name="edate" id="edate" value="<?php echo $edater;?>" required><br><br/>
						
						<label for="tmode"><b>Training Mode</b></label>
						<input type="name" placeholder="Training mode" name="tmode" id="tmode" value="<?php echo $tmoder;?>" required><br><br/>
						<hr>
					<fieldset>
					
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
					
				</div>
			</form>
			
			<div class="center">
				<button type="submit" class="register_acc" name="add">Add Record</button>
			</div>
		</div>
	</section>
	
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
