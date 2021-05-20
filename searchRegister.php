<?php
	if(isset($_POST['search']))
	{
		$registration_search = $_POST['registration_search'];
		$query = "SELECT * FROM `registration` WHERE CONCAT(`training_id`, `training_name`, `register_date`) 
		LIKE '%".$registration_search."%'";
		$search_result = filter($query);
	}else{
		$query = "SELECT * FROM `registration`";
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
		<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
		<link rel="stylesheet" type="text/css" href="css/index.css">
		<link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
		<!-- font icon -->
		<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
		
		<link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">
		<title>Search Registration</title>
    </head>
	
	
    <body>  

		<header>
			<!--navigation-->
			<?php include "admin_navigation.php";?>
		</header>
		
		<br><br><br><br><br>
		
		<!-- search field -->
        <form action="searchRegister.php" method="post" class="search">
			<button type="submit" name="search"><i class="zmdi zmdi-search"></i></button><br><br>
            <input type="text" name="registration_search" placeholder="Search...">
        </form>   
		
		
            <table class="center">
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
		

		
		table.center{
			margin-left:auto;
			margin-right:auto;
			padding:10px;
			width:50%;
			padding-bottom: 50px;
		}
		

		
		.search{
			margin-left:auto;
			margin-right:auto;
			width: 20%;
			padding-bottom: 50px;
		}
		
		button{
			border: 0;
			padding: 0;
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