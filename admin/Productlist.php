<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

include("include/BlModules/Bl_General.php");
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

include("include/BlModules/Bl_Productlist.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".TABLE_ADMINPRODUCT." WHERE Id='".$_REQUEST['id']."' ");
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
$CountValidRel=db_num_rows($ValidCheckRel);?>
<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Product List</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" enctype="multipart/form-data" name="FrmProductList" id="FrmProductList" action="index.php" onSubmit="return ValidateProductList();"> 
<input type="hidden" value="<?php echo $Fetch['Id']; ?>" id="ExistId" name="ExistId" />
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;<span id="Req"><?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Product Name Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; } ?></span></span></td></tr>
<tr>
<td height="24" align="right">
<table border="0" cellspacing="2" cellpadding="2" width="100%">
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">* </span>
Product  Code</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">
<?php
$autoCode = getMaxId(TABLE_ADMINPRODUCT, 'Id') + 1;
$autoCode = 'PRO'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['ProductCode'] == '')
$autoCode = 'PRO'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['ProductCode'];
?>
<input type="text" name="TxtProductCode" id="TxtProductCode" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>
</td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt"><span id="mustrequired">* </span>
Product  Name</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left"><input name="TxtProductName" type="text" id="TxtProductName" autocomplete="off"  value="<?php echo $Fetch['ProductName']; ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php } ?> class="input" /></td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt">* Product Category </td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">
<?php 
if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' )
{ ?>
<select id="Selpcat" name="Selpcat" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>   onchange="return OnclickPCategory(this.value);" >
<option value="" selected="selected">--Select Product Category--</option>
<?php 
$SelectCategory=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE Status='1'"); 
while($FetchCat=db_fetch_array($SelectCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductCat_Pk']; ?>" <?php if($FetchCat['ProductCat_Pk']==$Fetch['Category_fk']){ ?> selected <?php } ?> ><?php echo $FetchCat['ProductCat_Name']; ?></option>
<?php 
}?>
</select>
<?php 
} else { // save option ?>
<select id="Selpcat" name="Selpcat" class="dropdown" 
onchange="return OnclickPCategory(this.value);">
<option value="" selected="selected">--Select Product Category--</option>
<?php 
$SelectCategory=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE Status='1'"); 
while($FetchCat=db_fetch_array($SelectCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductCat_Pk']; ?>" ><?php echo $FetchCat['ProductCat_Name']; ?></option>
<?php 
}?>
</select>
<?php } ?></td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt">Product Sub Category </td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">
<span id="ShowProductSubCategory">
<?php 
if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' )
{  ?>
<select id="CboSubCatName" name="CboSubCatName" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  onchange="return OnclickPSubCategory(this.value);" >
<option value="" selected="selected">--Select Sub Product Category--</option>
<?php 
$SelectSubCategory=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1' AND ProductCat_Fk='".$Fetch['Category_fk']."'"); 
while($FetchCat=db_fetch_array($SelectSubCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductSubCat_Pk']; ?>" <?php if($FetchCat['ProductSubCat_Pk']==$Fetch['SubCategory_fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ProductSubCat_Name']; ?></option>
<?php 
}?>
</select>
<?php 
} else { ?>

<select id="CboSubCatName" name="CboSubCatName" class="dropdown"  onchange="return OnclickPSubCategory(this.value);"  >
<option value="" selected="selected">--Select Sub Product Category--</option>
<?php 
$SelectSubCategory=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1'"); 
while($FetchCat=db_fetch_array($SelectSubCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductSubCat_Pk']; ?>" ><?php echo $FetchCat['ProductSubCat_Name']; ?></option>
<?php } ?>
</select>

<?php } ?>   
</span></td>
</tr>
<tr>
<td height="24" align="right" class="feildstxt">Product Type</td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left">
<span id="ShowProductType">
<?php 
if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' )
{  ?>
<select id="CboPtpeCode" name="CboPtpeCode" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  >
<option value="" selected="selected">--Select Product Type--</option>
<?php 
$SelectProductType=db_query("Select ProductType_Pk,ProductType_Name From ".TABLE_PRODUCTTYPE." WHERE Status='1' AND ProductCat_Fk='".$Fetch['Category_fk']."' AND ProductSubCat_Fk='".$Fetch['SubCategory_fk']."'"); 
while($FetchCat=db_fetch_array($SelectProductType))
{ ?>
<option  value="<?php echo $FetchCat['ProductType_Pk']; ?>" <?php if($FetchCat['ProductType_Pk']==$Fetch['ProductType_fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ProductType_Name']; ?></option>
<?php 
}?>
</select>
<?php 
} else { ?>
<select id="CboPtpeCode" name="CboPtpeCode" class="dropdown">
<option value="" selected="selected">--Select Product Type--</option>
<?php 
$SelectProductType=db_query("Select ProductType_Pk,ProductType_Name From ".TABLE_PRODUCTTYPE." WHERE Status='1'"); 
while($FetchCat=db_fetch_array($SelectProductType))
{ ?>
<option  value="<?php echo $FetchCat['ProductType_Pk']; ?>" ><?php echo $FetchCat['ProductType_Name']; ?></option>
<?php 
} ?>
</select>
<?php } ?> 
</span></td>
</tr>
<?php if($_REQUEST['action']!='view') {?>
<tr><td colspan="3" align="center">

<input type="hidden" name="TxtEditId" id="TxtEditId" />
<input type="button" class="menu" id="BtnAddProductCom" name="BtnAddProductCom" value="Add" onclick="AddProductCom();">
</td></tr>
<?php }?>
<tr><td colspan="3" align="center">
<div id="ShowProductComList">
<input type="hidden" name="RelativityChk" id="RelativityChk" value="<?php echo $CountValidRel;?>" />
<?php if($_REQUEST["action"]=="edit" || $_REQUEST["action"]=="view") {
$SelProductRel=db_query("SELECT * FROM ".TABLE_PRODUCTRELATIVITY." WHERE Product_fk='".$_REQUEST["id"]."'");?>

<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10" align="left" valign="top"><img src="images/gridbox/grid_l_bg.gif" width="10" height="27" /></td>
<td align="left" class="gridmenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td width="10%" align="center" valign="top">S.No</td>
<td width="25%" align="left" valign="top">Category</td>
<td width="25%" align="left" valign="top">SubCategory</td>
<td width="20%" align="left" valign="top">Product Type</td>
<td width="20%" align="left" valign="top">Action</td>
</tr>
</table>
</td>
<td width="7" align="right" valign="top"><img src="images/gridbox/gird_r-bg.gif" width="7" height="27" /></td>
</tr>
</table>
</td>
</tr>

<tr>
<td align="left" valign="top" class="tdmsg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" ><?php 
$i=1;
if(db_num_rows($SelProductRel)>0)
{
while($row=db_fetch_array($SelProductRel)) 
{ ?>
<tr><td colspan="3"  height="2"></td></tr>
<tr>
<td width="10%"  align="center" class="gridtxt"><?php echo $i;?></td>
<td width="25%" align="left" class="gridtxt"><?php echo ProductCategory($row["Category_fk"]); ?></td>
<td width="25%" align="left" class="gridtxt"><?php echo ProductSubCategory($row["SubCategory_fk"]); ?></td>
<td width="20%" align="left" class="gridtxt"><?php echo ProductType($row["ProductType_fk"]); ?></td>
<td width="20%" align="left" class="gridtxt"><?php if($_REQUEST['action']!='view') {?><span style="cursor:pointer;" <?php if ($_REQUEST["action"]!="view"){ ?>  onClick="EditProductCom(<?php echo $row["Id"] ?>);" <?php } ?>>Edit</span>/<span style="cursor:pointer;" <?php if ($_REQUEST["action"]!="view"){ ?> onClick="DeleteProductCom(<?php echo $row["Id"] ?>);" <?php } ?>>Delete</span><?php }?></td>
</tr><?php 
$i=$i+1; 
} } else {?><tr>
<td align="left" valign="top" class="tdmsg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td align="center" class="gridtxt">No Record Found</td>
</tr>
</table>
</td>
</tr><?php }?>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="6" width="7" align="left"><img src="images/gridbox/grid_l_bt.gif" width="7" height="6" /></td>
<td height="6" background="images/gridbox/grid_m_bt.gif"></td>
<td height="6" width="7" align="right"><img src="images/gridbox/grid_r_bt.gif" width="7" height="6" /></td>
</tr>
</table>
</td>
</tr>
</table>
<?php } else {?>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="10" align="left" valign="top"><img src="images/gridbox/grid_l_bg.gif" width="10" height="27" /></td>
<td align="left" class="gridmenu">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td width="10%" align="center" valign="top">S.No</td>
<td width="25%" align="left" valign="top">Category</td>
<td width="25%" align="left" valign="top">SubCategory</td>
<td width="20%" align="left" valign="top">Product Type</td>
<td width="20%" align="left" valign="top">Action</td>
</tr>
</table>
</td>
<td width="7" align="right" valign="top"><img src="images/gridbox/gird_r-bg.gif" width="7" height="27" /></td>
</tr>
</table>
</td>
</tr>

<tr>
<td align="left" valign="top" class="tdmsg">
<table width="100%" border="0" cellspacing="0" cellpadding="0" >
<tr>
<td align="center" class="gridtxt">No Record Found</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td height="6" width="7" align="left"><img src="images/gridbox/grid_l_bt.gif" width="7" height="6" /></td>
<td height="6" background="images/gridbox/grid_m_bt.gif"></td>
<td height="6" width="7" align="right"><img src="images/gridbox/grid_r_bt.gif" width="7" height="6" /></td>
</tr>
</table>
</td>
</tr>
</table>
<?php }?>
</div>


</td></tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24" align="left"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled="disabled" <?php } ?>  />
</td>
</tr>
</table>
</td>
</tr>
<tr>
<td height="30" align="center">
<?php
$submitName = 'Productlist';
$fileName   = 'Productlist';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="FrmProductList" />
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
<select name="SearchFilterFieldList" id="SearchFilterFieldList" onchange="return onchangeFilterField('Bl_Productlist');"><option value="">-- Select Filter --</option>
<option value="ProName" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='ProName'){ echo 'Selected';} ?> >Product Name</option>
</select></span>&nbsp;&nbsp;<span id="FilterFieldList">
<?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProName') { ?>
<input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" class="input"/><?php 
} else { ?> <input type="hidden" name="SearchFilterField" id="SearchFilterField" value="" class="input"/><?php }
?></span>&nbsp;&nbsp;
<span><input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId; ?>','Bl_Productlist');"/></span></td>
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
$all_Sql = "Select DISTINCT a.Id, a.ProductCode, a.ProductName, a.Status,a.Verify From ".TABLE_ADMINPRODUCT." a ";
$orderBy = ' a.Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ProductName like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$Verified='A';
$gridHead = 'Product List Details';
$colHead  = array("Sl.No.", "Product Code", "Product Name", "Status","Verification","Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
