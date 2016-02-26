<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

include("include/BlModules/Bl_General.php");
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

include("include/BlModules/Bl_ProductSubCategory.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".TABLE_PRODUCTSUBCATEGORY." WHERE ProductSubCat_Pk='".$_REQUEST['id']."' ");
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
<td align="left" valign="top" class="title">Product Sub Category</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" enctype="multipart/form-data" name="FrmProSubCategory" id="FrmProSubCategory" action="index.php" onsubmit="return ValidateProductSubCategory();"> 
<input type="hidden" value="<?php echo $Fetch['ProductSubCat_Pk']; ?>" id="ExistId" name="ExistId" />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;<span id="Req"><?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Sub Category Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; } ?></span></span></td></tr>
<tr>
<td height="24" align="right">
<table border="0" cellspacing="2" cellpadding="2" width="100%">
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">*</span>Product Category</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left"><?php 
if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' )
{  ?>
<select id="Selpcat" name="Selpcat" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  >
<option value="" selected="selected">--Select Product Category--</option>
<?php 
$SelectCategory=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE Status='1'"); 
while($FetchCat=db_fetch_array($SelectCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductCat_Pk']; ?>" <?php if($FetchCat['ProductCat_Pk']==$Fetch['ProductCat_Fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ProductCat_Name']; ?></option>
<?php 
}?>
</select>
<?php 
} else { ?>
<select id="Selpcat" name="Selpcat" class="dropdown"  >
<option value="" selected="selected">--Select Product Category--</option>
<?php 
$SelectCategory=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE Status='1'"); 
while($FetchCat=db_fetch_array($SelectCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductCat_Pk']; ?>" ><?php echo $FetchCat['ProductCat_Name']; ?></option>
<?php 
}?>
</select>
<?php } ?>
</td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">*</span>Product Sub Category Code</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">
<?php
$autoCode = getMaxId(TABLE_PRODUCTSUBCATEGORY, 'ProductSubCat_Pk') + 1;
$autoCode = 'PROSC'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['ProductSubCat_code'] == '')
$autoCode = 'PROSC'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['ProductSubCat_code'];
?>
<input type="text" name="TxtSubCatCode" id="TxtSubCatCode" class="input"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>
</td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">*</span>Product Sub Category</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">
<input name="TxtPsubcat" type="text" id="TxtPsubcat" autocomplete="off"  value="<?php echo $Fetch['ProductSubCat_Name']; ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" />
</td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt">Product Sub Category Description</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left" colspan="5"><textarea name="TxtDesc" id="TxtDesc" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" style="width:300px;height:35px;"><?php echo $Fetch['ProductSubCat_Desc']; ?></textarea></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> />
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="30" align="center">
<?php
$submitName = 'ProductSubCategory';
$fileName   = 'ProductSubCategory';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="FrmProSubCategory" />
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
var cursorpointer=document.getElementById('Selpcat').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<td align="right">
<span class="feildstxt"> Select Filter Option&nbsp;&nbsp;:&nbsp;&nbsp;
<select name="SearchFilterFieldList" id="SearchFilterFieldList" onchange="return onchangeFilterField('Bl_ProductSubCategory');"><option value="">-- Select Filter --</option>
<option value="ProCategory" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='ProCategory'){ echo 'Selected';} ?> >Product Category</option>
<option value="ProSubCategory" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='ProSubCategory'){ echo 'Selected';} ?> >Product Sub Category</option>
</select></span>&nbsp;&nbsp;<span id="FilterFieldList">
<?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProCategory') 
{ ?>
<select id="SearchFilterField" name="SearchFilterField" class="dropdown">
<option value="" selected="selected">--Select Sector--</option>
<?php $SelectSector=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE Status='1'");
while($FetchSector=db_fetch_array($SelectSector))
{ ?>
<option  value="<?php echo $FetchSector['ProductCat_Pk']; ?>" <?php if($_REQUEST['SearchFilterField']==$FetchSector['ProductCat_Pk']){ echo 'Selected'; } ?> ><?php echo $FetchSector['ProductCat_Name']; ?></option><?php 
}?>
</select><?php
}
else if($_REQUEST['SearchFilterFieldList']=='ProSubCategory') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php
}	 
else { ?><input type="hidden" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php } ?></span>&nbsp;&nbsp;
<span><input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_ProductSubCategory');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div id="DetailList">
<?php $_REQUEST['optid'] = (isset($_REQUEST['optid']) ? $_REQUEST['optid'] : '');
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.ProductSubCat_Pk, b.ProductCat_Name, a.ProductSubCat_Name, a.Status From ".TABLE_PRODUCTSUBCATEGORY." a LEFT JOIN ".TABLE_PRODUCTCATEGORY." b on b.ProductCat_Pk = a.ProductCat_Fk ";
$orderBy = ' a.ProductSubCat_Pk ';
if($_REQUEST['SearchFilterFieldList']=='ProCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' Where a.ProductCat_Fk ="'.$_REQUEST['SearchFilterField'].'"'	;
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProSubCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ProductSubCat_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Product Sub Category Details';
$colHead  = array("Sl.No.", "Product Category", "Product Sub Category", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
