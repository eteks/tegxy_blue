<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');
if($_REQUEST['user']=='')
{
$LID = $_SESSION['LID'];
$Chk = "RGT_PK='".$LID."'";
}
else
{
$LID = $_REQUEST['user'];
$Chk = "RGT_ProfileUrl='".$LID."'";
}
$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE ".$Chk." AND RGT_Type=2");
$FetProfileDetails = db_fetch_array($ProfileDetails);
if($_REQUEST['user'])
$LID = $FetProfileDetails['RGT_PK'];
if($LID=='')
header("Location:Login.php");
$Logo=db_query("SELECT LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk ='".$LID."'");
$Logo_Fetch = db_fetch_array($Logo);
include("ScriptStyleView.php");
?>
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
<script>setInterval("update()", 5000); // Update every 10 seconds 
//to find online user status
function update() 
{ 
$.post("sessionupdate.php"); // Sends request to update.php 
} 
</script>


<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-45273681-1', 'tracemein.com');
  ga('send', 'pageview');

</script>

<div style="width:990px;margin-left:auto;margin-right:auto;">
<div id="topgrid">
<div class="profile_container">
<?php if($Logo_Fetch['LG_Logo']!=''){?>
<img width="148" height="155" src="<?php echo $Logo_Fetch['LG_Logo'];?> "  class="profimg" />
<?php } else {?><img width="148" height="155" src="images/nologo.png"  class="profimg" />
<?php } ?>
</div>
<!-------menu_container--------->
<div class="menu_container">
<div style="width:790px;height:56px;">
<div class="leftmenubg"></div>
<?php include("Navigation.php");?>
<div class="rightmenubg"></div>
</div>
</div>
<!-------menu_container---------> 
</div>
<!------slider---------->
<div id="sliderbg">
<div class="sliderimg" id="slideimg">
<div class="slider-wrapper theme-default">
<div id="slider" class="nivoSlider">
<?php 
$sqltot="SELECT GY_Image FROM ".TABLE_GALLERY." WHERE  ((GY_Type2=1) || (GY_Type=0 AND GY_Type2=1))  AND GY_UserFk='".$LID."' order by  GY_Id desc";
$SqlRun=db_query($sqltot);
$Count = db_num_rows($SqlRun);
if($Count>0){
while(list($GY_Image) = db_fetch_array($SqlRun)){?>
<img src="<?php echo $GY_Image;?>" />
<?php }} else{?><img src="Document/Gallery/Default/slide1.png" /><img src="Document/Gallery/Default/slide2.png" /><img src="Document/Gallery/Default/slide3.png" /><img src="Document/Gallery/Default/slide4.png" />
<?php }?>
</div>
</div>
</div>
<div style="width:98%;margin-left:auto;margin-right:auto;" align="right"><input type="button" value="" id="myButton" style="position:relative;background:transparent url(images/hide-panel.png) no-repeat bottom;border:none;height:12px;width:109px;top:0px;cursor:pointer;"/></div>

</div>
<!------slider---------->
</div>
