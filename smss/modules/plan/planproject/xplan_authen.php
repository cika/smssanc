<?
session_start();
$mydata= ( $_POST );
$optioncase=$_REQUEST["optioncase"];
/*  From  date_anyform  */
$myday=$_REQUEST["myday"];
$mymonth=$_REQUEST["mymonth"];
$myyear=$_REQUEST["myyear"];
$vidperson=$_REQUEST["vidperson"];
/*  From  allot_main  */
$vcode_id=$_REQUEST["vcode_id"];
$vname_sch=$_REQUEST["vname_sch"];
$vname_allo=$_REQUEST["vname_allo"];
$vbudget_allo=$_REQUEST["vbudget_allo"];
/*  From  Budget54  */
$vcode_clus=$_REQUEST["vcode_clus"];
$vname_clus=$_REQUEST["vname_clus"];
$vcode_proj=$_REQUEST["vcode_proj"];
$vcode_tegy=$_REQUEST["vcode_tegy"];
$vname_proj=$_REQUEST["vname_proj"];
$vbudget_proj=$_REQUEST["vbudget_proj"];
$vowner_proj=$_REQUEST["vowner_proj"];
$fname=$_REQUEST["fname"];
$fname=trim($fname);
$cname=$_REQUEST["cname"];
$cname=trim($cname);
//$vowner_proj=$fname.$cname;
$mcode_clus=$_SESSION["mcode_clus"];
$number=(int)$vcode_clus;
if ($number>=1){
	if ($mcode_clus!=$vcode_clus){
				$_SESSION["vcode_id"]= ""; 
				$_SESSION["vcode_sch"]= ""; 
				$_SESSION["vname_allo"]= ""; 
				$_SESSION["vbudget_allo"]= "";
				$_SESSION["mcode_proj"]= ""; 
				$_SESSION["mname_proj"]= ""; 
				$_SESSION["mbudget_proj"]= "";
	}}
$chkoption=ord($optioncase);
switch ($chkoption)
{
	case "49";
	   //$lenfname=strlen($fname);
	   //$fname=str_pad($fname, $lenfname+1);
	   $_SESSION["mcode_tegy"]=$vcode_tegy;
	   $_SESSION["mcode_proj"]=$vcode_proj;
	   $_SESSION["mname_proj"]=$vname_proj;
	   $_SESSION["mbudget_proj"]=$vbudget_proj;
	   $_SESSION["mowner_proj"]=$fname.$cname;
	   $_SESSION["optioncase"]=99;
		break;
	case "50";
	   $_SESSION["mcode_clus"]= $vcode_clus;
       $_SESSION["mname_clus"]= $vname_clus;
	   $_SESSION["optioncase"]=99;
	   break;
}
$vcode_acti=$_REQUEST["vcode_acti"];
$vname_acti=$_REQUEST["vname_acti"];
$vcode_approve=$_REQUEST["vcode_approve"];
$vbudget_approve=$_REQUEST["vbudget_approve"];
$vbudget_acti=$_REQUEST["vbudget_acti"];
$mybeginday=$_REQUEST["mybeginday"];
$myfinishday=$_REQUEST["myfinishday"];
$index=$_REQUEST["index"];
//$_SESSION["index"]= $index; 
$vbudget_acti=(int)$vbudget_acti;
$vbudget_approve=(int)$vbudget_approve;
/* User  budget_list  */
				$idperson=$_REQUEST["idperson"];
				$midcode=$_REQUEST["midcode"];
				$chkmidcode = $idperson."".$midcode;
				$len_myid=strlen($chkmidcode);
				if ($len_myid==13)
				{
				$_SESSION["chkmidcode"]= $chkmidcode;
				$_SESSION["m9idperson"]= $idperson;
				$_SESSION["m4idperson"]= $midcode;
				}
/*  From  allot_main  */
			if ($vcode_id!=""){
				$_SESSION["vcode_id"]= $vcode_id; }
			if ($vname_sch!=""){
				$_SESSION["vname_sch"]= $vname_sch; }
				if ($vname_allo!=""){
				$_SESSION["vname_allo"]= $vname_allo; }
			if ($vbudget_allo!=""){
				$_SESSION["vbudget_allo"]= $vbudget_allo; }	
/*  From  Budget54  */
			if ($vcode_proj!=""){
				$_SESSION["mcode_proj"]= $vcode_proj;
					$mcode_proj=$vcode_proj;}
			if ($vbudget_proj!=""){
				$_SESSION["mbudget_proj"]= $vbudget_proj;}
/*   Global  Variable */	
	$sname_perm=$_SESSION["name_perm"];
	$chkmidcode=$_SESSION["chkmidcode"];
	$mid_person=$_SESSION["mid_person"];
	$mpms_view=$_SESSION["mpms_view"];
	$mpms_read=$_SESSION["mpms_read"];
	$mpms_add=$_SESSION["mpms_add"];
	$mpms_edit=$_SESSION["mpms_edit"];
	$mpms_dele=$_SESSION["mpms_dele"];
	$mpms_comm=$_SESSION["mpms_comm"];
	$mpms_moderate=$_SESSION["mpms_moderate"];
	$mpms_admin=$_SESSION["mpms_admin"];
/*  From  $_REQUEST  */
	$mcode_clus=$_SESSION["mcode_clus"];
    $mname_clus=$_SESSION["mname_clus"];
	$mcode_proj=$_SESSION["mcode_proj"];
	$mname_proj=$_SESSION["mname_proj"];
	$mbudget_proj=$_SESSION["mbudget_proj"];
	$mowner_proj=$_SESSION["mowner_proj"];
	$vcode_id=$_SESSION["vcode_id"];
	$vname_sch=$_SESSION["vname_sch"];
	$vname_allo=$_SESSION["vname_allo"];
	$vbudget_allo=$_SESSION["vbudget_allo"];
/*  Check  Variable  $_REQUEST  */
//echo "$mcode_clus<BR>";
//echo "$mcode_proj<BR>";
//echo "$mname_proj<BR>authen";
//echo "$chkmidcode<BR>";
//echo "$mid_person<BR>";
?>