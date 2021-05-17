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
		<!-- CSS Files -->
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
		<title>Submit</title>
    </head>
	
    <body>  
		
		<!-- Header Area Start -->
		<header class="header-area header-sticky">
			<div class="container">
				<div class="row">
					<div class="col-12">
					
						<nav class="main-nav">
							<!-- Logo Start -->
							<a href="#" class="logo">Expert.com</a>
							<!-- Logo End -->
							
							<!-- Menu Start -->
							<ul class="nav">
								<li class="scroll-to-section"><a href="search.php">Training Search</a></li>
								<li ><a href="profile.php" >Profile</a></li>
								<li ><a href="logout.php">Log Out</a></li>
							</ul>
							<a class='menu-trigger'>
								<span>Menu</span>
							</a>
							<!-- Menu End -->
						</nav>
						
					</div>
				</div>
			</div>
		</header>

		
		<hr/>
		<br/><br/><br/>
		<div class="final_confirm">
			<?php echo $user_training_check . $tname; ?><br/><br/>
			<?php 
				if($user_training_check == "<span style='color:green'>You success register </span>")
				{
					echo "<a href='venue.php' class='return'><i class='fa fa-hand-o-right'> Venue Page </i></a> <br/>";
				}else if($user_training_check == "<span style='color:red'>You had registered </span>")
				{
					echo "<a href='search.php' class='return'><i class='fa fa-hand-o-right'> Return Training Page </i></a> <br/>";
				}
			?>
		</div>
		<style>
		.final_confirm{
			text-align: center;
		}
		</style>
		<br/><br/><br/>
		<hr/>
		
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
