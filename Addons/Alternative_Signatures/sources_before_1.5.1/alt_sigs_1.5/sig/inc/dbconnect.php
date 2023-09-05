<?php
// MYSQL CONNECT
$dbcnx = @mysqli_connect($dbhost,$dbuser,$dbpass);
if (!$dbcnx)
{
	echo "MySQL connection failed";
	die;
}

// CHOOSING DB
if (!@mysqli_select_db($dbcnx, $dbname)) 
{
	echo "DB connection failed";
	die;
} else {
	mysqli_query($dbcnx, "SET NAMES 'utf8'");
}
?>