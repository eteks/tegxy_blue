<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['SubPinMater'] = (isset($_POST['SubPinMater']) ? $_POST['SubPinMater'] : '');
$_REQUEST['SubPinMater'] = (isset($_REQUEST['SubPinMater']) ? $_REQUEST['SubPinMater'] : '');
if(($_POST['SubPinMater'] == 'Submit') || ($_REQUEST['SubPinMater'] == 'Update'))
{
$TxtPinCode=$_POST["TxtPinCode"];
$TxtPin	=$_POST["TxtPin"];
$SelCountry =$_POST["SelCountry"];
$SelState	=$_POST["SelState"];
$SelCity	=$_POST["SelCity"];
$SelArea	=$_POST["SelArea"];
$ActiveStatus=$_POST['ActiveStatus'];
$ExistId	=$_POST['ExistId']; 
$Status=$_POST['Status'];
$startdata		=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select PM_Area FROM ".TABLE_PINCODEMASTER." WHERE  `PM_Area`='".$SelArea."' AND `PM_Country`='".$SelCountry."' AND `PM_State`='".$SelState."' AND `PM_City`='".$SelCity."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','PincodeMaster','0', '');</script>";
else
{
echo $Head_Query="INSERT INTO ".TABLE_PINCODEMASTER." SET `PM_Code`='".$TxtPinCode."',`PM_Pincode`='".$TxtPin."' ,`PM_Area`='".$SelArea."' ,`PM_Country`='".$SelCountry."' ,`PM_State`='".$SelState."',`PM_City`='".$SelCity."', `PM_Status`='".$ActiveStatus."'  ,`PM_CreatedBy`='".$_SESSION['Admin_Id']."',`PM_CreatedOn`=NOW() ,`PM_ModifiedOn`=NOW() ,`PM_ModifiedBy`='".$_SESSION['Admin_Id']."'";
$Head_Insert=db_query($Head_Query); 
$optId = db_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','PincodeMaster','0', '$optId');</script>";
}
}
else
{
$Head_Query="UPDATE ".TABLE_PINCODEMASTER." SET `PM_Code`='".$TxtPinCode."',`PM_Pincode`='".$TxtPin."' ,`PM_Area`='".$SelArea."' ,`PM_Country`='".$SelCountry."' ,`PM_State`='".$SelState."',`PM_City`='".$SelCity."',`PM_Status`='".$ActiveStatus."'  ,`PM_ModifiedOn`=NOW() Where Id='".$ExistId."'";
$Head_Insert=db_query($Head_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','PincodeMaster','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}exit;
}
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='FilterFieldList')
{ 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
if($_REQUEST['SearchFilterFieldList']=='Country') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select Country--</option><?php $SelectCountry=db_query("Select * From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1");
while($FetchCountry=db_fetch_array($SelectCountry))
{ ?>
<option  value="<?php echo $FetchCountry['Id']; ?>"><?php echo $FetchCountry['Country_Name']; ?></option><?php 
}?>
</select><?php
}
if($_REQUEST['SearchFilterFieldList']=='State') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select State--</option><?php $SelectState=db_query("Select * From ".TABLE_GENERALSTATEMASTER." WHERE Status=1");
while($FetchState=db_fetch_array($SelectState))
{ ?>
<option  value="<?php echo $FetchState['Id']; ?>" ><?php echo $FetchState['St_Name']; ?></option><?php 
}?>
</select><?php
}
if($_REQUEST['SearchFilterFieldList']=='City') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select City--</option><?php $SelectState=db_query("Select * From ".TABLE_GENERALAREAMASTER." WHERE Status=1");
while($FetchState=db_fetch_array($SelectState))
{ ?>
<option  value="<?php echo $FetchState['Id']; ?>" ><?php echo $FetchState['Area']; ?></option><?php 
}?>
</select><?php
}
if($_REQUEST['SearchFilterFieldList']=='Area') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown"  <?php if($_REQUEST['action']=='view'){ ?> readonly <?php } ?>>
<option value="" selected="selected">--Select Area--</option><?php $SelectArea=db_query("Select * From ".TABLE_AREAMASTER." WHERE AM_Status=1");
while($FetchArea=db_fetch_array($SelectArea))
{ ?>
<option  value="<?php echo $FetchArea['AM_Id']; ?>" ><?php echo $FetchArea['AM_Area']; ?></option><?php 
}?>
</select><?php
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Pin') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="" class="input"/><?php }exit;
}
$_REQUEST['Action'] = (isset($_REQUEST['Action']) ? $_REQUEST['Action'] : '');
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter')
{
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
if($_REQUEST['action']=='delete')
db_query("delete from ".TABLE_PINCODEMASTER." where PM_Id=".$_REQUEST['id']."");
if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_PINCODEMASTER." SET PM_Status='".$_REQUEST['val']."' where PM_Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 

$all_Sql = "Select DISTINCT a.PM_Id, b.Country_Name, c.St_Name, a.PM_Pincode, a.PM_Status From ".TABLE_PINCODEMASTER." a LEFT JOIN ".TABLE_GENERALCOUNTRYMASTER." b on b.Id = a.PM_Country LEFT JOIN ".TABLE_GENERALSTATEMASTER." c on c.Id = a.PM_State LEFT JOIN ".TABLE_GENERALAREAMASTER." d on d.Id = a.PM_City LEFT JOIN ".TABLE_AREAMASTER." e on e.AM_Id = a.PM_Area";
$orderBy = ' a.PM_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_Country ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='State')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_State ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='City')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_City ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Area')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.PM_Area ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
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
include_once('../../six_col_grid.php');
exit;
}
?>
