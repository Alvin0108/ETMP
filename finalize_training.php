<!-- Start Session -->
<?php 
	session_start();
	$user_email = $user_ID = "";
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
		
		$name = $row['training_name'];
		$id = $row['training_id'];
		$fee = $row['training_fee'];
	}
	
	
	function filter($query)
	{
		$conn = mysqli_connect("localhost","root","","portal_database");
		$filter_data = mysqli_query($conn, $query);
		return $filter_data;
	}
?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<meta name="description" content="DP2" />
		<meta name="keywords" content="PHP" />
		<meta name="author" content="Alvin Chua Khai Chuen" />
		<link rel="stylesheet" href="style/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		<title>Finalize</title>
    </head>
	<header>
	<!--navigation-->
	<?php include "navigation.php";?>

	</header>
    <body>   
		<br><br>
		<div class="container">
        <form action="submit_training.php" method="post" class="check">
		<fieldset>
		<legend> Final Confirmation </legend>
			<br/>
			<label>User Email: </label>
			<input type="text" id="t_code" name="t_code" value="<?php echo $user_email ?>" disabled><br><br>
			
				<fieldset>
				<legend>Training Information</legend>
					<label>Training Code: </label>
					<input type="text" id="t_code" name="t_code" value="<?php echo $id ?>" disabled><br><br>
					<label>Training Name: </label>
					<input type="text" id="t_name" name="t_name" value="<?php echo $name ?>" disabled><br><br>
					<label>Fee: </label>
					<input type="text" id="fee" name="fee" value="RM <?php echo $fee ?>" disabled><br><br>
					<button type="submit" class="center" name="confirm"><i class="fa fa-check"> Confirm </i></button><br/><br/>
				</fieldset>
				
			<br/><br/>
			<a href="search.php"><i class="fa fa-ban"> Cancel </i></a>
		</fieldset>
		</form> 
		</div>
		
    </body>
</html>