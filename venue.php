<!DOCTYPE html>

<?php 
	session_start();
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
<?php

$conn = mysqli_connect("localhost","root","","portal_database");	
mysqli_query($conn, "create table IF NOT EXISTS venues (
venue_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
venue_name VARCHAR(20) NOT NULL,
time VARCHAR(40) NOT NULL,
number INT (10) NOT NULL,
availability VARCHAR(10) default 'Available',
description VARCHAR(200) NOT NULL
);");

$sql_venue = "INSERT INTO venues (venue_name, time, number, description) VALUES ('Room A', '3.00 - 6.00p.m. each Thursday', '40', 'Its a room designed for user that prefer grouping');";
$sql_venue .= "INSERT INTO venues (venue_name, time, number, description) VALUES ('Room B', '2.00 - 5.00p.m. each Tuesday', '20', 'Its a room designed for user that prefer quite environment');";
$sql_venue .= "INSERT INTO venues (venue_name, time, number, description) VALUES ('Room C', '4.00 - 7.00p.m. each Saturday', '30', 'Its a room designed for user that prefer interact with both others');";

$venue = mysqli_query($conn, "Select * from venues");

if (mysqli_num_rows($venue) <= 0) {
	$result = mysqli_multi_query($conn, $sql_venue);
	if($result != false)
	{
		echo "<h4>Venue tables successfully created and populated</h4><br/>";
	
	}
	else
	{
		echo "Error: " . $result . "<br>" . mysqli_error($conn). "<br>";
	}
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
		<?php 
		$count = 1;
		echo "<table class='center'>
		<tr>
		<th>Image</th>
		<th>Room ID </th>
		<th>Room Name</th>
		<th>Tuition Time</th>
		<th>Number of people participated</th>
		<th>Description</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			$id = $row['venue_id'];
		
			$image = "image/room_" . (string)$count . ".png";
			echo "<tr>";
			echo "<td>" . "
			<img src='$image' height=200px width=200px>" . "</td>";
			echo "<td>" . $row['venue_id'] . "</td>";
			echo "<td>" . $row['venue_name'] . "</td>";
			echo "<td>" . $row['time'] . "</td>";
			echo "<td>" . $row['number'] . "</td>";
			echo "<td>" . $row['description'] . "</td>";
			echo "<td><form action=finalize_training.php>
			<input name=id type=hidden value='".$row['venue_id']."'>   
			<input type=submit class='Select' name=select value=SELECT>
			</form></td>";
			echo "</tr>";
			$count++;
		}
		echo "</table>";
		?>	

</body>
</html>