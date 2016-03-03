<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$LID = trim($_REQUEST['LogIdd']);

if(isset($_POST['lastmsg']))
$lastmsg=$_POST['lastmsg'];



$sqltot="SELECT GY_Id,GY_Image,GY_Desp,GY_Title FROM ".TABLE_GALLERY." WHERE ((GY_Type=0) || (GY_Type=1 AND GY_Type2=0)) AND   GY_UserFk='".$LID."' AND GY_Id<'$lastmsg'  order by  GY_Id DESC LIMIT 12";
$SqlRun=db_query($sqltot);

/*$sqltot="SELECT GY_Id,GY_Image,GY_Desp,GY_Title FROM ".TABLE_GALLERY." WHERE  GY_UserFk='".$LID."' order by  GY_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=16;
$noofpages=$totalrecord/$pagesize;

if (!isset($_REQUEST['startdata']) || trim($_REQUEST['startdata'])=='' || trim($_REQUEST['startdata'])=='0')
$startdata=0;
else
$startdata=$_REQUEST['startdata'];
$count=$startdata;
if($_REQUEST["startdata"]=="0")
{	$i=1;	}
elseif($_REQUEST["startdata"]!="0")
{ 	$i=$_REQUEST["startdata"]+1; }
else
{ 	$i=1; 	}	
	
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");*/
$Count = db_num_rows($SqlRun);
if($Count>0){
$Pid=0;
?>
<table cellpadding="10" cellspacing="0" border="0" style="border-collapse:collapse;">
<tr>
<?php while(list($GY_Id,$GY_Image,$GY_Desp,$GY_Title) = db_fetch_array($SqlRun)){
$msg_id=$GY_Id;
?>
<td>
<a href="<?php echo $GY_Image;?>" class="highslide" onclick="return hs.expand(this)" style="text-decoration:none;color:#136578;">
<div style="width:150px;min-height:180px;height:auto;border:1px solid #c3c3c3;">
<div style="border:3px solid #F3F3F3;"><img  width="144" height="144" src="<?php echo $GY_Image;?>" /></div>
<div style="width:150px;min-height:20px;height:auto;background:#DBDBDB;text-align:center;padding:5px 0px;"><?php if(strlen(stripslashes($GY_Title))>10){ echo substr(stripslashes($GY_Title),0,20).'...' ;} else { echo stripslashes($GY_Title);} ?></div>
</div>
<div style="width:142px;height:5px;margin-left:auto;margin-right:auto;background:url(images/gallery_box-shadow.png) no-repeat;"></div>

</a>
<div class="highslide-caption"><?php echo $GY_Desp;?></div>

</td>
<?php $Pid++;  if($Pid%4==0){?></tr><tr><?php }}?>
</table>
<?php /*?><table cellpadding="0" cellspacing="0" border="0" align="right">
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'GalaryViewPage'); ?></td></tr>
</table>
<?php */
if($Count>11){?>
<div onclick="ViewMoree('more<?php echo $msg_id; ?>','<?php echo $msg_id; ?>','GalleryGrid','Bl_GalleryView','pass')" id="more<?php echo $msg_id; ?>" class="viewmoree">
View More
</div><div style="height:10px""></div>
<?php } }?>
