<?php 
$DOBB = $FetProfileDetails['RGT_OwnDOB'];
if($DOBB!=='')
{
$CurrentDate = date("d-m-Y");
$diff = abs(strtotime($CurrentDate) - strtotime($DOBB));
$Age = floor($diff / (365*60*60*24));
}
?>

<div class="heading" style="text-align:center">Owner Details</div>
<div id="OwnerDetlGrid">
<div id="personal" style="margin-left:100px; padding-bottom:30px;width:530px;">
<form id="OwnerForm">
<fieldset>
<legend> Owner Profile</legend>
<label for="input-one" class="float">Owner Name<span style="color:#F00;">*</span> :</label><br /> 
<input class="inp-text" name="OwnerName" id="OwnerName" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_OwnerName'];?>" /><br />

<label for="input-two" class="float">Designation :</label><br />
<input class="inp-text" name="Designation"  id="Designation" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_OwnDesign'];?>"/><br />

<label for="input-three" class="float">Date Of Birth :</label><!-- onFocus="return clearedate('DOB')" onClick="return clearedate('DOB')" -->
<input  class="inp-text" name="DOB"  id="DOB" type="text" size="30"    value="<?php echo $FetProfileDetails['RGT_OwnDOB']; ?>" autocomplete="off" readonly="readonly" onclick="return clearedate('DOB')"  onFocus="return clearedate('DOB')" /><img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onClick="showCalendarControl(document.forms['OwnerForm'].DOB)" /></br>
<input type="hidden" id="hide_current" value="<?php echo $CurrentDate; ?>">

<label for="input-four" class="float">Gender :</label><br />
Male&nbsp;<input type="radio" id="Male" name="Gender" value="1" <?php if($FetProfileDetails['RGT_OwnGender']==1){?>checked="checked"<?php }?>  />&nbsp;&nbsp;&nbsp;&nbsp;Female&nbsp;<input type="radio" id="Female" name="Gender" value="2"  <?php if($FetProfileDetails['RGT_OwnGender']==2){?>checked="checked"<?php }?> />
<br />

<label for="input-seven" class="float">Address :</label><br />
<input class="inp-text" name="OwnAddr"  id="OwnAddr" type="text" size="30" autocomplete="off" value="<?php echo $FetProfileDetails['RGT_OwnAddress'];?>" /><br />

<label for="input-eight" class="float">Country :</label><br />
<select name="OwnSelCountry" id="OwnSelCountry" onchange="return OnclickCountry(this.value,'OwnSelCountry','OwnSelState','OwnSelCity','OArea','OPincode');"  class="inp-text" >
<option value="">--Select Country--</option>
<?php $SelectCountry=db_query("Select Id,Country_Name From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1 order by  Country_Name asc");
while(list($MCId,$MCName)=db_fetch_array($SelectCountry))
{?>
<option  value="<?php echo $MCId; ?>" <?php if($FetProfileDetails['RGT_OwnCountry']==$MCId){?>selected=selected<?php }?> ><?php echo $MCName; ?></option><?php 
}?>
</select>

<label for="input-eight" class="float">State :</label><br />
<span id="OwnStateGrid"><select name="OwnSelState" id="OwnSelState" onchange="return OnclickStatee(this.value,'OwnSelCountry','OwnSelState','OwnSelCity','OArea','OPincode');"  class="inp-text" >
<option value="">--Select State--</option>
<?php
 $SelectState=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='".$FetProfileDetails['RGT_OwnCountry']."' Order by Id asc");
while(list($MSId,$MSName)=db_fetch_array($SelectState))
{?>
<option  value="<?php echo $MSId; ?>" <?php if($FetProfileDetails['RGT_OwnState']==$MSId){?>selected=selected<?php }?> ><?php echo $MSName; ?></option><?php 
}?>
</select></span>

<label for="input-eight" class="float">City :</label><br />
<span id="OwnCityGrid"><select name="OwnSelCity" id="OwnSelCity"  class="inp-text" onchange="return OnclickCityy(this.value,'OwnSelCountry','OwnSelState','OwnSelCity','OArea','OPincode');" >
<option value="">--Select City--</option>
<?php $SelectCity=db_query("Select Id,Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$FetProfileDetails['RGT_OwnCountry']."' AND A_State='".$FetProfileDetails['RGT_OwnState']."' Order by Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectCity))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($FetProfileDetails['RGT_OwnCity']==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select></span>


<label for="input-nine" class="float">Area :</label><br />
<span id="OwnAreaGrid"><select name="OArea" id="OArea"  class="inp-text" onchange="return OnclickCityy(this.value,'OwnSelCountry','OwnSelState','OwnSelCity','OArea','OPincode');">
<option value="">--Select Area--</option>
<?php $SelectArea=db_query("Select AM_Id,AM_Area From ".TABLE_AREAMASTER." WHERE AM_Status=1 AND AM_Country='".$FetProfileDetails['RGT_OwnCountry']."' AND AM_State='".$FetProfileDetails['RGT_OwnState']."' AND AM_City='".$FetProfileDetails['RGT_OwnCity']."' Order by AM_Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectArea))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($FetProfileDetails['RGT_OwnArea']==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select></span>


<label for="input-nine" class="float">Pincode :</label><br />
<span id="OwnPinGrid"><select name="OPincode" id="OPincode"  class="inp-text" >
<option value="">--Select Pincode--</option>
<?php $SelectPin=db_query("Select PM_Id,PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status=1 AND PM_Country='".$FetProfileDetails['RGT_OwnCountry']."' AND PM_State='".$FetProfileDetails['RGT_OwnState']."' AND PM_City='".$FetProfileDetails['RGT_OwnCity']."' AND PM_Area='".$FetProfileDetails['RGT_OwnArea']."' Order by PM_Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectPin))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($FetProfileDetails['RGT_OwnPincode']==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select></span>



<label for="input-nine" class="float">Mobile Number :</label><br />
<input class="inp-text" name="OwnPhoneNo"  id="OwnPhoneNo" type="text" size="30" autocomplete="off" maxlength="10"  onkeyup="checkNumber(this);" value="<?php echo $FetProfileDetails['RGT_OwnMobile'];?>" /><br />

<label for="input-ten" class="float">Land Line :</label><br />
<input class="inp-text" name="OwnLandLine"  id="OwnLandLine" type="text" size="30" autocomplete="off"  onkeyup="checkNumber(this);" value="<?php echo $FetProfileDetails['RGT_OwnLandline'];?>" />

<label for="input-ten" class="float">Email :</label><br />
<input class="inp-text" name="OwnEmail"  id="OwnEmail" type="text" size="30"  value="<?php echo $FetProfileDetails['RGT_OwnEmail'];?>"/><br />

<label for="input-nine" class="float">Education Details :</label><br />
<input class="inp-text" name="OwnEducate"  id="OwnEducate" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_OwnEducate'];?>" /><br />

</fieldset>
<p><input class="submit-btn" style="float:right;" type="button"  onclick="OwnerDetails();" value="Update" /></p>
</form>
</div>
</div>