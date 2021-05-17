<!DOCTYPE html>
<html lang="en">

<?php 
	session_start();
    //declare variables
    $user_training_check = $venues_search  = "";
    $user_email = $user_ID = $tid = $rid= "";

    $user_email = $_SESSION["user_email"];
    $user_ID = $_SESSION["user_id"];
    $tid = $_SESSION["tid"];

    $_SESSION["rid"] = $rid;

    //Select registration id
    $conn = mysqli_connect("localhost","root","","portal_database");
    $sql = "SELECT * FROM registration WHERE user_id='$user_ID' AND training_id='$tid'";
    $result = mysqli_query($conn,$sql);
    $row = mysqli_fetch_assoc($result);
    $_SESSION["rid"] = $row["register_id"];
?>

<!--search training with filter function-->
<?php
	$venues_search = "";

	if(isset($_POST['search']))
	{
		$venues_search = $_POST['training_search'];
		$query = "SELECT * FROM `venues` WHERE CONCAT(`venues_id`, `venues_name`) 
		LIKE '%".$venues_search."%'";
		$search_result = filter($query);

	}else{
		$query = "SELECT * FROM `venues`";
		$search_result = filter($query);
	}
	
	
	function filter($query)
	{
		$conn = mysqli_connect("localhost","root","","portal_database");
		$filter_data = mysqli_query($conn, $query);
		return $filter_data;
	}
?>

<style>
.room {
  position: relative;
  width: 100%;
  max-width: 400px;
}

.room img {
  width: 100%;
  height: auto;
}

.room .btn {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  -ms-transform: translate(-50%, -50%);
  background-color: #555;
  color: white;
  font-size: 16px;
  padding: 12px 24px;
  border: none;
  cursor: pointer;
  border-radius: 5px;
  text-align: center;
}

.room .btn:hover {
  background-color: black;
}
</style>

<html lang="en">

<head>
	<title> Venue Selection </title>
	<meta charset ="utf-8">
	<meta name="descrtiption" content="php">
	<meta name="keywords" content="ETMP">
	
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
	<!-- font icon -->
	<link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
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
	<h2> Training / Confirmation / Venue <?php echo $rid ?> </h2>	
	<style>
		h2{
			
			margin-left:200px;
		}
	</style>
	<br/><br/>
		<?php 
		echo "<table class='center'>
		<tr>
		<th>Room ID </th>
		<th>Image</th>
		<th>Room Name</th>
		<th>Tuition Day</th>
		<th>Description</th>
		<th>Selection</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			$id = $row['venue_id'];
			$image = $row['image'];
			$image = "images/" . $image;
			echo "<tr>";
			echo "<td>" . $id . "</td>";
			echo "<td>" . "
			<img src='$image' height=150px width=150px>" . "</td>";
			echo "<td>" . $row['venue_name'] . "</td>";
			echo "<td>" . $row['day'] . "</td>";
			echo "<td>" . $row['description'] . "</td>";
			echo "<td><form action=modify_venue.php>
			<input name=id type=hidden value='".$row['venue_id']."'>   
			<input type=submit class='Select' name=select value=SELECT>
			</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		?>	<br><br><br><br><br>
		
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