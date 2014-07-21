<?php
$sql="ALTER TABLE  `cabinet_main` ADD  `status` TINYINT NOT NULL AFTER  `doc_type`" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `mail_main` ADD INDEX ( `ref_id` )" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `mail_sendto_answer` ADD INDEX ( `ref_id` )" ;
$dbquery = mysql_query($sql);

$sql="ALTER TABLE `mail_sendto_answer` ADD INDEX ( `send_to` )" ;
$dbquery = mysql_query($sql);
?>
