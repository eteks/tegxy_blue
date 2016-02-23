<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
include("include/BlModules/Bl_General.php");
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");
$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

include("include/BlModules/Bl_AdvertisementCurrency.php");
$SelectRole=db_query("Select * from ".TABLE_ADVCURRENCY." WHERE Id='".$_REQUEST['id']."' ");
$FetchRole=db_fetch_array($SelectRole);
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;
 ?>
<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Currency</td>
</tr>
</table>
</td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="AdvertisementCurrencyForm" name="AdvertisementCurrencyForm" action="index.php" onSubmit="return ValidateAdvertisementCurrency();">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td colspan="3" align="center"><span id="msgdisplay">&nbsp;<?php 
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Currency Name Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; } ?></span>
</td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Currency Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<?php
$autoCode = getMaxId(TABLE_ADVCURRENCY, 'Id') + 1;
$autoCode = 'CUR'.$autoCode;
if ($_REQUEST['action']=='edit' && $FetchRole['CurrencyCode'] == '')
$autoCode = 'CUR'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $FetchRole['CurrencyCode'];
?>
<input type="text" name="Currencycode" id="Currencycode" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>&nbsp;&nbsp;<span id="validateshow"><span id="Req1" class="feildstxt"></span></span>
</td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Currency Name</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><input type="text" autocomplete="off"  name="CurrencyName" id="CurrencyName" value="<?php echo $FetchRole['CurrencyName']; ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input" />&nbsp;&nbsp;<span id="validateshow"><span id="Req2" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">Symbol</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><input type="text" autocomplete="off"  name="Symbol" id="Symbol" value="<?php echo $FetchRole['Symbol']; ?>" <?php if($_REQUEST['action']=='view' ){ ?> readonly="" <?php }?> class="input"/>&nbsp;&nbsp;<span id="validateshow"><span id="Req3" class="feildstxt"></span></span><input type="hidden" value="<?php echo $FetchRole['Id']; ?>" id="ExistId" name="ExistId" /><input type="hidden" value="<?php echo $FetchRole['Status']; ?>" id="Status" name="Status" /><input type="hidden" autocomplete="off"  name="Currencycode" id="Currencycode" value="<?php echo $FetchRole['CurrencyCode']; ?>" /></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($FetchRole['Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  /></td>
</tr>
<tr>
<td height="30" colspan="3" align="center">
<?php
$submitName = 'AdvertisementCurrency';
$fileName   = 'AdvertisementCurrency';
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
var cursorpointer=document.getElementById('Currencycode').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<Td align="right"><span class="feildstxt">Currency Name :</span><span id="FilterFieldList"><input type="hidden" name="SearchFilterFieldList" id="SearchFilterFieldList" value="CurrencyName" /></span><span id="FilterField"><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField']; ?>" class="input"/></span><span>&nbsp;&nbsp;<input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_AdvertisementCurrency');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div id="DetailList">
<?php
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.Id, a.CurrencyName, a.Symbol, a.Status From ".TABLE_ADVCURRENCY." a";
$orderBy = ' a.Id ';

if($_REQUEST['SearchFilterFieldList']=='CurrencyName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' Where a.CurrencyName like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if($WhereCont=='')
$WhereCont = ' where 1';

$gridHead = 'Currency Details';
$colHead  = array("Sl.No.", "Currency Name", "Symbol", "Status", "Action");
include_once('five_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
