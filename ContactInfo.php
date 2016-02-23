<div class="heading" style="text-align:center">Contact Info</div>
<div id="personal" style="margin-left:50px; padding-bottom:30px;width:680px;">
<div id="ContactEntryLevel"  style="display:block;">
<div class="pagination handsym" onclick="GridShowHide('ContactEntryLevel','ContactEntryGrid','Grid','');" style="line-height: 49px;"><img width="30" height="30" src="images/Back-icon.png" title="Back"></div><div style="clear:both"></div>
<fieldset id="Fields">
<input type="hidden" id="ContactStateData" value="0"  />
<input type="hidden" id="ContactExistId" />
<legend>Contact Info</legend>

<table border="0" cellspacing="0" cellpadding="0">
<tr>
<td>Title</td>
<td> :&nbsp;&nbsp;</td>
<td><input class="inp-text" name="CITitle"  id="CITitle" type="text" size="30" autocomplete="off" value="<?php echo $FetContactDetails['CI_Title'];?>" style="width:350px;"  /></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Contact Person</td>
<td> :&nbsp;&nbsp;</td>
<td><input class="inp-text" name="CIPerson"  id="CIPerson" type="text" size="30" autocomplete="off" value="<?php echo $FetContactDetails['CI_Person'];?>" style="width:350px;"  /></td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Address Line 1</td>
<td> :&nbsp;&nbsp;</td>
<td><input class="inp-text" name="CIAddress1"  id="CIAddress1" type="text" style="width:350px;" size="30" autocomplete="off" value="<?php echo $FetContactDetails['CI_Address'];?>" />
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Address Line 2</td>
<td> :&nbsp;&nbsp;</td>
<td><input class="inp-text" name="CIAddress2"  id="CIAddress2" style="width:350px;" type="text" size="30" autocomplete="off" value="<?php echo $FetContactDetails['CI_Address2'];?>" />
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Country</td>
<td> :&nbsp;&nbsp;</td>
<td><select name="CISelCountry" id="CISelCountry" onchange="return OnclickCountry(this.value,'CISelCountry','CISelState','CISelCity','CIBArea','CIBPincode');"  class="inp-text" >
<option value="">--Select Country--</option>
<?php $SelectCountry=db_query("Select Id,Country_Name From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1 order by  Country_Name asc");
while(list($MCId,$MCName)=db_fetch_array($SelectCountry))
{?>
<option  value="<?php echo $MCId; ?>" <?php if(isset($FetContactDetails) && !empty($FetContactDetails)) if($FetContactDetails['CI_Country']==$MCId){?>selected=selected<?php }?> ><?php echo $MCName; ?></option><?php 
}?>
</select>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>State</td>
<td> :&nbsp;&nbsp;</td>
<td><span id="CIStateGrid"><select name="CISelState" id="CISelState"  class="inp-text" ></select></span>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>City</td>
<td> :&nbsp;&nbsp;</td>
<td><span id="CICityGrid"><select name="CISelCity" id="CISelCity"  class="inp-text" ></select></span>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Area</td>
<td> :&nbsp;&nbsp;</td>
<td><span id="CIBAreaGrid"><select name="CIBArea" id="CIBArea"  class="inp-text"></select></span>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Pincode</td>
<td> :&nbsp;&nbsp;</td>
<td><span id="CIBPinGrid"><select name="CIBPincode" id="CIBPincode"  class="inp-text" ></select></span>
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Landline</td>
<td> :&nbsp;&nbsp;</td>
<td><input class="inp-text" name="CILandLine" style="width:350px;" id="CILandLine" type="text" size="30" autocomplete="off"  onkeyup="checkNumber(this);" value="<?php echo $FetContactDetails['CI_Landline'];?>" /><br />

</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Office Email</td>
<td> :&nbsp;&nbsp;</td>
<td>
<input class="inp-text" name="CIEmail" style="width:350px;" id="CIEmail" type="text" size="30" autocomplete="off"  value="<?php echo $FetContactDetails['CI_OfficeEmail'];?>" />
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td>Fax</td>
<td> :&nbsp;&nbsp;</td>
<td>
<input class="inp-text" name="CIFax" style="width:350px;" id="CIFax" type="text" size="30" autocomplete="off"  value="<?php echo $FetContactDetails['CI_Fax'];?>" />
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
<tr>
<td colspan="3" align="center">
<input type="button" class="submit-btn" onclick="AddContact();" id="ContactSmt" name="ContactSmt" value="Save Contact" />
<input type="button" class="submit-btn" onclick="ContactResett();" id="ContactReset" name="ContactReset" value="Reset" />
<input type="button" class="submit-btn" value="Cancel" onclick="GridShowHide('ContactEntryLevel','ContactEntryGrid','Grid','');" />
</td>
</tr>
<tr><td colspan="3">&nbsp;</td></tr>
</table>
</fieldset>
</div>
<div id="ContactEntryGrid" style="display:block;">
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="mfieldset">
<tr class="pagination heading2"><td width="90%" colspan="2"><span onclick="GridShowHide('ContactEntryLevel','ContactEntryGrid','Page','');ContactResett();"><b>Add New Contact&nbsp;</b></span></td><td width="10%"><span class="handsym" onclick="GridShowHide('ContactEntryLevel','ContactEntryGrid','Page','');ContactResett();"><img src="images/Add.jpg" width="30" height="30" title="Add" /></span></td></tr>
<tr><td colspan="5" class="gridbgcolor" >
<div id="ContactGrid" class="gridpad">
<?php $sqltot="SELECT CI_Id, CI_Title FROM ".TABLE_CONTACT." WHERE CI_UserFk='".$UId."' order by  CI_Id desc";
$tot=db_query($sqltot);
$rtot=db_num_rows($tot);
$totalrecord=$rtot;  $pagesize=2;
$noofpages=$totalrecord/$pagesize;
$SqlRun=db_query($sqltot." limit $startdata,$pagesize");
$Count = db_num_rows($SqlRun);
?>
<table border="0" cellspacing="0" cellpadding="0" width="100%" class="manageborder">
<tr height="35">
<td width="10%">S.No.</td>
<td width="80%">Title</td>
<td width="10%">Action</td>
</tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<?php
if($Count>0){
$Pid=1;
while(list($CI_Id,$CI_Title) = db_fetch_array($SqlRun)){
?>
<tr class="gridcenbgcolor"  height="40">
<td width="10%"><?php  echo $Pid;?></td>
<td width="80%"><?php echo $CI_Title;?></td>
<td width="10%" class="handsym"><img width="16" border="0" height="16" onclick="ContactEdit(<?php echo $CI_Id;?>);" src="images/b_edit.png" title="Edit">&nbsp;<img width="16" border="0" height="16" src="images/b_drop.png" onclick="ContactDelete(<?php echo $CI_Id;?>,<?php echo $Count;?>,<?php echo $startdata;?>);" title="Delete"></td>
</tr>

<?php  $Pid++;}?>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"  height="25"><td colspan="5"><?php echo getManagePagingLink($sqltot, $pagesize, $startdata, 'PageContact'); ?></td></tr>
<?php } else {?>
<tr class="gridcenbgcolor" height="25"><td colspan="5" class="text-align-c">No Record Found</td></tr>
<tr><td colspan="5" class="gridlinebgcolor"></td></tr>
<tr class="gridbgcolor"   height="25"><td colspan="5"></td></tr>
<?php }?>
</table>
</div>
</td></tr>
</table>
</div>
</div>
