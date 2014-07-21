					<?php
						require_once("../dbconfig.inc.php"); 
						echo  '<option  style="background-color:wheat; color:maroon;"  value ="" >  # เลือกโรงเรียนที่ได้รับจัดสรรงบประมาณ</option>' ;
						$sql = "select  *  from  standard_basic_sd  order by standard_basic_sd.sd_id";
						$dbquery =DBfieldQuery($sql);
						While ($result = mysql_fetch_array($dbquery))
							{ 
						echo '<option style="background-color:wheat; color:maroon;" value="' . $result['sd_id'] .'|'. $result['sd_name'] . '">'. $result['sd_name'] . '</option>'; 
					}
					echo "</select>";
					?>