<?php 
session_start();
$user_email = $user_ID = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];
?>

<!--search training with filter function-->
<?php
	$training_search = "";

	if(isset($_POST['training_search']))
	{
		$training_search = $_POST['training_search'];
		$query = "SELECT * FROM `training` WHERE CONCAT(`training_id`, `training_name`, `training_fee`,`start_date`,`end_date`,`mode`) 
		LIKE '%".$training_search."%'";
		$search_result = filter($query);

	}else{
		$query = "SELECT * FROM `training`";
		$search_result = filter($query);
	}
	
	
	function filter($query)
	{
		$conn = mysqli_connect("localhost","root","","portal_database");
		$filter_data = mysqli_query($conn, $query);
		return $filter_data;
	}
?>

<!DOCTYPE html>
<html lang="en">

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
		<!-- font icon -->
		<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
		<title>Search</title>
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
	
	
		<br><br><br><br><br>
		<!--Search-->
        <form action="search.php" method="post" class="training-search"> 
			<input type="text" name="training_search" placeholder="Search..." value="<?php echo $training_search ?>">
        </form> 

               										
		
		<!--Display training-->
		<?php 
		echo "<table class='center'>
		<tr>
		<th>Id</th>
		<th>Training Name</th>
		<th>Fee (per person)</th>
		<th>Starting Date</th>
		<th>Ending Date</th>
		<th>Training Mode</th>
		<th>Register</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			echo "<tr>";
			echo "<td>" . $row['training_id'] . "</td>";
			echo "<td>" . $row['training_name'] . "</td>";
			echo "<td> RM " . $row['training_fee'] . "</td>";
			echo "<td>" . $row['start_date'] . "</td>";
			echo "<td>" . $row['end_date'] . "</td>";
			echo "<td>" . $row['mode'] . "</td>";
			echo "<td><form action=finalize_training.php>
			<input name=id type=hidden value='".$row['training_id']."'>   
			<input type=submit class='register' name=register value=Register>
			</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		?>	
		<br><br><br><br>
		<style>
		th, td{
			padding: 15px;
			text-align: left;
			border-bottom: 1px solid #ddd;
		}
		
		tr:hover{
			background: #f5f5f5;
		}
		
		tr:nth-child(even){
			background-color: f2f2f2;
		}
		
		th{
			background-color:#6dabe4;
			color: white;
		}
		
		.register{
			display: inline-block;
			background: #6dabe4;
			color: #fff;
			border-bottom: none;
			width: auto;
			padding: 15px 39px;
			border-radius: 5px;
			-moz-border-radius: 5px;
			-webkit-border-radius: 5px;
			-o-border-radius: 5px;
			-ms-border-radius: 5px;
			margin-top: 25px;
			cursor: pointer;
		}
  
		.register:hover {
			background: #4292dc; 
		}
		
		table.center{
			margin-left:auto;
			margin-right:auto;
			padding:10px;
			width:50%;
			padding-bottom: 50px;
		}
		
		.search .training_search{
			padding: 15px 30px;
			box-shadow: inherit;
			border: inherit;
			width: 60%;
			font-size: 19px;
			box-shadow: #b0b0b0 0px -2px 9px 0px;
		}
		
		.training-search{
			margin-left:auto;
			margin-right:auto;
			width: 20%;
			padding-bottom: 50px;
		}
		
		input {
			width: 100%;
			display: block;
			border: none;
			border-bottom: 1px solid #999;
			padding: 6px 30px;
			font-family: Poppins;
			box-sizing: border-box; 
		}
		 
		input::-webkit-input-placeholder {
			color: #999; 
		}
			
		input::-moz-placeholder {
			color: #999; 
		}
			
		input:-ms-input-placeholder {
			color: #999; 
		}
			
		 input:-moz-placeholder {
			color: #999; 
		}
			
		 input:focus {
			border-bottom: 1px solid #222; 
		}
			
		input:focus::-webkit-input-placeholder {
			  color: #222; 
		}
			  
		input:focus::-moz-placeholder {
			  color: #222; 
		}
			  
		input:focus:-ms-input-placeholder {
			  color: #222; 
		}
			  
		input:focus:-moz-placeholder {
			  color: #222; 
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
