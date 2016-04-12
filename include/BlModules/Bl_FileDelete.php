<?php 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$UId   = trim($_SESSION['LID']);
// if($_REQUEST['action']==1)
// @unlink("../../".$_REQUEST['path']);	

if($_REQUEST['action']==1){
	// echo "action 1";
	// echo "Select LG_Id,LG_Logo FROM ".TABLE_LOGO." where LG_Id='".$_REQUEST['id']."'";
	// select image name
	$image=db_query("Select LG_Id,LG_Logo FROM ".TABLE_LOGO." where LG_Id='".$_REQUEST['id']."'") or die(db_error());
	if(db_num_rows($image)>0)
	{
		// echo "count",db_num_rows($image);
		$image_row=db_fetch_array($image);
		$image_name=$image_row["LG_Logo"];
		$check=db_query("Delete from ".TABLE_LOGO." where LG_Id='".$_REQUEST['id']."'") or die(db_error());
		db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$_REQUEST['id']."' AND SFS_Mode=1");

		if($check)
		{
			// remove from folder too
			@unlink($image_name);
			echo "ok DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$_REQUEST['id']."' AND SFS_Mode=1";
		}
		else
		{
			echo "Oops, there is some problem";
		}
	}	
}
	


if($_REQUEST['action']==2)
{
@unlink("../../".$_REQUEST['path']);


$Sql = db_query("SELECT ET_Image FROM ".TABLE_EVENTS." WHERE ET_Id='".$_REQUEST['id']."'");
$Path = db_fetch_array($Sql);
@unlink("../../".$Path['ET_Image']);
db_query("UPDATE ".TABLE_EVENTS." SET ET_Image='' WHERE ET_Id='".$_REQUEST['id']."'");
db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$_REQUEST['id']."' AND SFS_Mode=2");

echo '######21######'.UserFileSize($UId);
}

if($_REQUEST['action']==3 || $_REQUEST['action']==4)
{
$Sql = db_query("SELECT GY_Image FROM ".TABLE_GALLERY." WHERE GY_Id='".$_REQUEST['id']."'");
$Path = db_fetch_array($Sql);
@unlink("../../".$Path['GY_Image']);
db_query("UPDATE ".TABLE_GALLERY." SET GY_Image='' WHERE GY_Id='".$_REQUEST['id']."'");
db_query("DELETE FROM   ".TABLE_STOREFILESIZE."   WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$_REQUEST['id']."' AND SFS_Mode='".$_REQUEST['action']."'");

echo '######22######'.UserFileSize($UId);
}

if($_REQUEST['action']==5)
{
$Sql = db_query("SELECT PS_Brochure FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$_REQUEST['id']."'");
$Path = db_fetch_array($Sql);
@unlink("../../".$Path['PS_Brochure']);
db_query("UPDATE ".TABLE_PRODUCTSERVICE." SET PS_Brochure='' WHERE PS_Id='".$_REQUEST['id']."'");
db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$_REQUEST['id']."' AND SFS_Mode=5");

echo '######24######'.UserFileSize($UId);
}
if($_REQUEST['action']==6)
{
$Sql = db_query("SELECT PS_CoverImg FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$_REQUEST['id']."'");
$Path = db_fetch_array($Sql);
@unlink("../../".$Path['PS_CoverImg']);
db_query("UPDATE ".TABLE_PRODUCTSERVICE." SET PS_CoverImg='' WHERE PS_Id='".$_REQUEST['id']."'");
db_query("DELETE FROM ".TABLE_STOREFILESIZE."  WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$_REQUEST['id']."' AND SFS_Mode=6");

echo '######24######'.UserFileSize($UId);
}


?>