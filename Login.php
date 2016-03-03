<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link rel="icon" href="images/favicon.ico">
<?php include("ScriptStyle.php");?>
<link href="css/login.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body onload="document.LoginForm.UserName.focus();Disappear();" class="background">
<script type="text/javascript">
function ValidateLogin()
{
if(DocId('UserName').value=='')
{
alert("Please Enter the User Name / Email Id / Mobile Number");	
DocId('UserName').focus();
return false;
}
else if(DocId('PassWord').value=='')
{
alert("Please Enter the Password");	
DocId('PassWord').focus();
return false;
}
	
}
</script>

<div id="wrap">
<?php include("OuterHeader.php");?>
<div class="clear"></div>
<div class="clear"></div>
<div style="width:990px;min-height:687px;height:auto;margin-left:auto;margin-right:auto;">
<div align="center" style="width:990px;height:82px; margin-top:40px;"><a href="index.php" style="border:none;text-decoration:none;"><div style="font-weight: bold; margin-top: 80px; font-family: Trebuchet MS; font-size: 80px;text-shadow: 4px 4px #000000;"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:55px;">.COM</span></div></a></div>
<div id="personal" style="width:990px; padding-bottom:90px;margin-top:40px;">
<form id="LoginForm" name="LoginForm"  method="post" action="Login.php" onsubmit="return ValidateLogin();">
<h1>Sign In</h1>
<div class="validation text-align-c" id="msgdisplay"><?php if($_REQUEST["msg"]=="1") { ?>Invalid Username or Password!<?php }?></div>
<div style="height:15px;"></div>
<fieldset id="inputss" style="background:none;">
<input id="UserName" name="UserName" type="text" placeholder="Username / Email Id / Mobile Number" autofocus autocomplete="off" />   
<input id="PassWord" name="PassWord" type="password" placeholder="Password"  autocomplete="off" />
</fieldset>
<fieldset id="actions" style="background:none;margin: 9px 0 0;">


<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><input type="submit" id="Submit" name="Submit" value="Sign In"></td>
    <td>&nbsp;&nbsp;</td>
    <td><input type="button" id="CCancel" name="CCancel" value="Cancel" onclick="window.location.href='index.php'" /></td>
<td>&nbsp;&nbsp;</td><td><a href="ForgotPassword.php">Forgot your password?</a></td>

  </tr>
</table>


</fieldset>
</form>
</div>
</div>
<div class="clear"></div>

</div>
<?php include("Footer.php");?>
</body>
</html>
<?php
if($_REQUEST['Submit']=='Sign In')
{
$Username = $_REQUEST['UserName'];
$Password = base64_encode($_REQUEST['PassWord']);
	
$Check  = db_query("SELECT RGT_PK,RGT_Type,RGT_UserName FROM ".TABLE_REGISTRATION." WHERE (RGT_UserName='".$Username."' || RGT_Email='".$Username."' || RGT_Mobile='".$Username."') AND RGT_Password='".$Password."' AND RGT_Status='1' AND RGT_Type='2' ");
if(db_num_rows($Check)>0)
{
list($Lid,$Type,$UserName)=db_fetch_array($Check);	
$_SESSION['LID']= $Lid;
$_SESSION['Type']= $Type;
$_SESSION['UserName']= $UserName;
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_onlinestatus='1' WHERE RGT_PK='".$_SESSION['LID']."'");
header("Location:ManageProfile.php");
}
else
header("Location:Login.php?msg=1");
}
?>
