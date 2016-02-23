// JavaScript Document
function ValidateRole()
{
	if(document.getElementById('RoleName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Role Name';
		document.getElementById('RoleName').focus();
		return false;
	}
	document.RoleForm.submit();
}

