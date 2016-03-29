<script>
function view_product(pro,com_city,comp_area,req_type)
{ 
//alert(pro);
//alert(com_city);
//alert(comp_area);
//alert(req_type);
//
//var searchKery1 = pro;
//alert(searchKey1);
//var userCity = com_city;
//alert(userCity);
//var userArea = comp_area;
//alert(userArea);
//var requestType = req_type;
//alert(requestType);
//alert(searchKey);
//
//var userCity = document.getElementById('comp_city').value;
////alert(userCity);
//var userArea = document.getElementById('comp_area').value;
////alert(userArea);
//var requestType = document.getElementById('requestType').value;
////alert(requestType);

window.open("Searchpage.php?action=Add&searchkey="+pro+"&requesttype="+req_type+"&usercity="+com_city+"&userarea="+comp_area+"&type2=1");

//window.location.href="Searchpage.php?action=Add&searchkey="+searchKery+"";

}

</script>
<div class="adright_container">
<script type="text/javascript" src="js/Searchlist.js"></script>
<script type="text/javascript" src="adver/jquery.min.js"></script>
<script type="text/javascript" src="js/View.js" ></script>
    <link rel="stylesheet" href="adver/style.css" type="text/css" media="screen" />
    <script src="adver/jcarousellite_1.0.1c4.js" type="text/javascript"></script>
        <script type="text/javascript">
            $(function () {
                $(".newsticker-jcarousellite").jCarouselLite({
                    vertical: true,
                    hoverPause: true,
                    visible: 4,
                    auto: 5000,
                    speed: 300
                });
            });
</script>




<div class="newsticker-jcarousellite" style="width:300px; height:500px;">
<ul>

<?php
$selectadquery = db_query("SELECT ADV_Id,ADV_Existornew,ADV_Selection,ADV_Name,ADV_Imagepath,ADV_Description,ADV_Selectionfk FROM ".TABLE_ADVERTISEMENT." where ADV_Status=1");
while(list($adv_id,$adv_existornew,$adv_selection,$adv_name,$adv_imagepath,$adv_description,$adv_selectionfk) = db_fetch_array($selectadquery))
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


<li>
<div style="cursor:pointer;">
<div class="right_singlead">
<div class="right_adtitle"><?php echo $adv_title ;?></div>
<div style="width:290px;min-height:107px;">
<div style="width:290px;min-height:107px;">
<div class="right_adimg">

<?php if($adv_imagepath !="") { ?>
<!-- <img width="107" height="107" src="<?php echo $adv_imagepath;?>" style="border:solid 1px #999;"  onclick="view_product('<?php echo $adv_title; ?>','<?php echo getCitydetails($comp_city);?>','<?php echo getAreadetails($comp_area); ?>','<?php echo "bestdeals"; ?>');"/> -->
<img width="107" height="107" onclick="ProfileViewGrid('AdViewMore.php?user=10&BDId=<?php echo $adv_id;?>');" src="<?php echo $adv_imagepath;?>" style="border:solid 1px #999;"/>
<?php } else { ?>

<img width="107" height="107" src="images/no_image.png" onclick="view_product('<?php echo $adv_title; ?>','<?php echo getCitydetails($comp_city);?>','<?php echo getAreadetails($comp_area); ?>','<?php echo "bestdeals"; ?>');"/>


<?php } ?>
</div>
<div class="right_addesp" onclick="view_product('<?php echo $adv_title; ?>','<?php echo getCitydetails($comp_city);?>','<?php echo getAreadetails($comp_area); ?>','<?php echo "bestdeals"; ?>');">

<span style="font-weight:bold;"><?php echo $adv_title ;?></span>
<br />

<?php 
$count=strlen($adv_description);
$displaydata=(substr($adv_description,0,80));
if($count>80){ 

 echo $displaydata.= '<a href="#"  style="font-weight:bold; color:#F90;text-decoration:none;" ><span> <br>View More.. </span></a>'; 
 
}
else {  echo $displaydata; }
?>

</div>
</li>

<?php } ?>

</ul></div>

   
    </div>





