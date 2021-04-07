<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <meta name="keywords" content="PHP" />
 <title>ETMP</title>
</head>
<body>
	<h1>Registration Page</h1>
	<form action ="recordsave.php" method ="POST" >
		<label for="name">Name: 
		<input type="text" name="name" id="name"/><br/><br/></label>
		
		<label for="ID">Training ID: 
		<input type="number" name="trainingid" id="trainingid"/><br/><br/></label>
		<input type="submit" name="submit" value="Submit"/>
	</form>
</body>
</html>
