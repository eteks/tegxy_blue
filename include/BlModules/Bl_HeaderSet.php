<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$Image            = trim($_REQUEST['Imagee']);
$Type             = trim($_REQUEST['Type']);
$Type2            = 1;
$ExistId          = trim($_REQUEST['ExistId']);
$UId              = trim($_SESSION['LID']);
$Action           = trim($_REQUEST['action']);
$Imagee = filesize("../../".$Image);

if($Action=='1')
{
if($ExistId=='')
{
db_query("INSERT INTO ".TABLE_GALLERY." SET GY_UserFk='".$UId."',GY_Image='".$Image."',GY_Type='".$Type."',GY_Type2='".$Type2."',GY_CreatedOn=Now(),GY_ModifiedOn=Now() ");
$InsertId = db_insert_id();
db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='4',SFS_FileSize='".$Imagee."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

echo 'Added Successfullly';
}
else
{
db_query("UPDATE ".TABLE_GALLERY." SET GY_Image='".$Image."',GY_Type='".$Type."',GY_Type2='".$Type2."',GY_ModifiedOn=Now() WHERE GY_Id='".$ExistId."'");
$InsertId = $ExistId;
db_query("UPDATE ".TABLE_STOREFILESIZE." SET SFS_FileSize='".$Imagee."' WHERE  SFS_UserFk='".$UId."' AND  SFS_Mode='4' AND SFS_Fk='".$InsertId."' ");

echo 'Updated Successfullly';
}


}
if($Action=='2')
{
	
$ImgPath=db_query("Select GY_Image FROM ".TABLE_GALLERY." WHERE GY_Id='".$ExistId."'") or die(db_error());
$FetImgPath = db_fetch_array($ImgPath);
@unlink("../../".$FetImgPath['GY_Image']);	
db_query("DELETE FROM  ".TABLE_GALLERY." WHERE GY_Id='".$ExistId."'");
db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$ExistId."' AND SFS_Mode=4");

echo 'Deleted Successfullly';
}

if($Action=='3')
{
$Sql = db_query("SELECT GY_Id,GY_Image,GY_Desp,GY_Type FROM ".TABLE_GALLERY." WHERE GY_Id='".$ExistId."'");
list($GY_Id,$GY_Image,$GY_Desp,$GY_Type) = db_fetch_array($Sql);
if($GY_Image!='')
$GY_Imagedisp= '<img src="'.$GY_Image.'" width="30" height="30" border="0" />&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolderDB('.$GY_Id.',\'HeadSetImageDisp\',\'HeadSetImage\',4);" >Delete</span>&nbsp;&nbsp;';

echo $GY_Id.'*##*'.$GY_Image.'*##*'.$GY_Imagedisp.'*##*'.$GY_Desp.'*##*'.$GY_Type.'*##*';
}

$sqltot="SELECT GY_Id,GY_Image,GY_Desp,GY_Type FROM ".TABLE_GALLERY." WHERE ((GY_Type2=1) || (GY_Type=0 AND GY_Type2=1))  AND GY_UserFk='".$UId."' order by  GY_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=5;
$noofpages=$totalrecord/$pagesize;

if (!isset($_REQUEST['startdata']) || trim($_REQUEST['startdata'])=='' || trim($_REQUEST['startdata'])=='0')
$startdata=0;
else
$startdata=$_REQUEST['startdata'];

if(isset($_REQUEST['Count']) && $_REQUEST['Count']==1 && $startdata > 0){
	$startdata = $_REQUEST['startdata']-$pagesize;
	$i=$_REQUEST["startdata"]-($pagesize-1); 
}
else if(isset($_REQUEST['Count']) && $_REQUEST['Count']==1 && $startdata==0){
	$startdata = $_REQUEST['startdata'];
	$i=1;
}

else if($_REQUEST["startdata"]=="0")
	$i=1;	
elseif($_REQUEST["startdata"]!="0")
	$i=$_REQUEST["startdata"]+1; 
else
	$i=1; 	
	
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);?>
######<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="10%">S.No.</td>
<td width="80%">Image</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=$i;
while(list($GY_Id,$GY_Image,$GY_Desp,$GY_Type) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40" <?php if($GY_Id == $ExistId || $GY_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="10%"><?php  echo $Pid;?></td>
<td width="80%"><img src="<?php echo $GY_Image;?>" width="30" height="30" border="0" /></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="HeadSetEdit(<?php echo $GY_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="HeadSetDelete(<?php echo $GY_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>,<?php echo $GY_Type ;?>);" title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageHeadSet'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="5" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"   height="25"><td colspan="5"></td></tr>
<?php }?>
</table>######<?php echo UserFileSize($UId);?>
