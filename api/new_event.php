<?php 

include '../database/connect.php';

$eventit=$_POST['eventid'];

$queryPoll= "CREATE TABLE  `collabout`.`'OLDUOLDUOLLALALALALASDFASDFSADFASF'` (
`ID` INT NOT NULL AUTO_INCREMENT PRIMARY KEY ,
`Responder` INT NOT NULL ,
`Question` VARCHAR( 500 ) NOT NULL ,
`Response` VARCHAR( 200 ) NOT NULL
) ENGINE = MYISAM" ;

echo "ohye";

mysql_query($queryPoll) or die('No POLL!');

?>