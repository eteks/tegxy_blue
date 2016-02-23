<?php  include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
include("../../../Mailer/class.phpmailer.php");
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$_REQUEST['status'] = (isset($_REQUEST['status']) ? $_REQUEST['status'] : '');
$ModuleId = $_REQUEST['ModuleId'];
$fileName = $_REQUEST['fileName'];
$Status   = $_REQUEST['action'];
$BId      = $_REQUEST['id'];
$StatusVal  =$_REQUEST['status'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);


if ($Status=="status")
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Status='".$StatusVal."' WHERE RGT_PK='".$BId."' ");

if($StatusVal==1)
{
$Details = db_query("SELECT RGT_Email,RGT_UserName,RGT_Password,RGT_Name FROM ".TABLE_REGISTRATION." WHERE RGT_PK='".$BId."' AND RGT_Status=1");
$FetDetails = db_fetch_array($Details);

$ToAddress = $FetDetails['RGT_Email'];
$ToName    = $FetDetails['RGT_Name'];
$UserName  = $FetDetails['RGT_UserName'];
$Password  = $FetDetails['RGT_Password'];

$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;padding-bottom:10px;'>
<tr><td height='10'></td></tr>
<tr><td style='color:#006DB8;font-size:15px;'>Hi ".$ToName.",</td></tr>
<tr><td ><p>We are happy to welcome you to the tracemein.com family. Your registration process is completed and you are now a member in the family.</p><p>The following is your credentials</p></td></tr>
<tr><td >
<table width='100%' border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;>
<tr>
<td width='20%'>Username</td>
<td width='3%'>:</td>
<td width='77%'>".$UserName."</td>
</tr>
<tr>
<td width='20%'>Email Id</td>
<td width='3%'>:</td>
<td width='77%'>".$ToAddress."</td>
</tr>
<tr>
<td width='20%'>Password</td>
<td width='3%'>:</td>
<td width='77%'>".base64_decode($Password)."</td>
</tr>
</table>
</td></tr>
</table>";


$mailContent = file_get_contents("../../../MailTemplate.php");
$Message = str_replace('MSGCONTENT',$Message, $mailContent);
$Message = str_replace('../../../images/',HTTP_SERVER.'../../../images/', $Message);
$Subject='Confirmation Mail';
$FromName='Tracemein';
$FromAddress='services@tracemein.com';
PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,'','');
}

$Password='Yes';
$all_Sql = "SELECT RGT_PK, RGT_Name,RGT_UserName,RGT_Password,RGT_Status FROM ".TABLE_REGISTRATION." ";
$orderBy = ' RGT_PK ';
$WhereCont = ' where RGT_Type=1 ';

$gridHead = 'Personal';
$colHead  = array("Sl.No.", "Name","User Name","Password","Status","","","Details");
include_once('../../Nm_seven_col_grid.php');
?>


