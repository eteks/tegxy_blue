<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$HL=6;
include("CommonHeader.php");?>
<div id="contentwrapper">
<?php  
include("ProfileLeft.php");?>
<div id="contentcolumn">
<div class="innertube">
<center><h2 style="position:relative;color:#E76524;font-weight:bold;text-align:center;padding:5px 0px;">Advertisement</h2></center>

<?php if($EnableCount>0){?>
<!-- <div style="width:85%;height:40px;margin-right:auto;">
<span>
<input type="hidden" id="LogIdd" name="LogIdd" value="<?php echo $LID;?>" />
<input type="hidden" id="BDType" name="BDType" value="1" />
<input type="hidden" id="BCategory" name="BCategory"  />
<input type="hidden" id="BSubCategory" name="BSubCategory" />
<input type="hidden" id="BDStartData" name="BDStartData" value="0" />

<input type="text" id="SearchArea" name="SearchArea" style="width:350px;height:20px;border:1px solid #D9D9D9;background:#f3f3f3;" /></span>&nbsp;<span><input type="button" value="" style="width:107px;height:37px;border:none;background:transparent url(images/reset_button.png);color:#136578;font-weight:bold;cursor:pointer;float:right;margin-top:-6px;" onmouseover="javascript: this.style.backgroundImage='url(images/reset_button_hover.png)';" onmouseout="javascript: this.style.backgroundImage='url(images/reset_button.png)';" onclick="BestDealsReset();" />&nbsp;&nbsp;<input type="button" value=""  onclick="BestDealsSearch();" style="width:107px;height:37px;border:none;background:transparent url(images/search_button.png);color:#136578;font-weight:bold;cursor:pointer;float:right;margin-top:-6px;" onmouseover="javascript: this.style.backgroundImage='url(images/search_button_hover.png)';" onmouseout="javascript: this.style.backgroundImage='url(images/search_button.png)';" /></span>
</div> -->

<div style="width:650px;height:auto;min-height:550px;" id="Bestdealslist">

<div style="width:98%;height:40px;margin-left:auto;margin-right:auto;font-weight:bold;font-size:14px;color:#EB8A18;">
<span><a id="BestdealList"  style="text-decoration:none;color:#087287;cursor:pointer;" onclick="BestDealsView('1');">List</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span><a id="BestdealGrid" style="text-decoration:none;color:#EB8A18;cursor:pointer;" onclick="BestDealsView('2');">Gallery</a></span>
</div>

<div style="width:98%;height:7px;margin-left:auto;margin-right:auto;background:url(images/seprater_shadow.png) no-repeat left;">
</div>


<table cellpadding="0" cellspacing="0" border="0">
<?php
$Overallsql = "SELECT ADV_Id ,ADV_Userfk ,ADV_Name,ADV_Description ,ADV_Imagepath FROM ".tbl_advertisement." WHERE ADV_Userfk 	='".$LID."' order by ADV_Id";
$Overallcount = db_num_rows(db_query($Overallsql));
$sqltot=$Overallsql."  desc LIMIT 8";
$SqlRun=db_query($sqltot);
/*$sqltot="SELECT PS_Id ,PS_Fk ,PS_Description ,PS_CoverImg,PS_Display FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_User_Fk 	='".$LID."' order by  PS_Id  desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
$noofpages=$totalrecord/$pagesize;
$startdata=0;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");*/
$Count = db_num_rows($SqlRun);
if($Count>0){
$Pid=0;
$LocDisplay =' ---- ';
while(list($ADV_Id ,$ADV_Userfk ,$ADV_Name,$ADV_Description ,$ADV_Imagepath) = db_fetch_array($SqlRun)){
$msg_id=$ADV_Id;
$Location=db_query("SELECT RGT_Country,RGT_State,RGT_City,RGT_Area,RGT_Pincode FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$PS_User_Fk."'");
list($RGT_Country,$RGT_State,$RGT_City,$RGT_Area,$RGT_Pincode) = db_fetch_array($Location);
$LocDisplay = CountryName($RGT_Country).StringAppend(StateName($RGT_State),' , ',3,STR_PAD_LEFT).StringAppend(CityName($RGT_City),' , ',3,STR_PAD_LEFT).StringAppend(AreaName($RGT_Area).StringAppend(PincodeName($RGT_Pincode),' - ',3,STR_PAD_LEFT),' , ',3,STR_PAD_LEFT);
?>
<tr>
<td style="width: 125px; height: 145px; float: left; background: url(&quot;images/no_images.png&quot;) no-repeat scroll 0px 0px transparent;">
<div style="width:100px;height:122px;margin:5px 0px 0px 5px;">
<img src="<?php echo $ADV_Imagepath;?>" width="103" height="120px" />
</div></td>
<td valign="top">
<table>
<tr><td style="font-weight:bold;color:#E76524;height:25px;font-size:14px;"><?php if(strlen(stripslashes($ADV_Name))>15){ echo substr(stripslashes($ADV_Name),0,20).'...' ;} else { echo stripslashes($ADV_Name);} ?></td></tr>
<tr><td><?php echo ProductName($PS_Fk);?></td></tr>
<?php /*?><tr><td><b>Location :</b> <?php echo $LocDisplay;?></td></tr><?php */?>
<tr>
<td>
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <?php if($PS_Price!='' && $PS_Price!='0' ){?>
    <td><b>Price :</b></td>
    <td>&nbsp;</td>
    <td><?php echo $PS_Price.'&nbsp;'.CurrencyName($PS_Currency);?></td>
    <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
    <?php } if($PS_Unit!=''){?>
    <td><b>Quantity :</b></td>
    <td>&nbsp;</td>
<td><?php echo $PS_Unit;?></td><?php }?></tr>
</table>



</td>
</tr>
<tr><td><b>Description</b></td></tr>
<tr><td><?php if(strlen(stripslashes($ADV_Description))>45){ echo substr(stripslashes($ADV_Description),0,90).'...' ;} else { echo stripslashes($ADV_Description);} ?></td></tr>
<tr><td align="right" width="650px"><input type="button" 
onclick="ProfileViewGrid('AdViewMore.php?user=<?php echo $_REQUEST['user'];?>&BDId=<?php echo $ADV_Id;?>');"  style="width:80px;height:24px;background:transparent url(images/know-morw.png) no-repeat;border:none;cursor:pointer;" /></td></tr>
</table>
</td>
</tr>
<?php $Pid++; }};?>
</table>
<?php /*if($Count>0){?>
<table cellpadding="0" cellspacing="0" border="0" align="right">
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'BDViewPage'); ?></td></tr>
</table>
<?php }*/if($Overallcount>8){?>
<div onclick="ViewMoree('more<?php echo $msg_id; ?>','<?php echo $msg_id; ?>','Bestdealslist','Bl_BestDealsView','pass')" id="more<?php echo $msg_id; ?>" class="viewmoree">
View More
</div><div style="height:10px""></div><?php }?>

<?php } else echo '<center class="msgalert">No Record Found</center>'; ?>     
</div>   
</div>
</div>
</div>        
   

