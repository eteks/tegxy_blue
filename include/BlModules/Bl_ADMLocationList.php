<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	$str1 = addslashes($_POST['data']);
	if (trim($str1) != '') $str1 = trim($str1);
	$Whecon ="AND `Country_Name` like '".$str1."%'";
	$sql = "select distinct `Country_Name`,Id from ".TABLE_GENERALCOUNTRYMASTER." where `Status` = '1' ".$Whecon."  order by `Country_Name` asc limit 0,10";
	
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{	
		
		$LocRel = db_query('SELECT PM_Country,PM_State,PM_City,PM_Area,PM_Id FROM '.TABLE_PINCODEMASTER.' a , '.TABLE_GENERALCOUNTRYMASTER.' b  WHERE a.PM_Country = b.Id AND b.Country_Name LIKE "%'.$row['Country_Name'].'%" ');
		$FetLocRel = db_fetch_array($LocRel);
			$str = strtolower($row['Country_Name']);
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

			echo '<li><a href=\'javascript:void(0);\'>'.$final.'<span style="display:none;">**'.StateName($FetLocRel['PM_State']).StringLeftArrow(CityName($FetLocRel['PM_City']),' >> ',4).StringLeftArrow(AreaName($FetLocRel['PM_Area']),' >> ',4).StringLeftArrow(PincodeName($FetLocRel['PM_Id']),' - ',4).'**'.$FetLocRel['PM_State'].StringLeftArrow($FetLocRel['PM_City'],' >> ',4).StringLeftArrow($FetLocRel['PM_Area'],' >> ',4).StringLeftArrow($FetLocRel['PM_Id'],' >> ',4).'**'.$row['Id'].'</a></li>';
		 }
		echo "</ul>";
	}
	else
		echo 0;
?>	   
