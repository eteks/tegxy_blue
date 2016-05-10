<?php include_once("../Configuration.php");
include_once("../DatabaseConnection.php");
db_connect();

$LID           = $_SESSION['LID'];
$CompanyName   = $_REQUEST['CompanyName'];
$Sector        = $_REQUEST['Sector'];
$Address1      = $_REQUEST['Address1'];
$Address2      = $_REQUEST['Address2'];
$SelCountry    = $_REQUEST['SelCountry'];
$SelState      = $_REQUEST['SelState'];
$SelCity       = $_REQUEST['SelCity'];
$Mobile        = $_REQUEST['Mobile'];
$LandLine      = $_REQUEST['LandLine'];
$Email         = $_REQUEST['Email'];

$GroupName  = $_REQUEST['GroupName'];
$RequestNo  = $_REQUEST['RequestNo'];
$YearofEst  = date('Y-m-d',  strtotime($_REQUEST['YearofEst']));
$TypeofComp = $_REQUEST['TypeofComp'];
$EmpStr     = $_REQUEST['EmpStr'];
$Website    = $_REQUEST['Website'];
$SelArea = $_REQUEST['SelArea'];
$SelPincode = $_REQUEST['SelPincode'];


db_query("UPDATE ".TABLE_REGISTRATION." SET RGT_CompName='".$CompanyName."',RGT_Sector='".$Sector."',RGT_Address1='".$Address1."',RGT_Address2='".$Address2."',RGT_Country='".$SelCountry."',RGT_State='".$SelState."',RGT_City='".$SelCity."',RGT_Mobile='".$Mobile."',RGT_Landline='".$LandLine."',RGT_Email='".$Email."', RGT_GroupName='".$EmpStr."',RGT_RegNo='".$RequestNo."',RGT_YrofEstablish='".$YearofEst."',RGT_CompType='".$TypeofComp."',RGT_EmpStrength='".$GroupName."',RGT_Website='".$Website."',RGT_Area='".$SelArea."',RGT_Pincode='".$SelPincode."' WHERE RGT_PK='".$LID."'");

$ProfileDetails=db_query("SELECT * FROM ".TABLE_REGISTRATION." WHERE RGT_PK='".$LID."' AND RGT_Type=2");
$FetProfileDetails = db_fetch_array($ProfileDetails);
?>

<div id="personal" style="margin-left:100px;width:540px;">
<form id="NewsForm">
<fieldset>
<legend>Profile</legend>
<label for="input-one" class="float">Company Name :</label><br /> 
<input class="inp-text" name="CompanyName" disabled="disabled" id="CompanyName" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_CompName'];?>" /><br />

<label for="input-two" class="float">Group Name :</label><br />
<input class="inp-text" name="GroupName" id="GroupName" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_GroupName'];?>" /><br />

<label for="input-two" class="float">Industry :</label><br />
<select name="Sector" id="Sector"   class="inp-text" >
<option value="">--Select Industry--</option>
<?php $SelectSector=db_query("Select Id,S_Name From ".TABLE_SECTOR." WHERE Status=1 order by S_Name asc");
while(list($MSeId,$MSeName)=db_fetch_array($SelectSector))
{?>
<option  value="<?php echo $MSeId; ?>" <?php if($FetProfileDetails['RGT_Sector']==$MSeId){?>selected="selected"<?php }?>><?php echo $MSeName; ?></option><?php 
}?>
</select><br />

<label for="input-ten" class="float">Email :</label><br />
<input class="inp-text" name="Email"  id="Email" type="text" size="30" autocomplete="off" value="<?php echo $FetProfileDetails['RGT_Email'];?>" /><br /><br />


<label for="input-three" class="float">Corporate Identification No(CIN) :</label><br />
<input class="inp-text" name="RequestNo"  id="RequestNo" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_RegNo'];?>" /><br />

<label for="input-four" class="float">Year Of Establishment :</label><br />
<input  class="inp-text" name="YearofEst"  id="YearofEst" type="text" size="30"  onFocus="return clearedate('YearofEst')" onClick="return clearedate('YearofEst')"  value="<?php echo $FetProfileDetails['RGT_YrofEstablish']; ?>" readonly="readonly" autocomplete="off"  />
<img src="images/Cal.png" width="16" height="16" style="cursor:pointer" onclick="showCalendarControl(document.forms['NewsForm'].YearofEst)"  /> <br />

<label for="input-five" class="float">Type Of Company :</label><br />
<select name="TypeofComp" id="TypeofComp" class="inp-text" >
<option value="">--Select Company Type--</option>
<option value="1" <?php if($FetProfileDetails['RGT_CompType']=='1'){?>selected="selected"<?php }?>>Cooperative Societies</option>
<option value="2" <?php if($FetProfileDetails['RGT_CompType']=='2'){?>selected="selected"<?php }?>>Government Based</option>
<option value="3" <?php if($FetProfileDetails['RGT_CompType']=='3'){?>selected="selected"<?php }?>>Joint Stock Companies</option>
<option value="4" <?php if($FetProfileDetails['RGT_CompType']=='4'){?>selected="selected"<?php }?>>Partnership</option>
<option value="5" <?php if($FetProfileDetails['RGT_CompType']=='5'){?>selected="selected"<?php }?>>Private Limited</option>
<option value="6" <?php if($FetProfileDetails['RGT_CompType']=='6'){?>selected="selected"<?php }?>>Sole Proprietorship</option>
</select><br />

<label for="input-six" class="float">Employement Strength :</label><br />
<input class="inp-text" name="EmpStr"  id="EmpStr" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_EmpStrength'];?>" /><br />

<label for="input-six" class="float">Address Line 1 :</label><br />
<input class="inp-text" name="Address1"  id="Address1" type="text" size="30" autocomplete="off" value="<?php echo $FetProfileDetails['RGT_Address1'];?>" /><br />

<label for="input-seven" class="float">Address Line 2 :</label><br />
<input class="inp-text" name="Address2"  id="Address2" type="text" size="30" autocomplete="off" value="<?php echo $FetProfileDetails['RGT_Address2'];?>" /><br />

<label for="input-eight" class="float">Country :</label><br />
<select name="SelCountry" id="SelCountry" onchange="return OnclickCountry(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');"  class="inp-text" >
<option value="">--Select Country--</option>
<?php $SelectCountry=db_query("Select Id,Country_Name From ".TABLE_GENERALCOUNTRYMASTER." WHERE Status=1 order by  Country_Name asc");
while(list($MCId,$MCName)=db_fetch_array($SelectCountry))
{?>
<option  value="<?php echo $MCId; ?>" <?php if($FetProfileDetails['RGT_Country']==$MCId){?>selected=selected<?php }?> ><?php echo $MCName; ?></option><?php 
}?>
</select>

<label for="input-eight" class="float">State :</label><br />
<span id="StateGrid"><select name="SelState" id="SelState" onchange="return OnclickStatee(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');"  class="inp-text" >
<option value="">--Select State--</option>
<?php
 $SelectState=db_query("Select Id,St_Name From ".TABLE_GENERALSTATEMASTER." WHERE Status=1 AND St_Country='".$FetProfileDetails['RGT_Country']."' Order by Id asc");
while(list($MSId,$MSName)=db_fetch_array($SelectState))
{?>
<option  value="<?php echo $MSId; ?>" <?php if($FetProfileDetails['RGT_State']==$MSId){?>selected=selected<?php }?> ><?php echo $MSName; ?></option><?php 
}?>
</select></span>

<label for="input-eight" class="float">City :</label><br />
<span id="CityGrid"><select name="SelCity" id="SelCity"  class="inp-text" onchange="return OnclickCityy(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');">
<option value="">--Select City--</option>
<?php $SelectCity=db_query("Select Id,Area From ".TABLE_GENERALAREAMASTER." WHERE Status=1 AND A_Country='".$FetProfileDetails['RGT_Country']."' AND A_State='".$FetProfileDetails['RGT_State']."' Order by Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectCity))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($FetProfileDetails['RGT_City']==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select></span>

<label for="input-nine" class="float">Area :</label><br />
<span id="BAreaGrid"><select name="BArea" id="BArea"  class="inp-text" onchange="return OnclickCityy(this.value,'SelCountry','SelState','SelCity','BArea','BPincode');">
<option value="">--Select Area--</option>
<?php $SelectArea=db_query("Select AM_Id,AM_Area From ".TABLE_AREAMASTER." WHERE AM_Status=1 AND AM_Country='".$FetProfileDetails['RGT_Country']."' AND AM_State='".$FetProfileDetails['RGT_State']."' AND AM_City='".$FetProfileDetails['RGT_City']."' Order by AM_Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectArea))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($FetProfileDetails['RGT_Area']==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select></span>


<label for="input-nine" class="float">Pincode :</label><br />
<span id="BPinGrid"><select name="BPincode" id="BPincode"  class="inp-text" >
<option value="">--Select Pincode--</option>
<?php $SelectPin=db_query("Select PM_Id,PM_Pincode From ".TABLE_PINCODEMASTER." WHERE PM_Status=1 AND PM_Country='".$FetProfileDetails['RGT_Country']."' AND PM_State='".$FetProfileDetails['RGT_State']."' AND PM_City='".$FetProfileDetails['RGT_City']."' AND PM_Area='".$FetProfileDetails['RGT_Area']."' Order by PM_Id asc");
while(list($MCyId,$MCyName)=db_fetch_array($SelectPin))
{?>
<option  value="<?php echo $MCyId; ?>" <?php if($FetProfileDetails['RGT_Pincode']==$MCyId){?>selected=selected<?php }?> ><?php echo $MCyName; ?></option><?php 
}?>
</select></span>

<label for="input-nine" class="float">Mobile Number :</label><br />
<input class="inp-text" name="Mobile"  id="Mobile" type="text" size="30" autocomplete="off"  onkeyup="checkNumber(this);" value="<?php echo $FetProfileDetails['RGT_Mobile'];?>" /><br />

<label for="input-ten" class="float">Land Line :</label><br />
<input class="inp-text" name="LandLine"  id="LandLine" type="text" size="30" autocomplete="off"  onkeyup="checkNumber(this);" value="<?php echo $FetProfileDetails['RGT_Landline'];?>" />

<label for="input-ten" class="float">Website :</label><br />
<input class="inp-text" name="Website"  id="Website" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_Website'];?>" />
<?php if($FetProfileDetails['RGT_PaymentStatus']=='1'){?>
<label for="input-ten" class="float"><?php echo HTTP_URL ;?>/</label><br />
<span id="PrfleIdd"><input class="inp-text" name="ProfileLink" autocomplete="off" onkeyup="urlvalidate(this);showHint(this.value)"  id="ProfileLink" type="text" size="30" value="<?php echo $FetProfileDetails['RGT_ProfileUrl'];?>" /></span><p><input class="submit-button" type="button" onclick="ProfileeLinkk();" value="OK" />
</p><?php }?><br /><span style="padding-left: 160px;" id="txtHint"></span>
<p><input class="submit-btn" type="button" onclick="CompanyDetails();" value="Update" /></p>
</fieldset>

</form>
</div>
