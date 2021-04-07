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
		<meta name="description" content="Expert.com" />
		<meta name="keywords" content="PHP" />
		<meta name="author" content="Alvin Chua" />
		<link rel="stylesheet" href="style.css">
		<title>Search</title>
    </head>
    <body>
        
        <form action="search.php" method="post">
            <input type="text" name="training_search" placeholder="What are you looking for?"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
            <table>
                <tr>
					<th>Id</th>
                    <th>Training Name</th>
                    <th>Information</th>
                </tr>
				<?php while($row = mysqli_fetch_array($search_result)):?>
					<tr>
						<td><?php echo $row['training_id'];?></td>
						<td><?php echo $row['training_name'];?></td>
						<td><?php echo $row['training_des'];?></td>
					</tr>
				<?php endwhile;?>
            </table>
        </form>       
    </body>
</html>