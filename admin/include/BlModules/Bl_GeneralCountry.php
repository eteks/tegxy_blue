<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['SubCountry'] = (isset($_POST['SubCountry']) ? $_POST['SubCountry'] : '');
$_REQUEST['SubCountry'] = (isset($_REQUEST['SubCountry']) ? $_REQUEST['SubCountry'] : '');
if(($_POST['SubCountry'] == 'Submit') || ($_REQUEST['SubCountry'] == 'Update'))
{
$Country_Code=$_POST["Country_Code"];
$CountryName=$_POST["CountryName"];
$ISOCode=$_POST["ISOCode"];
$Description=$_POST["Description"];
$ActiveStatus=$_POST['ActiveStatus'];
$ExistId=$_POST['ExistId'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];



if($ExistId=='')
{
$ValidCheck=db_query("Select Country_Name FROM ".TABLE_GENERALCOUNTRYMASTER." WHERE Country_Name='".$CountryName."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
{
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','GeneralCountry', '0', '');</script>";
}	
$Country_Query="INSERT INTO ".TABLE_GENERALCOUNTRYMASTER." SET `Country_Code`='".$Country_Code."', `Country_Name`='".$CountryName."', `Country_ISO`='".$ISOCode."', `Description`='".$Description."',  `Created_By`='".$_SESSION['Admin_Id']."', `Created_On`=NOW(), `Modified_On`=NOW(), `Status`='".$ActiveStatus."'";
$Country_Insert=db_query($Country_Query);
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','GeneralCountry', '0', '$optId');</script>";
} else {
$Country_Query="UPDATE ".TABLE_GENERALCOUNTRYMASTER." SET `Country_Code`='".$Country_Code."', `Country_Name`='".$CountryName."' ,`Country_ISO`='".$ISOCode."', `Description`='".$Description."',  `Modified_On`=NOW(), `Status`='".$ActiveStatus."' Where Id='".$ExistId."'";
$Country_Insert=db_query($Country_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','GeneralCountry', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
} exit;
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
db_query("delete from ".TABLE_GENERALCOUNTRYMASTER." where Id=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_GENERALCOUNTRYMASTER." SET Status='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 
$all_Sql = "Select DISTINCT a.Id, a.Country_ISO, a.Country_Name, a.Status From ".TABLE_GENERALCOUNTRYMASTER." a";
$orderBy = ' a.Id ';
if($_REQUEST['SearchFilterFieldList']=='Country')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.Country_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'General Country Master Details';
$colHead  = array("Sl.No.", "Country ISO", "Country Name", "Status", "Action");
include_once('../../five_col_grid.php');
}


?>
