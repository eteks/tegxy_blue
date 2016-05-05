function CompanyDetails()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var CompanyName = DocId('CompanyName').value;
	var Sector = DocId('Sector').value;
	
	var Address1 = DocId('Address1').value;
	var Address2 = DocId('Address2').value;
	var SelCountry = DocId('SelCountry').value;
	var SelState = DocId('SelState').value;
	var SelCity = DocId('SelCity').value;
	var SelArea = DocId('BArea').value;
	var SelPincode = DocId('BPincode').value;
	var Mobile = DocId('Mobile').value;
	var LandLine = DocId('LandLine').value;
	var Email = DocId('Email').value;
	
	var GroupName  = DocId('GroupName').value;
	var RequestNo  = DocId('RequestNo').value;
	var YearofEst  = DocId('YearofEst').value;
	var TypeofComp = DocId('TypeofComp').value;
	var EmpStr     = DocId('EmpStr').value;
	var Website    = DocId('Website').value;
	
	/*var FromWD     = DocId('FromWD').value;
	var ToWD       = DocId('ToWD').value;
	var FromOT     = DocId('FromOT').value;
	var ToOT       = DocId('ToOT').value;
	var FromBT     = DocId('FromBT').value;
	var ToBT       = DocId('ToBT').value;*/
	
	if(CompanyName=='')
	{
	alert("Please Enter the Company Name");
	$('#CompanyName').addClass('highlight');
	return false;
	}
	/*else if(GroupName=='')
	{
	alert("Please Enter the Group Name");
	DocId('GroupName').focus();
	return false;
	}*/
	else if(Sector=='')
	{
	alert("Please Select the Sector");
	$('#Sector').addClass('highlight');
	return false;
	}
	/*else if(RequestNo=='')
	{
	alert("Please Enter the Corporate Identification No.");
	DocId('RequestNo').focus();
	return false;
	}*/
	else if(YearofEst=='')
	{
	alert("Please Select the Year Of Establishment");
	$('#YearofEst').addClass('highlight');
	return false;
	}
	else if(TypeofComp=='')
	{
	alert("Please Select the Company Type");
	$('#TypeofComp').addClass('highlight');
	return false;
	}
	/*else if(EmpStr=='')
	{
	alert("Please Enter the Employement Strength");
	DocId('EmpStr').focus();
	return false;
	}*/
	else if(Address1=='' && Address2=='')
	{
	alert("Please Enter the Address");
	$('#Address1').addClass('highlight');
	return false;
	}
	else if(SelCountry=='')
	{
	alert("Please Select the Country");
	$('#SelCountry').addClass('highlight');
	return false;
	}
	else if(SelState=='')
	{
	alert("Please Select the State");
	$('#SelState').addClass('highlight');
	return false;
	}
	else if(SelCity=='')
	{
	alert("Please Select the City");
	$('#SelCity').addClass('highlight');
	return false;
	}
	else if(Mobile=='' && LandLine=='')
	{
	alert("Please Enter the Mobile / Landline Number");
	$('#Mobile').addClass('highlight');
	return false;
	}
	else if(!DocId('Mobile').value.match(/^\d{10}$/))  
	{  
		alert('Please Enter Mobile number with 10 digits');
		$('#Mobile').addClass('highlight');
		return false;  
	}
	else if(Email=='')
	{
	alert("Please Enter the Email");
	$('#Email').addClass('highlight');
	return false;
	}
	else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(DocId('Email').value)))
	{
	alert("Please Enter the Valid Email Id");	
	$('#Email').addClass('highlight');
	return false;
	}

	/*else if(Website=='')
	{
	alert("Please Enter the Website");
	DocId('Website').focus();
	return false;
	}*/
	
	var str = "CompanyName="+CompanyName+"&Sector="+Sector+"&Address1="+Address1+"&Address2="+Address2+"&SelCountry="+SelCountry+"&SelState="+SelState+"&SelCity="+SelCity+"&Mobile="+encodeURIComponent(Mobile)+"&LandLine="+encodeURIComponent(LandLine)+"&Email="+Email+"&GroupName="+GroupName+"&RequestNo="+RequestNo+"&YearofEst="+YearofEst+"&TypeofComp="+TypeofComp+"&GroupName="+EmpStr+"&EmpStr="+GroupName+"&Website="+Website+"&SelArea="+SelArea+"&SelPincode="+SelPincode+"&r="+ran_number;
	//+"&FromWD="+FromWD+"&ToWD="+ToWD+"&FromOT="+FromOT+"&ToOT="+ToOT+"&FromBT="+FromBT+"&ToBT="+ToBT
	var url = "include/BlModules/Bl_CompanyDetails.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowCompanyDetails
}

function ShowCompanyDetails() 
{	
	if (xmlhttp.readyState == 4) 
	{
		alert('Updated Successfully');
		var response = xmlhttp.responseText;
		if (response != "") 
		DocId('CompDetlGrid').innerHTML  = response;
	}
}

function OwnerDetails()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var OwnerName = DocId('OwnerName').value;
	
	var Designation = DocId('Designation').value;
	var DOB = DocId('DOB').value;
	
	if(DocId('Male').checked)
	Gender = DocId('Male').value;
	else
	Gender = DocId('Female').value;
	
	var Address = DocId('OwnAddr').value;
	var SelCountry = DocId('OwnSelCountry').value;
	var SelState = DocId('OwnSelState').value;
	var SelCity = DocId('OwnSelCity').value;
	var SelArea = DocId('OArea').value;
	var SelPincode = DocId('OPincode').value;

	var Mobile = DocId('OwnPhoneNo').value;
	var LandLine = DocId('OwnLandLine').value;
	var Email = DocId('OwnEmail').value;	
	var OwnEducate = DocId('OwnEducate').value;	
	
	if(OwnerName=='')
	{
	alert("Please Enter the Owner Name");
	DocId('OwnerName').focus();
	return false;
	}
	if (Email!='' && !(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(DocId('OwnEmail').value)))
	{
	alert("Please Enter the Valid Email Id");	
	DocId('Email').focus();
	return false;
	}

	var str = "OwnerName="+OwnerName+"&Designation="+Designation+"&DOB="+DOB+"&Address="+Address+"&SelCountry="+SelCountry+"&SelState="+SelState+"&SelCity="+SelCity+"&Mobile="+encodeURIComponent(Mobile)+"&LandLine="+encodeURIComponent(LandLine)+"&Email="+Email+"&OwnEducate="+OwnEducate+"&Gender="+Gender+"&SelArea="+SelArea+"&SelPincode="+SelPincode+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_OwnerDetails.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowOwnerDetails
}

function ShowOwnerDetails() 
{	
	if (xmlhttp.readyState == 4) 
	{
		alert('Updated Successfully');
		var response = xmlhttp.responseText;
		if (response != "") 
		DocId('OwnerDetlGrid').innerHTML  = response;
	}
}

function Profile()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var startData = DocId('ProStateData').value;
	var ProTitle = DocId('ProTitle').value;
	var ProfileGrid = DocId('SubProfileGrid').innerHTML;
	var Exist = DocId('ProEdit').value;
	if(ProTitle=='')
	{
	alert("Please Enter the Title");
	DocId('ProTitle').focus();
	return false;
	}
	else if(ProfileGrid=='')
	{
	alert("Please Add Description");
	DocId('SProTitle').focus();
	return false;
	}
	var str = "Action=1&Option=1&ProTitle="+ProTitle+"&Exist="+Exist+"&startdata="+startData+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProfile
}

function ShowProfile() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
		DocId('ProfileSmt').value  = 'Save Profile';	
		DocId('ProTitle').value='';
		DocId('ProEdit').value='';
		var Res = response.split('######');
		if(Res[0]!='Already Exist')
		DocId('SubProfileGrid').innerHTML  = '';
		alert(Res[0]);
				
	    if(Res[0]!='Already Exist')
		GridShowHide('ProfileEntryLevel','ProfileEntryGrid','Grid','');
		else
		GridShowHide('ProfileEntryLevel','ProfileEntryGrid','Page','');
		DocId('ProfileGrid').innerHTML  = Res[1];
		}
	}
}


function SubProfile()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var startData = DocId('SProStateData').value;
	var SProTitle = DocId('SProTitle').value;
	var SProDespp = FCKeditorAPI.GetInstance('ProfDescribe');
	var SProDesp  = SProDespp.GetXHTML(true);
	var SExist = DocId('SProEdit').value;
	var Exist = DocId('ProEdit').value;
	/*if(SProTitle=='')
	{
	alert("Please Enter the Sub Title");
	DocId('SProTitle').focus();
	return false;
	}
	else*/ if(SProDesp=='')
	{
	alert("Please Enter the Description");
	SProDesp.Focus();
	return false;
	}
	var str = "Action=2&Option=1&SProTitle="+SProTitle+"&SProDesp="+encodeURIComponent(SProDesp)+"&SExist="+SExist+"&Exist="+Exist+"&startdata="+startData+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowSubProfile
}

function ShowSubProfile() 
{	
	if (xmlhttp.readyState == 4) 
	{
		
		var response = xmlhttp.responseText;
		if (response != "") 
		{
		var Res = response.split('######');
		SubProfileResett();
		alert(Res[0]);
		DocId('SubProfileGrid').innerHTML  = Res[1];
		}
	}
}

function PageProfile(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('ProStateData').value = startData;
	var Exist = DocId('ProEdit').value;
	var str = "Action=1&Option=1&startdata="+startData+"&Exist="+Exist+"&r="+ran_number;
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageProfile
}

function ShowPageProfile()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('ProfileGrid').innerHTML  = Res[1];
		}
	}
}

function PageSubProfile(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('SProStateData').value = startData;
	var Exist = DocId('ProEdit').value;
	var str = "Action=2&Option=1&startdata="+startData+"&Exist="+Exist+"&r="+ran_number;
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageSubProfile
}

function ShowPageSubProfile()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('SubProfileGrid').innerHTML  = Res[1];
		}
	}
}

function ProfileDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('ProStateData').value = startData;
	var Exist = DocId('ProEdit').value;
	var str = "Action=1&Option=2&PId="+Id+"&startdata="+startData+"&Count="+Count+"&Exist="+Exist+"&r="+ran_number;
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProfileDelete
	}
}

function ShowProfileDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('ProfileGrid').innerHTML  = Res[1];
		}
	}
}

function SubProfileDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('SProStateData').value = startData;
   var Exist = DocId('ProEdit').value;

	var str = "Action=2&Option=2&PId="+Id+"&startdata="+startData+"&Count="+Count+"&Exist="+Exist+"&r="+ran_number;
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowSubProfileDelete
	}
}

function ShowSubProfileDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('SubProfileGrid').innerHTML  = Res[1];
		}
	}
}

function ProfileEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Option=3&PId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProfileEdit
}

function ShowProfileEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('*##*');
			GridShowHide('ProfileEntryLevel','ProfileEntryGrid','Page','');
			DocId('ProfileSmt').value  = 'Update Profile';
			DocId('ProEdit').value  = Res[1];
			DocId('ProTitle').value  = Res[2];
			DocId('SubProfileGrid').innerHTML  = Res[3];
		}
	}
}

function SubProfileEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "Option=33&PId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_Profile.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowSubProfileEdit
}

function ShowSubProfileEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('*##*');
			DocId('SubProfileSmt').value  = 'Update'
			DocId('SProEdit').value  = Res[1];
			DocId('SProTitle').value  = Res[2];
			var Desp = FCKeditorAPI.GetInstance('ProfDescribe');
			Desp.SetHTML(Res[3]);
		}
	}
}

function SubProfileResett()
{
	DocId('SubProfileSmt').value  = 'Add';	
	DocId('SProTitle').value='';
	DocId('SProEdit').value='';
	var SProDespp = FCKeditorAPI.GetInstance('ProfDescribe');
	SProDespp.SetHTML('');
	//PageSubProfile(0);

}

function SubProfileRes()
{
	SubProfileResett();
	//PageSubProfile(0);

}

function ProfileResett()
{
DocId('ProfileSmt').value  = 'Save Profile';	
DocId('ProTitle').value='';
DocId('ProEdit').value='';
DocId('SubProfileGrid').innerHTML  = '';
SubProfileResett();
//PageProfile(0);
}

function ChangeProSpecificationMode(str)
{
	if(str=='New')
	{
		document.getElementById('ProdSpecf').style.display='none';
		document.getElementById('ProdSpecf_new').style.display='';
		document.getElementById('Add_Exist').checked=false;
	}
	else
	{
		document.getElementById('ProdSpecf').style.display='';
		document.getElementById('ProdSpecf_new').style.display='none';
		document.getElementById('Add_New').checked=false;
	}
}

function ClearSpecificData(obj,obj2)
{
	if(document.getElementById(obj).value==obj2)
	{
		document.getElementById(obj).value='';
	}
}
function ShowClearSpecificData(obj,obj2)
{
	if(document.getElementById(obj).value=='')
	{
		document.getElementById(obj).value=obj2;
	}
}

function GridShowHide(PageId,GridId,Show,Type)
{	
	if(Show=='Page')
	{	
		document.getElementById(PageId).style.display='block';
		document.getElementById(GridId).style.display='none';
	}
	else
	{
		document.getElementById(PageId).style.display='none';
		document.getElementById(GridId).style.display='block';
	}
}

function AddProduct(usertype)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var DisplayName = DocId('ProDisplayName').value;
	var Product = DocId('Prodt_Id').value;
    var Name = DocId('ProductName').value;
	var IndustryList = DocId('ProCategoryList').value;
	var CategoryData = DocId('ProCategoryListId').value;
	var CategoryList = CategoryData.split('>>');
	var Category = CategoryList[0];
	var SubCategory = CategoryList[1];
	var Type = CategoryList[2];
	var Descr = DocId('ProDescr').value;
	var BusType = DocId('ProBusType').value;
	var Keyword = DocId('ProKeyword').value;
    var ExistId = DocId('ProExistId').value;
	var PdfPath = DocId('ProdPdfPath').value;
	var CoverImgPath = DocId('ProdCoverImgPath').value;
	var Price = DocId('Price').value;
	var Currency = DocId('Currency').value;
	var Unit = DocId('Unit').value;
	var Mode;
	if(DocId('ProodType1').checked)
	Mode = DocId('ProodType1').value;
	else if(DocId('ProodType2').checked)
	Mode = DocId('ProodType2').value;
	else
	Mode=''; 
	if(Mode=='')
	{
	alert("Please Select Provider / Seeker");
	DocId('ProodType1').focus();
	return false;
	}
	else if(DisplayName=='')
	{
	alert("Please Enter Display Name");
	DocId('ProDisplayName').focus();
	return false;
	}
	else if(Name=='')
	{
	alert("Please Enter and Select Product / Service Name");
	DocId('ProductName').focus();
	return false;
	}
	else if(IndustryList=='')
	{
	alert("Please Select Industry");
	DocId('IndustryList').focus();
	return false;
	}
	else if(Descr=='')
	{
	alert("Please Enter Description");
	DocId('ProDescr').focus();
	return false;
	}
	else if(BusType=='')
	{
	alert("Please Select Business Type");
	DocId('ProBusType').focus();
	return false;
	}
	else if(DocId('ProCountry').value!='' || DocId('ProLocationList').value!='')
	{
	alert("Please Add/Update Entered Location");
	DocId('ProCountry').focus();
	return false;
	}
	
	var str = "action=1&DisplayName="+DisplayName+"&Product="+Product+"&IndustryList="+IndustryList+"&SubCategory="+SubCategory+"&Type="+Type+"&Descr="+Descr+"&BusType="+BusType+"&Keyword="+Keyword+"&r="+ran_number+"&ExistId="+ExistId+"&PdfPath="+PdfPath+"&CoverImgPath="+CoverImgPath+"&Name="+Name+"&Mode="+Mode+"&Price="+Price+"&Currency="+Currency+"&Unit="+Unit+"&UserType="+usertype;
	
	var url = "include/BlModules/Bl_Product.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProduct
}

function ShowProduct() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{	
		//sms sending process
		var message = "hai, Your product was posted successfully";
		var recepiants = $('#get_sesssion').val();		
	    $.ajax({
            type: 'GET',
            url: 'http://bulksms.blackholesolution.com/app/smsapi/index.php',
            data: {'key':'55113155e7e2c','type':'text','contacts':recepiants,'senderid':'VNSPDY','msg':message},
               	success: function(data) {
                 
               	}
        });
        //sms sending process
        ProductReset();
		GridShowHide('ProductEntryLevel','ProductEntryGrid','Grid','');
		var Res = response.split('######');
		alert(Res[0]);
		DocId('ProductGrid').innerHTML  = Res[1];
	
		}
	}
}


function PageProduct(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('ProdStateData').value = startData;
	var str = "startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_Product.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageProduct
}

function ShowPageProduct()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('ProductGrid').innerHTML  = Res[1];
		}
	}
}

function ProductDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('ProdStateData').value = startData;
	var str = "action=2&ExistId="+Id+"&startdata="+startData+"&Count="+Count+"&r="+ran_number;
	var url = "include/BlModules/Bl_Product.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProductDelete
	}
}

function ShowProductDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('ProductGrid').innerHTML  = Res[1];
		}
	}
}

function ProductEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&ExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_Product.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProductEdit
}

function ShowProductEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('ProDisplayName').value=trim(Res[0]);
		DocId('Prodt_Id').value=trim(Res[1]);
		DocId('ProductName').value=trim(Res[2]);
		DocId('ProCategoryListId').value=trim(Res[3]);
		DocId('ProCategoryList').value=trim(Res[4]);
		DocId('ProDescr').value=trim(Res[5]);
		DocId('ProBusType').value=trim(Res[6]);
		DocId('ProKeyword').value=trim(Res[7]);
		DocId('ProExistId').value=trim(Res[8]);
		DocId('ProdPdfPath').value=trim(Res[9]);
		DocId('ProdPdfPathDisp').innerHTML=trim(Res[10]);
		DocId('ProdCoverImgPath').value=trim(Res[11]);
		DocId('ProdCoverImgDisp').innerHTML=trim(Res[12]);
		DocId('PGalleryList').innerHTML=trim(Res[13]);
		DocId('ProdtSpecification').innerHTML=trim(Res[14]);
		if(Res[15]==1)
		DocId('ProodType1').checked=true;
		else
		DocId('ProodType2').checked=true;
		DocId('ProLocationGrid').innerHTML=trim(Res[16]);
		GridShowHide('ProductEntryLevel','ProductEntryGrid','Page','');
		DocId('ProductSmt').value  = 'Update';
		//DocId('ProductName').disabled=true;
		//DocId('IndustryList').disabled=true;
	    DocId('ProCategoryList').disabled=true;
		DocId('ProCatList').style.display='none';
		DocId('Price').value=trim(Res[17]);
		DocId('Currency').value=trim(Res[18]);
		DocId('Unit').value=trim(Res[19]);
		//DocId('IndustryList').value=trim(Res[20]);
		}
	}
}

function ProductReset()
{
	DocId('ProDisplayName').value='';
	DocId('Prodt_Id').value='';
	DocId('ProductName').value='';
	DocId('ProCategoryList').value='';
	DocId('ProCategoryListId').value='';
	DocId('ProCategoryList').value='';
	DocId('ProDescr').value='';
	DocId('ProBusType').value='';
	DocId('ProKeyword').value='';
	DocId('ProExistId').value='';
	DocId('ProExistId').value='';
	DocId('ProdPdfPath').value='';
	DocId('ProdPdfPathDisp').innerHTML='';
	DocId('ProdCoverImgPath').value;
	DocId('ProdCoverImgDisp').innerHTML='';
	DocId('PGalleryList').innerHTML='';
	DocId('ProdtSpecification').innerHTML='';
	DocId('ProLocationGrid').innerHTML='';
	DocId('ProductSmt').value  = 'Add';
	//DocId('ProductName').disabled=false;
	DocId('ProCategoryList').disabled=false;
    DocId('ProCatList').style.display='';
	DocId('ProodType1').checked=false;
    DocId('ProodType2').checked=false;
	DocId('Price').value='';
	DocId('Currency').value='1';
	DocId('Unit').value='';
	//DocId('IndustryList').disabled=false;
	//PageProduct(0);
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=1&r="+ran_number;
	var url = "include/BlModules/Bl_Delete.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);

	SpProductReset();
}

function AddSpProduct()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var ProductSpecific = DocId('ProductSpecific').value;
	var ProdSpecDec = DocId('ProdSpecDec').value;
    var ProductSpecificId = DocId('ProductSpecificId').value;
	var SpExistId    = DocId('SpProExistId').value;
	var ExistId    = DocId('ProExistId').value;
	if(ProductSpecific=='')
	{
	alert("Please Enter Details to Add");
	DocId('ProductSpecific').focus();
	return false;
	}
	else if(ProdSpecDec=='')
	{
	alert("Please Enter Details");
	DocId('ProdSpecDec').focus();
	return false;
	}
	var str = "action=1&ProductSpecific="+ProductSpecific+"&ProdSpecDec="+ProdSpecDec+"&ProductSpecificId="+ProductSpecificId+"&r="+ran_number+"&ExistId="+ExistId+"&SpExistId="+SpExistId;
	
	var url = "include/BlModules/Bl_ProductSpecification.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowSpProduct
}

function ShowSpProduct() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
        SpProductReset();
		var Res = response.split('######');
		alert(Res[0]);
		DocId('ProdtSpecification').innerHTML  = Res[1];
		}
	}
}


function PageSpProduct(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('SpProdStateData').value = startData;
    var ExistId = DocId('ProExistId').value;

	var str = "startdata="+startData+"&ExistId="+ExistId+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProductSpecification.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageSpProduct
}

function ShowPageSpProduct()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('ProdtSpecification').innerHTML  = Res[1];
		}
	}
}

function SpProductDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('SpProdStateData').value = startData;
	var ExistId = DocId('ProExistId').value;
	var str = "action=2&ExistId="+ExistId+"&SpExistId="+Id+"&startdata="+startData+"&Count="+Count+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProductSpecification.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowSpProductDelete
	}
}

function ShowSpProductDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('ProdtSpecification').innerHTML  = Res[1];
		}
	}
}

function SpProductEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&SpExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProductSpecification.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowSpProductEdit
}

function ShowSpProductEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('ProductSpecificId').value=trim(Res[0]);
		DocId('ProductSpecific').value=trim(Res[1]);
		DocId('ProdSpecDec').value=trim(Res[2]);
		DocId('SpProExistId').value=trim(Res[3]);
		DocId('SpProductSmt').value  = 'Update';
		
		}
	}
}

function SpProductReset()
{
	DocId('ProductSpecific').value='';
	DocId('ProdSpecDec').value='';
	DocId('ProductSpecificId').value='';
	DocId('ProductSpecific').placeholder='Enter here';
	DocId('ProdSpecDec').placeholder='Enter details here';
	DocId('SpProExistId').value=''; 
	DocId('SpProductSmt').value  = 'Add';
	//PageSpProduct(0);

}


function AddGallery()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Imagee = DocId('GalleryImage').value;
	var ExistId = DocId('GalryExistId').value;
    var Desp = DocId('GalleryDesp').value;
	var Title = DocId('GalleryTitle').value;
	var Type;
	if(DocId('HeadChk').checked==true)
	Type = 1;
	else
	Type = 2;
	
	if(Imagee=='')
	{
	alert("Please Upload Image");
	DocId('GalleryImage').focus();
	return false;
	}
	
	var str = "action=1&Imagee="+Imagee+"&ExistId="+ExistId+"&Desp="+encodeURIComponent(Desp)+"&Type="+Type+"&Title="+Title;
	var url = "include/BlModules/Bl_Gallery.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowGallery
}

function ShowGallery() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
        GalleryReset();
		GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Grid','');
		var Res = response.split('######');
		alert(Res[0]);
		DocId('GalleryGrid').innerHTML  = Res[1];
		}
	}
}


function PageGallery(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('GalryStateData').value = startData;
	var str = "startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_Gallery.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageGallery
}

function ShowPageGallery()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('GalleryGrid').innerHTML  = Res[1];
		}
	}
}

function GalleryDelete(Id,Count,startData,Type)
{
    if(Type!=2)
    n=confirm("If you proceed, it will be removed from header setting");
	else
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('GalryStateData').value = startData;
	var str = "action=2&ExistId="+Id+"&startdata="+startData+"&Count="+Count+"&r="+ran_number;
	var url = "include/BlModules/Bl_Gallery.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowGalleryDelete
	}
}

function ShowGalleryDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('GalleryGrid').innerHTML  = Res[1];
		}
	}
}

function GalleryEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&ExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_Gallery.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowGalleryEdit
}

function ShowGalleryEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('GalryExistId').value=trim(Res[0]);
		DocId('GalleryImage').value=trim(Res[1]);
		DocId('GalleryImageDisp').innerHTML=trim(Res[2]);
		DocId('GalleryDesp').value=trim(Res[3]);
		if(Res[4]==1)
	    DocId('HeadChk').checked=true;
		else
	    DocId('HeadChk').checked=false;
		DocId('GalleryTitle').value=trim(Res[5]);	
		GridShowHide('GalleryEntryLevel','GalleryEntryGrid','Page','');
		DocId('GallerySmt').value  = 'Update Gallery';
		}
	}
}

function GalleryReset()
{
	DocId('GalryExistId').value='';
	DocId('GalleryImage').value='';
	DocId('GalleryImageDisp').innerHTML='';
	DocId('GalleryDesp').value='';
	DocId('GalleryTitle').value='';
	DocId('HeadChk').checked=false;
	DocId('GallerySmt').value  = 'Add Gallery';
}


function AddHeadSet()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Imagee = DocId('HeadSetImage').value;
	var ExistId = DocId('HeadSetExistId').value;
	var Type;
	if(DocId('GallyChk').checked==true)
	Type = 0;
	else
	Type = 2;
	if(Imagee=='')
	{
	alert("Please Upload Image");
	DocId('HeadSetImage').focus();
	return false;
	}
	
	var str = "action=1&Type="+Type+"&Imagee="+Imagee+"&ExistId="+ExistId;
	var url = "include/BlModules/Bl_HeaderSet.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowHeadSet
}

function ShowHeadSet() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
        HeadSetReset();
		GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Grid','');
		var Res = response.split('######');
		alert(Res[0]);
		DocId('HeadSetGrid').innerHTML  = Res[1];
		}
	}
}


function PageHeadSet(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('HeadSetStateData').value = startData;
	var str = "startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_HeaderSet.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageHeadSet
}

function ShowPageHeadSet()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('HeadSetGrid').innerHTML  = Res[1];
		}
	}
}

function HeadSetDelete(Id,Count,startData,Type)
{
    if(Type!=2)
    n=confirm("If you proceed, it will be removed from gallery");
	else
	n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('HeadSetStateData').value = startData;
	var str = "action=2&ExistId="+Id+"&startdata="+startData+"&Count="+Count+"&r="+ran_number;
	var url = "include/BlModules/Bl_HeaderSet.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowHeadSetDelete
	}
}

function ShowHeadSetDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('HeadSetGrid').innerHTML  = Res[1];
		}
	}
}

function HeadSetEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&ExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_HeaderSet.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowHeadSetEdit
}

function ShowHeadSetEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('HeadSetExistId').value=trim(Res[0]);
		DocId('HeadSetImage').value=trim(Res[1]);
		DocId('HeadSetImageDisp').innerHTML=trim(Res[2]);
		if(Res[4]==0)
	    DocId('GallyChk').checked=true;
		else
	    DocId('GallyChk').checked=false;

		GridShowHide('HeadSetEntryLevel','HeadSetEntryGrid','Page','');
		DocId('HeadSetSmt').value  = 'Update';
		}
	}
}

function HeadSetReset()
{
	DocId('HeadSetExistId').value='';
	DocId('HeadSetImage').value='';
	DocId('HeadSetImageDisp').innerHTML='';
	DocId('HeadSetSmt').value  = 'Add';
	DocId('GallyChk').checked=false;

}


function AddProLocation()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var ExistId = DocId('ProExistId').value;
	var Country = DocId('ProLocdt_Id').value;
	var LocationData = DocId('ProLocationListId').value;
	var State;
	var City; 
	var Area;
	var Pincode;
	if(LocationData !='')
	{
	LocationList = LocationData.split('>>');
	State = LocationList[0];
    City = LocationList[1];
	Area = LocationList[2];
	Pincode = LocationList[3];
	}
	var LExistId = DocId('LoctExistId').value;
	
    
	if(Country=='')
	{
	alert("Please Enter and Select Country");
	DocId('ProCountry').focus();
	return false;
	}

	
	var str = "action=1&Country="+Country+"&State="+State+"&City="+City+"&Area="+Area+"&Pincode="+Pincode+"&ExistId="+ExistId+"&LExistId="+LExistId+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_ProLocation.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProLocation
}

function ShowProLocation() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
        ShowProLocationReset();
		var Res = response.split('######');
		alert(Res[0]);
		DocId('ProLocationGrid').innerHTML  = Res[1];
		}
	}
}

function ShowProLocationReset()
{
	DocId('LoctExistId').value='';
	DocId('ProCountry').value='';
	DocId('ProLocationList').value='';
	DocId('ProLocdt_Id').value='';
	DocId('ProLocationListId').value='';
	DocId('ProLoctSmt').value='Add Location';
	DocId('LoctExistId').value='';
}

function PageProLocation(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('ProLocStateData').value = startData;
	var ExistId = DocId('ProExistId').value;
	var str = "startdata="+startData+"&ExistId="+ExistId+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProLocation.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageProLocation
}

function ShowPageProLocation()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('ProLocationGrid').innerHTML  = Res[1];
		}
	}
}

function ProLocationDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('ProLocStateData').value = startData;
	var ExistId = DocId('ProExistId').value;
	var str = "action=2&LExistId="+Id+"&startdata="+startData+"&Count="+Count+"&ExistId="+ExistId+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProLocation.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProLocationDelete
	}
}

function ShowProLocationDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('ProLocationGrid').innerHTML  = Res[1];
		}
	}
}

function ProLocationEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&LExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProLocation.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProLocationEdit
}

function ShowProLocationEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('LoctExistId').value=trim(Res[0]);
		DocId('ProCountry').value=trim(Res[1]);
		DocId('ProLocationList').value=trim(Res[2]);
		DocId('ProLocdt_Id').value=trim(Res[3]);
		DocId('ProLocationListId').value=trim(Res[4]);
		DocId('ProLoctSmt').value='Update Location';
            
		
		}
	}
}

function AddEvents()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Imagee = DocId('EventsImage').value;
	var ExistId = DocId('EventssExistId').value;
    var Desp = DocId('EventsDesp').value;
	var From = DocId('EFrom').value;
	var To = DocId('ETO').value;
	var Title = DocId('EventsTitle').value;
	if(Title=='')
	{
	alert("Please Enter the Title");
	DocId('EventsTitle').focus();
	return false;
	}
	else if(From=='')
	{
	alert("Please Select From Date");
	DocId('EFrom').focus();
	return false;
	}
	var str = "action=1&Imagee="+Imagee+"&ExistId="+ExistId+"&Desp="+encodeURIComponent(Desp)+"&From="+From+"&To="+To+"&Title="+Title;
	var url = "include/BlModules/Bl_Events.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowEvents
}

function ShowEvents() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
        EventsReset();
		GridShowHide('EventsEntryLevel','EventsEntryGrid','Grid','');
		var Res = response.split('######');
		alert(Res[0]);
		DocId('EventsGrid').innerHTML  = Res[1];
		DocId('FileSize').value  = Res[2];
		}
	}
}


function PageEvents(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('EventssStateData').value = startData;
	var str = "startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_Events.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageEvents
}

function ShowPageEvents()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('EventsGrid').innerHTML  = Res[1];
		}
	}
}

function EventsDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('EventssStateData').value = startData;
	var str = "action=2&ExistId="+Id+"&startdata="+startData+"&Count="+Count+"&r="+ran_number;
	var url = "include/BlModules/Bl_Events.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowEventsDelete
	}
}

function ShowEventsDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('EventsGrid').innerHTML  = Res[1];
		}
	}
}

function EventsEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&ExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_Events.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowEventsEdit
}

function ShowEventsEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('EventssExistId').value=trim(Res[0]);
		DocId('EventsImage').value=trim(Res[1]);
		DocId('EventsImageDisp').innerHTML=trim(Res[2]);
		DocId('EventsDesp').value=trim(Res[3]);
		DocId('EFrom').value=trim(Res[4]);
		DocId('ETO').value=trim(Res[5]);
		DocId('EventsTitle').value=trim(Res[6]);
		GridShowHide('EventsEntryLevel','EventsEntryGrid','Page','');
		DocId('EventsSmt').value  = 'Update Activity';
		}
	}
}

function EventsReset()
{
	DocId('EventssExistId').value='';
	DocId('EventsImage').value='';
	DocId('EventsImageDisp').innerHTML='';
	DocId('EventsDesp').value='';
	DocId('EventsTitle').value='';
	DocId('HeadChk').checked=false;
	DocId('EventsSmt').value  = 'Add Activity';
	DocId('EFrom').value='';
	DocId('ETO').value='';
	
	
}


function ProfileeLinkk()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var ProfileLink = DocId('ProfileLink').value;
	if(ProfileLink=='')
	{
	alert("Please Enter the Page Address");
	DocId('ProfileLink').focus();
	return false;
	}
	var str = "ProfileLink="+encodeURIComponent(ProfileLink)+"&r="+ran_number;
	var url = "include/BlModules/Bl_ProfileLink.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowProfileeLinkk
}

function ShowProfileeLinkk() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
		var res = response.split("######");
		alert(trim(res[0]));
		DocId('PrfleIdd').innerHTML  = trim(res[1]);
		}
	}
}

function AddContact()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Title = DocId('CITitle').value;
	var Person = DocId('CIPerson').value;
    var Address1 = DocId('CIAddress1').value;
	var Address2 = DocId('CIAddress2').value;
	var SelCountry = DocId('CISelCountry').value;
	var SelState = DocId('CISelState').value;
    var SelCity = DocId('CISelCity').value;
	var BArea = DocId('CIBArea').value;
	var BPincode = DocId('CIBPincode').value;
	var LandLine = DocId('CILandLine').value;
	var Email = DocId('CIEmail').value;
    var Fax = DocId('CIFax').value;
	var ExistId = DocId('ContactExistId').value;
	
	if(Title=='')
	{
	alert("Please Enter the Title");
	DocId('CITitle').focus();
	return false;
	}
	else if(Person=='')
	{
	alert("Please Enter the Person");
	DocId('CIPerson').focus();
	return false;
	}
	else if(Address1=='' && Address2=='' )
	{
	alert("Please Enter the Address");
	DocId('CIAddress1').focus();
	return false;
	}
	else if(SelCountry=='')
	{
	alert("Please Select the Country");
	DocId('CISelCountry').focus();
	return false;
	}
	else if(SelState=='')
	{
	alert("Please Select the State");
	DocId('CISelState').focus();
	return false;
	}
	else if(SelCity=='')
	{
	alert("Please Select the City");
	DocId('CISelCity').focus();
	return false;
	}
	else if(BArea=='')
	{
	alert("Please Select the Area");
	DocId('CIBArea').focus();
	return false;
	}
	else if(BPincode=='')
	{
	alert("Please Select the Pincode");
	DocId('CIBPincode').focus();
	return false;
	}

	else if(LandLine=='')
	{
	alert("Please Enter the Landline Number");
	DocId('CILandLine').focus();
	return false;
	}
	else if(Email=='')
	{
	alert("Please Enter the Email Id");
	DocId('CIEmail').focus();
	return false;
	}
	else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(DocId('CIEmail').value)))
	{
	alert("Please Enter the Valid Email Id");	
	DocId('CIEmail').focus();
	return false;
	}
	else if(Fax=='')
	{
	alert("Please Enter the Fax");
	DocId('CIFax').focus();
	return false;
	} 
	var str = "action=1&Title="+Title+"&Address1="+Address1+"&Address2="+Address2+"&SelCountry="+SelCountry+"&SelState="+SelState+"&SelCity="+SelCity+"&BArea="+BArea+"&BPincode="+BPincode+"&LandLine="+LandLine+"&Email="+Email+"&ExistId="+ExistId+"&Person="+Person+"&Fax="+Fax;
	var url = "include/BlModules/Bl_ContactInfo.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowContact
}

function ShowContact() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
        ContactResett();
		GridShowHide('ContactEntryLevel','ContactEntryGrid','Grid','');
		var Res = response.split('######');
		alert(Res[0]);
		DocId('ContactGrid').innerHTML  = Res[1];
		}
	}
}


function PageContact(startData)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	DocId('ContactStateData').value = startData;
	var str = "startdata="+startData+"&r="+ran_number;
	var url = "include/BlModules/Bl_ContactInfo.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowPageContact
}

function ShowPageContact()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('ContactGrid').innerHTML  = Res[1];
		}
	}
}

function ContactDelete(Id,Count,startData)
{
    n=confirm("Do you want to delete");
	if(n==true)
	{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	if(Count==1)
    DocId('ContactStateData').value = startData;
	var str = "action=2&ExistId="+Id+"&startdata="+startData+"&Count="+Count+"&r="+ran_number;
	var url = "include/BlModules/Bl_ContactInfo.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowContactDelete
	}
}

function ShowContactDelete()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			alert(Res[0]);
			DocId('ContactGrid').innerHTML  = Res[1];
		}
	}
}

function ContactEdit(Id)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&ExistId="+Id+"&r="+ran_number;
	var url = "include/BlModules/Bl_ContactInfo.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowContactEdit
}

function ShowContactEdit()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
		var Res = response.split('*##*');
		DocId('ContactExistId').value=Res[0];
		DocId('CITitle').value=Res[1];
		DocId('CIAddress1').value=Res[2];
		DocId('CIAddress2').value=Res[3];
		DocId('CISelCountry').value=Res[4];
		DocId('CISelState').innerHTML=Res[5];
		DocId('CISelCity').innerHTML=Res[6];
		DocId('CIBArea').innerHTML=Res[7];
		DocId('CIBPincode').innerHTML=Res[8];
		DocId('CILandLine').value=Res[9];
		DocId('CIEmail').value=Res[10];
		DocId('CIPerson').value=Res[11];
		DocId('CIFax').value=Res[12];
		GridShowHide('ContactEntryLevel','ContactEntryGrid','Page','');
		DocId('ContactSmt').value  = 'Update';
		}
	}
}

function ContactResett()
{
		DocId('ContactExistId').value='';
		DocId('CITitle').value='';
		DocId('CIAddress1').value='';
		DocId('CIAddress2').value='';
		DocId('CISelCountry').value='';
		DocId('CISelState').innerHTML="<select class='inp-text' id='CISelState' name='CISelState'></select>";
		DocId('CISelCity').innerHTML="<select class='inp-text' id='CISelCity' name='CISelCity'></select>";
		DocId('CIBArea').innerHTML="<select class='inp-text' id='CIBArea' name='CIBArea'></select>";
		DocId('CIBPincode').innerHTML="<select class='inp-text' id='CIBPincode' name='CIBPincode'></select>";
		DocId('CILandLine').value='';
		DocId('CIEmail').value='';
		DocId('CIPerson').value='';
		DocId('CIFax').value='';
		DocId('ContactSmt').value  = 'Add';
}

function ChangePassword()
{
if(DocId('OldPassword').value=='')
{
alert("Please Enter the Old Password");	
DocId('OldPassword').focus();
return false;
}
else if(DocId('NewPassword').value=='')
{
alert("Please Enter the New Password");	
DocId('NewPassword').focus();
return false;
}
else if(DocId('ConfirmPassword').value=='')
{
alert("Please Enter the Confirm Password");	
DocId('ConfirmPassword').focus();
return false;
}

else if(DocId('NewPassword').value!=DocId('ConfirmPassword').value)
{
alert("Password Mismatched");	
DocId('NewPassword').focus();
DocId('NewPassword').value='';
DocId('ConfirmPassword').value='';
return false;
}
var OldPassword = DocId('OldPassword').value;
var NewPassword = DocId('NewPassword').value
var ConfirmPassword = DocId('ConfirmPassword').value
createXmlObject();
var str = "OldPassword="+OldPassword+"&NewPassword="+NewPassword+"&ConfirmPassword="+ConfirmPassword;
var url = "include/BlModules/Bl_ChangePassword.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
xmlhttp.onreadystatechange = ShowChangePassword

}


function ShowChangePassword()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
		alert(trim(response));
		ChangePasswordReset();
		}
	}
}

function ChangePasswordReset()
{
DocId('OldPassword').value=''
DocId('NewPassword').value=''
DocId('ConfirmPassword').value=''
}

function FileUploadValidate(HImage,doc,ImageDisp,Path)
{
	// alert("yes");
	// alert(HImage);
	// alert(doc);
	// alert(ImageDisp);
	// alert(Path);
if(parseInt($("#FileSizeLimit").val()) < parseInt($("#FileSize").val()))
alert("Can not upload");
else
FileUploader(HImage,doc,ImageDisp,Path);
}

function DeleteFromFolderDB(id,disp,hidden,action)
{
 n=confirm("Do you want to delete");
if(n==true)
{
createXmlObject();
var str = "action="+action+"&id="+id;
var url = "include/BlModules/Bl_FileDelete.php";
xmlhttp.open("POST", url, true);  
xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
xmlhttp.send(str);
$("#"+disp).html("");
$("#"+hidden).val("");
xmlhttp.onreadystatechange = ShowDeleteFromFolderDB
}	
}

function ShowDeleteFromFolderDB()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('FileSize').value  = Res[2];

			if(Res[1]==21)
			PageEvents(0);
			if(Res[1]==22)
			PageGallery(0);
			if(Res[1]==23)
			PageHeadSet(0);
			
		}
	}
}
