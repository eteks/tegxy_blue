<?php
include("include/Configuration.php");
include("include/DatabaseConnection.php");
db_connect();

	if(isset($_GET['city_check'])){
		$str1 = addslashes($_POST['Clearkey']);		
		if ($str1 != ''){	
			$Whecon  = "WHERE RGT_CompName like '$str1%' AND RGT_Status = '1' AND RGT_PaymentStatus = '1' AND RGT_City='".$_POST['Clearcity']."'";
		}
		$sql  = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon."";
	 	$select=mysql_query($sql);
	  	$row = mysql_fetch_assoc($select);
	  	if (mysql_num_rows($select) > 0) {
	      echo "exist";
	      
	  	}else { echo 'notexist'; }
	}

?>