<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link rel="stylesheet" href="css/ad.css" type="text/css" />
<script src="js/jquery-1.5.2.js"></script>
<script type="text/javascript" src="js/jsapi.js"></script>
<script type="text/javascript" src="js/Common.js"></script>
<script type="text/javascript" src="js/Register.js"></script>
<script type="text/javascript" src="http://www.google.com/jsapi"></script>
</head>
<style type="text/css">
#ListCityRes{
	border : 1px solid #8789E7;
	background : #FFFFFF;
	position:absolute;
	display:none;
	padding:2px 0px;
	top:auto;
	font-family :verdana;
	font-size:12px;
	width: 280px !important;
	overflow-x: hidden;
	overflow-y: auto;
	height:130px;
	z-index:100;
}

#ListCityRes .list {
	width: 280px;
	padding:0px 0px;
	margin:0px;
	list-style : none;
}
#SearchListRes,#SearchListPro{
	border : 1px solid #8789E7;
	background : #FFFFFF;
	position:absolute;
	display:none;
	padding:2px 0px;
	top:auto;
	font-family :verdana;
	font-size:12px;
	width: 605px !important;
	overflow-x: hidden;
	overflow-y: auto;
	height:130px;
	z-index:100;
}

#SearchListRes .list,#SearchListPro .list {
	width:605px;
	padding:0px 0px;
	margin:0px;
	list-style : none;
}
.list li a{
	text-align : left;
	padding:2px 4px;
	cursor:pointer;
	display:block;
	text-decoration : none;
	color:#000000;
}
.selected{
	background : #CCCFF2;
}
.bold{
	font-weight:bold;
	color: #131E9F;
}

</style>
<body class="background">
<?php include("OuterHeader.php");?>
<div class="main_container">
<div class="top_menu">
<div class="adlogo"><a href="index.php"><div style="font-weight: bold; margin-top: 5px; font-family: Trebuchet MS; font-size: 40px;text-shadow: 2px 2px #000000;" id="toplogo"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:30px;">.COM</span></div></a></div>
<!-- <div style="width:250px;height:20px;padding-top:13px;float:left;margin-left:10px;">
<a onclick="Togglecity();" id="cityvalue" ></a>
<input name="userCity" id="userCity"  type="hidden"  />
<input name="type2" id="type2"  type="hidden" value="<?php //echo $_REQUEST['type2'] ;?>"  />

<input name="userCityselect" placeholder="Select City" autocomplete="off" id="userCityselect"  type="text"  value="" style="width:280px;height:20px;border:1px solid #C8C8C8;color:#000000; display:none;" /><div id="ListCityRes"></div>
<input type="hidden" name="citylisthidden" id="citylisthidden" value="" />
<div id="citysuggestions" style="display: none;"> <div style="position: relative; width: 260px;  max-height: 300px; z-index: 9999; display: block;background: none repeat scroll 0 0 #FFFFFF;text-align:left;list-style: none outside none;border: 1px solid rgba(0, 51, 255, 0.5);cursor:pointer;" id="citysuggestionlist"> &nbsp; </div></div>
<span style="display:none;">Select Area in <span id="citydisplayname"  >Pondicherry</span>?</span>
</div> -->
<!-- <div style="width:200px;height:20px;padding-top:13px;float:left;margin-left:100px;">
<select name="selectarea" id="selectarea"  style="border:none;color:#007088;background:#F4F4F4;text-align: right;" >
	<?php
// 	$cityyidd=get_Search_Id(TABLE_GENERALAREAMASTER,"Id","Area",$_REQUEST['usercity']);
//     if($cityyidd!='')
// 	$cityyidd = $cityyidd;
// 	else
// 	$cityyidd =1;
// 	$queryarea=db_query("SELECT AM_Id, AM_Area, AM_Status  FROM ".TABLE_AREAMASTER." WHERE AM_City ='".$cityyidd."' ");
// echo '<option>Select Area in '.CityName($cityyidd).'</option>';
// while($fetchquery=mysql_fetch_array($queryarea)){
// 	$selectid = ($fetchquery['AM_Id'] == $_REQUEST['userarea']) ? 'selected=selected':'';
//     echo '<option value="'.$fetchquery['AM_Id'].'" '.$selectid.'>'.$fetchquery['AM_Area'].'</option>';
//} ?>
</select>
</div> -->
</div>
<div class="admain_container">
<div id="searchResults">
<!---admain_container-------->
<?php $path=''; include("advancesearchpage.php");?>
<!---admain_container-------->
</div>
<!---adright_container-------->
<?php include("Advertisementcolumn.php");?>
<!--adright_container-------->

</div>
</div>

<?php include("Footer.php");?>
<!----------mid------------->



<!--Load Javascript-->
<script type="text/javascript">

$(function(){
$(".comp_search").keyup(function()
{
var comp_searchid = $(this).val();
//var dataString = 'comp_search='+ comp_searchid;
//alert(comp_searchid);

// if(comp_searchid!='')
// {
// 	$.ajax({
// 		type: "POST",
// 		url: "autocomplete/search.php",
// 		data: {'comp_search':comp_searchid},
// 		cache: false,
// 		success: function(html)
// 		{
// 		alert(html);
// 		$("#comp_result").html(html.RGT_CompName).show();
// 		//alert(comp_result);
// 		}
// 	});
// }return false;
});

jQuery("#comp_result").click(function(c){

	var $comp_clicked = $(c.target);
	var $comp_name = $comp_clicked.find('.comp_name').html();
	var $comp_id_show = $comp_clicked.find('.id_show').html();
	var $indus_id_show = $comp_clicked.find('.indus_show').html();
	var $indus_name_show = $comp_clicked.find('.indus_name').html();
	//var $state_name_show = $comp_clicked.find('.state_name').html();
	//var $city_name_show = $comp_clicked.find('.area_name').html();
	//alert($state_name_show);

	var decoded = $("<div/>").html($comp_name).text();
	var decoded_id = $("<div/>").html($comp_id_show).text();
	var indus_decoded_id = $("<div/>").html($indus_id_show).text();
	var indus_decoded_name = $("<div/>").html($indus_name_show).text();
	//var state_decoded_name = $("<div/>").html($state_name_show).text();
	//var city_decoded_name = $("<div/>").html($city_name_show).text();


	$('#comp_searchid').val(decoded);
	$('#c_name').val(decoded);
	$('#comp_id').val(decoded_id);
	$('#Sector_id').val(indus_decoded_id);
	$('#Sector_name').val(indus_decoded_name);
	//$('#state_name').val(state_decoded_name);
	//$('#city_name').val(city_decoded_name);
	//alert(state_name);

	$("#Sector").hide();
	//$("#SelState").hide();
	//$("#Selcity").hide();
	//$("#CityGrid").hide();

	$("#Sector_name").show();
	$("#state_name").show();
	$("#city_name").show();
	//$("#SelState").show();
	//$("#city_name").show();

});


jQuery(document).click(function(c) {
	var $comp_clicked = $(c.target);
	if (! $comp_clicked.hasClass("comp_search")){
	jQuery("#comp_result").fadeOut();
	}
});

$('#comp_searchid').click(function(){
	jQuery("#comp_result").fadeIn();
});
});


$(function(){
$(".search_pro").keyup(function()
{
var searchid = $(this).val();
//alert(searchid);
var comp_name = $('#c_name').val();
//alert(comp_name);
var c_id = $('#comp_id').val();
//alert(c_id);
if(comp_name !="") {
var dataString = 'search='+searchid+"&c_name="+c_name+"&c_id="+c_id;
}
else { var dataString = 'search='+searchid;  } //alert(dataString);
if(searchid!='')
{
	$.ajax({
	type: "POST",
	url: "autocomplete/search.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#result").html(html).show();
	//alert(result);
	}
	});
}return false;
});


jQuery("#result").click(function(e){
	var $clicked = $(e.target);
	var $name = $clicked.find('.name').html();
	var decoded = $("<div/>").html($name).text();
	$('#searchid').val(decoded);
});
jQuery(document).click(function(e) {
	var $clicked = $(e.target);
	if (! $clicked.hasClass("search")){
	jQuery("#result").fadeOut();
	}
});
$('#searchid').click(function(){
	jQuery("#result").fadeIn();
});
});







$(function (){
$('#Sector').change(function()
{
var industry_id = $(this).val();
//alert(industry_id);
var dataString = 'industry='+ industry_id;
//alert(dataString);

if(industry_id!='')
{
	$.ajax({
	type: "POST",
	url: "autocomplete/search.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#industry_result").html(html).show();
	//alert(comp_result);
	}
	});
}return false;
});

});



$(function (){
$('#SelState').change(function()
{
var state_id = $(this).val();
//alert(state_id);
var dataString = 'state='+ state_id;
//alert(dataString);

if(state_id!='')
{
	$.ajax({
	type: "POST",
	url: "autocomplete/search.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#state_result").html(html).show();
	}
	});
}return false;
});

});





$(function (){
$('#SelCity').change(function()
{
var city_id = $(this).val();
//alert(state_id);

var dataString = 'state='+ city_id;
//alert(dataString);

if(city_id!='')
{
	$.ajax({
	type: "POST",
	url: "autocomplete/search.php",
	data: dataString,
	cache: false,
	success: function(html)
	{
	$("#city_result").html(html).show();
	}
	});
}return false;
});

});


</script>
<script>
if(google.loader.ClientLocation)
{
    visitor_city = google.loader.ClientLocation.address.city;
	<?php if($_REQUEST['usercity']!=''){?>
    $("#userCity").val('<?php echo $_REQUEST['usercity'];?>');
	$("#cityvalue").html('<?php echo $_REQUEST['usercity'];?>');
	<?php } else
	{?>
    $("#userCity").val(visitor_city);
	$("#cityvalue").html(visitor_city);
	<?php }?>
}
else
{
alert('We are not able to choose city Please Select Manually');
}
$("#userCityselect").focusout(function(){
  $("#cityvalue").css('display','inline-block');
  $("#userCityselect").css('display','none');


});

// citysuggestions should be displayed none
//userCityselect
$("#userCityselect").focusout(function(){

     setTimeout("$('#citysuggestions').fadeOut();", 100);

});

$("#searchlist").focusout(function(){
    setTimeout("$('#suggestions').fadeOut();", 600);
});


</script>
<!--popubox content starts-->
<div class="background_overlay" style="display:none"></div>
<input type="hidden" id="FProfileLink" />
<input type="hidden" id="FProfiletype" />
<input type="hidden" id="Postafreead" />
<input type="hidden" id="FBDId" />
<div id="overlay_form" style="display:none;">
<div class="closediv" align="right"><a href="#" id="close" ><div class="closebtn"></div></a></div>
<div class="formdiv">
<div style="width:100%;height:20px;position:relative;top:85px;">
<div class="newuser" align="center"><label><input name="Radiochkselection" onClick="onclicksignin();" id="fradio" type="radio"/>Already a Member</label></div>
<div class="registrd_usr" align="center"><label><input id="sradio" onClick="onclicksignup();" name="Radiochkselection" type="radio"/>Join XYGET.com</label></div>
</div>
<div style="width:100%;height:30px;"></div>

<!-------toggle1----------->
<div class="toggle1">
<form id="Freeuserlogin">
<div id="signin">
<div style="width:230px;background:#fff;padding:20px;border-radius:10px;">
<p align="center" style="color:#F7862A;">Sign In</p>
<div id="Fmsg" style="height:20px;color:#EC4211;font-size:16px;text-shadow:1px 1px 1px #aaa;font-style:italic;"></div>
<div class="field">
<div class="labeldiv">Username:</div>
<div class="txtboxdiv"><input type="text" name="FLusername" autocomplete="off" id="FLusername" class="txtbox" /></div>
</div>

<div class="field">
<div class="labeldiv">Password:</div>
<div class="txtboxdiv"><input type="password" name="FLpassword" autocomplete="off" id="FLpassword" class="txtbox"/></div>
</div>


<div style="width:230px;height:35px;margin-top:10px;">
<input type="button" value="Sign In" onclick="FreeUserLogin();"  class="btnstylee" style="margin-left:40px;" />
<input type="button" value="Reset" onclick="FreeUserLoginReset();"  class="btnstylee" style="margin-left:20px;" />
</div>


</form>

<div class="field" style="margin-top:10px;" align="right">
<a class="forgot" href="#" id="toggle2">
<div style="width:135px;height:25px;float:right;">Forgot Password?</div><div style="width:25px;height:25px;float:right;background:url(images/forgot-password.png) no-repeat;"></div>
</a>
</div>
</div>
</div>
<div id="signup" style="pointer-events:none;">
<div style="width:230px;background:#fff;padding:20px;border-radius:10px;">
<p align="center" style="color:#F7862A;font-size:14px;">Just takes few seconds to be a part of <br/>XYGET Community</p>
<div id="FRmsg" style="height:20px;color:#EC4211;font-size:16px;text-shadow:1px 1px 1px #aaa;font-style:italic;"></div>
<form onclick='return false;' id="Freeuserreg" >
<input type="hidden" id="Fcountry" name="Fcountry"  />
<input type="hidden" id="Fcity" name="Fcity"  />
<div class="field">
<div class="labeldiv">Name:</div>
<div class="txtboxdiv"><input type="text" name="Fname" id="Fname" autocomplete="off" class="txtbox" /></div>
</div>
<div class="field">
<div class="labeldiv">Username:</div>
<div class="txtboxdiv"><input type="text" name="Fusername" id="Fusername" autocomplete="off" class="txtbox" /></div>
</div>

<div class="field">
<div class="labeldiv">Mobile No.:</div>
<div class="txtboxdiv"><input onkeyup="checkNumber(this);" type="text" autocomplete="off" name="Fmobileno" id="Fmobileno" class="txtbox" /></div>
</div>

<div class="field">
<div class="labeldiv">Email Id:</div>
<div class="txtboxdiv"><input type="text" name="FemailId" id="FemailId" autocomplete="off" class="txtbox" /></div>
</div>

<div class="field">
<div class="labeldiv">Password:</div>
<div class="txtboxdiv"><input type="password" name="Fpassword" id="Fpassword" class="txtbox" autocomplete="off" /></div>
</div>

<div class="field">
<div class="labeldiv">Confirm Password:</div>
<div class="txtboxdiv"><input type="password" name="CFpassword" id="CFpassword" class="txtbox" autocomplete="off" /></div>
</div>

<div style="width:230px;height:35px;margin-top:10px;margin-left: 20%;">
<input type="button" value="Submit" onclick="FreeUserRegister();"  class="btnstylee" />
<input type="button" value="Reset" onclick="FreeUserRegisterReset()"  class="btnstylee" />
</div>
</form>
</div>
</div>

</div>
<!-------toggle1----------->
<!-------toggle2----------->
<div class="toggle2" style="display:none;">
<p style="margin-left:auto;margin-right:auto;margin-top:-60px;text-align:center;color:#F7862A;">Forgot Password</p>
<div style="width:360px;margin-left:auto;margin-right:auto;background:#F99F57;padding:30px 40px 30px 30px;border-radius:10px;-webkit-box-shadow: 0px 0px 3px 3px #999;box-shadow: 0px 0px 3px 3px #999;">
<div style="width:330px;background:#fff;padding:20px 20px 50px 20px;border-radius:10px;">
<div id="Fgtmsg" style="height:20px;color:#EC4211;font-size:16px;text-shadow:1px 1px 1px #aaa;font-style:italic;"></div>
<form id="FreeuserFogg">
<div class="ffield">
<div class="flabeldiv">Username:</div>
<div class="ftxtboxdiv"><input type="text" name="FFusername" id="FFusername" class="txtbox" autocomplete="off" /></div>

</div>
<div style="width:330px;height:35px;margin-top:20px;margin-left: 27%;">
<input type="button" value="Submit" onclick="FreeUserForgot();" class="btnstylee" />
<input type="button" value="Cancel"  class="btnstylee" id="closeforgetpass" />
</div>
</form>
</div>
</div>
</div>
<!-------toggle2----------->


</div>
</div>

<script>
$("#toggle1,#toggle3").click(function() {
    FreeUserLoginReset();
    FreeUserRegisterReset();
  if($('#fradio').is(':checked')){
    $("#signin").css('pointer-events','none');
     $("#signup").css('pointer-events','auto');
     $('#Fname').focus();
 }
if($('#sradio').is(':checked')){
    $("#signin").css('pointer-events','auto');
     $("#signup").css('pointer-events','none');
      $('#FLusername').focus();
}


  });

  /*$("#signin").click(function(){
$("#fradio").attr("selected","selected");
onclicksignin();

$('#FLusername').focus();
 FreeUserRegisterReset();
});
$("#signup").click(function(){
$("#sradio").attr("selected","selected");
onclicksignup();
$('#Fname').focus();
FreeUserLoginReset();
});*/

$('#closeforgetpass').click(function() {
    poploginreset();
	positionPopup();
	return false;
});

$('#FreeuserFogg').bind("keyup", function(e) {
  var code = e.keyCode || e.which;
  if (code  == 13) {
   FreeUserForgot();
    return false;
  }
});


$('#Freeuserreg').bind("keyup", function(e) {
  var code = e.keyCode || e.which;
  if (code  == 13) {
   FreeUserRegister();
    return false;
  }
});

$('#Freeuserlogin').bind("keyup", function(e) {
  var code = e.keyCode || e.which;
  if (code  == 13) {
   FreeUserLogin();
    return false;
  }
});

$(document).keypress(function(e) {
    if(e.which == 13) {
        FreeUserForgot();
    }
});
$(document).delegate('#SearchListRes .list li', 'click', function(){
	//alert($(this).text());
	$('#comp_searchid').val($(this).text());
});
$(document).delegate('#SearchListPro .list li', 'click', function(){
	//alert($(this).text());
	$('.search_pro').val($(this).text());
});


</script>
<script type="text/javascript">
	$('#search_city').change(function(event) {
		//alert('dfssddfs');
		var city_id = $(this).val();
		$.ajax({
			url: 'include/BlModules/Bl_ListArea.php',
			type: 'POST',
			data: {'city_id':city_id},
			success: function(data) {
				//alert(data);
				$('#Area').empty().append(data);
			}
		})
	});
	if(google.loader.ClientLocation)
	{
		visitor_lat = google.loader.ClientLocation.latitude;
		visitor_lon = google.loader.ClientLocation.longitude;
		visitor_city = google.loader.ClientLocation.address.city;
		visitor_region = google.loader.ClientLocation.address.region;
		visitor_country = google.loader.ClientLocation.address.country;
		visitor_countrycode = google.loader.ClientLocation.address.country_code;
		document.getElementById('Fcountry').value = visitor_country;
		document.getElementById('Fcity').value = visitor_city;
	}
	else
		alert('OOPS!');
</script>
<!--popubox content ends-->
</body>
</html>
