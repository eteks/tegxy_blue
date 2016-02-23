<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$CatId = $_REQUEST['CatId'];
$SubId = $_REQUEST['SubId'];
$TypeId = $_REQUEST['TypeId'];
$Action = $_REQUEST['action'];

if($Action=='Service')
{
if(isset($_REQUEST["Pcatid"])) {  // sub product search
?>
<select id="<?php echo $SubId;?>" name="<?php echo $SubId;?>" size="12"  onchange="return SOnclickSubCategory('<?php echo $CatId;?>',this.value,'<?php echo $SubId;?>','<?php echo $TypeId;?>','Bl_GeneralServiceFilter');"  >
<?php 
$SelectSubCategory=db_query("Select ServiceSubCat_Pk,ServiceSubCat_Name From ".TABLE_SERVICESUBCATEGORY." WHERE Status='1' AND ServiceCat_Fk='".$_REQUEST["Pcatid"]."'"); 
while($FetchCat=db_fetch_array($SelectSubCategory))
{ ?>
<option  value="<?php echo $FetchCat['ServiceSubCat_Pk']; ?>" <?php if($FetchCat['ServiceSubCat_Pk']==$Fetch['SubCategory_fk']){ ?> selected <?php }?> ><?php echo $FetchCat['ServiceSubCat_Name']; ?></option>
<?php 
}?>
</select><?php echo '######'.ServiceCategory($_REQUEST["Pcatid"]).'######'.$SubId.'######'.$_REQUEST["Pcatid"];
} 

if(isset($_REQUEST["PSubcatid"])) { // product type search
echo '######'.ServiceCategory($_REQUEST["pid"]).StringLeftArrow(ServiceSubCategory($_REQUEST["PSubCateId"]),' >> ',4).'######'.$TypeId.'######'.$_REQUEST["pid"].StringLeftArrow($_REQUEST["PSubCateId"],' >> ',4);
}
}