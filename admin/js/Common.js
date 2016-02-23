	// JavaScript Document
function Disappear()
{
	setTimeout(settimedisp,2000);
}
function settimedisp()
{
document.getElementById('msgdisplay').innerHTML='&nbsp;';
}

function myshowterg()
{
 document.getElementById('slide').style.display='block';
}

function createXmlObject() 
{
	if (window.XMLHttpRequest) 
	{
		xmlhttp = new XMLHttpRequest();
	} 
	else if(window.ActiveXObject) 
	{
		xmlhttp = new ActiveXObject("MSXML2.XMLHTTP");
	}
}


function cancelpage()
{
	document.location.href="index.php";
}

function OnChangeFilterElement(str1,str2,str3)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	/*var ModuleId=document.getElementById('ModuleId').value;*/
	var SearchFilterFieldList = document.getElementById(str1+'List').value;
	var SearchFilterField = document.getElementById(str1).value;
	var str = "Action=Filter&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&ModuleId="+str2+"&r="+ran_number;
	var url = "include/BlModules/"+str3+".php";	
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showOnChangeFilterElement
}

function showOnChangeFilterElement() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
		}
	}
}

function is_email(email)
{
   var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
   if(reg.test(email) == false) {
      return false;
   }
   return true;
}


function OnclickGeneralCountry(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
		/*var ModuleId=document.getElementById('ModuleId').value;*/
		
	var str = "action=GeneralCountry&Country="+str1+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateArea.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showGeneralCountry
}

function showGeneralCountry() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('ShowStateList').innerHTML = response;
		}
	}
}


function OnChangeFilterElement(str1,str2,str3)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	/* var ModuleId=document.getElementById('ModuleId').value; */
	var SearchFilterFieldList = document.getElementById(str1+'List').value;
	var SearchFilterField = document.getElementById(str1).value;
	var str = "Action=Filter&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&ModuleId="+str2+"&r="+ran_number;
	var url = "include/BlModules/"+str3+".php";	
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showOnChangeFilterElement
}

function showOnChangeFilterElement() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "")
		{
			document.getElementById('DetailList').innerHTML = response;
		}
	}
}
function onchangeFilterField(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var ModuleId=document.getElementById('ModuleId').value;
	var SearchFilterFieldList=document.getElementById('SearchFilterFieldList').value;
	var str = "action=FilterFieldList&SearchFilterFieldList="+SearchFilterFieldList+"&ModuleId="+ModuleId+"&r="+ran_number;
	var url = "include/BlModules/"+str1+".php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showonchangeCountryFilter
}
function showonchangeCountryFilter()
{
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('FilterFieldList').innerHTML=response;
		}
	}
}
function OnClickPage(startData)
{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
		var fileName=document.getElementById('fileName').value;
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value;
		var SearchFilterField     = document.getElementById('SearchFilterField').value;
		var str = "action=Page&fileName="+fileName+"&ModuleId="+ModuleId+"&startdata="+startData+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
	    xmlhttp.onreadystatechange = showOnClickPage
}

function showOnClickPage() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		//alert(response);
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
		}
	}
}

function OnClickStatusInActive(id,startData) 
{ 
	document.getElementById('tr_'+id).style.color = '#ffff00'; 
	n=confirm("Do you want to In-Active this Detail?"); 
	if (n==true) 
	{ 
		createXmlObject(); 
		var ran_unrounded=Math.random()*100000; 
		var ran_number=Math.floor(ran_unrounded); 
		var ModuleId=document.getElementById('ModuleId').value; 
		var fileName=document.getElementById('fileName').value; 
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value; 
		var SearchFilterField     = document.getElementById('SearchFilterField').value; 
		var str = "action=status&val=0&fileName="+fileName+"&ModuleId="+ModuleId+"&id="+id+"&startdata="+startData+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number; 
		var url = "include/BlModules/Bl_"+fileName+".php"; 
		xmlhttp.open("POST", url, true); 
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = showOnClickStatusInActive
	}
	else
	{
		document.getElementById('tr_'+id).style.color = '#FFFFFF';
	}
}

function showOnClickStatusInActive() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
			document.getElementById('msgdisplay').innerHTML = 'In Active Status Updated Successfully';
		}
	} else {
		document.getElementById('msgdisplay').innerHTML = 'Unable to change the Status';
	}

}

function OnClickStatusActive(id,startData)
{
	document.getElementById('tr_'+id).style.color = '#ffff00';
	n=confirm("Do you want to Active this Detail?");
	if (n==true)
	{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
		var fileName=document.getElementById('fileName').value;
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value;
		var SearchFilterField     = document.getElementById('SearchFilterField').value;
		var str = "action=status&val=1&fileName="+fileName+"&ModuleId="+ModuleId+"&id="+id+"&startdata="+startData+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = showOnClickStatusActive
	}
	else
	{
		document.getElementById('tr_'+id).style.color = '#FFFFFF';
	}
}

function showOnClickStatusActive() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
			document.getElementById('msgdisplay').innerHTML = 'Active Status Updated Successfully';
		}
	} else {
		document.getElementById('msgdisplay').innerHTML = 'Unable to change the Status';
	}
}

function OnclickEdit(id,startData)
{
	createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		//alert(document.getElementById('ModuleId').value);
		var ModuleId=document.getElementById('ModuleId').value;
		var fileName=document.getElementById('fileName').value;
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value;
		var SearchFilterField     = document.getElementById('SearchFilterField').value;
		
		var str = "action=edit&id="+id+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number+"&ModuleId="+ModuleId+"&startdata="+startData;
		var url = ""+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
	xmlhttp.onreadystatechange = showOnclickEdit
}

function showOnclickEdit() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		//alert(response);
		if (response != "") 
		{
			document.getElementById('ScrollText').innerHTML = response;
			document.getElementById('ScrollText').scrollIntoView(true);
			document.getElementById('ScrollText').scrollIntoView(true);
		}
	}
}

function OnClickDelete(id,startData)
{
	document.getElementById('tr_'+id).style.color = '#ffff00';
	n=confirm("Do you want to Delete this Detail?");
	if (n==true)
	{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
		var fileName=document.getElementById('fileName').value;
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value;
		var SearchFilterField     = document.getElementById('SearchFilterField').value;
		var str = "action=delete&val=1&ModuleId="+ModuleId+"&id="+id+"&startdata="+startData+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = showOnClickDelete
	}
	else
	{
		document.getElementById('tr_'+id).style.color = '#FFFFFF';
	}
}

function showOnClickDelete() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
			document.getElementById('msgdisplay').innerHTML = 'Deleted Successfully';
		}
	}
	else
	{
		document.getElementById('msgdisplay').innerHTML = 'Unable to Delete Record';
	}
}

function OnclickView(id,startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var ModuleId=document.getElementById('ModuleId').value;
	fileName=document.getElementById('fileName').value;
	var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value;
	var SearchFilterField     = document.getElementById('SearchFilterField').value;
	var str = "action=view&id="+id+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number+"&ModuleId="+ModuleId+"&startdata="+startData;
	var url = fileName+".php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showOnclickView
}

function showOnclickView() 
{
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('ScrollText').innerHTML = response;
		}
	}
}



function OnClickNVerification(id,startData) 
{ 
	document.getElementById('tr_'+id).style.color = '#ffff00'; 
	n=confirm("Do you want to In-Active this Detail?"); 
	if (n==true) 
	{ 
		createXmlObject(); 
		var ran_unrounded=Math.random()*100000; 
		var ran_number=Math.floor(ran_unrounded); 
		var ModuleId=document.getElementById('ModuleId').value; 
		var fileName=document.getElementById('fileName').value; 
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value; 
		var SearchFilterField     = document.getElementById('SearchFilterField').value; 
		var str = "action=verify&val=0&ModuleId="+ModuleId+"&id="+id+"&startdata="+startData+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number; 
		var url = "include/BlModules/Bl_"+fileName+".php"; 
		xmlhttp.open("POST", url, true); 
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = showOnClickNVerification
	}
	else
	{
		document.getElementById('tr_'+id).style.color = '#FFFFFF';
	}
}

function showOnClickNVerification() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
			document.getElementById('msgdisplay').innerHTML = 'Verification Status Updated Successfully';
		}
	} else {
		document.getElementById('msgdisplay').innerHTML = 'Unable to change Status';
	}

}

function OnClickVerification(id,startData)
{
	document.getElementById('tr_'+id).style.color = '#ffff00';
	n=confirm("Do you want to Active this Detail?");
	if (n==true)
	{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
		var fileName=document.getElementById('fileName').value;
		var SearchFilterFieldList = document.getElementById('SearchFilterFieldList').value;
		var SearchFilterField     = document.getElementById('SearchFilterField').value;
		var str = "action=verify&val=1&ModuleId="+ModuleId+"&id="+id+"&startdata="+startData+"&SearchFilterField="+SearchFilterField+"&SearchFilterFieldList="+SearchFilterFieldList+"&r="+ran_number;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = showOnClickVerification
	}
	else
	{
		document.getElementById('tr_'+id).style.color = '#FFFFFF';
	}
}

function showOnClickVerification() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
			document.getElementById('msgdisplay').innerHTML = 'Verification Status Updated Successfully';
		}
	} else {
		document.getElementById('msgdisplay').innerHTML = 'Unable to change Status';
	}
}




function OnClickPage(startData)
{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
		var fileName=document.getElementById('fileName').value;
		var str = "action=Page&fileName="+fileName+"&ModuleId="+ModuleId+"&startdata="+startData+"&r="+ran_number;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
	    xmlhttp.onreadystatechange = showOnClickPage
}

function showOnClickPage() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		//alert(response);
		if (response != "") 
		{
			document.getElementById('DetailList').innerHTML = response;
		}
	}
}




function StatusInActive(Id,Value,StartPage,fileName)
{
	var msg;
	if(Value==0){
		msg ="Do you want to In-Active this Detail?";
	} else {
		msg ="Do you want to Active this Detail?";
	}
	n=confirm(msg);
	if (n==true)
	{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
        var searchKey=$('#companySearchField').val();
		var str = "action=status&searchact=search&id="+Id+"&status="+Value+"&startdata="+StartPage+"&ModuleId="+ModuleId+"&fileName="+fileName+"&r="+ran_number+"&searchKey="+searchKey;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = ShowStatusInActive  
	}
}

function ShowStatusInActive()
{
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
    	    document.getElementById('msgdisplay').innerHTML = 'Status Updated Successfully';
			document.getElementById('DetailList').innerHTML=response;
		}
	}
}

function OnclickGeneralState(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Country = document.getElementById('SelCountry').value;
	var str = "action=GeneralState&Country="+Country+"&State="+str1+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateArea.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showGeneralCity
}

function showGeneralCity() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('ShowCityList').innerHTML = response;
		}
	}
}

function OnclickGeneralCity(str1)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Country = document.getElementById('SelCountry').value;
	var State = document.getElementById('SelState').value;
	var str = "action=GeneralCity&Country="+Country+"&State="+State+"&City="+str1+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateArea.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = showGeneralArea
}

function showGeneralArea() 
{ 
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			document.getElementById('ShowAreaList').innerHTML = response;
		}
	}
}

function toggleFeatured(id,status,StartPage){
     var msg;
	if(status==1){
		msg ="Do you want to Un List this From  Featured?";
	} else {
	      if($("#FeaturedAlert").val()<10)	
	      msg ="Do you want to List this as Featured?";
		  else
		  msg = "Only Ten Featured Companies Can be Listed";
	}
	n=confirm(msg);
	if (n==true)
	{
        var searchKey=$('#companySearchField').val();
    	var ModuleId=document.getElementById('ModuleId').value;
     var url = "include/BlModules/Bl_BusinessUser.php"; //url
	var data ="act=toggleFeatured&searchact=search&fileName=BusinessUser&id="+id+"&status="+status+"&ModuleId="+ModuleId+"&startdata="+StartPage+"&searchKey="+searchKey; //data
     $.ajax({ 
	  type: 'POST',
	  url: url,
	  data: data,
	  success: function(data, status){
	   var responsedata=data.split('@@@@')
       var limitfeatured=data.split('****');
       var checkActive=data.split('###');
       if($("#FeaturedAlert").val()<10)
	   {
       if(limitfeatured[1]=='1'){
        alert("Only Ten Featured Companies Can be Listed");
       }
	   }
       if(checkActive[1]=='1'){
        alert("Please Activate the Company First")
       }
	    $('#DetailList').html(responsedata[1]);
        },
	  error: function(xhr, desc, err) {
			alert("Desc: " + desc + "\nErr:" + err);
		}
	}); 
    }
}

function searchCompBy(fileName){
    
    var ModuleId=document.getElementById('ModuleId').value;
    var searchKey=$('#companySearchField').val();
     var url = "include/BlModules/Bl_BusinessUser.php"; //url
	var data ="searchact=search&searchKey="+searchKey+"&ModuleId="+ModuleId+"&fileName="+fileName; //data
     $.ajax({ 
	  type: 'POST',
	  url: url,
	  data: data,
	  success: function(data, status){
        
        $('#DetailList').html(data);
		},
	  error: function(xhr, desc, err) {
			alert("Desc: " + desc + "\nErr:" + err);
		}
	}); 
    
    
}


function PaymentInActive(Id,Value,StartPage,fileName)
{
	var msg;
	if(Value==0){
		msg ="Do you want to In-Active the Payment?";
	} else {
		msg ="Do you want to Active the Payment?";
	}
	n=confirm(msg);
	if (n==true)
	{
		createXmlObject();
		var ran_unrounded=Math.random()*100000;
		var ran_number=Math.floor(ran_unrounded);
		var ModuleId=document.getElementById('ModuleId').value;
        var searchKey=$('#companySearchField').val();
		var str = "action=paystatus&searchact=search&id="+Id+"&status="+Value+"&startdata="+StartPage+"&ModuleId="+ModuleId+"&fileName="+fileName+"&r="+ran_number+"&searchKey="+searchKey;
		var url = "include/BlModules/Bl_"+fileName+".php";
		xmlhttp.open("POST", url, true);  
		xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
		xmlhttp.send(str);
		xmlhttp.onreadystatechange = ShowPaymentInActive  
	}
}

function ShowPaymentInActive()
{
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
    	    document.getElementById('msgdisplay').innerHTML = 'Payment Status Updated Successfully';
			document.getElementById('DetailList').innerHTML=response;
		}
	}
}