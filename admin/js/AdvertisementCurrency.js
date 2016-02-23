// JavaScript Document

function ValidateAdvertisementCurrency()
{
	if(document.getElementById('Currencycode').value=='')
	{
		document.getElementById('Req1').innerHTML='Enter Currency Code';
		document.getElementById('Currencycode').focus();
		return false;
	}
	else if(document.getElementById('CurrencyName').value=='')
	{  
		document.getElementById('msgdisplay').innerHTML='Enter Currency Name';
		document.getElementById('CurrencyName').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').value='';
	}
}


