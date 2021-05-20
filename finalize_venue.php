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
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
		<!-- font icon -->
		<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
		<title>Finalize Venue</title>
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


	
			<br/><br/><br/><br/><br/><br/>
		<div class="final_confirm">
			<?php echo $rv_check ?><br/><br/>
			<a href="search.php"class="return"><i class="fa fa-hand-o-right"> Return to Training page </i></a><br/><br/>
			<a href="OnlineBanking.php" class="return"><i class="fa fa-bank"> Pay by Online Banking </i></a><br/><br/>
			<a href="ccpayment.php" class="return"><i class="fa fa-credit-card"> Pay by Credit Card </i></a>
		</div>
		<br/><br/><br/>
		<hr/>
		<style>
			.final_confirm{
				text-align: center;
			}
		</style>
		
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