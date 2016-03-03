function ValidateStateMast()
{
	if(document.getElementById('SelCountry').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Country';
		document.getElementById('SelCountry').focus();
		return false;
	}
	else if(document.getElementById('TxtStateCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter State Code';
		document.getElementById('TxtStateCode').focus();
		return false;
	}
	else if(document.getElementById('TxtStateName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter State Name';
		document.getElementById('TxtStateName').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}