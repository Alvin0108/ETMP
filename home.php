<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Tay Yuan Long" />
<link rel="stylesheet" href="style/style.css">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<title>Home Page</title>
</head>

<body>
<br/><br/>
<h1>Welcome to <br/>Expert Training Portal</h1>
<br/><br/>
<div class="center">
	<a href="login.php"><button class="button user" >Login as user </button></a><br/>
	<a href="admin_login.php"><button class="button user" >Login as admin</button></a>
</div>

<?php
$database = mysqli_connect("localhost","root","");
mysqli_query($database, "CREATE DATABASE IF NOT EXISTS portal_database"); // Create database if not exists

$conn = mysqli_connect("localhost","root","","portal_database");
// Creating tables if not exists
mysqli_query($conn, "create table IF NOT EXISTS users (
user_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_name VARCHAR(20) NOT NULL,
user_email VARCHAR(50) NOT NULL,
password  VARCHAR(100) NOT NULL,
description VARCHAR(50) NOT NULL,
gender VARCHAR(50) NOT NULL
);");
mysqli_query($conn, "create table IF NOT EXISTS admin (
admin_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
admin_email VARCHAR(50) NOT NULL,
admin_password  VARCHAR(100) NOT NULL
);");
mysqli_query($conn,"create table IF NOT EXISTS training (
training_id VARCHAR(10) NOT NULL,
training_name VARCHAR(20) NOT NULL,
training_des VARCHAR(250),
training_fee INT NOT NULL,
start_date DATE NOT NULL,
end_date DATE NOT NULL,
mode VARCHAR(10) NOT NULL
);");
mysqli_query($conn,"create table IF NOT EXISTS registration (
register_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT NOT NULL,
training_id VARCHAR(10) NOT NULL,
training_name VARCHAR(20) NOT NULL,
register_date DATE NOT NULL,
training_date DATE NOT NULL,
training_mode VARCHAR(10) NOT NULL,
training_time VARCHAR(40) NOT NULL
);");

//$sql = "INSERT INTO users (user_name,user_email,password,description,gender) VALUES ('Alvin','alvin@hotmail.com','0000');";
//$sql .= "INSERT INTO users (user_name,user_email,password,description,gender) VALUES ('Gillian','gillian@yahoo.com','1111');";
//$sql .= "INSERT INTO users (user_name,user_email,password,description,gender) VALUES ('Jack','jack@gmail.com','2222');";

$train = "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) VALUES ('ID01','Java Programming','Learn basic Java','200','2022-01-10','2022-01-13','online');";
$train .= "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) VALUES ('ID02','Python Programming','Learn how to use python','200','2022-01-10','2022-01-13','online');";
$train .= "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) VALUES ('ID03','Engineering','Basic information of engineering','150','2022-01-15','2022-01-18','online');";
$train .= "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) VALUES ('ID04','Cooking','Cooking Sunday','500','2022-01-10','2022-01-15','online');";
$train .= "INSERT INTO training (training_id, training_name, training_des, training_fee, start_date,end_date, mode) VALUES ('ID05','Leadership Skill','Time to lead your own company','500','2022-02-02','2022-02-05','online');";

//$reg = "INSERT INTO registration (user_id,training_id,training_name,register_date) VALUES ('1','ID01','Java Programming','2020-12-05');";
//$reg .= "INSERT INTO registration (user_id,training_id,training_name,register_date) VALUES ('1','ID02','Python Programming','2020-12-10');";
//$reg .= "INSERT INTO registration (user_id,training_id,training_name,register_date) VALUES ('2','ID03','Engineering','2021-2-3');";
	
$user = mysqli_query($conn, "Select * from users");
$training = mysqli_query($conn, "Select * from training");
$register = mysqli_query ($conn, "Select * from registration");

if (mysqli_num_rows($training) <= 0) {
	$result = mysqli_multi_query($conn, $train);
	if($result != false)
	{
		echo "<h4>Training tables successfully created and populated</h4><br/>";
	
	}
	else
	{
		echo "Error: " . $result . "<br>" . mysqli_error($conn). "<br>";
	}
}

/*
if (mysqli_num_rows($register) <= 0) {
	$result = mysqli_multi_query($conn, $reg);
	if($result != false)
	{
		echo "<h4>Training tables successfully created and populated</h4><br/>";
	
	}
	else
	{
		echo "Error: " . $result . "<br>" . mysqli_error($conn). "<br>";
	}
}
while ($row = mysqli_fetch_assoc($register)) {
	echo "User ID : " . $row['user_id'] . "  Training ID : " . $row['training_id'] . " Training Name : " . $row['training_name'] . 
	"   Register Date : " . $row['register_date'] . "<br/>";
}


while ($row = mysqli_fetch_assoc($training)) {
	echo "User ID : " . $row['user_id'] . "  Training ID : " . $row['training_id'] . " Training Name : " . $row['training_name'] . 
	"   Training Description : " . $row['training_des'] . " Training Fee : " . $row['training_fee'] . "<br/>";
}

*/

$database->close();
$conn->close();

?>

<?php

$conn = mysqli_connect("localhost","root","","portal_database");	
mysqli_query($conn, "create table IF NOT EXISTS venues (
venue_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
venue_name VARCHAR(20) NOT NULL,
day VARCHAR(10) NOT NULL,
availability VARCHAR(10) default 'Available',
description VARCHAR(200) NOT NULL
);");
mysqli_query($conn, "create table IF NOT EXISTS register_venue (
rv_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
register_id VARCHAR(20) NOT NULL,
venue_id VARCHAR(20) NOT NULL,
day VARCHAR(10) NOT NULL,
time VARCHAR(40)
);");
$sql_venue = "INSERT INTO venues (venue_name, day, description) VALUES ('Room A', 'Thursday', 'Its a room designed for user that prefer grouping');";
$sql_venue .= "INSERT INTO venues (venue_name, day, description) VALUES ('Room B', 'Tuesday', 'Its a room designed for user that prefer quite environment');";
$sql_venue .= "INSERT INTO venues (venue_name, day, description) VALUES ('Room C', 'Saturday', 'Its a room designed for user that prefer interact with both others');";

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

$conn->close();
?>


</body>
</html>