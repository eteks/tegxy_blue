<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$Image            = trim($_REQUEST['Imagee']);
$Desp             = trim(addslashes($_REQUEST['Desp']));
$From             = trim(ChangeDateforDB($_REQUEST['From']));
$To               = trim(ChangeDateforDB($_REQUEST['To']));
$ExistId          = trim($_REQUEST['ExistId']);
$UId              = trim($_SESSION['LID']);
$Action           = trim($_REQUEST['action']);
$Title            = trim($_REQUEST['Title']);
$Imagge           = filesize("../../".$Image);
if($Action=='1')
{
if($ExistId=='')
{
db_query("INSERT INTO ".TABLE_EVENTS." SET ET_UserFk='".$UId."',ET_Image='".$Image."',ET_Desp='".$Desp."',ET_Title='".$Title."',ET_From='".$From."', ET_To='".$To."',ET_CreatedOn=Now(),ET_ModifiedOn=Now() ");
$InsertId = db_insert_id();
if($Image!='')
db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='2',SFS_FileSize='".$Imagge."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");

echo 'Added Successfullly';
}
else
{
db_query("UPDATE ".TABLE_EVENTS." SET ET_Image='".$Image."',ET_Desp='".$Desp."',ET_Title='".$Title."',ET_From='".$From."', ET_To='".$To."',ET_ModifiedOn=Now() WHERE ET_Id='".$ExistId."'");
$InsertId = $ExistId;
if($Image!='')
{
$sqlCheck =db_query("SELECT * FROM ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND  SFS_Mode='2' AND SFS_Fk='".$InsertId."'");
if(db_num_rows($sqlCheck)>0)
db_query("UPDATE ".TABLE_STOREFILESIZE." SET SFS_FileSize='".$Imagge."' WHERE  SFS_UserFk='".$UId."' AND  SFS_Mode='2' AND SFS_Fk='".$InsertId."' ");
else
db_query("INSERT INTO ".TABLE_STOREFILESIZE." SET SFS_UserFk='".$UId."',SFS_Fk='".$InsertId."',SFS_Mode='2',SFS_FileSize='".$Imagge."',SFS_CreatedOn=NOw(),SFS_ModifiedOn=NOw() ");
}



echo 'Updated Successfullly';
}


}
if($Action=='2')
{
	
$ImgPath=db_query("Select ET_Image FROM ".TABLE_EVENTS." WHERE ET_Id='".$ExistId."'") or die(db_error());
$FetImgPath = db_fetch_array($ImgPath);
@unlink("../../".$FetImgPath['ET_Image']);	
db_query("DELETE FROM  ".TABLE_EVENTS." WHERE ET_Id='".$ExistId."'");
db_query("DELETE FROM  ".TABLE_STOREFILESIZE." WHERE SFS_UserFk='".$UId."' AND	SFS_Fk='".$ExistId."' AND SFS_Mode=2");
echo 'Deleted Successfullly';
}

if($Action=='3')
{
$Sql = db_query("SELECT ET_Id,ET_Image,ET_Desp,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE ET_Id='".$ExistId."'");
list($ET_Id,$ET_Image,$ET_Desp,$ET_From,$ET_To,$ET_Title) = db_fetch_array($Sql);
if($ET_Image!='')
$ET_Imagedisp= '<img src="'.$ET_Image.'" width="30" height="30" border="0" />&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolderDB('.$ET_Id.',\'EventsImageDisp\',\'EventsImage\',2);" >Delete</span>&nbsp;&nbsp;';
echo $ET_Id.'*##*'.$ET_Image.'*##*'.$ET_Imagedisp.'*##*'.stripslashes($ET_Desp).'*##*'.ChangeDateforShow($ET_From).'*##*'.ChangeDateforShow($ET_To).'*##*'.$ET_Title.'*##*';
}

$sqltot="SELECT ET_Id,ET_Image,ET_Desp,ET_From,ET_To,ET_Title FROM ".TABLE_EVENTS." WHERE  ET_UserFk='".$UId."' order by  ET_Id desc";
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
<td width="25%">Image</td>
<td width="25%">Title</td>
<td width="30%">Date of the Activities</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=$i;
while(list($ET_Id,$ET_Image,$ET_Desp,$ET_From,$ET_To,$ET_Title) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40" <?php if($ET_Id == $ExistId || $ET_Id == $InsertId) {?> style="font-weight:bold;" <?php }?>>
<td width="10%"><?php  echo $Pid;?></td>
<td width="25%"><img src="<?php echo $ET_Image;?>" width="30" height="30" border="0" /></td>
<td width="25%"><?php if(strlen(stripslashes($ET_Title))>25){ echo substr(stripslashes($ET_Title),0,50).'...' ;} else { echo stripslashes($ET_Title);} ?></td>
<td width="30%"><?php echo ChangeDateforShow($ET_From).StringLeftArrow(ChangeDateforShow($ET_To),' - ',3);?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="EventsEdit(<?php echo $ET_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="EventsDelete(<?php echo $ET_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>
<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageEvents'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="5" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"   height="25"><td colspan="5"></td></tr>
<?php }?>
</table>######<?php echo UserFileSize($UId);?>
