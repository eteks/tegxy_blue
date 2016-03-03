<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();


$UId=trim($_SESSION["LID"])!=""?trim($_SESSION["LID"]):session_id();
$proid=trim($_REQUEST["proid1"])!=""?trim($_REQUEST["proid1"]):'Pro1';
$result = process_image_upload('uploadfile','Document/InnerImages/','Document/InnerImages/WaterMarkInImg/',$UId);
if ($result) 
{
	$sql = "INSERT INTO ".TABLE_PRODUCTSERVICEGALLERY." set PSG_Mode=1, PSG_UserFk='".$UId."', PSG_ImgPath='".$result[0]."',PSG_PSFk='".$proid."'";
	$insert=db_query($sql) or die(db_error());
	$cc=db_insert_id();
db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$proid."',`SFS_MainFk` ='".$cc."',SFS_Mode='7',SFS_FileSize='".filesize($result[0])."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

	echo "success".$cc."###".$Thumbnail."###".UserFileSize($UId); 
} else {
	echo "error";
}
?>