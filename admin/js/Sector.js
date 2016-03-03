// JavaScript Document
function ValidateSectmst()
{
	if(document.getElementById('Sectcode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Sector Code';
		document.getElementById('Sectcode').focus();
		return false;
	} else if(document.getElementById('TxtSector').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Sector Name';
		document.getElementById('TxtSector').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}
