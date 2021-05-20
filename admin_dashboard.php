<?php 
session_start();
$admin_email = $admin_id = "";
$admin_email = $_SESSION["admin_email"];
$admin_id = $_SESSION["admin_id"];
?>
<?php
//Limit and show last 5 record
$query = "SELECT * FROM `registration` ORDER BY register_id DESC LIMIT 5";
$search_result = filter($query);

$query2 = "SELECT * FROM `users`";
$user_result = filter($query2);

function filter($query)
{
	$conn = mysqli_connect("localhost","root","","portal_database");
	$filter_data = mysqli_query($conn, $query);
	return $filter_data;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
	<title> Admin Dashboard </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="Admin Dashboard">
	<meta name="keywords" content="ETMP,dashboard">
	
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
	<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
</head>
 
<body>
	<header>
	<?php include ("admin_navigation.php"); ?>
	</header>

	<br><br><br><br><br><br>
	<h2>Dashboard</h2>
	<br><br><br>
	<style>
	h2{
			
			margin-left: 25%;
	}
	</style>
            <table class="center">
			  <p align="center" class="table-p"><b>Latest 5 User Registration Record </b>(<a href="searchRegister.php">View more</a>)</p>
                <tr>
					<th>Register ID</th>
					<th>User ID</th>
					<th>Training ID</th>
                    <th>Training Name</th>
                    <th>Register Date</th>
					<th>Start Date</th>
					<th>Mode</th>
                </tr>
				<?php while($row = mysqli_fetch_array($search_result)):?>
					<tr>
						<td><?php echo $row['register_id'];?></td>
						<td><?php echo $row['user_id'];?></td>
						<td><?php echo $row['training_id'];?></td>
						<td><?php echo $row['training_name'];?></td>
						<td><?php echo $row['register_date'];?></td>
						<td><?php echo $row['training_date'];?></td>
						<td><?php echo $row['training_mode'];?></td>
					</tr>
				<?php endwhile;?>
            </table>
			<br/><br/>
			<table class="center">
			  <p align="center" class="table-p"><b>User Record</b></p>
                <tr>
					<th>User ID</th>
					<th>User Name</th>
                    <th>User Email</th>
                </tr>
				<?php while($row = mysqli_fetch_array($user_result)):?>
					<tr>
						<td><?php echo $row['user_id'];?></td>
						<td><?php echo $row['user_name'];?></td>
						<td><?php echo $row['user_email'];?></td>
					</tr>
				<?php endwhile;?>
            </table>
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
		
		.Select{
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
  
		.Select:hover {
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
