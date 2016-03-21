function RegisterOption(Str)
{
if(Str=='Bus')
{
DocId('PersonalGridd').style.display='none';
DocId('BusinessGridd').style.display='block';
DocId('Perradio').checked=false;
DocId('Busradio').checked=true;
}
if(Str=='Per')
{
DocId('PersonalGridd').style.display='block';
DocId('BusinessGridd').style.display='none';
DocId('Busradio').checked=false;
DocId('Perradio').checked=true;

}
}

function RegisterReset()
{
document.RegisterForm.reset();
DocId('StateGrid').innerHTML='<select></select>';
DocId('CityGrid').innerHTML='<select></select>';
DocId('PStateGrid').innerHTML='<select></select>';
DocId('PCityGrid').innerHTML='<select></select>';
//DocId('txtHint').innerHTML='';
}

function ValidateFirstLevel()
{
	
	
if(DocId('CompanyName').value=='')
{
alert("Please Enter the Company Name");	
DocId('CompanyName').focus();
return false;
}
CompanyProfileValidate();
}

function CompanyProfileValidate()
{
if(DocId('YearofEst').value=='')
{
alert("Please Select the Year Of Establishment");	
DocId('YearofEst').focus();
return false;
}

else if(DocId('Sector').value=='')
{
alert("Please Select the Industry");	
DocId('Sector').focus();
return false;
}


else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(DocId('Email').value)))
{
alert("Please Enter the Valid Email Id");	
DocId('Email').focus();
return false;
}
else if(DocId('User_Name').value=='')
{
alert("Please Enter the User Name");	
DocId('User_Name').focus();
return false;
}

else if(DocId('Password').value=='')
{
alert("Please Enter the Password");	
DocId('Password').focus();
return false;
}

else if(DocId('CPassword').value=='')
{
alert("Please Enter the Confirm Password");	
DocId('CPassword').focus();
return false;
}

else if(DocId('CPassword').value!=DocId('Password').value)
{
alert("Password Mismatched");	
DocId('CPassword').focus();
DocId('Password').value='';
DocId('CPassword').value='';
return false;
}

else if(DocId('Address1').value=='' && DocId('Address2').value=='' )
{
alert("Please Enter the Address");	
DocId('Address1').focus();
return false;
}

else if(DocId('SelCountry').value=='')
{
alert("Please Select the Country");	
DocId('SelCountry').focus();
return false;
}
else if(DocId('SelState').value=='')
{
alert("Please Select the State");	
DocId('SelState').focus();
return false;
}
else if(DocId('SelCity').value=='')
{
alert("Please Select the City");	
DocId('SelCity').focus();
return false;
}

else if(DocId('Mobile').value=='' && DocId('LandLine').value=='')
{
alert("Please Enter the Mobile / Landline Number");	
DocId('Mobile').focus();
return false;
}
/*else if(DocId('ProfileLink').value=='')
{
alert("Please Enter the Page Address");	
DocId('ProfileLink').focus();
return false;
}
else if(DocId('txtHint').innerHTML!='')
{
alert("Please Change your Page Address to Proceed Further");	
DocId('ProfileLink').focus();
return false;
}*/

else
{
DocId('Busback').style.display='block';
RegisterOption('Per');
}
}



$(document).ready(function(){
$('#business_details').change(function(){
if(this.checked)
{
$('#view_business_details').fadeIn('slow');
$('#bus_details').val('1');
}
else
{
$('#view_business_details').fadeOut('slow');
$('#bus_details').val('0');
}
});
});


$(document).ready(function(){
$('#terms').change(function(){
if(this.checked)
{
$('#terms_con').val('1');
}
else
{
$('#terms_con').val('0');
}
});
});



/*-------------------------------------------------------------Registration form validation------------------------------------------------------------*/

$(document).ready(function()
{
$('#RegisterForm').submit(function()
{
if(DocId('OwnerName').value=='')
{
alert("Please Enter the Your Name");	
DocId('OwnerName').focus();
return false;
}	

else if(DocId('Email').value=='')
{
alert("Please Enter the Email");	
DocId('Email').focus();
return false;
}
else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(DocId('Email').value)))
{
alert("Please Enter the Valid Email Id");	
DocId('Email').focus();
return false;
}

else if(DocId('Mobile').value=='')
{
alert("Please Enter the Mobile Number");	
DocId('Mobile').focus();
return false;
}



if(DocId('bus_details').value =='1')
{

if(DocId('CompanyName').value=='')
{
alert("Please Enter the Company Name");	
DocId('CompanyName').focus();
return false;
}
if(DocId('YearofEst').value=='')
{
alert("Please Select the Year Of Establishment");	
DocId('YearofEst').focus();
return false;
}

if(DocId('Sector').value=='')
{
alert("Please Select the Industry");	
DocId('Sector').focus();
return false;
}

if(DocId('Designation').value=='')
{
alert("Please Enter the Company Description");	
DocId('Designation').focus();
return false;
}

if(DocId('Address1').value=='' && DocId('Address2').value=='' )
{
alert("Please Enter the Address");	
DocId('Address1').focus();
return false;
}

/*else if(DocId('SelCountry').value=='')
{
alert("Please Select the Country");	
DocId('SelCountry').focus();
return false;
}*/
if(DocId('SelState').value=='')
{
alert("Please Select the State");	
DocId('SelState').focus();
return false;
}
if(DocId('SelCity').value=='')
{
alert("Please Select the City");	
DocId('SelCity').focus();
return false;
}

}

/*else if(DocId('selectarea').value=='')
{
alert("Please Select the Area");	
DocId('selectarea').focus();
return false;
}*/
if(DocId('OpArea').value!='')
{
  var allSchools = [];
 var s = document.getElementById("OpArea");
            //alert("schools lenght  " + s.options.length);
         var c=1;
		    for (var i = 0; i < s.options.length; i++) {
                if (s.options[i].selected == true) {
					
					//alert(c);
                    var schoolid = s.options[i].value;
                  //  alert(s.options[i].value);
					
					if(c > 3)
					{ 
					alert("Please do not select more than three options");
					DocId('OpArea').focus();
					return false;
					}
                        allSchools.push(schoolid);
               var c=c+1;
				
				}
            }
}


if(DocId('User_Name').value=='')
{
alert("Please Enter the User Name");	
DocId('User_Name').focus();
return false;
}

else if(DocId('Password').value=='')
{
alert("Please Enter the Password");	
DocId('Password').focus();
return false;
}

else if(DocId('CPassword').value=='')
{
alert("Please Enter the Confirm Password");	
DocId('CPassword').focus();
return false;
}

else if(DocId('CPassword').value!=DocId('Password').value)
{
alert("Password Mismatched");	
DocId('CPassword').focus();
DocId('Password').value='';
DocId('CPassword').value='';
return false;
}


else if(DocId('terms_con').value=='0')
{
alert("Please select the Terms & Conditions");	
DocId('terms').focus();
return false;
}

var input = ($(this).serialize());
var rand = Math.random();
$.post('PasswordCheck.php', input, function(data) 
{
var res=data.split("######");
/*if(res[1]=='Yes')
{
alert("Personal User Name & Password Already Exist");
DocId('PUserName').value='';
DocId('PPassword').value='';
DocId('PCPassword').value='';
DocId('PUserName').focus();
return false;
}
else*/ if(res[1]=='Yes' && DocId('CompanyName').value!='')
{
alert("Business User Name & Password Already Exist");
DocId('User_Name').value='';
DocId('Password').value='';
DocId('CPassword').value='';
DocId('User_Name').focus();
return false;
}
else		
document.RegisterForm.submit();	
});

return false;
});
return false;
});	


function FreeUserRegister()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Fusername    = DocId('Fusername').value;
	var Fmobileno    = DocId('Fmobileno').value;
	var FemailId     = DocId('FemailId').value;
	var Fpassword    = DocId('Fpassword').value;
	var FProfileLink = DocId('FProfileLink').value;
	var Postafreead = DocId('Postafreead').value;
	var Fname         = DocId('Fname').value;
	var Fcity         = DocId('Fcity').value;
	var Fcountry      = DocId('Fcountry').value;
	if(Fname=='')
	{
	DocId('FRmsg').innerHTML="Please Enter the Name";
	DocId('Fname').focus();
	return false;
	}
	else if(Fusername=='')
	{
	DocId('FRmsg').innerHTML="Please Enter the Username";
	DocId('Fusername').focus();
	return false;
	}
	else if(Fmobileno=='')
	{
	DocId('FRmsg').innerHTML="Please Enter the Mobile";
	DocId('Fmobileno').focus();
	return false;
	}
	else if(FemailId=='')
	{
	DocId('FRmsg').innerHTML="Please Enter the Email";
	DocId('FemailId').focus();
	return false;
	}
	else if (!(/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(DocId('FemailId').value)))
	{
	DocId('FRmsg').innerHTML="Please Enter the Valid Email Id";
	DocId('FemailId').focus();
	return false;
	}
	else if(DocId('Fpassword').value=='')
	{
	DocId('FRmsg').innerHTML="Please Enter the Password";
	DocId('Fpassword').focus();
	return false;
	}
	
	else if(DocId('CFpassword').value=='')
	{
	DocId('FRmsg').innerHTML="Please Enter the Confirm Password";
	DocId('CFpassword').focus();
	return false;
	}
	
	else if(DocId('CFpassword').value!=DocId('Fpassword').value)
	{
	DocId('FRmsg').innerHTML="Password Mismatched";
	DocId('CFpassword').focus();
	DocId('Fpassword').value='';
	DocId('CFpassword').value='';
	return false;
	}
	
	var str = "action=1&Fusername="+Fusername+"&Fmobileno="+Fmobileno+"&FemailId="+FemailId+"&Fpassword="+Fpassword+"&FProfileLink="+FProfileLink+"&Postafreead="+Postafreead+"&Fname="+Fname+"&Fcity="+Fcity+"&Fcountry="+Fcountry+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_Login.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowFreeUserRegister
}



function ShowFreeUserRegister() 
{	
	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
		var FBDId= DocId('FBDId').value;
		
		var FProfileLink = DocId('FProfileLink').value;			
		var FProfiletype = DocId('FProfiletype').value;	
		
		var Res = trim(response).split('***');
		if(Res[0]=='1')
		DocId('FRmsg').innerHTML  = 'Username / Email Id Already Exists';
		else if(Res[0]=='' && Res[2]!='fad')
		{
		var FProfileLink = DocId('FProfileLink').value;	
		
		var FProfiletype = DocId('FProfiletype').value;	
		$("#overlay_form").fadeOut(500);
		$(".background_overlay").fadeOut(500);
		if(DocId('requestTypedeals').checked==true)
		window.location.href='Bestdealsajax.php?type='+FProfiletype+'&user='+FProfileLink+'&BDId='+FBDId;
		else
		window.location.href=FProfileLink;
		}
		else
		window.location.href=FProfileLink;
		//window.location.href='ManageProfile.php?user='+Res[1];	
		}
	}
}



function getUserProfile(user,id,type)
{
DocId('FProfileLink').value  = user;	
DocId('FBDId').value  = id;
DocId('FProfiletype').value  = type;
}



function FreeUserLogin()
{
  	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var FLusername    = DocId('FLusername').value;
	var FLpassword    = DocId('FLpassword').value;
	var FProfileLink  = DocId('FProfileLink').value;
	var Postafreead   = DocId('Postafreead').value;
	var Fname         = DocId('Fname').value;
	if(FLusername=='')
	{
	DocId('Fmsg').innerHTML="Please Enter the Username";
	DocId('FLusername').focus();
	return false;
	}
	else if(FLpassword=='')
	{
	DocId('Fmsg').innerHTML="Please Enter the Password";
	DocId('FLpassword').focus();
	return false;
	}
	
	var str = "action=2&FLusername="+FLusername+"&FLpassword="+FLpassword+"&FProfileLink="+FProfileLink+"&Postafreead="+Postafreead+"&Fname="+Fname+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_Login.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowFreeUserLogin
}

function ShowFreeUserLogin() 
{	

	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "")
		{ 
		var FBDId= DocId('FBDId').value;
		var FProfileLink = DocId('FProfileLink').value;
		var FProfiletype = DocId('FProfiletype').value;	
		var Res = trim(response).split('***');
		if(trim(Res[0])=='2')
		{
		DocId('Fmsg').innerHTML  = 'Invalid Username or Password!';
		DocId('FLusername').value='';
		DocId('FLpassword').value='';
		DocId('FLusername').focus();
		}
		else if(Res[0]=='22' && Res[2]!='fad')
		{
		$("#overlay_form").fadeOut(500);
		$(".background_overlay").fadeOut(500);
		if(DocId('requestTypedeals').checked==true)
	window.location.href='Bestdealsajax.php?type='+FProfiletype+'&user='+FProfileLink+'&BDId='+FBDId;
		else
		//alert(FProfileLink);
	window.location.href=FProfileLink ;

		}
		else
	window.location.href='ManageProfile.php?user='+Res[1];
		}
		
	}
}


function FreeUserForgot()
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var FFusername    = DocId('FFusername').value;
	if(FFusername=='')
	{
	DocId('Fgtmsg').innerHTML="Please Enter the Username";
	DocId('FFusername').focus();
	return false;
	}
	
	var str = "action=3&FFusername="+FFusername+"&r="+ran_number;
	
	var url = "include/BlModules/Bl_Login.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowFreeUserForgot
}

function ShowFreeUserForgot() 
{	

	if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "")
		{ 
		var FProfileLink = DocId('FProfileLink').value;	
		if(trim(response)=='3')
		DocId('Fgtmsg').innerHTML  = 'Invalid Username';
		else
		{
		alert("Password has been Sent to your Email Id & Mobile");	
		$("#overlay_form").fadeOut(500);
		$(".background_overlay").fadeOut(500);
		//window.location.href="ProfileView.php?user="+FProfileLink ;
		}
		}
	}
}


function FreeUserLoginReset()
{
$("#FLusername").val('');
$("#FLpassword").val('');
$("#Fmsg").html('');

}

function FreeUserRegisterReset()
{
$("#Fname,#Fusername,#Fmobileno,#FemailId,#CFpassword,#Fpassword").val('');
$("#FRmsg").html('');
}

function Postafreead()
{
$("#Postafreead").val('fad');	
}

function setsessionvalue(str)
{
	document.getElementById('keywordgrid').style.display = '';	
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "str="+str+"&r="+ran_number;
	var url = "include/BlModules/Bl_Setsessionval.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
}