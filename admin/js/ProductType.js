// JavaScript Document
function ValidateProducttype()
{
	if(document.getElementById('Selpcat').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Select Product Category';
		document.getElementById('Selpcat').focus();
		return false;
	}

   else if(document.getElementById('TxtPtypeCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Type Code';
		document.getElementById('TxtPtypeCode').focus();
		return false;
	}
	else if(document.getElementById('TxtProdtypeName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Type';
		document.getElementById('TxtProdtypeName').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}
function OnclickPCategory4type(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Pcatid="+str1+"&r="+ran_number;
	//alert(str);
	var url = "include/BlModules/Bl_ProductType.php";
	xmlhttp.open("POST", url, true);
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showProductCategory4type
}
function showProductCategory4type()
{
	if (xmlhttp.readyState == 4)
	{
		var response = xmlhttp.responseText;
		if (response != "")
		{
			document.getElementById('ShowProductSubCategory').innerHTML = response;
		}
	}
}

