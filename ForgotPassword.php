<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
include("Mailer/class.phpmailer.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<?php include("ScriptStyle.php");?>
<link href="css/login.css" rel="stylesheet" type="text/css" media="all" />
<link href="css/homepage.css" rel="stylesheet" type="text/css" media="all" />
</head>
<body onload="document.LoginForm.UserName.focus();Disappear();" class="background">
<script type="text/javascript">
function ValidateLogin()
{
if(DocId('UserName').value=='')
{
alert("Please Enter the Username");	
DocId('UserName').focus();
return false;
}


}
</script>
<div id="wrap">
<?php include("OuterHeader.php");?>
<div class="clear"></div>
<div class="clear"></div>
<div style="width:990px;height:auto;margin-left:auto;margin-right:auto;">
<div align="center" style="width:990px;height:82px; margin-top:40px;"><a href="index.php" style="border:none;text-decoration:none;"><div style="font-weight: bold; margin-top: 80px; font-family: Trebuchet MS; font-size: 80px;text-shadow: 4px 4px #000000;"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:55px;">.COM</span></div></a></div>
<div id="personal" style="width:990px; padding-bottom:90px; margin-top:40px;height:475px;">
<form id="LoginForm" name="LoginForm"  method="post" action="ForgotPassword.php" onsubmit="return ValidateLogin();">
<h1>Forgot Password</h1>
<div class="validation text-align-c" id="msgdisplay"><?php $_REQUEST['msg'] = (isset($_REQUEST['msg']) ? $_REQUEST['msg'] : ''); if($_REQUEST["msg"]=="1") { ?>Invalid Email Id / Mobile Number!<?php } if($_REQUEST["msg"]=="2") { ?>Password has been Sent to your Email Id and Mobile!<?php }?></div>
<div style="height:15px;"></div>
<fieldset id="inputss" style="background:none;">
<input id="UserName" name="UserName" type="text" placeholder="Username" autofocus autocomplete="off" />   
</fieldset>
<fieldset id="actions" style="background:none;margin: 9px 0 0;">
<table cellpadding="0" cellspacing="0" border="0">
  <tr>
    <td><input type="submit" id="Submit" name="Submit" value="Submit"></td>
    <td>&nbsp;&nbsp;</td>
    <td><input type="button" id="CCancel" name="CCancel" value="Cancel" onclick="window.location.href='Login.php'" /></td>
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

if($_REQUEST['Submit']=='Submit')
{
$Username = $_REQUEST['UserName'];
$EmailMobile = $_REQUEST['EmailMobile'];
	
$Check  = db_query("SELECT RGT_PK,RGT_Type,RGT_UserName,RGT_Password,RGT_Email,RGT_Mobile,RGT_OwnEmail,RGT_OwnMobile,RGT_CompName,RGT_OwnerName FROM ".TABLE_REGISTRATION." WHERE RGT_UserName='".$Username."' AND (RGT_Email='".$EmailMobile."' || RGT_Mobile='".$EmailMobile."' || RGT_OwnEmail='".$EmailMobile."' || RGT_OwnMobile='".$EmailMobile."') AND RGT_Status='1' AND RGT_Type!='3' ");
if(db_num_rows($Check)>0)
{
list($Lid,$Type,$UserName,$Password,$PEmail,$PMobile,$BEmail,$BMobile,$PName,$BName)=db_fetch_array($Check);	
$_SESSION['LID']= $Lid;
$_SESSION['Type']= $Type;
$_SESSION['UserName']= $UserName;

$ToEmail        = $PEmail;	
$ToName         = $PName;	
$ToMobile       = $PMobile;	

if($ToMobile!=''){
    
    
    $mainusername   =9092371237;
    $mainpassword   ='icrtwicrtw';
    $receiver   = $ToMobile;
    $message    = "Dear ".$ToName.", Your Login Name : ".$UserName.",Password : ".$Password." ";

        require 'sms/Way2Sms.php';
        $sms            =   new Way2Sms();
        $result         =   $sms->login($mainusername, $mainpassword);
        if($result) {
            $smsStatus  =   $sms->send($receiver, $message);
            if($smsStatus)
                echo "Message sent successfully!!!";
            else
                echo "Unable to send message";
            $sms->logout();
        }
        else
            echo "Invalid Username or Password";
}


$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;padding-bottom:10px;'>
<tr><td colspan='2' height='10'></td></tr>
<tr><td colspan='2' style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
<tr><td colspan='2' style='padding-left:20px;'>We had received a request for password from your account. Please refer the following</td></tr>
<tr><td colspan='2' style='padding-left:20px;font-weight:bold;'>Username : ".$UserName."</td></tr>
<tr><td colspan='2' style='padding-left:20px;font-weight:bold;'>Password : ".base64_decode($Password)."</td></tr>
</table>";

$mailContent = file_get_contents("MailTemplate.php");
$Message = str_replace('MSGCONTENT',$Message, $mailContent);
$Message = str_replace('images/',HTTP_SERVER.'images/', $Message);

$Subject='Forgot Password';
$ToAddress=$ToEmail;
$ToName=$ToName;
$FromName='Tracemein';
$FromAddress='services@tracemein.com';
PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,$Attachmenttemp,$Attachment);

header("Location:ForgotPassword.php?msg=2");
}
else
header("Location:ForgotPassword.php?msg=1");
}


 
?>