<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['SubArea'] = (isset($_POST['SubArea']) ? $_POST['SubArea'] : '');
$_REQUEST['SubArea'] = (isset($_REQUEST['SubArea']) ? $_REQUEST['SubArea'] : '');
if(($_POST['SubArea'] == 'Submit') || ($_REQUEST['SubArea'] == 'Update'))
{
$TxtAreaCode=$_POST["TxtAreaCode"];
$TxtArea	=$_POST["TxtArea"];
$SelCountry =$_POST["SelCountry"];
$SelState	=$_POST["SelState"];
$ActiveStatus=$_POST['ActiveStatus'];
$ExistId	=$_POST['ExistId']; 
$Status=$_POST['Status'];
$startdata		=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select Area FROM ".TABLE_GENERALAREAMASTER." WHERE `Area`='".$TxtArea."' AND `A_Country`='".$SelCountry."' AND `A_State`='".$SelState."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','GeneralArea','0', '');</script>";
else
{
$Role_Query="INSERT INTO ".TABLE_GENERALAREAMASTER." SET `Area_code`='".$TxtAreaCode."' ,`Area`='".$TxtArea."' ,`A_Country`='".$SelCountry."' ,`A_State`='".$SelState."',`Status`='".$ActiveStatus."'  ,`Created_by`='".$_SESSION['Admin_Id']."',`Created_on`=NOW() ,`Modified_on`=NOW() ,`Modified_by`='".$_SESSION['Admin_Id']."'";
$Role_Insert=db_query($Role_Query); 
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','GeneralArea','0', '$optId');</script>";
}
}
else
{
$Role_Query="UPDATE ".TABLE_GENERALAREAMASTER." SET `Area_code`='".$TxtAreaCode."' ,`Area`='".$TxtArea."' ,`A_Country`='".$SelCountry."' ,`A_State`='".$SelState."',`Modified_on`=NOW() ,`Status`='".$ActiveStatus."' Where Id='".$ExistId."'";
$Role_Insert=db_query($Role_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','GeneralArea','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
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
db_query("delete from ".TABLE_GENERALAREAMASTER." where Id=".$_REQUEST['id']."");
if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_GENERALAREAMASTER." SET Status='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where A_Country ="'.$_REQUEST['SearchFilterField'].'"'	;
} 
if($_REQUEST['SearchFilterFieldList']=='State')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where A_State ="'.$_REQUEST['SearchFilterField'].'"'	;
} 
if($_REQUEST['SearchFilterFieldList']=='City')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where Area like "%'.$_REQUEST['SearchFilterField'].'%"'	;
}
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
include_once('../../six_col_grid.php');
exit;
}
?>
