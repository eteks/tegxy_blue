<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
include("../../Mailer/class.phpmailer.php");

session_start();
if($_REQUEST['action']=='1')
{
$Fusername  = trim($_REQUEST['Fusername']);
$Fmobileno  = trim($_REQUEST['Fmobileno']);
$FemailId   = trim($_REQUEST['FemailId']);
$Fpassword  = trim($_REQUEST['Fpassword']);
$FProfileLink  = trim($_REQUEST['FProfileLink']);
$FName      = trim($_REQUEST['Fname']);
$Fcountry   = getPrimaryId('Country_Name ','tbl_generalcountrymaster','Id',$_REQUEST['Fcountry']);
$Fstate     = getPrimaryId('Area','tbl_generalareamaster','A_State',$_REQUEST['Fcity']);
$Fcity      = getPrimaryId('Area','tbl_generalareamaster','Id',$_REQUEST['Fcity']);

$CheckExist = db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE (RGT_UserName='".$Fusername."' || RGT_Email='".$FemailId."')");
if(db_num_rows($CheckExist)>0)
echo '1';
else
{
db_query("INSERT INTO ".TABLE_REGISTRATION." SET RGT_UserName='".$Fusername."',RGT_Password='".base64_encode($Fpassword)."',RGT_Mobile='".$Fmobileno."',RGT_Email='".$FemailId."',RGT_RegisterOn=NOW(),RGT_Type='1',RGT_Status=1,RGT_CompName='".$FName."',RGT_Country='".$Fcountry."',RGT_State='".$Fstate."',RGT_City='".$Fcity."'");
$InsetedId=db_insert_id(); 
$_SESSION['LID']= $InsetedId;
$_SESSION['Type']= 3;
$_SESSION['UserName']= $Fusername;
echo '11***'.base64_encode($_SESSION['Type']).'***'.$_REQUEST['Postafreead'];
}
}

if($_REQUEST['action']=='2')
{
$Username = $_REQUEST['FLusername'];
$Password = base64_encode($_REQUEST['FLpassword']);
$Check  = db_query("SELECT RGT_PK,RGT_Type,RGT_UserName FROM ".TABLE_REGISTRATION." WHERE RGT_UserName='".$Username."' AND RGT_Password='".$Password."' AND RGT_Status='1'  ");
if(db_num_rows($Check)>0)
{
list($Lid,$Type,$UserName)=db_fetch_array($Check);	
$_SESSION['LID']= $Lid;
$_SESSION['Type']= $Type;
$_SESSION['UserName']= $UserName;
echo '22***'.base64_encode($_SESSION['Type']).'***'.$_REQUEST['Postafreead'];
}
else
echo '2***'.base64_encode($_SESSION['Type']).'***'.$_REQUEST['Postafreead'];
}


if($_REQUEST['action']=='3')
{
$Username = $_REQUEST['FFusername'];
	
$Check  = db_query("SELECT RGT_PK,RGT_Type,RGT_UserName,RGT_Password,RGT_Email,RGT_Mobile FROM ".TABLE_REGISTRATION." WHERE RGT_UserName='".$Username."'  AND RGT_Status='1'  ");

if(db_num_rows($Check)>0)
{
list($Lid,$Type,$UserName,$Password,$PEmail,$PMobile)=db_fetch_array($Check);	
$_SESSION['LID']= $Lid;
$_SESSION['Type']= $Type;
$_SESSION['UserName']= $UserName;
if($Type==3)
{
if($PEmail == $EmailMobile)	
$Set = 1;//Email
if($PMobile == $EmailMobile)	
$Set = 2;//Phone
$ToEmail        = $PEmail;	
$ToName         = $UserName;	
$ToMobile       = $PMobile;	

}

if($Set==1)
{
$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;'>
<tr><td colspan='2' height='10'></td></tr>
<tr><td colspan='2' style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
<tr><td colspan='2' style='padding-left:20px;'>We had received a request for password from your account. Please refer the following</td></tr>
<tr><td colspan='2' style='padding-left:20px;font-weight:bold;'>Login Name : ".$UserName."</td></tr>
<tr><td colspan='2' style='padding-left:20px;font-weight:bold;'>Password : ".$Password."</td></tr>
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
}
else 
{
// phone
}
echo '33';
}
else
echo '3';
}
?>
