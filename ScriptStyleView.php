<link rel="stylesheet" href="css/frontpage.css" type="text/css" />
<link rel="stylesheet" href="css/accordion.css" type="text/css" />


<!--------vertical accordion----------->
<script type="text/javascript" src="vaccordian/jquery-1.4.3.min.js"></script>	
<!--------vertical accordion----------->
<!-----------product carousel---------->
<link rel="stylesheet" type="text/css" media="screen" href="carousel/css/CSSreset.min.css" />
<script type="text/javascript" src="carousel/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript" src="carousel/js/jquery.als-1.2.min.js"></script>
<script type="text/javascript">
var $k = jQuery.noConflict();
$k(document).ready(function()
{
$k("#lista1").als({
visible_items: 1,
scrolling_items: 1,
orientation: "horizontal",
circular: "yes",
autoscroll:"yes",
interval: 2000,
direction: "left",
start_from: 0
});
});

var $l = jQuery.noConflict();
$l(document).ready(function()
{
$l("#lista2").als({
visible_items: 1,
scrolling_items: 1,
orientation: "horizontal",
circular: "yes",
autoscroll:"yes",
interval: 2000,
direction: "left",
start_from: 0
});
});


var $k = jQuery.noConflict();
$k(document).ready(function()
{
$k("#lista3").als({
visible_items: 4,
scrolling_items: 1,
orientation: "horizontal",
circular: "yes",
autoscroll:"yes",
interval: 2000,
direction: "left",
start_from: 0
});
});
</script>
<!-----------product carousel---------->



<!----------nivo slider------->
	<link rel="stylesheet" href="nivo/themes/default/default.css" type="text/css" media="screen" />
    <link rel="stylesheet" href="nivo/nivo-slider.css" type="text/css" media="screen" />
    <script type="text/javascript" src="nivo/scripts/jquery-1.9.0.min.js"></script>
    <script type="text/javascript" src="nivo/jquery.nivo.slider.js"></script>
    <script type="text/javascript">
	var $niv = jQuery.noConflict();
    $niv(window).load(function() {
        $niv('#slider').nivoSlider();
    });

<!----------nivo slider------->
function showrow()
{
	if(document.getElementById("showtoggle").innerHTML=="SHOW ALL")
	{
   $('tr:not(.toplevel)[data-id="3"]').show();
   document.getElementById("showtoggle").innerHTML="HIDE ALL"

	}
	else
	{
	$('tr:not(.toplevel)[data-id="3"]').hide();
   document.getElementById("showtoggle").innerHTML="SHOW ALL"
	}

}
    </script>
<!----------nivo slider------->
<script type="text/javascript" src="js/Common.js" ></script>
<script type="text/javascript" src="js/View.js" ></script>
<link rel="stylesheet" href="roundslider/css/feature-carousel.css" charset="utf-8" />
<script src="roundslider/js/jquery-1.7.min.js" type="text/javascript" charset="utf-8"></script>
<script src="roundslider/js/jquery.featureCarousel.min.js" type="text/javascript" charset="utf-8"></script>
<script type="text/javascript">
var $g = jQuery.noConflict();
$g(document).ready(function() {
var carousel = $g("#carousel").featureCarousel({
autoPlay:0,
trackerIndividual:false,
trackerSummation:false
});

$g("#but_prev").click(function () {
carousel.prev();
});
$g("#but_pause").click(function () {
carousel.pause();
});
$g("#but_start").click(function () {
carousel.start();
});
$g("#but_next").click(function () {
carousel.next();
});
});
</script>

<!--------banner slider------>
<!-- Begin Events View More -->
<script type="text/javascript" >



function  ViewMoree(MoreId,ID,Grid,File,Pass,user)
{
var Type;
var SearchText;
var	Caty ;
var SubCaty ;
var User =user;
if(DocId('BDType'))
Type = DocId('BDType').value;
if(DocId('SearchArea'))
SearchText=DocId('SearchArea').value;
if(DocId('BCategory'))
Caty = DocId('BCategory').value;
if(DocId('BSubCategory'))
SubCaty = DocId('BSubCategory').value;


if(ID)
{
$("#"+MoreId).html('<img src="moreajax.gif" />');

$.ajax({
type: "POST",
url: "include/BlModules/"+File+".php?LogIdd=<?php echo $LID ;?>&Type="+Type+"&SearchText="+SearchText+"&Caty="+Caty+"&SubCaty="+SubCaty+"&User="+User,
data: "lastmsg="+ ID,
cache: false,
success: function(html){
$("#"+Grid).append(html);
$("#"+MoreId).remove();
}
});
}
else
{
$(".morebox").html('The End');

}
}

</script>
<!-- End Events View More -->

<!-----joom------->
<script src="joom/js/jquery-1.6.js" type="text/javascript"></script>
<script src="joom/js/jquery.jqzoom-core.js" type="text/javascript"></script>
<link rel="stylesheet" href="joom/css/jquery.jqzoom.css" type="text/css">
<style type"text/css">
.jqzoom{
	text-decoration:none;
	float:left;
}
ul#thumblist{display:block;}
ul#thumblist li{float:left;margin-right:2px;list-style:none;}
ul#thumblist li a{display:block;border:1px solid #CCC;}
ul#thumblist li a.zoomThumbActive{
    border:1px solid red;
}
</style>
<script type="text/javascript">
var $joom = jQuery.noConflict();
$joom(document).ready(function() {
	$joom('.jqzoom').jqzoom({
            zoomType: 'standard',
            lens:true,
            preloadImages: false,
            alwaysOn:false
        });

});
</script>
<style type="text/css">
.thumbnail{
position: relative;
z-index: 0;
cursor:url(images/zoomin.cur),auto;
}
.thumbnail:hover{
background-color: transparent;
z-index: 50;
}
.thumbnail span{ /*CSS for enlarged image*/
position: absolute;
background-color: lightyellow;
padding: 5px;
left: -1000px;
border: 1px solid #D2D2D2;
visibility: hidden;
color: black;
text-decoration: none;
top:-1000px;
width:224px;
height: 224px;
}
.thumbnail span img{ /*CSS for enlarged image*/
border-width: 0;
padding: 2px;
cursor:default;
}
.thumbnail:hover span{ /*CSS for enlarged image on hover*/
visibility: visible;
z-index: 1000;
left: 130px; /*position where enlarged image should offset horizontally */
top:-130px;
}
</style>
<!-----joom------>
<?php
$LID=(isset($LID) && !empty($LID) ? trim($LID) : '');
$EnableSql = db_query("SELECT * FROM ".TABLE_PRODUCTSERVICE." WHERE PS_User_Fk 	='".$LID."'");
$EnableSql2 = db_query("SELECT * FROM ".TABLE_GALLERY." WHERE ((GY_Type=0) || (GY_Type=1 AND GY_Type2=0))  AND GY_UserFk='".$LID."'");
$EnableSql3 = db_query("SELECT * FROM ".TABLE_EVENTS." WHERE ET_UserFk='".$LID."'");
$EnableSql4 = db_query("SELECT * FROM ".TABLE_PROFILE." WHERE PFE_CreatedBy='".$LID."'");
$EnableCount = db_num_rows($EnableSql);
$EnableCount2 = db_num_rows($EnableSql2);
$EnableCount3 = db_num_rows($EnableSql3);
$EnableCount4 = db_num_rows($EnableSql4);
$ConSize ='700px' ;
?>
<style type="text/css">
#contentcolumn{
width:<?php echo $ConSize;?>;
text-align:justify;
float:left;
margin-bottom:20px;
}
</style>

<!-----------LEFT ACCORDION-------------->
<link rel="stylesheet" type="text/css" href="css/accordion.css" />
<script src="accordion/jquery-latest.min.js" type="text/javascript"></script>
<script src="accordion/main.js" type="text/javascript"></script>
<script type="text/javascript">
var $latest = jQuery.noConflict();
$latest('#search').click(function () {
    $latest("#cssmenu").accordion({active: false}).click();
});
</script>
<!-----------LEFT ACCORDION-------------->
<style>
.supplr_menu_container
{
width:990px;
height:56px;
margin-left:auto;
margin-right:auto;
}

.leftaccordiaon_top
{
width:247px;
height:32px;
padding:10px 0px 0px 15px;
background:url(images/title_h.png) no-repeat;
color:#fff;
font-weight:bold;
font-size:16px;

}

.leftaccordion_btm
{
width:247px;
height:18px;
background:url(images/head_bottom.png) no-repeat;
margin-top:-10px;
}
</style>
