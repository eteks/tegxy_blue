<?php 
include_once("../DatabaseConnection.php");
db_connect();
?>
<script type="text/javascript" src="js/Searchlist.js"></script>
<link href="css/popup.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/popupbox.js"></script>
<script type="text/javascript">
    function Searchusingenterkey(e)
    {
    // look for window.event in case event isn't passed in
    if (typeof e == 'undefined' && window.event) { e = window.event; }
    if (e.keyCode == 13)
    searchResult($('#searchlist').val(),'','');
    }
</script>
<script>

function Searchpage()
{
var pro_search =$("#searchid").val();
var comp_name = $("#comp_searchid").val();
if(comp_name !="" && pro_search !="")
{
var searchKey = $("#searchid").val();
}

if(comp_name !="" && pro_search =="")
{
var searchKey = $("#comp_searchid").val();
}

if(comp_name =="" && pro_search !="")
{
var searchKey = $("#searchid").val();
}

if(pro_search =="" && comp_name =="")
{
var requestType="company";
alert("Please Enter Company Name OR Product Name");
return false;
}
else if(pro_search =="" && comp_name !="")
{
var requestType="company";
//alert(requestType);
}
else if(pro_search !="" && comp_name =="")
{
var requestType="bestdeals";
// alert('requestType adv'+requestType);
}
else if(pro_search !="" && comp_name !="")
{
var requestType="bestdeals";
// alert('2'+requestType);
}

var userCity1=$("#city_name").val();
//var userCity;
var userCity = userCity1.replace(",", "");
if(userCity =="")
{
var userCity="ALL City";
//alert(requestType);
}

var industry_c=$("#Sector_id").val();
var industry_p=$("#Sector").val();
//var userCity;
if(industry_c=="" && industry_p=="")
{
var industry="";
//alert(requestType);
}
else if(industry_c !="" && industry_p=="")
{
var industry=$("#Sector_id").val();
}

else if(industry_c =="" && industry_p !="")
{
var industry=$("#Sector").val();
}
//alert(industry);

// if(selectarea=='')
// {
// userArea=$("#selectarea").val();
// }
// else
// {
// userArea=selectarea;
// }

window.location.href="Searchpage.php?action=Add&searchkey="+searchKey+"&requesttype="+requestType+"&usercity="+userCity+"&industry="+industry+"&type2=1";
}
</script>
<script>

function GET_City(city_id)
{
//alert(city_id);
    createXmlObject();
    var ran_unrounded=Math.random()*100000;
    var ran_number=Math.floor(ran_unrounded);
    //var Country = document.getElementById('SelCountry').value;
    //var State = document.getElementById('SelState').value;
    var str = "Action=Get_City&City="+city_id+"&r="+ran_number;
    var url = "include/BlModules/Bl_CountryStateCity.php";
    //alert(url);
    xmlhttp.open("POST", url, true);  
    xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
    xmlhttp.send(str);
    xmlhttp.onreadystatechange = showGeneralArea   
    //clear the company that does not exists in a city
    var cityVal = $('#search_city').val(); 
    var complist = $("#comp_searchid").val();
    var productlist = $('#searchid').val();
    if(complist){
        $.post('Clearcitycheck.php?city_check=true', {'Clearcity' : cityVal, 'Clearkey' : complist}, function(data) {
            if(data.trim()=='exist'){
                 return true;           
            }
            else {
                alert('Selected item does not exists in this City');
                $('#comp_searchid').val('');
                 return false
            }
        });
    }
    else{
        $.post('Clearproductcheck.php?product_check=true', {'Clearcity' : cityVal, 'Clearproduct' : productlist}, function(data) {
            if(data.trim()=='exist'){
                 return true;           
            }
            else {
                alert('Selected item does not exists in this City');
                $('#searchid').val('');
                 return false
            }
        });
    }
}

function showGeneralArea() 
{ 
    if (xmlhttp.readyState == 4) 
    {
        var response = xmlhttp.responseText;
        if (response != "") 
        {
    //alert(response);
            document.getElementById('ShowAreaList').innerHTML = response;
        }
    }
}

</script>

<style type="text/css">
    ul.leftsidebarlist
    {
    list-style:none;width:180px;height:20px;margin:0 0 0 0px;padding:0;
    }
    ul.leftsidebarlist li
    {
    border-bottom:1px solid #EBEBEB;padding:10px 0px;
    }
    ul.leftsidebarlist li.deal
    {
    border-bottom:1px solid #EBEBEB;padding:15px 0px 15px 0px;height:30px;
    }
    ul.leftsidebarlist li.deal img
    {
    float:left;border:1px solid #ccc;
    position:relative;top:-9px;
    margin-right:8px;
    }
</style>
<?php
    if(isset($_REQUEST['searchkey'])){
    $searchkey=$_REQUEST['searchkey'];
    $requestType=$_REQUEST['requesttype'];
    $userCity=$_REQUEST['usercity'];
    $userArea=AreaName($_REQUEST['userarea']);
    $type2 = $_REQUEST['type2'];
    //TO SEARCH AND FIND THE MERGED SQL
    $findcitymatch=get_Search_Id(TABLE_GENERALAREAMASTER,"Id","Area",$userCity);
    if($findcitymatch!='')
    $querycitymatch ="AND RGT_City IN (".$findcitymatch.")";
    else
    $querycitymatch='';
    $findareamatch=get_Search_Id(TABLE_AREAMASTER,"AM_Id","AM_Area",$userArea);
    if($findareamatch!='')
    $queryareamatch ="AND RGT_Area IN (".$findareamatch.")";
    else
    $queryareamatch ='';
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
    $relatedsearch ='';
    $relatedsearch1 = '';
    $alreadylisteddetails = '';
    if($requestType=='company'){
    $searchtTitle="Company List";
    //db connection
    $searchquery=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  $searchsql RGT_Status=1 AND RGT_Type=2 $querycitymatch  $queryareamatch");
    $searchquery1=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  $searchsql RGT_Status=1 AND RGT_Type=2 $querycitymatch  $queryareamatch");
    $searchquery2=db_query("SELECT * FROM  ".TABLE_REGISTRATION." WHERE  $searchsql RGT_Status=1 AND RGT_Type=2 $querycitymatch  $queryareamatch");
    $countresult=mysql_num_rows($searchquery);
    while($fetchquery=mysql_fetch_array($searchquery1)){
    $relatedsearch.=$fetchquery['RGT_Sector'].',';
    }
    }
    else if($requestType=='bestdeals'){
    $searchtTitle="Xbit List";
    //db connection

    if(isset($findcitymatch) || isset($findareamatch)){
    $wherec = "AND RGT_City= $findcitymatch $queryareamatch ";
    $querycitymatch1=db_query("SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE  RGT_Status=1 AND RGT_PaymentStatus=1 ".$wherec."");
    while($fetchcitymatch=mysql_fetch_array($querycitymatch1)){
    $citymatchdata.=$fetchcitymatch['RGT_PK'].',';
    }
    $citymatchdata=substr($citymatchdata,0,-1);
    }

    $queryprodname=db_query("SELECT PS_Id FROM ".TABLE_PRODUCTSERVICE." WHERE PS_Display LIKE '$searchkey%' AND PS_Status=1");
    while($fetchprodid=mysql_fetch_array($queryprodname)){
    $matchingids.=$fetchprodid['PS_Id'].',';
    }
    $matchingids=substr($matchingids,0,-1);
    if($searchkey!='')
    {
    // Based On Keyword, Display
    $findproductmatch     = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Display AND PS_Status=1", $searchkey);

    $findkeywordmatch     = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Keyword", $searchkey);
    $finddisplaymatch     = get_Search_Id(TABLE_PRODUCTSERVICE, "PS_Id", "PS_Display AND PS_Status=1", $searchkey);

    if($findproductmatch!='' || $findkeywordmatch!='' || $finddisplaymatch!='' )
    {
    $con = " AND (PS_Display=''";
    if($findproductmatch!='')
    {
    $con .=" OR ";
    $con .="PS_Fk IN (".$findproductmatch.")";
    }
    if($findkeywordmatch!='')
    {
    $con .=" OR ";
    $con .="PS_Id IN (".$findkeywordmatch.")";
    }
    if($finddisplaymatch!='')
    {
    $con .=" OR ";
    $con .="PS_Id IN (".$finddisplaymatch.")";
    }
    $con .= ")";
    }
    else
    $con = "AND PS_Display=''";
    }

    if($citymatchdata!=''){
    $searchquery=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk IN (".$citymatchdata.") $con");
    $searchquery1=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk IN (".$citymatchdata.") $con");
    $searchquery2=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk IN (".$citymatchdata.") $con");
    $searchquery3=db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk IN (".$citymatchdata.") $con");

    $countresult=mysql_num_rows($searchquery);
    while($fetchquery=mysql_fetch_array($searchquery1)){
    $relatedsearch.=$fetchquery['PS_Id'].',';
    }
    while($fetchquery1=mysql_fetch_array($searchquery3)){
    $relatedsearch1.=$fetchquery1['PS_Fk'].',';
    }
    }}
    $relatedsearch=substr($relatedsearch, 0, -1);
    $relatedsearch1=substr($relatedsearch1, 0, -1);
    }

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
    if($requestType=='company'){?>
<!--adleft_container-->
<div class="adleft_container">
    <div style="width:100%;height:40px;float:left;" align="right"></div>
    <!--250-->
    <div style="width:250px;height:auto;float:left;">
        <!--relatedsearch-->
        <div class="adrelatedsearch">
            <div id="relatedresultsbox" style="display:<?php if($searchkey=='' ){echo 'none';} else echo 'block'; ?>" >
                <div class="adleftaccordiaon_top" >Related Searches</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                        <?php if($requestType=='company'){ if($_REQUEST['type2']==1){ getKeywordCompListFromSearchedCompany($_REQUEST['searchkey']); }  if($_REQUEST['type2']==2){ getKeywordListFromSearchedIndustry($_REQUEST['searchkey']);}if($_REQUEST['type2']==3){  getKeywordCompListFromSearchedKeyword($_REQUEST['searchkey']);}} //getRelatedSearchComp($relatedsearch,$finaldetails,$findcitymatch,$findareamatch);?>
                    </ul>
                </div>
            </div>
            <div id="featuredlistings" style="display:<?php if($searchkey=='' ){echo 'block';} else echo 'none'; ?>" >
                <div class="adleftaccordiaon_top" >Featured Companies</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                        <?php
                            if ($requestType=='company'){
                            list_featured();
                            }
                            ?>
                    </ul>
                </div>
            </div>
            <div class="adleftaccordion_btm" ></div>
        </div>
        <!--relatedsearch-->
    </div>
    <!--250-->
    <!--740-->
    <div style="position:absolute; left:320px; top:150px;" align="center">

    <fieldset style="width:650px;">
    <legend style="font-size:18px;">Advance Search</legend>

    <table width="600" border="0" cellpadding="5" cellspacing="5" align="center">
      <tr>
        <td colspan="3" align="right">
        <input id="searchsubmit" type="button" onClick="window.location.href='index.php'" value="<< BACK" class=""/>    </td>
      </tr>

      <tr>
        <td width="129">Company Name
        <span style="color:#F00;">*</span> </td>
        <td width="17">:</td>
        <td width="404" align="left">

    <div class="comp_content">

    <input type="text" class="comp_search" id="comp_searchid" placeholder="Search for Company Name" />
    <div id="SearchListRes" style="left:224px;width:260px!important;"></div>
    <input type="hidden"  id="c_name" name="c_name" />

    <input type="hidden" id="comp_id" name="comp_id"/>

    <input type="hidden" id="Sector_id" name="Sector_id"/>

    <div id="comp_result"></div>
    </div>    </td>
      </tr>
      <tr style="display:none;">
        <td>Product Name</td>
        <td>:</td>
        <td width="404" align="left">
            <div class="content">
    <input type="text" class="search_pro" id="searchid" placeholder="Search for Product" />
    <div id="SearchListPro" style="left:224px;width:260px!important;"></div>
    <div id="result"></div>
    </div>    </td>
      </tr>
      <tr>
        <td>Industry</td>
        <td>:</td>
        <td>


     <input type="text" id="Sector_name" name="Sector_name" style="width:260px; height:25px; display:none;"/>

    <select name="Sector" id="Sector" class="inp-text" style="width:260px; height:28px;">
    <option value="">--Select Industry--</option>
    <?php $SelectSector=db_query("Select Id,S_Name From ".TABLE_SECTOR." WHERE Status=1 order by S_Name asc");
    while(list($MSeId,$MSeName)=db_fetch_array($SelectSector))
    {?>
    <option  value="<?php echo $MSeId; ?>"  ><?php echo $MSeName; ?></option><?php
    }?>
    </select>    </td>
      </tr>
      <tr>
        <td>City</td>
        <td>:</td>
        <td>

    <?php /*?> <select name="SelCountry" style="display:none;" id="SelCountry" onChange="return OnclickCountry(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');"  class="inp-text" >
    <?php $SelectCountry=db_query("Select Id,Country_Name From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1 order by  Country_Name asc");
    while(list($MCId,$MCName)=db_fetch_array($SelectCountry))
    {?>
    <option  value="<?php echo $MCId; ?>" ><?php echo $MCName; ?></option><?php
    }?>
    </select><?php */?>

     <!--<input type="text" id="state_name" name="state_name" style="width:260px; height:25px; display:none;"/>-->
     <select id="search_city" name="search_city" class="memberinput" style="width:260px; height:25px;" onChange="GET_City(this.value);">
       <option value="" selected="selected">--Select City--</option>
       <?php
    $SelectArea=db_query("Select Id, Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='1' Order by Id asc");
    while(list($Id,$Area)=db_fetch_array($SelectArea))
    { ?>
       <option  value="<?php echo $Id; ?>"><?php echo $Area; ?></option>
       <?php } ?>
     </select>
     <input type="hidden" value="<?php getCitydetails($comp_city);?>" name="comp_city" id="comp_city" />    </td>
      </tr>
      <tr>
        <td>Area</td>
        <td>:</td>
        <td>

    	<!--<input type="text" id="city_name" name="city_name" style="width:260px; height:25px; display:none;"/>-->

    	<span id="ShowAreaList"><select id="Area" style="width:260px; height:25px;" name="Area"><option value="">--Select Area--</option></select>
    	<input type="hidden" name="city_name" id="city_name" value="" /></span>	</td>
      </tr>


      <tr>

        <td colspan="3" align="center" >

    <input id="searchsubmit" type="button" onClick="Searchpage();" value="Search" class="btnstyle" style="margin-right:30px;" /></td>
      </tr>
    </table>
    </fieldset>


    </div>
</div>
<!--adleft_container-->
<?php }
    if($requestType=='bestdeals'){?><!--adleft_container-->
<div class="adleft_container">
    <div style="width:100%;height:55px;float:left;" align="right">
  <!--       <div class="post_anadd">
            <a <?php  if(isset($_SESSION['LID'])){?> target="_blank"  href="<?php echo 'ManageProfile.php?user='.base64_encode($_SESSION['Type']);?>" <?php } else {?> class="pop firstviewmore" onclick="Postafreead();" <?php }?> title="View More" style="text-decoration: none;">
                <div class="post_addtxt">Post a Free Ad</div>
                <div class="post_findtxt">To find your Best Deal</div>
            </a>
        </div> -->
    </div>
    <!--250-->
    <div style="width:250px;height:auto;float:left;">
        <!--relatedsearch-->
        <div class="adrelatedsearch">
            <div id="relatedresultsbox" style="display:<?php if($searchkey=='' ){echo 'none';} else echo 'block'; ?>" >
                <div class="adleftaccordiaon_top" >Related Searches</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                        <?php if($requestType=='bestdeals') { getRelatedSearchBestdeals($relatedsearch,$relatedsearch1,$citymatchdata); } ?>
                    </ul>
                </div>
            </div>
            <div id="featuredlistings" style="display:<?php if($searchkey=='' ){echo 'block';} else echo 'none'; ?>" >
                <div class="adleftaccordiaon_top" >Featured Products</div>
                <div style="width:245px;height:auto;border:1px solid #C0C0C0;" >
                    <ul class="relatedsearch_ul">
                        <?php
                            if ($requestType=='bestdeals'){
                            list_featured_product();
                            }
                        ?>               
                    </ul>
                </div>
            </div>
            <div class="adleftaccordion_btm" ></div>
        </div>
        <!--relatedsearch-->
    </div>
    <!--250-->
        <div style="position:absolute; left:320px; top:150px;" align="center">

    <fieldset style="width:650px;">
    <legend style="font-size:18px;">Advance Search</legend>

    <table width="600" border="0" cellpadding="5" cellspacing="5" align="center">
      <tr>
        <td colspan="3" align="right">
        <input id="searchsubmit" type="button" onClick="window.location.href='index.php'" value="<< BACK" class=""/>    </td>
      </tr>

      <tr style="display:none;">
        <td width="129">Company Name </td>
        <td width="17">:</td>
        <td width="404" align="left">

    <div class="comp_content">

    <input type="text" class="comp_search" id="comp_searchid" placeholder="Search for Company Name" />
    <div id="SearchListRes" style="left:224px;width:260px!important;"></div>
    <input type="hidden"  id="c_name" name="c_name" />

    <input type="hidden" id="comp_id" name="comp_id"/>

    <input type="hidden" id="Sector_id" name="Sector_id"/>

    <div id="comp_result"></div>
    </div>    </td>
      </tr>
      <tr>
        <td>Product Name
        <span style="color:#F00;">*</span>
        </td>
        <td>:</td>
        <td width="404" align="left">
            <div class="content">
    <input type="text" class="search_pro" id="searchid" placeholder="Search for Product" />
    <div id="SearchListPro" style="left:224px;width:260px!important;"></div>
    <div id="result"></div>
    </div>    </td>
      </tr>
      <tr>
        <td>Industry</td>
        <td>:</td>
        <td>


     <input type="text" id="Sector_name" name="Sector_name" style="width:260px; height:25px; display:none;"/>

    <select name="Sector" id="Sector" class="inp-text" style="width:260px; height:28px;">
    <option value="">--Select Industry--</option>
    <?php $SelectSector=db_query("Select Id,S_Name From ".TABLE_SECTOR." WHERE Status=1 order by S_Name asc");
    while(list($MSeId,$MSeName)=db_fetch_array($SelectSector))
    {?>
    <option  value="<?php echo $MSeId; ?>"  ><?php echo $MSeName; ?></option><?php
    }?>
    </select>    </td>
      </tr>
      <tr>
        <td>City</td>
        <td>:</td>
        <td>

    <?php /*?> <select name="SelCountry" style="display:none;" id="SelCountry" onChange="return OnclickCountry(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');"  class="inp-text" >
    <?php $SelectCountry=db_query("Select Id,Country_Name From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1 order by  Country_Name asc");
    while(list($MCId,$MCName)=db_fetch_array($SelectCountry))
    {?>
    <option  value="<?php echo $MCId; ?>" ><?php echo $MCName; ?></option><?php
    }?>
    </select><?php */?>

     <!--<input type="text" id="state_name" name="state_name" style="width:260px; height:25px; display:none;"/>-->
     <select id="search_city" name="search_city" class="memberinput" style="width:260px; height:25px;" onChange="GET_City(this.value);">
       <option value="" selected="selected">--Select City--</option>
       <?php
    $SelectArea=db_query("Select Id, Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='1' Order by Id asc");
    while(list($Id,$Area)=db_fetch_array($SelectArea))
    { ?>
       <option  value="<?php echo $Id; ?>"><?php echo $Area; ?></option>
       <?php } ?>
     </select>
     <input type="hidden" value="<?php getCitydetails($comp_city);?>" name="comp_city" id="comp_city" />    </td>
      </tr>
      <tr>
        <td>Area</td>
        <td>:</td>
        <td>

        <!--<input type="text" id="city_name" name="city_name" style="width:260px; height:25px; display:none;"/>-->

        <span id="ShowAreaList"><select id="Area" style="width:260px; height:25px;" name="Area"><option value="">--Select Area--</option></select>
        <input type="hidden" name="city_name" id="city_name" value="" /></span> </td>
      </tr>
      <tr>
        <td colspan="3" align="center" >

    <input id="searchsubmit" type="button" onClick="Searchpage();" value="Search" class="btnstyle" style="margin-right:30px;" /></td>
      </tr>
    </table>
    </fieldset>


    </div>
    <!--740-->

</div>
<!--adleft_container-->
<?php }?>
