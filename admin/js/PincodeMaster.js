function ValidatePincodeMaster()
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
	else if(document.getElementById('SelArea').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Area';
		document.getElementById('SelArea').focus();
		return false;
	}
	else if(document.getElementById('TxtPinCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Pincode Code';
		document.getElementById('TxtPinCode').focus();
		return false;
	}
	else if(document.getElementById('TxtPin').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Pincode';
		document.getElementById('TxtPin').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}

