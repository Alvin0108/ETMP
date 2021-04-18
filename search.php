<?php 
session_start();
$user_email = $user_ID = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];

?>

<!--search training with filter function-->
<?php
	$training_search = "";

	if(isset($_POST['search']))
	{
		$training_search = $_POST['training_search'];
		$query = "SELECT * FROM `training` WHERE CONCAT(`training_id`, `training_name`, `training_fee`) 
		LIKE '%".$training_search."%'";
		$search_result = filter($query);

	}else{
		$query = "SELECT * FROM `training`";
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
		<!--Search-->
        <form action="search.php" method="post" class="search">
            <input type="text" name="training_search" placeholder="Search..." value="<?php echo $training_search ?>">
			<button type="submit" name="search"><i class="fa fa-search"></i></button><br><br>
        </form>   
		
		<!--Display training-->
		<?php 
		echo "<table class='center'>
		<tr>
		<th>Id</th>
		<th>Training Name</th>
		<th>Fee</th>
		<th>Register</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			echo "<tr>";
			echo "<td>" . $row['training_id'] . "</td>";
			echo "<td>" . $row['training_name'] . "</td>";
			echo "<td> RM " . $row['training_fee'] . "</td>";
			echo "<td><form action=finalize_training.php>
			<input name=id type=hidden value='".$row['training_id']."'>   
			<input type=submit class='register' name=register value=Register>
			</form></td>";
			echo "</tr>";
		}
		echo "</table>";
		?>	
    </body>
</html>