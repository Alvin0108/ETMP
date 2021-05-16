<!-- Start Session -->
<?php 
	session_start();
?>

<?php
	//declare variables
$r_id = $v_id = $v_name = $v_day = $v_time = "";
$rv_check = "";
$r_id = $_SESSION["rid"];
	
if(isset($_POST["confirm"])) {
	$v_id = $_SESSION["vid"];
	$v_name = $_SESSION["vname"];
	$v_day = $_POST["day"];
	$v_time = $_POST["time"];
	$rv_check = RVCheck();
	
	if($rv_check == "")
	{		
		// Insert the record
		$conn = mysqli_connect("localhost","root","","portal_database");
		$add= "INSERT INTO register_venue (register_id, venue_id, day, time) VALUES ('$r_id', '$v_id', '$v_day', '$v_time')";
		$queryResult = mysqli_query($conn,$add);
		$rv_check = "<span style='color:green'>You success assign the venue to this registration</span>";
	}
}

function RVCheck()
{
	$r_id = $_SESSION["rid"];
	$v_id = $_SESSION["vid"];
	$mysqli = mysqli_connect("localhost","root","","portal_database");
	$query= "SELECT * FROM register_venue WHERE venue_id='$v_id' AND register_id='$r_id'";
	$results= mysqli_query($mysqli, $query);
	// Checking if the same same user register same training again
	if((mysqli_num_rows($results))>0)
	{
			return "<span style='color:red'> This venue is already assigned to the registration </span>";
	}
}

?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<meta name="description" content="DP2" />
		<meta name="keywords" content="PHP" />
		<meta name="author" content="Tay Yuan Long" />
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Finalize Venue</title>
    </head>
	<header>
	<!--navigation-->
	<?php include "navigation.php";?>
	</header>
    <body>   
			<br/><br/><br/>
		<div class="final_confirm">
			<?php echo $rv_check ?><br/><br/>
			<a href="search.php"class="return"><i class="fa fa-hand-o-right"> Return to Training page </i></a><br/>
			<a href="OnlineBanking.php" class="return"><i class="fa fa-bank"> Pay by Online Banking </i></a><br/>
			<a href="testcc.php" class="return"><i class="fa fa-credit-card"> Pay by Credit Card </i></a>
		</div>
		<br/><br/><br/>
		<hr/>
    </body>
</html>