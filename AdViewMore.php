<?php include_once("include/Configuration.php");?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<!--------banner slider------>
</head>
<?php  $HL=6; include("CommonHeader.php");

$RunSql=db_query("SELECT ADV_Name,ADV_Description,ADV_Imagepath,ADV_Userfk FROM ".tbl_advertisement." WHERE  ADV_Userfk ='".$LID."' AND ADV_Id='".$_REQUEST['BDId']."' order by ADV_Id  desc");
list($ADV_Name,$ADV_Description,$ADV_Imagepath,$ADV_Userfk,$ADV_Userfk) = db_fetch_array($RunSql);

// $InnerSql=db_query("SELECT PSG_Id ,PSG_ImgPath FROM ".TABLE_PRODUCTSERVICEGALLERY." WHERE  PSG_UserFk 	='".$LID."' AND PSG_PSFk ='".$_REQUEST['BDId']."' order by  PSG_Id  desc limit 0,2");
// $SpeciSql=db_query("SELECT ProdSpecification,SP_SpecificDetail FROM ".TABLE_PRODUCTSPECIFICATION." a , ".TABLE_SPECIFICATION." b WHERE a.ProdSpec_Id = b.SP_Specification AND SP_UserFk ='".$LID."' AND SP_PsFk ='".$_REQUEST['BDId']."' order by  SP_Id  desc");

// $Location=db_query("SELECT RGT_Country,RGT_State,RGT_City,RGT_Area,RGT_Pincode FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$PS_User_Fk."'");
// list($RGT_Country,$RGT_State,$RGT_City,$RGT_Area,$RGT_Pincode) = db_fetch_array($Location);
// $LocDisplay = CountryName($RGT_Country).StringAppend(StateName($RGT_State),' , ',3,STR_PAD_LEFT).StringAppend(CityName($RGT_City),' , ',3,STR_PAD_LEFT).StringAppend(AreaName($RGT_Area).StringAppend(PincodeName($RGT_Pincode),' - ',3,STR_PAD_LEFT),' , ',3,STR_PAD_LEFT);

?>
<div id="contentwrapper">
<div style="height:30px;text-align: right;margin-right:20px;"><?php if(base64_decode($_REQUEST['type'])!=3) {?><a <?php if($HL==6){?> class="current" <?php }?> onclick="ProfileViewGrid('AdvertisementView.php?user=<?php echo $_REQUEST['user'];?>');" style="text-decoration:none;color:#FC5826;font-size:14px;"><img src="images/back-alt-icon.png" title="Back" style="cursor:pointer;"/></a><?php }?></div>


<div style="width:950px;height:30px;background:#136578;color:#fff;margin-left:auto;margin-right:auto;">
<div style="width:130px;height:20px;float:left;padding-top:5px;font-size:14px;padding-left:10px;">Advertisement</div>
<div style="width:535px;height:20px;float:left;padding-top:5px;font-size:14px;"></div>

</div>

<div style="width:940px;height:10px;margin-left:auto;margin-right:auto;"><p align="right"></p></div>
<!----content area------->
<div style="width:950px;min-height:450px;height:auto;margin-left:auto;margin-right:auto;color:#000;font-size:14px;text-align:justify;margin-top:-15px;float:left;padding:0px 20px;">

<!--------left content---------->
<span style="width:375px;min-height:265px;height:auto;float:left;padding:0px 15px 0px 0px;">
<?php
$FetchImg = db_fetch_array($InnerSql);
$PS_CoverImg = $FetchImg['PSG_ImgPath'];

if($ADV_Imagepath!='')
{?>
<div style="width:370px;height:250px;border:2px solid #D6D6D6;margin-top:20px;">
<a href="<?php echo $ADV_Imagepath;?>" class="jqzoom" rel='gal1'>
<img src="<?php echo $ADV_Imagepath;?>" width="370" height="250">
</a>
</div>
<?php } else {?>
<div style="width:370px;height:250px;border:2px solid #D6D6D6;margin-top:20px;">
<a href="images/noimage-large.png" class="jqzoom" rel='gal1'>
<img src="images/noimage-large.png" width="370" height="250">
</a>
</div>
<?php }?>



<div style="width:370px;height:100px;">

<ul id="thumblist" >
<li><a  href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $ADV_Imagepath;?>',largeimage: '<?php echo $ADV_Imagepath;?>'}"><img src='<?php echo $ADV_Imagepath;?>' width="100" height="70"></a></li>
<?php while(list($ADV_Id,$ADV_Imagepath) = db_fetch_array($InnerSql)){?>
<li><a style="cursor:arrow" href='javascript:void(0);' rel="{gallery: 'gal1', smallimage: '<?php echo $ADV_Imagepath;?>',largeimage: '<?php echo $ADV_Imagepath;?>'}"><img src='<?php echo $ADV_Imagepath;?>' width="100" height="70"></a></li>
        <?php }?>
	</ul>
</div>
</span>
<!--------left content---------->
<!--------right slider---------->
<!--<div style="width:590px;min-height:445px;height:auto;float:left;font-size:13px;">

<div style="width:565px;float:left;padding:0px 5px 0px 20px;">-->
<span style="color:#136578;font-size:16px;font-weight:bold;"><?php echo $ADV_Name;?></span>
<br/>
<!-- <span style="height:auto;">
<table cellpadding="0" cellspacing="0" style="line-height:24px;" >
<tr>
<td style="width:150px;height:auto;" valign="top"><strong>Name</strong></td>
<td style="width:20px;height:auto;font-weight:bold;" valign="top" align="center">:</td>
<td style="width:380px;text-align:justify;" valign="top"><?php echo ProductName($PS_Fk);?></td>
</tr>
</table>
</span> -->

<!-- <span style="height:auto;display:none;"> -->
<!-- <table cellpadding="0" cellspacing="0" style="line-height:24px;" >
<tr>
<td style="width:150px;" valign="top"><strong>Category</strong></td>
<td style="width:20px;font-weight:bold;" valign="top" align="center">:</td>
<td style="width:380px;text-align:justify;" valign="top"><?php echo ProductCategory($PS_CategoryFk).StringLeftArrow(ProductSubCategory($PS_SubCategoryFk),' , ',3).StringLeftArrow(ProductType($PS_TypeFk),' , ',3);?></td>
</tr>
</table>
</span> -->

<!-- <span style="height:auto;">
<table cellpadding="0" cellspacing="0" style="line-height:24px;" >
<tr>
<td style="width:150px;" valign="top"><strong>Business Source</strong></td>
<td style="width:20px;font-weight:bold;" align="center" valign="top">:</td>
<td style="width:380px;text-align:justify;" valign="top"><?php echo $PS_BusinessType ;?></td>
</tr>
</table>
</span>
 -->



<!--<span style="height:10px;"></span>
-->

<span style="width:auto;">
<p><span style="color:#136578;font-size:16px;font-weight:bold;">DESCRIPTION</span></p>
<p style="margin-top:-10px;"><?php echo $ADV_Description;?></p>
</span>


<div style="width:100%;height:10px;float:left;"></div>


<?php /*?><div style="width:565px;height:40px;">
<a href="#" style="border:none;text-decoration:none;color:#000;">
<div style="width:152px;height:39px;float:left;"><img src="images/add-to-favor.png" /></div>
</a>
</div><?php */?>

<!--</div>

</div>-->
<!--------right slider---------->
</div><!----content area------->
<!--------------bdslider-------->
<div style="width:990px;height:auto;float:left;margin-bottom:10px;">
<div style="width:900px;height:auto;margin-left:auto;margin-right:auto;"><?php include("BDSlider.php");?></div>
</div>
<!--------------bdslider-------->

</div>
