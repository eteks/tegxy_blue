<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_REQUEST['SubmitAdminUser'] = (isset($_REQUEST['SubmitAdminUser']) ? $_REQUEST['SubmitAdminUser'] : '');
if(($_REQUEST['SubmitAdminUser'] == 'Submit') || ($_REQUEST['SubmitAdminUser'] == 'Update'))
{	
$AdminUserCode=addslashes($_REQUEST["AdminUserCode"]); 
$AdminUserName=addslashes($_REQUEST["AdminUserName"]);
$AdminRole=addslashes($_REQUEST["AdminRole"]);
$AdminUserEmail=addslashes($_REQUEST["AdminUserEmail"]);
$AdminUserPhone=addslashes($_REQUEST["AdminUserPhone"]);
$ExistId=addslashes($_REQUEST["ExistId"]);

$AdminUserStatus=addslashes($_REQUEST["AdminUserStatus"]);
$AdminUserLogin=addslashes($_REQUEST["AdminUserLogin"]);
$AdminUserPassword=addslashes($_REQUEST["AdminUserPassword"]);
$SubmitAdminUser=$_REQUEST["SubmitAdminUser"];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select Admin_Id FROM ".TABLE_ADMINUSER." WHERE AdminUser_LoginId='".$AdminUserLogin."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid>0)
{
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','AdminUser', '0', '');</script>";
}	
else
{
$InsertAdminUser="INSERT INTO ".TABLE_ADMINUSER." SET `AdminUser_Code`='".$AdminUserCode."' ,`AdminUser_Name`='".$AdminUserName."' ,`AdminUser_Role`='".$AdminRole."',`AdminUser_Phone`='".$AdminUserPhone."',`AdminUser_Email`='".$AdminUserEmail."',`AdminUser_LoginId`='".$AdminUserLogin."' ,`AdminUser_Password`='".$AdminUserPassword."' ,`Created_By`='".$_SESSION['Admin_Id']."',`Created_on`=NOW() ,`Modified_on`=NOW() ,`AdminUser_Status`='".$AdminUserStatus."'";
$InsertAdminUser_Qry=db_query($InsertAdminUser);
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','AdminUser', '0', '$optId');</script>";
}
}
else
{
$UpdateAdminUser="UPDATE ".TABLE_ADMINUSER." SET `AdminUser_Code`='".$AdminUserCode."' ,`AdminUser_Name`='".$AdminUserName."' ,`AdminUser_Role`='".$AdminRole."',`AdminUser_Phone`='".$AdminUserPhone."',`AdminUser_Email`='".$AdminUserEmail."',`AdminUser_LoginId`='".$AdminUserLogin."' , `AdminUser_Password`='".$AdminUserPassword."', `Modified_By`='".$_SESSION['Admin_Id']."', `Modified_on`=NOW(), `AdminUser_Status`='".$AdminUserStatus."' where Admin_Id='".$ExistId."'";
$UpdateAdminUser_Qry=db_query($UpdateAdminUser); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','AdminUser', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
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
if($_REQUEST['action']=='delete' )
{
db_query("delete from ".TABLE_ADMINUSER." where Admin_Id=".$_REQUEST['id']."");
}

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_ADMINUSER." SET AdminUser_Status='".$_REQUEST['val']."' where Admin_Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
}
?>
<?php
$all_Sql = "Select DISTINCT a.Admin_Id, a.AdminUser_Name, b.Role_Name, a.AdminUser_Status From ".TABLE_ADMINUSER." a LEFT JOIN ".TABLE_ROLE." b ON a.AdminUser_Role=b.Id ";
$orderBy = ' a.Admin_Id ';
if($_REQUEST['SearchFilterFieldList']=='UserName')
{
if($_REQUEST['SearchFilterField']!='')
{
$WhereCont = ' where a.AdminUser_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
{
$WhereCont = ' where 1';
}
$gridHead = 'Admin User Details';
$colHead  = array("Sl.No.", "User Name", "User Role", "Status", "Action");
include_once('../../five_col_grid.php');
?>
<?php	
}
?>
