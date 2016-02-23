// JavaScript Document

function ValidateAdminUserForm()
{
	if(document.getElementById('AdminUserCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Admin User Code';
		document.getElementById('AdminUserCode').focus();
		return false;
	} else if(document.getElementById('AdminUserName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Admin User';
		document.getElementById('AdminUserName').focus();
		return false;
	} else if(document.getElementById('AdminRole').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Admin User Role';
		document.getElementById('AdminRole').focus();
		return false;
	}
	if(document.getElementById('AdminUserEmail').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Admin User Email';
		document.getElementById('AdminUserEmail').focus();
		return false;
	}
	else
	{
		if(!is_email(document.getElementById('AdminUserEmail').value))
		{
		document.getElementById('msgdisplay').innerHTML='Enter Valid Admin User Email';
		document.getElementById('AdminUserEmail').focus();
		return false;			
		}
	}
	if(document.getElementById('AdminUserLogin').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Admin User Login';
		document.getElementById('AdminUserLogin').focus();
		return false;
	}
	if(document.getElementById('AdminUserPassword').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Admin User Password';
		document.getElementById('AdminUserPassword').focus();
		return false;
	}
	if(document.getElementById('AdminUserCPassword').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Confirm Password';
		document.getElementById('AdminUserCPassword').focus();
		return false;
	}
		if(document.getElementById('AdminUserCPassword').value!=document.getElementById('AdminUserPassword').value)
	{
		document.getElementById('msgdisplay').innerHTML='Password Mismatched';
		document.getElementById('AdminUserCPassword').focus();
		return false;
	}

		document.getElementById('msgdisplay').innerHTML='';
}

