<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

	$str1 = addslashes($_POST['data']);
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
?>	   
