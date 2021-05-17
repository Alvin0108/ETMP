<!-- Start Session -->
<?php 
	session_start();
	$user_email = $user_ID = $t_date = "";
	$user_email = $_SESSION["user_email"];
	$user_ID = $_SESSION["user_id"];
	
?>

<?php
	if(isset($_GET['id'])){
		$ID = $_GET['id'];
		$sql = "SELECT * FROM training WHERE training_id = '{$ID}'";
		$result = filter($sql);
		$row = mysqli_fetch_assoc($result);	
		
		//Save into session
		$_SESSION["tname"] = $row['training_name'];
		$_SESSION["tid"] = $row['training_id'];
		$_SESSION["tfee"] = $row['training_fee'];
		$_SESSION["tdate"] = $row['start_date'];
		$_SESSION["tmode"] = $row['mode'];
		
		$name = $row['training_name'];
		$id = $row['training_id'];
		$fee = $row['training_fee'];
		$s_date = $row['start_date']; 
		$e_date = $row['end_date'];
		$mode = $row['mode'];

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
		
		<title>Finalize</title>
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

		
		<section class="section" id="about">
        <div class="container">
        <form action="submit_training.php" method="post" class="check">
		<div class="center">
			<h2>Training / Training Confirmation </h2>
			<hr>
			<fieldset>
				<legend> Training Infomation </legend>
				
				<br><label><b>Training Code</b></label>
				<input type="text" id="t_code" name="t_code" value="<?php echo $id ?>" disabled><br><br>
				
				<label><b>Training Name</b></label>
                <input type="text" id="t_name" name="t_name" value="<?php echo $name ?>" disabled><br><br>
				
				<label><b>Fee (per person)</b></label>
                <input type="text" id="fee" name="fee" value="RM <?php echo $fee ?>" disabled><br><br>
			
				<label><b>Training Mode</b></label>
				<input type="text" id="mode" name="mode" value="<?php echo $mode ?>" disabled><br><br>
				
				<label><b>Start Date</b></label>
				<input type="text" id="sdate" name="sdate" value="<?php echo $s_date ?>" disabled><br><br>
				
				<label><b>End Date</b></label>
				<input type="text" id="edate" name="edate" value="<?php echo $e_date ?>" disabled><br><br>
				
				<hr>
				<button type="submit" class="confirmbtn" name="confirm">Confirm </i></button><br/><br/>
			</fieldset>
							<style>
							
							
							.confirmbtn{
								font-size: 13px;
								border-radius: 20px;
								padding: 12px 20px;
								background-color: #f55858;
								text-transform: uppercase;
								color: #fff;
								letter-spacing: 0.25px;
								-webkit-transition: all 0.3s ease 0s;
								-moz-transition: all 0.3s ease 0s;
								-o-transition: all 0.3s ease 0s;
								transition: all 0.3s ease 0s;
								width: 15%;
								text-align: center;
								font-family: "Roboto", sans-serif;
							}
							
							.confirmbtn:hover{
								background-color: #0088e8;
								cursor: pointer;
							}
							
							input {
							  width: 85%;
							  display: block;
							  border: none;
							  border-bottom: 1px solid #999;
							  padding: 6px 30px;
							  font-family: Poppins;
							  box-sizing: border-box; }
							  input::-webkit-input-placeholder {
								color: #999; }
							  input::-moz-placeholder {
								color: #999; }
							  input:-ms-input-placeholder {
								color: #999; }
							  input:-moz-placeholder {
								color: #999; }
							  input:focus {
								border-bottom: 1px solid #222; }
								input:focus::-webkit-input-placeholder {
								  color: #222; }
								input:focus::-moz-placeholder {
								  color: #222; }
								input:focus:-ms-input-placeholder {
								  color: #222; }
								input:focus:-moz-placeholder {
								  color: #222; }

							input[type=checkbox]:not(old) {
							  width: 2em;
							  margin: 0;
							  padding: 0;
							  font-size: 1em;
							  display: none; }

							input[type=checkbox]:not(old) + label {
							  display: inline-block;
							  line-height: 1.5em;
							  margin-top: 6px; }

							input[type=checkbox]:not(old) + label > span {
							  display: inline-block;
							  width: 13px;
							  height: 13px;
							  margin-right: 15px;
							  margin-bottom: 3px;
							  border: 1px solid #999;
							  border-radius: 2px;
							  -moz-border-radius: 2px;
							  -webkit-border-radius: 2px;
							  -o-border-radius: 2px;
							  -ms-border-radius: 2px;
							  background: white;
							  background-image: -moz-linear-gradient(white, white);
							  background-image: -ms-linear-gradient(white, white);
							  background-image: -o-linear-gradient(white, white);
							  background-image: -webkit-linear-gradient(white, white);
							  background-image: linear-gradient(white, white);
							  vertical-align: bottom; }

							input[type=checkbox]:not(old):checked + label > span {
							  background-image: -moz-linear-gradient(white, white);
							  background-image: -ms-linear-gradient(white, white);
							  background-image: -o-linear-gradient(white, white);
							  background-image: -webkit-linear-gradient(white, white);
							  background-image: linear-gradient(white, white); }

							input[type=checkbox]:not(old):checked + label > span:before {
							  content: '\f26b';
							  display: block;
							  color: #222;
							  font-size: 11px;
							  line-height: 1.2;
							  text-align: center;
							  font-family: 'Material-Design-Iconic-Font';
							  font-weight: bold; }
							 
							
														
							</style>
			</div>
			</form>
			</div>
		</section>
		
		
		
		
		
		
		
		
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