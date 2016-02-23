// JavaScript Document
function ValidateCountry()
{
	if(document.getElementById('ISOCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Country ISO Id';
		document.getElementById('ISOCode').focus();
		return false;
	}
	else if(document.getElementById('CountryName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Country';
		document.getElementById('CountryName').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}



