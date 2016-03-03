<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$CatId = $_REQUEST['CatId'];
$SubId = $_REQUEST['SubId'];
$TypeId = $_REQUEST['TypeId'];
$Action = $_REQUEST['action'];

if($Action=='Product')
{
if(isset($_REQUEST["Pcatid"])) {  // sub product search
?>
<select id="<?php echo $SubId;?>" name="<?php echo $SubId;?>" size="12"  onchange="return OnclickSubCategory('<?php echo $CatId;?>',this.value,'<?php echo $SubId;?>','<?php echo $TypeId;?>','Bl_GeneralProductFilter');"  >
<?php 
$SelectSubCategory=db_query("Select ProductSubCat_Pk,ProductSubCat_Name From ".TABLE_PRODUCTSUBCATEGORY." WHERE Status='1' AND ProductCat_Fk='".$_REQUEST["Pcatid"]."'"); 
while($FetchCat=db_fetch_array($SelectSubCategory))
{ ?>
<option value="<?php if(isset($FetchCat) && !empty($FetchCat)) echo $FetchCat['ProductSubCat_Pk']; ?>" <?php if(isset($FetchCat) && !empty($FetchCat)) if($FetchCat['ProductSubCat_Pk']==$Fetch['SubCategory_fk']){ ?> selected <?php }?> ><?php if(isset($FetchCat) && !empty($FetchCat)) echo $FetchCat['ProductSubCat_Name']; ?></option>
<?php 
}?>
</select><?php echo '######'.ProductCategory($_REQUEST["Pcatid"]).'######'.$SubId.'######'.$_REQUEST["Pcatid"];
} 
if(isset($_REQUEST["PSubcatid"])) { // product type search
?>
<select id="<?php echo $TypeId;?>" name="<?php echo $TypeId;?>" size="12" onchange="OnclickProductType('<?php echo $CatId;?>','<?php echo $SubId;?>',this.value,'<?php echo $TypeId;?>','Bl_GeneralProductFilter');">
<?php 
$SelectProductType=db_query("Select ProductType_Pk,ProductType_Name From ".TABLE_PRODUCTTYPE." WHERE Status='1' AND ProductCat_Fk='".$_REQUEST["pid"]."' AND ProductSubCat_Fk='".$_REQUEST["PSubcatid"]."'"); 
while($FetchCat=db_fetch_array($SelectProductType))
{ ?>
<option  value="<?php if(isset($FetchCat) && !empty($FetchCat)) echo $FetchCat['ProductType_Pk']; ?>" <?php if(isset($FetchCat) && !empty($FetchCat)) if($FetchCat['ProductType_Pk']==$Fetch['ProductType_fk']){ ?> selected <?php }?> ><?php if(isset($FetchCat) && !empty($FetchCat)) echo $FetchCat['ProductType_Name']; ?></option>
<?php 
}?>
</select><?php echo '######'.ProductCategory($_REQUEST["pid"]).StringLeftArrow(ProductSubCategory($_REQUEST["PSubcatid"]),' >> ',4).'######'.$TypeId.'######'.$_REQUEST["pid"].StringLeftArrow($_REQUEST["PSubcatid"],' >> ',4);
}
if(isset($_REQUEST["PType"])) { // product type search
echo '######'.ProductCategory($_REQUEST["pid"]).StringLeftArrow(ProductSubCategory($_REQUEST["PSubCateId"]),' >> ',4).StringLeftArrow(ProductType($_REQUEST["PType"]),' >> ',4).'######'.$TypeId.'######'.$_REQUEST["pid"].StringLeftArrow($_REQUEST["PSubCateId"],' >> ',4).StringLeftArrow($_REQUEST["PType"],' >> ',4);
}
}