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
$Select=db_query("Select * from ".TABLE_PRODUCTSERVICE. " where PS_Status='1'");
$Fetch=db_fetch_array($Select);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;
if(isset($_REQUEST['action'])){
	if($_REQUEST['action']=='edit'){
		$ValidCheckSql ="Select * FROM ".TABLE_PRODUCTRELATIVITY." WHERE  Product_fk='".$_REQUEST['id']."'";
	}else if($_REQUEST['action']=='view'){
		$ValidCheckSql1 ="Select * FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_Id='".$_REQUEST['id']."'";
		echo $ValidCheckSql1;
		$ValidCheckRel1=db_query($ValidCheckSql1);
		$ValidCheckRel11=db_fetch_array($ValidCheckRel1);
		$CountValidRel=db_num_rows($ValidCheckRel11);
	}
}
$fileName   = 'UserProduct';
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
<?php
if($_REQUEST['action']=='view'){
?>
<table style="left: 201px; position: relative; z-index: -1000; padding: 34px;">
	<tr>
		<td class="feildstxt">Product mode</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt">
			<?php 
				if($ValidCheckRel11['PS_Mode']=='1'){
					echo 'Provider';
				}
				else {
					echo 'Seeker';
				}
			?>
		</td>
	</tr>
	<tr>
		<td class="feildstxt">Display name</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo $ValidCheckRel11['PS_Display']; ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Product / Service Name</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo ProductName($ValidCheckRel11['PS_Fk']); ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Industry</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo ProductCategory($ValidCheckRel11['PS_CategoryFk']).'>>'.ProductSubCategory($ValidCheckRel11['PS_SubCategoryFk']).'>>'.ProductType($ValidCheckRel11['PS_TypeFk']); ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Description</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo $ValidCheckRel11['PS_Description']; ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Business Type</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo $ValidCheckRel11['PS_BusinessType']; ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Keyword</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo $ValidCheckRel11['PS_Keyword']; ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Currency</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt">
			<?php if($ValidCheckRel11['PS_Currency']==1){
				echo "INR";
			} else{
				echo "$";
			}
			?></td>
	</tr>
	<tr>
		<td class="feildstxt">Quantity</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo $ValidCheckRel11['PS_Unit']; ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Price</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php echo $ValidCheckRel11['PS_Price']; ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Brochure</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><?php if(!empty($ValidCheckRel11['PS_Brochure'])){?><a href="../<?php echo $ValidCheckRel11['PS_Brochure']; ?>" target="_blank"><img width="30" height="30" src="../images/pdf.png"></a><?php }else{ echo "Nil"; } ?></td>
	</tr>
	<tr>
		<td class="feildstxt">Cover Image</td>
		<td class="feildstxt">:</td>
		<td class="feildstxt"><a target="_blank"><?php if(!empty($ValidCheckRel11['PS_CoverImg'])){?><img width="100" height="100" src="../<?php echo $ValidCheckRel11['PS_CoverImg']; ?>"><?php } else echo 'Nil';?></td>
	</tr>

</table>
<?php
}
?>
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
$all_Sql = "Select DISTINCT a.PS_Id, a.PS_Display, a.PS_Status From ".TABLE_PRODUCTSERVICE." AS a ";
$orderBy = ' a.PS_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PS_Display like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont)){
	if($WhereCont==''){
		$WhereCont = ' where 1';
	}
}
$Verified='A';
$gridHead = 'Product List Details';
$colHead  = array("Sl.No.",'', "Product Name",'',"Status");
include_once('three_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>