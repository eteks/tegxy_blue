<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();


$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
include("include/BlModules/Bl_GeneralArea.php");

$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".TABLE_GENERALAREAMASTER." WHERE Id='".$_REQUEST['id']."' ");
$Fetch=db_fetch_array($Select);
$_REQUEST['startdata'] = (isset($_REQUEST['startdata']) ? $_REQUEST['startdata'] : '');
if($_REQUEST['startdata']=='')
$_REQUEST['startdata']=0;
if($_REQUEST['startdata']==-1)
$_REQUEST['startdata']=0;
?>
<script type="text/javascript" src="js/GeneralArea.js"></script>
<div id="ScrollText" style="overflow:auto;">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
<tr>
<td align="left" valign="top">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">General City Master</td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="GeneralAreaForm" name="GeneralAreaForm" action="index.php" onSubmit="return ValidateArea();">
<input type="hidden" value="<?php echo $Fetch['Id']; ?>" id="ExistId" name="ExistId" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;
<?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Area Name Already Exist!"; }
if($_REQUEST['s']==3){ echo "Deleted Successfully"; }
if($_REQUEST['s']==4){ echo "Status Updated Successfully"; }
if($_REQUEST['s']==5){ echo "Updated Successfully"; }
?></span></td></tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Country</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><select id="SelCountry" name="SelCountry" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> onchange="return OnclickGeneralCountry(this.value);">
<option value="" selected="selected">--Select Country--</option>

<?php $SelectCountry=db_query("Select * From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1"); 
while($FetchCountry=db_fetch_array($SelectCountry)){
?>
<option  value="<?php echo $FetchCountry['Id']; ?>" <?php if($FetchCountry['Id']==$Fetch['A_Country']){ ?> selected <?php }?> ><?php echo $FetchCountry['Country_Name']; ?></option>
<?php }?>
</select>&nbsp;&nbsp;<span id="validateshow" ><span id="Req4" class="feildstxt"></span></span>
</td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*State</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><span id="ShowStateList"> 
<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' ){  ?>

<select id="SelState" name="SelState" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
<option value="" selected="selected">--Select State--</option><?php 
$SelectState=db_query("Select * From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='".$Fetch['A_Country']."'"); 
while($FetchState=db_fetch_array($SelectState))
{ ?>
<option  value="<?php echo $FetchState['Id']; ?>" <?php if($FetchState['Id']==$Fetch['A_State']){ ?> selected <?php }?> ><?php echo $FetchState['St_Name']; ?></option><?php 
}?>
</select>
<?php } else {  ?>
<select id="SelState" name="SelState" class="dropdown" <?php if($_REQUEST['action']=='view'){ ?> disabled <?php } ?>>
<option value="" selected="selected">--Select State--</option>
</select>
<?php } ?>
</span>
</td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*City Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<?php
$autoCode = getMaxId(TABLE_GENERALAREAMASTER, 'Id') + 1;
$autoCode = 'GMC'.$autoCode;
if ($_REQUEST['action']=='edit' && $Fetch['Area_code'] == '')
$autoCode = 'GMC'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['Area_code'];
?><input type="text" name="TxtAreaCode" id="TxtAreaCode" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>&nbsp;&nbsp;<span id="validateshow"><span id="Req2" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*City Name</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><input type="text" name="TxtArea" id="TxtArea" value="<?php echo $Fetch['Area']; ?>" autocomplete="off" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> class="input"/> &nbsp;&nbsp;<span id="validateshow"><span id="Req3" class="feildstxt"></span></span></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  /></td>
</tr>
<tr>
<td height="30" colspan="3" align="center">
<?php
$submitName = 'SubArea';
$fileName   = 'GeneralArea';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="GeneralAreaForm" />
<input type="hidden" id="ModuleId" name="ModuleId" value="<?php echo $ModuleId ?>" />
<input type="hidden" id="fileName" name="fileName" value="<?php echo $fileName ?>" />
<input type="hidden" id="startdata" name="startdata" value="<?php echo $_REQUEST['startdata'] ?>" />
<input type="hidden" id="hidSearchFilterFieldList" name="hidSearchFilterFieldList" value="<?php echo $_REQUEST['SearchFilterFieldList'] ?>" />
<input type="hidden" id="hidSearchFilterField" name="hidSearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'] ?>" />
</td>
</tr>
</table>
</form></td>
</tr>
<script type="text/javascript" language="javascript">
var cursorpointer=document.getElementById('TxtAreaCode').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<td align="right"><span class="feildstxt"> Select Filter Option&nbsp;&nbsp;:&nbsp;&nbsp;<select name="SearchFilterFieldList" id="SearchFilterFieldList" onchange="return onchangeFilterField('Bl_GeneralArea');"><option value="">-- Select Filter --</option><option value="Country" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='Country'){?>Selected<?php }?>>Country</option><option value="State" <?php if($_REQUEST['SearchFilterFieldList']=='State'){?>Selected<?php }?>>State</option><option value="City" <?php if($_REQUEST['SearchFilterFieldList']=='City'){?>Selected<?php }?>>City</option></select></span>&nbsp;&nbsp;<span id="FilterFieldList"><?php 
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Country') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select Country--</option><?php $SelectCountry=db_query("Select * From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1");
while($FetchCountry=db_fetch_array($SelectCountry))
{ ?>
<option  value="<?php echo $FetchCountry['Id']; ?>" <?php if($_REQUEST['SearchFilterField']==$FetchCountry['Id']){ echo 'Selected';} ?> ><?php echo $FetchCountry['Country_Name']; ?></option><?php 
}?>
</select><?php
}
else if($_REQUEST['SearchFilterFieldList']=='State') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select State--</option><?php $SelectState=db_query("Select * From ".TABLE_GENERALSTATEMASTER." WHERE Status=1");
while($FetchState=db_fetch_array($SelectState))
{ ?>
<option  value="<?php echo $FetchState['Id']; ?>" <?php if($_REQUEST['SearchFilterField']==$FetchState['Id']){ echo 'Selected';} ?> ><?php echo $FetchState['St_Name']; ?></option><?php 
}?>
</select><?php
}
else if($_REQUEST['SearchFilterFieldList']=='City') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php } 
else { ?><input type="hidden" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php } ?></span>&nbsp;&nbsp;<span><input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_GeneralArea');"/></span></td>
</tr>
</table>
</td>
</tr>
<tr><td>&nbsp;</td></tr>
<tr>
<td align="left" valign="top">
<div  id="DetailList">
<?php $_REQUEST['optid'] = (isset($_REQUEST['optid']) ? $_REQUEST['optid'] : '');
$optId = $_REQUEST['optid'];
$all_Sql = "Select DISTINCT a.Id, b.Country_Name, c.St_Name, a.Area, a.Status, c.St_Name From ".TABLE_GENERALAREAMASTER." a LEFT JOIN ".TABLE_GENERALCOUNTRYMASTER." b on b.Id = a.A_Country LEFT JOIN ".TABLE_GENERALSTATEMASTER." c on c.Id = a.A_State";
$orderBy = ' a.Id ';
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.A_Country ="'.$_REQUEST['SearchFilterField'].'"';
}
if($_REQUEST['SearchFilterFieldList']=='State')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.A_State ="'.$_REQUEST['SearchFilterField'].'"';
}
if($_REQUEST['SearchFilterFieldList']=='City')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.Area like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'General City Master Details';
$colHead  = array("Sl.No.", "Country", "State", "City Name", "Status", "Action");
include_once('six_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
<span style="display:none;" id="ShowCityList" ></span>
