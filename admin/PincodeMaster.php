<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');

if(!isset($_SESSION['Admin_Id']))
header("location:Login.php");

$ModuleId = $_REQUEST['ModuleId'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$Select=db_query("Select * from ".TABLE_PINCODEMASTER." WHERE PM_Id='".$_REQUEST['id']."' ");
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
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
<td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
<td align="left" valign="top" class="title">Pincode Master</td>
</tr>
</table></td>
</tr>
<tr>
<td align="left" valign="top" class="tdcom">
<form method="post" id="PincodeMasterForm" name="PincodeMasterForm" action="index.php" onSubmit="return ValidatePincodeMaster();">
<input type="hidden" value="<?php echo $Fetch['Id']; ?>" id="ExistId" name="ExistId" />
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr><td colspan="3" align="center"><span id="msgdisplay">&nbsp;
<?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : '');
if($_REQUEST['s']==1){ echo "Added Successfully!"; }
if($_REQUEST['s']==2){ echo "This Pincode Already Exist!"; }
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
<option  value="<?php echo $FetchCountry['Id']; ?>" <?php if($FetchCountry['Id']==$Fetch['PM_Country']){ ?> selected <?php }?> ><?php echo $FetchCountry['Country_Name']; ?></option>
<?php }?>
</select>&nbsp;&nbsp;<span id="validateshow" ><span id="Req4" class="feildstxt"></span></span>
</td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*State</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><span id="ShowStateList"> 
<?php $_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : ''); if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' ){  ?>

<select id="SelState" name="SelState" class="dropdown" onchange="OnclickGeneralState(this.value);" <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
<option value="" selected="selected">--Select State--</option><?php 
$SelectState=db_query("Select * From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='".$Fetch['PM_Country']."'"); 
while($FetchState=db_fetch_array($SelectState))
{ ?>
<option  value="<?php echo $FetchState['Id']; ?>" <?php if($FetchState['Id']==$Fetch['PM_State']){ ?> selected <?php }?> ><?php echo $FetchState['St_Name']; ?></option><?php 
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
<td width="35%" height="24" align="right"><span class="feildstxt">*City</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><span id="ShowCityList"> 
<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' ){  ?>

<select id="SelCity" name="SelCity" class="dropdown" onchange="OnclickGeneralCity(this.value);" <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
<option value="" selected="selected">--Select City--</option><?php 
$SelectCity=db_query("Select * From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$Fetch['PM_Country']."' AND A_State='".$Fetch['PM_State']."'"); 
while($FetchCity=db_fetch_array($SelectCity))
{ ?>
<option  value="<?php echo $FetchCity['Id']; ?>" <?php if($FetchCity['Id']==$Fetch['PM_City']){ ?> selected <?php }?> ><?php echo $FetchCity['Area']; ?></option><?php 
}?>
</select>
<?php } else {  ?>
<select id="SelCity" name="SelCity" class="dropdown" <?php if($_REQUEST['action']=='view'){ ?> disabled <?php } ?>>
<option value="" selected="selected">--Select City--</option>
</select>
<?php } ?>
</span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Area</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><span id="ShowAreaList"> 
<?php $_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : ''); if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit' ){ 
?><select id="SelArea" name="SelArea" class="dropdown"  <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?> >
<option value="" selected="selected">--Select Area--</option><?php 
$SelectArea=db_query("Select * From ".TABLE_AREAMASTER." WHERE AM_Status=1 AND AM_Country='".$Fetch['PM_Country']."' AND AM_State='".$Fetch['PM_State']."' AND AM_City='".$Fetch['PM_City']."'"); 
while($FetchArea=db_fetch_array($SelectArea))
{ ?>
<option  value="<?php echo $FetchArea['AM_Id']; ?>" <?php if($FetchArea['AM_Id']==$Fetch['PM_Area']){ ?> selected <?php }?> ><?php echo $FetchArea['AM_Area']; ?></option><?php 
}?>
</select>
<?php } else {  ?>
<select id="SelArea" name="SelArea" class="dropdown" <?php if($_REQUEST['action']=='view'){ ?> disabled <?php } ?>>
<option value="" selected="selected">--Select Area--</option>
</select>
<?php } ?>
</span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Pincode Code</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24">
<?php
$autoCode = getMaxId(TABLE_PINCODEMASTER, 'PM_Id') + 1;
$autoCode = 'PMC'.$autoCode;
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if ($_REQUEST['action']=='edit' && $Fetch['PM_Code'] == '')
$autoCode = 'PMC'.$_REQUEST['id'];
else if ($_REQUEST['action']=='view' || $_REQUEST['action']=='edit')
$autoCode = $Fetch['PM_Code'];
?><input type="text" name="TxtPinCode" id="TxtPinCode" class="input" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> value="<?php if($_REQUEST['action']=='view' || $_REQUEST['action']=='edit') echo $autoCode; else echo $autoCode; ?>" autocomplete="off"/>&nbsp;&nbsp;<span id="validateshow"><span id="Req2" class="feildstxt"></span></span></td>
</tr>
<tr>
<td width="35%" height="24" align="right"><span class="feildstxt">*Pincode</span></td>
<td width="2%" height="24" align="center"><span class="feildstxt">:</span></td>
<td width="63%" height="24"><input type="text" name="TxtPin" id="TxtPin" value="<?php echo $Fetch['PM_Pincode']; ?>" autocomplete="off" <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?> class="input"/> &nbsp;&nbsp;<span id="validateshow"><span id="Req3" class="feildstxt"></span></span></td>
</tr>
<tr>
<td height="24" align="right"><span class="feildstxt">Active Status</span></td>
<td height="24" align="center"><span class="feildstxt">:</span></td>
<td height="24"><input type="checkbox" name="ActiveStatus" id="ActiveStatus" style="width:20px;border:0px;" value="1" autocomplete="off" class="input" <?php if($Fetch['PM_Status']=='1' || ($_REQUEST['action']!='view' && $_REQUEST['action']!='edit')){ ?> checked="checked"<?php }?> <?php if($_REQUEST['action']=='view')	{ ?> disabled <?php } ?>  /></td>
</tr>
<tr>
<td height="30" colspan="3" align="center">
<?php
$submitName = 'SubPinMater';
$fileName   = 'PincodeMaster';
include_once('opt_Table.php'); ?>
<input type="hidden" id="formname" name="formname" value="PincodeMasterForm" />
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
var cursorpointer=document.getElementById('TxtPinCode').focus();
</script>
<tr><td>&nbsp;</td></tr>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0" width="100%">
<tr>
<td align="left" class="feildstxt"><strong>Filter</strong></td>
<td align="right"><span class="feildstxt"> Select Filter Option&nbsp;&nbsp;:&nbsp;&nbsp;<select name="SearchFilterFieldList" id="SearchFilterFieldList" onchange="return onchangeFilterField('Bl_PincodeMaster');"><option value="">-- Select Filter --</option><option value="Country" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='Country'){?>Selected<?php }?>>Country</option><option value="State" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='State'){?>Selected<?php }?>>State</option><option value="City" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='City'){?>Selected<?php }?>>City</option><option value="Area" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='Area'){?>Selected<?php }?>>Area</option><option value="Pin" <?php $_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : ''); if($_REQUEST['SearchFilterFieldList']=='Pin'){?>Selected<?php }?>>Pin</option></select></span>&nbsp;&nbsp;<span id="FilterFieldList"><?php 
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
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select City--</option><?php $SelectCity=db_query("Select Id,Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1");
while($FetchCity=db_fetch_array($SelectCity))
{ ?>
<option  value="<?php echo $FetchCity['Id']; ?>" <?php if($_REQUEST['SearchFilterField']==$FetchCity['Id']){ echo 'Selected';} ?> ><?php echo $FetchCity['Area']; ?></option><?php 
}?>
</select><?php
}
else if($_REQUEST['SearchFilterFieldList']=='Area') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select Area--</option><?php $SelectArea=db_query("Select AM_Id,AM_Area From ".TABLE_AREAMASTER." WHERE AM_Status=1");
while($FetchArea=db_fetch_array($SelectArea))
{ ?>
<option  value="<?php echo $FetchArea['Id']; ?>" <?php if($_REQUEST['SearchFilterField']==$FetchArea['Id']){ echo 'Selected';} ?> ><?php echo $FetchArea['Area']; ?></option><?php 
}?>
</select><?php
}
else if($_REQUEST['SearchFilterFieldList']=='Pin') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php } 
else { ?><input type="hidden" name="SearchFilterField" id="SearchFilterField" value="<?php echo $_REQUEST['SearchFilterField'];?>" class="input"/><?php } ?></span>&nbsp;&nbsp;<span><input type="button" name="SearchFilter" id="SearchFilter" value="Search Filter" onclick="return OnChangeFilterElement('SearchFilterField','<?php echo $ModuleId;?>','Bl_PincodeMaster');"/></span></td>
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
$all_Sql = "Select DISTINCT a.PM_Id, b.Country_Name, c.St_Name, a.PM_Pincode, a.PM_Status From ".TABLE_PINCODEMASTER." a LEFT JOIN ".TABLE_GENERALCOUNTRYMASTER." b on b.Id = a.PM_Country LEFT JOIN ".TABLE_GENERALSTATEMASTER." c on c.Id = a.PM_State LEFT JOIN ".TABLE_GENERALAREAMASTER." d on d.Id = a.PM_City LEFT JOIN ".TABLE_AREAMASTER." e on e.AM_Id = a.PM_Area";
$orderBy = ' a.PM_Id ';
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_Country ="'.$_REQUEST['SearchFilterField'].'"';
}
if($_REQUEST['SearchFilterFieldList']=='State')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_State ="'.$_REQUEST['SearchFilterField'].'"';
}
if($_REQUEST['SearchFilterFieldList']=='City')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_City ="'.$_REQUEST['SearchFilterField'].'"';
}
if($_REQUEST['SearchFilterFieldList']=='Area')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_Area ="'.$_REQUEST['SearchFilterField'].'"';
}

if($_REQUEST['SearchFilterFieldList']=='Pin')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_Pincode like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Pincode Master Details';
$colHead  = array("Sl.No.", "Country", "State", "Pincode", "Status", "Action");
include_once('six_col_grid.php');
?>
</div>
</td>
</tr>
</table>
</div>
