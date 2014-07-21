<?php
//session_start(); 
$mydata=($_POST);
if(isset($_REQUEST["optioncase"])){
$optioncase=$_REQUEST["optioncase"];
}else{$optioncase="0";}   //กำหนดค่าเริ่มต้น

require_once("dbconfig.inc.php");
$sql = "select * from  plan_year where year_active='1' order by budget_year desc limit 1";
$dbquery =DBfieldQuery($sql);
$year_active_result = mysql_fetch_array($dbquery);
$_SESSION['mplan_year']=$year_active_result['budget_year'];

$sql = "select * from plan_setgic_year where year_active='1'";
$dbquery =DBfieldQuery($sql);
$ref_result = mysql_fetch_array($dbquery);
$_SESSION['sd_year']=$year_active_result['budget_year'];

/*  From  date_anyform  */
if(isset($_REQUEST["myday"])){
$myday=$_REQUEST["myday"];
}
if(isset($_REQUEST["mymonth"])){
$mymonth=$_REQUEST["mymonth"];
}
if(isset($_REQUEST["myyear"])){
$myyear=$_REQUEST["myyear"];
}
if(isset($_REQUEST["vidperson"])){
$vidperson=$_REQUEST["vidperson"];
}
/*  From  Budget54  */
if(isset($_REQUEST["vbudget_year"])){
$vbudget_year=$_REQUEST["vbudget_year"];
}
if(isset($_REQUEST["vcode_clus"])){
$vcode_clus=$_REQUEST["vcode_clus"];
}
if(isset($_REQUEST["vname_clus"])){
$vname_clus=$_REQUEST["vname_clus"];
}else {$vname_clus='';}
if(isset($_REQUEST["vcode_proj"])){
$vcode_proj=$_REQUEST["vcode_proj"];
}
if(isset($_REQUEST["vcode_tegy"])){
$vcode_tegy=$_REQUEST["vcode_tegy"];
}else{$vcode_tegy=""; }  //กำหนดค่าเริ่มต้น

if(isset($_REQUEST["vname_proj"])){
$vname_proj=$_REQUEST["vname_proj"];
}else{$vname_proj=""; }

if(isset($_REQUEST["vbudget_proj"])){
$vbudget_proj=$_REQUEST["vbudget_proj"];
}else{$vbudget_proj=""; }

$vbudget_proj_2=$vbudget_proj;

if(isset($_REQUEST["vbudget_approve"])){
$vbudget_approve=$_REQUEST["vbudget_approve"];
}else{$vbudget_approve=""; }

if(isset($_REQUEST["vidperson"])){
$vidperson=$_REQUEST["vidperson"];
}else{$vidperson=""; }

if(isset($_REQUEST["dayseri"])){
$dayseri=$_REQUEST["dayseri"];
}else{$dayseri=""; }

if(isset($_REQUEST["vowner_proj"])){
$vowner_proj=$_REQUEST["vowner_proj"];
}
if(isset($_REQUEST["fname"])){
$fname=$_REQUEST["fname"];
}else{$fname=""; }
if(isset($fname)){
$fname=trim($fname);
}
if(isset($_REQUEST["cname"])){
$cname=$_REQUEST["cname"];
}else{$cname=""; }
if(isset($cname)){
$cname=trim($cname);
}
//$vowner_proj=$fname.$cname;
if(isset($_SESSION["mcode_clus"])){
$mcode_clus=$_SESSION["mcode_clus"];
}
else{
$mcode_clus="";   //กำหนดค่าว่าง
}

if(isset($vcode_clus)){
$number=(int)$vcode_clus;
}

if(isset($number)){
	if ($number>=1){
		if ($mcode_clus!=$vcode_clus){
					$_SESSION["vcode_id"]= ""; 
					$_SESSION["vcode_sch"]= ""; 
					$_SESSION["vname_allo"]= ""; 
					$_SESSION["vbudget_allo"]= "";
					//$_SESSION["mcode_proj"]= ""; 
					//$_SESSION["mname_proj"]= ""; 
					//$_SESSION["mbudget_proj"]= "";
		}
	}
}
	
if(isset($optioncase)){
$chkoption=ord($optioncase);
}

if(isset($chkoption)){
	switch ($chkoption)
	{
		case "48";
 		   $_SESSION["vclus_code"]='';
		   $_SESSION["vproj_code"]='';
		   $_SESSION["vproj_name"]='';
		   $_SESSION["vbudget_proj"]='';
		   $_SESSION["vname_clus"]='';
			$_SESSION["mcode_tegy"]= "";
			$_SESSION["mcode_proj"]= "";
			$_SESSION["mname_proj"]= "";
			$_SESSION["mbudget_proj"]= "";
			$_SESSION["mowner_proj"]="";
			break;
		case "49";
		   //$lenfname=strlen($fname);
		   //$fname=str_pad($fname, $lenfname+1);
		   $_SESSION["mcode_tegy"]=$vcode_tegy;
		   $_SESSION["mcode_proj"]=$vcode_proj;
		   $_SESSION["mname_proj"]=$vname_proj;
		   $_SESSION["mbudget_proj"]=$vbudget_proj;
		   $_SESSION["mowner_proj"]=$fname.$cname;
		   $_SESSION["optioncase"]=99;
			
		   $_SESSION["vproj_code"]=$_SESSION["mcode_proj"];
		   $_SESSION["vproj_name"]=$_SESSION["mname_proj"];
		   $_SESSION["vbudget_proj"]=$_SESSION["mbudget_proj"];
			break;
		case "50";
		   $_SESSION["mcode_clus"]= $vcode_clus;
		   $_SESSION["mname_clus"]= $vname_clus;
		   $_SESSION["optioncase"]=99;
		   $_SESSION["vclus_code"]=$_SESSION["mcode_clus"];
		   break;
	}
}

if(isset($_REQUEST["vcode_acti"])){
$vcode_acti=$_REQUEST["vcode_acti"];
}
if(isset($_REQUEST["vname_acti"])){
$vname_acti=$_REQUEST["vname_acti"];
}
if(isset($_REQUEST["vcode_approve"])){
$vcode_approve=$_REQUEST["vcode_approve"];
}
if(isset($_REQUEST["vbudget_approve"])){
$vbudget_approve=$_REQUEST["vbudget_approve"];
}
if(isset($_REQUEST["vbudget_acti"])){

$vbudget_acti=$_REQUEST["vbudget_acti"];
}
if(isset($_REQUEST["mybeginday"])){

$mybeginday=$_REQUEST["mybeginday"];
}
if(isset($_REQUEST["myfinishday"])){

$myfinishday=$_REQUEST["myfinishday"];
}
if(isset($_REQUEST["index"])){
$index=$_REQUEST["index"];
}
//$_SESSION["index"]= $index; 
if(isset($vbudget_acti)){
$vbudget_acti=(int)$vbudget_acti;
}
if(isset($vbudget_approve)){
$vbudget_approve=(int)$vbudget_approve;
}
/* User  budget_list  */
/* -->
				if(isset($_REQUEST["idperson"])){
				$idperson=$_REQUEST["idperson"];
				}
				if(isset($_REQUEST["midcode"])){
				$midcode=$_REQUEST["midcode"];
				}
				
				if(isset($idperson) and isset($midcode)){
				$chkmidcode = $idperson."".$midcode;
				}
				
				if(isset($chkmidcode)){
				$len_myid=strlen($chkmidcode);
				}
			
			if(isset($len_myid)){	
				if ($len_myid==13)
				{
				$_SESSION["chkmidcode"]= $chkmidcode;
				$_SESSION["m9idperson"]= $idperson;
				$_SESSION["m4idperson"]= $midcode;
				}
			}	*/
/*  From  Budget54 
		if(isset($vcode_proj)){
			if ($vcode_proj!=""){
				$_SESSION["mcode_proj"]= $vcode_proj;
					$mcode_proj=$vcode_proj;}
		}	
		if(isset($vbudget_proj)){		
			if ($vbudget_proj!=""){
				$_SESSION["mbudget_proj"]= $vbudget_proj;}
		} */

/*   Global  Variable */	
if(isset($_SESSION["name_perm"])){
	$sname_perm=$_SESSION["name_perm"];
}	
if(isset($_SESSION["chkmidcode"])){
	$chkmidcode=$_SESSION["chkmidcode"];
}	
if(isset($_SESSION["mid_person"])){
	$mid_person=$_SESSION["mid_person"];
}	
if(isset($_SESSION["mpms_view"])){
	$mpms_view=$_SESSION["mpms_view"];
}	
if(isset($_SESSION["mpms_read"])){
	$mpms_read=$_SESSION["mpms_read"];
}	
if(isset($_SESSION["mpms_add"])){
	$mpms_add=$_SESSION["mpms_add"];
}	
if(isset($_SESSION["mpms_edit"])){
	$mpms_edit=$_SESSION["mpms_edit"];
}	
if(isset($_SESSION["mpms_dele"])){
	$mpms_dele=$_SESSION["mpms_dele"];
}	
if(isset($_SESSION["mpms_comm"])){
	$mpms_comm=$_SESSION["mpms_comm"];
}	
if(isset($_SESSION["mpms_moderate"])){
	$mpms_moderate=$_SESSION["mpms_moderate"];
}	
if(isset($_SESSION["mpms_admin"])){
	$mpms_admin=$_SESSION["mpms_admin"];
}
/*  From  $_REQUEST  */
if(isset($_SESSION["mcode_clus"])){
	$mcode_clus=$_SESSION["mcode_clus"];
}	
else{
$mcode_clus="";  //กำหนดค่าว่าง
}

if(isset($_SESSION["mname_clus"])){
    $mname_clus=$_SESSION["mname_clus"];
}	
if(isset($_SESSION["mcode_proj"])){
	$mcode_proj=$_SESSION["mcode_proj"];
}	
if(isset($_SESSION["mname_proj"])){
	$mname_proj=$_SESSION["mname_proj"];
}	
if(isset($_SESSION["mbudget_proj"])){
	$mbudget_proj=$_SESSION["mbudget_proj"];
}	
if(isset($_SESSION["mowner_proj"])){
	$mowner_proj=$_SESSION["mowner_proj"];
}	
if(isset($_SESSION["vcode_id"])){
	$vcode_id=$_SESSION["vcode_id"];
}	
if(isset($_SESSION["vname_sch"])){
	$vname_sch=$_SESSION["vname_sch"];
}	
if(isset($_SESSION["vname_allo"])){
	$vname_allo=$_SESSION["vname_allo"];
}	
if(isset($_SESSION["vbudget_allo"])){
	$vbudget_allo=$_SESSION["vbudget_allo"];
}	
/*  Check  Variable  $_REQUEST  */
//echo "$mcode_clus<BR>";
//echo "$mcode_proj<BR>";
//echo "$mname_proj<BR>authen";
//echo "$chkmidcode<BR>";
//echo "$mid_person<BR>";
?>