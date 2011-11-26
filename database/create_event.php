<?php
ob_start();

include 'connect.php';

$eventname=$_POST['name'];
$description=$_POST['description'];

$query="INSERT INTO `collabout`.`events` (`ID`, `Title`, `Description`, `Date`, `Group`) VALUES (NULL, '$eventname', '$description', '', '1');";

if(mysql_query($query))
{
	$queryGet="SELECT * FROM `events` WHERE Title='$eventname'";
	$resultID=mysql_query($queryGet);
	
	$ID=mysql_result($resultID, 0, "ID");
	
	echo $ID;
	
	$tablePoll=$ID."_Poll";
	$tableList=$ID."_List";
	
	$queryPoll="CREATE TABLE  `collabout`.`$tablePoll` (
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`Responder` INT NOT NULL ,
	`Question` VARCHAR( 500 ) NOT NULL ,
	`Response` VARCHAR( 200 ) NOT NULL
	) ENGINE = MYISAM" ;
	
	mysql_query($queryPoll) or die('No POLL!');
	
	
	$queryList="CREATE TABLE  `collabout`.`$tableList` (
	`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
	`List` VARCHAR( 200 ) NOT NULL ,
	`AddedBy` INT NOT NULL ,
	`Item` VARCHAR( 400 ) NOT NULL ,
	`Status` BOOL NOT NULL
	) ENGINE = MYISAM ";
	
	mysql_query($queryList) or die('No LIST!');
	
	header("location:../event.php?selectedEvent=$ID");
	
}
else
{
	echo "Could not be created.";
}




?>