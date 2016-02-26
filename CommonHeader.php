<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');
$_REQUEST['type'] = (isset($_REQUEST['type']) ? $_REQUEST['type'] : '');
if($_REQUEST['user']=='' && base64_decode($_REQUEST['type'])=='')
{
$LID = $_SESSION['LID'];
$Chk = "RGT_PK='".$LID."'";
}
else if($_REQUEST['user']!='' && base64_decode($_REQUEST['type'])==3 )
{
$LID = $_REQUEST['user'];
$Chk = "RGT_PK='".$LID."'";
}
else
{
$LID = $_REQUEST['user'];
$Chk = "RGT_ProfileUrl='".$LID."'";
}
$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE ".$Chk." AND RGT_Type!=1");
$FetProfileDetails = db_fetch_array($ProfileDetails);
if($_REQUEST['user'])
$LID = $FetProfileDetails['RGT_PK'];
//if($LID=='')
//header("Location:Login.php");
$Logo=db_query("SELECT LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk ='".$LID."'");
$Logo_Fetch = db_fetch_array($Logo);

include("ScriptStyleView.php");?>
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

<!-------menu_container--------->
<?php if(base64_decode($_REQUEST['type'])!='3'){?>
<div class="supplr_menu_container">
<div style="width:790px;height:56px;margin-left:200px;">
<div class="leftmenubg"></div>
<?php include("Navigation.php");?>
<div class="rightmenubg"></div>
</div>
</div>
<?php }?>
<!-------menu_container--------->