<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$UId              = trim($_SESSION['LID']);

if(isset($_GET["imageid"]) && $_GET["imageid"]!="")
{
	// select image name
	$image=db_query("Select PSG_Id, PSG_ImgPath FROM ".TABLE_PRODUCTSERVICEGALLERY." where PSG_Id='".$_GET["imageid"]."'") or die(db_error());
	if(db_num_rows($image)>0)
	{
		$image_row=db_fetch_array($image);
		$image_name=$image_row["PSG_ImgPath"];
		$check=db_query("Delete from ".TABLE_PRODUCTSERVICEGALLERY." where PSG_Id='".$_GET["imageid"]."'") or die(db_error());
		db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_MainFk='".$_GET["imageid"]."' AND SFS_Mode=7");

		if($check)
		{
			// remove from folder too
			@unlink($image_name);
			echo "ok";
		}
		else
		{
			echo "Oops, there is some problem";
		}
	}	
}


?>