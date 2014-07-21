<?php 
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

echo "<form id='frm1' name='frm1'>";
echo "<br/>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>กลุ่มบุคลากร และสมาชิกกลุ่ม (Read only)</Font>";
echo "</Cener>";
echo "<br><br>";
echo "<TABLE width='100%'  boder='0' Bgcolor='#Fcf9d8'>";
echo "<Tr align='center'><Td align='center' >กลุ่มบุคลากร&nbsp;&nbsp;<select name='grp_id' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql= "select * from mail_group order by grp_id desc";
	$dbquery=mysql_query($sql);
	While ($result = mysql_fetch_array($dbquery)){
	
	if(isset($_POST['grp_id'])==$result['grp_id'])
		$select="selected";
		else
		$select="";
		
	echo "<option value=$result[grp_id] $select>$result[grp_name]</option>";
	}
	echo "</select>" ;
echo "&nbsp;&nbsp;<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton></Td></Tr>";
echo "</TABLE>";


if($index==1){
	$sql= "select * from person_position ";
	$dbquery=mysql_query($sql);
	While ($result = mysql_fetch_array($dbquery)){
	$position_code=$result['position_code'];
	$position_name=$result['position_name'];
	$position_ar[$position_code]=$position_name;
	}
echo "<br/>";	
echo "<table width='65%' CELLSPACING=1 CELLPADDING=2>";
	echo "<tr bgcolor='#000000' height='30'>";
	echo "<td align='center' width='5%'><b><font color='#FFFFFF'>ที่</td>";
	echo "<td align='center' width='30%'><b><font color='#FFFFFF'>ชื่อ</td>";
	echo "<td align='center' width='40%'><b><font color='#FFFFFF'>ตำแหน่ง</td>";
	echo "</tr>";
$sql = "select * from mail_group_member left join person_main on mail_group_member.person_id=person_main.person_id  where mail_group_member.grp_id='$_POST[grp_id]' order by person_main.position_code,person_main.person_order ";

	$dbquery = mysql_query($sql);
	$n=1;
	While ($result = mysql_fetch_array($dbquery)){
	$person_id= $result['person_id'];
	$prename = $result['prename'];
	$name = $result['name'];
	$surname = $result['surname'];
	$post = $result['position_code'];
	$full_name=$prename.$name." ".$surname ;
					if(($n%2)==0){
						$bgcolor="#e8e8e8";
					}else{
						$bgcolor="#F5F5F5";
					}
		echo "<tr bgcolor=$bgcolor>";
		echo "<td align=center>$n</td>";
		echo "<td align='left'>$full_name</td>";
		echo "<td align='left'>$position_ar[$post]</td>";
		echo "</tr>";
	$n++;	
	}	
echo "</table>";
}  //End index1
echo "<br/>";
echo "<br/>";
echo "</form>";
?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=mail&task=main/group_member_report");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.grp_id.value == ""){
			alert("กรุณาเลือกกลุ่มบุคลากร");
		}else{
			callfrm("?option=mail&task=main/group_member_report&index=1");   //page ประมวลผล
		}
	}
}

</script>
