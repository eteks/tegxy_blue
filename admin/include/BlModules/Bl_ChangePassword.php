<?php  ob_start();
$_POST['BtnUpdate'] = (isset($_POST['BtnUpdate']) ? $_POST['BtnUpdate'] : '');
if($_POST['BtnUpdate'] == 'Update')
{

			$TxtUser=$_POST["TxtUser"];

			//$TxtOld=base64_encode($_POST["TxtOld"]);
			$TxtOld=$_POST["TxtOld"];
			$TxtNew=$_POST["TxtNew"];
			$TxtConfirm=$_POST["TxtConfirm"];
			//$TxtConfirm=base64_encode($_POST["TxtConfirm"]);


$OldPass_Query="SELECT AdminUser_password FROM ".TABLE_ADMINUSER." WHERE AdminUser_LoginId='".$TxtUser."' AND AdminUser_Password='".$TxtOld."' ";

   
   //old password checking
   $Result_OldPass=db_query($OldPass_Query);
   $Record_Count=db_num_rows($Result_OldPass);
   
  if($Record_Count==0){
  
	echo "<script>var serty=OnclickMenu('2','".$ModuleId."','ChangePassword');</script>";

 /* header("Location:".HTTP_SERVER."ChangePassword.php?s=2");
  exit;*/
  }
   
   $ChangePassword_Query="UPDATE ".TABLE_ADMINUSER." SET AdminUser_Password='".$TxtConfirm."' WHERE AdminUser_LoginId='".$TxtUser."'"; 
     $Result_ChangePass=db_query($ChangePassword_Query);
   
   	echo "<script>var serty=OnclickMenu('1','".$ModuleId."','ChangePassword');</script>";

   // header("Location:".HTTP_SERVER."ChangePassword.php?s=1");
	 
	}


?>
