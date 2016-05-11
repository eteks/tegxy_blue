<?php 
//$LID = 0;
if(isset($_SESSION['LID']))
{

$SP = 'Logout.php';
$SPT = 'Sign Out';
}
else
{
$SP = 'Login.php';
$SPT = 'Sign In';
}
$Chk = "RGT_PK='".$_SESSION['LID']."'";

$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE ".$Chk." AND RGT_Type!=1");
$FetProfileDetails = db_fetch_array($ProfileDetails);


?>
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

<div id="header">
<div id="top">
<div id="topadd"><a href="index.php" style="text-decoration:none;"><div id="toplogo"><div style="font-weight: bold; margin-top: 30px; font-family: Trebuchet MS; font-size: 40px;text-shadow: 2px 2px #000000;" id="toplogo"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:30px;">.COM</span></div></div></a></div></div>
<div id="logo"><table width="600" height="55" cellpadding="0" style="margin-left:auto;margin-right:auto;"><tr><td valign="middle"><a href="<?php echo $FetProfileDetails['RGT_CompName'] ;?>"><?php echo $FetProfileDetails['RGT_CompName'] ;?></a></td></tr></table></div>
<div id="topright">
<div id="sign"><p><a href="<?php echo $SP;?>"><?php echo $SPT ;?></a></p></div>
<?php if($_SESSION['LID']==''){?><div id="register"><p><a href="Register.php">Register</a></p></div><?php }else { if($_SESSION['Type']==2 && $FetProfileDetails['RGT_PaymentStatus']==1){?><div id="ProfileVieww"><p><a href="<?php echo $FetProfileDetails['RGT_ProfileUrl'] ;?>" target="_blank">View Profile</a></p></div><?php }}?>
</div>
</div>