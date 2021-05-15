<?php 
session_start();
$user_email = $user_ID = "";
$user_email = $_SESSION["user_email"];
$user_ID = $_SESSION["user_id"];

?>

<!--search training with filter function-->
<?php

	$query = "SELECT * FROM `registration` WHERE user_ID = $user_ID";
	$search_result = filter($query);

	function filter($query)
	{
		$conn = mysqli_connect("localhost","root","","portal_database");
		$filter_data = mysqli_query($conn, $query);
		return $filter_data;
	}
	
if(isset($_GET['id'])){
	$ID = $_GET['id']
	
	$query2 = "SELECT'FROM registration WHERE training_id = '{$ID}' AND user_ID = '{$user_ID}'";
	result = filter($query2);
	$row = mysqli_fetch_assoc($search_result);
	$RID = $row['register_id'];
	$sql2 = "DELETE FROM register_venue WHERE register_id = '{$RID}'";
	$result = filter($sql2);
	$sql = "DELETE FROM registration WHERE training_id = '{$ID}' AND user_ID = '{$user_ID}'";
	$result = filter($sql);
	
}
?>

<!DOCTYPE html>
<html>
    <head>
		<meta charset="utf-8" />
		<meta name="description" content="DP2" />
		<meta name="keywords" content="PHP" />
		<link rel="stylesheet" href="style/style.css">
		<title>Registered Training</title>
    </head>
	<header>
	<!--navigation-->
	<?php include "navigation.php";?>

	</header>
    <body>   
		<br><br>
		<!--Display training-->
		<?php 
		echo "<table class='center'>
		<tr>
		<th>Training Id</th>
		<th>Training Name</th>
		<th>Register date</th>
		<th>Training cancel</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			echo "<tr>";
			echo "<td>" . $row['training_id'] . "</td>";
			echo "<td>" . $row['training_name'] . "</td>";
			echo "<td>" . $row['register_date'] . "</td>";
			echo "<td><form action=registered_training.php>
			<input name=id type=hidden value='".row['training_id']."'>
			<input type=submit value=Cancel>
			</form></td>;
			echo "</tr>";
		}
		echo "</table>";
		?>	
    </body>
</html>