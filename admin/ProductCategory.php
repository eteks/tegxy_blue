<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

include("include/BlModules/Bl_General.php");
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);


include("include/BlModules/Bl_ProductCategory.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".TABLE_PRODUCTCATEGORY." WHERE ProductCat_Pk='".$_REQUEST['id']."' ");
$Fetch=db_fetch_array($Select);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;
 ?>
<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Product Category</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" enctype="multipart/form-data" name="FrmProductCategory" id="FrmProductCategory" action="index.php" onsubmit="return ValidateProductCategory();" > 
<input type="hidden" value="<?php echo $Fetch['ProductCat_Pk']; ?>" id="ExistId" name="ExistId" />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;<span id="Req"><?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Product Category Name Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; } ?></span></span></td></tr>
<tr>
<td height="24" align="right">
<table border="0" cellspacing="2" cellpadding="2" width="100%">
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">* </span>Product Category Code</td>
<td height="24" align="center" class="feildstxt"><span id="feildstxt">:</span></td>
<td height="24" align="left">
<?php
$autoCode = getMaxId(TABLE_PRODUCTCATEGORY, 'ProductCat_Pk') + 1;
$autoCode = 'PC'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['ProductCat_code'] == '')
$autoCode = 'SER'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['ProductCat_code'];
?>
<input type="text" name="TxtProCategoryCode" id="TxtProCategoryCode" class="input"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>
</td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">* </span>Product Category</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left"><input name="TxtProCategoryName" type="text" id="TxtProCategoryName" autocomplete="off"  value="<?php echo $Fetch['ProductCat_Name']; ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" ></td>
</tr>

<tr>
<td height="24" align="right" class="feildstxt">Product Category Description</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left" colspan="5"><textarea name="TxtProCatDesc" id="TxtProCatDesc" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:300px;height:35px;"><?php echo $Fetch['ProductCat_Desc']; ?></textarea></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">

<input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  />

<input name="TxtGovtdeptcode" type="hidden" id="TxtGovtdeptcode" autocomplete="off" value="<?php echo $Fetch['ProductCat_code']; ?>"/><input type="hidden" id="formname" name="formname" value="GovtDeptForm" />
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="30" align="center">
<?php
$submitName = 'ProductCategory';
$fileName   = 'ProductCategory';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="FrmProductCategory" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" />
</td>
</tr>
</table>
</form>
</td>
</tr>
<script type="text/javascript" language="javascript">
var cursorpointer=document.getElementById('TxtProCategoryCode').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<td align="right"><span class="feildstxt">Category :</span><span id="FilterFieldList"><input type="hidden" name="SearchFilterFieldList" id="SearchFilterFieldList" value="Category" /></span><span id="FilterField"><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php $_REQUEST['SearchFilterField'] = (isset($_REQUEST['SearchFilterField']) ? $_REQUEST['SearchFilterField'] : ''); echo $_REQUEST['SearchFilterField']; ?>" class="input"/></span><span>&nbsp;&nbsp;<input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_ProductCategory');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div id="DetailList">
<?php
$_REQUEST['optid'] = (isset($_REQUEST['optid']) ? $_REQUEST['optid'] : '');
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.ProductCat_Pk, a.ProductCat_Code, a.ProductCat_Name, a.Status From ".TABLE_PRODUCTCATEGORY." a";
$orderBy = ' a.ProductCat_Pk ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');

if($_REQUEST['SearchFilterFieldList']=='Category')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where ProductCat_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
else
$WhereCont = ' where 1';
}

$gridHead = 'Product Category Details';
$colHead  = array("Sl.No.", "Product Category Code", "Product Category", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
