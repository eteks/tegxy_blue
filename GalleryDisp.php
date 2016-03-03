<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$UId=trim($_SESSION["LID"])!=""?trim($_SESSION["LID"]):session_id();
$proid=trim($_GET["proid"])!=""?trim($_GET["proid"]):'Pro1';


$sql = "Select PSG_Id,PSG_ImgPath,PSG_PSFk,PSG_Mode FROM ".TABLE_PRODUCTSERVICEGALLERY." WHERE PSG_UserFk='".$UId."' and PSG_PSFk='".$proid."'";

$SelectSlot=db_query($sql);
if($_GET['count']=='filecount')
echo $NumSlot=db_num_rows($SelectSlot);
else
{
while($FetchSlot=db_fetch_array($SelectSlot))
{
if($FetchSlot["PSG_Mode"]==1)
$Idd = 'PGalleryList';
else
$Idd = 'SGalleryList';
	
?>
<a href="javascript:void(0)" onClick="deleteGallery('<?php echo $FetchSlot['PSG_Id']; ?>','<?php echo $FetchSlot['PSG_PSFk']; ?>','<?php echo $Idd;?>');"><img src="<?php echo $FetchSlot['PSG_ImgPath']; ?>" height="30"  width="30" style="margin:5px;" /></a><?php 
}
$NumSlotct=db_num_rows($SelectSlot);
if($NumSlotct>0)
echo '<em><span class="alertmsg">Click on the image to delete</span></em>';
}?>

