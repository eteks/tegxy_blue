function trim(str) 
{
  return str.replace(/^\s*|\s*$/g,"");
}
function Disappear()
{
	setTimeout(settimedisp,2000);
}
function clearedate(obj)
{
	document.getElementById(obj).value='';
}
function settimedisp()
{
document.getElementById('msgdisplay').innerHTML='';
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

function DocId(Id)
{
return document.getElementById(Id);	
}


function checkNumber(o,w)						// Function Numbers only
{
o.value = o.value.replace(/[^0-9 +-]+/g,'');	// replace empty value to the characters execpt (0-9 +)
}

function OnclickCountry(str1,CountName,StaName,CitName,AreaName,Pincode)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Action=Country&Country="+str1+"&CountName="+CountName+"&StaName="+StaName+"&CitName="+CitName+"&AreaName="+AreaName+"&Pincode="+Pincode+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateCity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPertainState
}

function ShowPertainState() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			var splitresponse = response.split('######');
			
			if(DocId('StateGrid') && splitresponse[4]=='SelState')
			DocId('StateGrid').innerHTML = splitresponse[0];
			if(DocId('CityGrid') && splitresponse[5]=='SelCity')
			DocId('CityGrid').innerHTML  = splitresponse[1];
			if(DocId('BAreaGrid') && splitresponse[6]=='BArea')
			DocId('BAreaGrid').innerHTML = splitresponse[2];
			if(DocId('BPinGrid') && splitresponse[7]=='BPincode')
			DocId('BPinGrid').innerHTML  = splitresponse[3];
			
			
			
			
			
			if(DocId('PStateGrid') && splitresponse[4]=='PSelState')
			DocId('PStateGrid').innerHTML = splitresponse[0];
			if(DocId('PCityGrid') && splitresponse[5]=='PSelCity')
			DocId('PCityGrid').innerHTML  = splitresponse[1];
			if(DocId('PAreaGrid') && splitresponse[6]=='PArea')
			DocId('PAreaGrid').innerHTML = splitresponse[2];
			if(DocId('PPinGrid') && splitresponse[7]=='PPincode')
			DocId('PPinGrid').innerHTML  = splitresponse[3];
			
			
			
			if(DocId('OwnStateGrid') && splitresponse[4]=='OwnSelState')
			DocId('OwnStateGrid').innerHTML = splitresponse[0];
			if(DocId('OwnCityGrid') && splitresponse[5]=='OwnSelCity')
			DocId('OwnCityGrid').innerHTML  = splitresponse[1];
		    if(DocId('OwnAreaGrid') && splitresponse[6]=='OArea')
			DocId('OwnAreaGrid').innerHTML = splitresponse[2];
			if(DocId('OwnPinGrid') && splitresponse[7]=='OPincode')
			DocId('OwnPinGrid').innerHTML  = splitresponse[3];
			
			
			
			if(DocId('CIStateGrid') && splitresponse[4]=='CISelState')
			DocId('CIStateGrid').innerHTML = splitresponse[0];
			if(DocId('CICityGrid') && splitresponse[5]=='CISelCity')
			DocId('CICityGrid').innerHTML  = splitresponse[1];
		    if(DocId('CIBAreaGrid') && splitresponse[6]=='CIBArea')
			DocId('CIBAreaGrid').innerHTML = splitresponse[2];
			if(DocId('CIBPinGrid') && splitresponse[7]=='CIBPincode')
			DocId('CIBPinGrid').innerHTML  = splitresponse[3];

		}
	}
}


function OnclickStatee(str1,CountName,StaName,CitName,AreaName,Pincode)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Coun1 = DocId(CountName).value;
	var str = "Action=State&Coun1="+Coun1+"&State="+str1+"&CountName="+CountName+"&StaName="+StaName+"&CitName="+CitName+"&AreaName="+AreaName+"&Pincode="+Pincode+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateCity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPertainCity
}

function ShowPertainCity() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			var splitresponse = response.split('######');
			
			if(DocId('CityGrid')&& splitresponse[3]=='SelCity')
			DocId('CityGrid').innerHTML  = splitresponse[0];
			if(DocId('BAreaGrid') && splitresponse[4]=='BArea')
			DocId('BAreaGrid').innerHTML = splitresponse[1];
			if(DocId('BPinGrid') && splitresponse[5]=='BPincode')
			DocId('BPinGrid').innerHTML  = splitresponse[2];
			
			
			if(DocId('PCityGrid') && splitresponse[3]=='PSelCity')
			DocId('PCityGrid').innerHTML  = splitresponse[0];
			if(DocId('PAreaGrid') && splitresponse[4]=='PArea')
			DocId('PAreaGrid').innerHTML = splitresponse[1];
			if(DocId('PPinGrid') && splitresponse[5]=='PPincode')
			DocId('PPinGrid').innerHTML  = splitresponse[2];
			
			if(DocId('OwnCityGrid')&& splitresponse[3]=='OwnSelCity')
			DocId('OwnCityGrid').innerHTML  = splitresponse[0];
			if(DocId('OwnAreaGrid') && splitresponse[4]=='OArea')
			DocId('OwnAreaGrid').innerHTML = splitresponse[1];
			if(DocId('OwnPinGrid') && splitresponse[5]=='OPincode')
			DocId('OwnPinGrid').innerHTML  = splitresponse[2];
			
			if(DocId('CICityGrid')&& splitresponse[3]=='CISelCity')
			DocId('CICityGrid').innerHTML  = splitresponse[0];
			if(DocId('CIBAreaGrid') && splitresponse[4]=='CIBArea')
			DocId('CIBAreaGrid').innerHTML = splitresponse[1];
			if(DocId('CIBPinGrid') && splitresponse[5]=='CIBPincode')
			DocId('CIBPinGrid').innerHTML  = splitresponse[2];
			
		}
	}
}




function OnclickCityy(str1,CountName,StaName,CitName,AreaName,Pincode)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Coun1 = DocId(CountName).value;
	var State1 = DocId(StaName).value;
	var str = "Action=City&Coun1="+Coun1+"&State1="+State1+"&City="+str1+"&CountName="+CountName+"&StaName="+StaName+"&CitName="+CitName+"&AreaName="+AreaName+"&Pincode="+Pincode+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateCity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPertainArea
}

function ShowPertainArea() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			var splitresponse = response.split('######');
			
			if(DocId('BAreaGrid')&& splitresponse[2]=='BArea')
			DocId('BAreaGrid').innerHTML  = splitresponse[0];
			if(DocId('BPinGrid') && splitresponse[3]=='BPincode')
			DocId('BPinGrid').innerHTML  = splitresponse[1];
			
			if(DocId('PAreaGrid') && splitresponse[2]=='PArea')
			DocId('PAreaGrid').innerHTML  = splitresponse[0];
			if(DocId('BPinGrid') && splitresponse[3]=='BPincode')
			DocId('BPinGrid').innerHTML  = splitresponse[1];
			
			if(DocId('OwnAreaGrid')&& splitresponse[2]=='OArea')
			DocId('OwnAreaGrid').innerHTML  = splitresponse[0];
			if(DocId('BPinGrid') && splitresponse[3]=='BPincode')
			DocId('BPinGrid').innerHTML  = splitresponse[1];
			
			if(DocId('CIBAreaGrid')&& splitresponse[2]=='CIBArea')
			DocId('CIBAreaGrid').innerHTML  = splitresponse[0];
			if(DocId('CIBPinGrid') && splitresponse[3]=='CIBPincode')
			DocId('CIBPinGrid').innerHTML  = splitresponse[1];

			
		}
	}
}


function OnclickAreaa(str1,CountName,StaName,CitName,AreaName,Pincode)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	
	var Coun1 = DocId(CountName).value;
	var State1 = DocId(StaName).value;
    var City1 = DocId(CitName).value;
	
	var str = "Action=Area&Coun1="+Coun1+"&State1="+State1+"&City1="+City1+"&Area="+str1+"&CountName="+CountName+"&StaName="+StaName+"&CitName="+CitName+"&AreaName="+AreaName+"&Pincode="+Pincode+"&r="+ran_number;
	var url = "include/BlModules/Bl_CountryStateCity.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPertainPincode
}

function ShowPertainPincode() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			var splitresponse = response.split('######');
			if(DocId('BPinGrid')&& splitresponse[1]=='BPincode')
			DocId('BPinGrid').innerHTML  = splitresponse[0];
			
			if(DocId('PPinGrid') && splitresponse[1]=='PPincode')
			DocId('PPinGrid').innerHTML  = splitresponse[0];
			
			if(DocId('OwnPinGrid')&& splitresponse[1]=='OPincode')
			DocId('OwnPinGrid').innerHTML  = splitresponse[0];
			
			if(DocId('CIBPinGrid')&& splitresponse[1]=='CIBPincode')
			DocId('CIBPinGrid').innerHTML  = splitresponse[0];

		}
	}
}



function OnclickCategory(CatId,CatIdd,SubId,TypeId,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var str = "action=Product&Pcatid="+CatId+"&CatId="+CatIdd+"&SubId="+SubId+"&TypeId="+TypeId+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showSubCategory
}

function showSubCategory() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='ProSubCategory')
{
document.getElementById('ShowProductSubCategory').innerHTML = res[0];
$("#ProCategoryList").val(res[1]);
$("#ProCategoryListId").val(res[3]);
}
}
}
}




function OnclickSubCategory(CatId,SubId,SubIdd,TypeId,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var pid=document.getElementById(CatId).value;
var str = "action=Product&PSubcatid="+SubId+"&pid="+pid+"&CatId="+CatId+"&SubId="+SubIdd+"&TypeId="+TypeId+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showProductType
}

function showProductType() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='ProductType')
{
document.getElementById('ShowProductType').innerHTML = res[0];
$("#ProCategoryList").val(res[1]);
$("#ProCategoryListId").val(res[3]);
}
}
}
}

function OnclickProductType(CatId,SubId,TypeId,TypeIdd,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var pid=document.getElementById(CatId).value;
var PSubCateId=document.getElementById(SubId).value;
var str = "action=Product&PType="+TypeId+"&PSubCateId="+PSubCateId+"&CatId="+CatId+"&SubId="+SubId+"&TypeId="+TypeIdd+"&pid="+pid+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showAll
}

function showAll() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='ProductType')
{
$("#ProCategoryList").val(res[1]);
$("#ProCategoryListId").val(res[3]);
}
}
}
}



function FileUploader(obj1,obj2,obj3,obj4)
{
	// alert("FileUploader");
//newly added by kalai for logo upload
//start
if(obj3 == "UploadLogoList"){
	value = $("#uploadcompany_logo").attr('src');
	if(value == "Document/Logo/no_logo.png" || $("#"+obj3).html() == ""){
		window.open ("FileUploader.php?idname="+obj1+"&objtype="+obj2+"&disp="+obj3+"&path="+obj4,"File Uploader","menubar=1,resizable=1,scrollbars=1,width=300,height=300"); 
	}
	else
		alert("Please Delete the file");
}
//end
else if($("#"+obj3).html()!='')
alert("Please Delete the file");
else{
window.open ("FileUploader.php?idname="+obj1+"&objtype="+obj2+"&disp="+obj3+"&path="+obj4,"File Uploader","menubar=1,resizable=1,scrollbars=1,width=300,height=300"); 
}
}


function OnclickState(SId,StateId,CityId,AreaId,PinId,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var str = "action=Product&SId="+SId+"&StateId="+StateId+"&CityId="+CityId+"&AreaId="+AreaId+"&PinId="+PinId+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showCity
}

function showCity() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='City')
{
document.getElementById('ShowCityList').innerHTML = res[0];
$("#ProLocationList").val(res[1]);
$("#ProLocationListId").val(res[3]);
}
}
}
}



function OnclickCity(CId,StateId,CityId,AreaId,PinId,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var SId2=document.getElementById(StateId).value;
var str = "action=Product&CId="+CId+"&SId2="+SId2+"&StateId="+StateId+"&CityId="+CityId+"&AreaId="+AreaId+"&PinId="+PinId+"&PinId="+PinId+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showArea
}

function showArea() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='Area')
{
document.getElementById('ShowAreaList').innerHTML = res[0];
$("#ProLocationList").val(res[1]);
$("#ProLocationListId").val(res[3]);
}
}
}
}

function OnclickArea(AId,StateId,CityId,AreaId,PinId,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var SId3=document.getElementById(StateId).value;
var CId2=document.getElementById(CityId).value;
var str = "action=Product&AId="+AId+"&SId3="+SId3+"&CId2="+CId2+"&StateId="+StateId+"&CityId="+CityId+"&AreaId="+AreaId+"&PinId="+PinId+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showPin
}

function showPin() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='Pincode')
{
//document.getElementById('ShowPincodeList').innerHTML = res[0];
$("#ProLocationList").val(res[1]);
$("#ProLocationListId").val(res[3]);
}
}
}
}

function OnclickPin(PId,StateId,CityId,AreaId,PinId,File)
{
createXmlObject();
var ran_unrounded=Math.random()*100000;
var ran_number=Math.floor(ran_unrounded);
var SId4=document.getElementById(StateId).value;
var CId3=document.getElementById(CityId).value;
var AId2=document.getElementById(AreaId).value;
var str = "action=Product&PId="+PId+"&SId4="+SId4+"&CId3="+CId3+"&AId2="+AId2+"&StateId="+StateId+"&CityId="+CityId+"&AreaId="+AreaId+"&PinId="+PinId+"&r="+ran_number;
var url = "include/BlModules/"+File+".php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = showAllLoc
}

function showAllLoc() 
{ 
if (xmlhttp.readyState == 4) 
{
var response = xmlhttp.responseText;
if (response != "") 
{
var res = response.split("######");
if(res[2]=='Pincode')
{
$("#ProLocationList").val(res[1]);
$("#ProLocationListId").val(res[3]);
}
}
}
}

function showHint(str)
{
if (str.length==0)
  {
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","Checkurl.php?q="+str,true);
xmlhttp.send();
}

function urlvalidate(o,w)							
{
o.value = o.value.replace(/[^a-zA-Z0-9-]+/g,'');
}


function fill(thisValue) {
$('#searchlist').val(thisValue);
setTimeout("$('#suggestions').fadeOut();", 600);
}
function fillId(thisValue) {
$('#searchlisthidden').val(thisValue);
setTimeout("$('#suggestions').fadeOut();", 600);
}


function SearchListStyle(RequestType,SearchKey,Type,type2)
{
    if(Type==1)
	{
	   $('#Searchdisplaytypelist').css('color','#007088');
	   $('#Searchdisplaytypegrid').css('color','#EC5324');
	}
	if(Type==2)
	{
	   $('#Searchdisplaytypelist').css('color','#EC5324');
	   $('#Searchdisplaytypegrid').css('color','#007088');
	}
    var userCity=$('#userCity').val();
	if(type2=='')
	type2 = $('#type2').val();
	else
	type2 = type2;
    var url = "include/BlModules/Bl_SearchListStyle.php"; //url
	var data ="action=Listview&RequestType="+RequestType+"&SearchKey="+SearchKey+"&Type="+Type+"&userCity="+userCity+"&type2="+type2; //data
     $.ajax({ 
	  type: 'POST',
	  url: url,
	  data: data,
	  success: function(data, status){
	  	$('#mainsearchcontent').html(data);
        
		},
	  error: function(xhr, desc, err) {
			alert("Desc: " + desc + "\nErr:" + err);
		}
	}); 	
}


function fillcity(thisValue) {
    $('#userCityselect').val(thisValue);
    $('#userCity').val(thisValue);
    $('#cityvalue').html(thisValue);
    $('#citylist').val(thisValue);
    setTimeout("$('#citysuggestions').fadeOut();", 600);
}

function fillIdcity(thisValue) {
    $('#citylisthidden').val(thisValue);
    setTimeout("$('#citysuggestions').fadeOut();", 600);
    changeArealist(thisValue,'','');
}
function Togglecity(){
    $("#userCityselect").css('display','inline-block');
    $("#cityvalue").css('display','none');
	document.getElementById('userCityselect').placeholder='Select City';
    $("#userCityselect").focus();
    $("#userCityselect").val();
   
}
function changeArealist(citycode,selectt,key){
    if(citycode.length == 0) {
$('#citysuggestions').fadeOut();
} else {
$.ajax({
url: "include/BlModules/Bl_ListArea.php",
data: 'act=listarea&citycode='+citycode+'&selectt='+selectt+'&key='+key,
success: function(msg){
if(msg.length >0) {
    msg =msg.split('***');
    var arealist= msg[0];
    var cityname= msg[1];
 $('#selectarea').html(arealist);
 $('#citydisplayname').html(cityname);
}
}
});
}
}

function DeleteFromFolder(path,disp,data)
{
 n=confirm("Do you want to delete");
if(n==true)
{
createXmlObject();
var str = "action=1&path="+path;
var url = "include/BlModules/Bl_FileDelete.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
$("#"+disp).html("");
$("#"+data).html("");
}	
}
function DeleteLogoFromFolder(id,path,disp,data)
{
 n=confirm("Do you want to delete");
if(n==true)
{
createXmlObject();
var str = "action=1&path="+path+"&id="+id;
var url = "include/BlModules/Bl_FileDelete.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
$("#"+disp).html("");
$("#"+data).html("");
}	
}


function Numbercharacteronly(o,w)						
{
o.value = o.value.replace(/[^a-zA-Z0-9]+/g,'');
}

function Numberdot(o,w)						
{
o.value = o.value.replace(/[^0-9.]+/g,'');	
}

function searchResult(searchKey,selectarea,type2){
	// alert("asdf");
    var searchKey=searchKey;
    $("#searchlist").val(searchKey);
    var requestType=$("input[name='requestType']:checked").val();
    var userCity=$("#userCity").val();
	var userArea;
	if(selectarea=='')
	userArea=$("#selectarea").val();
	else
	userArea=selectarea;	
	if(type2=='')
	type2 = $("#type2").val();
	else
	type2 = type2 ;
	
    var url = "include/BlModules/Bl_SearchResults.php"; 
	
	var data ="action=Add&searchkey="+searchKey+"&requesttype="+requestType+"&usercity="+userCity+"&userarea="+userArea+"&type2="+type2;
	//alert(data);

     $.ajax({ 
	  type: 'POST',
	  url: url,
	  data: data,
	  success: function(data, status){
        $("#noneedspaces1" ).slideUp();
        $("#noneedspaces2" ).slideUp();
        $("#topsidelogo").css('display','block');
	   $("#searchResults").css('display','block');
       $("#searchResults").html(data);
	   //alert(searchResults);
		},
	  error: function(xhr, desc, err) {
			alert("Desc: " + desc + "\nErr:" + err);
		}
	}); 
    
}

function find_user_online(page_user_id){
    var url = "include/BlModules/Bl_UserOnline.php"; //url
	var data ="action=Find&page_user_id="+page_user_id; //data
     $.ajax({ 
	  type: 'POST',
	  url: url,
	  data: data,
	  success: function(data, status){
           if(data=='1'){
	           $('#iamonline').css('background-image','url(images/iamonline.png)');
	       	}
           else{
	          $('#iamonline').css('background-image','url(images/iamoffline.png)');
                       
           } 
    	},
	  error: function(xhr, desc, err) {
			alert("Desc: " + desc + "\nErr:" + err);
		}
	}); 
    }

function selectall(text,id)
{
$("#"+id).each(function(){
if($("#"+id+ " option").attr("selected"))
{
$("#"+id+"  option").removeAttr("selected");
$("#"+text).html("Select All");
}
else
{
$("#"+id+"  option").attr("selected", "selected");
$("#"+text).html("Deselect All");
}});
}