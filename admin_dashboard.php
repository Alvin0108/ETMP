<?php 
session_start();
$admin_email = $admin_id = "";
$admin_email = $_SESSION["admin_email"];
$admin_id = $_SESSION["admin_id"];
?>
<?php
//Limit and show last 5 record
$query = "SELECT * FROM `registration` ORDER BY register_id DESC LIMIT 5";
$search_result = filter($query);

$query2 = "SELECT * FROM `users`";
$user_result = filter($query2);

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
	<title> Admin Page </title>
	<meta charset ="utf-8">
	<meta name="author" content="Alvin Chua">
	<meta name="descrtiption" content="Admin Dashboard">
	<meta name="keywords" content="ETMP,dashboard">
	<link rel="stylesheet" href="style/style.css">
</head>
<header>
	<?php include ("admin_navigation.php"); ?>
</header>
<body>
	<h2 class="center">Dashboard</h2>
            <table class="center">
			  <caption>Latest 5 User Registration Record (<a href="searchRegister.php">View more</a>)</caption>
                <tr>
					<th>Register ID</th>
					<th>User ID</th>
					<th>Training ID</th>
                    <th>Training Name</th>
                    <th>Register Date</th>
					<th>Start Date</th>
					<th>Mode</th>
                </tr>
				<?php while($row = mysqli_fetch_array($search_result)):?>
					<tr>
						<td><?php echo $row['register_id'];?></td>
						<td><?php echo $row['user_id'];?></td>
						<td><?php echo $row['training_id'];?></td>
						<td><?php echo $row['training_name'];?></td>
						<td><?php echo $row['register_date'];?></td>
						<td><?php echo $row['training_date'];?></td>
						<td><?php echo $row['training_mode'];?></td>
					</tr>
				<?php endwhile;?>
            </table>
			<br/>
			<table class="center">
			  <caption>User Record</caption>
                <tr>
					<th>User ID</th>
					<th>User Name</th>
                    <th>User Email</th>
                </tr>
				<?php while($row = mysqli_fetch_array($user_result)):?>
					<tr>
						<td><?php echo $row['user_id'];?></td>
						<td><?php echo $row['user_name'];?></td>
						<td><?php echo $row['user_email'];?></td>
					</tr>
				<?php endwhile;?>
            </table>
</body>
</html>
