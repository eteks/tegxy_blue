<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$UId=$_SESSION["LID"];

function UploadLogo($str1){
$image=$_FILES[$str1]['name'];
if($image)  
{
	$FileName = stripslashes($_FILES[$str1]['name']);
	$Fileextension = getExtension($FileName);
	$str2 = 'Document/Logo/';
	$str3=$UId;
	$Filesize=filesize($_FILES[$str1]['tmp_name']);
	$AlteredFilename=$str3.time().'.'.$Fileextension;
	$FilePath=$str2.$AlteredFilename;
	$FilePaths = createThumbnail($_FILES[$str1]['tmp_name'], $FilePath, 142, 160);
}
return 'Document/Logo/'.$FilePaths;
}
$result = UploadLogo('uploadfile');


if ($result) 
{
	
	$Check = db_query("SELECT LG_Id,LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk='".$UId."'");
	list($LG_Id,$LG_Logo) =db_fetch_array($Check);
	
	@unlink($LG_Logo);	
	db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_Fk ='".$LG_Id."'");
	
	if(db_num_rows($Check)>0)
	$sql = "UPDATE ".TABLE_LOGO." SET LG_Logo='".$result."',LG_ModifiedOn=NOW() WHERE LG_Id='".$LG_Id."'";
	else
	$sql = "INSERT INTO ".TABLE_LOGO." set  LG_UserFk='".$UId."', LG_Logo='".$result."',LG_CreatedOn=NOW(),LG_ModifiedOn=NOW()";
	$insert=db_query($sql) or die(db_error());
	$cc=db_insert_id();
	
	$Check2 = db_query("SELECT SFS_Id FROM ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND SFS_Fk='".$cc."' AND SFS_Mode='1'");
	list($SFS_Id) =db_fetch_array($Check);

	if(db_num_rows($Check2)>0)
	db_query("UPDATE ".TABLE_STOREFILESIZE." SET SFS_FileSize='".filesize($result)."' WHERE  SFS_Id='".$SFS_Id."' ");
	else
	db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$cc."',SFS_Mode='1',SFS_FileSize='".filesize($result)."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

	echo "success".$cc."###".$Thumbnail."###".UserFileSize($UId); 
} else {
	echo "error";
}
?>