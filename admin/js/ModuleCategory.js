// JavaScript Document
function ValidateModuleCategory()
{
	if(document.getElementById('ModuleCategory_Code').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Module Category Code';
		document.getElementById('ModuleCategory_Code').focus();
		return false;
	}
	else if(document.getElementById('ModuleCategory_Name').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Module Category Name';
		document.getElementById('ModuleCategory_Name').focus();
		return false;
	}
	else if(document.getElementById('ModuleCategory_Function').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Module Category Function';
		document.getElementById('ModuleCategory_Function').focus();
		return false;
	}
}
