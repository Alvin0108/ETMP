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
	<link rel="stylesheet" href="style/style.css">
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
		$folder = "image/".$filename;
		
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
	<form action="admin_venue_record.php" method="post" enctype="multipart/form-data">
		<div class="center">
			<h2>Add new Venue Record</h1>
			<hr>	
			<label for="vname"><b>Venue Name</b></label>
			<input type="name" placeholder="Venue Name" name="vname" id="vname" value="<?php echo $vname;?>" required><br/><br/>

			<label for="vdesc"><b>Venue Description</b></label>
			<input type="desc" placeholder="About the venue" name="vdesc" id="vdesc" value="<?php echo $vdesc;?>" required><br/><br/>

			<label for="days"><b>Choose a Day <b/></label>
				<select name="days" id="days" class="days">
				<option value="Tuesday">Tuesday</option>
				<option value="Thursday">Thursday</option>
				<option value="Saturday">Saturday</option>
				<option value="Sunday">Sunday</option>
				</select><br/><br/>
				
			<label for="image"><b>Upload the image<b/></label>
			<input type="file" name="uploadfile" value=""/><br/>
			<?php echo $msg ?><br/>
			<br/><br/>
		
			<button type="submit" class="loginbtn" name="add">Add Record</button>
		</div>
	</form>
	</body>
</html>