<?php

include '../database/connect.php';


$eventType=$_GET['t'];
$listname=$_GET['listname'];
$eventValue=$_GET['val'];
$eventid=$_GET['eventid'];


if($eventType=='checklist')
{	
	$table=$eventid."_List";
	$queryList="INSERT INTO `collabout`.`$table` (`ID`, `List`, `AddedBy`, `Item`, `Status`) VALUES (NULL, '$listname', '', '$eventValue', 0)";
	
	echo "<script> alert('$queryList')</script>";
	
	mysql_query($queryList);
}
else
{
	$table=$eventid."_Poll";
	$queryPoll="INSERT INTO  `collabout`.`$table` (
	`ID` ,
	`Responder` ,
	`Question` ,
	`Response`
	)
	VALUES (
	NULL ,  '1',  '$listname',  '$eventValue'
	)";
	
	mysql_query($queryPoll);
}



?>