// JavaScript Document

function ValidateProdSpecForm()
{
	if(document.getElementById('PDScode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Specification Code';
		document.getElementById('PDScode').focus();
		return false;
	} else if(document.getElementById('PDSName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Specification';
		document.getElementById('PDSName').focus();
		return false;
	} 
	else
		document.getElementById('msgdisplay').innerHTML='';
}

