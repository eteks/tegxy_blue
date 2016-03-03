<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$UId=$_SESSION["LID"];
$SelectSlot= db_query("SELECT LG_Id,LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk='".$UId."'");
$FetchSlot=db_fetch_array($SelectSlot)?>
<a href="javascript:void(0)" onClick="deleteLogo('<?php echo $FetchSlot['LG_Id']; ?>','UploadLogoList');"><img src="<?php echo $FetchSlot['LG_Logo']; ?>" height="200"  width="200" style="margin:5px;" /></a><?php 
$NumSlotct=db_num_rows($SelectSlot);
if($NumSlotct>0)
echo '<em><span class="alertmsg">Click on the image to delete</span></em>';


