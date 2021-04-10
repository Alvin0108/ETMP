<!DOCTYPE html>
<html lang="en">
<head>
 <meta charset="utf-8" />
 <title>ETMP</title>
</head>
<body>
	<h1>Registration Record</h1>
	<?php 
	if (!is_dir('C:\Users\Asus\Desktop\TOOLS\xampp2/htdocs/etmp/data')) 
	{
		mkdir('C:\Users\Asus\Desktop\TOOLS\xampp2/htdocs/etmp/data');
	}
	
	 if (isset($_POST["name"])&& isset($_POST["trainingid"])) 
	 { 
		$name = $_POST["name"]; 
		$trainingid = $_POST["trainingid"]; 
		if(!empty($name)&&!empty($trainingid))
		{
			$filename = "data/record.txt"; 
			$handle = fopen($filename, "a"); 
			$data = $name . "," . $trainingid . "\r\n"; 
			fwrite($handle, $data); 
			fclose($handle); 
			
			echo "<p>Record</p> "; 
			
			 $handle = fopen($filename, "r");
			 
			 while (!feof($handle)) 
			 { 
				$data = fgets($handle); 
				echo "<p>", $data, "\r\n</p>"; 
			 }
			 fclose($handle); 
		}else
		{
			echo "<p>Please enter name and trainingID in the input form.</p>";
		}
	} 
	else 
	{ 
		echo "<p>Please enter name and trainingID in the input form.</p>";
	}
	?>
</body>
</html>