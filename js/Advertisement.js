// JavaScript Document

function Advformresetsecondlevel()
{
$("#Formcreatenew")[0].reset();
$("#Formcreateexist")[0].reset();
$("#Formadvname")[0].reset();
$("#Formadvname")[0].reset();
$("#Formtimeline")[0].reset();
$("#Formtargetad")[0].reset();
$("#Formdisplayformate")[0].reset();
}


function Advformreset()
{
$("#Advnamegrid").hide();
$("#Selectexistgrid").hide();
$("#Selectnewgrid").hide();
Advformresetsecondlevel();
$("#Nextprocess").hide();
$("#Advertiselevel").val('');
$("#Advertise").val('');

}



function Createnewadv()
{
$("#Renewgrid").hide();	
$("#Selectiongrid").show();
Advformreset();
}

function Renewadv()
{
$("#Renewgrid").show();
$("#Selectiongrid").hide();
Advformreset();
}

function Selectfromexistadv()
{
$("#Advnamegrid").show();
$("#Selectexistgrid").show();
$("#Selectnewgrid").hide();
$("#Nextprocess").show();
Advformresetsecondlevel();
$("#Advertiselevel").val(1);
}

function Selectcreatenewadv()
{
	$('#Renewgrid').hide();
	$("#Advnamegrid").show();
	$("#Selectexistgrid").hide();
	$("#Selectnewgrid").show();
	$("#Nextprocess").show();
	Advformresetsecondlevel();
	$("#Advertiselevel").val(2);
	//newly added by kalai
	$('#ADVImageDisp').html('');
}

function Firstleveladv()
{
$("#Firstleveladv").show();
$("#Secondleveladv").hide();
$("#Thirdleveladv").hide();
}

function Secondleveladv()
{
$("#Firstleveladv").hide();
$("#Secondleveladv").show();
$("#Thirdleveladv").hide();
$("#Fourthleveladv").hide();
}

function Thirdleveladv()
{
$("#Firstleveladv").hide();
$("#Secondleveladv").hide();
$("#Thirdleveladv").show();
$("#Fourthleveladv").hide();
}

function Fourthleveladv()
{
$("#Firstleveladv").hide();
$("#Secondleveladv").hide();
$("#Thirdleveladv").hide();
$("#Fourthleveladv").show();
}


function AdvSelection(type,user)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=1&type="+type+"&user="+user+"&r="+ran_number;
	var url = "include/BlModules/Bl_Advertisement.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowAdvSelection
}

function ShowAdvSelection()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('######');
			DocId('Selectionresponse').innerHTML  = Res[0];
		}
	}
}

function AddAdvertisement(user)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var Advname= DocId('Advname').value;
	var Advselectionlist=0;
	var Advlinkselection=0;
	var Advlinkurl=0;
	var Advimage=0;
	var Advdescription=0;
	var Advertiselevel = DocId('Advertiselevel').value;
	var Advselectiontype=0;
	if(Advertiselevel==1)
	{
    Advselectiontype= DocId('Selectiontype').value;
	Advselectionlist= DocId('Selectionlistadv').value;
	if(DocId('Linkselection').checked==true)
	Advlinkselection= DocId('Linkselection').value;
	else if(DocId('Linkselectionn').checked==true)
	Advlinkselection= DocId('Linkselectionn').value;
	else
	Advlinkselection='';
	var Advlinkurl= DocId('Linkurladv').value;
	}
	if(Advertiselevel==2)
	{
	Advimage= DocId('ADVImage').value;
	Advdescription= DocId('Advdescription').value;
	}
	var Advisplayformate = DocId('Firstformate').value;
	var Advtargetpage = DocId('Targetpage').value;
	var Advlocation = DocId('AdvLocation').value;
	var Advsector = DocId('AdvSector').value;
	var Advaudience = DocId('Advaudience').value;
	var Advfromtimeline = DocId('Fromtimeline').value;
	var Advtotimeline = DocId('Totimeline').value;
	var Advamount = DocId('Advamount').value;
	var Advbudget = DocId('Advbudget').value;
	var Advertise = DocId('Advertise').value;	
	var str = "action=2&user="+user+"&Advname="+Advname+"&Advselectionlist="+Advselectionlist+"&Advlinkselection="+Advlinkselection+"&Advlinkurl="+Advlinkurl+"&Advimage="+Advimage+"&Advdescription="+Advdescription+"&Advisplayformate="+Advisplayformate+"&Advtargetpage="+Advtargetpage+"&Advlocation="+Advlocation+"&Advsector="+Advsector+"&Advaudience="+Advaudience+"&Advfromtimeline="+Advfromtimeline+"&Advtotimeline="+Advtotimeline+"&Advamount="+Advamount+"&Advbudget="+Advamount+"&Advertise="+Advertise+"&Advertiselevel="+Advertiselevel+"&Advselectiontype="+Advselectiontype+"&r="+ran_number;
	var url = "include/BlModules/Bl_Advertisement.php";
	
	// if(DocId('Targetpage').value=='' || DocId('AdvLocation').value=='' || DocId('AdvSector').value=='' || DocId('Advaudience').value=='' || DocId('Fromtimeline').value=='' || DocId('Totimeline').value=='' || DocId('Advamount').value=='' || DocId('Advbudget').value==''){
		
	if(DocId('Targetpage').value==''){
		$('#Targetpage').addClass('error');
	}
	else{
		$('#Targetpage').removeClass('error');
	}
	
	if(DocId('AdvLocation').value==''){
		$('#AdvLocation').addClass('error');
	}
	else{
		$('#AdvLocation').removeClass('error');
	}

	if(DocId('AdvSector').value==''){
		$('#AdvSector').addClass('error');
	}
	else{	
		$('#AdvSector').removeClass('error');
	}

	if(DocId('Advaudience').value==''){
		$('#Advaudience').addClass('error');
	}
	else{
		$('#Advaudience').removeClass('error');
	}

	if((DocId('Fromtimeline').value=='')){
		$('#Fromtimeline').addClass('error');
		return false;
	}
	else{
		$('#Fromtimeline').removeClass('error');
	}

	if((DocId('Totimeline').value=='')){
		$('#Totimeline').addClass('error');
		return false;
	}
	else{
		$('#Totimeline').removeClass('error');
	}
	var from = $("#Fromtimeline").val();
	var to = $("#Totimeline").val();
	if(from > to){	
	   alert("Invalid Date Range");
	   return false;
	}
	
	if((DocId('Advamount').value=='')){
			$('#Advamount').addClass('error');
		}else{
			$('#Advamount').removeClass('error');
	}

	if((DocId('Advbudget').value=='')){
		$('#Advbudget').addClass('error');
	}else{
		$('#Advbudget').removeClass('error');
	}
	if(($('#Targetpage') || $('#AdvLocation') || $('#AdvSector') || $('#Advaudience') || $('#Fromtimeline') || $('#Totimeline') || $('#Advamount') || $('#Advbudget')).hasClass('error')){
		xmlhttp.open("POST", url, false);
		alert('Please Enter all the required fields');
	}
	else{
		if($('#Advname').val() == '' && $('#Advdescription').val() == ''){
			xmlhttp.open("POST", url, false);
			alert('Please Enter all the required fields ye');
		}
		else{
			xmlhttp.open("POST", url, true);  
			xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
			xmlhttp.send(str);
			xmlhttp.onreadystatechange = ShowAdvertisement
		}

		
	}
}

function ShowAdvertisement()
{
if (xmlhttp.readyState == 4) 
	{
		var response = xmlhttp.responseText;
		if (response != "") 
		{
			//sms sending process
			var message = "hai, Your Advertisement was posted successfully";
			var recepiant = $('#get_sesssion_for_ad').val();
			// alert('recepiant'+$('#get_sesssion_for_ad').val());		
		    // $.ajax({
	     //        type: 'GET',
	     //        url: 'http://bulksms.blackholesolution.com/app/smsapi/index.php',
	     //        data: {'key':'55113155e7e2c','type':'text','contacts':recepiant,'senderid':'VNSPDY','msg':message},
	     //           	success: function(data) {
	                 
	     //           	}
	     //    }); 
	        //sms sending process
			var Res = response.split('######');
			// DocId('Advalert').innerHTML  = Res[0];
			alert(Res[0]);
			Advformreset();
		}
	}
}

function FileUploadValidate(HImage,doc,ImageDisp,Path)
{
if(parseInt($("#FileSizeLimit").val()) < parseInt($("#FileSize").val()))
alert("Can not upload");
else
FileUploader(HImage,doc,ImageDisp,Path);
}

function Advertisementedit(editid,user)
{
	createXmlObject();
	var ran_unrounded=Math.random()*100000;
	var ran_number=Math.floor(ran_unrounded);
	var str = "action=3&editid="+editid+"&user="+user+"&r="+ran_number;
	var url = "include/BlModules/Bl_Advertisement.php";
	xmlhttp.open("POST", url, true);  
	xmlhttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded; charset=UTF-8");
	xmlhttp.send(str);
	xmlhttp.onreadystatechange = ShowAdvertisementedit
}

function ShowAdvertisementedit()
{
	// alert("ShowAdvertisementedit");
if (xmlhttp.readyState == 4) 
	{
		// alert("yes");
		var response = xmlhttp.responseText;
		if (response != "") 
		{ 
			var Res = response.split('#**#');
			if(Res[2]==1)
			{
			Selectfromexistadv();	
			DocId('Advname').value  = Res[1];
			DocId('Selectiontype').value  = Res[3];
			DocId('Selectionresponse').innerHTML  = Res[4];
			if(Res[5]==1)
			DocId('Linkselection').checked  = true;
			else
			{
				// alert(Res[1]);
			DocId('Advname').value  = Res[1];	
			DocId('Linkselectionn').checked  = true;
			DocId('Linkurladv').value = Res[6];
			}
			}
			if(Res[2]==2)
			{
			Selectcreatenewadv();	
			//newly added
			//*****
			DocId('Advname').value  = Res[1];	
			//*****
			DocId('ADVImage').value  = Res[7];
			// DocId('ADVImageDisp').innerHTML  = Res[8];

			DocId('ADVImageDisp').innerHTML  ='<img width="30" height="30" src="'+Res[8]+'" />\
			&nbsp;&nbsp;<span style="color: #00677D;cursor: pointer;font-size: 11px;font-weight: bold;" onclick="DeleteFromFolder(\''+Res[8]+'\',\'ADVImageDisp\',\'ADVImage\');" >Delete</span>&nbsp;&nbsp;';

			DocId('Advdescription').value  = Res[9];
			}
			if(Res[10]!='')
			DocId('Firstformate').checked=true;
			DocId('Targetpage').value = Res[11];
/*			DocId('AdvLocation').value = Res[0];
*/			DocId('AdvSector').value = Res[12];
			DocId('Advaudience').value = Res[13];
			DocId('Fromtimeline').value = Res[14];
			DocId('Totimeline').value = Res[15];
			DocId('Advamount').value = Res[16];
			DocId('Advbudget').value = Res[17];
			DocId('Advertise').value= Res[18];
		}
	}
}


function Advdisplayduration()
{
$('#Fromtimeline').val();
$('#Totimeline').val();	
alert($('#Fromtimeline').val()+$('#Totimeline').val())
}

$(document).ready(function(){	

	// prev and next process for first step
	$('.adv_next').click(function(){		
	    element = $(this).parents('.next_ad');	   	 
        if($('#Advname').val() != '' && $('#Advdescription').val() != ''){	
    		element.hide();	        
	        $('#Firstleveladv').next('.next_ad').show();  	           
        }	       
  	    else{
	        $('#Advname,#Advdescription').addClass('error');
           	element.show();
	    }
	    
	});

    // validation code when click previous button
    $('.adv_previous_format').click(function(){
        element = $(this).parents('.next_ad');
        element.hide();
        element.prev().children('.next_ad').show();
        return false;
    });

    // next click for step2
    $('.ad_next_format').click(function(){    	
    	element = $(this).parents('.next_ad');    	
		if ($('#Firstformate').is(':checked')){
			element.hide();
			$('#Thirdleveladv').show();
		}
		else{
			$('#ad_next_format').addClass('error');
			element.show();
		} 
    });
    // step3
    $('.adv_previous_format1').click(function(){
        element = $(this).parents('.next_ad1');
        // alert(element.html());
        element.hide();
        element.prev('.next_ad').show();
        return false;        
    });

});