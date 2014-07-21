<?php
	defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );
	if($_SESSION['admin_plan']!="plan"){
	?><script>
			alert("คุณไม่มีสิทธิ์");
		</script><?php die( 'Direct Access to this location is not allowed.  ให้เฉพาะผู้บริหาร module ' );
	}
	$vid_person=$_REQUEST["vid_person"];
	$vname_perm=$_REQUEST["vname_perm"];
	
$vperm_view=0;
$vperm_read=0;
$vperm_add=0; 
$vperm_edit=0;	
$vperm_dele=0;
$vcomment=0;  
$vmoderate=0; 
$vadmin=0;
    
if(isset($_REQUEST["vperm_view"])){	
		if ($_REQUEST["vperm_view"]=='on')
			$vperm_view=1;
}	
if(isset($_REQUEST["vperm_read"])){
		if ($_REQUEST["vperm_read"]=='on')
			$vperm_read=1;
}	
if(isset($_REQUEST["vperm_add"])){
		if ($_REQUEST["vperm_add"]=='on')
			$vperm_add=1;
}	
if(isset($_REQUEST["vperm_edit"])){
		if ($_REQUEST["vperm_edit"]=='on')
			$vperm_edit=1;
}	
if(isset($_REQUEST["vperm_dele"])){
		if ($_REQUEST["vperm_dele"]=='on')
			$vperm_dele=1;
}	
if(isset($_REQUEST["vcomment"])){
		if ($_REQUEST["vcomment"]=='on')
			$vcomment=1;
}	
if(isset($_REQUEST["vmoderate"])){
		if ($_REQUEST["vmoderate"]=='on')
			$vmoderate=1;
}	
if(isset($_REQUEST["vadmin"])){
		if ($_REQUEST["vadmin"]=='on')
			$vadmin=1;
}	
if(isset($vid_person)){
		$vpassword_new=substr($vid_person,-4,4);
}


require_once("dbconfig.inc.php");

$sql = "SELECT *  FROM  plan_permission where id_person='$vid_person'"; 
$dbquery =DBfieldQuery($sql);
$num_rows = mysql_num_rows($dbquery);

if($num_rows>=1){
$sql="update plan_permission set  perm_add='$vperm_add', perm_edit='$vperm_edit', perm_dele='$vperm_dele' where id_person='$vid_person'";
$dbquery =DBfieldQuery($sql);
}
else{
$sql = "insert into plan_permission (id_person,name_perm,password_new,password_old,perm_view,perm_read,perm_add,perm_edit,perm_dele,comment,moderate,admin,id_defalt) values ('$vid_person','$vname_perm','$vpassword_new','$vpassword_new','$vperm_view','$vperm_read','$vperm_add','$vperm_edit','$vperm_dele','$vcomment','$vmoderate','$vadmin','$vid_person')";
$dbquery  =  DBfieldQuery($sql);
}

?>
<Form id='user_form' name='frm1'>
</Form>
<script>
	callfrm("?option=plan&task=planproject/plan_setuser"); 
</script>