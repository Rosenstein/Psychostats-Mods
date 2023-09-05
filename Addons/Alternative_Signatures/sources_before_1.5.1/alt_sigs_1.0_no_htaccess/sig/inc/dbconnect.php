<?php
// MYSQL CONNECTING
$dbcnx = @mysql_connect($dbhost,$dbuser,$dbpass);
if (!$dbcnx)
{
	echo "MySQL connection failed";
	die;
}

// CHOOSING DB
if (!@mysql_select_db($dbname, $dbcnx)) 
{
	echo "DB connection failed";
	die;
} else {
	mysql_query("SET NAMES 'utf8'");
}
?>