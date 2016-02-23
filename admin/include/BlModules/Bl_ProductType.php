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
{ ?><select id="SearchFilterField" name="SearchFilterField" class="dropdown" >
<option value="" selected="selected">--Select Pro Sub Category--</option><?php $SelectSector=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1'");
while($FetchSector=db_fetch_array($SelectSector))
{ ?>
<option  value="<?php echo $FetchSector['ProductSubCat_Pk']; ?>" ><?php echo $FetchSector['ProductSubCat_Name']; ?></option>
<?php 
}?>
</select><?php
}
if($_REQUEST['SearchFilterFieldList']=='ProType') 
{ ?><input type="text" name="SearchFilterField" id="SearchFilterField" value="" class="input"/><?php }exit;
}
$_POST['ProductType'] = (isset($_POST['ProductType']) ? $_POST['ProductType'] : '');
$_REQUEST['ProductType'] = (isset($_REQUEST['ProductType']) ? $_REQUEST['ProductType'] : '');
if(($_POST['ProductType'] == 'Submit') || ($_REQUEST['ProductType'] == 'Update'))
{
$Selpcat=$_POST["Selpcat"];
$CboSubCatName=$_POST["CboSubCatName"];
$TxtProdtypeName=$_POST["TxtProdtypeName"];
$TxtPtypeCode=$_POST["TxtPtypeCode"];
$TxtDesc=$_POST['TxtDesc'];
$ExistId=$_POST['ExistId']; 
$ActiveStatus=$_POST['ActiveStatus'];
$startdata=$_POST['startdata'];
$SearchFilterFieldList=$_POST['hidSearchFilterFieldList'];
$SearchFilterField=$_POST['hidSearchFilterField'];

if($ExistId=='')
{
$ValidCheck=db_query("Select ProductType_code,ProductType_Name FROM ".TABLE_PRODUCTTYPE." WHERE ProductType_Pk='".$ExistId."' AND ProductType_Name='".$TxtProdtypeName."' AND ProductType_code='".$TxtPtypeCode."'");
$CountValid=db_num_rows($ValidCheck);
if($CountValid!=0)
echo "<script>var serty=OnclickMenu('2','$ModuleId','ProductType','0','');</script>";
else
{
$ProductType_Query="INSERT INTO ".TABLE_PRODUCTTYPE." SET `ProductCat_Fk`='".$Selpcat."',`ProductSubCat_Fk`='".$CboSubCatName."',`ProductType_code`='".$TxtPtypeCode."',`ProductType_Name`='".$TxtProdtypeName."',`ProductType_Desc`='".$TxtDesc."',`Created_BY`='".$_SESSION['Admin_Id']."',`Created_ON`=NOW(),`Modified_On`=NOW(),`Status`='".$ActiveStatus."'";
$ProductType_Insert=db_query($ProductType_Query); 
$optId = mysql_insert_id(); 
echo "<script>var serty=OnclickMenu('1','$ModuleId','ProductType','0','$optId');</script>";
}
}
else
{
$ProductType_Query="UPDATE ".TABLE_PRODUCTTYPE." SET `ProductCat_Fk`='".$Selpcat."',`ProductSubCat_Fk`='".$CboSubCatName."',`ProductType_code`='".$TxtPtypeCode."',`ProductType_Name`='".$TxtProdtypeName."',`ProductType_Desc`='".$TxtDesc."',`Modified_On`=NOW(),`Status`='".$ActiveStatus."' Where ProductType_Pk='".$ExistId."'";
$ProductType_Update=db_query($ProductType_Query); 
$optId = $ExistId;
echo "<script>var serty=OnclickMenu_Edit('5','$ModuleId','ProductType','$startdata', '$optId', '$SearchFilterFieldList', '$SearchFilterField');</script>";
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
db_query("DELETE FROM ".TABLE_PRODUCTTYPE." where ProductType_Pk=".$_REQUEST['id']."");

if($_REQUEST['action']=='status')
{
db_query("UPDATE ".TABLE_PRODUCTTYPE." SET Status='".$_REQUEST['val']."' where ProductType_Pk=".$_REQUEST['id']."");
$optId = $_REQUEST['id'];

} 
$all_Sql = "Select DISTINCT a.ProductType_Pk, b.ProductCat_Name, a.ProductType_Name, a.Status From ".TABLE_PRODUCTTYPE." a LEFT JOIN ".TABLE_PRODUCTCATEGORY." b on b.ProductCat_Pk = a.ProductCat_Fk ";
$orderBy = ' a.ProductType_Pk ';
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' Where a.ProductCat_Fk ="'.$_REQUEST['SearchFilterField'].'"';
}	
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProSubCategory')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ProductSubCat_Fk  ="'.$_REQUEST['SearchFilterField'].'"';
}
$_REQUEST['SearchFilterFieldList'] = (isset($_REQUEST['SearchFilterFieldList']) ? $_REQUEST['SearchFilterFieldList'] : '');
if($_REQUEST['SearchFilterFieldList']=='ProType')
{
if($_REQUEST['SearchFilterField']!='')
$WhereCont = ' where a.ProductType_Name like "%'.trim(addslashes($_REQUEST['SearchFilterField'])).'%"'	;
}
if(isset($WhereCont) && !empty($WhereCont))
if($WhereCont=='')
$WhereCont = ' where 1';
$gridHead = 'Product Type Details';
$colHead  = array("Sl.No.", "Product Category", "Product Type", "Status", "Action");
include_once('../../five_col_grid.php');

 } 

if($_REQUEST["Pcatid"]!="") {  // sub product search
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
?>
<select id="<?php if ($_REQUEST['search']== 'search') { echo 'SearchFilterFieldCombo2'; } else { echo 'CboSubCatName'; } ?>" name="<?php if ($_REQUEST['search']== 'search') { echo 'SearchFilterFieldCombo2'; } else { echo 'CboSubCatName'; } ?>" class="dropdown" <?php if($_REQUEST['action']=='view') { ?> disabled <?php } ?>>
<option value="" selected="selected">--Select Sub Product Category--</option>
<?php 
$SelectSubCategory=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1' AND ProductCat_Fk='".$_REQUEST["Pcatid"]."'"); 
while($FetchCat=db_fetch_array($SelectSubCategory))
{ ?>
<option  value="<?php echo $FetchCat['ProductSubCat_Pk']; ?>" <?php if($FetchCat['ProductSubCat_Pk']==$Fetch['SubCategory_fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ProductSubCat_Name']; ?></option>
<?php 
}?>
</select>

<?php  exit;
}

?>
