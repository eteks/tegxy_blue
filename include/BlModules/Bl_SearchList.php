<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	$str1 = addslashes($_POST['data']);
	// $strc = addslashes($_POST['city_act']);
 	$strc =  (isset($_POST['city_act']) ? $_POST['city_act'] : 1);
	if($_GET['action']=='1'){	
	if ($str1 != '')	
	{	
	$Whecon  = "WHERE RGT_CompName like '$str1%' AND RGT_Status = '1' AND RGT_PaymentStatus = '1' AND RGT_City=".$strc."";
	$Whecon1 = "WHERE S_Name like '".$str1."%'";
	$Whecon2 = "WHERE Kd_Keyword like '".$str1."%'";
	}
	// $sql    = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon." UNION SELECT `S_Name` as search  ,'1' as RGT_City,'b' as RGT_Area ,'2' as type2 FROM `tbl_sector`  ".$Whecon1." UNION SELECT `Kd_Keyword` as search  ,'1' as RGT_City,'b' as RGT_Area ,'3' as type2 FROM `tbl_keywordmst`  ".$Whecon2."";
	$sql  = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon."";
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{	
			$str = strtolower($row['search']);
			if($str1!=""){
				$start = strpos($str, $str1);
				$end = similar_text($str, $str1);
				$last = substr($str, $end, strlen($str));
				$first = substr($str, $start, $end);
			} else {
				$first = "";
				$last = $str;
			}
				 
			$final = '<span class="bold">'.$first.'</span>'.$last;

			echo '<li><a href=\'javascript:void(0);\'>'.$final.'<span style="display:none;">**'.$row['RGT_City'].'**'.CityName($row['RGT_City']).'**'.$row['RGT_Area'].'**'.AreaName($row['RGT_Area']).'**'.$row['type2'].'</span></a></li>';
		 }
		echo "</ul>";
	}
	else
		echo 0;
}
if($_REQUEST['action']=='2'){		
	if (trim($str1) != '') $str1 = trim($str1);
	$Whecon = "Where `PS_Display` like '".$str1."%' AND PS_Status='1'";
	// $sql    = "SELECT  ProductName FROM  ".TABLE_ADMINPRODUCT."  ".$Whecon." Order by ProductName asc limit 0,5";
	$sql    = "SELECT  PS_Display,RGT_City,RGT_Area FROM  ".tbl_productservice." as prods INNER JOIN `tbl_registration` as regs ON regs.RGT_PK=prods.PS_User_Fk ".$Whecon." AND RGT_City=".$strc." Order by PS_Display asc limit 0,5";
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{	
			// $str = strtolower($row['ProductName']);
			$str = strtolower($row['PS_Display']);
			if($str1!=""){
				$start = strpos($str, $str1);
				$end = similar_text($str, $str1);
				$last = substr($str, $end, strlen($str));
				$first = substr($str, $start, $end);
			} else {
				$first = "";
				$last = $str;
			}
				 
			$final = '<span class="bold">'.$first.'</span>'.$last;

			// echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
			echo '<li><a href=\'javascript:void(0);\'>'.$final.'<span style="display:none;">**'.$row['RGT_City'].'**'.CityName($row['RGT_City']).'**'.$row['RGT_Area'].'**'.AreaName($row['RGT_Area']).'**'.$row['type2'].'</span></a></li>';
			
		 }
		echo "</ul>";
	}
	else
		echo '<div style="text-align:left;font-family:verdana;font-size:11px;width:498px;padding:2px 4px;" class="no_matches">Sorry! No such item found</div>';	
}
if($_REQUEST['action']=='3'){	
	if ($str1 != '')
	{	
	$Whecon  = "WHERE `RGT_CompName` like '".$str1."%' AND RGT_Status = '1' AND RGT_PaymentStatus = '1' AND RGT_City=".$strc."";
	$Whecon1 = "WHERE `S_Name` like '".$str1."%'";
	$Whecon2 = "WHERE `Kd_Keyword` like '".$str1."%'";
	}
	$sql    = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon."";
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{
			$str = strtolower($row['search']);
			if($str1!=""){
				$start = strpos($str, $str1);
				$end = similar_text($str, $str1);
				$last = substr($str, $end, strlen($str));
				$first = substr($str, $start, $end);
			} else {
				$first = "";
				$last = $str;
			}

			$final = '<span class="bold">'.$first.'</span>'.$last;

			echo '<li><a>'.$final.'</a></li>';
		 }
		echo "</ul>";
	}
	else
		echo 0;
}
if($_REQUEST['action']=='4'){
	if (trim($str1) != '') $str1 = trim($str1);
	$Whecon = "Where `Ps_Display` like '".$str1."%' AND PS_Status='1'";
	$sql    = "SELECT  Ps_Display FROM  ".tbl_productservice." as product INNER JOIN `tbl_registration` as register ON register.RGT_PK=product.PS_User_Fk ".$Whecon." AND RGT_City=".$strc." Order by Ps_Display asc limit 0,5";
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{
			$str = strtolower($row['Ps_Display']);
			if($str1!=""){
				$start = strpos($str, $str1);
				$end = similar_text($str, $str1);
				$last = substr($str, $end, strlen($str));
				$first = substr($str, $start, $end);
			} else {
				$first = "";
				$last = $str;
			}

			$final = '<span class="bold">'.$first.'</span>'.$last;

			echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
		 }
		echo "</ul>";
	}
	else
		echo 0;
}
?>	   
