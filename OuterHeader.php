<?php
$PageName        = basename($_SERVER['SCRIPT_FILENAME'], '.php');
$_SESSION['LID'] = (isset($_SESSION['LID']) ? $_SESSION['LID'] : '');
if ($_SESSION['LID'] == '') {
    $SP  = 'Login.php';
    $SPT = 'Sign In';
} else {
    $SP  = 'Logout.php';
    $SPT = 'Sign Out';
}
$Chk               = "RGT_PK='" . $_SESSION['LID'] . "'";
$ProfileDetails    = db_query("SELECT * FROM " . TABLE_REGISTRATION . " WHERE " . $Chk . " AND RGT_Type=2");
$FetProfileDetails = db_fetch_array($ProfileDetails);
include("ScriptStyleView.php");
?>
<link href="css/homepage.css" rel="stylesheet" type="text/css" media="all" />
<!--------LOGIN FORM----------->
<script>setInterval("update()", 5000); // Update every 10 seconds
//to find online user status
function update()
{
$.post("sessionupdate.php"); // Sends request to update.php
}
</script>
<script type="text/javascript">
var $login = jQuery.noConflict();
$login(document).ready(function(){

    $login('.main_container').click(function(){
        $login('#login-content').hide();
        })

    $login('#login-trigger').click(function(){
        $login(this).next('#login-content').slideToggle();
        $login(this).toggleClass('active');

        if ($login(this).hasClass('active')) $login(this).find('span').html('&#x25B2;')
            else $login(this).find('span').html('&#x25BC;')
        })
});
function ValidateLogin()
{
if(DocId('UserName').value=='')
{
alert("Please Enter the User Name / Email Id / Mobile Number");
DocId('UserName').focus();
return false;
}
else if(DocId('PassWord').value=='')
{
alert("Please Enter the Password");
DocId('PassWord').focus();
return false;
}
}
</script>
<!------------LOGIN FORM---------------->
<div class="search_topbar" >

<?php
if ($_SESSION['LID'] == '') {
?>
<div style="width:190px;height:29px;float:right;">
<div style="width:70px;height:10px;float:left;">
<?php
    if ($PageName != 'Login' && $PageName != 'ForgotPassword') {
?>
<nav>

	<ul>
		<li id="login">
			<a id="login-trigger" href="#" style="margin:0px;color:#fff;font-size:14px;font-weight:normal;margin-top:-5px;">
				Sign In
			</a>
			<div id="login-content" style="margin-top:20px;">
				<form  method="post" action="Login.php" onSubmit="return ValidateLogin();">
					<fieldset id="inputs" style="border:none;background:none;padding: 7px 10px;">
						<input id="UserName" class="loginfont" name="UserName" style="color:#000;font-family: Arial,Helvetica,sans-serif;" type="text" placeholder="Username / Email Id / Mobile Number" autofocus autocomplete="off" />
						<input id="PassWord" class="loginfont" style="color:#000;font-family: Arial,Helvetica,sans-serif;" name="PassWord" type="password" placeholder="Password"  autocomplete="off" />
					</fieldset>
					<fieldset id="actions" style="border:none;background:none;">
                    	<input type="submit" id="Submit" name="Submit" value="Sign In">
                    </fieldset>
				</form>
				<a href="ForgotPassword.php" style="text-decoration:none;color:#666;font-size:11px;"><span><img src="images/forgot-passwords.png" /></span>Forgot Password ?</a>
			</div>
		</li>
	</ul>
</nav>
<?php
    }
?>
</div>
<div style="width:60px;height:10px;float:left;"><a href="Register.php">Register</a></div>
<div style="width:60px;height:10px;float:left;"><a href="#" style="border:none;text-decortaion:none;"><img src="images/home/register_icon.png" style="position:relative;left:-15px;" /></a></div>
</div>
<?php
} else {
?>
<div style="width:250px;height:29px;float:right;">
<div style="float:left;"><?php
    if ($_SESSION['Type'] == 2) {
        if ($FetProfileDetails['RGT_PaymentStatus'] == 1) {
?>
<a id="login-trigger"  href="<?php
            echo $FetProfileDetails['RGT_ProfileUrl'];
?>" target="_blank">View Profile</a><?php
        }
?><a id="login-trigger" href="ManageProfile.php" target="_blank">Admin</a>
<?php
    }
?><a href="Logout.php">Sign Out</a></div>
<?php
}
?>
</div>

</div>
