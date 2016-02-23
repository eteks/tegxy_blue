<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_REQUEST['SubStat'] = (isset($_REQUEST['SubStat']) ? $_REQUEST['SubStat'] : '');
$_POST['SubStat'] = (isset($_POST['SubStat']) ? $_POST['SubStat'] : '');
if(($_POST['SubStat'] == 'Submit') || ($_REQUEST['SubStat'] == 'Update'))
{
$TxtStateCode=$_POST["TxtStateCode"];
$TxtStateName	=$_POST["TxtStateName"];
$SelCountry =$_POST["SelCountry"];
$ActiveStatus	=$_POST["ActiveStatus"];
$ExistId	=$_POST['ExistId']; 
$Status	=$_POST["Status"];
$startdata		=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select St_Name FROM ".TABLE_GENERALSTATEMASTER." WHERE `St_Name`='".$TxtStateName."' AND `St_Country`='".$SelCountry."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','GeneralState','0','');</script>";
else
{
$Role_Query="INSERT INTO ".TABLE_GENERALSTATEMASTER." SET `St_Code`='".$TxtStateCode."' ,`St_Name`='".$TxtStateName."' ,`St_Country`='".$SelCountry."' ,`Status`='".$ActiveStatus."',`Created_by`='".$_SESSION['Admin_Id']."',`Created_on`=NOW() ,`Modified_on`=NOW() ,`Modified_by`='".$_SESSION['Admin_Id']."'";
$Role_Insert=db_query($Role_Query); 
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','GeneralState','0','$optId');</script>";
}
}
else
{
$Role_Query="UPDATE ".TABLE_GENERALSTATEMASTER." SET `St_Code`='".$TxtStateCode."' ,`St_Name`='".$TxtStateName."' ,`St_Country`='".$SelCountry."' ,`Modified_on`=NOW() ,`Status`='".$ActiveStatus."' Where Id='".$ExistId."'";
$Role_Insert=db_query($Role_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','GeneralState','$startdata','$optId','$SearchFilterFieldList', '$SearchFilterField');</script>";
}
}
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='FilterFieldList')
{ 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
if($_REQUEST['SearchFilterFieldList']=='Country') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown" >
<option value="" selected="selected">--Select Country--</option><?php $SelectCountry=db_query("Select * From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1");
while($FetchCountry=db_fetch_array($SelectCountry))
{ ?>
<option  value="<?php echo $FetchCountry['Id']; ?>" ><?php echo $FetchCountry['Country_Name']; ?></option><?php 
}?>
</select><?php
}
if($_REQUEST['SearchFilterFieldList']=='State') 
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
db_query("delete from ".TABLE_GENERALSTATEMASTER." where Id=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_GENERALSTATEMASTER." SET Status='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
}
$all_Sql = "Select DISTINCT a.Id, b.Country_Name, a.St_Name, a.Status From ".TABLE_GENERALSTATEMASTER." a LEFT JOIN ".TABLE_GENERALCOUNTRYMASTER." b on b.Id = a.St_Country";
$orderBy = ' a.Id ';
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.St_Country ="'.$_REQUEST['SearchFilterField'].'"';
} 
if($_REQUEST['SearchFilterFieldList']=='State')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.St_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'General State Master Details';
$colHead  = array("Sl.No.", "Country", "State Name", "Status", "Action");
include_once('../../five_col_grid.php');
exit;
} ?>
