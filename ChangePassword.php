<div class="heading" style="text-align:center">Change Password</div>
<div id="CompDetlGrid">
<div id="personal" style="margin-left:100px;width:540px;">
<form id="NewsForm">
<fieldset>
<legend>Change Password</legend>
<table border="0" cellspacing="0" cellpadding="0" width="100%">
<tr>
<td>Old Password</td> 
<td>:</td> 
<td><input type="Password" id="OldPassword" name="OldPassword" autocomplete="off"  class="inp-text" /></td> 
</tr>
<tr>
<td>New Password</td> 
<td>:</td> 
<td><input type="Password" id="NewPassword" name="NewPassword" autocomplete="off"  class="inp-text" /></td> 
</tr>
<tr>
<td>Confirm Password</td> 
<td>:</td> 
<td><input type="Password" id="ConfirmPassword" name="ConfirmPassword" autocomplete="off"  class="inp-text" /></td> 
</tr>
<tr>
<td colspan="3" align="center">
<input type="button" onclick="return ChangePassword();" class="submit-btn" id="ChangePassSmt" name="ChangePassSmt" value="Submit" />
<input type="button" onclick="ChangePasswordReset();"  class="submit-btn" value="Reset" />
</td> 
</tr>
</table>
</fieldset>
</form>
</div>
</div>