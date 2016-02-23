<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$LID = trim($_REQUEST['LogIdd']);
$Type = trim($_REQUEST['Type']);
$SearchText = trim($_REQUEST['SearchText']);
$Caty = trim($_REQUEST['Caty']);
$SubCaty = trim($_REQUEST['SubCaty']);


if($Caty!='')
$Filter = " AND PS_IndustryFk='".$Caty."'";
if($SubCaty!='')
$Filter .= " AND PS_Id='".$SubCaty."'";

if($SearchText!='')
{
$ProductIds   = get_Search_Id(TABLE_KEYWORDMST, "Kd_Id", "Kd_Keyword", $SearchText);
$KeywordIds   = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Keyword", $SearchText);
$DescIds      = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Description", $SearchText);
//$CategoryIds  = get_Search_Id(TABLE_PRODUCTCATEGORY, "ProductCat_Pk", "ProductCat_Name", $SearchText);
$DisplayIds   = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Display", $SearchText);

$CountryIds   = get_Search_Id(TABLE_GENERALCOUNTRYMASTER, "Id", "Country_Name", $SearchText);
$StateIds     = get_Search_Id(TABLE_GENERALSTATEMASTER, "Id", "St_Name", $SearchText);
$CityIds      = get_Search_Id(TABLE_GENERALAREAMASTER, "Id", "Area", $SearchText);
$AreaIds      = get_Search_Id(TABLE_AREAMASTER, "AM_Id", "AM_Area", $SearchText);
$PinIds       = get_Search_Id(TABLE_PINCODEMASTER, "PM_Id", "PM_Pincode", $SearchText);




$Con = " AND (PS_Display=''";

if($ProductIds!='')
{
$Con .=" OR ";	
$Con .="PS_Fk IN (".$ProductIds.")";
}

if($KeywordIds!='')
{
$Con .=" OR ";	
$Con .="PS_Id IN (".$KeywordIds.")";
}

if($DescIds!='')
{
$Con .=" OR ";	
$Con .="PS_Id IN (".$DescIds.")";
}
if($DisplayIds!='')
{
$Con .=" OR ";	
$Con .="PS_Id IN (".$DisplayIds.")";
}
/*if($CategoryIds!='')
{
$Con .=" OR ";	
$Con .="PS_CategoryFk IN (".$CategoryIds.")";
}*/
if($CountryIds!='')
{
$Con .=" OR ";	
$Con .="PS_User_Fk IN (SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$LID."' AND RGT_Country IN (".$CountryIds."))";
}
if($StateIds!='')
{
$Con .=" OR ";	
$Con .="PS_User_Fk IN (SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$LID."' AND RGT_State IN (".$StateIds."))";
}
if($CityIds!='')
{
$Con .=" OR ";	
$Con .="PS_User_Fk IN (SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$LID."' AND RGT_City IN (".$CityIds."))";
}
if($AreaIds!='')
{
$Con .=" OR ";	
$Con .="PS_User_Fk IN (SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$LID."' AND RGT_Area IN (".$AreaIds."))";
}
if($PinIds!='')
{
$Con .=" OR ";	
$Con .="PS_User_Fk IN (SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$LID."'  AND RGT_Pincode IN (".$PinIds."))";
}

$Con .=" ) ";
}

if(isset($_POST['lastmsg']))
{
$lastmsg=$_POST['lastmsg'];
$Overallsql = "SELECT PS_Id ,PS_Fk ,PS_Description ,PS_CoverImg,PS_Display,PS_Price,PS_Currency,PS_Unit,PS_User_Fk FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_User_Fk 	='".$LID."' ".$Con." ".$Filter." AND PS_Id<'$lastmsg' order by PS_Id";
$Overallcount = db_num_rows(db_query($Overallsql));
$sqltot=$Overallsql."  DESC LIMIT 8";
}
else
{
    $Con=(isset($Con) && !empty($Con) ? trim($Con) : '');
    $Filter=(isset($Filter) && !empty($Filter) ? trim($Filter) : '');
$Overallsql = "SELECT PS_Id ,PS_Fk ,PS_Description ,PS_CoverImg,PS_Display,PS_Price,PS_Currency,PS_Unit,PS_User_Fk FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_User_Fk 	='".$LID."' ".$Con." ".$Filter."  order by PS_Id";
$Overallcount = db_num_rows(db_query($Overallsql));
	
$sqltot=$Overallsql." DESC LIMIT 8";
}
$SqlRun=db_query($sqltot);

/*$sqltot="SELECT PS_Id ,PS_Fk ,PS_Description ,PS_CoverImg,PS_Display FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_User_Fk 	='".$LID."' ".$Con." ".$Filter." order by  PS_Id  desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=10;
$noofpages=$totalrecord/$pagesize;

if (!isset($_REQUEST['startdata']) || trim($_REQUEST['startdata'])=='' || trim($_REQUEST['startdata'])=='0')
$startdata=0;
else
$startdata=$_REQUEST['startdata'];
$count=$startdata;
if($_REQUEST["startdata"]=="0")
{	$i=1;	}
elseif($_REQUEST["startdata"]!="0")
{ 	$i=$_REQUEST["startdata"]+1; }
else
{ 	$i=1; 	}	

$SqlRun=db_query($sqltot." limit $startdata,$pagesize");*/
$Count = db_num_rows($SqlRun);
if(isset($lastmsg) && !empty($lastmsg))
if($Type=='1'){
if($Count>0 && $lastmsg==''){?>
<div style="width:98%;height:40px;margin-left:auto;margin-right:auto;font-weight:bold;font-size:14px;color:#EB8A18;">
<span><a id="BestdealList"  style="text-decoration:none;color:#087287;cursor:pointer;" onclick="BestDealsView('1');">List</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span><a id="BestdealGrid" style="text-decoration:none;color:#EB8A18;cursor:pointer;" onclick="BestDealsView('2');">Gallery</a></span>
</div>

<div style="width:98%;height:7px;margin-left:auto;margin-right:auto;background:url(images/seprater_shadow.png) no-repeat left;">
</div><?php }?>
<table  cellpadding="0" cellspacing="0" border="0">
<?php 
if($Count>0){
$Pid=0;
$LocDisplay =' ---- ';
while(list($PS_Id,$PS_Fk,$PS_Description,$PS_CoverImg,$PS_Display,$PS_Price,$PS_Currency,$PS_Unit,$PS_User_Fk ) = db_fetch_array($SqlRun)){
$msg_id=$PS_Id;
$Location=db_query("SELECT RGT_Country,RGT_State,RGT_City,RGT_Area,RGT_Pincode FROM ".TABLE_REGISTRATION." WHERE  RGT_PK ='".$PS_User_Fk."'");
list($RGT_Country,$RGT_State,$RGT_City,$RGT_Area,$RGT_Pincode) = db_fetch_array($Location);
$LocDisplay = CountryName($RGT_Country).StringAppend(StateName($RGT_State),' , ',3,STR_PAD_LEFT).StringAppend(CityName($RGT_City),' , ',3,STR_PAD_LEFT).StringAppend(AreaName($RGT_Area).StringAppend(PincodeName($RGT_Pincode),' - ',3,STR_PAD_LEFT),' , ',3,STR_PAD_LEFT);
?>
<tr>
<td style="width: 125px; height: 145px; float: left; background: url(&quot;images/nobestdeal.png&quot;) no-repeat scroll 0px 0px transparent;"><div style="width:100px;height:122px;margin:5px 0px 0px 5px;"><img src="<?php echo XbitImage($PS_Id);?>" width="103" height="120px" /></div></td>
<td valign="top">
<table>
<tr><td style="font-weight:bold;color:#E76524;height:25px;font-size:14px;"><?php if(strlen(stripslashes($PS_Display))>15){ echo substr(stripslashes($PS_Display),0,20).'...' ;} else { echo stripslashes($PS_Display);} ?></td></tr>
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
<tr><td><?php if(strlen(stripslashes($PS_Description))>50){ echo substr(stripslashes($PS_Description),0,100).'...' ;} else { echo stripslashes($PS_Description);} ?></td></tr>
<tr><td align="right" width="650"><input type="button" onclick="ProfileViewGrid('BDViewMore.php?user=<?php echo ProfileUrl($LID);?>&BDId=<?php echo $PS_Id;?>');"  style="width:80px;height:24px;background:transparent url(images/know-morw.png) no-repeat;border:none;cursor:pointer;" /></td></tr>
</table>
</td>
</tr>
<?php $Pid++; }} else {?><tr><td align="center"><div style="border:0px solid #E76524;padding-left:260px;border-radius:5px;" class="comment more">
<center class="msgalert">No Record Found</center>     
</div></td></tr><?php }?>
</table>
<?php /*if($Count>0){?>
<table cellpadding="0" cellspacing="0" border="0" align="right">
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'BDViewPage'); ?></td></tr>
</table>
<?php }*/
if($Overallcount>8){?>
<div onclick="ViewMoree('more<?php echo $msg_id; ?>','<?php echo $msg_id; ?>','Bestdealslist','Bl_BestDealsView','pass')" id="more<?php echo $msg_id; ?>" class="viewmoree">
View More
</div><div style="height:10px"></div><?php }?>
<?php  }
if($Type=='2'){
    if(isset($lastmsg) && !empty($lastmsg))
if($Count>0 && $lastmsg==''){
$Pid=0;
?>
<div style="width:98%;height:40px;margin-left:auto;margin-right:auto;font-weight:bold;font-size:14px;color:#EB8A18;">
<span><a id="BestdealList"  style="text-decoration:none;color:#EB8A18;cursor:pointer;" onclick="BestDealsView('1');">List</a></span>&nbsp;&nbsp;|&nbsp;&nbsp;<span><a id="BestdealGrid" style="text-decoration:none;color:#087287;cursor:pointer;" onclick="BestDealsView('2');">Gallery</a></span>
</div>

<div style="width:98%;height:7px;margin-left:auto;margin-right:auto;background:url(images/seprater_shadow.png) no-repeat left;">
</div>
<table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;" >
<tr>
<?php while(list($PS_Id,$PS_Fk,$PS_Description,$PS_CoverImg,$PS_Display ) = db_fetch_array($SqlRun)){
$msg_id=$PS_Id;?>
<td style="padding:10px 15px 0px 0px;">
<a href="#" style="text-decoration:none;color:#136578;cursor:default;">
<div style="width:150px;min-height:180px;height:auto;border:1px solid #c3c3c3;">
<div style="border:3px solid #F3F3F3;" ><img src="<?php if (XbitImage($PS_Id)!='') echo XbitImage($PS_Id) ; else echo 'images/default/no_image.png' ;?>" width="144" height="144"  /></div>

<div style="width:150px;min-height:20px;height:auto;background:#DBDBDB;text-align:center;cursor:pointer;padding:5px 0px;" onclick="ProfileViewGrid('BDViewMore.php?user=<?php echo $_REQUEST['user'];?>&BDId=<?php echo $PS_Id;?>');"><?php echo $PS_Display;?></div>
</div>
<div style="width:142px;height:5px;margin-left:auto;margin-right:auto;background:url(images/gallery_box-shadow.png) no-repeat;"></div>
</a>
</td>
<?php $Pid++;  if($Pid%4==0){?></tr><tr><?php }}  }  else {?><tr><td align="center"><div style="border:0px solid #E76524;border-radius:5px;" class="comment more">
<center class="msgalert">No Record Found</center>     
</div></td></tr><?php } ?>
</table>
<?php /*if($Count>0){?>
<table cellpadding="0" cellspacing="0" border="0" align="right">
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'BDViewPage'); ?></td></tr>
</table>
<?php }*/
if($Overallcount>8){?>
<div onclick="ViewMoree('more<?php echo $msg_id; ?>','<?php echo $msg_id; ?>','Bestdealslist','Bl_BestDealsView','pass')" id="more<?php echo $msg_id; ?>" class="viewmoree">
View More
</div><div style="height:10px"></div><?php }
}?>
