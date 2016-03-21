<?php 
include_once("include/Configuration.php");
include_once(PAGE_DBCONNECTION);
db_connect();
$PageName = basename($_SERVER['SCRIPT_FILENAME'],'.php');
if($_REQUEST['user']=='')
{
$LID = $_SESSION['LID'];
$Chk = "RGT_PK='".$LID."'";
}
else
{
$LID = $_REQUEST['user'];
$Chk = "RGT_ProfileUrl='".$LID."'";
}
$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE ".$Chk." AND RGT_Type=2");
$FetProfileDetails = db_fetch_array($ProfileDetails);
if($_REQUEST['user'])
$LID = $FetProfileDetails['RGT_PK'];
if($LID=='')
header("Location:Login.php");
$Logo=db_query("SELECT LG_Logo FROM ".TABLE_LOGO." WHERE LG_UserFk ='".$LID."'");
$Logo_Fetch = db_fetch_array($Logo);
?>
<script type="text/javascript" src="js/CalendarControl.js"></script>
<script type="text/javascript" src="js/Common.js"></script>
<script type="text/javascript" src="js/Advertisement.js"></script>
<link href="css/CalendarControl.css" rel="stylesheet" type="text/css" />
<div class="heading" style="text-align:center">Advertisement</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<div id="AdvertisementEntryLevel"  style="display:block;">
<div class="pagination handsym" onclick="GridShowHide('AdvertisementEntryLevel','AdvertisementEntryGrid','Page','');" style="line-height: 49px;"><img width="30" height="30" src="images/Back-icon.png" title="Back"></div><div style="clear:both"></div>

</div>
<div id="AdvertisementEntryGrid" style="display:block;">
<div id="Profile_View_Grid" class="advbg">
	<div style="text-align:center" id="Advalert"></div>
	<!-- <input type="text" id="Advertise"  /> -->
	<input type="hidden" id="Advertise"  />
	<input type="hidden" id="Advertiselevel" />
		<div id="Firstleveladv" style="display:block;">
			<table  align="center"  border="0" cellpadding="0" cellspacing="0" >
			<tr><td colspan="7" height="10"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<!-- <td><input type="button" onclick="Createnewadv();" value="Create New" /></td> -->
			<td><input type="button" onclick="Selectcreatenewadv();" value="Create New" /></td>
			<td>&nbsp;</td>
			<td><input type="button" onclick="Renewadv();" value="Edit Existing" /></td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="10"></td></tr>
			</table>

			<div id="Renewgrid" style="display:none;">
			<fieldset>
			<legend>Renew Advertisement</legend>
			<form id="Formrenew" >
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td colspan="7" height="10"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Advertisement List</td>
			<td>&nbsp;</td>
			<td><select name="Advfromdblist" id="Advfromdblist" size="10" onchange="Advertisementedit(this.value,<?php echo $LID;?>);">
			<?php $SelectSector=db_query("Select ADV_Id ,ADV_Name From ".TABLE_ADVERTISEMENT." WHERE ADV_Userfk='".$LID."' order by ADV_Name asc");
			while(list($ADV_Id,$ADV_Name)=db_fetch_array($SelectSector))
			{?>
			<option  value="<?php echo $ADV_Id; ?>" ><?php echo $ADV_Name; ?></option><?php 
			}?>
			</select></td>
			<td colspan="2">&nbsp;</td>
			<tr><td colspan="7" height="10"></td></tr>
			</tr></table>
			</form>
			</fieldset>
			</div>

			<!-- <div id="Selectiongrid" style="display:none;">
			<table align="center" border="0" cellpadding="0" cellspacing="0" >
			<tr>
			<td colspan="2">&nbsp;</td>
			<td><input type="button" onclick="Selectfromexistadv();" value="Select From Existing" /></td>
			<td>&nbsp;</td>
			<td><input type="button" onclick="Selectcreatenewadv();" value="Create New" /></td>
			<td colspan="2">&nbsp;</td>
			<tr><td colspan="7" height="10"></td></tr>
			</tr></table>
			</div> -->



			<div id="Advnamegrid" style="display:none;">
			<form id="Formadvname">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td colspan="7" height="10"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Advertisement Name</td>
			<td>&nbsp;</td>
			<td><input type="text" id="Advname" name="Advname" value=""  /></td>
			<td colspan="2">&nbsp;</td>
			<tr><td colspan="7" height="10"></td></tr>
			</tr></table>
			</form>
			</div>

			<div id="Selectexistgrid" style="display:none;">
			<fieldset>
			<legend>Select From Existing</legend>
			<form id="Formcreateexist">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td colspan="7" height="10"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Select From</td>
			<td>&nbsp;</td>
			<td>
			<select id="Selectiontype" name="Selectiontype" onchange="AdvSelection(this.value,<?php echo $LID;?>)" >
			<option value="">-- Select --</option>
			<option value="1">Xbit</option>
			<option value="2">Events</option>
			<option value="3">Gallery</option>
			</select>
			</td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="5"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Advertise</td>
			<td>&nbsp;</td>
			<td><span id="Selectionresponse"><select></select></span></td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="5"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Link Your Ad to</td>
			<td>&nbsp;</td>
			<td><input type="radio" id="Linkselection" name="Linkselectionpage" value="1" />Selected ad page</td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="5"></td></tr>
			<tr>
			<td colspan="4">&nbsp;</td>
			<td><input type="radio" id="Linkselectionn"  name="Linkselectionpage" value="2" />A page on tracemein.com (Server name)</td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="5"></td></tr>
			<tr>
			<td colspan="4">&nbsp;</td>
			<td><?php echo HTTP_URL ;?>/ <input type="text" id="Linkurladv"  name="Linkurladv" /></td>
			</tr>
			<tr><td colspan="7" height="10"></td></tr>
			</table>
			</form>
			</fieldset>
			</div>


			<div id="Selectnewgrid" style="display:none;">
			<fieldset>
			<legend>Create New Selected</legend>
			<form id="Formcreatenew">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td colspan="7" height="10"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Image</td>
			<td>&nbsp;</td>
			<td><input type="hidden" name="ADVImage" id="ADVImage" value="" /><span onclick="FileUploadValidate('ADVImage','doc','ADVImageDisp','Document/Advertisement/');"  style="cursor:pointer;"><img src="images/upload-icon.png" /> upload</span>&nbsp;&nbsp;<span id="ADVImageDisp"></span></td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="5"></td></tr>
			<tr>
			<td colspan="2">&nbsp;</td>
			<td>Description</td>
			<td>&nbsp;</td>
			<td><textarea name="Advdescription" id="Advdescription"></textarea></td>
			<td colspan="2">&nbsp;</td>
			</tr>
			<tr><td colspan="7" height="10"></td></tr>
			</table>
			</form>
			</fieldset>
			</div>

			<div id="Nextprocess" style="display:none;text-align:right;">
			<table width="100%" border="0" cellpadding="0" cellspacing="0" >
			<tr><td colspan="7" height="10"></td></tr>
			<tr><td colspan="7" height="5"><input type="button" onclick="Secondleveladv();" value="Next" />&nbsp;<input type="button"  value="Cancel" onclick="window.location.href='index.php'" /></td></tr>
			<tr><td colspan="7" height="10"></td></tr>
			</table>
			</div>
		</div>

		<div id="Secondleveladv" style="display:none;">
		<fieldset>
		<legend>Display Formate</legend>
		<form id="Formdisplayformate">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="7" height="10"></td></tr>
		<tr>
		<td>Formate <input type="radio" id="Firstformate"  name="Displayformate" value="1" /></td>
		<?php /*?><td>&nbsp;</td>
		<td>Formate2 <input type="radio" /></td>
		<td>&nbsp;</td>
		<td>Formate3 <input type="radio" /></td>
		<td>&nbsp;</td>
		<td>Formate4 <input type="radio" /></td>
		<?php */?>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<!-- <tr>
		<td>Note : <span><div style="border:1px solid #000000;width:100px;border: 1px solid #000000;padding: 10px;width: 60px;">Image Text</div></span></td>
		<?php /*?><td>&nbsp;</td>
		<td>Formate2 <input type="radio" /></td>
		<td>&nbsp;</td>
		<td>Formate3 <input type="radio" /></td>
		<td>&nbsp;</td>
		<td>Formate4 <input type="radio" /></td>
		<?php */?>
		</tr> -->
		<tr><td colspan="7" height="10"></td></tr>
		</table>
		</form>
		</fieldset>

		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="2" height="10"></td></tr>
		<tr><td height="5"><input type="button" onclick="Firstleveladv();" value="Back" /></td><td  height="5" align="right"><input type="button" onclick="Thirdleveladv();" value="Next" />&nbsp;<input type="button"  value="Cancel" onclick="window.location.href='index.php'" /></td></tr>
		<tr><td colspan="2" height="10"></td></tr>
		</table>
		</div>

		<div id="Thirdleveladv" style="display:none;">
		<fieldset>
		<legend>Target Your Ad</legend>
		<form id="Formtargetad">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="7" height="10"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>Target page:</td>
		<td>&nbsp;</td>
		<td><select name="Targetpage" id="Targetpage">
		<option value="">--Select--</option>
		<option value="1">Index </option>
		<option value="2">Admin</option>
		<option value="3">Search(Companies)</option>
		<option value="4">Search(Xbit)</option>
		</select></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>Location:</td>
		<td>&nbsp;</td>
		<td><select name="AdvLocation" id="AdvLocation" multiple="multiple">
		<?php
		 $SelectState=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='1' Order by Id asc");
		while(list($MSId,$MSName)=db_fetch_array($SelectState))
		{?>
		<option  value="<?php echo $MSId; ?>" ><?php echo $MSName; ?></option><?php 
		}?>
		</select></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>Sector:</td>
		<td>&nbsp;</td>
		<td><select name="AdvSector" id="AdvSector" >
		<option value="">--Select Sector--</option>
		<?php $SelectSector=db_query("Select Id,S_Name From ".TABLE_SECTOR." WHERE Status=1 order by S_Name asc");
		while(list($MSeId,$MSeName)=db_fetch_array($SelectSector))
		{?>
		<option  value="<?php echo $MSeId; ?>" ><?php echo $MSeName; ?></option><?php 
		}?>
		</select></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>Total Audience:</td>
		<td>&nbsp;</td>
		<td><input type="text" id="Advaudience" name="Advaudience" /></td>
		<td colspan="2">&nbsp;</td>
		<tr><td colspan="7" height="10"></td></tr>
		</tr>
		</table>
		</form>
		</fieldset>
		<fieldset>
		<legend>Select YourBudget / Timeline For This Ad</legend>
		<form id="Formtimeline">
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="7" height="10"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>From: <input name="Fromtimeline"  id="Fromtimeline" type="text"   onFocus="return clearedate('Fromtimeline')" onClick="return clearedate('Fromtimeline')"  readonly="readonly" autocomplete="off"  />
		<img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onclick="showCalendarControl(document.forms['Formtimeline'].Fromtimeline)"  /></td>
		<td>&nbsp;</td>
		<td>To: <input name="Totimeline"  id="Totimeline" type="text"  onFocus="return clearedate('Totimeline')" onClick="return clearedate('Totimeline');"   readonly="readonly" autocomplete="off"  />
		<img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onclick="showCalendarControl(document.forms['Formtimeline'].Totimeline);"  /><span onclick="Advdisplayduration();">&nbsp;&nbsp;Calculate</span></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>Total Amount:</td>
		<td>&nbsp;</td>
		<td><input type="text" id="Advamount" name="Advamount" /></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<tr>
		<td colspan="6" align="center">( Or )</td>
		</tr>
		<tr><td colspan="7" height="5"></td></tr>
		<tr>
		<td colspan="2">&nbsp;</td>
		<td>Enter Budget:</td>
		<td>&nbsp;</td>
		<td><input type="text" id="Advbudget" name="Advbudget" /></td>
		<td colspan="2">&nbsp;</td>
		</tr>
		<tr><td colspan="7" height="10"></td></tr>
		</table>
		</form>
		</fieldset>

		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="2" height="10"></td></tr>
		<!-- <tr><td  height="5"><input type="button" onclick="Secondleveladv();" value="Back" /></td><td  height="5" align="right"><input type="button" onclick="Fourthleveladv();" value="Next" />&nbsp;<input type="button"  value="Cancel" onclick="window.location.href='index.php'" /></td></tr> -->
		<tr><td height="5"><input type="button" onclick="Secondleveladv();" value="Back" /></td><td  height="5"><input type="button" onclick="AddAdvertisement(<?php echo $LID;?>);" value="Submit" />&nbsp;<input type="button"  value="Cancel" onclick="window.location.href='index.php'" /></td></tr>
		<tr><td colspan="2" height="10"></td></tr>
		</table>
		</div>

		<!-- <div id="Fourthleveladv" style="display:none;">
		<fieldset>
		<legend>Checkout</legend>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="7" height="10"></td></tr>
		</table>
		</fieldset>
		<table width="100%" border="0" cellpadding="0" cellspacing="0" >
		<tr><td colspan="2" height="10"></td></tr>
		<tr><td height="5"><input type="button" onclick="Thirdleveladv();" value="Back" /></td><td  height="5"><input type="button" onclick="AddAdvertisement(<?php echo $LID;?>);" value="Submit" />&nbsp;<input type="button"  value="Cancel" onclick="window.location.href='index.php'" /></td></tr>
		<tr><td colspan="2" height="10"></td></tr>
		</table>
		</div> -->
	</div>
</div>
</div>
