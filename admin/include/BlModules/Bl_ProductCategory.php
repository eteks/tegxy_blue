<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_POST['ProductCategory'] = (isset($_POST['ProductCategory']) ? $_POST['ProductCategory'] : '');
$_REQUEST['ProductCategory'] = (isset($_REQUEST['ProductCategory']) ? $_REQUEST['ProductCategory'] : '');
if(($_POST['ProductCategory'] == 'Submit') || ($_REQUEST['ProductCategory'] == 'Update'))
{
$TxtProCategoryCode=addslashes($_POST["TxtProCategoryCode"]);
$TxtProCategoryName=addslashes($_POST["TxtProCategoryName"]);
$TxtProCatDesc=addslashes($_POST["TxtProCatDesc"]);
$ExistId=$_POST['ExistId']; 
$ActiveStatus=$_POST['ActiveStatus'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select ProductCat_code FROM ".TABLE_PRODUCTCATEGORY." WHERE  ProductCat_Pk!='".$ExistId."' AND ProductCat_Name='".$TxtProCategoryName."' AND ProductCat_code='".$TxtProCategoryCode."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','".$ModuleId."','ProductCategory','0', '', '');</script>";
else
{
$Role_Query="INSERT INTO ".TABLE_PRODUCTCATEGORY." SET `ProductCat_code`='".$TxtProCategoryCode."',`ProductCat_Name`='".$TxtProCategoryName."' ,`ProductCat_Desc`='".$TxtProCatDesc."' ,`Created_BY`='".$_SESSION['Admin_Id']."',`Created_ON`=NOW(), `Modified_On`=NOW(),`Status`='".$ActiveStatus."'";
$Role_Insert=db_query($Role_Query);
$optId = mysql_insert_id();
echo "<script>var serty=OnclickMenu('1','".$ModuleId."','ProductCategory','0', '$optId');</script>";
}
}
else
{
$Role_Query="UPDATE ".TABLE_PRODUCTCATEGORY." SET `ProductCat_code`='".$TxtProCategoryCode."',`ProductCat_Name`='".$TxtProCategoryName."' ,`ProductCat_Desc`='".$TxtProCatDesc."',`Modified_On`=NOW() ,`Status`='".$ActiveStatus."' WHERE `ProductCat_Pk`='".$ExistId."'";
$Role_Insert=db_query($Role_Query);
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','".$ModuleId."','ProductCategory','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
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
db_query("delete from ".TABLE_PRODUCTCATEGORY." where ProductCat_Pk=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{

$sql="Update ".TABLE_PRODUCTCATEGORY." SET `Status`=".$_REQUEST['val']." where `ProductCat_Pk`='".$_REQUEST['id']."'";
$resultStatus=db_query($sql);
$optId = $_REQUEST['id'];
} 

$all_Sql = "Select DISTINCT a.ProductCat_Pk, a.ProductCat_Code, a.ProductCat_Name, a.Status From ".TABLE_PRODUCTCATEGORY." a";
$orderBy = ' a.ProductCat_Pk ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='Category')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ProductCat_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
else
$WhereCont = ' where 1';
}

$gridHead = 'Product Category Details';
$colHead  = array("Sl.No.", "Product Category Code", "Product Category", "Status", "Action");
include_once('../../five_col_grid.php');
  } ?>
