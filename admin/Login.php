<?php include("include/BlModules/Bl_Login.php") ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link href="css/adminlogin.css" rel="stylesheet" type="text/css" />
<link href="css/style_msg.css" rel="stylesheet" type="text/css" />
</head>
<body>
<script type="text/javascript" src="js/Login.js"></script>
<form method="post" id="LoginForm" name="LoginForm" action="Login.php" >

<table width="381" border="0" align="center" cellpadding="0" cellspacing="1">
  <tr>
    <td width="379" height="109" align="center" valign="bottom"><img src="images/logo.png"></td>
  </tr>
  <tr>
    <td align="left"><table border="0" cellpadding="0" cellspacing="1"class="login" >
      <tr>
        <td align="left" valign="bottom" class="td"><table width="100%" border="0" cellspacing="0" cellpadding="0">
          <tr>
            <td align="left" valign="top"><img src="images/member-login.gif" width="190" height="54" /></td>
          </tr>
          <tr>
            <td align="left" valign="top" class="td"><table width="100%" border="0" cellspacing="1" cellpadding="0">
              <tr>
                <td width="29%" height="40" align="left" class="logintxt">User Name</td>
                <td width="71%" align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
				<tr>
				  <td colspan="3" align="center"><span id="msgdisplay" class="logintxt">&nbsp;
					<?php $_REQUEST['s'] = (isset($_REQUEST['s']) ? $_REQUEST['s'] : ''); if($_REQUEST['s']==1){ echo "Invalid User Login!"; }?>
				  </span></td>
				</tr>
                  <tr class="inputbg">
                    <td width="34"><img src="images/userlogin.gif" width="34" height="32" /></td>
                    <td width="393" ><input type="text" autocomplete="off" maxlength="30" class="iput" name="Username" id="Username" style="width:165px;border:0px;" />&nbsp;&nbsp;<span id="validateshow"><span id="Req1"></span></span><!--<input name="textfield" type="text" class="iput" id="textfield" size="30" />--></td>
                    <td width="20"><img src="images/rgt_corner.gif" width="21" height="32" /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td height="47" align="left" class="logintxt">Password</td>
                <td align="left"><table width="100%" border="0" cellspacing="0" cellpadding="0">
                  <tr class="inputbg">
                    <td width="34"><img src="images/password.gif" width="34" height="32" /></td>
                    <td width="393" ><input type="Password" autocomplete="off" maxlength="30" class="iput" name="Password" id="Password"  style="width:165px;border:0px;"/>&nbsp;&nbsp;<span id="validateshow"><span id="Req11"></span></span><!--<input name="textfield2" type="text" class="iput" id="textfield2" size="30" />--></td>
                    <td width="20"><img src="images/rgt_corner.gif" width="21" height="32" /></td>
                  </tr>
                </table></td>
              </tr>
              <tr>
                <td colspan="2" align="left"><table width="100%" border="0" cellspacing="1" cellpadding="0">
                  <tr>
                    <td width="35%" height="55"><!--<input type="checkbox" name="checkbox" id="checkbox" />--></td>
                    <td width="24%"><!--<span class="logintxt">Remember me</span>--><input type="image" src="images/login-button.jpg" id="Login" name="Login" width="99" height="38" onclick="return ValidateLogin();" style="cursor:pointer;outline:none;" /></td>
                    <td width="41%" align="center"><em><img src="images/reset-button.jpg" name="Reset" id="Reset" value="Reset" onClick="window.location.href='Login.php';" style="cursor:pointer;outline:none;"/></em></td>
                  </tr>
                </table></td>
              </tr>
            </table></td>
          </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
 <script>
var cursorpointer=document.getElementById('Username').focus();
</script>
</form>
</body>
</html>
