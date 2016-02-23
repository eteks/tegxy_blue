<?php    ob_start();
		include_once("include/Configuration.php");
		include_once(PAGE_DBCONNECTION);
		db_connect();
		//include_once(DIR_WS_BLMODULES.PAGE_BLCHAGEPASSWORD); 
		//include_once(DIR_WS_DALMODULES.PAGE_DALCHANGEPASSWORD); 
		
?>
<?php    //include("include/header.php"); 
	      include("include/BlModules/Bl_ChangePassword.php");

?>	
<script src="js/ChangePassword.js" type="text/javascript"></script>
<div id="ScrollText" style="overflow:auto;">

<form method="post"  name="f1" id="f1" action="index.php" onSubmit="return ChangePasswordValidation();" >
		
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0" >
    <tr>
    <td align="left" valign="top" colspan="2">
	<table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td width="9" align="left" valign="top"><img src="images/gridbox/title_l_bg.gif" width="9" height="29" /></td>
        <td align="left" valign="top" class="title">Change Password</td>
      </tr>
    </table></td>
  	</tr> 
	  <tr>
            <td colspan="2" class="Text_Blue" align="center">
			<div id="msg_content">
			<?php  if($_REQUEST["s"]=="1") { echo "Successfully Changed.";  }
					if($_REQUEST["s"]=="2") { echo "Wrong User Name Or Password";  } ?></div>
			</td>
          </tr>
		  <tr><td>&nbsp;</td></tr>
          <tr>
            <td height="30" align="right" ><span class="feildstxt">User Id: </span> &nbsp;</td>
            <td align="left"><input name="TxtUser" type="text"  id="TxtUser" size="20" autocomplete="off" class="input" /></td>
          </tr>
          <tr>
            <td width="45%" height="30" align="right" ><span class="feildstxt">Old Password : </span> &nbsp; </td>
            <td width="55%" align="left"><input name="TxtOld" type="password"  id="TxtOld" size="20"  autocomplete="off" class="input"/>            </td>
          </tr>
		  
          <tr>
            <td width="45%" height="30" align="right" ><span class="feildstxt">New Password : </span>&nbsp; </td>
            <td width="55%" align="left" ><input name="TxtNew" type="password"  id="TxtNew" size="20"  autocomplete="off" class="input" />            </td>
          </tr>
          <tr>
            <td width="45%" height="30" align="right" ><span class="feildstxt">Confirm Password : </span>&nbsp;  </td>
            <td width="55%" align="left" ><input name="TxtConfirm" type="password"  id="TxtConfirm" size="20" autocomplete="off" class="input" /> </td>
          </tr>
          <tr>
            <td colspan="2">&nbsp;</td>
          </tr>
          <tr>
            <td height="25" colspan="2" align="center" >&nbsp;
                <input name="BtnUpdate" type="submit"  id="BtnUpdate"  value="Update"  style="border:none; cursor:pointer;" class="menu"/>
              &nbsp;&nbsp;<input name="Submit2" type="button"  onclick="return OnclickChangePass(0);" value="Reset" style="border:none; cursor:pointer;" class="menu"  />&nbsp;&nbsp;<input type="button" id="btnclose" name="btnclose" onClick="return cancelpage();" value="Cancel"  style="border:none; cursor:pointer;" class="menu"  ></td>
          </tr>
          <tr>
            <td colspan="2" >&nbsp;</td>
          </tr>
        </table>
		<script>
		function Resetmyform(){
		document.f1.reset();
		document.getElementById('TxtUser').focus();
		document.getElementById('result').innerHTML='EnterNewPassword';
		}
		var ret=document.getElementById('TxtUser').focus();

		</script>
</form>	
	</div>	
	
<?php  //include_once("include/footer.php"); ?>
