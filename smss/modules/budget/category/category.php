<script src="./ajax/framework.js"></script>
<script>
function ajaxCall() {
	var data = getFormData("frm1");
	var URL = "./modules/budget/category/ajax_type.php";
	ajaxLoad("get", URL, data, "displayAJAX");
}

function ajaxCall2() {
	var data = getFormData("frm1");
	var URL = "./modules/budget/category/ajax_type2.php";
	ajaxLoad("get", URL, data, "displayAJAX");
}


function removeOption() {
	var el = document.getElementById('pj_activity');
	while(el.length>0) {
		el.options[0] = null;
	}
}

function removeOption2() {
	var el = document.getElementById('item2');
	while(el.length>0) {
		el.options[0] = null;
	}
}


</script>

<Form id="frm1" name="frm1" Action="withdraw.php" Method="Post">
<?php
 include "./smss_connect.php";

echo "<Center>";
echo "<Font Size=4><B>เพิ่มข้อมูลการขอเบิกเงิน/ขอยืมเงิน</B></Font>";
echo "</Cener>";
echo "<Br><Br>";
echo "<Table   width=85% Border=0 Bgcolor=#Fcf9d8>";
echo "<Tr align='left'><Td width=20></Td><Td>เลขที่เอกสาร</Td><Td><Input Type=Text Name=doc Size=20></Td></Tr>";
echo "<Tr align='left'><Td ></Td><Td>รายการเบิก</Td><Td><Input Type=Text Name=item0 Size=60></Td></Tr>";


echo "<Tr align='left'><Td ></Td><Td>ประเภทงบประมาณ</Td>";

echo "<td><div align='left'><Select  name='category' id='category' size='1' onChange = 'ajaxCall()'>";
echo  "<option  value = ''>เลือก</option>" ;

$sql = "select  * from  budget_category  order by  category_id";
$dbquery = mysql_db_query($dbname, $sql);
While ($result = mysql_fetch_array($dbquery))
   {
$category_id = $result['category_id']; 
$category_name = $result['category_name'];
echo  "<option value = $category_id>$category_name</option>";
	}
echo "</select>";
echo "</div></td></tr>";

echo "<Tr align='left'><Td ></Td><Td>หมวด</Td><td>";
echo "<Select  name='pj_activity' id='pj_activity' size='1'  onChange = 'ajaxCall2()'>";
echo  "<option  value = ''>เลือก</option>" ;
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td ></Td><Td>รายการ</Td><td>";
echo "<Select  name='item2' id='item2' size='1' >";
echo  "<option  value = ''>เลือก</option>" ;
echo "</select>";
echo "</td></tr>";

echo "<Tr align='left'><Td ></Td><Td>จำนวนเงิน</Td><Td><Input Type='Text' Name='money' Size='10' onkeydown='digitOnly()'></Td></Tr>";
echo "<Br>";
echo "<Input Type=Hidden Name=index Value=1>";
echo "</Table>";
echo "<INPUT TYPE='button' name='smb' value='ตกลง' onclick='goto_url(1)' class=entrybutton>
		&nbsp;&nbsp;<INPUT TYPE='button' name='back' value='ย้อนกลับ' onclick='goto_url(0)' class=entrybutton'>";
echo "</Form>";

echo "<div id='displayAJAX'></div>";

?>



<script>
function goto_url(val){
	if(val==0){
		callfrm("?option=budget");   // page ย้อนกลับ 
	}else if(val==1){
		if(frm1.doc.value == ""){
			alert("กรุณากรอกเอกสาร");
		}else if(frm1.item0.value==""){
			alert("กรุณากรอกรายการเบิก");
		}else if(frm1.category.value == ""){
			alert("กรุณาเลือกประเภทงบประมาณ");
		}else if(frm1.pj_activity.value==""){
			alert("กรุณาเลือกหมวด");
		}else if(frm1.item2.value==""){
			alert("กรุณาเลือกรายการ");
		}else if(frm1.money.value==""){
			alert("กรุณากรอกจำนวนเงิน");	
		}else{
			callfrm("?option=budget&task=category/category");   //page ประมวลผล
		}
	}
}

</script>





