<?php
	session_start();
	if(isset($_GET['id'])){
		$ID = $_GET['id'];
		$sql = "SELECT * FROM training WHERE training_id = '{$ID}'";
		$result = filter($sql);
		$row = mysqli_fetch_assoc($result);	
		
		$name = $row['training_name'];
		$id = $row['training_id'];
		$fee = $row['training_fee'];
	}
	if(isset($_POST['cancel'])){
		header("Location: search.php");
	}
	
	//next page havent finish
	if(isset($_POST['check'])){
		$_SESSION["s_id"] = $_GET['id'];
		header("Location: search.php");
		
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
		<title>Search</title>
    </head>
	<header>
	<!--navigation-->
	<?php include "navigation.php";?>

	</header>
    <body>   
		<br><br>
		<div class="container">
        <form method="post" class="check">
			<label>Training Code: </label>
			<input type="text" id="t_code" name="t_code" value="<?php echo $id ?>" disabled><br><br>
			<label>Training Name: </label>
			<input type="text" id="t_name" name="t_name" value="<?php echo $name ?>" disabled><br><br>
			<label>Fee: </label>
			<input type="text" id="fee" name="fee" value="RM <?php echo $fee ?>" disabled><br><br>
			<button type="cancel" name="cancel"><i class="fa fa-ban"></i></button>
			<button type="submit" name="check"><i class="fa fa-check"></i></button>
		</form> 
		</div>
    </body>
</html>