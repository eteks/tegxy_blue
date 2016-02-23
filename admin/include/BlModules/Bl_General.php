<?php 



function RoleName($Value1)
{
	$Selectquery=db_query("Select Role_Name FROM ".TABLE_ROLE." WHERE Id='".$Value1."'");
	$Countrows=@db_num_rows($Selectquery);
	if($Countrows>0)
	{
		$fetchrow = db_fetch_array($Selectquery);
		$Result = $fetchrow['Role_Name'];
	}
	else
	{
		$Result = '-';
	}
	return $Result;	
} 

function RoleTypeName($Value1)
{
	$Selectquery=db_query("Select Role_Type FROM ".TABLE_ADMINUSER." WHERE Id='".$Value1."'");
	$Countrows=@db_num_rows($Selectquery);
	if($Countrows>0)
	{
		$fetchrow = db_fetch_array($Selectquery);
		$Result = $fetchrow['Role_Type'];
	}
	else
	{
		$Result = '-';
	}
	return $Result;	
} 








?>