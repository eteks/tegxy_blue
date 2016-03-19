<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

include("include/BlModules/Bl_General.php");
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

// include("include/BlModules/Bl_Productlist.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".tbl_advertisement);
$Fetch=db_fetch_array($Select);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;
if($_REQUEST['action']=='edit')
	$ValidCheckSql ="Select * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Product_fk='".$_REQUEST['id']."'";
else
	$ValidCheckSql ="Select * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Ses_Id='".session_id()."'";
$ValidCheckRel=db_query($ValidCheckSql);
$CountValidRel=db_num_rows($ValidCheckRel);
$fileName   = 'Advertisement';
?>
<div id="ScrollText" style="overflow:auto;">
<input type="hidden" id="SearchFilterFieldList" name="SearchFilterFieldList" value="" />
<input type="hidden" id="SearchFilterField" name="SearchFilterField" value="" />
<input type="hidden" id="formname" name="formname" value="FrmProductList" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" />
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<!-- <table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Product List</td>
</tr>
</table> -->
</td>
</tr>
<script type="text/javascript" language="javascript">
var cursorpointer=document.getElementById('Selpcat').focus();
</script>

<tr>
<td align="left" valign="top">
<div id="DetailList">
<?php $_REQUEST['optid'] = (isset($_REQUEST['optid']) ? $_REQUEST['optid'] : '');
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.ADV_Id, a.ADV_Name, a.ADV_Status From ".tbl_advertisement." a ";
$orderBy = ' a.ADV_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ADV_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$Verified='A';
$gridHead = 'Product List Details';
$colHead  = array("Sl.No.",'', "Advertisement Name",'',"Status");
include_once('three_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>