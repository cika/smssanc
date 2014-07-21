<?php 
/** ensure this file is being included by a parent file */
defined( '_VALID_' ) or die( 'Direct Access to this location is not allowed.' );

echo "<form id='frm1' name='frm1'>";
echo "<br/>";
echo "<Center>";
echo "<Font color='#006666' Size=3><B>เพิ่ม แก้ไข สมาชิกกลุ่มบุคลากร</Font>";
echo "</Cener>";
echo "<br><br>";
echo "<TABLE width='100%'  boder='0' Bgcolor='#Fcf9d8'>";
echo "<Tr align='center'><Td align='center' >กลุ่มบุคลากร&nbsp;&nbsp;<select name='grp_id' size='1'>";
echo  "<option  value = ''>เลือก</option>" ;
$sql= "select * from mail_group order by grp_id desc";
	$dbquery=mysql_query($sql);
	While ($result = mysql_fetch_array($dbquery)){
	
	if($_POST['grp_id']==$result['grp_id'])
		$select="selected";
		else
		$select="";
		
	echo "<option value=$result[grp_id] $select>$result[grp_name]</option>";
	}
	echo "</select>" ;
echo "&nbsp;&nbsp;<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton></Td></Tr>";
echo "</TABLE>";

if($index==2){
	$sql= "select * from person_main where status='0' ";
	$dbquery = mysql_query($sql);
	While ($result = mysql_fetch_array($dbquery)){
	$person_id=$result['person_id'];
	$member_num=0;
		$sql2= "select * from mail_group_member where (grp_id = '$_POST[grp_id]') and (person_id = '$person_id')"; 
		$dbquery2=mysql_query($sql2);
		$member_num = mysql_num_rows($dbquery2);
		if($member_num<1){
				if(isset($_POST[$person_id])==1){
				$sql3="insert into mail_group_member(grp_id, person_id) values('$_POST[grp_id]','$person_id')";	
				mysql_query($sql3);
				}
		}
		if($member_num>=1){
				if(isset($_POST[$person_id])!=1){
				$sql4="delete from mail_group_member where (grp_id='$_POST[grp_id]') and (person_id = '$person_id')"; 
				mysql_query($sql4);
				}	
		}
	} //loop while
} //loopindex2

if($index==1 or $index==2){

	$sql= "select * from mail_group_member where grp_id = '$_POST[grp_id]'";
	$dbquery=mysql_query($sql);
	$i=1;
	While ($result = mysql_fetch_array($dbquery)){
	$p_id=$result['person_id'];
	$person_in_grp[$i]=$p_id;
	$i++;
	}
echo "<br/>";	
echo "<table width='75%' CELLSPACING=1 CELLPADDING=2>";
	echo "<tr bgcolor='#000000' height='30'>";
	echo "<td align='center' width='5%'><b><font color='#FFFFFF'>ที่</td>";
	echo "<td align='center' width='30%'><b><font color='#FFFFFF'>ชื่อ</td>";
	echo "<td align='center' width='40%'><b><font color='#FFFFFF'>ตำแหน่ง</td>";
	echo "<td align='center'><b><font color=#FFFFFF>เลือก</td>";
	echo "</tr>";
$sql = "select * from person_main left join person_position on person_main.position_code=person_position.position_code where person_main.status='0' order by person_main.position_code,person_main.person_order ";

	$dbquery = mysql_query($sql);
	$n=1;
	While ($result = mysql_fetch_array($dbquery)){
	$person_id= $result['person_id'];
	$prename = $result['prename'];
	$name = $result['name'];
	$surname = $result['surname'];
	$full_name=$prename.$name." ".$surname ;
	$position_name = $result['position_name'];
					if(($n%2)==0){
							if($index==2){
							$bgcolor="#FFFFB";
							}
							else{
							$bgcolor="#e8e8e8";
							}
					}else{
					$bgcolor="#F5F5F5";
					}
		echo "<tr bgcolor=$bgcolor>";
		echo "<td align=center>$n</td>";
		echo "<td align='left'>$full_name</td>";
		echo "<td align='left'>$position_name</td>";
		$check="";
		for($x=1;$x<$i;$x++){
			if($person_id==$person_in_grp[$x]){
			$check="checked";
			break;
			}
		}
		echo "<td><INPUT TYPE='checkbox' NAME='$person_id' $check value='1' ></td>";
		echo "</tr>";
	$n++;	
	}	
echo "</table>";
echo "<br/>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(2)'>";
echo "<br/>";
echo "<br/>";
}  //End index1
echo "<br/>";
echo "<br/>";
echo "</form>";
?>
<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=mail&task=main/group_member");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.grp_id.value == ""){
			alert("กรุณาเลือกกลุ่มบุคลากร");
		}else{
			callfrm("?option=mail&task=main/group_member&index=1");   //page ประมวลผล
		}
	}else if(val==2){
		callfrm("?option=mail&task=main/group_member&index=2");   //page ประมวลผล
	}
}

</script>
