jQuery.ajax('http://localhost/facebook_hackathon/api/new_list.php?t='+type+'&listname='+question+'&firstval='+element.value+'&eventid='+eventID);


<?php

include '../database/connect.php';


$eventType=$_GET['t'];
$listname=$_GET['listname'];
$eventValue=$_GET['firstval'];
$eventid=$_GET['eventid'];


if($eventType=='checklist')
{	
	$table=$eventid."_List";
	$queryList="INSERT INTO `collabout`.`$table` (`ID`, `List`, `AddedBy`, `Item`, `Status`) VALUES (NULL, '$listname', '', '$eventValue', 0)";
	
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

