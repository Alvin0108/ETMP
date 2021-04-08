<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="description" content="Web application development" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Tay Yuan Long" />
<link rel="stylesheet" href="style.css">
<title>Home Page</title>
</head>

<body>

<h1>Sprint 1</h1> 
<h1>Expert Training Management Portal</h1>

<?php
$database = mysqli_connect("localhost","root","");
mysqli_query($database, "CREATE DATABASE IF NOT EXISTS portal_database"); // Create database if not exists

$conn = mysqli_connect("localhost","root","","portal_database");
// Creating tables if not exists
mysqli_query($conn, "create table IF NOT EXISTS users (
user_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_name VARCHAR(20) NOT NULL,
user_email VARCHAR(50) NOT NULL,
password  VARCHAR(20) NOT NULL
);");
mysqli_query($conn,"create table IF NOT EXISTS training (
user_id INT NOT NULL,
training_id VARCHAR(10) NOT NULL,
training_name VARCHAR(20) NOT NULL,
training_des VARCHAR(250),
training_fee INT NOT NULL
);");
mysqli_query($conn,"create table IF NOT EXISTS registration (
register_id INT AUTO_INCREMENT PRIMARY KEY NOT NULL,
user_id INT NOT NULL,
training_id VARCHAR(10) NOT NULL,
training_name VARCHAR(20) NOT NULL,
register_date DATE NOT NULL
);");

$sql = "INSERT INTO users (user_name,user_email,password) VALUES ('Alvin','alvin@hotmail.com','0000');";
$sql .= "INSERT INTO users (user_name,user_email,password) VALUES ('Gillian','gillian@yahoo.com','1111');";
$sql .= "INSERT INTO users (user_name,user_email,password) VALUES ('Jack','jack@gmail.com','2222');";

$train = "INSERT INTO training (user_id, training_id, training_name, training_des, training_fee) VALUES ('1','ID01','Java Programming','Learn basic Java','200');";
$train .= "INSERT INTO training (user_id, training_id, training_name, training_des, training_fee) VALUES ('2','ID02','Python Programming','Learn how to use python','200');";
$train .= "INSERT INTO training (user_id, training_id, training_name, training_des, training_fee) VALUES ('3','ID03','Engineering','Basic information of engineering','2000');";
$train .= "INSERT INTO training (user_id, training_id, training_name, training_des, training_fee) VALUES ('4','ID04','Cooking','Cooking Sunday','500');";
$train .= "INSERT INTO training (user_id, training_id, training_name, training_des, training_fee) VALUES ('5','ID05','Leadership Skill','Time to lead your own company','500');";

$reg = "INSERT INTO registration (user_id,training_id,training_name,register_date) VALUES ('1','ID01','Programming','2020-12-05');";
$reg .= "INSERT INTO registration (user_id,training_id,training_name,register_date) VALUES ('1','ID01','Programming','2020-12-10');";
$reg .= "INSERT INTO registration (user_id,training_id,training_name,register_date) VALUES ('1','ID01','Programming','2021-2-3');";
	
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


if (mysqli_num_rows($user) <= 0) {
	$result = mysqli_multi_query($conn, $sql);
	
	if($result != false)
	{
		echo "<h4>User tables successfully created and populated</h4><br/>";
	
	}
	else
	{
		echo "Error: " . $query . "<br>" . mysqli_error($conn). "<br>";
	}
}

while ($row = mysqli_fetch_assoc($user)) {
	echo "ID : " . $row['user_id'] . "  Name : " . $row['user_name'] . "   Email : " . $row['user_email'] . "   Password : " . $row['password'] . "<br/>";
}

while ($row = mysqli_fetch_assoc($training)) {
	echo "User ID : " . $row['user_id'] . "  Training ID : " . $row['training_id'] . " Training Name : " . $row['training_name'] . 
	"   Training Description : " . $row['training_des'] . " Training Fee : " . $row['training_fee'] . "<br/>";
}

*/
$database->close();
$conn->close();
?>


</body>
</html>