<?php

	$dbhost = 'gateway.eventially.com';
	$dbuser = 'admin_eventially'; 
	$dbpass = 'hackathon';

	$dbname = 'collabout';	
	$conn = mysql_connect($dbhost, $dbuser, $dbpass) or die ('Error connecting to mysql');
	
	mysql_select_db('collabout',$conn) or die ('Error connecting to db');
	mysql_query("SET NAMES 'utf8'");
	mysql_query("SET CHARACTER SET utf8");

?>