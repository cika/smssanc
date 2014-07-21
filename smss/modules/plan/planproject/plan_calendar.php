<?php
$mnum=date("m");
if ($mnum>="10")
{
	$myyear = mktime(0,0,0,date("m"),date("d"),date("Y")+1);
	$Ybudget=date("Y",$myyear);
	$dbudget="30";
	$mbudget="09";
} else {
	$Ybudget=date("Y");
	$dbudget="30";
	$mbudget="09";
}
	$Ynum=date("Y");
	$dnum=date("d");
	$mnum=date("m");
?>