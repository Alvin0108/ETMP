<!-- Start Session -->
<?php 
	session_start();
?>

<?php
	//declare variables
	$user_training_check  = "";
	$user_email = $user_ID = $tname = $tid = $tfee = "";
	
	$user_email = $_SESSION["user_email"];
	$user_ID = $_SESSION["user_id"];
	$tname = $_SESSION["tname"];
	$tid = $_SESSION["tid"];
	$tfee = $_SESSION["tfee"];
	$tdate = $_SESSION["tdate"];
	$tmode = $_SESSION["tmode"];
	$date = date('Y-m-d');
	
if(isset($_POST["confirm"])) {  
	$user_training_check = TrainingCheck();							// Checking training register

	if($user_training_check == "")
	{		
		// Insert the record
		$conn = mysqli_connect("localhost","root","","portal_database");
		$add= "INSERT INTO registration (user_id,training_id,training_name,register_date,training_date,training_mode) VALUES ('$user_ID','$tid','$tname','$date','$tdate','$tmode')";
		$queryResult = mysqli_query($conn,$add);
		$user_training_check = "<span style='color:green'>You success register </span>";
	}
}

function TrainingCheck()
{
	$tid = $_SESSION["tid"];
	$user_ID = $_SESSION["user_id"];
	$mysqli = mysqli_connect("localhost","root","","portal_database");
	$query= "SELECT * FROM registration WHERE user_id='$user_ID' AND training_id='$tid'";
	$results= mysqli_query($mysqli, $query);
	// Checking if the same same user register same training again
	if((mysqli_num_rows($results))>0)
	{
			return "<span style='color:red'>You had registered </span>";
	}
}

?>


<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<meta name="description" content="DP2" />
		<meta name="keywords" content="PHP" />
		<meta name="author" content="Alvin Chua Khai Chuen" />
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Submit</title>
    </head>
	<header>
	<!--navigation-->
	<?php include "navigation.php";?>

	</header>
    <body>   
		<hr/>
		<br/><br/><br/>
		<div class="final_confirm">
			<?php echo $user_training_check . $tname; ?><br/><br/>
			<a href="search.php"class="return"><i class="fa fa-hand-o-right"> Return to Training Search </i></a>
		</div>
		<br/><br/><br/>
		<hr/>
    </body>
</html>