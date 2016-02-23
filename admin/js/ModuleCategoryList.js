// JavaScript Document
function ValidateModuleList()
{
	if(document.getElementById('SelModule').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Module Category';
		document.getElementById('SelModule').focus();
		return false;
	}
	else if(document.getElementById('ModuleList_code').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Module List Code';
		document.getElementById('ModuleList_code').focus();
		return false;
	}
	else if(document.getElementById('ModuleList_name').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Module List Name';
		document.getElementById('ModuleList_name').focus();
		return false;
	}
	else if(document.getElementById('ModuleList_function').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Module List Function';
		document.getElementById('ModuleList_function').focus();
		return false;
	}
	else if(document.getElementById('ModuleList_image').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Image Path';
		document.getElementById('ModuleList_image').focus();
		return false;
	}
}
