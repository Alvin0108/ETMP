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
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			echo "<tr>";
			echo "<td>" . $row['training_id'] . "</td>";
			echo "<td>" . $row['training_name'] . "</td>";
			echo "<td>" . $row['register_date'] . "</td>";
			echo "</tr>";
		}
		echo "</table>";
		?>	
    </body>
</html>