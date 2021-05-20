<?php 
session_start();
$admin_email = $admin_id = "";
$admin_email = $_SESSION["admin_email"];
$admin_id = $_SESSION["admin_id"];
?>

<!DOCTYPE html>
<html lang="en">

<head>
	<title> Add Venue Record </title>
	<meta charset ="utf-8">
	<meta name="author" content="Tay Yuan Long">
	<meta name="descrtiption" content="venue record">
	<meta name="keywords" content="ETMP, venue record">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
	
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
<header>
	<?php include ("admin_navigation.php"); ?>
</header>
<body>
<?php
//Declare variable
$vname = $vdesc = $vday = $msg = "";
$nameer = "";
$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
	
if(isset($_POST["add"])) { 

	$nameer = NameCheck();
	$vname = $_POST["vname"];
	$vdesc = $_POST["vdesc"];
	$vday = $_POST["days"];
	
	if($nameer=="" ) {
		$filename = $_FILES["uploadfile"]["name"];
		$tempname = $_FILES["uploadfile"]["tmp_name"];    
		$folder = "images/".$filename;
		
		// Select file type
		$imageFileType = strtolower(pathinfo($filename,PATHINFO_EXTENSION));
		
		// valid file extensions
		$extensions_arr = array("jpg","jpeg","png","gif");
		if( in_array($imageFileType,$extensions_arr) ){
			// Now let's move the uploaded image into the folder: image
			if (move_uploaded_file($tempname, $folder))  {
				$msg = "<span style='color:green'>Image uploaded successfully</span>";
			// Insert the record
				$adding = "INSERT INTO venues (venue_name, day, description, image) VALUES ('$vname','$vday','$vdesc','$filename');";
				$queryResult=mysqli_query($conn,$adding);
			}else{
				$msg = "<span style='color:red'>Failed to upload image</span>";
			}		
		}
		else 
		{
			$msg = "<span style='color:red'>You need to upload image file</span>";
		}
	}
	else
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
	<br/><br/><br/><br/><br/><br/>
	<section class="section">
		<div class="container">
			<form action="admin_venue_record.php" method="post" enctype="multipart/form-data">
				<div class="center">
					<h2>Add New Venue Record</h2>
					<hr>	
						<fieldset>
							<br/><label for="vname"><b>Venue Name</b></label>
							<input type="name" placeholder="Venue Name" name="vname" id="vname" value="<?php echo $vname;?>" required><br/><br/>

							<label for="vdesc"><b>Venue Description</b></label>
							<input type="desc" placeholder="About the venue" name="vdesc" id="vdesc" value="<?php echo $vdesc;?>" required><br/><br/>

							<label for="days"><b>Choose a Day <b/></label>
								<select name="days" id="days" class="days">
								<option value="Tuesday">Tuesday</option>
								<option value="Thursday">Thursday</option>
								<option value="Saturday">Saturday</option>
								<option value="Sunday">Sunday</option>
								</select><br/><br/><br/>
								
							<label for="image"><b>Upload the image<b/></label>
							<input type="file" name="uploadfile" value=""/><br/>
							<?php echo $msg ?><br/><br/>
						</fieldset>
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
						<br>
						<hr>
				</div>
			
			<div>
				<button type="submit" class="register_acc" name="add">Add Record</button>
			</div>
			</form>
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
