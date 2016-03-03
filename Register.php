<?php include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
include("Mailer/class.phpmailer.php");
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title><?php echo $Title;?></title>
<link rel="icon" href="images/">

<?php include("ScriptStyle.php");?>

<!-- Keyword related script -->

<link rel="StyleSheet" href="Tagedit-master/css/ui-lightness/jquery-ui-1.9.2.custom.min.css" type="text/css" media="all"/>
<link rel="StyleSheet" href="Tagedit-master/css/jquery.tagedit.css" type="text/css" media="all"/>

<script type="text/javascript" src="Tagedit-master/js/jquery-1.10.2.min.js"></script>
<script type="text/javascript" src="Tagedit-master/js/jquery-ui-1.9.2.custom.min.js"></script>
<script type="text/javascript" src="Tagedit-master/js/jquery.autoGrowInput.js"></script>
<script type="text/javascript" src="Tagedit-master/js/jquery.tagedit.js"></script>
<link href="jquery-ui-timepicker-0.3.3/jquery.ui.timepicker.css" />
<link href="jquery-ui-timepicker-0.3.3/include/ui-1.10.0/ui-lightness/jquery-ui-1.10.0.custom.min.css" />
<script type="text/javascript" src="jquery-ui-timepicker-0.3.3/jquery.ui.timepicker.js?v=0.3.3" ></script>
<script type="text/javascript">
jQuery.noConflict();
(function( $ ) {
$(function() {
// Fullexample
$("#tagform-full").find('input.tag').tagedit(
{
autocompleteURL: 'Tagedit-master/server/autocomplete.php',
//checkToDeleteURL: 'server/checkToDelete.php'
});

$('#timepicker_1').timepicker({
showPeriod: true,
showLeadingZero: true,
showCloseButton: true
});

$('#timepicker_2').timepicker({
showPeriod: true,
showLeadingZero: true,
showCloseButton: true
});

$('#timepicker_3').timepicker({
showPeriod: true,
showLeadingZero: true,
showCloseButton: true
});

$('#timepicker_4').timepicker({
showPeriod: true,
showLeadingZero: true,
showCloseButton: true
});

});
})(jQuery);
</script>
<!-- Keyword related script -->
<script type="text/javascript" src="js/CalendarControl.js"></script>
<link href="css/CalendarControl.css" rel="stylesheet" type="text/css" />
<script type="text/javascript" src="js/Register.js"></script>
</head><!-- onload="Disappear();" -->
<body  class="background">

<div id="wrap" style="width:100%;">

<style type="text/css">
#actions, #Submit, #inputs, #login #actions
{
	margin:0;
}
#login #actions
{
	margin:0;
}
#inputs
{
margin-left: -7px;	
}
/* some styling for the page */
body { font-size: 10px; /* for the widget natural size */ }
#content { font-size: 1.2em; /* for the rest of the page to show at a normal size */
font-family: "Lucida Sans Unicode", "Lucida Grande", Verdana, Arial, Helvetica, sans-serif;
width: 950px; margin: auto;
}
.code { margin: 6px; padding: 9px; background-color: #fdf5ce; border: 1px solid #c77405; }
fieldset { padding: 0.5em 2em }
hr { margin: 0.5em 0; clear: both }
a { cursor: pointer; }
#requirements li { line-height: 1.6em; }

#ui-timepicker-div a
{
padding: 2px;   
}
#ui-timepicker-div
{
text-align: center;
font-size: 11px;
}
input.submit-btn {
    background: none repeat scroll 0 0 #1EB9E7;
    border: medium none;
    border-radius: 5px;
    color: #FFFFFF;
    cursor: pointer;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: bold;
    padding: 3px;
}
</style>
<?php include("OuterHeader.php");?>

<?php $id = $_REQUEST['Id'];  if($id=="2")  {  echo '<script>alert("Registration Successfully..");</script>'; } else { }  ?>

<div class="clear"></div>
<div id="content">

<div align="center" style="width:990px;height:82px; margin-top:20px;"><a href="index.php" style="border:none;text-decoration:none;"><div style="font-weight: bold; margin-top: 30px; font-family: Trebuchet MS; font-size: 80px;text-shadow: 4px 4px #000000;"><span style="color:#00667C;">X</span><span style="color:#C31118;">Y</span><span style="color:#00667C;">GET</span><span style="color:#C31118;font-size:55px;">.COM</span></div></a></div>

<div id="popular" style="padding-bottom:25px; margin-top:20px;">

<div id="registerform">


<?php if($_SESSION['Tracemeinreg']=='Success') { ?>

<div>                               
<p>Dear <strong><?php echo $_SESSION['TracemeinregName'];?></strong>,</p>
<p>Thank you for showing interest in joining our XYget.com family. You will receive a confirmation mail on approval of your registration.</p>
<p>Thanks,</p>
<p><strong>XYget.com Team</strong></p>
<p><a href="index.php"  style=" color:#ED5222;text-decoration: none;">Click here</a> 
to continue browsing XYget.com</p>
</div>

<?php $_SESSION['Tracemeinreg']='';$_SESSION['TracemeinregName']=''; } else {?>

<?php /*?><div class="validation text-align-c" id="msgdisplay" style="height:15px;"><?php if($_REQUEST['Id']=='1'){?>Successfully Registered<?php }?></div><?php */?>
<div class="text-align-c" style="height:15px;display:none;">
<input type="radio" id="Busradio" name="RegisterOpt" checked="checked" onclick="RegisterOption('Bus');RegisterReset();" />&nbsp;Business&nbsp;&nbsp;<input type="radio" id="Perradio" name="RegisterOpt" onclick="RegisterOption('Per');RegisterReset();" />&nbsp;Personal</div>
<form method="post" id="RegisterForm" name="RegisterForm" action="Register.php" ><!-- onSubmit="return Validation();" -->
<div id="BusinessGridd" style="display:block;" >
<div id="personal"  style="width:140px;">&nbsp;</div>
<div id="personal"  class="newreg" style="width:800px; padding-left:80px; margin-top:-40px;">
<fieldset style="height:auto;">
<legend>Register</legend>
<table border="0" cellspacing="0" cellpadding="0" align="center">


<tr>
<td class="twenty"><label for="input-two" class="floatleft">Name<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="OwnerName"  id="OwnerName" type="text" size="30" autocomplete="off" /></td>
</tr>


<tr>
<td class="twenty"><label for="input-ten" class="floatleft">Email<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="Email"  id="Email" type="text" size="30" autocomplete="off" /></td></tr>
<tr>

<tr>
<td class="twenty"><label for="input-eight" class="floatleft">Mobile Number<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="Mobile"  id="Mobile" type="text" size="30" autocomplete="off"  onkeyup="checkNumber(this);" /></td>
</tr>

<tr>
<td class="twenty"><label for="input-two" class="floatleft">Date Of Birth</label></td>
<td class="ten"> : </td>
<td class="seventy"><input  class="inp-text" name="DOB"  id="DOB" type="text" size="30"  onFocus="return clearedate('DOB')" onClick="return clearedate('DOB')"   autocomplete="off" readonly="readonly"  /><img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onClick="showCalendarControl(document.forms['RegisterForm'].DOB)"  /></td>
</tr>

<tr>
<td class="twenty"><label for="input-two" class="floatleft">Gender</label></td>
<td class="ten"> : </td>
<td class="seventy">Male&nbsp;<input type="radio" id="Male" name="Gender" value="1" />&nbsp;&nbsp;&nbsp;&nbsp;Female&nbsp;<input type="radio" id="Female" name="Gender" value="2"  /></td>
</tr>

<tr>
<td class="twenty"><label for="input-one" class="floatleft"><b>Busniess Details </b></label></td>
<td class="ten"> : </td> 
<td class="seventy">

<input id="business_details" type="checkbox" />

<input type="hidden" value="" name="bus_details" id="bus_details"/>

</td>
</tr>


<tr>
<td class="twenty" colspan="3">

<div id="view_business_details" style="display:none;">
<fieldset style="height:auto;">
<legend>Business Details</legend>
<table width="100%" border="0">
<tr>
<td class="twenty"><label for="input-one" class="floatleft">Company Name<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td> 
<td class="seventy"><input class="inp-text" name="CompanyName" id="CompanyName" type="text" size="30" maxlength="85" autocomplete="off" /></td>
</tr>
<tr>
<td class="twenty"><label for="input-one" class="floatleft">Group Name</label></td>
<td class="ten"> : </td> 
<td class="seventy"><input class="inp-text" name="GroupName" id="GroupName" type="text" size="30" maxlength="85" autocomplete="off" /></td>
</tr>

<tr>
<td class="twenty"><label for="input-two" class="floatleft">Year Of Establishment<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input  class="inp-text" name="YearofEst"  id="YearofEst" type="text" size="30"  onFocus="return clearedate('YearofEst')" onClick="return clearedate('YearofEst')"  readonly="readonly" autocomplete="off"  /><img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onclick="showCalendarControl(document.forms['RegisterForm'].YearofEst)"  />
</td>
</tr>

<tr>
<td class="twenty"><label for="input-two" class="floatleft">Industry<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy">

<select name="Sector" id="Sector"   class="inp-text" onchange="setsessionvalue(this.value);">
<option value="">--Select Industry--</option>
<?php $SelectSector=db_query("Select Id,S_Name From ".TABLE_SECTOR." WHERE Status=1 order by S_Name asc");
while(list($MSeId,$MSeName)=db_fetch_array($SelectSector))
{?>
<option  value="<?php echo $MSeId; ?>"  ><?php echo $MSeName; ?></option><?php 
}?>
</select>

</td>
</tr>

<tr>
<td class="twenty"><label for="input-two" class="floatleft">Type Of Company</label></td>
<td class="ten"> : </td>
<td class="seventy"><select name="TypeofComp" id="TypeofComp" class="inp-text" >
<option value="">--Select Company Type--</option>
<option value="1" >Cooperative Societies</option>
<option value="2" >Government Based</option>
<option value="3" >Joint Stock Companies</option>
<option value="4" >Partnership</option>
<option value="5" >Private Limited</option>
<option value="6" >Sole Proprietorship</option>
</select>
</td>
</tr>





<tr>
<td class="twenty"><label for="input-two" class="floatleft">Description<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy">

<textarea class="inp-text" style="height:100px;" name="Designation"  id="Designation" type="text" maxlength="200" autocomplete="off"> </textarea>
</td>
</tr>

<tr>
<td class="twenty"><label for="input-two" class="floatleft">Company Strength</label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="CompStrength"  id="CompStrength" type="text" size="30" autocomplete="off" /></td>
</tr>


<tr>
<td class="twenty"><label for="input-two" class="floatleft">Website URL</label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="website_url" value="http://" id="website_url" type="text" size="30" autocomplete="off" /></td>
</tr>


<?php /*?><tr id="keywordgrid" style="display:none;">
<td class="twenty"><label for="input-two" class="floatleft">offers</label></td>
<td class="ten"> : </td>
<td class="seventy" id="tagform-full" ><input type="text" name="tag[]"  class="tag" />
</td>
</tr><?php */?>


<tr>
<td class="twenty"><label for="input-six" class="floatleft">Address Line 1<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="Address1"  id="Address1" type="text" size="30" autocomplete="off" /></td>
</tr>
<tr>
<td class="twenty"><label for="input-seven" class="floatleft">Address Line 2</label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="Address2"  id="Address2" type="text" size="30" autocomplete="off" /></td>
</tr>
<tr>
<td class="twenty"><label for="input-eight" class="floatleft">Country<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy">

<select name="SelCountry" id="SelCountry" onchange="return OnclickCountry(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');"  class="inp-text" >
<?php $SelectCountry=db_query("Select Id,Country_Name From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1 order by  Country_Name asc");
while(list($MCId,$MCName)=db_fetch_array($SelectCountry))
{?>
<option  value="<?php echo $MCId; ?>" ><?php echo $MCName; ?></option><?php 
}?>
</select>

</td>
</tr>
<tr>
<td class="twenty"><label for="input-eight" class="floatleft">State<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy">

<span id="StateGrid">

<select onchange="return OnclickStatee(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');" class="memberinput" name="SelState" id="SelState">
<option selected="selected" value="">--Select State--</option>
<?php $SelectState=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='1' Order by Id asc");
while(list($MCId,$MCName)=db_fetch_array($SelectState))
{?>
<option  value="<?php echo $MCId; ?>" ><?php echo $MCName; ?></option><?php 
}?>
</select>

</span>

</td>
</tr>
<tr>
<td class="twenty"><label for="input-eight" class="floatleft">City<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><span id="CityGrid"><select></select></span></td>
</tr>
<tr>
<td class="twenty"><label for="input-eight" class="floatleft">Area<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><span id="BAreaGrid"><select></select></span></td>
</tr>
<tr>
<td class="twenty"><label for="input-eight" class="floatleft">Pincode</label></td>
<td class="ten"> : </td>
<td class="seventy"><span id="BPinGrid"><select></select></span></td>
</tr>

<tr><td class="twenty"><label for="input-nine" class="floatleft">Land Line</label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="LandLine"  id="LandLine" type="text" size="30" autocomplete="off"  onkeyup="checkNumber(this);" /></td></tr>
<tr><td colspan="3" height="5"></td></tr>
<tr>
<td class="twenty"><label for="input-eight" class="floatleft">Operating Areas</label></td>
<td class="ten"> : </td>
<td class="seventy">
<table cellpadding="0" cellspacing="0" border="0" >
<!--<tr><td><span id='selecttext' onclick="selectall('selecttext','OpArea');" style="float:right;font-style:italic;cursor:pointer;"> Select All</span></td></tr>-->
<tr><td><select id="OpArea" name="OpArea[]" multiple="multiple" style="height: 85px;">
<?php $SelectArea=db_query("Select Id, Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 Order by Id asc");
while(list($Id,$Area)=db_fetch_array($SelectArea))
{ ?>
<option  value="<?php echo $Id; ?>" ><?php echo $Area; ?></option><?php 
}?>
</select></td></tr>
</table>
</td>
</tr>


<tr><td colspan="3" height="5"></td></tr>
<tr><td><label for="input-nine" class="floatleft">Working Days</label></td>
<td class="ten"> : </td>
<td>From <select class="inp-text" name="FromWD"  id="FromWD" style="width:100px;">
<option value="">--Select--</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option>
</select> To <select class="inp-text" name="ToWD"  id="ToWD" style="width:100px;">
<option value="">--Select--</option>
<option value="Monday">Monday</option>
<option value="Tuesday">Tuesday</option>
<option value="Wednesday">Wednesday</option>
<option value="Thursday">Thursday</option>
<option value="Friday">Friday</option>
<option value="Saturday">Saturday</option>
<option value="Sunday">Sunday</option></select></td></tr>
<tr><td colspan="3" height="5"></td></tr>
<tr><td><label for="input-nine" class="floatleft">Business Timing</label></td>
<td class="ten"> : </td>
<td>From <input class="inp-text" name="FromOT"  id="timepicker_1" type="text" size="30" style="width:65px;" autocomplete="off"   /> To <input class="inp-text" name="ToOT"  id="timepicker_2" style="width:65px;" type="text" size="30" autocomplete="off"  /></td></tr>
<tr><td colspan="3" height="5"></td></tr>
<tr><td><label for="input-nine" class="floatleft">Break Time</label></td>
<td class="ten"> : </td>
<td>From <input class="inp-text" name="FromBT"  id="timepicker_3" type="text" size="30" style="width:65px;" autocomplete="off"   /> To <input class="inp-text" name="ToBT"  id="timepicker_4" style="width:65px;" type="text" size="30" autocomplete="off"  /></td></tr>

</table>


</fieldset>

</div>


</td>

</tr>







<tr>
<td class="twenty"><label for="input-four" class="floatleft">User Name<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="User_Name"  id="User_Name" type="text" size="30" autocomplete="off" /><br />
</td>
</tr>

<tr>
<td class="twenty"><label for="input-four" class="floatleft">Password<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="Password"  id="Password" type="Password" size="30" autocomplete="off" /></td>
</tr>

<tr>
<td class="twenty"><label for="input-five" class="floatleft">Confirm Password<span style="color:#F00;">*</span></label></td>
<td class="ten"> : </td>
<td class="seventy"><input class="inp-text" name="CPassword"  id="CPassword" type="Password" size="30" autocomplete="off" /></td>
</tr>


<?php /*?><tr><td colspan="3" align="left" style="font-weight:bold;">Please Set your Page Address here,</td>
<tr><td colspan="3" height="5"></td></tr>

<tr><td colspan="2"><label for="input-nine" class="float"><?php echo HTTP_URL ;?>/</label></td>
<td><input class="inp-text" name="ProfileLink"  autocomplete="off" id="ProfileLink" type="text" size="30" onkeyup="urlvalidate(this);showHint(this.value)" />
</td></tr>
<tr><td colspan="3" align="right"><span id="txtHint"></span></td>
</tr><?php */?>


<tr><td colspan="3">&nbsp;</td></tr>
<tr><td colspan="3" class="text-align-c">

<input type="hidden" name="terms_con" id="terms_con" value="0"/>

<input type="checkbox" name="terms" id="terms" value=""/>

<a href="#" class="topopup1" style="text-decoration:none; padding:5px; color:#333;"><span >Terms & Conditions</span></a>
<input type="submit" value="SUBMIT" style="margin:0;height:auto;box-shadow:none;" name="Submit" class="submit-btn" >
<input type="hidden" value="true"  name="post_value" >
<!--<input type="button" onclick="return ValidateFirstLevel();" id="Next" name="Next" value="Next" class="submit-btn" />--></td></tr>
</table>
</fieldset>
</div>
</div>

</form>
<?php }?>
</div>




<link href="css/eventpopup.css" rel="stylesheet" type="text/css" media="all" />
<script type="text/javascript" src="js/script.js"></script>
<div id="toPopup1"> 
    	
        <div class="close1"></div>
       	<span class="arrow"></span>
		<div id="popup_content"> 
            <p> 
            <img src="images/logo.png" style="position:relative;top:-10px;"><br/>
           <b> 1.	Service Utility; XYget Accounts</b><br />


<p>This service comes to effect on your Account creation and approval by XYget (an <b>“Account”</b>). XYget has got all the rights to refuse or limit your access to the Services provided. You agree to that you are at least 18 years of age, an individual,  to hold an account with XYget. If as an organization or group of companies you have to provide your registration number for Authenticity.</p> <br />

<p>This account is valid for a period of one year, from the date of approval of the account and has to be renewed for further period of validity.</p><br />

<p>By registering with XYget, you allow <b>TECHDNS</b> to serve, as applicable, (i) commercials and other Ads content, (ii) All searches and their results, and (iii) associated search queries and other links to your websites, and/or other assets approved by <b>TECHDNS</b> (each individually a <b>“assets”</b>). And also, you grant <b>TECHDNS</b> the right to access, index and reserve the assets, or any part thereof, including by automated means. <b>TECHDNS</b> may reject the Services to any assets, at any time.</p><br />

<p>Any asset that is a software application and accesses our Services (a) necessitates preapproval by <b>TECHDNS</b> in writing, and (b) must act in accordance with <b>TECHDNS</b>   Software Principles.</p><br />

<b>2.	Website usage</b><br />
<ol>
<li>By utilizing this Service, you affirm and represent to the <b>TECHDNS</b> that you are authorized to do so and to make use of information accessible via the website.</li> <br />
<li>TECHDNS reserves the right, in its sole discretion and at any time, to make changes to this account. </li><br />
<li>Any changes made will be effective accordingly when made and the updated details will be sent to the member via e-mail.</li><br />
<li>By becoming an account holder you are agreeing to be e bound by this agreement and any of the policies and procedures that may be made by TECHDNS from time to time.</li><br />
<li>Any communications sent to you concerning the services or related matters are not intended to be made public.</li><br />
<li>While TECHDNS makes reasonable efforts to ensure that the services are available at all times, TECHDNS does not guarantee that the Members will be able to access or use all the services or all of their features at all the times.</li><br />
<li>The information that you supply during the resignation process is deemed accurate and complete by <b>TECHDNS</b></li><br />
<li>Account holder is responsible for maintaining the confidentiality of their login id and password.</li><br />
</ol>

<b>3.	Trademarks</b><br />
<p>The trademarks, names, logos and service marks (jointly “trademarks”) displayed on this website are registered and unregistered trademarks of <b>TECHDNS</b>. No content on this website should be interpreted as granting any license or rights to utilize any trademark without the prior written permission of <b>TECHDNS</b>.</p><br />

<b>4.	External links</b><br />
<p>Links may be provided from external source for your convenience, but they are not controlled by <b>TECHDNS</b> and no representation is made as to their content. Usage or dependence on any external links and the content thereon offered is at your individual risk</p>.<br />
<b>5.	Warranties</b><br />
<ol>
<li>The <b>TECHDNS</b> commits no warranties, representations, statements or guarantees (whether articulated, implied in law or enduring) regarding the service.</li><br />
<li>You represent and warrant to <b>TECHDNS</b> that all of the information provided by you to <b>TECHDNS</b> to register as an account holder and participate in the services is correct and current, and that you have all necessary right, power and authority to enter in to this service.</li>
</ol><br />
<b>6.	VIOLATIONS:</b><br />
<ol>
<li>Violations of system and network security are prohibited, and may result in criminal and civil liability. Examples of system and network security violations include the following:<br/> 
a)	Any automated use of system.<br/>
b)	Use of software that allows your account to stay logged on while you are not actively using the account.<br/>
c)	Unauthorized access to or use of data, systems or networks, including any attempt to probe, scan or test the vulnerability of a system or network or to breach security or authentication measures without the express authorization of the owner of the system or network.</li>
<li>TECHDNS may investigate incident involving such violations, any violations of this Account that may constitute or have the potential to constitute violations of law, and any activity by Members on network that constitute or may constitute violations of law. You understand that we may report any such activity to, and cooperate with, law enforcement, or other legal process.</li><br />
</ol>
<b>7.	Liability Disclaimer</b><br />
<p>
The <b>TECHDNS</b> shall not be accountable for and disown all accountability for any loss, liability, damage (whether direct, indirect or consequential), personal injury or expense of any nature whatsoever which may be suffered by you or any third party (including your company), as a result of or which may be attributable, directly or indirectly, to your access and use of the service, any information contained on the website, you or your company’s personal information or material and information conveyed over our system. In particular, neither the <b>TECHDNS</b> nor any third party or data or content provider shall be liable in any way to you or to any other person, firm or corporation whatsoever for any loss, liability, damage (whether direct or consequential), personal injury or expense of any nature whatsoever happening by any delays, factual errors, or omission of any share price information or the transmission thereof, or for any proceedings taken in trust thereon or occasioned thereby or by reason of non-performance or disruption, or termination thereof.</p><br />
<b>8.	Conflict of terms</b><br />
<p>If there is a conflict or contradiction between the provisions of these website terms and conditions and any other related terms and conditions, policies or notices, the other relevant terms and conditions, policies or notices which relate specifically to a particular section or part of the website shall prevail in respect of your use of the relevant section or part of the website.</p><br />
<b>9.	Severability</b><br />
<p>Any requisites of any relevant terms and conditions, policies and notices, which is or becomes unenforceable in any jurisdiction, whether due to being canceled, invalidity, illegality, unlawfulness or for any reason whatever, shall, in such jurisdiction only and only to the extent that it is so unenforceable, be treated as void and the remaining provisions of any relevant terms and conditions, policies and notices shall remain in full force and effect.</p><br />
<b>10.	Laws Applicable</b><br />
<p>Usage of this website will in all respect, be governed by the laws of the Union Territory of Puducherry, INDIA, despite of the laws that might be valid under principles of conflicts of law. The parties agree that the Puducherry courts located in Union Territory of Puducherry, INDIA, shall have exclusive jurisdiction over all controversies occurring under this contract and agree that location is fitting in those courts.</p><br />

            </p>
        </div> 
    
    </div>

   	<div id="backgroundPopup"></div>

</div></div>
<div class="clear"></div>

</div>
<?php include("Footer.php");?>

</body>
</html>

<?php
/*print_r($_POST);
exit;*/

		
//Personal Registration
if($_REQUEST['post_value']=="true")
{
	echo '<script>alert('.$_REQUEST['post_value'].');</script>';

$OwnerName = $_REQUEST['OwnerName'];

$CompName = $_REQUEST['CompanyName'];

if($OwnerName!='' && $CompanyName =="")
{

$OwnName = trim($_REQUEST['OwnerName']);
$Mobile = trim($_REQUEST['Mobile']);
$Email = trim($_REQUEST['Email']);	
$UserName = trim($_REQUEST['User_Name']);
$Password = base64_encode(trim($_REQUEST['Password']));
$DOB = trim($_REQUEST['DOB']);
$Gender = trim($_REQUEST['Gender']);

$Country = trim($_REQUEST['SelCountry']);
$State = trim($_REQUEST['SelState']);
$City = trim($_REQUEST['SelCity']);

		
//$P_Type="1";


db_query("INSERT INTO ".TABLE_REGISTRATION." SET RGT_Name='".$OwnerName."',RGT_UserName='".$UserName."',RGT_Password='".$Password."',RGT_Mobile='".$Mobile."' ,RGT_Email='".$Email."' ,RGT_RegisterOn=NOW(), RGT_Country='".$Country."',RGT_State='".$State."',RGT_City='".$City."', RGT_Type='3', RGT_Status='1', RGT_DOB='".$DOB."',RGT_Gender='".$Gender."', RGT_Filesize='0',RGT_Featured='0'");
$PerId = db_insert_id();




/*db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Relation = '".$PerId."' WHERE RGT_PK='".$BusId."' ");
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Relation = '".$BusId."' WHERE RGT_PK='".$PerId."' ");
*/
}

//Business Registration
if($_REQUEST['CompanyName']!='')
{
//Business Registration
$CompName = $_REQUEST['CompanyName'];
$ToAddress = trim($_REQUEST['Email']);
$ToName    = trim($_REQUEST['OwnerName']); 		
$OwnName = trim($_REQUEST['OwnerName']);
$Sector = trim($_REQUEST['Sector']);
$UserName = trim($_REQUEST['User_Name']);
$Password = base64_encode(trim($_REQUEST['Password']));
$Address1 = trim($_REQUEST['Address1']);
$Address2 = trim($_REQUEST['Address2']);
$Country = trim($_REQUEST['SelCountry']);
$State = trim($_REQUEST['SelState']);
$City = trim($_REQUEST['SelCity']);
$Mobile = trim($_REQUEST['Mobile']);
$LandLine = trim($_REQUEST['LandLine']);
$Email = trim($_REQUEST['Email']);	
$website_url = trim($_REQUEST['website_url']);	

$YearofEst = trim($_REQUEST['YearofEst']);
$Designation = trim($_REQUEST['Designation']);
$Gender = trim($_REQUEST['Gender']);
$DOB = trim($_REQUEST['DOB']);
$Area = trim($_REQUEST['BArea']);
$Pincode = trim($_REQUEST['BPincode']);
$TypeofComp = trim($_REQUEST['TypeofComp']);
$FromWD = trim($_REQUEST['FromWD']);
$ToWD = trim($_REQUEST['ToWD']);
$FromOT = trim($_REQUEST['FromOT']);
$ToOT = trim($_REQUEST['ToOT']);
$FromBT = trim($_REQUEST['FromBT']);
$ToBT = trim($_REQUEST['ToBT']);
//$ProfileLink = trim($_REQUEST['ProfileLink']);
$GroupName    = $_REQUEST['GroupName'];
$CompStrength = $_REQUEST['CompStrength'];
$Type="2";

db_query("INSERT INTO ".TABLE_REGISTRATION." SET RGT_CompName='".$CompName."',RGT_OwnerName='".$OwnName."',RGT_UserName='".$UserName."',RGT_Password='".$Password."',RGT_Address1='".$Address1."',RGT_Address2='".$Address2."',RGT_Country='".$Country."',RGT_State='".$State."',RGT_City='".$City."',RGT_Mobile='".$Mobile."',RGT_Landline='".$LandLine."',RGT_Email='".$Email."',RGT_Sector='".$Sector."',RGT_RegisterOn=NOW(),RGT_Type='".$Type."',RGT_OwnDOB='".$DOB."',RGT_OwnGender='".$Gender."',RGT_Area='".$Area."',RGT_Pincode='".$Pincode."',RGT_YrofEstablish='".$YearofEst."',RGT_OwnDesign='".$Designation."',RGT_CompType='".$TypeofComp."',RGT_ProfileUrl='".$ProfileLink."',RGT_Filesize='5242880',RGT_Featured='1',RGT_WorkingdayFrom='".$FromWD."',RGT_WorkingdayTo='".$ToWD."',RGT_OfficetimeFrom='".$FromOT."',RGT_OfficetimeTo='".$ToOT."',RGT_BreaktimeFrom='".$FromBT."',RGT_BreaktimeTo='".$ToBT."',RGT_GroupName='".$GroupName."',RGT_EmpStrength='".$CompStrength."',RGT_Website='".$website_url."'");
$BusId = db_insert_id();


db_query("INSERT INTO ".TABLE_CONTACT." SET CI_UserFk='".$BusId."',CI_Title='".$CompName."',CI_Address='".$Address1."',CI_Address2='".$Address2."',CI_Country='".$Country."',CI_State='".$State."',CI_City='".$City."',CI_Area='".$Area."',CI_Pincode='".$Pincode."',CI_Phone='".$LandLine."',CI_Email='".$Email."',CI_Person='".$OwnName."',CI_CreatedOn=Now(),CI_ModifiedOn=Now() ");

foreach($_POST['OpArea'] as $opvalue)
{
db_query("INSERT INTO ".TABLE_OPERATINGAREA." SET Op_BusFk='".$BusId."',Op_AreaFk='".$opvalue."' ");
}

/*$checkexistdummy  = db_query("SELECT * FROM ".TABLE_KEYWORDMST." WHERE Kd_IndustryFk='".$Sector."' and Kd_Keyword=''");	
if(db_num_rows($checkexistdummy)>0)
echo '1';
else
db_query("INSERT INTO ".TABLE_KEYWORDMST." SET Kd_IndustryFk='".$Sector."', Kd_Keyword='', Kd_CreatedOn=Now(), Kd_ModifiedOn=Now()");*/

foreach($_POST['tag'] as $tagvalue)
{
$checkexist      = db_query("SELECT Kd_Id FROM ".TABLE_KEYWORDMST." WHERE Kd_Keyword='".$tagvalue."'");	
$fetchcheckexist = db_fetch_array($checkexist);
if(db_num_rows($checkexist)>0)
$keyid = $fetchcheckexist['Kd_Id'];
else
{
db_query("INSERT INTO ".TABLE_KEYWORDMST." SET Kd_IndustryFk='".$Sector."', Kd_Keyword='".$tagvalue."', Kd_CreatedOn=Now(), Kd_ModifiedOn=Now()");
$keyid = db_insert_id();
}
db_query("INSERT INTO ".TABLE_MEMBERKEYWORD." SET Mk_MemFk='".$BusId."', Mk_KeywordFk='".$keyid."', Mk_CreatedOn=Now(), Mk_ModifiedOn=Now()");
}

//|| $PerId!=''
if($BusId!='' )
{
$Message     = "<table border='0' cellpadding='0' cellspacing='0'  style='font-size: 12px; line-height: 25px;font-family:Arial, Helvetica, sans-serif;padding-left:5px;padding-bottom:10px;'>
<tr><td colspan='2' height='10'></td></tr>
<tr><td colspan='2' style='color:#006DB8;font-size:15px;'>Dear ".$ToName.",</td></tr>
<tr><td colspan='2' height='10'></td></tr>
<tr><td colspan='2' >Thank you for showing interest in joining our xyget.com family. You will receive a confirmation mail on approval of your registration.</td></tr>
</table>";


$mailContent = file_get_contents("MailTemplate.php");
$Message = str_replace('MSGCONTENT',$Message, $mailContent);
$Message = str_replace('images/',HTTP_SERVER.'images/', $Message);
$Subject='Registration';
$FromName='XYget';
$FromAddress='services@tracemein.com';
PHP_Mailer($Message,$Subject,$ToAddress,$ToName,$FromAddress,$FromName,'','');
}

$_SESSION['TracemeinregName']=$CompName;
$_SESSION['Tracemeinreg']='Success';

/*db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Relation = '".$PerId."' WHERE RGT_PK='".$BusId."' ");
db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_Relation = '".$BusId."' WHERE RGT_PK='".$PerId."' ");
*/

header("Location:Register.php?Id=1");	

}
header("Location:Register.php?Id=2");	
}
?>

