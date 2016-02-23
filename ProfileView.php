<?php
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
if(isset($_SESSION['UserName'])){
    $_SESSION['chatuser'] = $_SESSION['LID'];
    $_SESSION['chatuser_name'] = $_SESSION['UserName'];
}

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
//to find count

if($_REQUEST['user']!='' && $_SESSION['LID']!='' ){
$userip=getRealIPAddr();
$profileuserid=find_profile_id($_REQUEST['user']);

track_page_visits($profileuserid,$_REQUEST['user'],$userip);
}


$pageusername=find_page_username($_REQUEST['user']);
$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE ".$Chk." AND RGT_Type=2");
$FetProfileDetails = db_fetch_array($ProfileDetails);
if($_REQUEST['user'])
$LID = $FetProfileDetails['RGT_PK'];
if($LID=='')
header("Location:Login.php");
$Logo=db_query("SELECT LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk ='".$LID."'");
$Logo_Fetch = db_fetch_array($Logo);

$sessionuserprofile=find_user_url($_SESSION['LID']);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link rel="stylesheet" href="css/frontpage.css" type="text/css" />
<!--SCRIPT FILES---------------------------->
<!--------slide up/down----------->
<script src="js/jquery-1.5.2.js"></script>
<script type="application/javascript">
var $j = jQuery.noConflict();
$j(document).ready(function(){
$j("#myButton").toggle(function(){
    $j("#slideimg").slideUp();
    $j(this).css("background-image", "url(images/show-panel.png)");
},function(){
	$j("#slideimg").slideDown();
    $j(this).css("background-image", "url(images/hide-panel.png)");
})
});
</script>
<!---------slide up/down--------------->


<!---------chat script css--------------->
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />

<!---------chat script css  ends --------------->



<!------------------------HIGJSLIDE GALLERY PAGE---------------------------->
<script type="text/javascript" src="highslide/highslide-with-gallery.js"></script>
<link rel="stylesheet" type="text/css" href="highslide/highslide.css" />
<script type="text/javascript">


hs.graphicsDir = 'highslide/graphics/';
hs.align = 'center';
hs.transitions = ['expand', 'crossfade'];
hs.outlineType = 'rounded-white';
hs.fadeInOut = true;
hs.dimmingOpacity = 0.75;
hs.useBox = true;
hs.width = 800;
hs.height = 600;



// Add the controlbar
hs.addSlideshow({
	//slideshowGroup: 'group1',
	interval: 5000,
	repeat: true,
	useControls: true,
	fixedControls: 'fit',
	overlayOptions: {
		opacity: 0.75,
		position: 'bottom center',
		hideOnMouseOut: false
	}
});
</script>
<!------------------------HIGJSLIDE GALLERY PAGE---------------------------->


<!------------LOGIN FORM---------------->
<script type="text/javascript">
var $login = jQuery.noConflict();
$login(document).ready(function(){
	$login('#login-trigger').click(function(){
		$login(this).next('#login-content').slideToggle();
		$login(this).toggleClass('active');

		if ($login(this).hasClass('active')) $login(this).find('span').html('&#x25B2;')
			else $login(this).find('span').html('&#x25BC;')
		})
});
</script>
<!------------LOGIN FORM---------------->




<!------------------------SCRIPT FILES---------------------------->
</head>
<body>
<div id="maincontainer">
    <div id="toplogo"><div id="toplogo" style="font-weight: bold; margin-top: 30px; font-family: Trebuchet MS; font-size: 40px;text-shadow: 2px 2px #000000;"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:30px;">.COM</span></div></div><!-- cursor:pointer; onclick="window.open('index.php','_self')" href="index.php"-->
<div id="title"><table width="600" height="45" cellpadding="0" style="margin-left:auto;margin-right:auto;"><tr><td valign="middle"><a href="index.php" style="text-decoration:none;"><h1><?php echo $FetProfileDetails['RGT_CompName'] ;?></h1></a></td></tr></table></div> <!-----login---->
<div class="login">
<?php if($_SESSION['LID']==''){ ?>
<nav>
<ul>
<li id="login">
<a id="login-trigger" href="#">
<img src="images/login.png" style="position:relative;top:15px;"/>
</a>
<div id="login-content">
<form  method="post" action="Login.php" onSubmit="return ValidateLogin();">
<fieldset id="inputs" style="border:none;">
<input id="UserName" class="loginfont" name="UserName" type="text" placeholder="Username / Email Id / Mobile Number" autofocus autocomplete="off" />
<input id="PassWord"  class="loginfont" name="PassWord" type="password" placeholder="Password"  autocomplete="off" />
</fieldset>
<fieldset id="actions" style="border:none;">
<input type="submit" id="Submit" name="Submit" value="Sign In">					</fieldset>
</form>
</div>
</li>
</ul>
</nav>
<?php }else{?>
<nav>
<ul>
<li id="login">
<a id="login-trigger" href="Logout.php">Sign Out</a>
<?php if($_SESSION['Type']==2){?>
<a id="login-trigger" href="ManageProfile.php" target="_blank">Admin</a>           <?php }?>
</li>
</ul>
</nav>
<?php }?>
</div>
<!-----login---->
</div>

<div id="Profile_View_Grid">
<?php  include("ProfileViewajax.php");?>
</div>
<?php
if($_SESSION['LID']!=''){
if($sessionuserprofile!=$_REQUEST['user']){
    ?>
    <!-- script to online get status -->
<script>
setInterval("find_user_online(<?php echo $LID; ?>)", 5000); // Update every 10 seconds
</script>

<!-- script to online get status end -->
    <?php
$useronlinestatus=find_user_online($_REQUEST['user']);
?>
<a id="onlinestatusmessage" href="javascript:void(0)" onclick="chatWith('<?php echo $LID; ?>','<?php echo $pageusername; ?>');"><div id="iamonline" onmouseover="importJavascript('js/chat.js')" style="z-index:1261;width:143px;height:74px;position:fixed;right:0;top:25%;background-image: url(images/<?php if($useronlinestatus=='0'){echo 'iamoffline';}else {echo 'iamonline';}?>.png);"></div></a>
<?php }} ?>

</body>



<?php include("ProfileFooter.php");
if($_SESSION['LID']!=find_user_url($_REQUEST['user'])){?>
<script type="text/javascript" src="js/chat.js"></script>
<?php } ?>
</html>
