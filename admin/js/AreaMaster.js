function ValidateAreaMaster()
{
	
	if(document.getElementById('SelCountry').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Country';
		document.getElementById('SelCountry').focus();
		return false;
	}
	else if(document.getElementById('SelState').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select State';
		document.getElementById('SelState').focus();
		return false;
	}
	else if(document.getElementById('SelCity').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select City';
		document.getElementById('SelCity').focus();
		return false;
	}
	else if(document.getElementById('TxtAreaCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Area Code';
		document.getElementById('TxtAreaCode').focus();
		return false;
	}
	else if(document.getElementById('TxtArea').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Area';
		document.getElementById('TxtArea').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}

