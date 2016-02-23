<?php
include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
$path='../../';

?>
<script type="text/javascript" src="js/popupbox.js"></script>
<?php
$requestType=$_REQUEST['RequestType'];
$searchkey=$_REQUEST['SearchKey'];
$Type=$_REQUEST['Type'];
$userCity=$_REQUEST['userCity'];
$type2 = $_REQUEST['type2'];
if($_REQUEST['action']=='Listview'){

//TO SEARCH AND FIND THE MERGED SQL
$findcitymatch=get_Search_Id(TABLE_GENERALAREAMASTER,"Id","Area",$userCity);
$querycitymatch ="AND RGT_City IN (".$findcitymatch.")";



if($type2 == 1)
{
if($searchkey!='')
$searchsql = "`RGT_CompName` LIKE  '$searchkey%'  AND";
else
$searchsql ="";
}
else if($type2 == 3)
{
$findkeywordmatch=get_Search_Id(TABLE_KEYWORDMST,"Kd_Id","Kd_Keyword",$searchkey);
if($findkeywordmatch!='')
$findkeywordmatchIds=get_Search_Id(TABLE_MEMBERKEYWORD,"Mk_MemFk","Mk_KeywordFk",$findkeywordmatch);
if($findkeywordmatchIds!='')
$searchsql = "`RGT_PK` IN (".$findkeywordmatchIds.") AND";
else
$searchsql ="";
}
else
{
$findsectormatch=get_Search_Id(TABLE_SECTOR,"Id","S_Name",$searchkey);
if($findsectormatch!='')
$searchsql ="RGT_Sector IN (".$findsectormatch.") AND";
else
$searchsql ='';
}





if($requestType=='company'){
$searchtTitle="Company List";

//db connection
$searchquery=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  $searchsql RGT_Status=1 AND RGT_Type=2 $querycitymatch ");
$searchquery1=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  $searchsql RGT_Status=1 AND RGT_Type=2 $querycitymatch ");
$searchquery2=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  $searchsql RGT_Status=1 AND RGT_Type=2 $querycitymatch");
$countresult=mysql_num_rows($searchquery);
while($fetchquery=mysql_fetch_array($searchquery1)){
$relatedsearch.=$fetchquery['RGT_Sector'].',';
}
}
else if($requestType=='bestdeals'){
$searchtTitle="Xbit List";
//db connection

if(isset($findcitymatch)){
$querycitymatch1=db_query("SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE RGT_City= $findcitymatch AND RGT_Status=1 ");
while($fetchcitymatch=mysql_fetch_array($querycitymatch1)){
$citymatchdata.=$fetchcitymatch['RGT_PK'].',';
}
$citymatchdata=substr($citymatchdata,0,-1);
}

$queryprodname=db_query("SELECT Id FROM ".TABLE_ADMINPRODUCT." WHERE ProductName LIKE '$searchkey%'");
while($fetchprodid=mysql_fetch_array($queryprodname)){
$matchingids.=$fetchprodid['Id'].',';
}
$matchingids=substr($matchingids,0,-1);
$relatedsearch1='';
if($matchingids!=''&&$citymatchdata!=''){
$searchquery=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_Fk IN (".$matchingids.") AND PS_User_Fk IN (".$citymatchdata.") ");
$searchquery1=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_Fk IN (".$matchingids.") AND PS_User_Fk IN (".$citymatchdata.") ");
$searchquery2=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_Fk IN (".$matchingids.") AND PS_User_Fk IN (".$citymatchdata.") ");
$searchquery3=db_query("SELECT DISTINCT * FROM ".TABLE_PRODUCTSERVICE." WHERE  PS_Fk IN (".$matchingids.") AND PS_User_Fk IN (".$citymatchdata.") ");

$countresult=mysql_num_rows($searchquery);
while($fetchquery=mysql_fetch_array($searchquery1)){
$relatedsearch.=$fetchquery['PS_Id'].',';
}
while($fetchquery1=mysql_fetch_array($searchquery3)){
$relatedsearch1.=$fetchquery1['PS_Fk'].',';
}
}
}
$relatedsearch=substr($relatedsearch, 0, -1);
$relatedsearch1=substr($relatedsearch1, 0, -1);
if(isset($searchquery2)){
while($fetchquery=db_fetch_array($searchquery2)){
if($requestType=='company'){
$alreadylisteddetails .=$fetchquery['RGT_PK'].',';

}
if($requestType=='bestdeals'){
$alreadylisteddetails.=$fetchquery['PS_Id'].',';
}
$finaldetails=substr($alreadylisteddetails, 0, -1);;
}
}


if($Type=='1' && $requestType=='company' ){
if($countresult>0){
while($fetchquery=mysql_fetch_array($searchquery)){
$yearofestablishment = explode('-',$fetchquery['RGT_YrofEstablish']);
 if(strlen(stripslashes($fetchquery['RGT_CompName']))>25){ $Compnamefixlimit = substr(stripslashes($fetchquery['RGT_CompName']),0,25).'...' ;} else { $Compnamefixlimit =  stripslashes($fetchquery['RGT_CompName']);}
$Compnamedisp = '<span style="cursor:pointer;" title="'.$fetchquery['RGT_CompName'].'">'.$Compnamefixlimit.'</span><span style="color:#007088;"> (Since - '.$yearofestablishment[2].')</span>';
?>
<div class="singlead">
<!----title---->
<div class="adtitle">
<div style="width:550px;color:#EC5324;float:left;"><b><?php echo $Compnamedisp ;?></b></div>
<?php /*?><div class="rating">Rating <span><img src="images/rating_star.png" /><img src="images/rating_star.png" /><img src="images/rating_star.png" /></span> 3.0</div><?php */?>
</div>
<!----title--------->
<!------adimage--------->
<div class="adimage">
<div class="company_logo" align="right"><a href="#thumb" class="thumbnail">
<img src="<?php if($fetchquery['RGT_PK']!=''){ echo getLogodetails($fetchquery['RGT_PK'],$path); } else { echo 'images/default/no_image.png'; }?>"  width="124" height="115" /><span><img  src="<?php if($fetchquery['RGT_PK']!=''){ echo getLogodetails($fetchquery['RGT_PK'],$path); } else { echo 'images/default/no_image.png'; }?>" width="220" height="220" /></span></a></div>
<div class="addetails_left">
<?php if (strlen(getOperatingAreas($fetchquery['RGT_PK'])) > 35)
$dispareas =  substr(getOperatingAreas($fetchquery['RGT_PK']),0,35).'...';
else
$dispareas = getOperatingAreas($fetchquery['RGT_PK']);?>
<div><span>Operating Areas : <span style="cursor:pointer;" title="<?php echo getOperatingAreas($fetchquery['RGT_PK']);?>"><?php  echo $dispareas;?></span></span></div>
<div style="height:5px;"></div>
<div><span>Working Days : <?php echo $fetchquery['RGT_WorkingdayFrom'];?> - <?php echo $fetchquery['RGT_WorkingdayTo'];?></span></div>
<div style="height:5px;"></div>
<div><span>Business Timing : <?php echo $fetchquery['RGT_OfficetimeFrom'];?> - <?php echo $fetchquery['RGT_OfficetimeTo'];?></span></div>
<div style="height:5px;"></div>
<div><span> Break Time : <?php echo $fetchquery['RGT_BreaktimeFrom'];?> - <?php echo $fetchquery['RGT_BreaktimeTo'];?></span></div>
</div>
</div>
<!------adimage--------->
<!------addetails--------->
<div class="addetails">
<div class="addetails_left">
<span style="color:#EC5324;"><b>Company Details</b></span>
<div style="height:10px;"></div><?php if($fetchquery['RGT_CompType']!=''){?><span>Company Type : <?php if($fetchquery['RGT_CompType']=='1'){echo "Cooperative Societies"; } elseif($fetchquery['RGT_CompType']=='2'){ echo "Government Based";} elseif($fetchquery['RGT_CompType']=='3'){ echo "Joint Stock Companies";} elseif($fetchquery['RGT_CompType']=='4'){ echo "Partnership";} elseif($fetchquery['RGT_CompType']=='5'){ echo "Private Limited";} elseif($fetchquery['RGT_CompType']=='6'){ echo "Sole Proprietorship";}?></span><?php }?>
<div style="height:5px;"></div><span>Industry : </span> <?php getSectordetails($fetchquery['RGT_Sector']);?></span><br/><?php //if(getMemberKeywords($fetchquery['RGT_PK'])!=''){?><div style="height:5px;" ></div><span>offers : </span><span style="cursor:pointer;" title="<?php echo getMemberKeywords($fetchquery['RGT_PK']);?>"><?php
if (strlen(getMemberKeywords($fetchquery['RGT_PK'])) > 20)
$dispkeyword =  substr(getMemberKeywords($fetchquery['RGT_PK']),0,20).'...';
else
$dispkeyword = getMemberKeywords($fetchquery['RGT_PK']);
echo $dispkeyword;?></span></span><?php //}?>
</div>
<div class="addetails_sep"></div>
<div class="addetails_right">
<span style="color:#EC5324;"><b>Contact Details</b></span><div style="height:10px;"></div>
<?php
if (strlen($fetchquery['RGT_Address1']) > 15)
$dispaddress =  substr($fetchquery['RGT_Address1'],0,15).'...';
else
$dispaddress = $fetchquery['RGT_Address1'];

if (strlen($fetchquery['RGT_Address2']) > 15)
$dispaddress2 =  substr($fetchquery['RGT_Address2'],0,15).'...';
else
$dispaddress2 = $fetchquery['RGT_Address2'];

echo '<span style="cursor:pointer;" title="'.$fetchquery['RGT_Address1'].'">'.$dispaddress.'</span>';
if($fetchquery['RGT_Address2']!=''){ echo ', <span style="cursor:pointer;" title="'.$fetchquery['RGT_Address2'].'">'.$dispaddress2.'</span><br/>';}
if($fetchquery['RGT_Area']!=''){ getAreadetails($fetchquery['RGT_Area']);}  if($fetchquery['RGT_City']!=''){ getCitydetails($fetchquery['RGT_City']); } if($fetchquery['RGT_State']!=''){  getStatedetails($fetchquery['RGT_State']); } if($fetchquery['RGT_Pincode']!=''){ getPindetails($fetchquery['RGT_Pincode']); } if($fetchquery['RGT_Country']!=''){ getCountrydetails($fetchquery['RGT_Country'],$fetchquery['RGT_Pincode']); } ?>
<div><?php if($fetchquery['RGT_Landline']!='') echo 'Phone: '.$fetchquery['RGT_Landline'];else echo  'Phone: '. $fetchquery['RGT_Mobile'] ;?></div>
<div><?php echo 'Email: '.$fetchquery['RGT_Email'] ;?></div>
</div>
</div>
<div style="width:720px;height:39px;float:left;">
<?php if($fetchquery['RGT_PaymentStatus']=='1'){?>
<div class="chat_details">
<div class="chat_curve"></div>
<div class="chat_style"><img src="images/chat_online.png" style="position:relative;top:3px;" />&nbsp;&nbsp;<a href="#"> I'm Offline</a>
</div>
<div class="chat_fullcurve"></div>
<div class="full_det"><a href="<?php echo $fetchquery['RGT_ProfileUrl']?>"  target="_blank"> View Full Details</a><?php /*?><a <?php  if(isset($_SESSION['LID'])){?>href="<?php echo $fetchquery['RGT_ProfileUrl']?>" <?php } else {?> class="pop firstviewmore" onclick="getUserProfile('<?php echo $fetchquery['RGT_ProfileUrl']?>','','');" <?php }?>   target="_blank"> View Full Details</a><?php */?></div>
</div>
<?php }?>
</div>
<!------addetails--------->
</div><br /></br>
<?php }} else{?><tr><td>No Records Found</td></tr><?php }}
if($Type=='1' && $requestType=='bestdeals' ){
if($countresult>0){
while($fetchquery=mysql_fetch_array($searchquery)){
$yearofestablishment = explode('-',get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_YrofEstablish'));
 if(strlen(stripslashes(get_company_name($fetchquery['PS_Id'])))>25){ $Compnamefixlimit = substr(stripslashes(get_company_name($fetchquery['PS_Id'])),0,25).'...' ;} else { $Compnamefixlimit =  stripslashes(get_company_name($fetchquery['PS_Id']));}
$Compnamedisp = $Compnamefixlimit.'<span style="color:#007088;"> (Since - '.$yearofestablishment[2].')</span>';
?>
<div class="singlead">
<!----title---->
<div class="adtitle">
<div style="width:550px;color:#EC5324;float:left;"><b><?php echo $Compnamedisp ;?></b></div>
<?php /*?><div class="rating">Rating <span><img src="images/rating_star.png" /><img src="images/rating_star.png" /><img src="images/rating_star.png" /></span> 3.0</div>
<?php */?></div>
<!----title--------->
<!------adimage--------->
<div class="adimage">
<div class="company_logo">
<a href="#thumb" class="thumbnail">
<img src="<?php if($fetchquery['PS_CoverImg']!=''){ echo $fetchquery['PS_CoverImg']; } else { echo 'images/default/no_image.png'; }?>"  width="124" height="115" /><span><img src="<?php if($fetchquery['PS_CoverImg']!=''){ echo $fetchquery['PS_CoverImg']; } else { echo 'images/default/no_image.png'; }?>" width="220" height="220" /></span></a>

</div>
<div>
<div><?php echo $fetchquery['PS_Display']?></div>
<div><?php
if($fetchquery['PS_Price']!=''&&$fetchquery['PS_Price']!='0'){
echo '<span> Price :'.' '.$fetchquery['PS_Price'].' '.CurrencyName($fetchquery['PS_Currency']).'</span>';
}
if($fetchquery['PS_Unit']!=''){
echo '<span> Unit :'.' '.$fetchquery['PS_Unit'].'</span>';
}

?></div>
</div>
</div>
<!------adimage--------->
<!------addetails--------->
<div class="addetails">
<div class="addetails_left">
<span style="color:#EC5324;"><b>Business Descriptions</b></span><div style="height:10px;"></div>
<?php if(strlen($fetchquery['PS_Description'])>150){ echo substr($fetchquery['PS_Description'],0,150).'...'; } else {echo $fetchquery['PS_Description']; } ?></div>
<div class="addetails_sep"></div>
<div class="addetails_right">
<span style="color:#EC5324;"><b>Contact Details</b></span><div style="height:10px"></div>
<?php
getAreadetails(get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Area'));
getCitydetails(get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_City'));
getStatedetails(get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_State'));
getPindetails(get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Pincode'));
getCountrydetails2(get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Country'));
?>
<div><?php if(get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Mobile')!='') echo 'Phone: '.get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Mobile') ;else echo  'Phone: '. get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Landline') ;?></div>
<div><?php echo 'Email: '.get_data_from_registration($fetchquery['PS_User_Fk'],'RGT_Email') ;?></div>

</div>
</div>
<div style="width:720px;height:39px;float:left;">
<div class="chat_details">
<div class="chat_curve"></div>
<div class="chat_style"><img src="images/chat_online.png" style="position:relative;top:3px;" />&nbsp;&nbsp;<a href="#"> I'm Offline</a>
</div>
<div class="chat_fullcurve"></div>
<?php

if(get_data_from_registration($fetchquery['PS_User_Fk'],RGT_Type)==3)
$user_id = $fetchquery['PS_User_Fk'];
else
$user_id = get_data_from_registration($fetchquery['PS_User_Fk'],RGT_ProfileUrl);
?>
<div class="full_det"><a <?php  if(isset($_SESSION['LID'])){?> target="_blank"  href="<?php echo 'Bestdealsajax.php?type='.base64_encode(get_data_from_registration($fetchquery['PS_User_Fk'],RGT_Type)).'&user='.$user_id.'&BDId='.$fetchquery['PS_Id'];?>" <?php } else {?> class="pop firstviewmore" onclick="getUserProfile('<?php echo $user_id ;?>','<?php echo $fetchquery['PS_Id'];?>','<?php echo base64_encode(get_data_from_registration($fetchquery['PS_User_Fk'],RGT_Type));?>');" <?php }?> >View Full Details</a>
</div>
</div>
<!------addetails--------->
</div><br/><br/>
<div class="clear"></div>
<?php }} else{?><tr><td>No Records Found</td></tr><?php }}

if($Type=='2' && $requestType=='company' ){
if($countresult>0){
$companycount=0;
?>

<table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
<tbody><tr>

<?php while($fetchquery=mysql_fetch_array($searchquery)){?>
<td style="padding:10px 15px 0px 20px;">
<a href="#" style="text-decoration:none;color:#136578;cursor:default;">
<div style="width:150px;min-height:180px;height:auto;border:1px solid #c3c3c3;">
<div style="border:3px solid #F3F3F3;"><img src="<?php getLogodetailsgallery($fetchquery['RGT_PK'],$path);?>" width="144" height="144" /></div>

<?php if($fetchquery['RGT_PaymentStatus']=='1'){?><a style="text-decoration:none;color: #136578;" href="<?php echo $fetchquery['RGT_ProfileUrl']?>"    target="_blank" title="View More" ><?php }?><div style="width:150px;min-height:20px;height:auto;background:#DBDBDB;text-align:center;padding:5px 0px;"><?php echo nameLimiter($fetchquery['RGT_CompName'], 17); ?></div><?php if($fetchquery['RGT_PaymentStatus']=='1'){?></a><?php /*?><a style="text-decoration:none;color: #136578;" <?php  if(isset($_SESSION['LID'])){?>href="<?php echo $fetchquery['RGT_ProfileUrl']?>" <?php } else {?> class="pop firstviewmore" onclick="getUserProfile('<?php echo $fetchquery['RGT_ProfileUrl']?>','','');" <?php }?>   target="_blank" title="View More" ><?php }?><div style="width:150px;min-height:20px;height:auto;background:#DBDBDB;text-align:center;padding:5px 0px;"><?php echo nameLimiter($fetchquery['RGT_CompName'], 17); ?></div><?php if($fetchquery['RGT_PaymentStatus']=='1'){?></a><?php */?><?php }?>
</div>
<div style="width:142px;height:5px;margin-left:auto;margin-right:auto;background:url(images/gallery_box-shadow.png) no-repeat;"></div>
</a>
</td><?php $companycount++; if ($companycount%4==0){ ?></tr><tr><?php } } ?>
</tr></tbody></table>
<?php } else{ ?><tr><td>No Records Found</td></tr><?php }  ?>





<?php
}
if($Type=='2' && $requestType=='bestdeals' ){
if($countresult>0){
$listcount=0;?>

<table cellpadding="0" cellspacing="0" border="0" style="border-collapse:collapse;">
<tbody><tr>

<?php while($fetchquery=mysql_fetch_array($searchquery)){?>
<td style="padding:10px 15px 0px 20px;">
<a href="#" style="text-decoration:none;color:#136578;cursor:default;">
<div style="width:150px;min-height:180px;height:auto;border:1px solid #c3c3c3;">
<div style="border:3px solid #F3F3F3;"><img src="<?php if($fetchquery['PS_CoverImg']!=''){ echo $fetchquery['PS_CoverImg']; } else { echo 'images/default/no_image_gallery.png'; }?>" width="144" height="144" /></div>

<a style="text-decoration:none;color: #136578;" <?php  if(isset($_SESSION['LID'])){?> target="_blank"  href="<?php echo 'Bestdealsajax.php?user='.get_data_from_registration($fetchquery['PS_User_Fk'],RGT_ProfileUrl).'&BDId='.$fetchquery['PS_Id'];?>" <?php } else {?> class="pop firstviewmore" <?php }?> title="View More" ><div style="width:150px;min-height:20px;height:auto;background:#DBDBDB;text-align:center;padding:5px 0px;"><?php echo nameLimiter($fetchquery['PS_Display'], 17); ?></div></a>
</div>
<div style="width:142px;height:5px;margin-left:auto;margin-right:auto;background:url(images/gallery_box-shadow.png) no-repeat;"></div>
</td>
<?php $listcount++; if($listcount%4==0){ ?></tr><tr><?php }} ?>
</tr></tbody></table><?php } else { ?><tr><td>No Records Found</td></tr><?php } }}?>
