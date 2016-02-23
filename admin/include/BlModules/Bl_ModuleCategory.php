<?php 
ob_start();

$ModuleId = $_REQUEST['ModuleId'];
 $_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
  $_REQUEST['Action'] = (isset($_REQUEST['Action']) ? $_REQUEST['Action'] : '');
if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter')
{
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'], 'ModuleList', $ModuleId);

if($_REQUEST['action']=='delete')
db_query("delete from ".TABLE_MODULECATEGORY." where ModuleCategory_pk=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_MODULECATEGORY." SET ModuleCategory_Status='".$_REQUEST['val']."' where ModuleCategory_pk=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 
 
$all_Sql = "Select DISTINCT a.ModuleCategory_pk, a.ModuleCategory_Code, a.ModuleCategory_Name, a.ModuleCategory_Status From ".TABLE_MODULECATEGORY." a";
$orderBy = ' a.ModuleCategory_pk ';
if($_REQUEST['SearchFilterFieldList']=='ModuleCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ModuleCategory_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Module Category Details';
$colHead  = array("Sl.No.", "Module Category Code", "Module Category Name", "Status", "Action");
include_once('../../five_col_grid.php');
exit;
}
 $_REQUEST['SubModule'] = (isset($_REQUEST['SubModule']) ? $_REQUEST['SubModule'] : '');
if((trim($_REQUEST['SubModule']) == 'Submit') || (trim($_REQUEST['SubModule']) == 'Update'))
{
$ModuleCategory_Code=$_POST["ModuleCategory_Code"];
$ModuleCategory_Name=$_POST["ModuleCategory_Name"];
$ModuleCategory_Function=addslashes($_POST["ModuleCategory_Function"]);
$ModuleCategory_Status=$_POST['ModuleCategory_Status'];
$ExistId=$_POST['ExistId']; 
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select ModuleCategory_Code FROM ".TABLE_MODULECATEGORY." WHERE ModuleCategory_Name='".$ModuleCategory_Name."' ");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','$ModuleId','ModuleCategory', '0', '');</script>";
else
{
$Role_Query="INSERT INTO ".TABLE_MODULECATEGORY." SET `ModuleCategory_Code`='".$ModuleCategory_Code."' ,`ModuleCategory_Name`='".$ModuleCategory_Name."' ,`ModuleCategory_Function`='".$ModuleCategory_Function."' ,`Created_by`='".$_SESSION['Admin_Id']."',`Created_on`=NOW() ,`Modified_by`='".$_SESSION['Admin_Id']."' ,`Modified_on`=NOW() ,`ModuleCategory_Status`='".$ModuleCategory_Status."'";
$Role_Insert=@db_query($Role_Query);
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','$ModuleId','ModuleCategory', '0', '$optId');</script>";
exit;
}
}
else
{
$ValidCheck=db_query("Select ModuleCategory_Code FROM ".TABLE_MODULECATEGORY." WHERE ModuleCategory_Name='".$ModuleCategory_Name."' AND ModuleCategory_pk<>'".$ExistId."' ");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
{
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('2', '$ModuleId', 'ModuleCategory', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}
else
{
$Role_Query="UPDATE ".TABLE_MODULECATEGORY." SET `ModuleCategory_Code`='".$ModuleCategory_Code."' ,`ModuleCategory_Name`='".$ModuleCategory_Name."' ,`ModuleCategory_Function` = '".$ModuleCategory_Function."', `Modified_on`=NOW(), `Modified_by`='".$_SESSION['Admin_Id']."', `ModuleCategory_Status`='".$ModuleCategory_Status."' Where ModuleCategory_pk='".$ExistId."'";
$Role_Insert=db_query($Role_Query);
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5', '$ModuleId', 'ModuleCategory', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}
} exit;
}
?>
