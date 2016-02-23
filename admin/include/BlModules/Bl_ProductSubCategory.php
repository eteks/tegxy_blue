<?php  ob_start();
$ModuleId = $_REQUEST['ModuleId'];
$_REQUEST['action'] = (isset($_REQUEST['action']) ? $_REQUEST['action'] : '');
if($_REQUEST['action']=='FilterFieldList')
{ 
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
if($_REQUEST['SearchFilterFieldList']=='ProCategory') 
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown" >
<option value="" selected="selected">--Select Pro Category--</option><?php $SelectSector=db_query("Select ProductCat_Pk,ProductCat_Name From ".TABLE_PRODUCTCATEGORY." WHERE Status='1'");
while($FetchSector=db_fetch_array($SelectSector))
{ ?>
<option  value="<?php echo $FetchSector['ProductCat_Pk']; ?>" ><?php echo $FetchSector['ProductCat_Name']; ?></option>
<?php 
}?>
</select><?php
}
if($_REQUEST['SearchFilterFieldList']=='ProSubCategory') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="" class="input"/>1<?php }exit;
}
$_POST['ProductSubCategory'] = (isset($_POST['ProductSubCategory']) ? $_POST['ProductSubCategory'] : '');
$_REQUEST['ProductSubCategory'] = (isset($_REQUEST['ProductSubCategory']) ? $_REQUEST['ProductSubCategory'] : '');
if(($_POST['ProductSubCategory'] == 'Submit') || ($_REQUEST['ProductSubCategory'] == 'Update'))
{
$Selpcat=$_POST["Selpcat"];
$TxtSubCatCode=$_POST["TxtSubCatCode"];
$TxtPsubcat=$_POST["TxtPsubcat"];
$TxtDesc=$_POST['TxtDesc'];
$ExistId=$_POST['ExistId']; 
$ActiveStatus=$_POST['ActiveStatus'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select `ProductSubCat_code` FROM ".TABLE_PRODUCTSUBCATEGORY." WHERE `ProductSubCat_code` ='".$TxtSubCatCode."' AND `ProductCat_Fk`='".$TxtSubCatCode."' AND `ProductSubCat_Name`='".$TxtPsubcat."' AND `ProductSubCat_Pk`!='".$ExistId."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','$ModuleId','ProductSubCategory','0','');</script>";
else
{
$ProductSubCat_Query="INSERT INTO ".TABLE_PRODUCTSUBCATEGORY." SET `ProductSubCat_code`='".$TxtSubCatCode."', `ProductCat_Fk`='".$Selpcat."',`ProductSubCat_Name`='".$TxtPsubcat."',`ProductSubCat_Desc`='".$TxtDesc."' ,`Created_BY`='".$_SESSION['Admin_Id']."',`Created_ON`=NOW(),`Modified_On`=NOW() ,`Status`='".$ActiveStatus."'";
$ProductSubCat_Insert=db_query($ProductSubCat_Query); 
$optId = mysql_insert_id(); 
echo "<script>var serty=OnclickMenu('1','$ModuleId','ProductSubCategory','0','$optId');</script>";
}
}
else
{
$ProductSubCat_Query="UPDATE ".TABLE_PRODUCTSUBCATEGORY."  SET `ProductSubCat_code`='".$TxtSubCatCode."', `ProductCat_Fk`='".$Selpcat."' ,`ProductSubCat_Name`='".$TxtPsubcat."',`ProductSubCat_Desc`='".$TxtDesc."' ,`Modified_On`=NOW() ,`Status`='".$ActiveStatus."' Where ProductSubCat_Pk='".$ExistId."'";
$ProductSubCat_Update=db_query($ProductSubCat_Query);
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','$ModuleId','ProductSubCategory','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
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
db_query("DELETE FROM ".TABLE_PRODUCTSUBCATEGORY." where ProductSubCat_Pk=".$_REQUEST['id']."");
if($_REQUEST['action']=='status')
{
db_query("UPDATE ".TABLE_PRODUCTSUBCATEGORY." SET Status='".$_REQUEST['val']."' where ProductSubCat_Pk=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];
} 


$all_Sql = "Select DISTINCT a.ProductSubCat_Pk, b.ProductCat_Name, a.ProductSubCat_Name, a.Status From ".TABLE_PRODUCTSUBCATEGORY." a LEFT JOIN ".TABLE_PRODUCTCATEGORY." b on b.ProductCat_Pk = a.ProductCat_Fk ";
$orderBy = ' a.ProductSubCat_Pk ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' Where a.ProductCat_Fk ="'.$_REQUEST['SearchFilterField'].'"'	;
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProSubCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ProductSubCat_Name like "%'.addslashes(trim($_REQUEST['SearchFilterField'])).'%"';
}
if(isset($whereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';

$gridHead = 'Product Sub Category Details';
$colHead  = array("Sl.No.", "Product Category", "Product Sub Category", "Status", "Action");
include_once('../../five_col_grid.php');
} ?>
