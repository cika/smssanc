<?php
ob_start();
//include("../../../smss_connect.php");
require_once("dbconfig.inc.php");
$sql = "select * from  budget_year where year_active='1' order by budget_year desc limit 1";
//$dbquery = mysql_db_query($dbname, $sql);
$dbquery =DBfieldQuery($sql);
$year_active_result = mysql_fetch_array($dbquery);
$year_active_result=$year_active_result['budget_year'];
$category_id=$_GET['category_id'];

$js = "removeOption();";
$js .= "
		var opt = new Option('เลือก', '');
		document.getElementById('pj_activity').options[0] = opt;
	";
			$ppp="(";
			$bbb=")";
switch ($category_id)
{
	case "1";
$sql = "select  * from  budget_main  where  budget_main.budget_year='$year_active_result' and budget_main.status between '1' and '2' and budget_main.type_id<200 order by budget_main.id ";
				$i=1;
				$dbquery =DBfieldQuery($sql);
				While ($result = mysql_fetch_array($dbquery))
				 {
								$type_id= $result['doc'];
								$type_name= $result['operate_item'];
								$receive_amount= $result['receive_amount'];
						$js .= "
						var opt = new Option('$type_id $type_name $ppp $receive_amount $bbb ', '$type_id');
						document.getElementById('pj_activity').options[$i] = opt;
					";
				$i++;		
				}
				break;
	case "2";
$sql = "select * from  budget_receive  where   budget_receive.budget_year='$year_active_result'  order by budget_receive.id desc limit 50";
				$i=1;
				$dbquery =DBfieldQuery($sql);
				While ($result = mysql_fetch_array($dbquery))
				 {
								$type_id= $result['num'];
								$type_name= $result['item'];
								//$type_name =explode(" ",$type_name);
								//$type_name =$type_name[0].$type_name[1];
								$type_name = substr($type_name,0,130);
								$receive_amount= $result['money'];
						$js .= "
						var opt = new Option('$type_id $type_name $ppp $receive_amount $bbb ', '$type_id');
						document.getElementById('pj_activity').options[$i] = opt;
					";
				$i++;		
				}
				break;
	case "3";
$sql = "select  * from  budget_main  where  budget_main.budget_year='$year_active_result'  and budget_main.type_id>=300 and budget_main.type_id<400 order by budget_main.id ";
				$i=1;
				$dbquery =DBfieldQuery($sql);
				While ($result = mysql_fetch_array($dbquery))
				 {
								$type_id= $result['doc'];
								$type_name= $result['operate_item'];
								$receive_amount= $result['receive_amount'];
						$js .= "
						var opt = new Option('$type_id $type_name $ppp $receive_amount $bbb ', '$type_id');
						document.getElementById('pj_activity').options[$i] = opt;
					";
				$i++;		
				}
				break;
	case "4";
$sql = "select  * from  budget_bud  where   budget_bud.budget_year='$year_active_result' and receive_amount>0 order by budget_bud.id ";
				$i=1;
				$dbquery =DBfieldQuery($sql);
				While ($result = mysql_fetch_array($dbquery))
				 {
								$type_id= $result['doc'];
								$type_name= $result['item'];
								$receive_amount= $result['receive_amount'];
						$js .= "
						var opt = new Option('$type_id $type_name $ppp $receive_amount $bbb ', '$type_id');
						document.getElementById('pj_activity').options[$i] = opt;
					";
				$i++;		
				}
				break;

break;
}

header("Content-Type:text/javascript; charset=utf-8");
echo $js;
?>
