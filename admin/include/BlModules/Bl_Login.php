<?php  ob_start();
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();

$_POST['Username'] = (isset($_POST['Username']) ? $_POST['Username'] : '');
if($_POST['Username'] != '')
{
   
	$Username=$_POST["Username"];
	//$Password=base64_encode($_POST["Password"]);
	$Password=$_POST["Password"];
	//echo "Select AdminUser_LoginId,AdminUser_Password,AdminUser_Name,Admin_Id FROM ".TABLE_ADMINUSER." WHERE AdminUser_LoginId='".$Username."' AND AdminUser_Password='".$Password."'";
	$SelectUser=db_query("Select AdminUser_LoginId,AdminUser_Password,AdminUser_Name,Admin_Id,AdminUser_Role FROM ".TABLE_ADMINUSER." WHERE AdminUser_LoginId='".$Username."' AND AdminUser_Password='".$Password."'");
	$CountUser=db_num_rows($SelectUser);
	$FetchUser=db_fetch_array($SelectUser);
	if($CountUser==0){	
	header("Location:".HTTP_SERVER."Login.php?s=1");
	}else{
	$_SESSION['Name']=$FetchUser['AdminUser_Name'];
	$_SESSION['Admin_Id']=$FetchUser['Admin_Id'];
	$_SESSION['LoginId']=$FetchUser['AdminUser_LoginId'];
	$_SESSION['AdminUser_Role']=$FetchUser['AdminUser_Role'];
	header("Location:".HTTP_SERVER."index.php");
	}
}
?>
