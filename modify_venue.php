<?php 
	session_start();
	$rid = $user_email = $user_ID = $t_date = "";
	$user_email = $_SESSION["user_email"];
	$user_ID = $_SESSION["user_id"];
	$rid = $_SESSION["rid"];
?>
<?php
	if(isset($_GET['id'])){
		$ID = $_GET['id'];
		$sql = "SELECT * FROM venues WHERE venue_id = '{$ID}'";
		$result = filter($sql);
		$row = mysqli_fetch_assoc($result);	
		
		//Save into session
		$_SESSION["vname"] = $row['venue_name'];
		$_SESSION["vid"] = $row['venue_id'];
		$_SESSION["vday"] = $row['day'];
		$_SESSION["vdesc"] = $row['description'];
		
		$v_name = $row['venue_name'];
		$v_id = $row['venue_id'];
		$v_day = $row['day'];
		$v_desc = $row['description'];

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

<head>
	<title> Modify Venue </title>
	<meta charset ="utf-8">
	<meta name="descrtiption" content="php">
	<meta name="keywords" content="ETMP">
	<!-- CSS Files -->
	<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="css/font-awesome.css">
	<link rel="stylesheet" href="css/index.css">
	<link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
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
        <form action="finalize_venue.php" method="post" class="check">
		<div class="center">
			<h2>Training / Training Confirmation / Venue / Venue Confirmation</h2>
			<hr>
			<fieldset>
			<legend> Venue Information </legend>
			
			<br/><label><b>Registration ID</b></label>
			<input type="text" id="reg" name="reg" value="<?php echo $rid ?>" disabled><br><br>
			
					<label><b>Venue ID </b></label>
					<input type="text" id="code" name="code" value="<?php echo $v_id ?>" disabled><br><br>
					
				<label><b>Venue Name</b> </label>
					<input type="text" id="name" name="name" value="<?php echo $v_name ?>" disabled><br><br>
					
				<label><b>Description </b></label>
				<input type="text" id="desc" name="desc" value=" <?php echo $v_desc ?>" disabled><br><br>
					
				<label for="day"><b>Choose a Day </b></label>
					<select name="day" id="day">
					<option value="<?php echo $v_day ?>"><?php echo $v_day ?></option>
					<option value="Monday">Monday</option>
					<option value="Wednesday">Wednesday</option>
					<option value="Friday">Friday</option>
					</select><br><br>
						
				<label for="time"><b>Choose a time</b></label>
					<select name="time" id="time">
					<option value="9.00am to 11.00am">9.00am to 11.00am</option>
					<option value="12.00pm to 2.00pm">12.00pm to 2.00pm</option>
					<option value="3.00pm to 5.00pm">3.00pm to 5.00pm</option>
					<option value="6.00pm to 8.00pm">6.00pm to 8.00pm</option>
					</select><br><br>
			
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