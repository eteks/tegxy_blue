<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$_SESSION['chatuser'] = $_SESSION['LID'];
$_SESSION['chatuser_name'] = $_SESSION['UserName'];
// print_r ($_SESSION['Type']);
if($_SESSION['LID']=='')
header("Location:index.php");
$LID   = $_SESSION['LID'];
$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE RGT_PK='".$LID."' AND RGT_Type!=1");
$FetProfileDetails = db_fetch_array($ProfileDetails);
$UId   = trim($_SESSION['LID']);

db_query("DELETE FROM ".TABLE_PROFILEDETAILS."  WHERE PDS_Fk='".session_id()."'");

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<?php include("ScriptStyle.php");?>
</head>
<script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
<script type="text/javascript" src="js/jquery.hoverIntent.minified.js"></script>
<script type="text/javascript" src="js/jquery.naviDropDown.1.0.js"></script>
<script type="text/javascript" src="js/ManageProfile.js"></script>
<script type="text/javascript" src="js/CalendarControl.js"></script>
<link href="css/CalendarControl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/ajaxupload.3.5.js" ></script>

<!---------chat script css--------------->
<link type="text/css" rel="stylesheet" media="all" href="css/chat.css" />
<link type="text/css" rel="stylesheet" media="all" href="css/screen.css" />

<!---------chat script css  ends --------------->

<link href="css/Profile.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(function(){
$('#navigation_vert').naviDropDown({
dropDownWidth: '165px',
orientation: 'vertical'
});
});

$(document).ready(function()
{
<?php  for($i=1;$i<=12;$i++)
{?>
	$("#OpenProfile_<?php echo $i ;?>").click(function()
	{
	<?php 
	for($j=1;$j<=14;$j++)
	{
		if($i==$j)
		{?>
		$("#Profile_<?php echo $j ;?>").show();
  <?php } 
   else {?>
   $("#Profile_<?php echo $j ;?>").hide();
   <?php }
     }?>
   });
<?php }?>
});
</script>
<body>
<div id="wrap">
<?php include("Header.php");?>
<div class="clear"></div>
<!-- Center Content-->
<div id="content">
<?php include("LeftMenu.php");?>
<input type="hidden" id="FileSize" name="FileSize"  value="<?php echo UserFileSize($UId);?>" />
<input type="hidden" id="FileSizeLimit" name="FileSizeLimit"  value="<?php echo UserFileSizeLimit($UId);?>" />
<!-- Establishment Profile -->
<div id="Profile_1"  style="display:<?php if(base64_decode($_REQUEST['user'])!=''){?>none<?php }else{ ?>block<?php }?>;" ><?php include("CompanyDetails.php");?></div>
<div id="Profile_2" style="display:none;"><?php  include("OwnerDetails.php");?></div>
<!-- Content Management -->
<div id="Profile_3"  style="display:none;"><?php  include("Profile.php");?></div>
<div id="Profile_4" style="display:none;"><?php  include("Events.php");?></div>
<!-- Image Management -->
<div id="Profile_5" style="display:none;"><?php  include("LogoUpload.php");?></div>
<div id="Profile_6" style="display:none;"><?php  include("Gallery.php");?></div>
<div id="Profile_7" style="display:none;"><?php  include("HeaderSet.php");?></div>
<div id="Profile_8"  style="display:<?php if(base64_decode($_REQUEST['user'])!=''){?>block<?php }else{ ?>none<?php }?>;"><?php  include("Product.php");?></div>
<div id="Profile_9" style="display:none;"><?php  include("ContactInfo.php");?></div>
<div id="Profile_10" style="display:none;"><?php include("ChangePassword.php");?></div>
<div id="Profile_11" style="display:none;"><?php include("companychat.php");?></div>
<div id="Profile_12" style="display:none;"><?php include("Advertisement.php");?></div>
</div>
</div>
<div class="clear"></div>
<?php include("Footer.php");?>

<!-----chat script---->
<script type="text/javascript" src="js/chat.js"></script>
<!-----chat script---->
</body>
</html>
