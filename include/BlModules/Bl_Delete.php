<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();


$UId                 = trim($_SESSION['LID']);
$Action              = trim($_SESSION['action']);

if($_REQUEST['action']==1)
{
$InImgPath=db_query("Select PSG_ImgPath FROM ".TABLE_PRODUCTSERVICEGALLERY." where PSG_UserFk='".$UId."' AND PSG_PSFk='Pro1'") or die(db_error());
while($InFetImgPath = db_fetch_array($InImgPath))
{
@unlink("../../".$InFetImgPath['PSG_ImgPath']);	
}	
db_query("DELETE FROM ".TABLE_PRODUCTSERVICEGALLERY." WHERE PSG_UserFk ='".$UId."' AND PSG_PSFk='Pro1'");
db_query("DELETE FROM ".TABLE_SPECIFICATION." WHERE SP_UserFk='".$UId."' AND  (SP_PsFk='Pro1' || SP_PsFk='Ser1')");
//db_query("DELETE FROM ".TABLE_LOCATION." WHERE PSG_UserFk='".$UId."' AND PSG_PSFk='Pro1'");

}

