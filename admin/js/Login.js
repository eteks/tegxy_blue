// JavaScript Document

function ValidateLogin()
{
	if(document.getElementById('Username').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter User Name';
		document.getElementById('Username').focus();
		return false;
	}
	else if(document.getElementById('Password').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='';
		document.getElementById('msgdisplay').innerHTML='Enter Password';
		document.getElementById('Password').focus();
		return false;
	}
	document.LoginForm.submit();
}

