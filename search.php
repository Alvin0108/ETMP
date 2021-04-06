<?php
	if(isset($_POST['search']))
	{
	}else{
		$query = "SELECT * FROM 'info'";
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
        <title>Training Search</title>
    </head>
    <body>
        
        <form action="search.php" method="post">
            <input type="text" name="train_search" placeholder="What are you looking for?"><br><br>
            <input type="submit" name="search" value="Search"><br><br>
            <table>
                <tr>
					<th>Id</th>
                    <th>Training Name</th>
                    <th>Information</th>
                </tr>
				<?php while($row = mysqli_fetch_array($search_result))?>
					<tr>
						<td><?php echo $row['id'];?></td>
						<td><?php echo $row['Training Name'];?></td>
						<td><?php echo $row['Information'];?></td>
					</tr>
            </table>
        </form>       
    </body>
</html>