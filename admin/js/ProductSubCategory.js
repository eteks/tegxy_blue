// JavaScript Document
function ValidateProductSubCategory()
{
	if(document.getElementById('Selpcat').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Product Category';
		document.getElementById('Selpcat').focus();
		return false;
	}
	else if(document.getElementById('TxtSubCatCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Sub Category Code';
		document.getElementById('TxtSubCatCode').focus();
		return false;
	}
	else if(document.getElementById('TxtPsubcat').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Sub Category';
		document.getElementById('TxtPsubcat').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}
