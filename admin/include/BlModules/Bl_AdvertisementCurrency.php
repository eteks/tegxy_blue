<?php  ob_start();

$ModuleId = $_REQUEST['ModuleId'];
$_POST['AdvertisementCurrency'] = (isset($_POST['AdvertisementCurrency']) ? $_POST['AdvertisementCurrency'] : '');
$_REQUEST['AdvertisementCurrency'] = (isset($_REQUEST['AdvertisementCurrency']) ? $_REQUEST['AdvertisementCurrency'] : '');
if(($_POST['AdvertisementCurrency'] == 'Submit') || ($_REQUEST['AdvertisementCurrency'] == 'Update'))
{
$Unitcode=$_POST["Currencycode"];
$UnitName=$_POST["CurrencyName"];
$Symbol=$_POST["Symbol"];
$ExistId=$_POST['ExistId']; 
$ActiveStatus=$_POST['ActiveStatus'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select CurrencyName FROM ".TABLE_ADVCURRENCY." WHERE CurrencyName='".$UnitName."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','AdvertisementCurrency','0', '');</script>";
else
{
$AdvertisementCurrency_Query="INSERT INTO ".TABLE_ADVCURRENCY." SET `CurrencyCode`='".$Unitcode."' ,`CurrencyName`='".$UnitName."' ,`Symbol`='".$Symbol."',`Created_On`=NOW() ,`Modified_On`=NOW() ,`Status`='".$ActiveStatus."'";
$AdvertisementCurrency_Insert=db_query($AdvertisementCurrency_Query); 
$optId = mysql_insert_id(); 
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','AdvertisementCurrency','0', '$optId');</script>";
}
}
else
{
$ValidCheck=db_query("Select CurrencyName FROM ".TABLE_ADVCURRENCY." WHERE CurrencyName='".$UnitName."' AND Id<>'".$ExistId."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
{
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('2','".$ModuleId."','AdvertisementCurrency','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}	
else
{
$AdvertisementCurrency_Query="UPDATE ".TABLE_ADVCURRENCY." SET `CurrencyCode`='".$Unitcode."' ,`CurrencyName`='".$UnitName."' ,`Symbol`='".$Symbol."',`Status`='".$ActiveStatus."',`Modified_On`=NOW() Where Id='".$ExistId."'";
$AdvertisementCurrency_Insert=db_query($AdvertisementCurrency_Query);
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','AdvertisementCurrency','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}
}
exit;
} 

if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter')
{
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

if($_REQUEST['action']=='delete')
db_query("delete from ".TABLE_ADVCURRENCY." where Id=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_ADVCURRENCY." SET Status='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
}
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
include_once('../../five_col_grid.php');
}
?>
