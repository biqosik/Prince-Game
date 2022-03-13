<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title></title>
</head>
<body>
<?php

include 'connection.php';

if(isset($_SESSION['login'])){
	unset($_SESSION['login']);
	unset($_SESSION['id']);
		header("Location:login.php");
	}
header("Location:login.php");
?>
</body>
</html>