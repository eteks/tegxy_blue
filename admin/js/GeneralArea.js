function ValidateArea()
{
	
	if(document.getElementById('SelCountry').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Country';
		document.getElementById('SelCountry').focus();
		return false;
	}
	if(document.getElementById('SelState').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select State';
		document.getElementById('SelState').focus();
		return false;
	}
	else if(document.getElementById('TxtAreaCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter City Code';
		document.getElementById('TxtAreaCode').focus();
		return false;
	}
	else if(document.getElementById('TxtArea').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter City';
		document.getElementById('TxtArea').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}

