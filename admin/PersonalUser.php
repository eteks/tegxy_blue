<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");
$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);?>

<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">  
<tr>
<td align="left" valign="top">
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<?php $fileName   = 'PersonalUser'; ?>
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />

<div  id="DetailList">
<?php 
$Password='Yes';
$optId = $_REQUEST['optid'];
$all_Sql = $all_Sql = "SELECT RGT_PK, RGT_Name,RGT_UserName,RGT_Password,RGT_Status FROM ".TABLE_REGISTRATION." ";
$orderBy = ' RGT_PK ';
$WhereCont = ' where RGT_Type=1 ';
$gridHead = 'Personal';
$colHead  = array("Sl.No.", "Name","User Name","Password","Status","","","Details");
include_once('Nm_seven_col_grid.php');

?>
</div>
</td>
</tr>
</table>
</table></td>
</tr>
</table>
</div>
