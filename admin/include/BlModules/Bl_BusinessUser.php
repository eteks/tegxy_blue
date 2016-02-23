<?php  include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();
include("../../../Mailer/class.phpmailer.php");
/*error_reporting(E_ALL);
ini_set('display_errors', 0);*/
$_REQUEST['id'] = (isset($_REQUEST['id']) ? $_REQUEST['id'] : '');
$_REQUEST['status'] = (isset($_REQUEST['status']) ? $_REQUEST['status'] : '');
$_REQUEST['searchKey'] = (isset($_REQUEST['searchKey']) ? $_REQUEST['searchKey'] : '');
$ModuleId = $_REQUEST['ModuleId'];
$fileName = $_REQUEST['fileName'];
$Status   = $_REQUEST['action'];
$BId      = $_REQUEST['id'];
$StatusVal  =$_REQUEST['status'];
$search_key= $_REQUEST['searchKey'];
$CheckModulePrevilage = PermissionList($_SESSION['Admin_Id'],'ModuleList',$ModuleId);

if(isset($_REQUEST['searchact'])){
    $search_query=" AND RGT_CompName LIKE '%$search_key%'";
}
else{
    $search_query='';
}

if ($Status=="status")
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Status='".$StatusVal."' WHERE RGT_PK='".$BId."' ");
if($StatusVal==1)
{
$Details = db_query("SELECT RGT_Email,RGT_UserName,RGT_Password,RGT_OwnerName,RGT_Featured FROM ".TABLE_REGISTRATION." WHERE RGT_PK='".$BId."' AND RGT_Status=1 $search_query");
$FetDetails = db_fetch_array($Details);

$ToAddress = $FetDetails['RGT_Email'];
$ToName    = $FetDetails['RGT_OwnerName'];
$UserName  = $FetDetails['RGT_UserName'];
$Password  = $FetDetails['RGT_Password'];

$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif; padding-left:5px;'>
<tr><td height='10'></td></tr>
<tr><td style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
<tr><td ><p>We are happy to welcome you to the tracemein.com family. Your registration process is completed and you are now a member in the family.</p><p>The following is your credentials</p></td></tr>
<tr><td >
<table width='100%' border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;'>
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

if ($Status=="paystatus")
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_PaymentStatus='".$StatusVal."' WHERE RGT_PK='".$BId."' ");

$featuredcount=db_query("SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE RGT_Featured=0");
$countfeatured=db_num_rows($featuredcount);

$Password='Yes';
$all_Sql = "SELECT RGT_PK, RGT_CompName,RGT_UserName,RGT_Password,RGT_Status,RGT_PaymentStatus,RGT_Featured FROM ".TABLE_REGISTRATION." ";
$orderBy = ' RGT_PK ';
$WhereCont = " where RGT_Type=2 $search_query ";

$gridHead = 'Business';
$colHead  = array("Sl.No.", "Company Name","User Name","Password","Status","Payment","Details","Featured","Comp");
$comp_id=$_REQUEST['id'];
$featured_status=$_REQUEST['status'];
if(isset($_REQUEST['act'])){
   if($_REQUEST['act']=='toggleFeatured'){
    $checkactive=db_query("SELECT RGT_PK FROM ".TABLE_REGISTRATION." WHERE RGT_PK=$comp_id AND RGT_Status=1");
    $activecount=db_num_rows($checkactive);
    
    if($activecount!=''){
    if($featured_status=='0'){
    if($countfeatured<10){
    $featured_query=("UPDATE ".TABLE_REGISTRATION." SET RGT_Featured =$featured_status WHERE  RGT_PK =$comp_id");
$run_fetched_query=db_query($featured_query);
    }
    else{
        echo '****1****';
    }    
    }
    else{
        $featured_query=("UPDATE ".TABLE_REGISTRATION." SET RGT_Featured =$featured_status WHERE  RGT_PK =$comp_id");
$run_fetched_query=db_query($featured_query);
    }            
    echo '****0****';
    echo '@@@@';
    }
    else{
        echo '###1###';
    }
    }
    

}
include_once('../../Nm_seven_col_grid.php');
?>


