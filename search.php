<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link rel="icon" href="images/favicon.ico">
<?php include("ScriptStyle.php");?>
<script type="text/javascript">
$(function(){
	$('#navigation_vert').naviDropDown({
		dropDownWidth: '165px',
		orientation: 'vertical'
	});
});
</script>
<link href="css/homepage.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body class="background">
<!----------top------------->
<div class="search_topbar" align="right">
<div style="width:190px;height:29px;float:right;">
<div style="float:left;"><a href="Login.php">Sign In</a>
<a href="Register.php">Register</a></div>
<div style="float:left;"><a href="#" style="border:none;text-decortaion:none;"><img src="images/home/register_icon.png" style="position:relative;left:-15px;" /></a></div>
</div>
</div>
<!----------top------------->

<?php if(isset($_POST['searchkey'])){
    $searchkey=$_POST['searchkey'];
    $requestType=$_POST['requestType']; 
    $userCity=$_POST['userCity']; 
    //TO SEARCH AND FIND THE MERGED SQL
    $findcitymatch=get_Search_Id(TABLE_GENERALAREAMASTER,"Id","Area",$userCity);
    
    
    if($requestType=='company'){
        $searchtTitle="Company List";
        //db connection
        $searchquery=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  `RGT_CompName` LIKE  '$searchkey%' AND RGT_City IN (".$findcitymatch.")");
        $searchquery1=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  `RGT_CompName` LIKE  '$searchkey%' AND RGT_City IN (".$findcitymatch.")");
        $countresult=mysql_num_rows($searchquery);
         while($fetchquery=mysql_fetch_array($searchquery1)){
        $relatedsearch.=$fetchquery['RGT_Sector'].',';
        }
    }
    else if($requestType=='bestdeals'){
        $searchtTitle="Xbit List";
        //db connection
        if(isset($findcitymatch)){
        $selectmatch="SELECT LN_PSFk FROM ".TABLE_LOCATION." WHERE LN_City IN (".$findcitymatch.")";
        $selecttest=" AND PS_Id IN ($selectmatch)";
        }
        $searchquery=db_query("SELECT * FROM  ".TABLE_PRODUCTSERVICE." WHERE  `PS_Display` LIKE  '$searchkey%' ".$selecttest."");
        $searchquery1=db_query("SELECT * FROM  ".TABLE_PRODUCTSERVICE." WHERE  `PS_Display` LIKE  '$searchkey%' ".$selecttest."");
        $countresult=mysql_num_rows($searchquery);
        while($fetchquery=mysql_fetch_array($searchquery1)){
        $relatedsearch.=$fetchquery['PS_BusinessType'].',';
        }
        }
}
$relatedsearch=substr($relatedsearch, 0, -1);
 ?>
 





<div style="width:990px;height:auto;margin-left:auto;margin-right:auto;margin-top:20px;color:#7A7A7A;font-size:14px;">

<form method="post" action="search.php" >
<div style="width:990px;height:30px;margin-left:auto;margin-right:auto;">
<div style="width:700px;height:25px;float:left;">

<div style="width:300px;height:25px;float: left;">
<a onclick="Togglecity();" id="cityvalue" >Pondicherry</a>
<input name="userCity" id="userCity"  type="hidden" value="" />
<input name="userCityselect" autocomplete="off" id="userCityselect" onkeyup="suggestCity(this.value);" type="text"  value="" style="width:100px;height:25px;border:1px solid #A8A8A8;color:#136578;background:#EEEEEE; display:none;" />
<input type="hidden" name="citylisthidden" id="citylisthidden" value="" />
<div id="citysuggestions" style="display: none;"> <div style="position: relative; width: 150px;  max-height: 300px; z-index: 9999; display: block;" id="citysuggestionlist"> &nbsp; </div></div>
</div>
<div style="width:150px;height:25px;float: left;">
<input type="radio" id="requestTypeCom" name="requestType" checked="checked" value="company" title="Company" <?php if($requestType=='company'){echo 'checked';} elseif($requestType!='company'&&$requestType!='bestdeals') {echo 'checked'; } ?> /><span style="color:#7A7A7A;font-size:14px;">Company</span>
</div>
<div style="width:100px;height:25px;float: left;">
<input type="radio" name="requestType" id="requestTypedeals" value="bestdeals" title="Xbit" <?php if($requestType=='bestdeals'){echo 'checked';} ?> /><span style="color:#7A7A7A;font-size:14px;">Xbit</span>
</div>
</div>
<div style="width:290px;height:30px;float:left;">
Area in Pondicherry?
</div>
</div>


<div style="width:990px;height:40px;margin-left:auto;margin-right:auto;">
<div style="width:700px;height:30px;float:left;">
<input type="text" autocomplete="off" name="searchkey" id="searchlist" onkeyup="suggest(this.value);"   class="searchbox" placeholder="Please Input Keywords..." value="" style="width:670px;height:25px;color:#A8A8A8;border:1px solid #C8C8C8;" />
<div id="suggestions" style="display: none;"> <div style="position: relative; margin-top: 0; width: 450px;  max-height: 300px; z-index: 9999; display: block;" id="suggestionsList"> &nbsp; </div></div>
<input type="hidden" name="searchlisthidden" id="searchlisthidden" value="" />
</div>
<div style="width:290px;height:30px;float:left;">
<select name="selectarea" id="selectarea"  style="width:280px;height:29px;color:#A8A8A8;border:1px solid #C8C8C8;" ><?php $queryarea=db_query("SELECT  AM_Area, AM_Status  FROM ".TABLE_AREAMASTER." WHERE AM_City =1 ");
while($fetchquery=mysql_fetch_array($queryarea)){
    echo '<option>'.$fetchquery['AM_Area'].'</option>';
} ?></select>
</div>
</div>

<div style="width:990px;height:30px;">
<div style="width:695px;height:30px;float:left;"></div>
<div style="width:295px;height:30px;float:left;"><input name="rememberlocation" id="rememberlocation" type="checkbox" /> Remember My Location</div>
</div>


<div style="width:990px;height:75px;" align="center">
<input id="searchsubmit" type="submit" value="" style="width:107px;height:37px;border:none;background:transparent url(images/home/search_back.png);color:#136578;font-weight:bold;cursor:pointer;" onmouseover="javascript: this.style.backgroundImage='url(images/home/search_hover.png)';" onmouseout="javascript: this.style.backgroundImage='url(images/home/search_back.png)';" />&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="" style="width:161px;height:42px;border:none;background:transparent url(images/home/advance_back.png);color:#136578;font-weight:bold;cursor:pointer;" onmouseover="javascript: this.style.backgroundImage='url(images/home/advance_hover.png)';" onmouseout="javascript: this.style.backgroundImage='url(images/home/advance_back.png)';" /></span>
</div>
</form>


</div>







<div style="width:990px;min-height:532px;height:auto;margin-left:auto;margin-right:auto;">


<!--Category Start-->
  <div id="left_cate">
   <h3 style="padding-left:28px">Related Searches</h3><div id="navigation_vert">
                <ul>
                    <?php if($requestType=='company'){ getRelatedSearchComp($relatedsearch);} elseif($requestType=='bestdeals') { getRelatedSearchBestdeals($relatedsearch); } ?>                    
      </ul>
    </div><!-- vertical_menu -->

<a href="#"><img src="images/correct_choice.jpg" width="120" height="100" border="no" /></a></div>
  <!--categoryend-->
  
 <div id="listview">
  <div id="listviewheaderone"><span onclick="SearchListStyle(<?php echo '\''.$requestType.'\''.','.'\''.$searchkey.'\''; ?>,'1');" >List</span></div>
  <div id="listviewheader"><span onclick="SearchListStyle(<?php echo '\''.$requestType.'\''.','.'\''.$searchkey.'\''; ?>,'2');" >Gallery</span></div>
<div id="mainsearchcontent" style="float: left;height: auto;width: 772px;">
<?php if($requestType=='company'){ if($countresult>0){
    while($fetchquery=mysql_fetch_array($searchquery)){
    
    ?>
  <div id="listdoctors">
      <div id="doctorsimg"><img src="<?php getLogodetails($fetchquery['RGT_PK']);?>" width="151" height="171"  /></div>
      <div id="doctorstext">
      <h4><?php echo $fetchquery['RGT_CompName']; ?></h4>
      <p>Industry :<?php getSectordetails($fetchquery['RGT_Sector']);?></p>
      <p>Location :<?php if($fetchquery['RGT_Area']!=''){ getAreadetails($fetchquery['RGT_Area']);} if($fetchquery['RGT_Pincode']!=''){ getPindetails($fetchquery['RGT_Pincode']); } if($fetchquery['RGT_City']!=''){ getCitydetails($fetchquery['RGT_City']); } if($fetchquery['RGT_State']!=''){  getStatedetails($fetchquery['RGT_State']); } if($fetchquery['RGT_Country']!=''){ getCountrydetails($fetchquery['RGT_Country']); } ?></p>
      <p>Description:</p>
      <p><?php getDescriptiondetails($fetchquery['RGT_PK']); ?></p>
      </div>
      <div id="view"><a href="<?php echo $fetchquery['RGT_ProfileUrl']?>" title="View More">View More</a></div>
    </div>
    <div class="clear"></div>
    <?php }} }?>
    
    <?php if($requestType=='bestdeals'){ if($countresult>0){
    while($fetchquery=mysql_fetch_array($searchquery)){
    
    ?>
  <div id="listdoctors">
      <div id="doctorsimg"><img src="<?php echo $fetchquery['PS_CoverImg'];?>" width="151" height="171"  /></div>
      <div id="doctorstext">
      <h4><?php echo $fetchquery['PS_Display']; ?></h4>
      <p>Business Type :<?php echo $fetchquery['PS_BusinessType'];?></p>
      <p>Keyword :<?php echo $fetchquery['PS_Keyword'];?></p>
      <p>Description:</p>
      <p><?php if(strlen($fetchquery['PS_Description'])>170){ echo substr($fetchquery['PS_Description'],0,170).'...'; } else {echo $fetchquery['PS_Description']; } ?></p>
      </div>
      <div id="view"><a href="<?php echo $fetchquery['RGT_ProfileUrl']?>" title="View More">View More</a></div>
    </div>
    <div class="clear"></div>
    <?php }} }?>
    
    </div>
    <!--<div id="listdoctors">
      <div id="prev_next">
        <div id="prev_next_btn" style="background-image:url(images/previuos.jpg)"><a href="#" title="Previous Page">Previous Page</a></div>
        <div id="prev_next_btn" style="background-image:url(images/next_btn.jpg)"><a href="#" title="Next Page">Next Page</a></div>
      </div>
    </div>-->
  </div> 

</div>  

<div class="clear"></div>
<?php include("Footer.php");?>
</div>
<!--Load Javascript-->
<script>
if(google.loader.ClientLocation)
{
    visitor_city = google.loader.ClientLocation.address.city;
    $("#userCity").val(visitor_city);
}
else
{
alert('We are not able to choose city Please Select Manually');
}
$("#userCityselect").focusout(function(){
  $("#cityvalue").css('display','inline-block');
  $("#userCityselect").css('display','none');
});
</script>
</body>
</html>