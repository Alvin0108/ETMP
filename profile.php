<?php 
session_start();
$user_email = $user_ID = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];
$user_name = $_SESSION["user_name"];

?>
<!DOCTYPE html>
<html lang="en">

<head>
	<<title>Profile</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="user, profile, user profile, edit, profile picture, user information, user account">
	<meta name="keywords" content="ETMP">
    <meta name="author" content="Alvin Chua Khai Chuen, Gillian Tan">
	
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,500,700,900" rel="stylesheet">

    <!-- CSS Files -->
    <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="css/font-awesome.css">
    <link rel="stylesheet" type="text/css" href="css/index.css">
    <link rel="stylesheet" type="text/css" href="css/owl-carousel.css">
</head>


	<body>
	
	<!-- Preloader Starts -->
    <div id="preloader">
        <div class="jumper">
            <div></div>
            <div></div>
            <div></div>
        </div>
    </div>  
    <!-- Preloader End -->
    
    
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
	
	<?php
		$conn = mysqli_connect("localhost","root","","portal_database");		// Connect to database
		//Declare variable
		$desc = $gender = "";
		$query = "SELECT * FROM users WHERE user_email='$user_email'";
		$results= mysqli_query($conn, $query);
		$row = mysqli_fetch_assoc($results);
		
		$sql = "SELECT count(training_id) AS total FROM registration WHERE user_id='$user_ID'";
		$result = mysqli_query($conn,$sql);
		$num = mysqli_fetch_assoc($result);
		$total = $num['total'];
		
		// Assign the Session variable so the page it direct can recieve the info
		$desc = $row["description"];
		$gender = $row["gender"];
		
	?>
	
	<!-- Welcome Area Start -->
    <div class="welcome-area" id="welcome">

        <!-- Header Text Start -->
        <div class="header-text">
            <div class="container">
                <div class="row">
                    <div class="left-text col-lg-6 col-md-6 col-sm-12 col-xs-12" data-scroll-reveal="enter left move 30px over 0.6s after 0.4s">
                        <h1>Welcome</h1>
                    </div>
          
                </div>

        </div>
        <!-- Header Text End -->
    </div>
	</div>
    <!-- Welcome Area End -->	
	
    <!-- Features Big Item Start -->
    <section class="section" id="about">
        <div class="container">
		
        <form>
		<div class="center">
			<h2>Profile</h2>
			<hr>
			<fieldset>
			<br><label><b>Name</b></label>
			<input type="text" name="name" id="name" value=<?php echo $user_name ?> disabled><br/><br/>
	
			<label><b>Email</b></label>
			<input type="text" name="email" id="email" value=<?php echo $user_email ?> disabled><br/><br/>

			<label><b>Gender</b></label>
			<input type="text" name="gender" id="gender" value=<?php echo $gender ?> disabled><br/><br/>
			
			<label><b>About</b></label>
			<input type="text" name="desc" id="desc" value=<?php echo $desc ?> disabled><br/><br/>
			
			<label><b>Total Training</b></label>
			<input type="text" name="num" id="num" value=<?php echo $total ?> disabled><br/><br/>
			</fieldset>
			
			<style>
			
			input {
			  width: 100%;
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

			<br>
			<hr>
		</div>
		</form>
		
		<div class="center">
			<a href="account.php" class="main-button-slider">Edit Account</a>
			<a href="registered_training.php" class="main-button-slider">View Registered Training</a>
		</div>
		
        </div>

    </section>
    <!-- Features Big Item End -->


    
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
