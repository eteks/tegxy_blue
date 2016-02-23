<div class="adright_container">
<?php 
$selectadquery = db_query("SELECT ADV_Existornew,ADV_Selection,ADV_Name,ADV_Imagepath,ADV_Description,ADV_Selectionfk FROM ".TABLE_ADVERTISEMENT."");
while(list($adv_existornew,$adv_selection,$adv_name,$adv_imagepath,$adv_description,$adv_selectionfk) = db_fetch_array($selectadquery))
{
$adv_title       = $adv_name;
	
if($adv_existornew==2)
{
$adv_imagepath   = $adv_imagepath;
$adv_description = $adv_description;
}
else 
{
if($adv_selection==1)
{	
$selectadquery1 = db_query("SELECT PS_CoverImg,PS_Description FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Id='".$adv_selectionfk."'");
list($ps_coverImg,$ps_description) = db_fetch_array($selectadquery1);
$adv_imagepath   = $ps_coverImg;
$adv_description = $ps_description;
}
else if($adv_selection==2)
{
$selectadquery2 = db_query("SELECT ET_Image,ET_Desp FROM ".TABLE_EVENTS." WHERE ET_Id='".$adv_selectionfk."'");
list($et_image,$et_desp) = db_fetch_array($selectadquery2);
$adv_imagepath   = $et_image;
$adv_description = $et_desp;
}
else
{
$selectadquery3 = db_query("SELECT GY_Image,GY_Desp FROM ".TABLE_GALLERY." WHERE GY_Id='".$adv_selectionfk."'");
list($gy_image,$gy_desp) = db_fetch_array($selectadquery3);
$adv_imagepath   = $gy_image;
$adv_description = $gy_desp;
	
}
}
?>
<div class="right_singlead">
<div class="right_adtitle"><?php echo $adv_title ;?></div>
<div style="width:290px;min-height:107px;">
<div class="right_adimg"><img width="107" height="107" src="<?php echo $adv_imagepath;?>" /></div>
<div class="right_addesp"><?php echo $adv_description; ?></div>
</div>
</div>
<?php }?>
</div>