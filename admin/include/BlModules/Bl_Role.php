<?php 
ob_start();
$_REQUEST['ModuleId'] = (isset($_REQUEST['ModuleId']) ? $_REQUEST['ModuleId'] : '');
$ModuleId = $_REQUEST['ModuleId'];
$_REQUEST['Role'] = (isset($_REQUEST['Role']) ? $_REQUEST['Role'] : '');
if(($_REQUEST['Role'] == 'Submit') || ($_REQUEST['Role'] == 'Update'))
{
$RoleCode=$_REQUEST["RoleCode"];
$RoleName=$_REQUEST["RoleName"];
$ISOCode=$_REQUEST["ISOCode"];
$Description=$_REQUEST["Description"];
$ActiveStatus=$_REQUEST['ActiveStatus'];
$ExistId=$_REQUEST['ExistId'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select Role_Name FROM ".TABLE_ROLE." WHERE Role_Name='".$RoleName."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','Role', '0', '');</script>";
else
{
$Role_Query="INSERT INTO ".TABLE_ROLE." SET `Role_Code`='".$RoleCode."', `Role_Name`='".$RoleName."' ,`Description`='".$Description."' ,`Created_BY`='".$_SESSION['Admin_Id']."',`Created_ON`=NOW() ,`Modified_On`=NOW() ,`Status`='".$ActiveStatus."'";
$Role_Insert=db_query($Role_Query); 
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','Role', '0', '$optId');</script>";
}
}
else
{
$Role_Query="UPDATE ".TABLE_ROLE." SET `Role_Code`='".$RoleCode."', `Role_Name`='".$RoleName."' ,`Description`='".$Description."',`Modified_On`=NOW() ,`Status`='".$ActiveStatus."' Where Id='".$ExistId."'";
$Role_Insert=db_query($Role_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','Role', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}
exit;
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
db_query("delete from ".TABLE_ROLE." where Id=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_ROLE." SET Status='".$_REQUEST['val']."' where Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 

$all_Sql = "Select DISTINCT a.Id, a.Role_Code, a.Role_Name, a.Status From ".TABLE_ROLE." a ";
$orderBy = ' a.Id ';
if($_REQUEST['SearchFilterFieldList']=='RoleName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.Role_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Admin Role Details';
$colHead  = array("Sl.No.", "Role Code", "Role Name", "Status", "Action");
include_once('../../five_col_grid.php');
}
?>
