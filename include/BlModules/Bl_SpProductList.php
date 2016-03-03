<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	$str1 = addslashes($_POST['data']);
	if (trim($str1) != '') $str1 = trim($str1);
	$Whecon ="AND `ProdSpecification` like '".$str1."%'";
	$sql = "select distinct ProdSpec_Id,`ProdSpecification` from ".TABLE_PRODUCTSPECIFICATION." where `ProdStatus` = '1' ".$Whecon."  order by `ProdSpecification` asc limit 0,5";
	
	$result = db_query($sql) or die(db_error());
	if(db_num_rows($result))
	{		
		echo '<ul class="list">';
		while($row = db_fetch_array($result))
		{	
		
			$str = strtolower($row['ProdSpecification']);
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

			echo '<li><a href=\'javascript:void(0);\'>'.$final.'<span style="display:none;">**'.$row['ProdSpec_Id'].'</a></li>';
		 }
		echo "</ul>";
	}
	else
		echo 0;
?>	   
