// JavaScript Document
function ValidateProductList()
{
   if(document.getElementById('TxtProductCode').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Code';
		document.getElementById('TxtProductCode').focus();
		return false;
	}
	else if(document.getElementById('TxtProductName').value=='')
	{
		document.getElementById('msgdisplay').innerHTML='Enter Product Name';
		document.getElementById('TxtProductName').focus();
		return false;
	}
	else if(document.getElementById('Selpcat').value=='' && document.getElementById('RelativityChk').value=='0')
	{
		document.getElementById('msgdisplay').innerHTML='Select Category';
		document.getElementById('Selpcat').focus();
		return false;
	}
	else if(document.getElementById('RelativityChk').value=='0')
	{
		document.getElementById('msgdisplay').innerHTML='Add Category';
		document.getElementById('Selpcat').focus();
		return false;
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML='';
	}
}


function OnclickPCategory(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Pcatid="+str1+"&r="+ran_number;
	//alert(str);
	var url = "include/BlModules/Bl_Productlist.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showProductCategory
}

function showProductCategory() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			//alert(response);
			document.getElementById('ShowProductSubCategory').innerHTML = response;
		}
	}
}




function OnclickPSubCategory(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var pid=document.getElementById('Selpcat').value;
	var str = "PSubcatid="+str1+"&pid="+pid+"&r="+ran_number;
	//alert(str);
	var url = "include/BlModules/Bl_Productlist.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showProductSubCategory
}

function showProductSubCategory() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			//alert(response);
			document.getElementById('ShowProductType').innerHTML = response;
		}
	}
}

/* Begin Add Product Relativity */
function AddProductCom(){
	
	if(trim(document.getElementById('Selpcat').value)==""){ alert('Select Category');
	document.getElementById('Selpcat').focus();
	return false;}
	var Category=document.getElementById('Selpcat').value;
	var SubCategory=document.getElementById('CboSubCatName').value;
	var ProductType=document.getElementById('CboPtpeCode').value;
    var ExistId=document.getElementById('ExistId').value;
	var TxtEditId=document.getElementById('TxtEditId').value;
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
		
	var str = "Relativity=Y&action=AddProductRelativity&Category="+Category+"&SubCategory="+SubCategory+"&ProductType="+ProductType+"&ExistId="+ExistId+"&TxtEditId="+TxtEditId+"&r="+ran_number;
	
    var url = "include/BlModules/Bl_ProductRelativity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowAddProductCom
	return true;
}

function ShowAddProductCom() 
{
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		var Res = response.split("#######");
		if (response != "") 
		{  
		   if(trim(Res[0])=="1") {
			  alert('Already Exist')  
		      document.getElementById('Selpcat').value="";
			  document.getElementById('CboSubCatName').value="";
			  document.getElementById('CboPtpeCode').value="";
			  document.getElementById('TxtEditId').value="";
			  document.getElementById('BtnAddProductCom').value="Add"; 
		   }else {
			  document.getElementById('ShowProductComList').innerHTML=Res[1];
			  document.getElementById('Selpcat').value="";
			  document.getElementById('CboSubCatName').value="";
			  document.getElementById('CboPtpeCode').value="";
			  document.getElementById('TxtEditId').value="";
			  document.getElementById('BtnAddProductCom').value="Add";
		   }
		}
	}
}

function EditProductCom(obj){
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Relativity=Y&action=EditProductRelativity&Id="+obj+"&r="+ran_number;
    var url = "include/BlModules/Bl_ProductRelativity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowEditProductCom
}

function ShowEditProductCom() 
{
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
		    var Res = response.split("###");
			document.getElementById('TxtEditId').value=trim(Res[0]);
			document.getElementById('Selpcat').value=trim(Res[1]);
			document.getElementById('ShowProductSubCategory').innerHTML=trim(Res[2]);
			document.getElementById('ShowProductType').innerHTML=trim(Res[3]);
			document.getElementById('BtnAddProductCom').value="Update";
		}
	}
}

function DeleteProductCom(obj){
	n=confirm("Do you want to delete this Detail?");
	if (n==false)
	{
		return false;
	}
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var ExistId=document.getElementById('ExistId').value;
	var str = "Relativity=Y&action=DeleteProductRelativity&Id="+obj+"&ExistId="+ExistId+"&r="+ran_number;
    var url = "include/BlModules/Bl_ProductRelativity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowAddProductCom	
}


/* End Add Product Category, Subcategory, Product Type */
