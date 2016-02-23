<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
require_once ('../../Mailer/class.phpmailer.php');

$UId              = trim($_SESSION['LID']);
$OldPassword	 = $_REQUEST['OldPassword'];
$NewPassword	 = $_REQUEST['NewPassword']; 
$ConfirmPassword = $_REQUEST['ConfirmPassword'];
	
$SelPass=db_query("SELECT RGT_Password,RGT_UserName,RGT_CompName,RGT_Email FROM ".TABLE_REGISTRATION." WHERE RGT_PK = '".$UId."' AND RGT_Type=2");
$FetPass=db_fetch_array($SelPass);
$Pass=base64_decode($FetPass['RGT_Password']);

if($Pass == $OldPassword)
{
$NewPass = base64_encode($NewPassword);	
$UpdateNewPassword=db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Password ='".$NewPass."' WHERE RGT_PK = '".$UId ."'");
$ToName      = $FetPass['RGT_CompName'];
$UserName    = $FetPass['RGT_UserName'];
$Password    = $NewPassword;
$ToEmail     = $FetPass['RGT_Email'];
$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;padding-bottom:10px;'>
<tr><td colspan='2' height='10'></td></tr>
<tr><td colspan='2' style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
<tr><td colspan='2' style='padding-left:20px;'>Your password has been successfully changed. Please note the following current credential details.</td></tr>
<tr><td colspan='2' style='padding-left:20px;font-weight:bold;'>Username : ".$UserName."</td></tr>
<tr><td colspan='2' style='padding-left:20px;font-weight:bold;'>Password : ".$Password."</td></tr>
</table>";

$mailContent = file_get_contents("../../MailTemplate.php");
$Message = str_replace('MSGCONTENT',$Message, $mailContent);
$Message = str_replace('images/',HTTP_SERVER.'images/', $Message);
//echo $Message;
$Subject='Password Change';
$ToAddress=$ToEmail;
$ToName=$ToName;
$FromName='Tracemein';
$FromAddress='services@tracemein.com';
PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,$Attachmenttemp,$Attachment);
echo 'Password Changed Successfully';
}
else
echo 'Your Entered Old Password is Wrong';



?>