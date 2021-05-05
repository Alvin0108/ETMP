<!DOCTYPE html>

<?php 
	session_start();
	$_SESSION["rid"] = $rid;
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
	
	<h1 align="center"> Select one of the venue <?php echo $rid ?> </h1> <br/><br/>
		<?php 
		$count = 1;
		echo "<table class='center'>
		<tr>
		<th>Room ID </th>
		<th>Image</th>
		<th>Room Name</th>
		<th>Tuition Day</th>
		<th>Description</th>
		<th>Selection</th>
		</tr>";
		
		while($row = mysqli_fetch_array($search_result))
		{
			$id = $row['venue_id'];
			$image = "image/room" . (string)$count . ".jpg";
			echo "<tr>";
			echo "<td>" . $id . "</td>";
			echo "<td>" . "
			<img src='$image' height=200px width=200px>" . "</td>";
			echo "<td>" . $row['venue_name'] . "</td>";
			echo "<td>" . $row['day'] . "</td>";
			echo "<td>" . $row['description'] . "</td>";
			echo "<td><form action=modify_venue.php>
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