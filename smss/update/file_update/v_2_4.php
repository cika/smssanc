<?php
$sql="ALTER TABLE  `system_module` ADD  `web_link` TINYINT NULL AFTER  `module_order`" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE  `system_module` ADD  `url` VARCHAR( 150 ) NULL AFTER  `web_link`" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE  `meeting_main` ADD  `person_num` INT NOT NULL AFTER  `reason` ,
ADD  `other` VARCHAR( 250 ) NOT NULL AFTER  `person_num`" ;
$dbquery = mysql_query($sql);

?>
