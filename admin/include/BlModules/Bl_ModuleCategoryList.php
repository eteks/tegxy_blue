<?php  ob_start(); session_start();
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
db_query("delete from ".TABLE_MODULECATEGORYLIST." where ModuleList_pk=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_MODULECATEGORYLIST." SET ModuleList_Status='".$_REQUEST['val']."' where ModuleList_pk=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} ?>
<?php 
$all_Sql = "Select DISTINCT a.ModuleList_pk, b.ModuleCategory_Name, a.ModuleList_name, a.ModuleList_status From ".TABLE_MODULECATEGORYLIST." a LEFT JOIN ".TABLE_MODULECATEGORY." b on b.ModuleCategory_pk = a.ModuleList_fk";
$orderBy = ' a.ModuleList_pk ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ModuleCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ModuleList_fk ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ModuleCategoryList')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ModuleList_name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Module List Details';
$colHead  = array("Sl.No.", "Module Category Name", "Module Name", "Status", "Action");
include_once('../../five_col_grid.php');
exit;
}

if($_REQUEST['action']=='FilterFieldList')
{ 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
if($_REQUEST['SearchFilterFieldList']=='ModuleCategory') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown" >
<option value="" selected="selected">-- Select --</option>
<?php 
$SelectModule=db_query("Select * From ".TABLE_MODULECATEGORY." WHERE ModuleCategory_Status=1"); 
while($FetchModule=db_fetch_array($SelectModule))
{ ?>
<option value="<?php echo $FetchModule['ModuleCategory_pk'] ?>"><?php echo $FetchModule['ModuleCategory_Name'] ?></option>
<?php } ?>
</select><?php 
}

if($_REQUEST['SearchFilterFieldList']=='ModuleCategoryList') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="" class="input"/><?php }exit;
}

if((trim($_REQUEST['SubModule']) == 'Submit') || (trim($_REQUEST['SubModule']) == 'Update'))
{
$ModuleList_code=addslashes(trim($_POST["ModuleList_code"]));
$ModuleList_name= addslashes(trim($_POST["ModuleList_name"]));
$ModuleList_function=$_POST["ModuleList_function"];
$ModuleList_fk = $_POST['SelModule'];
$ModuleList_image=$_POST['ModuleList_image'];
$ModuleList_status=$_POST['ModuleList_status'];
$ExistId=$_POST['ExistId'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select ModuleList_code FROM ".TABLE_MODULECATEGORYLIST." WHERE ModuleList_code='".$ModuleList_code."' OR ModuleList_name='".$ModuleList_name."' ");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','$ModuleId','ModuleCategoryList', '0', '');</script>";
else
{
$Role_Query="INSERT INTO ".TABLE_MODULECATEGORYLIST." SET `ModuleList_code`='".$ModuleList_code."' ,`ModuleList_name`='".$ModuleList_name."' ,`ModuleList_function`='".addslashes($ModuleList_function)."',`ModuleList_image`='".$ModuleList_image."' ,`ModuleList_fk`='".$ModuleList_fk."' ,`Created_by`='".$_SESSION['Admin_Id']."',`Created_on`=NOW() ,`Modified_by`='".$_SESSION['Admin_Id']."' ,`Modified_on`=NOW() ,`ModuleList_status`='".$ModuleList_status."'";
$Role_Insert=@db_query($Role_Query);
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','$ModuleId','ModuleCategoryList', '0', '$optId');</script>";
exit;
}
}
else
{
$Role_Query="UPDATE ".TABLE_MODULECATEGORYLIST." SET `ModuleList_code`='".$ModuleList_code."' ,`ModuleList_name`='".$ModuleList_name."' ,`ModuleList_function` = '".addslashes($ModuleList_function)."', `ModuleList_image`='".$ModuleList_image."' ,`ModuleList_fk` = '".$ModuleList_fk."', `Modified_on`=NOW(), `Modified_by`='".$_SESSION['Admin_Id']."', `ModuleList_status`='".$ModuleList_status."' Where ModuleList_pk='".$ExistId."'";
$Role_Insert=db_query($Role_Query);
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5', '$ModuleId', 'ModuleCategoryList', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
} exit;
}
?>
