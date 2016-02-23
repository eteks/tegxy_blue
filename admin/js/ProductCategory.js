// JavaScript Document
function ValidateProductCategory()
{
	if(document.getElementById('TxtProCategoryCode').value=='') {
	
		document.getElementById('msgdisplay').innerHTML='Enter Product Category Code';
		document.getElementById('TxtProCategoryCode').focus();
		return false;

     }
	else if(document.getElementById('TxtProCategoryName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Category';
		document.getElementById('TxtProCategoryName').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}