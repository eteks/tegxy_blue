<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['SubAreaMater'] = (isset($_POST['SubAreaMater']) ? $_POST['SubAreaMater'] : '');
$_REQUEST['SubAreaMater'] = (isset($_REQUEST['SubAreaMater']) ? $_REQUEST['SubAreaMater'] : '');
if(($_POST['SubAreaMater'] == 'Submit') || ($_REQUEST['SubAreaMater'] == 'Update'))
{
$TxtAreaCode=$_POST["TxtAreaCode"];
$TxtArea	=$_POST["TxtArea"];
$SelCountry =$_POST["SelCountry"];
$SelState	=$_POST["SelState"];
$SelCity	=$_POST["SelCity"];
$ActiveStatus=$_POST['ActiveStatus'];
$ExistId	=$_POST['ExistId']; 
$Status=$_POST['Status'];
$startdata		=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select AM_Area FROM ".TABLE_AREAMASTER." WHERE `AM_Area`='".$TxtArea."' AND `AM_Country`='".$SelCountry."' AND `AM_State`='".$SelState."' AND `AM_City`='".$SelCity."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','AreaMaster','0', '');</script>";
else
{
echo $Head_Query="INSERT INTO ".TABLE_AREAMASTER." SET `AM_Code`='".$TxtAreaCode."' ,`AM_Area`='".$TxtArea."' ,`AM_Country`='".$SelCountry."' ,`AM_State`='".$SelState."',`AM_City`='".$SelCity."', `AM_Status`='".$ActiveStatus."'  ,`AM_CreatedBy`='".$_SESSION['Admin_Id']."',`AM_CreatedOn`=NOW() ,`AM_ModifiedOn`=NOW() ,`AM_ModifiedBy`='".$_SESSION['Admin_Id']."'";
$Head_Insert=db_query($Head_Query); 
$optId = db_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','AreaMaster','0', '$optId');</script>";
}
}
else
{
$Head_Query="UPDATE ".TABLE_AREAMASTER." SET `AM_Code`='".$TxtAreaCode."' ,`AM_Area`='".$TxtArea."' ,`AM_Country`='".$SelCountry."' ,`AM_State`='".$SelState."',`AM_City`='".$SelCity."',`AM_Status`='".$ActiveStatus."'  ,`AM_ModifiedOn`=NOW() Where Id='".$ExistId."'";
$Head_Insert=db_query($Head_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','AreaMaster','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
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
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Area') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="" class="input"/><?php }exit;
}
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
$_REQUEST['Action'] = (isset($_REQUEST['Action']) ? $_REQUEST['Action'] : '');
if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter')
{
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
if($_REQUEST['action']=='delete')
db_query("delete from ".TABLE_AREAMASTER." where AM_Id=".$_REQUEST['id']."");
if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_AREAMASTER." SET AM_Status='".$_REQUEST['val']."' where AM_Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 

$all_Sql = "Select DISTINCT a.AM_Id, b.Country_Name, c.St_Name, a.AM_Area, a.AM_Status From ".TABLE_AREAMASTER." a LEFT JOIN ".TABLE_GENERALCOUNTRYMASTER." b on b.Id = a.AM_Country LEFT JOIN ".TABLE_GENERALSTATEMASTER." c on c.Id = a.AM_State LEFT JOIN ".TABLE_GENERALAREAMASTER." d on d.Id = a.AM_City";
$orderBy = ' a.AM_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.AM_Country ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='State')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.AM_State ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='City')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.AM_City ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Area')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.AM_Area like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Area Master Details';
$colHead  = array("Sl.No.", "Country", "State", "Area", "Status", "Action");
include_once('../../six_col_grid.php');
exit;
}
?>
