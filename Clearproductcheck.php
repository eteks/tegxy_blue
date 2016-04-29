<?php
include("include/Configuration.php");
include("include/DatabaseConnection.php");
db_connect();

	if(isset($_GET['product_check'])){
		$str1 = addslashes($_POST['Clearproduct']);		
		if ($str1 != ''){	
			$Whecon = "Where `PS_Display` like '".$str1."%' AND PS_Status='1'";
		}
		$sql  = "SELECT  PS_Display FROM  ".tbl_productservice." as prods INNER JOIN `tbl_registration` as regs ON regs.RGT_PK=prods.PS_User_Fk ".$Whecon." AND RGT_City='".$_POST['Clearcity']."' Order by PS_Display asc limit 0,5";
	 	$select=mysql_query($sql);
	  	$row = mysql_fetch_assoc($select);
	  	if (mysql_num_rows($select) > 0) {
	      echo "exist";	      
	  	}else { echo 'notexist'; }
	}

?>