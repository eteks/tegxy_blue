<?php
include("include/Configuration.php");
include("include/DatabaseConnection.php");
db_connect();

/*//Personal
$PCheck = db_query("SELECT RGT_UserName,RGT_Password FROM ".TABLE_REGISTRATION." WHERE RGT_UserName='".$_REQUEST['PUserName']."' AND RGT_Password='".base64_encode($_REQUEST['PPassword'])."'");
if(db_num_rows($PCheck)>0)
$PStatus = 'Yes';
else
$PStatus = 'No';
*/
//Business
$Check = db_query("SELECT RGT_UserName,RGT_Password FROM ".TABLE_REGISTRATION." WHERE RGT_UserName='".$_REQUEST['User_Name']."' AND RGT_Password='".base64_encode($_REQUEST['Password'])."'");
if(db_num_rows($Check)>0)
$Status = 'Yes';
else
$Status = 'No'."SELECT RGT_UserName,RGT_Password FROM ".TABLE_REGISTRATION." WHERE RGT_UserName='".$_REQUEST['User_Name']."' AND RGT_Password='".base64_encode($_REQUEST['Password'])."'";

echo '######'.$Status; //'######'.$PStatus.?>