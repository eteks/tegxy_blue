<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	$str1 = addslashes($_POST['data']);
if($_REQUEST['action']=='1'){
	//if (trim($str1) != '') $str1 = trim($str1);
	//$Whecon = "WHERE `RGT_CompName` like '".$str1."%'";//AND
	//$sql    = "SELECT RGT_CompName,RGT_City,RGT_Area FROM `tbl_registration`   ".$Whecon." Order by RGT_CompName asc limit 0,5";
	//RGT_Status=1
	if (trim($str1) != '') $str1 = trim($str1);
	{
	$Whecon  = "WHERE `RGT_CompName` like '".$str1."%' AND RGT_Status='1' AND RGT_PaymentStatus='1'";//AND
	$Whecon1 = "WHERE `S_Name` like '".$str1."%' AND Status='1'";
	$Whecon2 = "WHERE `Kd_Keyword` like '".$str1."%' AND Kd_Status='1'";
	}
	//$sql = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon." UNION SELECT `S_Name` as search  ,'1' as RGT_City,'b' as RGT_Area ,'2' as type2 FROM `tbl_sector`  ".$Whecon1." UNION SELECT `Kd_Keyword` as search  ,'1' as RGT_City,'b' as RGT_Area ,'3' as type2 FROM `tbl_keywordmst`  ".$Whecon2."";
	// $sql = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon." UNION SELECT `S_Name` as search  ,'1' as RGT_City,'b' as RGT_Area ,'2' as type2 FROM `tbl_sector`  ".$Whecon1." UNION SELECT `Kd_Keyword` as search  ,'1' as RGT_City,'b' as RGT_Area ,'3' as type2 FROM `tbl_keywordmst`  ".$Whecon2."";
	$sql = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon." UNION SELECT `S_Name` as search  ,'1' as RGT_City,'b' as RGT_Area ,'2' as type2 FROM `tbl_sector`  ".$Whecon1."";
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
	// $Whecon = "Where `ProductName` like '".$str1."%'";
	// $sql    = "SELECT  ProductName FROM  ".TABLE_ADMINPRODUCT."  ".$Whecon." Order by ProductName asc limit 0,5";
	
	$Whecon = "Where `PS_Display` like '".$str1."%' AND PS_Status='1'";
	$sql    = "SELECT  PS_Display FROM  `tbl_productservice`  ".$Whecon." Order by PS_Display asc limit 0,5";
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{	
			$str = strtolower($row['PS_Display']);
			if($str1!=""){
				$start = strpos($str, $str1);
				$end = similar_text($str, $str1);
				$last = substr($str, $end, strlen($str));
				$first = substr($str, $start, $end);				
			} else {
				$first = "";
				// echo "$first", $first;
				$last = $str;
				// echo "$last", $last;
			}
				 
			$final = '<span class="bold">'.$first.'</span>'.$last;		
			echo '<li><a href=\'javascript:void(0);\'>'.$final.'</a></li>';
		 }
		echo "</ul>";
	}
	else
		echo 0;		
}
if($_REQUEST['action']=='3'){
	//if (trim($str1) != '') $str1 = trim($str1);
	//$Whecon = "WHERE `RGT_CompName` like '".$str1."%'";//AND
	//$sql    = "SELECT RGT_CompName,RGT_City,RGT_Area FROM `tbl_registration`   ".$Whecon." Order by RGT_CompName asc limit 0,5";
	//RGT_Status=1
	if (trim($str1) != '') $str1 = trim($str1);
	{
	$Whecon  = "WHERE `RGT_CompName` like '".$str1."%'";//AND
	$Whecon1 = "WHERE `S_Name` like '".$str1."%'";
	$Whecon2 = "WHERE `Kd_Keyword` like '".$str1."%'";
	}
	$sql    = "SELECT `RGT_CompName` as search, RGT_City,RGT_Area, '1' as type2 FROM `tbl_registration` ".$Whecon." UNION SELECT `S_Name` as search  ,'1' as RGT_City,'b' as RGT_Area ,'2' as type2 FROM `tbl_sector`  ".$Whecon1." UNION SELECT `Kd_Keyword` as search  ,'1' as RGT_City,'b' as RGT_Area ,'3' as type2 FROM `tbl_keywordmst`  ".$Whecon2."";

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
	$Whecon = "Where `ProductName` like '".$str1."%'";
	$sql    = "SELECT  ProductName FROM  ".TABLE_ADMINPRODUCT."  ".$Whecon." Order by ProductName asc limit 0,5";

	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{
			$str = strtolower($row['ProductName']);
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
