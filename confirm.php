﻿<?php
session_start();
echo'<h3>Confirm Address</h3>';
echo '<p>'.'&nbsp;'.'</p>';

$firstname = $_SESSION['firstname'];
$lastname = $_SESSION['lastname'];
$age = $_SESSION['age'];
$gender = $_SESSION['gender'];
$streetaddress = $_SESSION['streetaddress'];
$city = $_SESSION['city'];
$county = $_SESSION['county'];
$postcode = $_SESSION['postcode'];

echo"NAME: $firstname ";
echo"$lastname<br/>";
echo"AGE: $age<br/>";
echo"GENDER: $gender<br/>";
echo"ADDRESS: $streetaddress<br/> ";
echo"CITY: $city<br/>";
echo"COUNTY OR TOWN: $county <br/>";
echo"POSTCODE: $postcode <br/>";

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>	
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	</head>
	<body>
		<a href="index.php?<?php echo SID; ?>">Home</a>
		
	</body>
</html>