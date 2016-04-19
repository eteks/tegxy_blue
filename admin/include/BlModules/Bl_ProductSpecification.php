<?php  
print_r($_POST);
ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['ProdSpec'] = (isset($_POST['ProdSpec']) ? $_POST['ProdSpec'] : '');
$_REQUEST['ProdSpec'] = (isset($_REQUEST['ProdSpec']) ? $_REQUEST['ProdSpec'] : '');
if(($_POST['ProdSpec'] == 'Submit') || ($_REQUEST['ProdSpec'] == 'Update'))
{
$PDScode=$_POST["PDScode"];
$PDSName=$_POST["PDSName"];
$ExistId=$_POST['ExistId']; 
$ActiveStatus=$_POST['ActiveStatus'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select ProdSpecification FROM ".TABLE_PRODUCTSPECIFICATION." WHERE ProdSpecification='".$PDSName."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','ProductSpecification','0', '');</script>";
else
{
$ProductSpecification_Query="INSERT INTO ".TABLE_PRODUCTSPECIFICATION." SET `ProdSpec_Code`='".$PDScode."' ,`ProdSpecification`='".$PDSName."',`Created_By`='".$_SESSION['Admin_Id']."',`Created_on`=NOW() ,`Modified_on`=NOW(),`ProdStatus`='".$ActiveStatus."'";
$ProductSpecification_Insert=db_query($ProductSpecification_Query); 
$optId=mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','ProductSpecification','0', '$optId');</script>";
}
}
else
{
$ProductSpecification_Query="UPDATE ".TABLE_PRODUCTSPECIFICATION." SET `ProdSpec_Code`='".$PDScode."' ,`ProdSpecification`='".$PDSName."' ,`ProdStatus`='".$ActiveStatus."',`Modified_By`='".$_SESSION['Admin_Id']."', `Modified_on`=NOW() Where ProdSpec_Id='".$ExistId."'";
$ProductSpecification_Insert=db_query($ProductSpecification_Query);
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','ProductSpecification', '$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
}
exit;
} 
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='delete' || $_REQUEST['action']=='status' || $_REQUEST['action']=='Page' || $_REQUEST['Action']=='Filter')
{
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='delete')
db_query("delete from ".TABLE_PRODUCTSPECIFICATION." where ProdSpec_Id=".$_REQUEST['id']."");
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='status')
{
db_query("Update ".TABLE_PRODUCTSPECIFICATION." SET ProdStatus='".$_REQUEST['val']."' where ProdSpec_Id=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
// Begin user side product specification status updation	
$ProductSpecific_Sel=db_query("Select NM_ProSpec from ".TABLE_PRODUCTSPECIFICATION." Where ProdSpec_Id=".$_REQUEST['id']."");	
$ProductSpecific_Fet=db_fetch_array($ProductSpecific_Sel);
db_query("Update ".TABLE_NMPRODUCTSPECIFICATION." SET Status='1' ,ProSpec='".$_REQUEST['id']."' where ProSpec_Id='".$ProductSpecific_Fet['NM_ProSpec']."'");
db_query("Update ".TABLE_PRODUCTSPECIFICATION." SET NM_ProSpec='' ,NM_Product_Fk='' where ProdSpec_Id=".$_REQUEST['id']."");	
// End user side product specification status updation
}
$all_Sql = "Select DISTINCT a.ProdSpec_Id, a.ProdSpec_Code, a.ProdSpecification, a.ProdStatus From ".TABLE_PRODUCTSPECIFICATION." a ";
$orderBy = ' a.ProdSpec_Id ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='PDSName')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' Where a.ProdSpecification like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';

$gridHead = 'Product Specification Details';
$colHead  = array("Sl.No.", "Product Specification Code", "Product Specification", "Status", "Action");
include_once('../../five_col_grid.php');
}
?>