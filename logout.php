<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
<meta charset="utf-8" />
<meta name="description" content="DP2" />
<meta name="keywords" content="PHP" />
<meta name="author" content="Alvin Chua" />
<link rel="stylesheet" href="style/style.css">
<title>Log Out</title>
</head>
<body>

</body>

</html>

<?php
// remove all session variables
session_unset();
// destroy the session
session_destroy();

header("Location: home.php");

?>