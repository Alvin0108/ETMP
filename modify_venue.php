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

<html lang="en">

<head>
	<title> Venue Selection </title>
	<meta charset ="utf-8">
	<meta name="descrtiption" content="php">
	<meta name="keywords" content="ETMP">
	<link rel="stylesheet" href="style/style.css">
</head>
	<header>
		<!--navigation-->
	<?php include "navigation.php";?>

	</header>
	<body> 
		<div class="container">
        <form action="finalize_venue.php" method="post" class="check">
		<fieldset>
		<legend> Venue Modification </legend>
			<br/>
			<label>User Email: </label>
			<input type="text" id="t_code" name="t_code" value="<?php echo $user_email ?>" disabled><br><br>
			
				<fieldset>
				<legend>Venue Information</legend>
					<label>Registration ID: </label>
					<input type="text" id="reg" name="reg" value="<?php echo $rid ?>" disabled><br><br>
					<label>Venue ID: </label>
					<input type="text" id="code" name="code" value="<?php echo $v_id ?>" disabled><br><br>
					<label>Venue Name: </label>
					<input type="text" id="name" name="name" value="<?php echo $v_name ?>" disabled><br><br>
					<label>Description: </label>
					<input type="text" id="desc" name="desc" value=" <?php echo $v_desc ?>" disabled><br><br>
					<label for="day">Choose a Day: </label>
						<select name="day" id="day">
						<option value="<?php echo $v_day ?>"><?php echo $v_day ?></option>
						<option value="Monday">Monday</option>
						<option value="Wednesday">Wednesday</option>
						<option value="Friday">Friday</option>
						</select><br><br>
					<label for="time">Choose a time:</label>
						<select name="time" id="time">
						<option value="9.00am to 11.00am">9.00am to 11.00am</option>
						<option value="12.00pm to 2.00pm">12.00pm to 2.00pm</option>
						<option value="3.00pm to 5.00pm">3.00pm to 5.00pm</option>
						<option value="6.00pm to 8.00pm">6.00pm to 8.00pm</option>
						</select><br><br>
					<button type="submit" class="center" name="confirm"><i class="fa fa-check"> Confirm </i></button><br/><br/>
				</fieldset>
				
			<br/><br/>
			<a href="venue.php"><i class="fa fa-ban"> Cancel </i></a>
		</fieldset>
		</form> 
		</div>


	</body>
</html>