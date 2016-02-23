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
<tr>
<td>&nbsp;</td></tr>
<tr>
<td>
<div style="float:left;color:#fff;padding:0 0 0 10px;font-size: 15px;">Filter</div>
<div style="float:right;"><span style="color:#fff;font-size: 15px;">Search : </span>
<span id="companySearch"><input type="text" name="companySearchField" id="companySearchField" value="" class="input" /></span>
<span><input type="button" name="companySearchFilter" id="companySearchFilter" value="Search" onclick="searchCompBy('BusinessUser');" /></span></div></td></tr>
<tr>
<td>&nbsp;</td></tr>

<tr>
<td align="left" valign="top">
<?php $fileName   = 'BusinessUser'; ?>
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />

<div  id="DetailList">
<?php
$featuredcount=db_query("SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE RGT_Featured=0");
$countfeatured=db_num_rows($featuredcount);

$Password='Yes';
$optId = $_REQUEST['optid'];
$all_Sql = $all_Sql = "SELECT RGT_PK, RGT_CompName,RGT_UserName,RGT_Password,RGT_Status,RGT_PaymentStatus,RGT_Featured FROM ".TABLE_REGISTRATION." ";
$orderBy = ' RGT_PK ';
$WhereCont = ' where RGT_Type=2 ';
$gridHead = 'Business';
$colHead  = array("Sl.No.", "Company Name","User Name","Password","Status","Payment","Details","Featured","Comp");
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
