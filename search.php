<?php
	if(isset($_POST['search']))
	{
		$training_search = $_POST['training_search'];
		$query = "SELECT * FROM `training` WHERE CONCAT(`training_id`, `training_name`, `training_des`) 
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
        <form action="search.php" method="post" class="search">
            <input type="text" name="training_search" placeholder="Search...">
			<button type="submit" name="search"><i class="fa fa-search"></i></button><br><br>
        </form>   
            <table class="center">
                <tr>
					<th>Id</th>
                    <th>Training Name</th>
                    <th>Information</th>
					<th>Fee</th>
                </tr>
				<?php while($row = mysqli_fetch_array($search_result)):?>
					<tr>
						<td><?php echo $row['training_id'];?></td>
						<td><?php echo $row['training_name'];?></td>
						<td><?php echo $row['training_des'];?></td>
						<td><?php echo "RM ".$row['training_fee'];?></td>
					</tr>
				<?php endwhile;?>
            </table>	
    </body>
</html>