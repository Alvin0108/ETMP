<?php 
session_start();
$user_email = $user_ID = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];

?>

<!--search training with filter function-->
<?php

	$query = "SELECT * FROM `registration` WHERE user_ID = $user_ID";
	$search_result = filter($query);

	function filter($query)
	{
		$conn = mysqli_connect("localhost","root","","portal_database");
		$filter_data = mysqli_query($conn, $query);
		return $filter_data;
	}
	
if(isset($_GET['id'])){
	$ID = $_GET['id'];
	
	$query2 = "SELECT * FROM registration WHERE training_id = '{$ID}' AND user_ID = '{$user_ID}'";
	$result = filter($query2);
	$row = mysqli_fetch_assoc($result);
	$RID = $row['register_id'];
	$sql2 = "DELETE FROM register_venue WHERE register_id = '{$RID}'";
	$result = filter($sql2);
	$sql = "DELETE FROM registration WHERE training_id = '{$ID}' AND user_ID = '{$user_ID}'";
	$result = filter($sql);
	
}
?>

<!DOCTYPE html>
<html lang="en">
<html>
    <head>
		<meta charset="utf-8" />
		<meta name="description" content="DP2" />
		<meta name="keywords" content="PHP, training, registered, registered training, ETMP, Expert.com, view, viewing" />
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
		<title>Registered Training</title>
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
	
		
		
		<br><br><br><br>
		<h2> Profile / Registered Training </h2>
		<style>
		h2{
			
			margin-left:200px;
		}
		</style>
		<br><br>
		<!--Display training-->
		<?php 
		echo "<table class='center'>
		<tr>
		<th>Training Id</th>
		<th>Training Name</th>
		<th>Register date</th>
		<th>Training cancel</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			echo "<tr>";
			echo "<td>" . $row['training_id'] . "</td>";
			echo "<td>" . $row['training_name'] . "</td>";
			echo "<td>" . $row['register_date'] . "</td>";
			echo "<td><form action=registered_training.php>
			<input name=id type=hidden value='".$row['training_id']."'>
			<input type=submit value=Cancel class=Cancel>
			</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		?>	
		
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
		
		.Cancel{
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
  
		.Cancel:hover {
			background: #4292dc; 
		}
		
		table.center{
			margin-left:auto;
			margin-right:auto;
			padding:10px;
			width:50%;
			padding-bottom: 50px;
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
